    // Initialize AOS
    document.addEventListener('DOMContentLoaded', function() {
      AOS.init({
        duration: 400,
        once: true,
        offset: 10
      });
      
      // Mobile sidebar toggle
      const sidebar = document.getElementById('sidebar');
      const mobileMenuButton = document.getElementById('mobileMenuButton');
      const closeSidebar = document.getElementById('closeSidebar');
      const overlay = document.getElementById('overlay');
      
      function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
      }
      
      function closeSidebarFunc() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
      }
      
      mobileMenuButton.addEventListener('click', openSidebar);
      closeSidebar.addEventListener('click', closeSidebarFunc);
      overlay.addEventListener('click', closeSidebarFunc);
      
      // Close sidebar when clicking outside on mobile
      document.addEventListener('click', function(event) {
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickOnMenuButton = mobileMenuButton.contains(event.target);
        
        if (!isClickInsideSidebar && !isClickOnMenuButton && window.innerWidth < 1024) {
          closeSidebarFunc();
        }
      });
      
      // Handle window resize
      window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
          sidebar.classList.remove('-translate-x-full');
          overlay.classList.add('hidden');
          document.body.classList.remove('overflow-hidden');
        } else {
          sidebar.classList.add('-translate-x-full');
        }
      });
    });