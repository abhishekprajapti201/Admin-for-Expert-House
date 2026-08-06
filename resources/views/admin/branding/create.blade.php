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
      <h1 class="text-2xl font-bold text-gray-800">Create Branding</h1>
      <p class="text-sm text-gray-500 mt-1">Add new branding with images and author information.</p>
    </div>
    <a href="{{ route('brand') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">
      <i class="fas fa-arrow-left mr-2"></i> Back to List
    </a>
  </div>

  <!-- form card -->
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">

    <form id="brandingForm" onsubmit="return handleSubmit(event)" class="space-y-6">

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

        <!-- Hidden input to store image URLs (comma separated) -->
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

      <!-- Preview Helper -->
      <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 flex items-center gap-3 text-sm text-gray-500">
        <i class="fas fa-info-circle text-indigo-400"></i>
        <span>Images will be stored as an array. Author name is required.</span>
      </div>

      <!-- action buttons -->
      <div class="pt-4 flex flex-wrap items-center justify-between gap-3 border-t border-gray-200">
        <button type="reset" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
          <i class="fas fa-undo-alt mr-1"></i> Reset
        </button>
        <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-sm transition flex items-center">
          <i class="fas fa-save mr-1.5"></i> Create Branding
        </button>
      </div>

    </form>

    <!-- feedback message -->
    <div id="formFeedback" class="mt-4 hidden"></div>

  </div>

</div>

<script>
  let uploadedImages = [];

  // Handle image upload
  document.getElementById('dropzone').addEventListener('click', function() {
    document.getElementById('imageInput').click();
  });

  document.getElementById('imageInput').addEventListener('change', function(e) {
    const files = Array.from(e.target.files);
    handleFiles(files);
    this.value = ''; // Reset input
  });

  // Drag and drop
  const dropzone = document.getElementById('dropzone');
  dropzone.addEventListener('dragover', function(e) {
    e.preventDefault();
    this.classList.add('border-indigo-500', 'bg-indigo-50');
  });

  dropzone.addEventListener('dragleave', function(e) {
    e.preventDefault();
    this.classList.remove('border-indigo-500', 'bg-indigo-50');
  });

  dropzone.addEventListener('drop', function(e) {
    e.preventDefault();
    this.classList.remove('border-indigo-500', 'bg-indigo-50');
    const files = Array.from(e.dataTransfer.files);
    handleFiles(files);
  });

  // Handle file processing
  function handleFiles(files) {
    files.forEach(file => {
      if (!file.type.startsWith('image/')) {
        showFeedback('Please upload only image files.', 'red');
        return;
      }

      // Simulate upload - in real scenario, you'd upload to server
      const reader = new FileReader();
      reader.onload = function(e) {
        const imageUrl = e.target.result;
        uploadedImages.push(imageUrl);
        renderImagePreviews();
        updateHiddenInput();
      };
      reader.readAsDataURL(file);
    });
  }

  // Render image previews
  function renderImagePreviews() {
    const grid = document.getElementById('imagePreviewGrid');
    if (uploadedImages.length === 0) {
      grid.innerHTML = '';
      return;
    }

    grid.innerHTML = uploadedImages.map((url, index) => `
      <div class="relative group">
        <img src="${url}" alt="Branding image ${index + 1}" class="w-full h-32 object-cover rounded-lg border border-gray-200">
        <button onclick="removeImage(${index})"
                class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs shadow-md transition group-hover:scale-110">
          <i class="fas fa-times"></i>
        </button>
        <span class="absolute bottom-2 left-2 bg-black bg-opacity-50 text-white text-xs px-2 py-0.5 rounded">
          ${index + 1}
        </span>
      </div>
    `).join('');
  }

  // Remove image
  window.removeImage = function(index) {
    uploadedImages.splice(index, 1);
    renderImagePreviews();
    updateHiddenInput();
  };

  // Update hidden input with image URLs
  function updateHiddenInput() {
    document.getElementById('images').value = uploadedImages.join(',');
  }

  // Handle form submission
  window.handleSubmit = function(event) {
    event.preventDefault();

    const images = document.getElementById('images').value;
    const author_name = document.getElementById('author_name').value.trim();

    // Validate
    if (!images) {
      showFeedback('Please upload at least one image.', 'red');
      return false;
    }

    if (!author_name) {
      showFeedback('Please enter the author name.', 'red');
      return false;
    }

    // Prepare data
    const formData = {
      images: images.split(','),
      author_name: author_name
    };

    // Show success feedback
    showFeedback(`Branding created successfully! Author: ${author_name}`, 'green');

    // Log the data
    console.log('📦 Branding created:', formData);

    // Reset form after 2 seconds
    setTimeout(() => {
      document.getElementById('brandingForm').reset();
      uploadedImages = [];
      renderImagePreviews();
      updateHiddenInput();
    }, 2000);

    return false;
  };

  // Show feedback message
  function showFeedback(message, type = 'green') {
    const feedback = document.getElementById('formFeedback');
    feedback.classList.remove('hidden');

    const colors = {
      green: 'bg-emerald-50 border-emerald-200 text-emerald-700',
      red: 'bg-red-50 border-red-200 text-red-700',
      blue: 'bg-blue-50 border-blue-200 text-blue-700'
    };

    feedback.className = `mt-4 p-4 border rounded-lg text-sm flex items-start gap-3 ${colors[type] || colors.green}`;
    feedback.innerHTML = `
      <i class="fas ${type === 'green' ? 'fa-check-circle' : type === 'red' ? 'fa-exclamation-circle' : 'fa-info-circle'} mt-0.5"></i>
      <div>
        <strong class="font-medium">${message}</strong>
      </div>
    `;

    setTimeout(() => {
      feedback.classList.add('hidden');
    }, 3000);
  }
</script>

@endsection
