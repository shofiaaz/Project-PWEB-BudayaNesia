@extends('layouts.appCus')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Back Button -->
    <div class="mb-6 animate-fade-in">
        <a href="{{ route('profile.show') }}" class="p-2 border border-b-8 border-black rounded bg-budanes font-bold inline-flex items-center text-white hover:text-black hover:bg-budanes-dark transition">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke profil
        </a>
    </div>

    <!-- Profile Card -->
    <div class="profile-card rounded-2xl overflow-hidden animate-fade-in">
        <div class="flex flex-col lg:flex-row">
            <!-- Profile Picture Section -->
            <div class="w-full lg:w-1/3 p-8 flex flex-col items-center justify-center bg-gradient-to-br from-gray-800 to-budanes">
                <div class="relative mb-6">
                    <div class="w-40 h-40 rounded-full border-4 border-white overflow-hidden shadow-xl">
                        @if($user->profile_photo)
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full bg-gray-700 flex items-center justify-center">
                            <i class="fas fa-user text-6xl text-gray-400"></i>
                        </div>
                        @endif
                    </div>
                    <button type="button" onclick="document.getElementById('profile-photo-input').click()" class="absolute bottom-0 right-0 bg-budanes text-black p-2 rounded-full shadow-md hover:bg-budanes-darker transition">
                        <i class="fas fa-camera"></i>
                    </button>
                </div>
                <h2 class="text-white text-2xl font-bold text-center">{{ $user->username }}</h2>
                <p class="text-white mt-1">{{ $user->email }}</p>
            </div>

            <!-- Edit Form Section -->
            <div class="bg-gray-50 w-full lg:w-2/3 p-8">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Hidden file input for profile photo -->
                    <input type="file" id="profile-photo-input" name="profile_photo" class="hidden" accept="image/*" onchange="previewImage(event)">

                    <!-- Account Info -->
                    <div>
                        <div class="flex items-center mb-6">
                            <div class="h-8 w-1 bg-budanes mr-3 rounded-full"></div>
                            <h3 class="text-xl font-bold">Informasi Akun</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="username" class="block text-sm font-medium text-black mb-2">Username</label>
                                <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                                       class="form-input border-black border-2 text-black block w-full rounded-lg py-2.5 px-4 focus:ring-2 focus:ring-budanes">
                                @error('username')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-black mb-2">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                       class="form-input border-black border-2 text-black block w-full rounded-lg py-2.5 px-4 focus:ring-2 focus:ring-budanes">
                                @error('email')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="nomor_hp" class="block text-sm font-medium text-black mb-2">Nomor HP</label>
                                <input type="text" name="nomor_hp" id="nomor_hp" value="{{ old('nomor_hp', $user->nomor_hp) }}"
                                       class="form-input border-black border-2 text-black block w-full rounded-lg py-2.5 px-4 focus:ring-2 focus:ring-budanes">
                                @error('nomor_hp')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Change Password -->
                    <div>
                        <div class="flex items-center mb-6">
                            <div class="h-8 w-1 bg-budanes mr-3 rounded-full"></div>
                            <h3 class="text-xl font-bold">Ubah Password</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="current_password" class="block text-sm font-medium text-black mb-2">Password Saat Ini</label>
                                <input type="password" name="current_password" id="current_password"
                                       class="form-input border-black border-2 text-black block w-full rounded-lg py-2.5 px-4 focus:ring-2 focus:ring-budanes">
                                @error('current_password')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-black mb-2">Password Baru</label>
                                <input type="password" name="password" id="password"
                                       class="form-input border-black border-2 text-black block w-full rounded-lg py-2.5 px-4 focus:ring-2 focus:ring-budanes">
                                @error('password')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-black mb-2">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="form-input border-black border-2 text-black block w-full rounded-lg py-2.5 px-4 focus:ring-2 focus:ring-budanes">
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end pt-6">
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-budanes text-white font-semibold rounded-lg hover:bg-budanes-dark transition shadow-md">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // SweetAlert for errors
    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Data Tidak Valid',
            html: `Harap periksa kembali data yang dimasukkan`,
            confirmButtonColor: '#2096f6',
            background: '#111827',
            color: '#FFF'
        });
    @elseif (session()->has('success_once'))
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success_once') }}',
            icon: 'success',
            confirmButtonColor: '#2096f6',
            background: '#111827',
            color: '#FFF'
        }).then(() => {
            window.location.href = "{{ route('profile.show') }}";
        });
    @endif

    // Animation for form elements
    document.querySelectorAll('input, select, textarea').forEach((el, index) => {
        el.style.animationDelay = `${index * 0.05}s`;
        el.classList.add('animate-fade-in');
    });

    // Profile photo preview
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.querySelector('.profile-picture img');
            if (preview) {
                preview.src = reader.result;
            } else {
                const div = document.querySelector('.profile-picture div');
                if (div) {
                    div.innerHTML = `<img src="${reader.result}" class="w-full h-full object-cover" alt="Preview">`;
                }
            }
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }
    .profile-card {
        background: linear-gradient(135deg, #111827 0%, #0D1321 100%);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    .form-input border-black border-2 text-black {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        transition: all 0.3s ease;
    }
    .form-input border-black border-2 text-black:focus {
        background: rgba(255, 255, 255, 0.1);
        border-color: #20f2f6;
        box-shadow: 0 0 0 2px rgba(32, 242, 246, 0.3);
    }
</style>
@endsection
