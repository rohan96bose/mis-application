<?php include '../include/sidebar.php'; ?>

    <!-- Main Content -->
    <main class="flex-grow p-4 lg:p-8 overflow-auto lg:ml-0">

    <!-- Header & Add Button -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4" data-aos="fade-up">
      <div>
        <h2 class="text-2xl lg:text-3xl font-bold text-gray-800">Entrepreneurs</h2>
        <p class="text-gray-600 mt-1">Manage all entrepreneurs in the program</p>
      </div>
<button 
  onclick="openModal()"
  class="bg-[#4F46E5] text-white px-5 py-2.5 rounded-lg hover:bg-[#7C3AED] transition-all duration-300 shadow-md hover:shadow-lg flex items-center gap-2">
  <i class="fas fa-plus-circle"></i>
  Add Entrepreneur
</button>

    </div>

    <!-- Entrepreneur Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden" data-aos="fade-up">
      <div class="overflow-x-auto">
        <table class="min-w-full">
          <thead>
            <tr class="bg-gray-100 text-left text-gray-700 uppercase text-sm font-medium">
              <th class="px-6 py-4">Name</th>
              <th class="px-6 py-4">Age</th>
              <th class="px-6 py-4">Village</th>
              <th class="px-6 py-4">Phone</th>
              <th class="px-6 py-4">Product Type</th>
              <th class="px-6 py-4 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 bg-white">
  <!-- Entrepreneurs will be loaded here -->
