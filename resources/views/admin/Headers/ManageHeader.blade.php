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
    <div
        class="w-full max-w-7xl mx-auto bg-white shadow-2xl rounded-2xl border border-gray-200 overflow-hidden transition-all duration-200">
        {{-- Header --}}
        <div
            class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100/80 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                    <span class="w-10 h-10 bg-blue-600/10 text-blue-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-sliders-h text-lg"></i>
                    </span>
                    Settings
                </h2>
                <p class="text-sm text-gray-500 mt-1 ml-1">Manage your contact & branding information</p>
            </div>
            <div class="flex items-center gap-3">
                <button
                    class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex items-center gap-2 font-medium">
                    <i class="fas fa-plus-circle"></i> Add New
                </button>
                <button
                    class="text-sm bg-white hover:bg-gray-50 text-gray-700 px-5 py-2.5 rounded-xl shadow-sm border border-gray-300 hover:border-gray-400 transition-all duration-200 flex items-center gap-2 font-medium">
                    <i class="fas fa-edit text-blue-500"></i> Edit
                </button>
                <button
                    class="text-sm bg-white hover:bg-red-50 text-red-600 px-5 py-2.5 rounded-xl shadow-sm border border-gray-300 hover:border-red-200 transition-all duration-200 flex items-center gap-2 font-medium">
                    <i class="fas fa-trash-alt"></i> Delete
                </button>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto px-6 py-4 border-b border-gray-200">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs font-semibold uppercase text-gray-500 bg-gray-50/90 rounded-xl">
                    <tr>
                        <th class="px-4 py-3.5 font-semibold">Logo</th>
                        <th class="px-4 py-3.5 font-semibold">WhatsApp</th>
                        <th class="px-4 py-3.5 font-semibold">Phone</th>
                        <th class="px-4 py-3.5 font-semibold">Location</th>
                        <th class="px-4 py-3.5 font-semibold">Icons</th>
                        <th class="px-4 py-3.5 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-blue-50/40 transition-colors duration-150">
                        <td class="px-4 py-4 flex items-center gap-3">
                            <span
                                class="w-9 h-9 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl flex items-center justify-center text-sm font-bold shadow-sm">A</span>
                            <span class="font-medium text-gray-800">Acme Inc.</span>
                        </td>
                        <td class="px-4 py-4"><span
                                class="bg-green-100 text-green-700 px-3 py-1.5 rounded-full text-xs font-semibold"><i
                                    class="fab fa-whatsapp mr-1.5"></i>+1 234 5678</span></td>
                        <td class="px-4 py-4"><span
                                class="bg-indigo-100 text-indigo-700 px-3 py-1.5 rounded-full text-xs font-semibold"><i
                                    class="fas fa-phone mr-1.5"></i>+1 987 6543</span></td>
                        <td class="px-4 py-4"><i class="fas fa-map-pin text-gray-400 mr-2"></i>New York, USA</td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2.5">
                                <span
                                    class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center"><i
                                        class="fab fa-whatsapp"></i></span>
                                <span
                                    class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center"><i
                                        class="fas fa-phone-alt"></i></span>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-right">
                            <button class="text-gray-400 hover:text-blue-600 transition-colors mr-3"><i
                                    class="fas fa-pen text-sm"></i></button>
                            <button class="text-gray-400 hover:text-red-500 transition-colors"><i
                                    class="fas fa-trash text-sm"></i></button>
                        </td>
                    </tr>
                    <tr class="hover:bg-blue-50/40 transition-colors duration-150">
                        <td class="px-4 py-4 flex items-center gap-3">
                            <span
                                class="w-9 h-9 bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-xl flex items-center justify-center text-sm font-bold shadow-sm">B</span>
                            <span class="font-medium text-gray-800">Beta Corp</span>
                        </td>
                        <td class="px-4 py-4"><span
                                class="bg-green-100 text-green-700 px-3 py-1.5 rounded-full text-xs font-semibold"><i
                                    class="fab fa-whatsapp mr-1.5"></i>+44 20 1234</span></td>
                        <td class="px-4 py-4"><span
                                class="bg-indigo-100 text-indigo-700 px-3 py-1.5 rounded-full text-xs font-semibold"><i
                                    class="fas fa-phone mr-1.5"></i>+44 20 5678</span></td>
                        <td class="px-4 py-4"><i class="fas fa-map-pin text-gray-400 mr-2"></i>London, UK</td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2.5">
                                <span
                                    class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center"><i
                                        class="fab fa-whatsapp"></i></span>
                                <span
                                    class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center"><i
                                        class="fas fa-phone-alt"></i></span>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-right">
                            <button class="text-gray-400 hover:text-blue-600 transition-colors mr-3"><i
                                    class="fas fa-pen text-sm"></i></button>
                            <button class="text-gray-400 hover:text-red-500 transition-colors"><i
                                    class="fas fa-trash text-sm"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Form --}}
        <div class="px-8 py-6 bg-gradient-to-b from-gray-50/60 to-white">
            <div class="flex items-center gap-3 mb-5">
                <span class="w-8 h-8 bg-blue-600/10 text-blue-600 rounded-lg flex items-center justify-center"><i
                        class="fas fa-pencil-alt text-sm"></i></span>
                <h3 class="text-base font-semibold text-gray-800">Create / Edit Record</h3>
                <span class="text-xs text-gray-400 bg-gray-100 px-3 py-1 rounded-full font-medium">fillable fields</span>
            </div>

            <form class="grid grid-cols-1 md:grid-cols-2 gap-5" action="{{ route('header.store') }}" method="POST">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Logo</label>
                    <div class="flex items-center gap-2">
                        <input type="file" name="logo"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition-all bg-white shadow-sm" />
                        <button type="button"
                            class="bg-gray-100 hover:bg-gray-200 p-2.5 rounded-xl text-gray-600 transition-all hover:shadow-sm">
                            <i class="fas fa-image"></i>
                        </button>
                    </div>
                </div>
                <!-- WhatsApp -->
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">WhatsApp
                        No.</label>
                    <input type="text" value="{{ old('whatsapp_no') }}" name="whatsapp_no" placeholder="WhatsApp number"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition-all bg-white shadow-sm" />
                </div>
                <!-- Phone -->
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Phone
                        No.</label>
                    <input type="text" value="{{ old('phone_no') }}" name="phone_no" placeholder="Phone number"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition-all bg-white shadow-sm" />
                </div>
                <!-- Location -->
                <div>
                    <label
                        class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Location</label>
                    <input type="text" value="{{ old('location') }}" name="location" placeholder="City, Country"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-200 focus:border-blue-500 outline-none transition-all bg-white shadow-sm" />
                </div>
                <!-- Icons -->
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Icons
                        (whatsappIcon / phoneIcon)</label>
                    <div class="flex flex-wrap items-center gap-3">
                        <div
                            class="flex items-center gap-2 bg-white border border-gray-300 rounded-xl px-3 py-2 shadow-sm">
                            <i class="fab fa-whatsapp text-green-500 text-lg"></i>
                            <input type="text" value="{{ old('whatsappIcon') }}" name="whatsappIcon"
                                placeholder="icon class"
                                class="w-32 border-0 p-0 text-sm focus:ring-0 outline-none bg-transparent font-mono text-gray-700" />
                        </div>
                        <div
                            class="flex items-center gap-2 bg-white border border-gray-300 rounded-xl px-3 py-2 shadow-sm">
                            <i class="fas fa-phone-alt text-blue-500 text-lg"></i>
                            <input type="text" value="{{ old('whatsappIcon') }}" name="whatsappIcon"
                                placeholder="icon class"
                                class="w-32 border-0 p-0 text-sm focus:ring-0 outline-none bg-transparent font-mono text-gray-700" />
                        </div>
                        <span class="text-xs text-gray-400 italic bg-gray-100 px-3 py-1.5 rounded-full">icon
                            placeholders</span>
                    </div>
                </div>
                <!-- Form Actions -->
                <div class="md:col-span-2 flex items-center justify-end gap-3 pt-3 border-t border-gray-200/80 mt-1">
                    <button type="reset"
                        class="px-6 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-xl transition-all">Cancel</button>
                    <button type="submit"
                        class="px-7 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>

        {{-- Footer --}}
        <div
            class="px-8 py-3.5 bg-gray-50 border-t border-gray-200 text-xs text-gray-500 flex flex-wrap items-center justify-between gap-2">
            <span class="flex items-center gap-1.5">
                <i class="fas fa-database text-gray-400"></i>
                <span class="font-medium">fillable:</span>
                <span class="font-mono bg-white/80 px-2 py-0.5 rounded-md text-gray-700 border border-gray-200">logo</span>
                <span
                    class="font-mono bg-white/80 px-2 py-0.5 rounded-md text-gray-700 border border-gray-200">whatsapp_no</span>
                <span
                    class="font-mono bg-white/80 px-2 py-0.5 rounded-md text-gray-700 border border-gray-200">phone_no</span>
                <span
                    class="font-mono bg-white/80 px-2 py-0.5 rounded-md text-gray-700 border border-gray-200">location</span>
                <span
                    class="font-mono bg-white/80 px-2 py-0.5 rounded-md text-gray-700 border border-gray-200">whatsappIcon</span>
                <span
                    class="font-mono bg-white/80 px-2 py-0.5 rounded-md text-gray-700 border border-gray-200">phoneIcon</span>
            </span>
            <span class="flex items-center gap-2 text-green-600">
                <i class="fas fa-check-circle"></i>
                <span class="font-medium">CRUD ready</span>
            </span>
        </div>
    </div>

    {{-- Minimal JS for interactivity --}}
    <script>
        (function() {
            const addBtn = document.querySelector('button:has(.fa-plus-circle)');
            if (addBtn) {
                addBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    alert(
                        '📋 Add new record (simulated) – fillable fields: logo, whatsapp_no, phone_no, location, whatsappIcon, phoneIcon'
                    );
                });
            }
            const editBtn = document.querySelector('button:has(.fa-edit)');
            if (editBtn) {
                editBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    alert('✏️ Edit selected record (simulated)');
                });
            }
            const delBtn = document.querySelector('button:has(.fa-trash-alt)');
            if (delBtn) {
                delBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (confirm('🗑️ Delete selected record?')) {
                        alert('✅ Record deleted (simulated)');
                    }
                });
            }
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    alert('💾 Record saved (simulated) – all fillable fields included');
                });
            }
        })();
    </script>
@endsection
