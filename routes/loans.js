const express = require('express');
const router = express.Router();
const db = require('../config/db');

// Get all loans with entrepreneur details
router.get('/', async (req, res) => {
  try {
    const [rows] = await db.query(`
      SELECT 
        l.*,
        e.name AS entrepreneurName,
        e.village AS entrepreneurVillage,
        e.image AS entrepreneurAvatarUrl
      FROM loans l
      LEFT JOIN entrepreneurs e ON l.entrepreneur_id = e.id
      ORDER BY l.disbursement_date DESC
    `);
    res.json(rows);
  } catch (err) {
    console.error('Error fetching loans:', err);
    res.status(500).json({ error: err.message });
  }
});

// Add a loan entry
router.post('/', async (req, res) => {
  const {
    entrepreneur_id,
    entrepreneur_name,
    village,
    amount,
    interest_rate,
    disbursement_date,
    due_date,
    purpose,
    notes,
    status
  } = req.body || {};

  // Required fields check
  if (!entrepreneur_id || !entrepreneur_name || !amount || !interest_rate || !disbursement_date) {
    return res.status(400).json({ error: 'Missing required fields' });
  }

  try {
    const [result] = await db.query(
      `INSERT INTO loans 
        (entrepreneur_id, entrepreneur_name, village, amount, interest_rate, disbursement_date, due_date, purpose, notes, status)
       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`,
      [
        entrepreneur_id,
        entrepreneur_name,
        village || null,
        amount,
        interest_rate,
        disbursement_date,
        due_date || null,
        purpose || null,
        notes || null,
        status || 'Processing'
      ]
    );

    res.status(201).json({ loan_id: result.insertId, message: 'Loan added' });
  } catch (err) {
    console.error('Error inserting loan:', err);
    res.status(500).json({ error: err.message });
  }
});

// Delete a loan entry
router.delete('/:loan_id', async (req, res) => {
  const loan_id = parseInt(req.params.loan_id);
  if (isNaN(loan_id)) return res.status(400).json({ error: 'Invalid loan_id' });

  try {
    const [result] = await db.query('DELETE FROM loans WHERE loan_id = ?', [loan_id]);
    if (result.affectedRows === 0) return res.status(404).json({ error: 'Loan not found' });
    res.json({ message: 'Loan deleted' });
  } catch (err) {
    console.error('Error deleting loan:', err);
    res.status(500).json({ error: err.message });
  }
});

module.exports = router;
