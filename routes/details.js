const express = require('express');
const router = express.Router();
const db = require('../config/db'); // Assuming you have a database connection

// Dashboard Overview Data
router.get('/dashboard-overview', async (req, res) => {
  try {
    // Get total entrepreneurs
    const [[entrepreneursResult]] = await db.query(`
      SELECT COUNT(*) as total FROM entrepreneurs
    `);
    
    // Get active villages
    const [[villagesResult]] = await db.query(`
      SELECT COUNT(DISTINCT village) as total FROM entrepreneurs
    `);
    
    // Get mentoring sessions
    const [[mentoringResult]] = await db.query(`
      SELECT COUNT(*) as total FROM mentoring_reports
    `);
    
    // Get today's mentoring sessions
    const [[todayMentoringResult]] = await db.query(`
      SELECT COUNT(*) as total FROM mentoring_reports 
      WHERE DATE(session_date) = CURDATE()
    `);
    
    // Get total loans disbursed
    const [[loansResult]] = await db.query(`
      SELECT SUM(amount) as total FROM loans WHERE status = 'Active'
    `);
    
    // Get recovery rate
    const [[recoveryResult]] = await db.query(`
      SELECT 
        (SELECT COUNT(*) FROM loans WHERE status = 'Completed') / 
        (SELECT COUNT(*) FROM loans WHERE status IN ('Active', 'Completed')) * 100 as recovery_rate
    `);
    
    // Get average loan amount
    const [[avgLoanResult]] = await db.query(`
      SELECT AVG(amount) as avg_amount FROM loans WHERE status = 'Active'
    `);
    
    // Get women trained
    const [[trainedResult]] = await db.query(`
      SELECT COUNT(DISTINCT entrepreneur_id) as total FROM mentoring_reports
    `);
    
    res.json({
      total_entrepreneurs: entrepreneursResult.total,
      active_villages: villagesResult.total,
      mentoring_sessions: mentoringResult.total,
      today_mentoring: todayMentoringResult.total,
      total_loans: loansResult.total || 0,
      recovery_rate: recoveryResult.recovery_rate || 0,
      avg_loan_amount: avgLoanResult.avg_amount || 0,
      women_trained: trainedResult.total
    });
  } catch (error) {
    console.error('Error fetching dashboard overview:', error);
    res.status(500).json({ error: 'Internal server error' });
  }
});

// Entrepreneurs by Village
router.get('/entrepreneurs-by-village', async (req, res) => {
  try {
    const [results] = await db.query(`
      SELECT village, COUNT(*) as count 
      FROM entrepreneurs 
      GROUP BY village 
      ORDER BY count DESC
    `);
    
    res.json(results);
  } catch (error) {
    console.error('Error fetching entrepreneurs by village:', error);
    res.status(500).json({ error: 'Internal server error' });
  }
});

// Mentoring Sessions Over Time
router.get('/mentoring-sessions-over-time', async (req, res) => {
  try {
    const period = req.query.period || 'monthly'; // monthly or quarterly
    
    let query;
    if (period === 'quarterly') {
      query = `
        SELECT 
          CONCAT(YEAR(session_date), '-Q', QUARTER(session_date)) as period,
          COUNT(*) as sessions
        FROM mentoring_reports
        WHERE session_date >= DATE_SUB(NOW(), INTERVAL 1 YEAR)
        GROUP BY YEAR(session_date), QUARTER(session_date)
        ORDER BY YEAR(session_date), QUARTER(session_date)
      `;
    } else {
      query = `
        SELECT 
          DATE_FORMAT(session_date, '%Y-%m') as period,
          COUNT(*) as sessions
        FROM mentoring_reports
        WHERE session_date >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
        GROUP BY YEAR(session_date), MONTH(session_date)
        ORDER BY YEAR(session_date), MONTH(session_date)
      `;
    }
    
    const [results] = await db.query(query);
    res.json(results);
  } catch (error) {
    console.error('Error fetching mentoring sessions over time:', error);
    res.status(500).json({ error: 'Internal server error' });
  }
});

