{{-- resources/views/admin/categories/index.blade.php --}}
@extends('admin.loyout.master')

@section('content')


    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}")
        </script>
    @endif
<div class="w-full max-w-6xl mx-auto bg-white shadow-2xl rounded-2xl border border-gray-200 overflow-hidden transition-all duration-200">
    {{-- Header --}}
    <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100/80 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                <span class="w-10 h-10 bg-indigo-600/10 text-indigo-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-tags text-lg"></i>
                </span>
                Categories Management
            </h2>
            <p class="text-sm text-gray-500 mt-1 ml-1">Manage your product/service categories</p>
        </div>
        <div>
            <a href="{{ route('category.form') }}"
               class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex items-center gap-2 font-medium">
                <i class="fas fa-plus-circle"></i> Add New Category
            </a>
        </div>
    </div>

    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div class="mx-8 mt-4 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg flex items-center gap-3">
            <i class="fas fa-check-circle text-green-500 text-xl"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="mx-8 mt-4 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg flex items-center gap-3">
            <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto px-6 py-4">
        @if($categories->count() > 0)
        <table class="w-full text-sm text-left text-gray-600">
            <thead class="text-xs font-semibold uppercase text-gray-500 bg-gray-50/90 rounded-xl">
                <tr>
                    <th class="px-4 py-3.5 font-semibold">#</th>
                    <th class="px-4 py-3.5 font-semibold">Category Name</th>
                    <th class="px-4 py-3.5 font-semibold">Slug</th>
                    <th class="px-4 py-3.5 font-semibold">Created At</th>
                    <th class="px-4 py-3.5 text-right font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($categories as $category)
                <tr class="hover:bg-indigo-50/40 transition-colors duration-150">
                    <td class="px-4 py-4 font-medium text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-3">
                            <span class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-indigo-600 text-white rounded-xl flex items-center justify-center text-sm font-bold shadow-sm">
                                {{ substr($category->category_name, 0, 1) }}
                            </span>
                            <span class="font-medium text-gray-800">{{ $category->category_name }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <span class="bg-gray-100 text-gray-600 px-3 py-1.5 rounded-full text-xs font-mono">
                            {{ $category->slug }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-gray-500 text-xs">
                        {{ $category->created_at->format('M d, Y H:i') }}
                    </td>
                    <td class="px-4 py-4 text-right">
                        <a href=""
                           class="text-gray-400 hover:text-indigo-600 transition-colors mr-2 inline-block">
                            <i class="fas fa-eye text-sm"></i>
                        </a>
                        <a href="{{ route('category.edit',$catrgory->id ?? 0) }}"
                           class="text-gray-400 hover:text-indigo-600 transition-colors mr-2 inline-block">
                            <i class="fas fa-pen text-sm"></i>
                        </a>
                        <form action="{{ route('category.delete',$category->id ?? 0) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors"
                                    onclick="return confirm('Are you sure you want to delete this category?')">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="text-center py-12">
            <div class="text-gray-400 text-6xl mb-4">
                <i class="fas fa-tags"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No Categories Found</h3>
            <p class="text-gray-400 mb-4">Start by adding your first category.</p>
            <a href="{{ route('category.form') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                <i class="fas fa-plus-circle mr-2"></i> Create Category
            </a>
        </div>
        @endif
    </div>

    {{-- Footer --}}
    <div class="px-8 py-3.5 bg-gray-50 border-t border-gray-200 text-xs text-gray-500 flex flex-wrap items-center justify-between gap-2">
        <span class="flex items-center gap-1.5">
            <i class="fas fa-database text-gray-400"></i>
            <span class="font-medium">Fillable:</span>
            <span class="font-mono bg-white/80 px-2 py-0.5 rounded-md text-gray-700 border border-gray-200">category_name</span>
            <span class="font-mono bg-white/80 px-2 py-0.5 rounded-md text-gray-700 border border-gray-200">slug</span>
        </span>
        <span class="flex items-center gap-2 text-indigo-600">
            <i class="fas fa-check-circle"></i>
            <span class="font-medium">Total: {{ $categories->count() }} categories</span>
        </span>
    </div>
</div>
@endsection
