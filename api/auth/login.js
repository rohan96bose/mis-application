const express = require('express');
const router = express.Router();
const mysql = require('mysql2/promise');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
require('dotenv').config();

// DB connection pool
const pool = mysql.createPool({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_NAME
});

router.post('/login', async (req, res) => {
  const { username, password } = req.body || {};

  if (!username || !password) {
    return res.status(400).json({ message: 'Username and password are required.' });
  }

  try {
    const [rows] = await pool.execute('SELECT * FROM users WHERE username = ?', [username]);

    if (rows.length === 0) {
      return res.status(401).json({ message: 'Invalid credentials.' });
    }

    const user = rows[0];
    const isMatch = await bcrypt.compare(password, user.password);

    if (!isMatch) {
      return res.status(401).json({ message: 'Invalid credentials.' });
    }

    // Create JWT token
    const token = jwt.sign(
      { id: user.id, username: user.username, role: user.role },
      process.env.JWT_SECRET,
      { expiresIn: '1h' }
    );

    // Set the token in a secure HTTP-only cookie
    res.cookie('token', token, {
      httpOnly: true,
      secure: false,           // Use true in production with HTTPS
      maxAge: 3600000,         // 1 hour
      sameSite: 'Lax'
    });

    // Optional: Set session if you want both session and token
    req.session.user = {
      id: user.id,
      username: user.username,
      role: user.role
    };

    return res.status(200).json({
      message: 'Login successful',
      user: {
        id: user.id,
        username: user.username,
        role: user.role
      }
    });

  } catch (err) {
    console.error('Login Error:', err);
    return res.status(500).json({ message: 'Server error' });
  }
});

module.exports = router;
