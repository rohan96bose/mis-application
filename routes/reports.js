const express = require('express');
const router = express.Router();
const db = require('../config/db');

// Fetch all reports
router.get('/', async (req, res) => {
  try {
    const [rows] = await db.query(`
      SELECT r.*,
             e.name AS entrepreneurName,
             e.village AS entrepreneurVillage,
             e.image AS entrepreneurAvatarUrl
      FROM mentoring_reports r
      LEFT JOIN entrepreneurs e ON r.entrepreneur_id = e.id
      ORDER BY r.session_date DESC, r.session_time DESC
    `);

    res.json(rows);
  } catch (err) {
    console.error('Error in GET /reports:', err);
    res.status(500).json({ error: err.message });
  }
});

// Add a new report
router.post('/', async (req, res) => {
  const {
    entrepreneur_id,
    session_date,
    session_time,
    session_type,
    topics,
    notes
  } = req.body || {};

  if (!entrepreneur_id || !session_date || !session_time || !session_type) {
    return res.status(400).json({ error: 'Missing required fields' });
  }

  // Convert topics array to comma-separated string if necessary
  const topicsStr = Array.isArray(topics) ? topics.join(', ') : topics;

  try {
    const [result] = await db.query(
      `INSERT INTO mentoring_reports 
        (entrepreneur_id, session_date, session_time, session_type, topics, notes) 
        VALUES (?, ?, ?, ?, ?, ?)`,
      [entrepreneur_id, session_date, session_time, session_type, topicsStr, notes]
    );

    res.status(201).json({ id: result.insertId, message: 'Report added' });
  } catch (err) {
    console.error('Error in POST /reports:', err);
    res.status(500).json({ error: err.message });
  }
});

// Delete a report by ID
router.delete('/:id', async (req, res) => {
  const id = parseInt(req.params.id, 10);
  if (isNaN(id)) {
    return res.status(400).json({ error: 'Invalid report id' });
  }

  try {
    const [result] = await db.query('DELETE FROM mentoring_reports WHERE id = ?', [id]);

    if (result.affectedRows === 0) {
      return res.status(404).json({ error: 'Report not found' });
    }

    res.json({ message: 'Report deleted' });
  } catch (err) {
    console.error('Error in DELETE /reports/:id:', err);
    res.status(500).json({ error: err.message });
  }
});

module.exports = router;
