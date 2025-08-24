const express = require('express');
const router = express.Router();

router.post('/logout', (req, res) => {
  // Destroy the session
  req.session.destroy(err => {
    if (err) {
      console.error('Logout error:', err);
      return res.status(500).json({ message: 'Logout failed' });
    }

    // Clear the cookie on client side
    res.clearCookie('connect.sid'); // default cookie name unless configured otherwise

    return res.status(200).json({ message: 'Logout successful' });
  });
});

module.exports = router;
