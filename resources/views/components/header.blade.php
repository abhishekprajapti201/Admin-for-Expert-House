<header class="fixed top-4 left-1/2 transform -translate-x-1/2 w-11/12 z-50">
    <div class="backdrop-blur-xl bg-white/90 border border-emerald-100 shadow-lg rounded-full">
        <div class="max-w-7xl mx-auto flex items-center justify-between px-5 py-3">
            <a href="{{ url('/') }}" class="flex items-center gap-3 min-w-0">
                <div class="w-11 h-11 rounded-full flex items-center justify-center text-white font-extrabold shrink-0"
                    style="background: linear-gradient(135deg, var(--color-primary), var(--color-blue));">
                    R
                </div>
                <div class="leading-tight min-w-0">
                    <p class="text-sm font-extrabold truncate" style="color: var(--color-dark);">RCDHO</p>
                    <p class="text-xs text-gray-500 truncate">DrMukherjeeS Clinic Pvt. Ltd.</p>
                </div>
            </a>

            <nav class="hidden md:flex items-center gap-7 text-sm font-semibold">
                <a href="{{ url('/') }}" class="transition {{ request()->is('/') ? 'text-emerald-700' : 'text-gray-700 hover:text-emerald-700' }}">Home</a>
                <a href="{{ url('/services') }}" class="transition {{ request()->is('services*') ? 'text-emerald-700' : 'text-gray-700 hover:text-emerald-700' }}">Services</a>
                <a href="{{ url('/clinics') }}" class="transition {{ request()->is('clinics') ? 'text-emerald-700' : 'text-gray-700 hover:text-emerald-700' }}">Clinics</a>
                <a href="{{ url('/about') }}" class="transition {{ request()->is('about') ? 'text-emerald-700' : 'text-gray-700 hover:text-emerald-700' }}">Doctors</a>
                <a href="{{ url('/contact') }}" class="transition {{ request()->is('contact') ? 'text-emerald-700' : 'text-gray-700 hover:text-emerald-700' }}">Contact</a>
            </nav>

            <div class="hidden md:flex items-center gap-3">
                <a href="tel:+918002268003" class="px-4 py-2 rounded-full text-sm font-bold bg-white border border-emerald-200 text-emerald-800 hover:bg-emerald-50 transition">
                    Call 8002268003
                </a>
                <a href="{{ url('/contact') }}" class="px-5 py-2 rounded-full text-white text-sm font-bold shadow transition hover:-translate-y-0.5"
                    style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
                    Appointment
                </a>
            </div>

            <button id="menu-toggle" class="md:hidden w-10 h-10 rounded-full border border-emerald-100 flex items-center justify-center" aria-label="Open menu">
                <i class="fa-solid fa-bars" style="color: var(--color-dark);"></i>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="hidden mt-3 backdrop-blur-xl bg-white/95 border border-emerald-100 shadow-xl rounded-2xl p-5 flex-col gap-3 text-center">
        <a href="{{ url('/') }}" class="block py-1 font-semibold text-gray-700">Home</a>
        <a href="{{ url('/services') }}" class="block py-1 font-semibold text-gray-700">Services</a>
        <a href="{{ url('/clinics') }}" class="block py-1 font-semibold text-gray-700">Clinics</a>
        <a href="{{ url('/about') }}" class="block py-1 font-semibold text-gray-700">Doctors</a>
        <a href="{{ url('/contact') }}" class="block py-1 font-semibold text-gray-700">Contact</a>
        <a href="tel:+918002268003" class="block px-4 py-2 rounded-full text-sm font-bold border border-emerald-200 text-emerald-800">Call Now</a>
    </div>
</header>

<script>
    document.getElementById('menu-toggle')?.addEventListener('click', () => {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
        mobileMenu.classList.toggle('flex');
    });
</script>
