@extends('admin.loyout.master')
@section('content')
 @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        </script>
    @endif

    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}")
        </script>
    @endif
<div class="max-w-7xl mx-auto">

  <!-- Page Header -->
  <div class="mb-6 flex items-center justify-between flex-wrap gap-4">
    <div>
      <h1 class="text-2xl font-bold text-gray-800">Branding Management</h1>
      <p class="text-sm text-gray-500 mt-1">Manage all branding entries with images and author information.</p>
    </div>
    <a href="{{ route('brand.form') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
      <i class="fas fa-plus mr-2"></i> Create Branding
    </a>
  </div>


  <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <!-- Table Toolbar -->
    <div class="px-6 py-4 border-b border-gray-200 flex flex-wrap items-center justify-between gap-3">
      <div class="relative">
        <input type="text" id="searchInput" placeholder="Search by author or image..."
               class="pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none w-64">
        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
      </div>

    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left">
        <thead class="bg-gray-50 text-xs uppercase text-gray-600 border-b border-gray-200">
          <tr>
            <th scope="col" class="px-6 py-3 font-medium">#</th>
            <th scope="col" class="px-6 py-3 font-medium">Images</th>
            <th scope="col" class="px-6 py-3 font-medium">Author Name</th>
            <th scope="col" class="px-6 py-3 font-medium">Image Count</th>
            <th scope="col" class="px-6 py-3 font-medium">Created</th>
            <th scope="col" class="px-6 py-3 font-medium text-center">Actions</th>
          </tr>
        </thead>
        <tbody id="brandingTableBody" class="divide-y divide-gray-200">
          <!-- Dynamic rows will be inserted here -->
        </tbody>
      </table>
    </div>

    <!-- Empty State -->
    <div id="emptyState" class="text-center py-12 hidden">
      <i class="fas fa-images text-gray-300 text-5xl mb-4"></i>
      <p class="text-gray-500 text-sm mb-2">No branding entries found</p>
      <p class="text-gray-400 text-xs">Create your first branding entry by clicking the "Create Branding" button.</p>
    </div>

    <!-- Table Footer -->
    <div class="px-6 py-3 border-t border-gray-200 flex flex-wrap items-center justify-between gap-3 bg-gray-50">
      <p class="text-sm text-gray-500" id="tableInfo">Showing 0 entries</p>
      <div class="flex items-center gap-2">
        <button onclick="previousPage()" class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-100 transition disabled:opacity-50" id="prevBtn" disabled>
          <i class="fas fa-chevron-left"></i>
        </button>
        <span class="text-sm text-gray-600" id="pageInfo">Page 1 of 1</span>
        <button onclick="nextPage()" class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-100 transition disabled:opacity-50" id="nextBtn" disabled>
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-xl max-w-md w-full mx-4 p-6">
    <div class="text-center">
      <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <i class="fas fa-trash-alt text-red-600 text-2xl"></i>
      </div>
      <h3 class="text-lg font-semibold text-gray-800 mb-2">Delete Branding</h3>
      <p class="text-sm text-gray-500 mb-4">Are you sure you want to delete this branding entry? This action cannot be undone.</p>
      <p id="deleteItemName" class="text-sm font-medium text-gray-700 mb-6"></p>
      <div class="flex items-center justify-center gap-3">
        <button onclick="closeDeleteModal()" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
          Cancel
        </button>
        <button onclick="confirmDelete()" class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition">
          <i class="fas fa-trash-alt mr-1"></i> Delete
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  // Sample data store
  let brandings = [];
  let currentPage = 1;
  const itemsPerPage = 5;
  let searchTerm = '';
  let deleteId = null;

  // Initialize with sample data
  function initSampleData() {
    brandings = [
      {
        id: 1,
        images: [
          'https://via.placeholder.com/150/1',
          'https://via.placeholder.com/150/2',
          'https://via.placeholder.com/150/3'
        ],
        author_name: 'John Doe',
        created_at: '2026-01-15 10:30',
        updated_at: '2026-01-20 14:30'
      },
      {
        id: 2,
        images: [
          'https://via.placeholder.com/150/4',
          'https://via.placeholder.com/150/5'
        ],
        author_name: 'Jane Smith',
        created_at: '2026-01-18 09:15',
        updated_at: '2026-01-19 11:45'
      },
      {
        id: 3,
        images: [
          'https://via.placeholder.com/150/6',
          'https://via.placeholder.com/150/7',
          'https://via.placeholder.com/150/8',
          'https://via.placeholder.com/150/9'
        ],
        author_name: 'Mike Johnson',
        created_at: '2026-01-20 16:20',
        updated_at: '2026-01-21 08:00'
      }
    ];
    renderTable();
    updateStats();
  }

  // Render table
  function renderTable() {
    const tbody = document.getElementById('brandingTableBody');
    const emptyState = document.getElementById('emptyState');

    // Filter data
    let filteredData = brandings;
    if (searchTerm) {
      filteredData = brandings.filter(item =>
        item.author_name.toLowerCase().includes(searchTerm.toLowerCase()) ||
        item.images.some(img => img.toLowerCase().includes(searchTerm.toLowerCase()))
      );
    }

    // Pagination
    const totalItems = filteredData.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage) || 1;

    if (currentPage > totalPages) currentPage = totalPages;
    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const pageData = filteredData.slice(start, end);

    if (totalItems === 0) {
      tbody.innerHTML = '';
      emptyState.classList.remove('hidden');
      document.getElementById('tableInfo').textContent = 'Showing 0 entries';
      return;
    } else {
      emptyState.classList.add('hidden');
    }

    // Build table rows
    let html = '';
    pageData.forEach((item, index) => {
      const rowNum = start + index + 1;
      const imagePreview = item.images.slice(0, 3).map(img =>
        `<img src="${img}" alt="Branding image" class="w-10 h-10 object-cover rounded border border-gray-200">`
      ).join('');
      const extraCount = item.images.length > 3 ? `+${item.images.length - 3}` : '';

      html += `
        <tr class="hover:bg-gray-50 transition">
          <td class="px-6 py-4 text-gray-500 font-medium">${rowNum}</td>
          <td class="px-6 py-4">
            <div class="flex items-center gap-1">
              ${imagePreview}
              ${extraCount ? `<span class="text-xs text-gray-500 ml-1">${extraCount}</span>` : ''}
            </div>
          </td>
          <td class="px-6 py-4 font-medium text-gray-800">${item.author_name}</td>
          <td class="px-6 py-4">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
              ${item.images.length} images
            </span>
          </td>
          <td class="px-6 py-4 text-gray-500 text-sm">${item.created_at}</td>
          <td class="px-6 py-4 text-center">
            <div class="flex items-center justify-center gap-2">
              <a href="" class="text-indigo-600 hover:text-indigo-800 transition" title="Edit">
                <i class="fas fa-edit"></i>
              </a>
              <button onclick="openDeleteModal(${item.id}, '${item.author_name}')" class="text-red-500 hover:text-red-700 transition" title="Delete">
                <i class="fas fa-trash-alt"></i>
              </button>

            </div>
          </td>
        </tr>
      `;
    });

    tbody.innerHTML = html;
    document.getElementById('tableInfo').textContent = `Showing ${start + 1} to ${Math.min(end, totalItems)} of ${totalItems} entries`;
    document.getElementById('pageInfo').textContent = `Page ${currentPage} of ${totalPages}`;

    document.getElementById('prevBtn').disabled = currentPage <= 1;
    document.getElementById('nextBtn').disabled = currentPage >= totalPages;

    updateStats();
  }

  // Update statistics
  function updateStats() {
    document.getElementById('totalBranding').textContent = brandings.length;
    const totalImages = brandings.reduce((sum, b) => sum + b.images.length, 0);
    document.getElementById('totalImages').textContent = totalImages;
    const uniqueAuthors = new Set(brandings.map(b => b.author_name));
    document.getElementById('totalAuthors').textContent = uniqueAuthors.size;
    if (brandings.length > 0) {
      const latest = brandings.reduce((a, b) => new Date(a.updated_at) > new Date(b.updated_at) ? a : b);
      document.getElementById('lastUpdated').textContent = latest.updated_at;
    }
  }

  // View branding
  window.viewBranding = function(id) {
    const branding = brandings.find(item => item.id === id);
    if (branding) {
      alert(`Branding Details:\n\nAuthor: ${branding.author_name}\nImages: ${branding.images.length}\nCreated: ${branding.created_at}\n\nImage URLs:\n${branding.images.join('\n')}`);
    }
  };

  // Delete operations
  window.openDeleteModal = function(id, name) {
    deleteId = id;
    document.getElementById('deleteItemName').textContent = `"${name}"`;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
  };

  window.closeDeleteModal = function() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
    deleteId = null;
  };

  window.confirmDelete = function() {
    if (deleteId) {
      brandings = brandings.filter(item => item.id !== deleteId);
      renderTable();
      closeDeleteModal();
      showToast('Branding deleted successfully!', 'success');
    }
  };

  // Pagination
  window.previousPage = function() {
    if (currentPage > 1) {
      currentPage--;
      renderTable();
    }
  };

  window.nextPage = function() {
    const totalItems = brandings.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    if (currentPage < totalPages) {
      currentPage++;
      renderTable();
    }
  };

  // Search
  document.getElementById('searchInput').addEventListener('input', function(e) {
    searchTerm = e.target.value;
    currentPage = 1;
    renderTable();
  });

  // Refresh
  window.refreshTable = function() {
    renderTable();
    showToast('Table refreshed!', 'info');
  };

  // Export
  window.exportData = function() {
    const dataStr = JSON.stringify(brandings, null, 2);
    const blob = new Blob([dataStr], { type: 'application/json' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `brandings_${new Date().toISOString().split('T')[0]}.json`;
    a.click();
    URL.revokeObjectURL(url);
    showToast('Data exported successfully!', 'success');
  };

  // Toast
  function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    const colors = {
      success: 'bg-green-500',
      error: 'bg-red-500',
      info: 'bg-blue-500'
    };
    toast.className = `fixed top-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-300`;
    toast.innerHTML = `
      <div class="flex items-center gap-2">
        <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'}"></i>
        <span>${message}</span>
      </div>
    `;
    document.body.appendChild(toast);

    setTimeout(() => {
      toast.style.opacity = '0';
      setTimeout(() => toast.remove(), 300);
    }, 3000);
  }

  // Close modal on outside click
  document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
      closeDeleteModal();
    }
  });

  // Initialize
  document.addEventListener('DOMContentLoaded', function() {
    initSampleData();
  });
</script>

@endsection
