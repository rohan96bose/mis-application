<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard – Mission Women Empowerment</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <!-- AOS -->
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

  <!-- Chart.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="../js/tailwind.config.js"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
  <!-- Mobile menu button (will be shown only on mobile) -->
  <div class="lg:hidden fixed top-4 left-4 z-50">
    <button id="mobileMenuButton" class="p-2 rounded-md bg-primary text-white shadow-lg focus:outline-none">
      <i class="fas fa-bars text-xl"></i>
    </button>
  </div>

  <div class="flex flex-grow">
    <!-- Sidebar -->
    <aside id="sidebar" class="bg-white shadow-xl w-72 min-h-screen flex flex-col p-6 fixed lg:relative z-40 -translate-x-full lg:translate-x-0 transition-transform duration-300">
      <!-- Close button for mobile -->
      <button id="closeSidebar" class="lg:hidden self-end p-2 text-gray-500 hover:text-gray-700">
        <i class="fas fa-times text-xl"></i>
      </button>

      <!-- User Profile -->
      <div class="flex items-center space-x-4 mb-10 mt-4" data-aos="fade-right" data-aos-delay="100">
        <div class="relative">
          <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Anita Devi" class="w-14 h-14 rounded-full object-cover border-2 border-primary" />
          <span class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-green-500 border-2 border-white rounded-full"></span>
        </div>
<div>
  <h2 id="userName" class="font-semibold text-lg text-gray-800">Loading...</h2>
  <p id="userRole" class="text-sm text-gray-500">Loading role...</p>
  <button id="logoutButton" class="mt-1 text-sm text-red-500 hover:text-red-700 font-medium flex items-center focus:outline-none">
    <i class="fas fa-sign-out-alt mr-1"></i> Logout
  </button>
</div>

      </div>

      <!-- Navigation -->
      <nav class="flex flex-col space-y-2 mt-4">
        <a href="index.php" class="flex items-center space-x-3 text-primary font-semibold bg-blue-50 rounded-lg px-4 py-3 hover:bg-blue-100 transition-colors duration-200 group" data-aos="fade-right" data-aos-delay="150">
          <div class="w-8 text-center">
            <i class="fas fa-home text-primary"></i>
          </div>
          <span>Dashboard</span>
          <span class="ml-auto w-2 h-6 bg-primary rounded-l-lg"></span>
        </a>
        
        <a href="register.php" class="flex items-center space-x-3 text-gray-700 rounded-lg px-4 py-3 hover:bg-gray-100 transition-colors duration-200 group" data-aos="fade-right" data-aos-delay="200">
          <div class="w-8 text-center">
            <i class="fas fa-user-plus text-gray-500 group-hover:text-primary"></i>
          </div>
          <span>Register Entrepreneur</span>
        </a>
        
        <a href="mentoring.php" class="flex items-center space-x-3 text-gray-700 rounded-lg px-4 py-3 hover:bg-gray-100 transition-colors duration-200 group" data-aos="fade-right" data-aos-delay="250">
          <div class="w-8 text-center">
            <i class="fas fa-hands-helping text-gray-500 group-hover:text-primary"></i>
          </div>
          <span>Mentoring Visits</span>
        </a>
        
        <a href="loan.php" class="flex items-center space-x-3 text-gray-700 rounded-lg px-4 py-3 hover:bg-gray-100 transition-colors duration-200 group" data-aos="fade-right" data-aos-delay="300">
          <div class="w-8 text-center">
            <i class="fas fa-hand-holding-usd text-gray-500 group-hover:text-primary"></i>
          </div>
          <span>Loan Disbursements</span>
        </a>
        
        <a href="reports.php" class="flex items-center space-x-3 text-gray-700 rounded-lg px-4 py-3 hover:bg-gray-100 transition-colors duration-200 group" data-aos="fade-right" data-aos-delay="350">
          <div class="w-8 text-center">
            <i class="fas fa-chart-bar text-gray-500 group-hover:text-primary"></i>
          </div>
          <span>Reports & Data</span>
        </a>

      <!-- Bottom section -->
      <div class="mt-auto pt-8 border-t border-gray-200">
        <!-- Quick stats -->
        <div class="mb-6" data-aos="fade-up" data-aos-delay="400">
          <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Today's Overview</h3>
          <div class="grid grid-cols-2 gap-3">
            <div class="bg-blue-50 rounded-lg p-3">
              <p class="text-2xl font-bold text-primary">12</p>
              <p class="text-xs text-gray-600">New Registers</p>
            </div>
            <div class="bg-green-50 rounded-lg p-3">
              <p class="text-2xl font-bold text-green-600">7</p>
              <p class="text-xs text-gray-600">Visits Done</p>
            </div>
          </div>
        </div>
        
        <!-- Support section -->
        <div class="bg-gray-50 rounded-xl p-4" data-aos="fade-up" data-aos-delay="450">
          <h3 class="text-sm font-semibold text-gray-800 mb-2">Need Help?</h3>
          <p class="text-xs text-gray-600 mb-3">Contact our support team for assistance</p>
          <button class="w-full bg-white border border-gray-300 rounded-lg py-2 text-xs font-medium text-gray-700 hover:bg-gray-100 transition-colors duration-200 flex items-center justify-center">
            <i class="fas fa-question-circle mr-2 text-primary"></i> Get Support
          </button>
        </div>
      </div>
      </nav>

    </aside>

    <!-- Overlay for mobile -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden"></div>

  <script>
  document.getElementById('logoutButton').addEventListener('click', async () => {
    try {
      // Call your logout API endpoint
      const response = await fetch('http://localhost:5000/api/auth/logout', {
        method: 'POST',
        credentials: 'include'  // important to send cookies
      });

      if (response.ok) {
        alert('Logged out successfully!');
        // Clear token or session storage if any (example if you stored JWT)
        localStorage.removeItem('token');
        // Redirect to login page (adjust URL)
        window.location.href = 'login.php'; 
      } else {
        alert('Logout failed');
      }
    } catch (error) {
      console.error('Logout error:', error);
      alert('Logout error, check console');
    }
  });

  document.addEventListener('DOMContentLoaded', () => {
  fetch('http://localhost:5000/api/user/me', {
    method: 'GET',
    credentials: 'include'  // Needed to send session cookies
  })
  .then(res => {
    if (!res.ok) {
      // User is not logged in — redirect or handle accordingly
      window.location.href = 'login.php';
      return;
    }
    return res.json();
  })
  .then(data => {
    if (!data) return;

    // Update DOM
    document.getElementById('userName').textContent = data.username;
    document.getElementById('userRole').textContent = data.role;
  })
  .catch(err => {
    console.error('Error fetching user info:', err);
    window.location.href = 'login.php';
  });
});

</script>
