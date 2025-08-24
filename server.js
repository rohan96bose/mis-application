const express = require('express');
const session = require('express-session');
const cors = require('cors');
require('dotenv').config();

// ROUTES IMPORT
const authRoutes = require('./api/auth/login');         
const logoutRoutes = require('./api/auth/logout');     
const entrepreneurRoutes = require('./routes/entrepreneurs');
const userInfoRoutes = require('./routes/userInfo');
const reportsRouter = require('./routes/reports');
const loanRoutes = require('./routes/loans');
const projectReportRoutes = require('./routes/projectreport');
const dashboardRouter = require('./routes/dashboard');



const app = express(); 

// CORS
app.use(cors({
  origin: 'http://localhost', 
  credentials: true
}));

// Body Parser
app.use(express.json()); 

// Sessions
app.use(session({
  secret: process.env.SESSION_SECRET || 'your_session_secret',
  resave: false,
  saveUninitialized: false,
  cookie: {
    secure: false,
    httpOnly: true,
    maxAge: 3600000
  }
}));

// ROUTES
app.use('/api/auth', authRoutes);
app.use('/api/auth', logoutRoutes);
app.use('/api/user', userInfoRoutes);
app.use('/api/dashboard', dashboardRouter);
app.use('/api/entrepreneurs', entrepreneurRoutes);
app.use('/api/reports', reportsRouter);
app.use('/api/loans', loanRoutes);
app.use('/api/projectreport', projectReportRoutes);


app.use('/uploads', express.static('uploads'));

// Start server
const PORT = process.env.PORT || 5000;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));
