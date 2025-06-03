@extends('layouts.appCus')

@section('content')
    <!-- Registration Section -->
    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-6xl bg-gray-900 rounded-2xl shadow-xl overflow-hidden border border-gray-800">
            <div class="flex flex-col lg:flex-row">
                <!-- Image Section -->
                <div class="lg:w-1/2 register-bg hidden lg:block relative">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center p-10">
                        <div class="text-center">
                            <h2 class="text-4xl font-bold text-budanes mb-4 animate-fade-in" style="font-family: 'Lily Script One', cursive;">BudayaNesia</h2>
                            <p class="text-gray-300 text-lg animate-fade-in" style="animation-delay: 0.2s;">Bergabunglah dengan pecinta kopi lain, dan rasakan kenikmatan kopi khas kami</p>
                            <div class="mt-8 space-y-4 text-left animate-fade-in" style="animation-delay: 0.4s;">
                                <div class="flex items-start">
                                    <i class="fas fa-check-circle text-budanes mt-1 mr-3"></i>
                                    <span class="text-gray-300">Portal budaya nusantara</span>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-check-circle text-budanes mt-1 mr-3"></i>
                                    <span class="text-gray-300">Berbagai fitur menarik untuk diakses</span>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-check-circle text-budanes mt-1 mr-3"></i>
                                    <span class="text-gray-300">Ikutin event seru disekitarmu</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="lg:w-1/2 p-8 md:p-12">
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold text-white mb-2 animate-fade-in">Daftar Akun <span class="text-budanes" style="font-family: 'Lily Script One', cursive;">BudayaNesia</span></h1>
                        <p class="text-gray-400 animate-fade-in" style="animation-delay: 0.1s;">Bergabunglah dengan kami sekarang</p>
                    </div>

                    <form id="registrationForm" method="POST" action="{{ route('register.submit') }}" class="space-y-5">
                        @csrf
                        <!-- Personal Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <div class="animate-fade-in" style="animation-delay: 0.2s;">
                                <label for="nama" class="block text-gray-300 mb-2">Email</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-500"></i>
                                    </div>
                                    <input type="email" id="email" name="email" required
                                           class="form-input w-full pl-10 pr-3 py-3 rounded-lg"
                                           placeholder="Masukkan email anda">
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="animate-fade-in" style="animation-delay: 0.3s;">
                                <label for="username" class="block text-gray-300 mb-2">Username</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-at text-gray-500"></i>
                                    </div>
                                    <input type="text" id="username" name="username" required
                                           class="form-input w-full pl-10 pr-3 py-3 rounded-lg"
                                           placeholder="Buat username">
                                </div>
                                @error('username')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="animate-fade-in" style="animation-delay: 0.4s;">
                            <label for="nomor_hp" class="block text-gray-300 mb-2">Nomor HP</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone text-gray-500"></i>
                                </div>
                                <input type="text" id="nomor_hp" name="nomor_hp" required
                                       class="form-input w-full pl-10 pr-3 py-3 rounded-lg"
                                       placeholder="Contoh: 081234567890">
                            </div>
                            @error('nomor_hp')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="animate-fade-in" style="animation-delay: 0.5s;">
                                <label for="password" class="block text-gray-300 mb-2">Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-500"></i>
                                    </div>
                                    <input type="password" id="password" name="password" required
                                           class="form-input w-full pl-10 pr-4 py-3 rounded-lg"
                                           placeholder="Buat password">
                                </div>
                                @error('password')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="animate-fade-in" style="animation-delay: 0.6s;">
                                <label for="confirmPassword" class="block text-gray-300 mb-2">Konfirmasi Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-500"></i>
                                    </div>
                                    <input type="password" id="confirmPassword" name="confirmPassword" required
                                           class="form-input w-full pl-10 pr-4 py-3 rounded-lg"
                                           placeholder="Ulangi password">
                                </div>
                                @error('confirmPassword')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row justify-between gap-4 pt-6">
                            <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-700 transition">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center justify-center px-6 py-3 bg-budanes text-white font-bold rounded-lg hover:bg-budanes-dark transition">
                                <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-6 text-gray-400">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-budanes hover:text-budanes-dark hover:underline">Masuk disini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Data Tidak Valid',
                html: `Harap periksa kembali data yang dimasukkan`,
                confirmButtonColor: '#F57F17',
                background: '#111827',
                color: '#FFF'
            });
        @elseif(session('success_swal'))
            Swal.fire({
                title: 'Pendaftaran Berhasil!',
                text: '{{ session('success_swal') }}',
                icon: 'success',
                confirmButtonColor: '#F57F17',
                background: '#111827',
                color: '#FFF'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('login') }}";
                }
            });
        @endif

        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(`toggle${fieldId === 'password' ? 'Password' : 'ConfirmPassword'}Icon`);
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        }

        // Animation for elements
        document.querySelectorAll('.animate-fade-in').forEach((el, index) => {
            el.style.animationDelay = `${index * 0.1}s`;
        });
    </script>
@endsection
