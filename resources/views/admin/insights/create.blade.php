{{-- resources/views/admin/posts/create.blade.php --}}
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
    <style>
        /* Modern CKEditor Styling */
        .ck-editor__editable {
            min-height: 250px !important;
            border-radius: 12px !important;
            border: 2px solid #e5e7eb !important;
            transition: all 0.3s ease !important;
            background: #fafbfc !important;
        }

        .ck-editor__editable:focus {
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1) !important;
            background: white !important;
        }

        .ck-editor__top {
            border-radius: 12px 12px 0 0 !important;
        }

        .ck-editor__bottom {
            border-radius: 0 0 12px 12px !important;
        }

        .ck-toolbar {
            border-radius: 12px 12px 0 0 !important;
            background: #f8fafc !important;
            border-bottom: 2px solid #e5e7eb !important;
            padding: 8px 12px !important;
        }

        .ck-toolbar .ck-button {
            border-radius: 6px !important;
            transition: all 0.2s ease !important;
        }

        .ck-toolbar .ck-button:hover {
            background: #eef2ff !important;
            color: #6366f1 !important;
        }

        .ck-toolbar .ck-button.ck-on {
            background: #6366f1 !important;
            color: white !important;
        }

        .ck-editor-wrapper {
            position: relative;
        }

        /* Loading state */
        .ck-editor-wrapper .ck-editor {
            opacity: 0;
            animation: fadeIn 0.5s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="w-full max-w-7xl mx-auto bg-white shadow-2xl rounded-2xl border border-gray-200 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-purple-50/80">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                <span class="w-10 h-10 bg-indigo-600/10 text-indigo-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-pen-fancy text-lg"></i>
                </span>
                Create New Post
            </h2>
            <p class="text-sm text-gray-500 mt-1 ml-1">Fill in the details to create a new post</p>
        </div>

        <form action="{{ route('insight.store') }}" method="POST" enctype="multipart/form-data" class="px-8 py-6" id="postForm">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-5">
                    <!-- Heading -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">
                            Heading <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="heading" value="{{ old('heading') }}" placeholder="Enter post heading"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none transition-all bg-white shadow-sm @error('heading') border-red-500 @enderror" />
                        @error('heading')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select name="cat_id"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none transition-all bg-white shadow-sm @error('cat_id') border-red-500 @enderror">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('cat_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('cat_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">
                            Featured Image
                        </label>
                        <div class="relative">
                            <input type="file" name="image" accept="image/*"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none transition-all bg-white shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('image') border-red-500 @enderror" />
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Supported: JPG, PNG, GIF, WebP (Max 2MB)</p>
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-5">
                    <!-- Date -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">
                            Publish Date
                        </label>
                        <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none transition-all bg-white shadow-sm @error('date') border-red-500 @enderror" />
                        @error('date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Created By -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">
                            Author Name
                        </label>
                        <input type="text" name="created_by" value="{{ old('created_by', auth()->user()->name ?? '') }}"
                            placeholder="Enter author name"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none transition-all bg-white shadow-sm @error('created_by') border-red-500 @enderror" />
                        @error('created_by')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Note -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">
                            Additional Note
                        </label>
                        <input type="text" name="note" value="{{ old('note') }}" placeholder="Any additional notes"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none transition-all bg-white shadow-sm @error('note') border-red-500 @enderror" />
                        @error('note')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Paragraph with CKEditor -->
            <div class="mt-6">
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">
                    Paragraph Content <span class="text-red-500">*</span>
                </label>
                <div class="ckeditor-wrapper">
                    <textarea name="paragraph" id="paragraph" rows="8" placeholder="Write your paragraph content here..."
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none transition-all bg-white shadow-sm @error('paragraph') border-red-500 @enderror">{{ old('paragraph') }}</textarea>
                </div>
                @error('paragraph')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description with CKEditor -->
            <div class="mt-6">
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">
                    Description <span class="text-red-500">*</span>
                </label>
                <div class="ckeditor-wrapper">
                    <textarea name="description" id="description" rows="8" placeholder="Write your description here..."
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 outline-none transition-all bg-white shadow-sm @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200/80 mt-8">
                <a href="{{ route('post') }}"
                    class="px-6 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-xl transition-all duration-200">
                    <i class="fas fa-times mr-2"></i> Cancel
                </a>
                <button type="submit"
                    class="px-7 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white text-sm font-medium rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-save"></i> Create Post
                </button>
            </div>
        </form>
    </div>


    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            function initEditor(selector) {
                const element = document.querySelector(selector);

                if (!element) {
                    console.error(selector + " not found");
                    return;
                }

                ClassicEditor.create(element, {
                        toolbar: [
                            'heading',
                            '|',
                            'bold',
                            'italic',
                            'underline',
                            '|',
                            'bulletedList',
                            'numberedList',
                            '|',
                            'link',
                            'blockQuote',
                            'insertTable',
                            '|',
                            'undo',
                            'redo'
                        ]
                    })
                    .then(editor => {
                        console.log(selector + " initialized");
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }

            initEditor('#paragraph');
            initEditor('#description');

        });
    </script>
@endsection
