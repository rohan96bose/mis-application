const express = require('express');
const router = express.Router();
const pool = require('../config/db');

router.get('/', async (req, res) => {
  try {
    const { fromDate, toDate, village } = req.query;

    // Validate required params
    if (!fromDate || !toDate) {
      return res.status(400).json({ error: 'fromDate and toDate are required' });
    }

    const villageFilter = village ? 'AND e.village = ?' : '';
const villageFilterWithJoin = village ? 'AND e.village = ?' : '';

// Summary Query
const [summaryRows] = await pool.query(
  `
  SELECT 
    (SELECT COUNT(DISTINCT e.id) 
     FROM entrepreneurs e 
     WHERE e.created_at BETWEEN ? AND ? ${villageFilter}
    ) AS totalEntrepreneurs,

    (SELECT COUNT(*) 
     FROM mentoring_reports m
     JOIN entrepreneurs e ON m.entrepreneur_id = e.id
     WHERE m.session_date BETWEEN ? AND ? ${villageFilterWithJoin}
    ) AS totalMentoringSessions,

    (SELECT COUNT(*) 
     FROM loans l
     WHERE l.disbursement_date BETWEEN ? AND ? ${village ? 'AND l.village = ?' : ''}
    ) AS totalLoans
  `,
  village
    ? [fromDate, toDate, village, fromDate, toDate, village, fromDate, toDate, village]
    : [fromDate, toDate, fromDate, toDate, fromDate, toDate]
);
    const summary = summaryRows[0];

    // Detailed Entrepreneurs Query
    const [details] = await pool.query(
      `
      SELECT 
        e.id,
        e.name,
        e.village,
        e.image,
        e.product_type,
        COUNT(DISTINCT m.id) AS mentoring_sessions,
        COUNT(DISTINCT l.loan_id) AS loan_count,
        IFNULL(SUM(l.amount), 0) AS total_loan_amount
      FROM entrepreneurs e
      LEFT JOIN mentoring_reports m 
        ON m.entrepreneur_id = e.id AND m.session_date BETWEEN ? AND ?
      LEFT JOIN loans l 
        ON l.entrepreneur_id = e.id AND l.disbursement_date BETWEEN ? AND ?
      WHERE e.created_at BETWEEN ? AND ?
      ${village ? 'AND e.village = ?' : ''}
      GROUP BY e.id
      ORDER BY e.name ASC
      LIMIT 100
      `,
      village
        ? [fromDate, toDate, fromDate, toDate, fromDate, toDate, village]
        : [fromDate, toDate, fromDate, toDate, fromDate, toDate]
    );

    // Respond with summary + details
    res.json({
      summary,
      entrepreneurs: details
    });
  } catch (error) {
    console.error('Project report error:', error);
    res.status(500).json({ error: 'Server error' });
  }
});

module.exports = router;
