<aside class="w-72 bg-slate-800 text-slate-200 flex-shrink-0 flex flex-col shadow-2xl">
    @php
        $dashboardRoute = null;
        $name = null;
        if (Auth::guard('super_admin')->check()) {
            $dashboardRoute = route('admin.dashboard');
            $name = 'Admin';
        }
    @endphp
    <!-- Logo -->
    <div class="p-6 flex items-center space-x-3 border-b border-slate-700/60">
        <div class="w-10 h-10 rounded-xl bg-indigo-500 flex items-center justify-center shadow-lg shadow-indigo-500/30">
            <i class="fas fa-user-doctor text-white text-xl"></i>
        </div>

        <span class="text-2xl font-bold text-white">
            {{ $name }}<span class="text-indigo-400">Panel</span>
        </span>

        <span class="ml-auto text-[10px] px-2 py-1 rounded-full bg-indigo-500/30 text-indigo-200">
            v2.0
        </span>
    </div>

    <!-- Menu -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <a href="{{ $dashboardRoute }}"
            class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-lg transition-all duration-300
            {{ request()->routeIs('doctor.dashboard') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">

            <i class="fas fa-th-large w-5 text-center"></i> <span class="font-medium">Dashboard</span>
        </a>
        @if (Auth::guard('super_admin')->check())
            <a href="{{ route('header') }}"
                class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-700 hover:text-white transition">
                <i class="fa-solid fa-window-maximize w-5"></i> <span class="font-medium">Header Management</span>
            </a>
            {{-- <a href=""
                class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-700 hover:text-white transition">
                <i class="fa-solid fa-briefcase-medical w-5"></i>
                <span class="font-medium">Services Management</span>
            </a> --}}

            <div x-data="{ open: false }">

                <button @click="open = !open"
                    class="sidebar-item w-full flex items-center justify-between gap-4 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-700 hover:text-white transition">

                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-chart-pie w-5"></i>
                        <span class="font-medium">Insights Management</span>
                    </div>

                    <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300"
                        :class="{ 'rotate-180': open }"></i>
                </button>

                <div x-show="open" x-transition class="mt-2 ml-6 space-y-2">

                    <a href="{{ route('category') }}"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg text-slate-300 hover:bg-slate-700 hover:text-white transition">

                        <i class="fa-solid fa-folder-tree text-sm"></i>
                        <span>Insight Category</span>
                    </a>

                    <a href="{{ route('post') }}"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg text-slate-300 hover:bg-slate-700 hover:text-white transition">

                        <i class="fa-solid fa-file-lines text-sm"></i>
                        <span>Insight Pages</span>
                    </a>

                </div>

            </div>

            <a href=""
                class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-700 hover:text-white transition">
                <i class="fa-solid fa-briefcase-medical w-5"></i>
                <span class="font-medium">Manage Banner</span>
            </a>

            <a href=""
                class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-700 hover:text-white transition">
                <i class="fa-solid fa-briefcase-medical w-5"></i>
                <span class="font-medium">Manage Brands</span>
            </a>
            <!-- Settings -->
            <a href="#"
                class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-700 hover:text-white transition">
                <i class="fa-solid fa-sliders w-5"></i>
                <span class="font-medium">Settings</span>
            </a>
        @endif

    </nav>

    @php
        $name = 'Guest';
        $email = '';
        $logoutRoute = null;

        if (Auth::guard('super_admin')->check()) {
            $user = Auth::guard('super_admin')->user();
            $name = $user->name ?? 'N/A';
            $email = $user->email ?? '';
            $logoutRoute = route('admin.logout');
        }
    @endphp

    <!-- User Profile -->
    <div class="p-4 border-t border-slate-700 flex items-center gap-3">

        <div
            class="w-11 h-11 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-lg">
            {{ strtoupper(substr($name, 0, 1)) }}
        </div>

        <div class="flex-1 overflow-hidden">
            <h4 class="font-semibold text-white truncate">{{ $name }}</h4>
            <p class="text-xs text-slate-400 truncate">{{ $email }}</p>
        </div>

        @if ($logoutRoute)
            <form action="{{ $logoutRoute }}" method="POST">
                @csrf
                <button
                    class="w-10 h-10 rounded-lg bg-red-500/10 hover:bg-red-600 hover:text-white text-red-400 transition duration-300">
                    <i class="fas fa-right-from-bracket"></i>
                </button>
            </form>
        @endif

    </div>

</aside>
