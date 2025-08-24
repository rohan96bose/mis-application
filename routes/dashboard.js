const express = require('express');
const router = express.Router();
const pool = require('../config/db');

// Helper function to run a query and return the first row or default
async function querySingle(sql, params = []) {
  const [rows] = await pool.query(sql, params);
  return rows[0] || {};
}

router.get('/', async (req, res) => {
  try {
    // Total Entrepreneurs
    const { total: totalEntrepreneurs = 0 } = await querySingle(
      "SELECT COUNT(*) AS total FROM entrepreneurs"
    );

    // Active Villages
    const { total: activeVillages = 0 } = await querySingle(
      "SELECT COUNT(DISTINCT village) AS total FROM entrepreneurs"
    );

    // Mentoring Sessions
    const mentoringSessions = await querySingle(`
      SELECT 
        COUNT(*) AS total, 
        SUM(CASE WHEN session_date = CURDATE() THEN 1 ELSE 0 END) AS completed_today 
      FROM mentoring_reports
    `);

    // Total Loans Disbursed (sum)
    const { total_amount: totalLoans = 0 } = await querySingle(
      "SELECT SUM(amount) AS total_amount FROM loans WHERE status IN ('Active', 'Processing', 'Completed')"
    );

    // Average Loan Amount
    const { avg_amount: avgLoanAmount = 0 } = await querySingle(
      "SELECT AVG(amount) AS avg_amount FROM loans WHERE status IN ('Active', 'Processing', 'Completed')"
    );

    // Loan Recovery Rate
    const loanData = await querySingle(`
      SELECT 
        COUNT(*) AS total_loans,
        SUM(CASE WHEN status = 'Completed' THEN 1 ELSE 0 END) AS recovered_loans
      FROM loans
    `);
    const totalLoansCount = loanData.total_loans || 0;
    const recoveredLoans = loanData.recovered_loans || 0;
    const loanRecoveryRate = totalLoansCount > 0 ? ((recoveredLoans / totalLoansCount) * 100).toFixed(2) : '0';

    // Entrepreneurs by Village (top 10)
    const [villagesRows] = await pool.query(`
      SELECT village, COUNT(*) AS count 
      FROM entrepreneurs 
      GROUP BY village 
      ORDER BY count DESC 
      LIMIT 10
    `);

    const villagesLabels = villagesRows.map(r => r.village);
    const villagesData = villagesRows.map(r => r.count);

    // Mentoring Sessions Over Last 6 Months
    const mentoringLabels = [];
    const mentoringData = [];
    for(let i = 5; i >= 0; i--) {
      const month = new Date();
      month.setMonth(month.getMonth() - i);
      const monthStr = month.toISOString().slice(0,7); // YYYY-MM
      mentoringLabels.push(month.toLocaleString('default', { month: 'short' }));

      const [[{count = 0}]] = await pool.query(
        "SELECT COUNT(*) AS count FROM mentoring_reports WHERE DATE_FORMAT(session_date, '%Y-%m') = ?",
        [monthStr]
      );
      mentoringData.push(count);
    }

    // Loan Disbursement by Product
    const [loanProductRows] = await pool.query(`
      SELECT product_type, SUM(amount) AS total_amount 
      FROM entrepreneurs 
      JOIN loans ON entrepreneurs.id = loans.entrepreneur_id 
      GROUP BY product_type 
      ORDER BY total_amount DESC
    `);
    const loanProductLabels = loanProductRows.map(r => r.product_type);
    const loanProductData = loanProductRows.map(r => parseFloat(r.total_amount));

    // Loans Disbursed Over Time (last 6 months)
    const loansLabels = [];
    const loansData = [];
    for(let i = 5; i >= 0; i--) {
      const month = new Date();
      month.setMonth(month.getMonth() - i);
      const monthStr = month.toISOString().slice(0,7);
      loansLabels.push(month.toLocaleString('default', { month: 'short' }));

      const [[{total = 0}]] = await pool.query(
        "SELECT IFNULL(SUM(amount), 0) AS total FROM loans WHERE DATE_FORMAT(disbursement_date, '%Y-%m') = ?",
        [monthStr]
      );
      loansData.push(parseFloat(total));
    }

    // Women Trained (for demo, totalEntrepreneurs - 50)
    const womenTrainedCount = totalEntrepreneurs - 50;

    // Remaining Entrepreneurs
    const remainingEntrepreneurs = Math.max(0, totalEntrepreneurs - womenTrainedCount);

    // Send JSON response
    res.json({
      totalEntrepreneurs,
      activeVillages,
      totalMentoring: mentoringSessions.total || 0,
      completedToday: mentoringSessions.completed_today || 0,
      totalLoans,
      avgLoanAmount,
      loanRecoveryRate,
      villagesLabels,
      villagesData,
      mentoringLabels,
      mentoringData,
      loanProductLabels,
      loanProductData,
      loansLabels,
      loansData,
      womenTrainedCount,
      remainingEntrepreneurs,
    });

  } catch (err) {
    console.error(err);
    res.status(500).json({ error: 'Server error fetching dashboard data' });
  }
});

module.exports = router;
