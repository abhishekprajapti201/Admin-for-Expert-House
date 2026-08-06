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
<div class="max-w-3xl mx-auto">

  <!-- page header -->
  <div class="mb-6 flex items-center justify-between">
    <div>
      <h1 class="text-2xl font-bold text-gray-800">Edit Branding</h1>
      <p class="text-sm text-gray-500 mt-1">Update branding images and author information.</p>
    </div>
    <div class="flex items-center gap-3">
      <a href="{{ route('branding.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">
        <i class="fas fa-arrow-left mr-2"></i> Back to List
      </a>
      <a href="{{ route('branding.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition">
        <i class="fas fa-plus mr-2"></i> Add New
      </a>
    </div>
  </div>

  <!-- Edit Form -->
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">

    <!-- Branding ID / Info -->
    <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
      <div class="flex items-center gap-3">
        <span class="text-sm text-gray-500">Branding ID: #<span id="brandingId">1</span></span>
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
          <i class="fas fa-circle text-[6px] mr-1.5"></i>
          Active
        </span>
      </div>
      <span class="text-xs text-gray-400">Last updated: <span id="lastUpdated">2026-01-15 14:30</span></span>
    </div>

    <form id="editBrandingForm" onsubmit="return handleUpdate(event)" class="space-y-6">

      <!-- Images Field (Array) -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
          <i class="fas fa-images text-gray-400 mr-1"></i> Images <span class="text-red-500">*</span>
        </label>

        <!-- Image Upload Area -->
        <div id="dropzone" class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-indigo-500 transition cursor-pointer">
          <input type="file" id="imageInput" accept="image/*" multiple class="hidden">
          <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
          <p class="text-gray-600 text-sm">Drag & drop images here or click to browse</p>
          <p class="text-gray-400 text-xs mt-1">Supports JPG, PNG, GIF up to 5MB</p>
        </div>

        <!-- Image Preview Grid -->
        <div id="imagePreviewGrid" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
          <!-- Dynamic image previews will be inserted here -->
        </div>

        <!-- Hidden input to store image URLs -->
        <input type="hidden" id="images" name="images" value="">
        <p class="mt-1 text-xs text-gray-400">Upload at least one image for the branding.</p>
      </div>

      <!-- Author Name Field -->
      <div>
        <label for="author_name" class="block text-sm font-medium text-gray-700 mb-1">
          <i class="fas fa-user text-gray-400 mr-1"></i> Author Name <span class="text-red-500">*</span>
        </label>
        <input type="text" id="author_name" name="author_name"
               class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition outline-none"
               placeholder="e.g. John Doe"
               required>
      </div>

      <!-- Created At (Read-only) -->
      <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
          <div>
            <span class="text-gray-500">Created:</span>
            <span class="text-gray-700 font-medium ml-2" id="createdAt">2026-01-15 10:30</span>
          </div>
          <div>
            <span class="text-gray-500">Last Modified:</span>
            <span class="text-gray-700 font-medium ml-2" id="modifiedAt">2026-01-20 14:30</span>
          </div>
        </div>
      </div>

      <!-- action buttons -->
      <div class="pt-4 flex flex-wrap items-center justify-between gap-3 border-t border-gray-200">
        <div class="flex items-center gap-3">
          <button type="reset" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
            <i class="fas fa-undo-alt mr-1"></i> Reset
          </button>
          <button type="button" onclick="viewBranding()" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
            <i class="fas fa-eye mr-1"></i> View All Images
          </button>
        </div>
        <div class="flex items-center gap-3">
          <button type="button" onclick="deleteBranding()" class="px-5 py-2.5 text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition">
            <i class="fas fa-trash-alt mr-1"></i> Delete
          </button>
          <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-sm transition flex items-center">
            <i class="fas fa-save mr-1.5"></i> Update Branding
          </button>
        </div>
      </div>

    </form>

    <!-- feedback message -->
    <div id="formFeedback" class="mt-4 hidden"></div>

  </div>

  <!-- View Images Modal -->
  <div id="viewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl max-w-3xl w-full mx-4 p-6">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-800">All Images</h3>
        <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600">
          <i class="fas fa-times text-xl"></i>
        </button>
      </div>
      <div id="viewImagesGrid" class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <!-- Images will be displayed here -->
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
