@extends('layouts.appCus')

@section('content')
@php
    $shareUrl = urlencode(request()->fullUrl());
    $shareText = urlencode($event->judul);
@endphp

<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="relative h-64 md:h-80 bg-gradient-to-r from-budanes-darker to-budanes-dark overflow-hidden">
        @if($event->thumbnail)
        <img src="{{ asset('storage/' . $event->thumbnail) }}" alt="{{ $event->judul }}"
             class="w-full h-full object-cover opacity-90">
        @else
        <div class="w-full h-full flex items-center justify-center">
            <i class="fas fa-image text-white text-6xl opacity-50"></i>
        </div>
        @endif
        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-end pb-8 px-6">
            <div class="container mx-auto">
                <h1 class="font-lily text-4xl md:text-5xl text-white mb-2 animate-fade-in">{{ $event->judul }}</h1>
                <div class="flex flex-wrap gap-3">
                    <span class="bg-white bg-opacity-90 text-budanes-darker px-3 py-1 rounded-full text-xs font-medium capitalize">
                        {{ $event->kategori }}
                    </span>
                    <span class="bg-white bg-opacity-90 text-budanes-darker px-3 py-1 rounded-full text-xs font-medium">
                        <i class="fas fa-map-marker-alt mr-1"></i> {{ $event->tempat }}
                    </span>
                    <span class="bg-white bg-opacity-90 text-budanes-darker px-3 py-1 rounded-full text-xs font-medium">
                        <i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($event->jadwal)->translatedFormat('d F Y, H:i') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="lg:w-2/3">
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-budanes flex items-center justify-center text-white mr-3">
                                    {{ $event->akun ? strtoupper(substr($event->akun->username, 0, 1)) : '?' }}
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">{{ $event->akun->username ?? 'Tidak diketahui' }}</p>
                                    <p class="text-xs text-gray-500">
                                        <i class="far fa-clock mr-1"></i> {{ $event->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-budanes-darker transition-colors">
                                <i class="far fa-bookmark text-xl"></i>
                            </button>
                        </div>

                        <div class="prose max-w-none text-gray-700 font-poppins">
                            {!! $event->isi !!}
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="px-6 md:px-8 pb-6 md:pb-8">
                        <div class="border-t border-gray-100 pt-6">
                            <h4 class="font-medium text-gray-800 mb-3">Tags</h4>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">
                                    #{{ $event->kategori }}
                                </span>
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">
                                    #{{ str_replace(' ', '', $event->tempat) }}
                                </span>
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">
                                    #eventbudaya
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comments Section (optional, bisa dinamis) -->
                {{-- Tambahkan bagian komentar jika diinginkan --}}
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/3">
                <!-- Related Events -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
                    <div class="p-6 md:p-6">
                        <h3 class="font-bold text-xl text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-calendar-alt text-budanes mr-2"></i> Event Lainnya
                        </h3>

                        <div class="space-y-4">
                            <!-- Event Item 1 -->
                            <a href="#" class="flex gap-3 group">
                                <div class="flex-shrink-0 w-16 h-16 rounded-lg bg-gray-200 overflow-hidden">
                                    <img src="https://via.placeholder.com/100" alt="Event" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800 group-hover:text-budanes transition-colors line-clamp-2">Festival Reog Ponorogo</h4>
                                    <p class="text-xs text-gray-500">22 Juli 2025</p>
                                </div>
                            </a>

                            <!-- Event Item 2 -->
                            <a href="#" class="flex gap-3 group">
                                <div class="flex-shrink-0 w-16 h-16 rounded-lg bg-gray-200 overflow-hidden">
                                    <img src="https://via.placeholder.com/100" alt="Event" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800 group-hover:text-budanes transition-colors line-clamp-2">Kirab Budaya Solo</h4>
                                    <p class="text-xs text-gray-500">15 Agustus 2025</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Share Section -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 md:p-6">
                        <h3 class="font-bold text-xl text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-share-alt text-budanes mr-2"></i> Bagikan
                        </h3>
                        <div class="flex gap-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank"
                               class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ $shareText }}&url={{ $shareUrl }}" target="_blank"
                               class="w-10 h-10 rounded-full bg-blue-400 text-white flex items-center justify-center hover:bg-blue-500 transition-colors">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://pinterest.com/pin/create/button/?url={{ $shareUrl }}&description={{ $shareText }}" target="_blank"
                               class="w-10 h-10 rounded-full bg-red-600 text-white flex items-center justify-center hover:bg-red-700 transition-colors">
                                <i class="fab fa-pinterest-p"></i>
                            </a>
                            <a href="https://wa.me/?text={{ $shareText }}%20{{ $shareUrl }}" target="_blank"
                               class="w-10 h-10 rounded-full bg-gray-800 text-white flex items-center justify-center hover:bg-gray-900 transition-colors">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .prose {
        line-height: 1.75;
    }

    .prose p {
        margin-bottom: 1.25em;
    }

    .prose img {
        border-radius: 0.5rem;
        margin: 1.5em 0;
        max-width: 100%;
        height: auto;
    }

    @media (max-width: 640px) {
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .hero-section {
            height: 50vh;
        }
    }
</style>
@endsection
