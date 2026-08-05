<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body {
            background: #f0f4f8;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .sidebar-item {
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .sidebar-item:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateX(4px);
        }

        .sidebar-item.active {
            background: rgba(99, 102, 241, 0.25);
            border-right: 3px solid #818cf8;
            color: #e0e7ff;
        }

        .stat-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.15);
        }

        .chart-placeholder {
            background: linear-gradient(145deg, #1e293b, #0f172a);
        }

        /* custom scroll for tables */
        .table-wrap::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }

        .table-wrap::-webkit-scrollbar-track {
            background: #1e293b;
        }

        .table-wrap::-webkit-scrollbar-thumb {
            background: #475569;
            border-radius: 12px;
        }
    </style>
</head>

<body>

    <div class="flex h-screen overflow-hidden">
        @include('admin.loyout.sidebar')
        <main class="flex-1 overflow-y-auto bg-slate-100/60 p-6 lg:p-8">
            @include('admin.loyout.topbar')
            @yield('content')
            @include('admin.loyout.footer')
        </main>
    </div>
    <script>
        (function() {
            const sidebarItems = document.querySelectorAll('.sidebar-item');
            sidebarItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    sidebarItems.forEach(i => i.classList.remove('active', 'text-white'));
                    sidebarItems.forEach(i => i.classList.add('text-slate-300'));
                    this.classList.add('active', 'text-white');
                    this.querySelector('i')?.classList.add('text-indigo-300');
                    sidebarItems.forEach(i => {
                        if (i !== this) {
                            i.querySelector('i')?.classList.remove('text-indigo-300');
                        }
                    });
                });
            });
        })();
        toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
        "preventDuplicates": true,
    };
    </script>
</body>

</html>
