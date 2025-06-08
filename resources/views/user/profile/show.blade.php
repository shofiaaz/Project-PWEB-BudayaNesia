@extends('layouts.appCus')

@section('content')
<!-- Header dengan Gradient -->
<div class="gradient-bg h-32 md:h-40 relative">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="relative z-10 container mx-auto px-4 py-6">
        <!-- Back Button -->
        <a href="{{ route('home') }}" class="rounded-lg border-b-4 border-budanes py-2 px-4 bg-black inline-flex items-center text-white hover:text-budanes transition-colors duration-300 font-semibold">
            <i class="fas fa-arrow-left mr-2"></i>
            <span class="hidden sm:inline">Kembali ke Home</span>
            <span class="sm:hidden">Kembali</span>
        </a>
    </div>
</div>

<!-- Success Message -->
@if(session('success'))
<div id="success-message" class="fixed top-4 right-4 z-50 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg animate-slide-up">
    <div class="flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        <span>{{ session('success') }}</span>
    </div>
</div>
@endif

<!-- Main Content -->
<div class="container mx-auto px-4 -mt-16 md:-mt-20 relative z-20 pb-8">
    <!-- Profile Card -->
    <div class="glass-card rounded-2xl shadow-2xl overflow-hidden animate-scale-in">
        <!-- Profile Header -->
        <div class="p-6 md:p-8 text-center border-b border-gray-200">
            <div class="relative inline-block mb-4">
                <!-- Profile Photo -->
                <div class="w-24 h-24 md:w-32 md:h-32 rounded-full overflow-hidden border-4 border-black shadow-lg profile-photo-container mx-auto">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->username) }}&background=A41313&color=fff" alt="Profile Photo" class="w-full h-full object-cover">
                    <div class="profile-photo-overlay">
                        <button class="text-white text-sm">
                            <i class="fas fa-camera text-lg"></i>
                        </button>
                    </div>
                </div>
                <!-- Online Indicator -->
                <div class="absolute bottom-1 right-1 w-6 h-6 bg-green-500 rounded-full border-3 border-white"></div>
            </div>

            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-1">{{ $user->username }}</h1>
            <p class="text-gray-600 mb-1">{{ $user->email }}</p>
            <p class="text-sm text-gray-500">Member sejak {{ $user->created_at->format('Y') }}</p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 mt-6 justify-center">
                <a href="{{ route('profile.edit') }}" class="btn-budanes text-white px-6 py-3 rounded-xl font-semibold inline-flex items-center justify-center">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Profil
                </a>
                <button id="logout-btn" class="btn-black text-white px-6 py-3 rounded-xl font-semibold inline-flex items-center justify-center">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Logout
                </button>
            </div>
        </div>

        <!-- Profile Information -->
        <div class="p-6 md:p-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Personal Information -->
                <div class="space-y-4 animate-fade-in">
                    <div class="flex items-center mb-6">
                        <div class="w-1 h-8 bg-budanes rounded-full mr-3"></div>
                        <h2 class="text-xl font-bold text-gray-800">Informasi Personal</h2>
                    </div>

                    <div class="info-item bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-budanes-light rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-user text-budanes"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-500">Username</p>
                                <p class="text-lg font-semibold text-gray-800 truncate">{{ $user->username }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-item bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-budanes-light rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-envelope text-budanes"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="text-lg font-semibold text-gray-800 truncate">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-item bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-budanes-light rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-phone text-budanes"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-500">Nomor HP</p>
                                <p class="text-lg font-semibold text-gray-800 truncate">{{ $user->nomor_hp ?? 'Belum diatur' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Information -->
                <div class="space-y-4 animate-fade-in" style="animation-delay: 0.2s;">
                    <div class="flex items-center mb-6">
                        <div class="w-1 h-8 bg-budanes rounded-full mr-3"></div>
                        <h2 class="text-xl font-bold text-gray-800">Informasi Akun</h2>
                    </div>

                    <div class="info-item bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-budanes-light rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-shield-alt text-budanes"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-500">Role</p>
                                <p class="text-lg font-semibold text-gray-800">
                                    {{ $user->role->nama_role ?? 'User' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="info-item bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-budanes-light rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-calendar-alt text-budanes"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-500">Bergabung</p>
                                <p class="text-lg font-semibold text-gray-800">
                                    {{ $user->created_at->translatedFormat('d F Y') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="info-item bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-budanes-light rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-clock text-budanes"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-500">Terakhir Update</p>
                                <p class="text-lg font-semibold text-gray-800">
                                    {{ $user->updated_at->translatedFormat('d F Y, H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Logout Form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
    // Animate elements on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe all info items
    document.querySelectorAll('.info-item').forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        item.style.transition = `all 0.6s ease ${index * 0.1}s`;
        observer.observe(item);
    });

    // Auto-hide success message
    const successMessage = document.getElementById('success-message');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.opacity = '0';
            successMessage.style.transform = 'translateX(100%)';
            setTimeout(() => successMessage.remove(), 300);
        }, 3000);
    }

    // Logout confirmation
    document.getElementById('logout-btn').addEventListener('click', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Konfirmasi Logout',
            text: "Apakah Anda yakin ingin keluar dari akun ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#A41313',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal',
            background: '#ffffff',
            customClass: {
                popup: 'rounded-2xl shadow-2xl',
                confirmButton: 'rounded-xl px-6 py-3 font-semibold',
                cancelButton: 'rounded-xl px-6 py-3 font-semibold'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    });
</script>


<style>
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes scaleIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }

    .gradient-bg {
        background: linear-gradient(135deg, #c82500 0%, rgb(16, 16, 16) 100%);
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .info-item {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .info-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .profile-photo-container {
        position: relative;
        overflow: hidden;
    }

    .profile-photo-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .profile-photo-container:hover .profile-photo-overlay {
        opacity: 1;
    }

    .btn-budanes {
        background: linear-gradient(135deg, #ce1800 100%,rgb(206, 0, 0)0 100%);
        transition: all 0.3s ease;
    }

    .btn-budanes:hover {
        background: linear-gradient(135deg, #c90000 0%, #fec119 100%);
        transform: translateY(-1px);
        box-shadow: 0 8px 20px rgba(255, 193, 7, 0.3);
    }

    .btn-black {
        background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
        transition: all 0.3s ease;
    }

    .btn-black:hover {
        background: linear-gradient(135deg, #333333 0%, #1a1a1a 100%);
        transform: translateY(-1px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }
</style>
@endsection
