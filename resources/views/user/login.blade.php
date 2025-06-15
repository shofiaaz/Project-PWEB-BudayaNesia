@extends('layouts.appCus')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-screen-xl h-[100vh] bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="flex flex-col lg:flex-row h-full"> <div class="lg:w-1/2 login-bg hidden lg:block relative h-full"> <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center p-10">
                    <div class="text-center">
                        <h2 class="text-2xl font-bold text-white mb-4 animate-fade-in" style="font-family: 'Lily Script One', cursive;">BudayaNesia</h2>
                        <p class="text-white text-l animate-fade-in" style="animation-delay: 0.2s;">Eksplorasi seluruh kekayaan budaya indonesia</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-900 border-2 border-b-8 border-black lg:w-1/2 p-8 md:p-12 flex flex-col justify-center h-full"> <div class="text-center mb-8">
                    <h1 class="text-xl font-bold text-white mb-2 animate-fade-in">Welcome back to <span class="bg-red-700 bg-clip-text text-transparent" style="font-family: 'Lily Script One', cursive;">BudayaNesia</span></h1>
                    <p class="text-white text-lg animate-fade-in" style="animation-delay: 0.1s;">Silakan masuk ke akun Anda</p>
                </div>

                <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="animate-fade-in" style="animation-delay: 0.2s;">
                        <label for="username" class="block text-white mb-2 text-lg">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-500 text-lg"></i>
                            </div>
                            <input type="text" name="username" required
                                   class="text-white border-black form-input w-full pl-10 pr-3 py-4 rounded-lg focus:ring-2 focus:ring-budanes text-lg"
                                   placeholder="Masukkan username Anda">
                        </div>
                        @error('username')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="animate-fade-in" style="animation-delay: 0.3s;">
                        <label for="password" class="block text-white mb-2 text-lg">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-500 text-lg"></i>
                            </div>
                            <input type="password" name="password" id="password" required
                                   class="text-white border-black form-input w-full pl-10 pr-10 py-4 rounded-lg focus:ring-2 focus:ring-budanes text-lg"
                                   placeholder="Masukkan password Anda">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            </div>
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="animate-fade-in" style="animation-delay: 0.4s;">
                        <button type="submit"
                                class="border-b-4 border-red-900 w-full bg-budanes hover:bg-black hover:text-budanes text-white font-bold py-4 px-4 rounded-lg transition duration-300 flex items-center justify-center text-xl">
                            <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center animate-fade-in" style="animation-delay: 0.5s;">
                    <p class="text-white text-lg">Belum punya akun?
                        <a href="{{ route('regis') }}" class="text-blue-500 hover:text-white hover:underline">Daftar sekarang</a>
                    </p>
                </div>

                <div class=" rounded-lg mt-6 text-center animate-fade-in p-3" style="animation-delay: 0.6s;">
                    <a href="{{route('home')}}" class="border-b-4 border-red-900 inline-flex items-center text-white hover:bg-black hover:text-budanes transition text-lg bg-budanes rounded-lg p-3 border-b-2 border-black">
                        <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                    </a>
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
            html: `Harap isi kembali`,
            confirmButtonColor: '#F57F17',
            background: '#111827',
            color: '#FFF'
        });
    @elseif (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            text: 'Username atau password tidak terdaftar',
            confirmButtonColor: '#F57F17',
            background: '#111827',
            color: '#FFF'
        });
    @endif

    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        toggleIcon.classList.toggle('fa-eye');
        toggleIcon.classList.toggle('fa-eye-slash');
    }
</script>
@endsection
