{{-- resources/views/admin/posts/index.blade.php --}}
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
<div class="w-full max-w-7xl mx-auto bg-white shadow-2xl rounded-2xl border border-gray-200 overflow-hidden transition-all duration-200">
    {{-- Header --}}
    <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100/80 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                <span class="w-10 h-10 bg-rose-600/10 text-rose-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-newspaper text-lg"></i>
                </span>
                Posts Management
            </h2>
            <p class="text-sm text-gray-500 mt-1 ml-1">Manage all your posts and content</p>
        </div>
        <div>
            <a href="{{ route('insight.form') }}"
               class="text-sm bg-rose-600 hover:bg-rose-700 text-white px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex items-center gap-2 font-medium">
                <i class="fas fa-plus-circle"></i> Add New Post
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
        @if($posts->count() > 0)
        <table class="w-full text-sm text-left text-gray-600">
            <thead class="text-xs font-semibold uppercase text-gray-500 bg-gray-50/90 rounded-xl">
                <tr>
                    <th class="px-4 py-3.5 font-semibold">#</th>
                    <th class="px-4 py-3.5 font-semibold">Image</th>
                    <th class="px-4 py-3.5 font-semibold">Heading</th>
                    <th class="px-4 py-3.5 font-semibold">Category</th>
                    <th class="px-4 py-3.5 font-semibold">Created By</th>
                    <th class="px-4 py-3.5 font-semibold">Date</th>
                    <th class="px-4 py-3.5 text-right font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($posts as $post)
                <tr class="hover:bg-rose-50/40 transition-colors duration-150">
                    <td class="px-4 py-4 font-medium text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-4 py-4">
                        @if($post->image)
                            <img src="{{ asset($post->image) }}"
                                 alt="{{ $post->heading }}"
                                 class="w-12 h-12 rounded-xl object-cover border border-gray-200 shadow-sm">
                        @else
                            <span class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 border border-gray-200">
                                <i class="fas fa-image"></i>
                            </span>
                        @endif
                    </td>
                    <td class="px-4 py-4">
                        <span class="font-medium text-gray-800">{{ Str::limit($post->heading, 30) }}</span>
                        @if($post->paragraph)
                            <p class="text-xs text-gray-400 mt-0.5">{{ Str::limit($post->paragraph, 40) }}</p>
                        @endif
                    </td>
                    <td class="px-4 py-4">
                        @if($post->category)
                            <span class="bg-indigo-100 text-indigo-700 px-3 py-1.5 rounded-full text-xs font-semibold">
                                {{ $post->category->category_name ?? 'N/A' }}
                            </span>
                        @else
                            <span class="text-gray-400 text-xs">Uncategorized</span>
                        @endif
                    </td>
                    <td class="px-4 py-4">
                        <span class="text-gray-600">{{ $post->created_by ?? 'N/A' }}</span>
                    </td>
                    <td class="px-4 py-4">
                        @if($post->date)
                            <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($post->date)->format('M d, Y')  }}</span>
                        @else
                            <span class="text-gray-400 text-xs">N/A</span>
                        @endif
                    </td>
                    <td class="px-4 py-4 text-right">
                        <a href=""
                           class="text-gray-400 hover:text-rose-600 transition-colors mr-2 inline-block">
                            <i class="fas fa-eye text-sm"></i>
                        </a>
                        <a href="{{ route('insight.edit', $post) }}"
                           class="text-gray-400 hover:text-rose-600 transition-colors mr-2 inline-block">
                            <i class="fas fa-pen text-sm"></i>
                        </a>
                        <form action="{{ route('insight.delete', $post) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors"
                                    onclick="return confirm('Are you sure you want to delete this post?')">
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
                <i class="fas fa-newspaper"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No Posts Found</h3>
            <p class="text-gray-400 mb-4">Start by adding your first post.</p>
            <a href="{{ route('insight.form') }}" class="inline-block bg-rose-600 hover:bg-rose-700 text-white px-6 py-2.5 rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                <i class="fas fa-plus-circle mr-2"></i> Create Post
            </a>
        </div>
        @endif
    </div>

    {{-- Footer --}}
    <div class="px-8 py-3.5 bg-gray-50 border-t border-gray-200 text-xs text-gray-500 flex flex-wrap items-center justify-between gap-2">
        <span class="flex items-center gap-1.5">
            <i class="fas fa-database text-gray-400"></i>
            <span class="font-medium">Fillable:</span>
            <span class="font-mono bg-white/80 px-2 py-0.5 rounded-md text-gray-700 border border-gray-200">heading</span>
            <span class="font-mono bg-white/80 px-2 py-0.5 rounded-md text-gray-700 border border-gray-200">paragraph</span>
            <span class="font-mono bg-white/80 px-2 py-0.5 rounded-md text-gray-700 border border-gray-200">image</span>
            <span class="font-mono bg-white/80 px-2 py-0.5 rounded-md text-gray-700 border border-gray-200">description</span>
            <span class="font-mono bg-white/80 px-2 py-0.5 rounded-md text-gray-700 border border-gray-200">created_by</span>
            <span class="font-mono bg-white/80 px-2 py-0.5 rounded-md text-gray-700 border border-gray-200">note</span>
            <span class="font-mono bg-white/80 px-2 py-0.5 rounded-md text-gray-700 border border-gray-200">date</span>
            <span class="font-mono bg-white/80 px-2 py-0.5 rounded-md text-gray-700 border border-gray-200">cat_id</span>
        </span>
        <span class="flex items-center gap-2 text-rose-600">
            <i class="fas fa-check-circle"></i>
            <span class="font-medium">Total: {{ $posts->count() }} posts</span>
        </span>
    </div>
</div>
@endsection
