const express = require('express');
const router = express.Router();
const pool = require('../config/db');
const multer = require('multer');
const path = require('path');

// Setup multer storage for uploaded images
const storage = multer.diskStorage({
  destination: function (req, file, cb) {
    cb(null, 'uploads/');  
  },
  filename: function (req, file, cb) {
    const uniqueSuffix = Date.now() + '-' + Math.round(Math.random() * 1E9);
    // Save file with original extension
    cb(null, uniqueSuffix + path.extname(file.originalname));
  }
});

const upload = multer({ storage });

// Get all entrepreneurs
router.get('/', async (req, res) => {
  try {
    const [rows] = await pool.query('SELECT * FROM entrepreneurs');
    // Map over rows to add image URL
    const entrepreneurs = rows.map(e => ({
      ...e,
      image_url: e.image ? `/uploads/${e.image}` : null
    }));
    res.json(entrepreneurs);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// Add new entrepreneur with image upload
router.post('/', upload.single('image'), async (req, res) => {
  const { name, age, village, phone, product_type } = req.body;
  const image = req.file ? req.file.filename : null;  // filename stored in uploads/
  try {
    const [result] = await pool.query(
      'INSERT INTO entrepreneurs (name, age, village, phone, product_type, image) VALUES (?, ?, ?, ?, ?, ?)',
      [name, age, village, phone, product_type, image]
    );
    res.status(201).json({ id: result.insertId, message: 'Entrepreneur added' });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// Update entrepreneur by ID with optional image upload
router.put('/:id', upload.single('image'), async (req, res) => {
  const { id } = req.params;
  const { name, age, village, phone, product_type } = req.body;
  const image = req.file ? req.file.filename : null;
  
  try {
    if (image) {
      // Update with image
      await pool.query(
        'UPDATE entrepreneurs SET name=?, age=?, village=?, phone=?, product_type=?, image=? WHERE id=?',
        [name, age, village, phone, product_type, image, id]
      );
    } else {
      // Update without image
      await pool.query(
        'UPDATE entrepreneurs SET name=?, age=?, village=?, phone=?, product_type=? WHERE id=?',
        [name, age, village, phone, product_type, id]
      );
    }
    res.json({ message: 'Entrepreneur updated' });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// Get distinct villages
router.get('/villages', async (req, res) => {
  try {
    const [rows] = await pool.query('SELECT DISTINCT village FROM entrepreneurs');
    const villages = rows.map(row => row.village);
    res.json(villages);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});



// Delete entrepreneur by ID
router.delete('/:id', async (req, res) => {
  const { id } = req.params;
  try {
    await pool.query('DELETE FROM entrepreneurs WHERE id = ?', [id]);
    res.json({ message: 'Entrepreneur deleted' });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

module.exports = router;
