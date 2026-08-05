{{-- resources/views/admin/posts/edit.blade.php --}}
@extends('admin.layout.master')

@section('content')
<div class="w-full max-w-5xl mx-auto bg-white shadow-2xl rounded-2xl border border-gray-200 overflow-hidden">
    <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100/80">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
            <span class="w-10 h-10 bg-yellow-600/10 text-yellow-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-edit text-lg"></i>
            </span>
            Edit Post
        </h2>
        <p class="text-sm text-gray-500 mt-1 ml-1">Update post information</p>
    </div>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="px-8 py-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Heading -->
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">
                    Heading <span class="text-red-500">*</span>
                </label>
                <input type="text" name="heading" value="{{ old('heading', $post->heading) }}"
                       placeholder="Enter heading"
                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-rose-200 focus:border-rose-500 outline-none transition-all bg-white shadow-sm @error('heading') border-red-500 @enderror" />
                @error('heading')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">
                    Category
                </label>
                <select name="cat_id"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-rose-200 focus:border-rose-500 outline-none transition-all bg-white shadow-sm @error('cat_id') border-red-500 @enderror">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('cat_id', $post->cat_id) == $category->id ? 'selected' : '' }}>
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
                    Image
                </label>
                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <input type="file" name="image" accept="image/*"
                               class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-rose-200 focus:border-rose-500 outline-none transition-all bg-white shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100 @error('image') border-red-500 @enderror" />
                        <p class="text-xs text-gray-400 mt-1">Leave empty to keep current image</p>
                    </div>
                    @if($post->image && file_exists(public_path('uploads/posts/' . $post->image)))
                        <div class="w-16 h-16 rounded-xl border-2 border-gray-200 overflow-hidden bg-gray-50 flex-shrink-0">
                            <img src="{{ asset('uploads/posts/' . $post->image) }}"
                                 alt="Current image"
                                 class="w-full h-full object-cover">
                        </div>
                    @endif
                </div>
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date -->
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">
                    Date
                </label>
                <input type="date" name="date" value="{{ old('date', $post->date ? $post->date->format('Y-m-d') : '') }}"
                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-rose-200 focus:border-rose-500 outline-none transition-all bg-white shadow-sm @error('date') border-red-500 @enderror" />
                @error('date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Created By -->
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">
                    Created By
                </label>
                <input type="text" name="created_by" value="{{ old('created_by', $post->created_by) }}"
                       placeholder="Author name"
                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-rose-200 focus:border-rose-500 outline-none transition-all bg-white shadow-sm @error('created_by') border-red-500 @enderror" />
                @error('created_by')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Note -->
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">
                    Note
                </label>
                <input type="text" name="note" value="{{ old('note', $post->note) }}"
                       placeholder="Additional notes"
                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-rose-200 focus:border-rose-500 outline-none transition-all bg-white shadow-sm @error('note') border-red-500 @enderror" />
                @error('note')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Paragraph -->
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">
                    Paragraph
                </label>
                <textarea name="paragraph" rows="3"
                          placeholder="Enter paragraph text"
                          class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-rose-200 focus:border-rose-500 outline-none transition-all bg-white shadow-sm @error('paragraph') border-red-500 @enderror">{{ old('paragraph', $post->paragraph) }}</textarea>
                @error('paragraph')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">
                    Description
                </label>
                <textarea name="description" rows="3"
                          placeholder="Enter description"
                          class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-rose-200 focus:border-rose-500 outline-none transition-all bg-white shadow-sm @error('description') border-red-500 @enderror">{{ old('description', $post->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200/80 mt-6">
            <a href="{{ route('admin.posts.index') }}"
               class="px-6 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-xl transition-all">
                Cancel
            </a>
            <button type="submit" class="px-7 py-2.5 bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex items-center gap-2">
                <i class="fas fa-save"></i> Update Post
            </button>
        </div>
    </form>
</div>
@endsection
