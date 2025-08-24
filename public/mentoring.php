<?php include '../include/sidebar.php'; ?>

<!-- Main Content -->
<main class="flex-grow p-4 lg:p-8 overflow-auto lg:ml-0">

  <!-- Header & Add Button -->
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4" data-aos="fade-up">
    <div>
      <h2 class="text-2xl lg:text-3xl font-bold text-gray-800">Mentoring Session Reports</h2>
      <p class="text-gray-600 mt-1">Track and manage all mentoring sessions</p>
    </div>
    <button 
      onclick="openModal()"
      class="bg-primary text-white px-5 py-2.5 rounded-lg hover:bg-secondary transition-all duration-300 shadow-md hover:shadow-lg flex items-center gap-2">
      <i class="fas fa-plus-circle"></i>
      Add Report
    </button>
  </div>

  <!-- Reports Table -->
  <div class="bg-white rounded-xl shadow-sm overflow-hidden" data-aos="fade-up">
    <div class="overflow-x-auto">
      <table class="min-w-full" id="reports-table">
        <thead>
          <tr class="bg-gray-100 text-left text-gray-700 uppercase text-sm font-medium">
            <th class="px-6 py-4">Entrepreneur</th>
            <th class="px-6 py-4">Date</th>
            <th class="px-6 py-4">Type</th>
            <th class="px-6 py-4 hidden md:table-cell">Topics</th>
            <th class="px-6 py-4 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200" id="reports-body">
          <!-- Rows will be populated here dynamically -->
        </tbody>
      </table>
    </div>

    <!-- Pagination (You can implement this dynamically as well) -->
    <div class="bg-white px-6 py-3 flex items-center justify-between border-t border-gray-200">
      <div class="flex-1 flex justify-between items-center">
        <div>
          <p class="text-sm text-gray-700" id="pagination-info">
            <!-- Pagination info will update here -->
          </p>
        </div>
        <div>
          <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50" id="prev-page">
              <span class="sr-only">Previous</span>
              <i class="fas fa-chevron-left"></i>
            </a>
            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-blue-50 text-sm font-medium text-blue-600 hover:bg-blue-100" id="page-1">1</a>
            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50" id="page-2">2</a>
            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50" id="page-3">3</a>
            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50" id="next-page">
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
      <h3 class="text-xl font-semibold mb-2 text-gray-800">Mentoring Session Report</h3>
      <p class="text-gray-600 mb-6">Record details of a mentoring session</p>

      <form id="report-form" method="POST" action="/mentoring" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="entrepreneur" class="block mb-2 font-medium text-gray-700">Entrepreneur</label>
            <select id="entrepreneur" name="entrepreneur" required
              class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
              <option value="">Loading entrepreneurs...</option>
            </select>
          </div>

          <div>
            <label for="date" class="block mb-2 font-medium text-gray-700">Session Date</label>
            <input id="date" name="date" type="date" required
              class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="time" class="block mb-2 font-medium text-gray-700">Session Time</label>
            <input id="time" name="time" type="time" required
              class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
          </div>

          <div>
            <label for="type" class="block mb-2 font-medium text-gray-700">Session Type</label>
            <select id="type" name="type" required
              class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
              <option value="">Select type</option>
              <option value="Individual">Individual</option>
              <option value="Group">Group</option>
            </select>
          </div>
        </div>

        <div>
          <label for="topics" class="block mb-2 font-medium text-gray-700">Topics Covered (comma separated)</label>
          <input id="topics" name="topics" type="text"
            placeholder="e.g. Marketing, Branding"
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
        </div>

        <div>
          <label for="notes" class="block mb-2 font-medium text-gray-700">Session Notes</label>
          <textarea id="notes" name="notes" rows="4"
            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
            placeholder="Record key discussion points, action items, and observations"></textarea>
        </div>

        <div class="pt-4 flex gap-3">
          <button type="button" onclick="closeModal()"
            class="flex-1 bg-gray-200 text-gray-800 px-4 py-2.5 rounded-lg hover:bg-gray-300 transition-all duration-300">
            Cancel
          </button>
          <button type="submit"
            class="flex-1 bg-primary text-white px-4 py-2.5 rounded-lg hover:bg-secondary transition-all duration-300 shadow-md hover:shadow-lg">
            Save Report
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include '../include/footer.php'; ?>
<script>
  const API_BASE = 'http://localhost:5000/api';  // Change if needed
  const entrepreneursSelect = document.getElementById('entrepreneur');
  const reportsBody = document.getElementById('reports-body');
  const form = document.getElementById('report-form');

  // Open/close modal functions
  function openModal() {
    document.getElementById('modal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
  }

  function closeModal() {
    document.getElementById('modal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
    form.reset();
    setTodayDate();
  }

  // Close modal when clicking outside the form (on backdrop)
  document.getElementById('modal').addEventListener('click', e => {
    if (e.target.id === 'modal') closeModal();
  });

  // Set today's date in date input
  function setTodayDate() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('date').value = today;
  }

  // Initialize on page load
  document.addEventListener('DOMContentLoaded', () => {
    setTodayDate();
    fetchEntrepreneurs();
    fetchReports();
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

  // Fetch reports and render table rows
  async function fetchReports() {
    try {
      const res = await fetch(`${API_BASE}/reports`);
      if (!res.ok) throw new Error('Failed to fetch reports');

      const reports = await res.json();
      renderReportsTable(reports);
    } catch (error) {
      console.error(error);
      reportsBody.innerHTML = `
        <tr>
          <td colspan="5" class="text-center py-4 text-red-500">Failed to load reports</td>
        </tr>`;
    }
  }

  // Render the reports in the table
  function renderReportsTable(reports) {
    reportsBody.innerHTML = ''; // Clear current rows

    reports.forEach(report => {
      const name = report.entrepreneurName || 'Unknown';
      const village = report.entrepreneurVillage ? `${report.entrepreneurVillage}` : '';
      const avatarUrl = report.entrepreneurAvatarUrl 
        ? `http://localhost:5000/uploads/${report.entrepreneurAvatarUrl}`
        : 'https://via.placeholder.com/40';

      const topicsStr = Array.isArray(report.topics) ? report.topics.join(', ') : (report.topics || '');
      const type = report.session_type || '';
const typeClass = type === 'Group'
  ? 'bg-green-100 text-green-800'
  : 'bg-blue-100 text-blue-800';

      const rowHTML = `
        <tr class="hover:bg-gray-50 transition-colors duration-150">
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="flex-shrink-0 h-10 w-10">
                <img class="h-10 w-10 rounded-full object-cover" src="${avatarUrl}" alt="${name}">
              </div>
              <div class="ml-4">
                <div class="font-medium text-gray-900">${name}</div>
                <div class="text-gray-500 text-sm">${village}</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-gray-900 font-medium">${report.session_date || ''}</div>
            <div class="text-gray-500 text-sm">${report.session_time || ''}</div>
          </td>
              <td class="px-6 py-4 whitespace-nowrap">
      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${typeClass}">
        ${type}
      </span>
    </td>
          <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
            <div class="text-gray-900">${topicsStr}</div>
            <div class="text-gray-500 text-sm truncate max-w-xs">${report.notes || ''}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <div class="flex items-center justify-end space-x-3">
              <button class="text-blue-600 hover:text-blue-900 transition-colors" title="Edit" onclick="editReport(${report.id})">
                <i class="fas fa-edit"></i>
              </button>
              <button class="text-green-600 hover:text-green-900 transition-colors" title="View" onclick="viewReport(${report.id})">
                <i class="fas fa-eye"></i>
              </button>
              <button class="text-red-600 hover:text-red-900 transition-colors" title="Delete" onclick="deleteReport(${report.id})">
                <i class="fas fa-trash-alt"></i>
              </button>
            </div>
          </td>
        </tr>
      `;

      reportsBody.insertAdjacentHTML('beforeend', rowHTML);
    });
  }

  // Handle form submission for creating a new report
  form.addEventListener('submit', async e => {
    e.preventDefault();

    const formData = {
      entrepreneur_id: entrepreneursSelect.value,
      session_date: document.getElementById('date').value,
      session_time: document.getElementById('time').value,
      session_type: document.getElementById('type').value,
      topics: document.getElementById('topics').value.split(',').map(t => t.trim()).filter(Boolean),
      notes: document.getElementById('notes').value.trim()
    };

    if (!formData.entrepreneur_id) {
      alert('Please select an entrepreneur.');
      return;
    }

    console.log('Submitting report:', formData);

    try {
      const response = await fetch(`${API_BASE}/reports`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData),
      });

      if (!response.ok) {
        let errorMsg = 'Failed to save report';
        try {
          const errorData = await response.json();
          if (errorData.error) errorMsg = errorData.error;
        } catch {
          // Ignore JSON parsing errors
        }
        throw new Error(errorMsg);
      }

      await fetchReports();
      closeModal();
    } catch (error) {
      alert(`Error saving report: ${error.message}`);
      console.error(error);
    }
  });

  // Delete report by id
  async function deleteReport(id) {
    if (!confirm('Are you sure you want to delete this report?')) return;

    try {
      const res = await fetch(`${API_BASE}/reports/${id}`, { method: 'DELETE' });
      if (!res.ok) throw new Error('Failed to delete report');

      fetchReports();
    } catch (error) {
      alert('Error deleting report.');
      console.error(error);
    }
  }

  // Placeholder: edit report (implement as needed)
  function editReport(id) {
    alert(`Edit report with id ${id} - feature Coming Soon.`);
  }

  // Placeholder: view report details (implement as needed)
  function viewReport(id) {
    alert(`View report with id ${id} - feature Coming Soon.`);
  }
</script>
