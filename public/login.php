<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login – Mission Women Empowerment</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- AOS -->
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#4F46E5',
            secondary: '#7C3AED',
            accent: '#EC4899',
            dark: '#1F2937',
            light: '#F9FAFB'
          }
        }
      }
    }
  </script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-purple-50 min-h-screen flex items-center justify-center p-4">
  <!-- Background decoration -->
  <div class="absolute top-10 left-10 w-24 h-24 bg-primary/10 rounded-full blur-xl animate-pulse"></div>
  <div class="absolute bottom-10 right-10 w-32 h-32 bg-secondary/10 rounded-full blur-xl animate-pulse delay-1000"></div>
  
  <!-- Login Container -->
  <div class="relative w-full max-w-md">
    <!-- Login Card -->
    <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl p-8 border border-white/20" data-aos="zoom-in" data-aos-duration="800">
      <!-- Logo/Header -->
      <div class="text-center mb-8" data-aos="fade-down" data-aos-delay="200">
        <div class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
          <i class="fas fa-hands-helping text-white text-2xl"></i>
        </div>
        <h1 class="text-3xl font-bold text-gray-800">Women Empowerment</h1>
        <p class="text-gray-600 mt-2">Management Information System</p>
      </div>
      
      <form id="loginForm" class="space-y-6">
        <!-- Username Field -->
        <div data-aos="fade-right" data-aos-delay="300">
          <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
            <i class="fas fa-user mr-2 text-primary"></i> Username
          </label>
          <div class="relative">
            <input 
              type="text" 
              name="username" 
              required 
              placeholder="Enter your username"
              class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300" 
            />
            <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
          </div>
        </div>
        
        <!-- Password Field -->
        <div data-aos="fade-left" data-aos-delay="400">
          <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
            <i class="fas fa-lock mr-2 text-primary"></i> Password
          </label>
          <div class="relative">
            <input 
              type="password" 
              name="password" 
              required 
              placeholder="Enter your password"
              class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300" 
            />
            <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
          </div>
        </div>
        
        <!-- Login Button -->
        <button 
          type="submit" 
          class="w-full bg-gradient-to-r from-primary to-secondary text-white py-3.5 rounded-lg font-semibold hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50"
          data-aos="zoom-in" 
          data-aos-delay="600"
        >
          <i class="fas fa-sign-in-alt mr-2"></i> Login to Dashboard
        </button>

        <!-- Inline error message -->
        <div id="errorMsg" class="text-red-500 mt-4 text-center"></div>
      </form>
      
      
      <!-- Footer -->
      <div class="mt-8 pt-5 border-t border-gray-200" data-aos="fade-up" data-aos-delay="900">
        <p class="text-xs text-center text-gray-500">
          © 2025 Sauramandala Foundation. Empowering women through technology.
        </p>
      </div>
    </div>
  </div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    AOS.init({
      duration: 800,
      once: true,
      offset: 10
    });

    const loginForm = document.getElementById('loginForm');
    const errorMsg = document.getElementById('errorMsg');

    loginForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      const formData = new FormData(loginForm);
      const username = formData.get('username');
      const password = formData.get('password');

      try {
        const response = await fetch('http://localhost:5000/api/auth/login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          credentials: 'include', // Important to include cookies/session
          body: JSON.stringify({ username, password })
        });

        const result = await response.json();

        if (!response.ok) {
          errorMsg.textContent = result.message || 'Login failed. Please try again.';
          return;
        }

        // Optionally store token in localStorage or cookie
        localStorage.setItem('token', result.token);

        // Redirect to dashboard or another page
        window.location.href = 'index.php'; // Change as needed

      } catch (err) {
        console.error(err);
        errorMsg.textContent = 'Server error. Please try again later.';
      }
    });
  });
</script>


  </script>
</body>
</html>
