<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login · Clean White</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz@14..32&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        * {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 1.5rem;
        }

        .card-clean {
            background: #ffffff;
            border: 1px solid #e9edf4;
            box-shadow: 0 12px 40px -12px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(0, 0, 0, 0.02) inset;
            transition: box-shadow 0.2s;
        }

        .card-clean:hover {
            box-shadow: 0 20px 48px -16px rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(0, 0, 0, 0.02) inset;
        }

        .input-light {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
            color: #0f172a;
        }

        .input-light::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .input-light:focus {
            outline: none;
            border-color: #6366f1;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.08), 0 0 0 1px #6366f1;
        }

        /* primary button - clean gradient */
        .btn-primary-clean {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            transition: all 0.25s ease;
            box-shadow: 0 4px 14px -4px rgba(79, 70, 229, 0.25);
            color: white;
            font-weight: 500;
        }

        .btn-primary-clean:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px -8px rgba(79, 70, 229, 0.35);
        }

        .btn-primary-clean:active {
            transform: scale(0.97);
        }

        /* demo badge - clean light */
        .demo-badge-light {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            color: #334155;
            padding: 0.3rem 1rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 450;
            transition: all 0.2s;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .demo-badge-light:hover {
            background: #e9edf4;
            border-color: #cbd5e1;
            color: #0f172a;
        }

        /* toggle password button */
        .toggle-pwd-light {
            color: #94a3b8;
            transition: color 0.2s;
        }

        .toggle-pwd-light:hover {
            color: #4f46e5;
        }

        /* checkbox custom */
        .checkbox-light {
            accent-color: #4f46e5;
            width: 1.1rem;
            height: 1.1rem;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            transition: all 0.2s;
            cursor: pointer;
        }

        .checkbox-light:checked {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }

        /* toast messages - clean */
        .toast-clean {
            border-radius: 12px;
            padding: 0.75rem 1.25rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            font-weight: 450;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideUp 0.25s ease-out;
            box-shadow: 0 4px 12px -4px rgba(0, 0, 0, 0.04);
        }

        .toast-success {
            border-left: 4px solid #22c55e;
            color: #166534;
        }

        .toast-error {
            border-left: 4px solid #ef4444;
            color: #991b1b;
        }

        .toast-info {
            border-left: 4px solid #3b82f6;
            color: #1e3a8a;
        }

        @keyframes slideUp {
            0% {
                opacity: 0;
                transform: translateY(8px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* link style */
        .link-clean {
            color: #4f46e5;
            font-weight: 450;
            transition: color 0.2s;
        }

        .link-clean:hover {
            color: #4338ca;
            text-decoration: underline;
        }

        /* shake animation */
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20% {
                transform: translateX(-6px);
            }

            40% {
                transform: translateX(6px);
            }

            60% {
                transform: translateX(-4px);
            }

            80% {
                transform: translateX(4px);
            }
        }

        .animate-shake {
            animation: shake 0.3s ease-in-out;
        }
    </style>
</head>

<body>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                toastr.error("{{ $error }}")
            </script>
        @endforeach
    @endif

    @if (session('error'))
        <script>
            toastr.error("{{ session('error') }}")
        </script>
    @endif

    <div class="w-full max-w-md">
        <div class="card-clean rounded-3xl p-8 sm:p-10 border border-black">

            <!-- header -->
            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-indigo-50 border border-indigo-100 mb-4">
                    <i class="fas fa-fingerprint text-3xl text-indigo-600"></i>
                </div>
                <h2 class="text-2xl font-semibold text-slate-800 tracking-tight">Secure Login</h2>
                <p class="text-sm text-slate-500 mt-1.5">Sign in to your dashboard</p>
            </div>
            <form action="{{ route('system.login') }}" class="space-y-5" method="POST">
                @csrf
                <div>
                    <label class="block text-xs font-medium text-slate-600 uppercase tracking-wider mb-1.5">
                        <i class="fas fa-envelope mr-2 text-indigo-400"></i> Email
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="input-light w-full px-4 py-3.5 rounded-xl text-sm @error('email')
border-red-600
            @enderror"
                        placeholder="Enter your username" />
                    @error('email')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- password -->
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label class="block text-xs font-medium text-slate-600 uppercase tracking-wider">
                            <i class="fas fa-key mr-2 text-indigo-400"></i> Password
                        </label>
                        <a href="#" id="forgotLink"
                            class="text-xs text-indigo-500 hover:text-indigo-700 transition-colors">Forgot?</a>
                    </div>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="input-light w-full px-4 py-3.5 rounded-xl text-sm pr-12 @error('password')
border-red-600
                            @enderror"
                            placeholder="••••••••" />
                        @error('password')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center toggle-pwd-light"
                            aria-label="toggle visibility">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- options -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2.5 text-sm text-slate-600 cursor-pointer group">
                        <input type="checkbox" class="checkbox-light" checked />
                        <span class="group-hover:text-slate-800 transition-colors">Keep me signed in</span>
                    </label>

                </div>

                <!-- submit -->
                <button type="submit"
                    class="btn-primary-clean w-full py-3.5 px-4 rounded-xl text-sm tracking-wide flex items-center justify-center gap-3">
                    <i class="fas fa-arrow-right-to-bracket"></i> Log in
                </button>
            </form>


        </div>
    </div>

    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000",
            "preventDuplicates": true,
        };
        (function() {
            const form = document.getElementById('loginForm');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const toggleBtn = document.getElementById('togglePassword');
            const eyeIcon = document.getElementById('eyeIcon');
            const msgContainer = document.getElementById('messageContainer');
            const demoTrigger = document.getElementById('demoFillTrigger');
            const forgotLink = document.getElementById('forgotLink');

            // toggle password visibility
            toggleBtn.addEventListener('click', () => {
                const type = password.type === 'password' ? 'text' : 'password';
                password.type = type;
                eyeIcon.classList.toggle('fa-eye');
                eyeIcon.classList.toggle('fa-eye-slash');
            });

            // show toast message
            function showToast(text, type = 'error') {
                msgContainer.innerHTML = '';
                const toast = document.createElement('div');
                toast.className = `toast-clean toast-${type}`;
                const iconMap = {
                    success: 'fa-circle-check',
                    error: 'fa-circle-exclamation',
                    info: 'fa-circle-info'
                };
                const icon = document.createElement('i');
                icon.className = `fas ${iconMap[type] || iconMap.error} text-lg`;
                toast.appendChild(icon);
                const span = document.createElement('span');
                span.textContent = text;
                toast.appendChild(span);
                msgContainer.appendChild(toast);
                if (type === 'success' || type === 'info') {
                    setTimeout(() => {
                        if (msgContainer.contains(toast)) toast.remove();
                    }, 5000);
                }
            }

            // login handler (mock)
            function handleLogin(e) {
                e.preventDefault();
                const emailVal = email.value.trim();
                const passVal = password.value.trim();

                if (!emailVal || !passVal) {
                    showToast('Please fill in both fields.', 'error');
                    return;
                }
                if (!emailVal.includes('@') || !emailVal.includes('.')) {
                    showToast('Please enter a valid email address.', 'error');
                    return;
                }

                if (emailVal === 'admin@demo.com' && passVal === 'password') {
                    showToast('Login successful. Redirecting to dashboard…', 'success');
                    setTimeout(() => {
                        showToast('Welcome, Admin! (demo redirect)', 'info');
                    }, 900);
                } else {
                    showToast('Invalid credentials. Use demo: admin@demo.com / password', 'error');
                    form.classList.add('animate-shake');
                    setTimeout(() => form.classList.remove('animate-shake'), 400);
                }
            }

            form.addEventListener('submit', handleLogin);

            // demo fill (click on badge)
            demoTrigger.addEventListener('click', () => {
                email.value = 'admin@demo.com';
                password.value = 'password';
                showToast('Demo credentials filled. Click "Log in".', 'info');
                [email, password].forEach(el => {
                    el.classList.add('ring-2', 'ring-indigo-200');
                    setTimeout(() => el.classList.remove('ring-2', 'ring-indigo-200'), 1400);
                });
            });

            // forgot link
            forgotLink.addEventListener('click', (e) => {
                e.preventDefault();
                showToast('Use demo password: "password" (or contact admin)', 'info');
            });

            console.log('✅ Clean white Admin Login ready');
        })();
    </script>

</body>

</html>
