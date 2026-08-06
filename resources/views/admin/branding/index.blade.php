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
                <form method="GET" action="{{ route('brand') }}" class="flex items-center gap-2">
                    <input type="text" name="search" placeholder="Search by author or image..."
                           class="pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none w-64"
                           value="{{ request('search') }}">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700 transition">Search</button>
                    @if(request('search'))
                        <a href="{{ route('brand.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300 transition">Clear</a>
                    @endif
                </form>
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
                    @forelse($brandings as $index => $branding)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-gray-500 font-medium">
                                {{ $brandings->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1">
                                    @php
                                        $images = is_array($branding->images) ? $branding->images : json_decode($branding->images, true);
                                        $imageCount = count($images);
                                        $displayImages = array_slice($images, 0, 3);
                                    @endphp
                                    @foreach($displayImages as $image)
                                        <img src="{{ asset($image) }}" alt="Branding image" class="w-10 h-10 object-cover rounded border border-gray-200">
                                    @endforeach
                                    @if($imageCount > 3)
                                        <span class="text-xs text-gray-500 ml-1">+{{ $imageCount - 3 }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $branding->author_name }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                    {{ $imageCount }} images
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-sm">{{ $branding->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('brand.edit', $branding->id) }}" class="text-indigo-600 hover:text-indigo-800 transition" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="openDeleteModal({{ $branding->id }}, '{{ $branding->author_name }}')"
                                            class="text-red-500 hover:text-red-700 transition" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12">
                                <i class="fas fa-images text-gray-300 text-5xl mb-4 block"></i>
                                <p class="text-gray-500 text-sm mb-2">No branding entries found</p>
                                <p class="text-gray-400 text-xs">Create your first branding entry by clicking the "Create Branding" button.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        <div class="px-6 py-3 border-t border-gray-200 flex flex-wrap items-center justify-between gap-3 bg-gray-50">
            <p class="text-sm text-gray-500">
                Showing {{ $brandings->firstItem() ?? 0 }} to {{ $brandings->lastItem() ?? 0 }} of {{ $brandings->total() }} entries
            </p>
            <div class="flex items-center gap-2">
                @if($brandings->hasPages())
                    {{ $brandings->links() }}
                @endif
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
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition">
                        <i class="fas fa-trash-alt mr-1"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Delete operations
    window.openDeleteModal = function(id, name) {
        document.getElementById('deleteItemName').textContent = `"${name}"`;
        document.getElementById('deleteForm').action = `/brand/${id}`;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    };

    window.closeDeleteModal = function() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    };

    // Close modal on outside click
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
</script>

@endsection
