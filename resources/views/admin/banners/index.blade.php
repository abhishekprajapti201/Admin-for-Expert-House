@extends('admin.loyout.master')
@section('content')
 @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}")
        </script>
    @endif
    <div class="max-w-7xl mx-auto">

        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Banner Management</h1>
                <p class="text-sm text-gray-500 mt-1">Manage all your banners from this dashboard.</p>
            </div>
            <a href="{{ route('banner.form') }}"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                <i class="fas fa-plus mr-2"></i> Add New Banner
            </a>
        </div>

        <!-- Banners Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Table Toolbar -->
            <div class="px-6 py-4 border-b border-gray-200 flex flex-wrap items-center justify-between gap-3">

                <div class="flex items-center gap-2">

                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-600 border-b border-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">
                                <input type="checkbox" id="selectAll" onchange="toggleAll(this)">
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">#</th>
                            <th scope="col" class="px-6 py-3 font-medium">Video URL</th>
                            <th scope="col" class="px-6 py-3 font-medium">Heading</th>
                            <th scope="col" class="px-6 py-3 font-medium">First Button</th>
                            <th scope="col" class="px-6 py-3 font-medium">Second Button</th>

                            <th scope="col" class="px-6 py-3 font-medium text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="bannerTableBody" class="divide-y divide-gray-200">
                        @forelse ($banners as $banner)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <input type="checkbox">
                                </td>

                                <td class="px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4">
                                    @if ($banner->video_url)
                                        <video width="150" height="80" controls class="rounded-lg">
                                            <source src="{{ asset($banner->video_url) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @else
                                        <span class="text-red-500">No Video</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    {{ $banner->heading }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $banner->first_button }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $banner->second_button }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('banner.edit', $banner->id) }}"
                                        class="text-blue-600 hover:text-blue-800 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('banner.delete', $banner->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-6 text-gray-500">
                                    No Banner Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="text-center py-12 hidden">
                <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                <p class="text-gray-500 text-sm mb-2">No banners found</p>
                <p class="text-gray-400 text-xs">Create your first banner by clicking the "Add New Banner" button.</p>
            </div>


        </div>
    </div>
@endsection
