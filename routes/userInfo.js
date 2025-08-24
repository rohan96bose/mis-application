const express = require('express');
const router = express.Router();

router.get('/me', (req, res) => {
  if (!req.session.user) {
    return res.status(401).json({ message: 'Not authenticated' });
  }

  return res.status(200).json({
    id: req.session.user.id,
    username: req.session.user.username,
    role: req.session.user.role
  });
});

module.exports = router;
