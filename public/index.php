<?php include '../include/sidebar.php'; ?>

    <!-- Main Content -->
    <main class="flex-grow p-4 lg:p-8 overflow-auto lg:ml-0">
      <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-6 lg:mb-8" data-aos="fade-up">
          <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Dashboard Overview</h1>
          <p class="text-gray-600 mt-2">Welcome back, Anita! Here's what's happening with the women empowerment program today.</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-8">
          <!-- Total Entrepreneurs Card -->
          <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-blue-500" data-aos="fade-up" data-aos-delay="100">
            <div class="flex justify-between items-start">
              <div>
                <p class="text-sm font-medium text-gray-600">Total Entrepreneurs</p>
                <h3 class="text-2xl lg:text-3xl font-bold text-gray-800 mt-1" id="totalEntrepreneurs">0</h3>
              </div>
              <div class="bg-blue-100 p-3 rounded-lg">
                <i class="fas fa-users text-blue-600 text-lg"></i>
              </div>
            </div>
            <p class="text-xs text-green-600 mt-3 flex items-center">
              <i class="fas fa-arrow-up mr-1"></i> 12% from last month
            </p>
          </div>

          <!-- Active Villages Card -->
          <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-green-500" data-aos="fade-up" data-aos-delay="150">
            <div class="flex justify-between items-start">
              <div>
                <p class="text-sm font-medium text-gray-600">Active Villages</p>
                <h3 class="text-2xl lg:text-3xl font-bold text-gray-800 mt-1" id="activeVillages">0</h3>
              </div>
              <div class="bg-green-100 p-3 rounded-lg">
                <i class="fas fa-map-marker-alt text-green-600 text-lg"></i>
              </div>
            </div>
            <p class="text-xs text-gray-600 mt-3 flex items-center">
              <i class="fas fa-info-circle mr-1"></i> Across 2 districts
            </p>
          </div>

          <!-- Mentoring Sessions Card -->
          <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-yellow-500" data-aos="fade-up" data-aos-delay="200">
            <div class="flex justify-between items-start">
              <div>
                <p class="text-sm font-medium text-gray-600">Mentoring Sessions</p>
                <h3 class="text-2xl lg:text-3xl font-bold text-gray-800 mt-1" id="totalMentoring">0</h3>
              </div>
              <div class="bg-yellow-100 p-3 rounded-lg">
                <i class="fas fa-handshake text-yellow-600 text-lg"></i>
              </div>
            </div>
            <p class="text-xs text-green-600 mt-3 flex items-center">
              <i class="fas fa-check-circle mr-1"></i> <span id="completedToday">0</span> completed today
            </p>
          </div>

          <!-- Total Loans Card -->
          <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-pink-500" data-aos="fade-up" data-aos-delay="250">
            <div class="flex justify-between items-start">
              <div>
                <p class="text-sm font-medium text-gray-600">Total Loans Disbursed</p>
                <h3 class="text-2xl lg:text-3xl font-bold text-gray-800 mt-1" id="totalLoans">₹0</h3>
              </div>
              <div class="bg-pink-100 p-3 rounded-lg">
                <i class="fas fa-rupee-sign text-pink-600 text-lg"></i>
              </div>
            </div>
            <p class="text-xs text-green-600 mt-3 flex items-center">
              <i class="fas fa-arrow-up mr-1"></i> <span id="loanRecoveryRateText">0%</span> recovery rate
            </p>
          </div>
        </div>

        <!-- Secondary Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6 mb-8">
          <!-- Avg Loan Amount -->
          <div class="bg-white rounded-xl shadow-sm p-5" data-aos="fade-up" data-aos-delay="300">
            <div class="flex justify-between items-center">
              <div>
                <p class="text-sm font-medium text-gray-600">Avg Loan Amount</p>
                <h3 class="text-xl lg:text-2xl font-bold text-purple-600 mt-1" id="avgLoanAmount">₹0</h3>
              </div>
              <div class="bg-purple-100 p-2 rounded-lg">
                <i class="fas fa-coins text-purple-600"></i>
              </div>
            </div>
          </div>

          <!-- Women Trained -->
          <div class="bg-white rounded-xl shadow-sm p-5" data-aos="fade-up" data-aos-delay="350">
            <div class="flex justify-between items-center">
              <div>
                <p class="text-sm font-medium text-gray-600">Women Trained</p>
                <h3 class="text-xl lg:text-2xl font-bold text-indigo-600 mt-1" id="womenTrainedCount">0</h3>
              </div>
              <div class="bg-indigo-100 p-2 rounded-lg">
                <i class="fas fa-graduation-cap text-indigo-600"></i>
              </div>
            </div>
          </div>

          <!-- Loan Recovery Rate -->
          <div class="bg-white rounded-xl shadow-sm p-5" data-aos="fade-up" data-aos-delay="400">
            <div class="flex justify-between items-center">
              <div>
                <p class="text-sm font-medium text-gray-600">Loan Recovery Rate</p>
                <h3 class="text-xl lg:text-2xl font-bold text-teal-600 mt-1" id="loanRecoveryRatePercent">0%</h3>
              </div>
              <div class="bg-teal-100 p-2 rounded-lg">
                <i class="fas fa-chart-line text-teal-600"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
          <!-- Entrepreneurs by Village -->
          <div class="bg-white rounded-xl shadow-sm p-6" data-aos="fade-up" data-aos-delay="100">
            <div class="flex justify-between items-center mb-5">
              <h3 class="text-lg font-semibold text-gray-800">Entrepreneurs by Village</h3>
              <button class="text-xs text-primary bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg">
                View All
              </button>
            </div>
            <canvas id="barChart" class="w-full" style="height: 250px;"></canvas>
          </div>

          <!-- Mentoring Sessions Over Time -->
          <div class="bg-white rounded-xl shadow-sm p-6" data-aos="fade-up" data-aos-delay="150">
            <div class="flex justify-between items-center mb-5">
              <h3 class="text-lg font-semibold text-gray-800">Mentoring Sessions Over Time</h3>
              <div class="flex space-x-2">
                <button class="text-xs bg-gray-100 hover:bg-gray-200 px-2 py-1 rounded">
                  Monthly
                </button>
                <button class="text-xs text-primary bg-blue-50 hover:bg-blue-100 px-2 py-1 rounded">
                  Quarterly
                </button>
              </div>
            </div>
            <canvas id="lineChart" class="w-full" style="height: 250px;"></canvas>
          </div>

          <!-- Loan Disbursement by Product -->
          <div class="bg-white rounded-xl shadow-sm p-6" data-aos="fade-up" data-aos-delay="200">
            <div class="flex justify-between items-center mb-5">
              <h3 class="text-lg font-semibold text-gray-800">Loan Disbursement by Product</h3>
              <button class="text-xs text-primary bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg">
                Export
              </button>
            </div>
            <canvas id="pieChart" class="w-full" style="height: 250px;"></canvas>
          </div>

          <!-- Loans Disbursed Over Time -->
          <div class="bg-white rounded-xl shadow-sm p-6" data-aos="fade-up" data-aos-delay="250">
            <div class="flex justify-between items-center mb-5">
              <h3 class="text-lg font-semibold text-gray-800">Loans Disbursed Over Time</h3>
              <button class="text-xs text-primary bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-lg">
                View Report
              </button>
            </div>
            <canvas id="loansLineChart" class="w-full" style="height: 250px;"></canvas>
          </div>
        </div>

        <!-- Additional Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
          <!-- Mentoring Sessions by Village -->
          <div class="bg-white rounded-xl shadow-sm p-6" data-aos="fade-up" data-aos-delay="300">
            <h3 class="text-lg font-semibold text-gray-800 mb-5">Mentoring Sessions by Village</h3>
            <canvas id="mentoringBarChart" class="w-full" style="height: 250px;"></canvas>
          </div>

          <!-- Women Trained vs Entrepreneurs -->
          <div class="bg-white rounded-xl shadow-sm p-6" data-aos="fade-up" data-aos-delay="350">
            <h3 class="text-lg font-semibold text-gray-800 mb-5">Women Trained vs Entrepreneurs</h3>
            <canvas id="womenDoughnutChart" class="w-full" style="height: 250px;"></canvas>
          </div>
        </div>

        <!-- Bottom Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <!-- Loan Recovery Rate -->
          <div class="bg-white rounded-xl shadow-sm p-6" data-aos="fade-up" data-aos-delay="400">
            <h3 class="text-lg font-semibold text-gray-800 mb-5">Loan Recovery Rate</h3>
            <canvas id="recoveryRateChart" class="w-full" style="height: 250px;"></canvas>
          </div>

          <!-- Entrepreneur Growth Rate -->
          <div class="bg-white rounded-xl shadow-sm p-6" data-aos="fade-up" data-aos-delay="450">
            <h3 class="text-lg font-semibold text-gray-800 mb-5">Entrepreneur Growth Rate</h3>
            <canvas id="growthRateChart" class="w-full" style="height: 250px;"></canvas>
          </div>
        </div>
      </div>
    </main>
  </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const API_BASE = 'http://localhost:5000/api'; 
  
  async function fetchDashboardData() {
    try {
      const res = await fetch(`${API_BASE}/dashboard`);
      if (!res.ok) throw new Error('Failed to fetch dashboard data');
      const data = await res.json();

      // Update Cards
      document.getElementById('totalEntrepreneurs').textContent = data.totalEntrepreneurs;
      document.getElementById('activeVillages').textContent = data.activeVillages;
      document.getElementById('totalMentoring').textContent = data.totalMentoring;
      document.getElementById('completedToday').textContent = data.completedToday;
      document.getElementById('totalLoans').textContent = '₹' + formatAmount(data.totalLoans);
      document.getElementById('loanRecoveryRateText').textContent = data.loanRecoveryRate + '%';
      document.getElementById('avgLoanAmount').textContent = '₹' + formatAmount(data.avgLoanAmount);
      document.getElementById('womenTrainedCount').textContent = data.womenTrainedCount;
      document.getElementById('loanRecoveryRatePercent').textContent = data.loanRecoveryRate + '%';

      // Initialize Charts with fetched data
      initCharts(data);
    } catch (err) {
      console.error(err);
      alert('Error loading dashboard data.');
    }
  }

  function formatAmount(num) {
    if (num >= 100000) {
      return (num / 100000).toFixed(1) + 'L'; // Convert to Lakhs (Indian notation)
    } else if (num >= 1000) {
      return (num / 1000).toFixed(1) + 'K'; // Thousands
    }
    return num;
  }

  function initCharts(data) {
    // Entrepreneurs by Village (barChart)
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
      type: 'bar',
      data: {
        labels: data.villagesLabels,
        datasets: [{
          label: 'Entrepreneurs',
          data: data.villagesData,
          backgroundColor: '#3B82F6'
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false }},
        scales: { y: { beginAtZero: true, ticks: { stepSize: 10 }}}
      }
    });

    // Mentoring Sessions Over Time (lineChart)
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(lineCtx, {
      type: 'line',
      data: {
        labels: data.mentoringLabels,
        datasets: [{
          label: 'Mentoring Sessions',
          data: data.mentoringData,
          fill: false,
          borderColor: '#F59E0B',
          tension: 0.3
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: true }},
        scales: { y: { beginAtZero: true }}
      }
    });

    // Loan Disbursement by Product (pie chart)
    const pieCtx = document.getElementById('pieChart');
    if(pieCtx) {
      new Chart(pieCtx.getContext('2d'), {
        type: 'pie',
        data: {
          labels: data.loanProductLabels,
          datasets: [{
            data: data.loanProductData,
            backgroundColor: ['#EF4444', '#3B82F6', '#10B981', '#F59E0B', '#8B5CF6']
          }]
        },
        options: {
          responsive: true,
          plugins: { legend: { position: 'bottom' }}
        }
      });
    }

    // Loans Disbursed Over Time (loansLineChart)
    const loansLineCtx = document.getElementById('loansLineChart').getContext('2d');
    new Chart(loansLineCtx, {
      type: 'line',
      data: {
        labels: data.loansLabels,
        datasets: [{
          label: 'Loans Disbursed (₹)',
          data: data.loansData,
          borderColor: '#EC4899',
          backgroundColor: 'rgba(236, 72, 153, 0.1)',
          fill: true,
          tension: 0.3
        }]
      },
      options: {
        responsive: true,
        scales: { y: { beginAtZero: true }}
      }
    });

    // Mentoring Sessions by Village (mentoringBarChart)
    const mentoringBarCtx = document.getElementById('mentoringBarChart').getContext('2d');
    new Chart(mentoringBarCtx, {
      type: 'bar',
      data: {
        labels: data.villagesLabels,
        datasets: [{
          label: 'Mentoring Sessions',
          data: data.villagesData.map(x => Math.floor(x * 0.4)),
          backgroundColor: '#2563EB'
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        scales: { x: { beginAtZero: true }},
        plugins: { legend: { display: false }}
      }
    });

    // Women Trained vs Remaining Entrepreneurs (womenDoughnutChart)
    const womenDoughnutCtx = document.getElementById('womenDoughnutChart').getContext('2d');
    new Chart(womenDoughnutCtx, {
      type: 'doughnut',
      data: {
        labels: ['Women Trained', 'Remaining Entrepreneurs'],
        datasets: [{
          data: [data.womenTrainedCount, data.remainingEntrepreneurs],
          backgroundColor: ['#6366F1', '#D1D5DB']
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' }}
      }
    });

    // Loan Recovery Rate (recoveryRateChart)
    const recoveryRateCtx = document.getElementById('recoveryRateChart').getContext('2d');
    new Chart(recoveryRateCtx, {
      type: 'doughnut',
      data: {
        labels: ['Recovered', 'Pending'],
        datasets: [{
          data: [parseFloat(data.loanRecoveryRate), 100 - parseFloat(data.loanRecoveryRate)],
          backgroundColor: ['#10B981', '#EF4444']
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' }}
      }
    });

    // Entrepreneur Growth Rate (growthRateChart)
    const growthRateCtx = document.getElementById('growthRateChart').getContext('2d');
    new Chart(growthRateCtx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
          label: 'Growth Rate (%)',
          data: [5, 7, 10, 12, 15, 18],
          borderColor: '#22D3EE',
          backgroundColor: 'rgba(34, 211, 238, 0.1)',
          fill: true,
          tension: 0.3
        }]
      },
      options: {
        responsive: true,
        scales: { y: { beginAtZero: true }}
      }
    });
  }

  // Fetch data and initialize on page load
  window.addEventListener('DOMContentLoaded', fetchDashboardData);
</script>

<?php include '../include/footer.php'; ?>