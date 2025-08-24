<?php include '../include/sidebar.php'; ?>

    <!-- Main Content -->
    <main class="flex-grow p-4 lg:p-8 overflow-auto lg:ml-0">
    <div class="max-w-7xl mx-auto bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up">

      <!-- Header -->
      <div class="text-center mb-8" data-aos="fade-down" data-aos-delay="100">
        <h2 class="text-3xl font-bold text-gray-800">Project Reports</h2>
        <p class="text-gray-600 mt-2">Comprehensive overview of women entrepreneurship program</p>
      </div>

      <!-- Filters -->
      <div class="bg-gray-50 p-5 rounded-xl mb-8" data-aos="fade-up" data-aos-delay="150">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
          <i class="fas fa-filter mr-2 text-primary"></i> Filter Reports
        </h3>
        <form id="filterForm" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
          <div>
            <label for="fromDate" class="block mb-2 font-medium text-gray-700">From Date</label>
            <div class="relative">
              <input type="date" id="fromDate" name="fromDate" 
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required/>
              <i class="fas fa-calendar-day absolute right-3 top-3 text-gray-400"></i>
            </div>
          </div>

          <div>
            <label for="toDate" class="block mb-2 font-medium text-gray-700">To Date</label>
            <div class="relative">
              <input type="date" id="toDate" name="toDate" 
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" required/>
              <i class="fas fa-calendar-day absolute right-3 top-3 text-gray-400"></i>
            </div>
          </div>

          <div class="md:col-span-2">
            <label for="villageFilter" class="block mb-2 font-medium text-gray-700">Village</label>
            <div class="relative">
              <select id="villageFilter" name="village" 
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                <option value="">All Villages</option>
                <!-- Village options will be populated dynamically -->
              </select>
              <i class="fas fa-map-marker-alt absolute right-3 top-3 text-gray-400"></i>
            </div>
          </div>

          <div>
            <button type="submit" 
              class="w-full bg-primary text-white py-2.5 rounded-lg hover:bg-secondary transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center">
              <i class="fas fa-search mr-2"></i> Apply
            </button>
          </div>
        </form>
      </div>

      <!-- Summary Stats -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-r from-blue-500 to-primary text-white p-5 rounded-xl shadow-md" data-aos="fade-up" data-aos-delay="200">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-4xl font-bold" id="totalEntrepreneurs">0</p>
              <p class="font-semibold mt-2">Total Entrepreneurs</p>
            </div>
            <div class="bg-white/20 p-3 rounded-lg">
              <i class="fas fa-users text-2xl"></i>
            </div>
          </div>
          <p class="text-sm opacity-90 mt-3 flex items-center">
            <i class="fas fa-info-circle mr-1"></i> <span id="entrepreneursInfo">No data available</span>
          </p>
        </div>

        <div class="bg-gradient-to-r from-green-500 to-success text-white p-5 rounded-xl shadow-md" data-aos="fade-up" data-aos-delay="250">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-4xl font-bold" id="totalMentoring">0</p>
              <p class="font-semibold mt-2">Mentoring Sessions</p>
            </div>
            <div class="bg-white/20 p-3 rounded-lg">
              <i class="fas fa-handshake text-2xl"></i>
            </div>
          </div>
          <p class="text-sm opacity-90 mt-3 flex items-center">
            <i class="fas fa-info-circle mr-1"></i> <span id="mentoringInfo">No data available</span>
          </p>
        </div>

        <div class="bg-gradient-to-r from-amber-500 to-warning text-white p-5 rounded-xl shadow-md" data-aos="fade-up" data-aos-delay="300">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-4xl font-bold" id="totalLoans">0</p>
              <p class="font-semibold mt-2">Loans Disbursed</p>
            </div>
            <div class="bg-white/20 p-3 rounded-lg">
              <i class="fas fa-rupee-sign text-2xl"></i>
            </div>
          </div>
          <p class="text-sm opacity-90 mt-3 flex items-center">
            <i class="fas fa-info-circle mr-1"></i> <span id="loansInfo">No data available</span>
          </p>
        </div>
      </div>

      <!-- Loading Indicator -->
      <div id="loadingIndicator" class="hidden text-center py-8">
        <div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-primary transition ease-in-out duration-150">
          <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          Loading data...
        </div>
      </div>

      <!-- Data Table -->
      <div class="bg-white rounded-xl shadow-sm overflow-hidden" data-aos="fade-up" data-aos-delay="350">
        <div class="overflow-x-auto">
          <table class="min-w-full">
            <thead class="bg-gray-100">
              <tr>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                  <div class="flex items-center">
                    <i class="fas fa-id-card mr-2 text-primary"></i> Entrepreneur ID
                  </div>
                </th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                  <div class="flex items-center">
                    <i class="fas fa-user mr-2 text-primary"></i> Name
                  </div>
                </th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                  <div class="flex items-center">
                    <i class="fas fa-map-marker-alt mr-2 text-primary"></i> Village
                  </div>
                </th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                  <div class="flex items-center">
                    <i class="fas fa-box mr-2 text-primary"></i> Product
                  </div>
                </th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                  <div class="flex items-center">
                    <i class="fas fa-handshake mr-2 text-primary"></i> Mentoring
                  </div>
                </th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                  <div class="flex items-center">
                    <i class="fas fa-rupee-sign mr-2 text-primary"></i> Loans
                  </div>
                </th>
              </tr>
            </thead>
            <tbody id="reportTableBody" class="divide-y divide-gray-200">
              <!-- Data will be populated here dynamically -->
              <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                  No data available. Apply filters to see results.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        
        <!-- Pagination -->
        <div id="paginationContainer" class="bg-white px-6 py-3 flex items-center justify-between border-t border-gray-200 hidden">
          <div class="flex-1 flex justify-between items-center">
            <div>
              <p class="text-sm text-gray-700" id="paginationInfo">
                Showing <span class="font-medium">0</span> to <span class="font-medium">0</span> of <span class="font-medium">0</span> results
              </p>
            </div>
            <div>
              <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                <button id="prevPageBtn" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                  <span class="sr-only">Previous</span>
                  <i class="fas fa-chevron-left"></i>
                </button>
                <span id="pageNumbers" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                  Page 1 of 1
                </span>
                <button id="nextPageBtn" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                  <span class="sr-only">Next</span>
                  <i class="fas fa-chevron-right"></i>
                </button>
              </nav>
            </div>
          </div>
        </div>
      </div>

      <!-- Download Button -->
      <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4" data-aos="fade-up" data-aos-delay="400">
        <div class="text-sm text-gray-600">
          <i class="fas fa-info-circle mr-1 text-primary"></i> <span id="lastUpdated">Data not loaded yet</span>
        </div>
        <div class="flex gap-3">
          <button id="downloadBtn" 
            class="bg-primary text-white px-5 py-2.5 rounded-lg hover:bg-secondary transition-all duration-300 shadow-md hover:shadow-lg flex items-center gap-2">
            <i class="fas fa-file-csv"></i> Download CSV
          </button>
          <button id="printBtn"
            class="bg-white border border-gray-300 text-gray-700 px-5 py-2.5 rounded-lg hover:bg-gray-50 transition-all duration-300 shadow-sm hover:shadow-md flex items-center gap-2">
            <i class="fas fa-print"></i> Print Report
          </button>
        </div>
      </div>

    </div>
  </main>
