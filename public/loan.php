<?php include '../include/sidebar.php'; ?>

    <!-- Main Content -->
    <main class="flex-grow p-4 lg:p-8 overflow-auto lg:ml-0">

    <!-- Header & Add Button -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4" data-aos="fade-up">
      <div>
        <h2 class="text-2xl lg:text-3xl font-bold text-gray-800">Loan Disbursements</h2>
        <p class="text-gray-600 mt-1">Manage and track all loan disbursements</p>
      </div>
<button 
  onclick="openModal()"
  class="bg-gradient-to-r from-yellow-500 to-amber-600 text-white px-5 py-2.5 rounded-lg hover:from-amber-600 hover:to-yellow-500 transition-all duration-300 shadow-md hover:shadow-lg flex items-center gap-2">
  <i class="fas fa-plus-circle"></i>
  Add Loan
</button>

    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
      <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-warning" data-aos="fade-up" data-aos-delay="100">
        <div class="flex justify-between items-start">
          <div>
            <p class="text-sm font-medium text-gray-600">Total Disbursed</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1" id="total-disbursed">₹0</h3>
          </div>
          <div class="bg-amber-100 p-2 rounded-lg">
            <i class="fas fa-rupee-sign text-warning text-lg"></i>
          </div>
        </div>
        <p class="text-xs text-green-600 mt-3 flex items-center" id="monthly-growth">
          <i class="fas fa-arrow-up mr-1"></i> Loading...
        </p>
      </div>

      <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-success" data-aos="fade-up" data-aos-delay="150">
        <div class="flex justify-between items-start">
          <div>
            <p class="text-sm font-medium text-gray-600">Active Loans</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1" id="active-loans">0</h3>
          </div>
          <div class="bg-green-100 p-2 rounded-lg">
            <i class="fas fa-file-invoice-dollar text-success text-lg"></i>
          </div>
        </div>
        <p class="text-xs text-gray-600 mt-3 flex items-center" id="recovery-rate">
          <i class="fas fa-info-circle mr-1"></i> Loading...
        </p>
      </div>

      <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-primary" data-aos="fade-up" data-aos-delay="200">
        <div class="flex justify-between items-start">
          <div>
            <p class="text-sm font-medium text-gray-600">Avg. Loan Size</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1" id="avg-loan-size">₹0</h3>
          </div>
          <div class="bg-blue-100 p-2 rounded-lg">
            <i class="fas fa-coins text-primary text-lg"></i>
          </div>
        </div>
        <p class="text-xs text-gray-600 mt-3 flex items-center" id="loan-range">
          <i class="fas fa-chart-pie mr-1"></i> Loading...
        </p>
      </div>

      <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-danger" data-aos="fade-up" data-aos-delay="250">
        <div class="flex justify-between items-start">
          <div>
            <p class="text-sm font-medium text-gray-600">Overdue</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1" id="overdue-loans">0</h3>
          </div>
          <div class="bg-red-100 p-2 rounded-lg">
            <i class="fas fa-exclamation-triangle text-danger text-lg"></i>
          </div>
        </div>
        <p class="text-xs text-danger mt-3 flex items-center">
          <i class="fas fa-clock mr-1"></i> Requires attention
        </p>
      </div>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white p-4 rounded-xl shadow-sm mb-6" data-aos="fade-up">
      <div class="flex flex-col md:flex-row gap-4">
        <div class="flex-1 relative">
          <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
          <input type="text" placeholder="Search loans..." id="search-input"
            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-warning focus:border-transparent">
        </div>
        <div class="flex gap-2">
          <select id="status-filter" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-warning focus:border-transparent">
            <option value="all">All Status</option>
            <option value="Active">Active</option>
            <option value="Completed">Completed</option>
            <option value="Overdue">Overdue</option>
            <option value="Processing">Processing</option>
          </select>
          <input type="month" id="month-filter" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-warning focus:border-transparent">
          <button id="filter-btn" class="bg-warning text-white px-4 py-2 rounded-lg hover:bg-amber-600 transition-colors">
            <i class="fas fa-filter"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Loan Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden" data-aos="fade-up">
      <div class="overflow-x-auto">
        <table class="min-w-full">
          <thead>
            <tr class="bg-gray-100 text-left text-gray-700 uppercase text-sm font-medium">
              <th class="px-6 py-4">Entrepreneur</th>
              <th class="px-6 py-4">Amount</th>
              <th class="px-6 py-4">Date</th>
              <th class="px-6 py-4 hidden md:table-cell">Purpose</th>
              <th class="px-6 py-4">Status</th>
              <th class="px-6 py-4 text-right">Actions</th>
            </tr>
          </thead>
          <tbody id="loans-table-body" class="divide-y divide-gray-200">
            <!-- Data will be populated by JavaScript -->
          </tbody>
        </table>
      </div>
      
      <!-- Pagination -->
      <div class="bg-white px-6 py-3 flex items-center justify-between border-t border-gray-200">
        <div class="flex-1 flex justify-between items-center">
          <div>
            <p class="text-sm text-gray-700" id="pagination-info">
              Showing <span class="font-medium">0</span> to <span class="font-medium">0</span> of <span class="font-medium">0</span> results
            </p>
          </div>
          <div>
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
              <a href="#" id="prev-page" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Previous</span>
                <i class="fas fa-chevron-left"></i>
              </a>
              <div id="page-numbers" class="flex">
                <!-- Page numbers will be added here -->
              </div>
              <a href="#" id="next-page" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Next</span>
                <i class="fas fa-chevron-right"></i>
              </a>
            </nav>
          </div>
        </div>
      </div>
    </div>

  </main>

  <!-- Modal -->
  <div id="modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl relative max-h-[90vh] overflow-y-auto" data-aos="zoom-in">
      <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-500 hover:text-black transition-colors">
        <i class="fas fa-times text-xl"></i>
      </button>
      <div class="p-6">
        <h3 class="text-xl font-semibold mb-2 text-gray-800" id="modal-title">Loan Disbursement Entry</h3>
        <p class="text-gray-600 mb-6" id="modal-subtitle">Add a new loan disbursement record</p>
        
        <form id="loanForm" class="space-y-4">
          <input type="hidden" id="loan_id" name="loan_id" value="">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="entrepreneur" class="block mb-2 font-medium text-gray-700">Entrepreneur</label>
              <select id="entrepreneur" name="entrepreneur_id" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-warning focus:border-transparent transition-all">
                <option value="">Loading entrepreneurs...</option>
              </select>
            </div>

            <div>
              <label for="amount" class="block mb-2 font-medium text-gray-700">Amount (₹)</label>
              <div class="relative">
                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">₹</span>
                <input id="amount" name="amount" type="number" min="1" step="0.01" required
                  placeholder="Enter loan amount"
                  class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-warning focus:border-transparent transition-all">
              </div>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="disbursement_date" class="block mb-2 font-medium text-gray-700">Disbursement Date</label>
              <input id="disbursement_date" name="disbursement_date" type="date" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-warning focus:border-transparent transition-all">
            </div>

            <div>
              <label for="interest_rate" class="block mb-2 font-medium text-gray-700">Interest Rate (%)</label>
              <input id="interest_rate" name="interest_rate" type="number" min="0" max="100" step="0.01" required
                placeholder="Enter interest rate"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-warning focus:border-transparent transition-all">
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="due_date" class="block mb-2 font-medium text-gray-700">Due Date (Optional)</label>
              <input id="due_date" name="due_date" type="date"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-warning focus:border-transparent transition-all">
            </div>

            <div>
              <label for="status" class="block mb-2 font-medium text-gray-700">Status</label>
              <select id="status" name="status" required
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-warning focus:border-transparent transition-all">
                <option value="Processing">Processing</option>
                <option value="Active">Active</option>
                <option value="Completed">Completed</option>
                <option value="Overdue">Overdue</option>
              </select>
            </div>
          </div>

          <div>
            <label for="purpose" class="block mb-2 font-medium text-gray-700">Purpose</label>
            <textarea id="purpose" name="purpose" rows="3" required
              placeholder="Purpose of the loan"
              class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-warning focus:border-transparent transition-all"></textarea>
          </div>

          <div>
            <label for="notes" class="block mb-2 font-medium text-gray-700">Additional Notes</label>
            <textarea id="notes" name="notes" rows="2"
              placeholder="Any additional information"
              class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-warning focus:border-transparent transition-all"></textarea>
          </div>

          <div class="pt-4 flex gap-3">
            <button type="button" onclick="closeModal()"
              class="flex-1 bg-gray-200 text-gray-800 px-4 py-2.5 rounded-lg hover:bg-gray-300 transition-all duration-300">
              Cancel
            </button>
            <button type="submit" id="submit-btn"
              class="flex-1 bg-gradient-to-r from-warning to-amber-600 text-white px-4 py-2.5 rounded-lg hover:from-amber-600 hover:to-warning transition-all duration-300 shadow-md hover:shadow-lg">
              Submit Loan Entry
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php include '../include/footer.php'; ?>
  <script>
      const API_BASE = 'http://localhost:5000/api';  
      const entrepreneursSelect = document.getElementById('entrepreneur');
      const loansTableBody = document.getElementById('loans-table-body');
      const searchInput = document.getElementById('search-input');
      const statusFilter = document.getElementById('status-filter');
      const monthFilter = document.getElementById('month-filter');
      const filterBtn = document.getElementById('filter-btn');
      const prevPageBtn = document.getElementById('prev-page');
      const nextPageBtn = document.getElementById('next-page');
      const pageNumbersContainer = document.getElementById('page-numbers');
      const paginationInfo = document.getElementById('pagination-info');
      const loanForm = document.getElementById('loanForm');
      const modalTitle = document.getElementById('modal-title');
      const modalSubtitle = document.getElementById('modal-subtitle');
      const submitBtn = document.getElementById('submit-btn');

      // Pagination variables
      let currentPage = 1;
      const itemsPerPage = 5;
      let allLoans = [];
      let filteredLoans = [];

      // Initialize AOS
      document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
          duration: 800,
          easing: 'ease-in-out',
          once: true
        });
        
        // Set today's date as default for the date field
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('disbursement_date').value = today;
        
        // Load initial data
        fetchEntrepreneurs();
        fetchLoans();
        
        // Set up event listeners
        searchInput.addEventListener('input', filterLoans);
        statusFilter.addEventListener('change', filterLoans);
        monthFilter.addEventListener('change', filterLoans);
        filterBtn.addEventListener('click', filterLoans);
        prevPageBtn.addEventListener('click', goToPrevPage);
        nextPageBtn.addEventListener('click', goToNextPage);
        
        // Form submission
        loanForm.addEventListener('submit', handleFormSubmit);
      });

   function openModal(loanId = null) {
  if (loanId) {
    // Editing feature not implemented yet
    alert(`Loan edit with id ${loanId} - feature Coming Soon.`);
    return; 
  } else {
    // Adding a new loan
    modalTitle.textContent = 'Loan Disbursement Entry';
    modalSubtitle.textContent = 'Add a new loan disbursement record';
    loanForm.reset();
    document.getElementById('loan_id').value = '';
    document.getElementById('disbursement_date').value = new Date().toISOString().split('T')[0];
    document.getElementById('status').value = 'Processing';
    submitBtn.textContent = 'Submit Loan Entry';
  }
  
  document.getElementById('modal').classList.remove('hidden');
  document.body.classList.add('overflow-hidden');
}


      function closeModal() {
        document.getElementById('modal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
      }

      // Close modal when clicking outside
      document.getElementById('modal').addEventListener('click', function(e) {
        if (e.target.id === 'modal') {
          closeModal();
        }
      });

      // Fetch entrepreneurs and populate select dropdown
      async function fetchEntrepreneurs() {
        try {
          const res = await fetch(`${API_BASE}/entrepreneurs`);
          if (!res.ok) throw new Error('Failed to fetch entrepreneurs');

          const data = await res.json();

          entrepreneursSelect.innerHTML = `<option value="">Select entrepreneur</option>`;
          data.forEach(ent => {
            const option = document.createElement('option');
            option.value = ent.id;
            option.textContent = `${ent.name} (Village ${ent.village || 'N/A'})`;
            entrepreneursSelect.appendChild(option);
          });
        } catch (error) {
          console.error(error);
          entrepreneursSelect.innerHTML = `<option value="">Failed to load entrepreneurs</option>`;
        }
      }

      async function fetchLoans() {
        try {
          const response = await fetch(`${API_BASE}/loans`);
          if (!response.ok) throw new Error('Failed to fetch loans');
          
          allLoans = await response.json();
          filteredLoans = [...allLoans];
          
          // Update stats
          updateStats(allLoans);
          
          // Render table and pagination
          filterLoans();
        } catch (err) {
          console.error('Error fetching loans:', err);
          loansTableBody.innerHTML = `<tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">Failed to load loans. Please try again.</td></tr>`;
        }
      }

      function updateStats(loans) {
        // Total disbursed
        const totalDisbursed = loans.reduce((sum, loan) => sum + parseFloat(loan.amount), 0);
        document.getElementById('total-disbursed').textContent = `₹${totalDisbursed.toLocaleString('en-IN')}`;
        
        // Active loans
        const activeLoans = loans.filter(loan => loan.status === 'Active').length;
        document.getElementById('active-loans').textContent = activeLoans;
        
        // Average loan size
        const avgLoanSize = loans.length > 0 ? totalDisbursed / loans.length : 0;
        document.getElementById('avg-loan-size').textContent = `₹${avgLoanSize.toLocaleString('en-IN', {maximumFractionDigits: 2})}`;
        
        // Overdue loans
        const overdueLoans = loans.filter(loan => loan.status === 'Overdue').length;
        document.getElementById('overdue-loans').textContent = overdueLoans;
        
        // Additional stats (simplified for demo)
        document.getElementById('monthly-growth').innerHTML = '<i class="fas fa-arrow-up mr-1"></i> Calculating...';
        document.getElementById('recovery-rate').innerHTML = '<i class="fas fa-info-circle mr-1"></i> Calculating...';
        document.getElementById('loan-range').innerHTML = '<i class="fas fa-chart-pie mr-1"></i> Calculating...';
        
        // Calculate range if we have loans
        if (loans.length > 0) {
          const amounts = loans.map(loan => parseFloat(loan.amount));
          const minAmount = Math.min(...amounts);
          const maxAmount = Math.max(...amounts);
          document.getElementById('loan-range').innerHTML = `<i class="fas fa-chart-pie mr-1"></i> Range: ₹${minAmount.toLocaleString('en-IN')}-₹${maxAmount.toLocaleString('en-IN')}`;
        }
      }

      function filterLoans() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        const monthValue = monthFilter.value;
        
        filteredLoans = allLoans.filter(loan => {
          // Search filter
          const matchesSearch = 
            loan.entrepreneurName.toLowerCase().includes(searchTerm) ||
            (loan.purpose && loan.purpose.toLowerCase().includes(searchTerm)) ||
            (loan.village && loan.village.toLowerCase().includes(searchTerm));
          
          // Status filter
          const matchesStatus = statusValue === 'all' || loan.status === statusValue;
          
          // Month filter
          let matchesMonth = true;
          if (monthValue) {
            const loanDate = new Date(loan.disbursement_date);
            const filterDate = new Date(monthValue);
            matchesMonth = 
              loanDate.getFullYear() === filterDate.getFullYear() &&
              loanDate.getMonth() === filterDate.getMonth();
          }
          
          return matchesSearch && matchesStatus && matchesMonth;
        });
        
        currentPage = 1; // Reset to first page when filtering
        renderTable();
        renderPagination();
      }

      function renderTable() {
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const currentLoans = filteredLoans.slice(startIndex, endIndex);
        
        if (currentLoans.length === 0) {
          loansTableBody.innerHTML = `<tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">No loans found</td></tr>`;
          return;
        }
        
        loansTableBody.innerHTML = '';
        
        currentLoans.forEach(loan => {
          const tr = document.createElement('tr');
           const avatarUrl = loan.entrepreneurAvatarUrl
    ? `http://localhost/mis/uploads/${loan.entrepreneurAvatarUrl}`
    : 'https://randomuser.me/api/portraits/lego/1.jpg';
          tr.classList.add('hover:bg-gray-50', 'transition-colors', 'duration-150');
          
          tr.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10">
                   <img class="h-10 w-10 rounded-full object-cover" src="${avatarUrl}" alt="${loan.entrepreneurName}">
                </div>
                <div class="ml-4">
                  <div class="font-medium text-gray-900">${loan.entrepreneurName}</div>
                  <div class="text-gray-500 text-sm">${loan.village || 'No village'}</div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-gray-900 font-medium">₹${parseFloat(loan.amount).toLocaleString('en-IN')}</div>
              <div class="text-gray-500 text-sm">${loan.interest_rate}% interest</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-gray-900">${formatDate(loan.disbursement_date)}</div>
              <div class="text-gray-500 text-sm">${loan.due_date ? `Due: ${formatDate(loan.due_date)}` : 'No due date'}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
              <div class="text-gray-900">${loan.purpose || 'No purpose specified'}</div>
              <div class="text-gray-500 text-sm truncate max-w-xs">${loan.notes || 'No notes'}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${getStatusClass(loan.status)}">${loan.status}</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <div class="flex items-center justify-end space-x-3">
                <button class="text-blue-600 hover:text-blue-900 transition-colors" title="Edit" onclick="openModal(${loan.loan_id})">
                  <i class="fas fa-edit"></i>
                </button>
                <button class="text-green-600 hover:text-green-900 transition-colors" title="View" onclick="viewLoan(${loan.loan_id})">
                  <i class="fas fa-eye"></i>
                </button>
                <button class="text-red-600 hover:text-red-900 transition-colors" title="Delete" onclick="deleteLoan(${loan.loan_id})">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </div>
            </td>
          `;
          
          loansTableBody.appendChild(tr);
        });
      }

      function formatDate(dateString) {
        if (!dateString) return 'N/A';
        
        const date = new Date(dateString);
        return date.toLocaleDateString('en-IN', {
          year: 'numeric',
          month: 'short',
          day: 'numeric'
        });
      }

      function getStatusClass(status) {
        switch (status) {
          case 'Active': return 'bg-green-100 text-green-800';
          case 'Processing': return 'bg-blue-100 text-blue-800';
          case 'Overdue': return 'bg-red-100 text-red-800';
          case 'Completed': return 'bg-gray-100 text-gray-800';
          default: return 'bg-gray-100 text-gray-800';
        }
      }

      function renderPagination() {
        const totalPages = Math.ceil(filteredLoans.length / itemsPerPage);
        
        // Update pagination info
        const startItem = (currentPage - 1) * itemsPerPage + 1;
        const endItem = Math.min(currentPage * itemsPerPage, filteredLoans.length);
        
        paginationInfo.innerHTML = `
          Showing <span class="font-medium">${startItem}</span> to <span class="font-medium">${endItem}</span> of 
          <span class="font-medium">${filteredLoans.length}</span> results
        `;
        
        // Update page numbers
        pageNumbersContainer.innerHTML = '';
        
        for (let i = 1; i <= totalPages; i++) {
          const pageLink = document.createElement('a');
          pageLink.href = '#';
          pageLink.className = `relative inline-flex items-center px-4 py-2 border text-sm font-medium ${
            i === currentPage 
              ? 'border-amber-500 bg-amber-50 text-amber-600 z-10' 
              : 'border-gray-300 bg-white text-gray-500 hover:bg-gray-50'
          }`;
          pageLink.textContent = i;
          pageLink.addEventListener('click', (e) => {
            e.preventDefault();
            goToPage(i);
          });
          
          pageNumbersContainer.appendChild(pageLink);
        }
        
        // Enable/disable previous and next buttons
        prevPageBtn.classList.toggle('opacity-50', currentPage === 1);
        prevPageBtn.classList.toggle('cursor-not-allowed', currentPage === 1);
        nextPageBtn.classList.toggle('opacity-50', currentPage === totalPages || totalPages === 0);
        nextPageBtn.classList.toggle('cursor-not-allowed', currentPage === totalPages || totalPages === 0);
      }

      function goToPage(page) {
        const totalPages = Math.ceil(filteredLoans.length / itemsPerPage);
        if (page < 1 || page > totalPages) return;
        
        currentPage = page;
        renderTable();
        renderPagination();
        
        // Scroll to top of table
        loansTableBody.parentElement.scrollIntoView({ behavior: 'smooth' });
      }

      function goToPrevPage(e) {
        e.preventDefault();
        if (currentPage > 1) {
          goToPage(currentPage - 1);
        }
      }

      function goToNextPage(e) {
        e.preventDefault();
        const totalPages = Math.ceil(filteredLoans.length / itemsPerPage);
        if (currentPage < totalPages) {
          goToPage(currentPage + 1);
        }
      }

      async function handleFormSubmit(e) {
        e.preventDefault();
        
        const formData = new FormData(loanForm);
        const loanId = formData.get('loan_id');
        const isEdit = !!loanId;
        
        const loanData = {
          entrepreneur_id: formData.get('entrepreneur_id'),
          amount: formData.get('amount'),
          interest_rate: formData.get('interest_rate'),
          disbursement_date: formData.get('disbursement_date'),
          due_date: formData.get('due_date') || null,
          purpose: formData.get('purpose'),
          notes: formData.get('notes'),
          status: formData.get('status')
        };
        
        // Get entrepreneur name and village for display
        const selectedOption = entrepreneursSelect.options[entrepreneursSelect.selectedIndex];
        const optionText = selectedOption.textContent;
        const matches = optionText.match(/(.+)\s+\(Village\s+(.+)\)/);
        
        if (matches) {
          loanData.entrepreneur_name = matches[1];
          loanData.village = matches[2];
        } else {
          loanData.entrepreneur_name = optionText;
          loanData.village = null;
        }
        
        try {
          const url = isEdit ? `${API_BASE}/loans/${loanId}` : `${API_BASE}/loans`;
          const method = isEdit ? 'PUT' : 'POST';
          
          // For this demo, we'll simulate API calls since we can't actually modify the backend
          console.log(`${method} request to ${url}`, loanData);
          
          // Simulate API call delay
          submitBtn.disabled = true;
          submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
          
          // In a real application, you would use:
         
          const response = await fetch(url, {
            method: method,
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(loanData)
          });
          
          if (!response.ok) throw new Error('Failed to save loan');
          
          
          // Simulate API response
          await new Promise(resolve => setTimeout(resolve, 1000));
          
          if (Math.random() > 0.1) { // 90% success rate for demo
            alert(isEdit ? 'Loan updated successfully!' : 'Loan added successfully!');
            closeModal();
            fetchLoans(); // Refresh the data
          } else {
            throw new Error('Simulated API error');
          }
        } catch (error) {
          console.error('Error saving loan:', error);
          alert(`Error: ${error.message}`);
        } finally {
          submitBtn.disabled = false;
          submitBtn.textContent = isEdit ? 'Update Loan' : 'Submit Loan Entry';
        }
      }
      
  function viewLoan(loanId) {
    alert(`View report with id ${loanId} - feature Coming Soon.`);
  }

    async function deleteLoan(loanId) {
    if (!confirm('Are you sure you want to delete this loan? This action cannot be undone.')) return;

    try {
      const res = await fetch(`${API_BASE}/loans/${loanId}`, { method: 'DELETE' });
      if (!res.ok) throw new Error('Failed to delete loan');

      fetchLoans();
    } catch (error) {
      alert('Error deleting loan.');
      console.error(error);
    }
  }
  </script>