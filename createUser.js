const bcrypt = require('bcrypt');
const pool = require('./config/db');

async function createUser(username, password, role) {
  try {
    const hashedPassword = await bcrypt.hash(password, 10); // hash with salt rounds 10

    const [result] = await pool.query(
      'INSERT INTO users (username, password, role) VALUES (?, ?, ?)',
      [username, hashedPassword, role]
    );

    console.log('User inserted with ID:', result.insertId);
  } catch (error) {
    console.error('Error inserting user:', error);
  } finally {
    pool.end();
  }
}

// Replace values here
createUser('testuser', 'password123', 'program_manager');
