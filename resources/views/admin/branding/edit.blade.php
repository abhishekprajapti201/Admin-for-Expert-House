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
            toastr.success("{{ session('success') }}");
        </script>
    @endif

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Header -->
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Branding</h1>
                <p class="text-sm text-gray-500 mt-1">Update branding information and images.</p>
            </div>
            <a href="{{ route('brand') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Back to List
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form action="{{ route('brand.update', $branding->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Existing Images Display -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Current Images
                    </label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @php
                            $images = is_array($branding->images) ? $branding->images : json_decode($branding->images, true);
                        @endphp
                        @foreach($images as $index => $image)
                            <div class="relative group">
                                <img src="{{ asset($image) }}"
                                     alt="Branding image {{ $index + 1 }}"
                                     class="w-full h-24 object-cover rounded-lg border border-gray-200">
                                <button type="button"
                                        onclick="removeImage({{ $branding->id }},{{ $index }})"
                                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600 transition opacity-0 group-hover:opacity-100">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <!-- Hidden input to store removed image indices -->
                    <input type="hidden" name="removed_images" id="removedImages" value="[]">
                </div>

                <!-- Upload New Images -->
                <div class="mb-6">
                    <label for="images" class="block text-sm font-medium text-gray-700 mb-2">
                        Add New Images
                    </label>
                    <input type="file" name="images[]" id="images" multiple accept="image/*"
                        class="block w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('images') border-red-500 @enderror">
                    <p class="text-xs text-gray-500 mt-1">You can select multiple images. Existing images will be preserved.</p>

                    @error('images')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                    @error('images.*')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Author Name Field -->
                <div class="mb-6">
                    <label for="author_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Author Name
                    </label>
                    <input type="text" name="author_name" id="author_name"
                           value="{{ old('author_name', $branding->author_name) }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('author_name') border-red-500 @enderror">

                    @error('author_name')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-3 rounded-lg transition-colors duration-200 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Update Branding
                </button>
            </form>
        </div>
    </div>

    <script>

        function removeImage(id,index) {
            $.ajax({
                url:"{{ url('/admin/delete/image/') }}/"+ id + "/" + index,
                type:"GET",
                success:function(response){
                    console.log(response);
                    window.location.reload();
                },
                error:function(error){
                    console.log(error);
                }

            });
        }
    </script>
@endsection