</tbody>

        </table>
      </div>
      
      <!-- Pagination -->
      <div class="bg-white px-6 py-3 flex items-center justify-between border-t border-gray-200">
        <div class="flex-1 flex justify-between items-center">
          <div>
            <p class="text-sm text-gray-700">
              Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">42</span> results
            </p>
          </div>
          <div>
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
              <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Previous</span>
                <i class="fas fa-chevron-left"></i>
              </a>
              <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-blue-50 text-sm font-medium text-blue-600 hover:bg-blue-100">1</a>
              <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">2</a>
              <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">3</a>
              <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
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
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg relative max-h-[90vh] overflow-y-auto" data-aos="zoom-in">
      <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-500 hover:text-black transition-colors">
        <i class="fas fa-times text-xl"></i>
      </button>
      <div class="p-6">
        <h3 class="text-xl font-semibold mb-2 text-gray-800">Register Entrepreneur</h3>
        <p class="text-gray-600 mb-6">Add a new entrepreneur to the program</p>
        
       <form method="POST" action="" enctype="multipart/form-data" class="space-y-4">
          <div>
            <label for="name" class="block mb-2 font-medium text-gray-700">Full Name</label>
            <input id="name" name="name" type="text" required
              class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
              placeholder="Enter full name">
          </div>

          <div>
            <label for="age" class="block mb-2 font-medium text-gray-700">Age</label>
            <input id="age" name="age" type="number" min="18" max="100" required
              class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
              placeholder="Enter age">
          </div>

          <div>
            <label for="village" class="block mb-2 font-medium text-gray-700">Village</label>
            <select id="village" name="village" required
              class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
              <option value="">Select village</option>
              <?php for ($i = 1; $i <= 10; $i++): ?>
                <option value="Village<?= $i ?>">Village <?= $i ?></option>
              <?php endfor; ?>
            </select>
          </div>

          <div>
            <label for="phone" class="block mb-2 font-medium text-gray-700">Phone Number</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="text-gray-500">+91</span>
              </div>
              <input id="phone" name="phone" type="tel" pattern="[0-9]{10}" required
                class="w-full border border-gray-300 rounded-lg pl-12 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                placeholder="9876543210">
            </div>
          </div>

          <div>
            <label for="product_type" class="block mb-2 font-medium text-gray-700">Product Type</label>
            <select id="product_type" name="product_type" required
              class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
              <option value="">Select product type</option>
              <option value="Papad">Papad</option>
              <option value="Jam">Jam</option>
              <option value="Jelly">Jelly</option>
              <option value="Other">Other</option>
            </select>
          </div>

            <div>
    <label for="image" class="block mb-2 font-medium text-gray-700">Upload Image</label>
    <input id="image" name="image" type="file" accept="image/*"
      class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" />
  </div>
          <div class="pt-4 flex gap-3">
            <button type="button" onclick="closeModal()"
              class="flex-1 bg-gray-200 text-gray-800 px-4 py-2.5 rounded-lg hover:bg-gray-300 transition-all duration-300">
              Cancel
            </button>
            <button type="submit"
              class="flex-1 bg-primary text-white px-4 py-2.5 rounded-lg hover:bg-secondary transition-all duration-300 shadow-md hover:shadow-lg">
              Register Entrepreneur
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php include '../include/footer.php'; ?>
  <script>
  function openModal() {
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

  const API_URL = 'http://localhost:5000/api/entrepreneurs'; 

  // Fetch and render entrepreneurs list
  async function fetchEntrepreneurs() {
    try {
      const response = await fetch(API_URL);
      const data = await response.json();
      renderEntrepreneurs(data);
    } catch (error) {
      console.error('Error fetching entrepreneurs:', error);
    }
  }

  // Render entrepreneurs inside table body
function renderEntrepreneurs(entrepreneurs) {
  const tbody = document.querySelector('tbody.divide-y');
  tbody.innerHTML = ''; // Clear existing rows

  entrepreneurs.forEach(e => {
    const imgSrc = e.image
      ? `../uploads/${e.image}`
      : 'https://randomuser.me/api/portraits/women/43.jpg';

    const tr = document.createElement('tr');
    tr.classList.add('hover:bg-gray-50', 'transition-colors', 'duration-150');

    tr.innerHTML = `
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
          <div class="flex-shrink-0 h-10 w-10">
            <img 
              class="h-10 w-10 rounded-full object-cover" 
              src="${imgSrc}" 
              alt="${e.name || 'Entrepreneur'}"
              loading="lazy"
            >
          </div>
          <div class="ml-4">
            <div class="font-medium text-gray-900">${e.name || '-'}</div>
            <div class="text-gray-500">${e.email || '-'}</div>
          </div>
        </div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-gray-900">${e.age ?? '-'}</div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">${e.village || '-'}</span>
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-gray-900">${e.phone || '-'}</td>
      <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${getProductColor(e.product_type)}">${e.product_type || '-'}</span>
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <div class="flex items-center justify-end space-x-3">
          <button 
            class="text-blue-600 hover:text-blue-900 transition-colors" 
            title="Edit" 
            onclick="editEntrepreneur(${e.id})"
          >
            <i class="fas fa-edit"></i>
          </button>
          <button 
            class="text-green-600 hover:text-green-900 transition-colors" 
            title="View" 
            onclick="viewEntrepreneur(${e.id})"
          >
            <i class="fas fa-eye"></i>
          </button>
          <button 
            class="text-red-600 hover:text-red-900 transition-colors" 
            title="Delete" 
            onclick="deleteEntrepreneur(${e.id})"
          >
            <i class="fas fa-trash-alt"></i>
          </button>
        </div>
      </td>
    `;

    tbody.appendChild(tr);
  });
}

  function getProductColor(product) {
    switch(product.toLowerCase()) {
      case 'papad': return 'bg-purple-100 text-purple-800';
      case 'jam': return 'bg-green-100 text-green-800';
      case 'jelly': return 'bg-yellow-100 text-yellow-800';
      default: return 'bg-gray-100 text-gray-800';
    }
  }

  // Handle form submit (Add entrepreneur) with FormData for image upload
  document.querySelector('form').addEventListener('submit', async (e) => {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    try {
      const response = await fetch(API_URL, {
        method: 'POST',
        body: formData
      });

      if (response.ok) {
        alert('Entrepreneur registered!');
        form.reset();
        fetchEntrepreneurs();
        closeModal();
      } else {
        const error = await response.json();
        alert('Error: ' + (error.error || 'Failed to register entrepreneur'));
      }
    } catch (error) {
      alert('Failed to register entrepreneur');
      console.error(error);
    }
  });

  // Delete entrepreneur
  async function deleteEntrepreneur(id) {
    if (!confirm('Are you sure you want to delete this entrepreneur?')) return;

    try {
      const response = await fetch(`${API_URL}/${id}`, { method: 'DELETE' });

      if (response.ok) {
        alert('Entrepreneur deleted!');
        fetchEntrepreneurs();
      } else {
        alert('Failed to delete entrepreneur');
      }
    } catch (error) {
      alert('Failed to delete entrepreneur');
      console.error(error);
    }
  }

  // Placeholder functions for Edit and View buttons (optional)
  function editEntrepreneur(id) {
    alert('Edit feature coming soon! ID: ' + id);
  }

  function viewEntrepreneur(id) {
    alert('View feature coming soon! ID: ' + id);
  }

  // Load entrepreneurs when page loads
  fetchEntrepreneurs();
</script>
