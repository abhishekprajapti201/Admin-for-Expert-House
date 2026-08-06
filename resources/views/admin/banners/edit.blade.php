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
      <h1 class="text-2xl font-bold text-gray-800">Add new banner</h1>
      <p class="text-sm text-gray-500 mt-1">Fill in the fields below to create a new banner slide.</p>
    </div>

  </div>

  <!-- form card with all fields: video_url, heading, first_button, second_button -->
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">

    <form action="{{ route('banner.update',$banner->id) }}" method="POST" onsubmit="return handleSubmit(event)" class="space-y-6">
@csrf
      <!-- video_url field -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
 <div>
        <label for="video_url" class="block text-sm font-medium text-gray-700 mb-1">
          <i class="fas fa-link text-gray-400 mr-1"></i> Video URL
        </label>
        <div>

          <input type="file" id="video_url" name="video_url" value="{{ old('video_url',$banner->video_url ?? "") }}"
                 class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition outline-none"
                >
                <p>
                    <img src="{{ asset($banner->video_url ?? "") }}" alt="" width="100">
                </p>
        </div>
      </div>

       <div>
        <label for="video_url" class="block text-sm font-medium text-gray-700 mb-1">
          <i class="fas fa-link text-gray-400 mr-1"></i> Video URL
        </label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-play-circle text-gray-400"></i>
          </div>
          <input type="url" id="video_url" name="video_url" value="{{ old('video_url',$banner->video_url) }}"
                 class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition outline-none"
                 placeholder="https://www.youtube.com/embed/..."
                 value="https://www.youtube.com/embed/dQw4w9WgXcQ">
        </div>
        <p class="mt-1 text-xs text-gray-400">Supports YouTube, Vimeo or direct video link.</p>
      </div>
      </div>


      <!-- heading field -->
      <div>
        <label for="heading" class="block text-sm font-medium text-gray-700 mb-1">
          <i class="fas fa-heading text-gray-400 mr-1"></i> Heading
        </label>
        <input type="text" id="heading" name="heading" value="{{ old('heading',$banner->heading ?? "") }}"
               class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition outline-none"
               placeholder="e.g. Summer collection 2026"
              >
      </div>

      <!-- first_button & second_button (side by side on md+) -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="first_button" class="block text-sm font-medium text-gray-700 mb-1">
            <i class="fas fa-circle text-gray-400 mr-1"></i> First button
          </label>
          <input type="text" id="first_button" name="first_button" value="{{ old('first_button',$banner->first_button ?? "") }}"
                 class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition outline-none"
                 placeholder="Label / link"
                 >
        </div>
        <div>
          <label for="second_button" class="block text-sm font-medium text-gray-700 mb-1">
            <i class="fas fa-circle text-gray-400 mr-1"></i> Second button
          </label>
          <input type="text" id="second_button" name="second_button" value="{{ old('second_button',$banner->second_button ?? "") }}"
                 class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition outline-none"
                 placeholder="Label / link"
                 >
        </div>
      </div>

      <!-- preview / helper (static) -->
      <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 flex items-center gap-3 text-sm text-gray-500">
        <i class="fas fa-info-circle text-indigo-400"></i>
        <span>All fields are ready. The banner will appear on the homepage.</span>
      </div>


          <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-sm transition flex items-center">
            <i class="fas fa-save mr-1.5"></i> Update banner
          </button>
        </div>
      </div>

    </form>

    <!-- mock "submitted" alert (js only) -->
    <div id="formFeedback" class="mt-4 hidden"></div>

  </div>

  <!-- extra hint: fields list -->
  <div class="mt-4 text-xs text-gray-400 flex flex-wrap gap-x-4 gap-y-1">
    <span><span class="font-mono bg-gray-100 px-1.5 py-0.5 rounded">video_url</span></span>
    <span><span class="font-mono bg-gray-100 px-1.5 py-0.5 rounded">heading</span></span>
    <span><span class="font-mono bg-gray-100 px-1.5 py-0.5 rounded">first_button</span></span>
    <span><span class="font-mono bg-gray-100 px-1.5 py-0.5 rounded">second_button</span></span>
  </div>
</div>

<!-- minimal JavaScript: handle submit & reset feedback (no custom css) -->
<script>
  (function() {
    const form = document.getElementById('bannerForm');
    const feedback = document.getElementById('formFeedback');

    // Reset feedback when reset is clicked
    form.addEventListener('reset', function(e) {
      setTimeout(() => {
        feedback.classList.add('hidden');
        feedback.innerHTML = '';
      }, 50);
    });

    // Expose handleSubmit globally
    window.handleSubmit = function(event) {
      event.preventDefault();

      // gather values
      const video_url = document.getElementById('video_url').value.trim();
      const heading = document.getElementById('heading').value.trim();
      const first_button = document.getElementById('first_button').value.trim();
      const second_button = document.getElementById('second_button').value.trim();

      // show feedback card (success)
      feedback.classList.remove('hidden');
      feedback.className = 'mt-4 p-4 bg-emerald-50 border border-emerald-200 rounded-lg text-emerald-700 text-sm flex items-start gap-3';
      feedback.innerHTML = `
        <i class="fas fa-check-circle text-emerald-500 mt-0.5"></i>
        <div>
          <strong class="font-medium">Banner draft saved</strong>
          <div class="mt-1 space-y-0.5 text-emerald-600/90">
            <div><span class="font-mono bg-emerald-100/60 px-1.5 py-0.5 rounded text-xs">video_url</span> ${video_url || '—'}</div>
            <div><span class="font-mono bg-emerald-100/60 px-1.5 py-0.5 rounded text-xs">heading</span> ${heading || '—'}</div>
            <div><span class="font-mono bg-emerald-100/60 px-1.5 py-0.5 rounded text-xs">first_button</span> ${first_button || '—'}</div>
            <div><span class="font-mono bg-emerald-100/60 px-1.5 py-0.5 rounded text-xs">second_button</span> ${second_button || '—'}</div>
          </div>
          <p class="mt-1 text-xs text-emerald-600">(simulated — ready to send to server)</p>
        </div>
      `;

      // scroll feedback into view
      feedback.scrollIntoView({ behavior: 'smooth', block: 'center' });

      // console.log the payload
      console.log('📦 Banner payload:', { video_url, heading, first_button, second_button });

      return false;
    };
  })();
</script>

@endsection