// Loan Disbursement by Product
router.get('/loans-by-product', async (req, res) => {
  try {
    const [results] = await db.query(`
      SELECT e.product_type, SUM(l.amount) as total_amount
      FROM loans l
      JOIN entrepreneurs e ON l.entrepreneur_id = e.id
      WHERE l.status = 'Active'
      GROUP BY e.product_type
      ORDER BY total_amount DESC
    `);
    
    res.json(results);
  } catch (error) {
    console.error('Error fetching loans by product:', error);
    res.status(500).json({ error: 'Internal server error' });
  }
});

// Loans Disbursed Over Time
router.get('/loans-over-time', async (req, res) => {
  try {
    const [results] = await db.query(`
      SELECT 
        DATE_FORMAT(disbursement_date, '%Y-%m') as period,
        SUM(amount) as total_amount
      FROM loans
      WHERE disbursement_date >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
      GROUP BY YEAR(disbursement_date), MONTH(disbursement_date)
      ORDER BY YEAR(disbursement_date), MONTH(disbursement_date)
    `);
    
    res.json(results);
  } catch (error) {
    console.error('Error fetching loans over time:', error);
    res.status(500).json({ error: 'Internal server error' });
  }
});

// Mentoring Sessions by Village
router.get('/mentoring-by-village', async (req, res) => {
  try {
    const [results] = await db.query(`
      SELECT e.village, COUNT(mr.id) as sessions
      FROM mentoring_reports mr
      JOIN entrepreneurs e ON mr.entrepreneur_id = e.id
      GROUP BY e.village
      ORDER BY sessions DESC
    `);
    
    res.json(results);
  } catch (error) {
    console.error('Error fetching mentoring by village:', error);
    res.status(500).json({ error: 'Internal server error' });
  }
});

// Women Trained vs Entrepreneurs
router.get('/trained-vs-entrepreneurs', async (req, res) => {
  try {
    const [[trainedResult]] = await db.query(`
      SELECT COUNT(DISTINCT entrepreneur_id) as trained FROM mentoring_reports
    `);
    
    const [[totalResult]] = await db.query(`
      SELECT COUNT(*) as total FROM entrepreneurs
    `);
    
    res.json({
      trained: trainedResult.trained,
      total: totalResult.total,
      remaining: totalResult.total - trainedResult.trained
    });
  } catch (error) {
    console.error('Error fetching trained vs entrepreneurs:', error);
    res.status(500).json({ error: 'Internal server error' });
  }
});

// Loan Recovery Rate
router.get('/recovery-rate', async (req, res) => {
  try {
    const [[recoveryResult]] = await db.query(`
      SELECT 
        (SELECT COUNT(*) FROM loans WHERE status = 'Completed') as recovered,
        (SELECT COUNT(*) FROM loans WHERE status = 'Active') as pending
    `);
    
    const total = recoveryResult.recovered + recoveryResult.pending;
    const rate = total > 0 ? (recoveryResult.recovered / total) * 100 : 0;
    
    res.json({
      recovered: recoveryResult.recovered,
      pending: recoveryResult.pending,
      rate: rate.toFixed(2)
    });
  } catch (error) {
    console.error('Error fetching recovery rate:', error);
    res.status(500).json({ error: 'Internal server error' });
  }
});

// Entrepreneur Growth Rate
router.get('/growth-rate', async (req, res) => {
  try {
    const [results] = await db.query(`
      SELECT 
        DATE_FORMAT(created_at, '%Y-%m') as period,
        COUNT(*) as new_entrepreneurs,
        (COUNT(*) / (SELECT COUNT(*) FROM entrepreneurs WHERE created_at < MIN(e.created_at)) * 100) as growth_rate
      FROM entrepreneurs e
      WHERE created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
      GROUP BY YEAR(created_at), MONTH(created_at)
      ORDER BY YEAR(created_at), MONTH(created_at)
    `);
    
    res.json(results);
  } catch (error) {
    console.error('Error fetching growth rate:', error);
    res.status(500).json({ error: 'Internal server error' });
  }
});

module.exports = router;