<?php include '../include/footer.php'; ?>
<script>
  const API_BASE = 'http://localhost:5000/api'; 

  // Global variables
  let currentPage = 1;
  const itemsPerPage = 10;
  let allEntrepreneurs = [];
  let filteredEntrepreneurs = [];
  let villages = [];

  // Initialize the page
  document.addEventListener('DOMContentLoaded', () => {
    // Set default date values
    const today = new Date();
    const firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);

    document.getElementById('fromDate').value = firstDayOfMonth.toISOString().split('T')[0];
    document.getElementById('toDate').value = today.toISOString().split('T')[0];

    // Fetch villages for the dropdown
    fetchVillages();

    // Add event listeners
    document.getElementById('filterForm').addEventListener('submit', handleFilterSubmit);
    document.getElementById('downloadBtn').addEventListener('click', downloadCSV);
    document.getElementById('printBtn').addEventListener('click', printReport);
    document.getElementById('prevPageBtn').addEventListener('click', goToPrevPage);
    document.getElementById('nextPageBtn').addEventListener('click', goToNextPage);

    // Load initial data
    fetchReportData();
  });

  // Fetch villages for the dropdown
  async function fetchVillages() {
    try {
      const response = await fetch(`${API_BASE}/entrepreneurs/villages`);
      if (!response.ok) throw new Error('Failed to fetch villages');

      villages = await response.json();
    } catch (error) {
      console.error('Error fetching villages:', error);

      // Fallback hardcoded villages if fetch fails
      villages = [
        "Village 1", "Village 2", "Village 3", "Village 4", "Village 5",
        "Village 6", "Village 7", "Village 8", "Village 9", "Village 10"
      ];
    }

    // Populate dropdown
    const villageFilter = document.getElementById('villageFilter');
    villageFilter.innerHTML = '<option value="">All Villages</option>'; // Default option

    villages.forEach(village => {
      const option = document.createElement('option');
      option.value = village;
      option.textContent = village;
      villageFilter.appendChild(option);
    });
  }

  // Handle filter form submission
  function handleFilterSubmit(e) {
    e.preventDefault();
    currentPage = 1; // Reset to first page when applying new filters
    fetchReportData();
  }

  // Fetch report data from API
  async function fetchReportData() {
    const fromDate = document.getElementById('fromDate').value;
    const toDate = document.getElementById('toDate').value;
    const village = document.getElementById('villageFilter').value;

    if (!fromDate || !toDate) {
      alert('Please select both from and to dates');
      return;
    }

    // Show loading indicator
    document.getElementById('loadingIndicator').classList.remove('hidden');
    document.getElementById('reportTableBody').innerHTML = `
      <tr>
        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
          Loading data...
        </td>
      </tr>
    `;

    try {
      // Build query parameters
      const params = new URLSearchParams({
        fromDate,
        toDate,
        ...(village && { village })
      });

      const response = await fetch(`${API_BASE}/projectreport?${params.toString()}`);

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();

      // Update summary stats
      document.getElementById('totalEntrepreneurs').textContent = data.summary.totalEntrepreneurs || 0;
      document.getElementById('totalMentoring').textContent = data.summary.totalMentoringSessions || 0;
      document.getElementById('totalLoans').textContent = data.summary.totalLoans || 0;

      // Update info text
      document.getElementById('entrepreneursInfo').textContent =
        `Registered between ${formatDate(fromDate)} and ${formatDate(toDate)}`;
      document.getElementById('mentoringInfo').textContent =
        `Sessions conducted between ${formatDate(fromDate)} and ${formatDate(toDate)}`;
      document.getElementById('loansInfo').textContent =
        `Disbursed between ${formatDate(fromDate)} and ${formatDate(toDate)}`;

      // Store entrepreneurs data
      allEntrepreneurs = data.entrepreneurs || [];
      filteredEntrepreneurs = allEntrepreneurs;

      // Update last updated timestamp
      document.getElementById('lastUpdated').textContent =
        `Data updated at ${new Date().toLocaleTimeString()}`;

      // Render table and pagination
      renderTable();
      updatePagination();

    } catch (error) {
      console.error('Error fetching report data:', error);
      document.getElementById('reportTableBody').innerHTML = `
        <tr>
          <td colspan="6" class="px-6 py-4 text-center text-red-500">
            Error loading data: ${error.message}
          </td>
        </tr>
      `;
    } finally {
      // Hide loading indicator
      document.getElementById('loadingIndicator').classList.add('hidden');
    }
  }

  // Render the table with current page data
  function renderTable() {
    const tableBody = document.getElementById('reportTableBody');

    if (filteredEntrepreneurs.length === 0) {
      tableBody.innerHTML = `
        <tr>
          <td colspan="6" class="px-6 py-4 text-center text-gray-500">
            No entrepreneurs found for the selected filters.
          </td>
        </tr>
      `;
      return;
    }

    // Calculate pagination
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = Math.min(startIndex + itemsPerPage, filteredEntrepreneurs.length);
    const currentItems = filteredEntrepreneurs.slice(startIndex, endIndex);

    let tableHTML = '';

    currentItems.forEach(entrepreneur => {
      tableHTML += `
        <tr class="hover:bg-gray-50 transition-colors duration-150">
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">E${String(entrepreneur.id).padStart(3, '0')}</span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="flex-shrink-0 h-8 w-8">
                <img class="h-8 w-8 rounded-full object-cover" src="${entrepreneur.image ? `../uploads/${entrepreneur.image}` : 'https://randomuser.me/api/portraits/women/43.jpg'}" alt="${entrepreneur.name}">
              </div>
              <div class="ml-3">
                <div class="font-medium text-gray-900">${entrepreneur.name}</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">${entrepreneur.village}</span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">${entrepreneur.product_type}</span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <span class="font-medium text-gray-900">${entrepreneur.mentoring_sessions || 0}</span>
              <span class="ml-2 text-xs text-gray-500">sessions</span>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="font-medium text-gray-900">₹${formatCurrency(entrepreneur.total_loan_amount || 0)}</div>
            <div class="text-xs text-gray-500">${entrepreneur.loan_count || 0} loans</div>
          </td>
        </tr>
      `;
    });

    tableBody.innerHTML = tableHTML;
  }

  // Update pagination controls
  function updatePagination() {
    const totalPages = Math.ceil(filteredEntrepreneurs.length / itemsPerPage);

    if (filteredEntrepreneurs.length <= itemsPerPage) {
      document.getElementById('paginationContainer').classList.add('hidden');
      return;
    }

    document.getElementById('paginationContainer').classList.remove('hidden');

    // Update pagination info
    const startIndex = (currentPage - 1) * itemsPerPage + 1;
    const endIndex = Math.min(startIndex + itemsPerPage - 1, filteredEntrepreneurs.length);

    document.getElementById('paginationInfo').innerHTML = `
      Showing <span class="font-medium">${startIndex}</span> to <span class="font-medium">${endIndex}</span> of <span class="font-medium">${filteredEntrepreneurs.length}</span> results
    `;

    // Update page numbers
    document.getElementById('pageNumbers').textContent = `Page ${currentPage} of ${totalPages}`;

    // Enable/disable navigation buttons
    document.getElementById('prevPageBtn').disabled = currentPage === 1;
    document.getElementById('nextPageBtn').disabled = currentPage === totalPages;
  }

  // Navigate to previous page
  function goToPrevPage() {
    if (currentPage > 1) {
      currentPage--;
      renderTable();
      updatePagination();
    }
  }

  // Navigate to next page
  function goToNextPage() {
    const totalPages = Math.ceil(filteredEntrepreneurs.length / itemsPerPage);
    if (currentPage < totalPages) {
      currentPage++;
      renderTable();
      updatePagination();
    }
  }

  // Download CSV function
  function downloadCSV() {
    if (filteredEntrepreneurs.length === 0) {
      alert('No data to download');
      return;
    }

    const fromDate = document.getElementById('fromDate').value;
    const toDate = document.getElementById('toDate').value;
    const village = document.getElementById('villageFilter').value;

    // Create CSV content
    let csvContent = "Entrepreneur ID,Name,Village,Product Type,Mentoring Sessions,Loan Count,Total Loan Amount\n";

    filteredEntrepreneurs.forEach(entrepreneur => {
      csvContent += `E${String(entrepreneur.id).padStart(3, '0')},"${entrepreneur.name}",${entrepreneur.village},${entrepreneur.product_type},${entrepreneur.mentoring_sessions || 0},${entrepreneur.loan_count || 0},${entrepreneur.total_loan_amount || 0}\n`;
    });

    // Create download link
    const encodedUri = encodeURI('data:text/csv;charset=utf-8,' + csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);

    // Create filename with date range and village
    let filename = `entrepreneurs_report_${fromDate}_to_${toDate}`;
    if (village) {
      filename += `_${village}`;
    }
    filename += '.csv';

    link.setAttribute("download", filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  }

  // Print report function
  function printReport() {
    window.print();
  }

  // Helper function to format date
  function formatDate(dateString) {
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return new Date(dateString).toLocaleDateString(undefined, options);
  }

  // Helper function to format currency
  function formatCurrency(amount) {
    return new Intl.NumberFormat('en-IN').format(amount);
  }
</script>
