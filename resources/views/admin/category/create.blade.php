{{-- resources/views/admin/categories/create.blade.php --}}
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
<div class="w-full max-w-3xl mx-auto bg-white shadow-2xl rounded-2xl border border-gray-200 overflow-hidden">
    <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100/80">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
            <span class="w-10 h-10 bg-green-600/10 text-green-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-plus-circle text-lg"></i>
            </span>
            Create New Category
        </h2>
        <p class="text-sm text-gray-500 mt-1 ml-1">Add a new category to your system</p>
    </div>

    <form action="{{ route('category.store') }}" method="POST" class="px-8 py-6">
        @csrf

        <div class="space-y-5">
            <!-- Category Name -->
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">
                    Category Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="category_name" value="{{ old('category_name') }}"
                       placeholder="Enter category name"
                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none transition-all bg-white shadow-sm @error('category_name') border-red-500 @enderror" />
                @error('category_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Slug -->
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">
                    Slug <span class="text-gray-400 font-normal">(optional - auto-generated)</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-link text-gray-400 text-sm"></i>
                    </div>
                    <input type="text" name="slug" value="{{ old('slug') }}"
                           placeholder="e.g., my-category-slug"
                           class="w-full border border-gray-300 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none transition-all bg-white shadow-sm @error('slug') border-red-500 @enderror" />
                </div>
                <p class="text-xs text-gray-400 mt-1">Leave empty to auto-generate from category name</p>
                @error('slug')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200/80 mt-6">
            <a href="{{ route('category') }}"
               class="px-6 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-xl transition-all">
                Cancel
            </a>
            <button type="submit" class="px-7 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex items-center gap-2">
                <i class="fas fa-save"></i> Create Category
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const name = document.querySelector("input[name='category_name']");
    const slug = document.querySelector("input[name='slug']");

    function makeSlug(text) {
        return text
            .toLowerCase()
            .trim()
            .replace(/\s+/g, "-")
            .replace(/[^\w\-]+/g, "")
            .replace(/\-\-+/g, "-");
    }

    name.addEventListener("input", function () {
        if (!slug.dataset.edited) {
            slug.value = makeSlug(this.value);
        }
    });

    slug.addEventListener("input", function () {
        this.dataset.edited = "true";
    });

});
</script>
@endsection
