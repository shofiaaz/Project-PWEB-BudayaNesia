@extends('layouts.appCus')

@section('content')
@php
    $shareUrl = urlencode(request()->fullUrl());
    $shareText = urlencode($content->judul);
@endphp

<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="relative h-64 md:h-80 bg-gradient-to-r from-budanes-darker to-budanes-dark overflow-hidden">
        @if($content->thumbnail)
        <img src="{{ asset('storage/' . $content->thumbnail) }}" alt="{{ $content->judul }}"
             class="w-full h-full object-cover opacity-90">
        @else
        <div class="w-full h-full flex items-center justify-center">
            <i class="fas fa-image text-white text-6xl opacity-50"></i>
        </div>
        @endif
        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-end pb-8 px-6">
            <div class="container mx-auto">
                <h1 class="font-lily text-4xl md:text-5xl text-white mb-2 animate-fade-in">{{ $content->judul }}</h1>
                <div class="flex flex-wrap gap-3">
                    <span class="bg-white bg-opacity-90 text-budanes-darker px-3 py-1 rounded-full text-xs font-medium capitalize">
                        {{ $content->kategori }}
                    </span>
                    <span class="bg-white bg-opacity-90 text-budanes-darker px-3 py-1 rounded-full text-xs font-medium">
                        <i class="fas fa-map-marker-alt mr-1"></i> {{ $content->asal }}
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
                                    {{ $content->akun ? strtoupper(substr($content->akun->username, 0, 1)) : '?' }}
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">{{ $content->akun->username ?? 'Tidak diketahui' }}</p>
                                    <p class="text-xs text-gray-500">
                                        <i class="far fa-clock mr-1"></i> {{ $content->created_at->diffForHumans() }}
                                    </p>
                                </div>

                            </div>
                            <button class="text-gray-400 hover:text-budanes-darker transition-colors">
                                <i class="far fa-bookmark text-xl"></i>
                            </button>
                        </div>

                        <div class="prose max-w-none text-gray-700 font-poppins">
                            {!! $content->isi !!}
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="px-6 md:px-8 pb-6 md:pb-8">
                        <div class="border-t border-gray-100 pt-6">
                            <h4 class="font-medium text-gray-800 mb-3">Tags</h4>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">
                                    #{{ $content->kategori }}
                                </span>
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">
                                    #{{ str_replace(' ', '', $content->asal) }}
                                </span>
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">
                                    #budayaindonesia
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 md:p-8">
                        <h3 class="font-bold text-xl text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-comments text-budanes mr-2"></i> Komentar
                        </h3>

                        <!-- Comment Form -->
                        <div class="mb-8">
                            <textarea class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-budanes focus:border-transparent transition-all font-poppins mb-3"
                                      rows="3" placeholder="Tulis komentar Anda..."></textarea>
                            <button class="px-6 py-2 bg-budanes text-white rounded-lg font-medium font-poppins hover:bg-budanes-darker transition-all">
                                Kirim Komentar
                            </button>
                        </div>

                        <!-- Comment List -->
                        <div class="space-y-6">
                            <!-- Sample Comment 1 -->
                            <div class="flex gap-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full bg-budanes flex items-center justify-center text-white">
                                        A
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <div class="flex justify-between items-start mb-2">
                                            <h5 class="font-medium text-gray-800">Ahmad Santoso</h5>
                                            <span class="text-xs text-gray-500">2 jam lalu</span>
                                        </div>
                                        <p class="text-gray-600 text-sm">Sangat informatif! Saya jadi ingin mencoba membuat rendang sendiri setelah membaca ini.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Sample Comment 2 -->
                            <div class="flex gap-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full bg-budanes-dark flex items-center justify-center text-white">
                                        S
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <div class="flex justify-between items-start mb-2">
                                            <h5 class="font-medium text-gray-800">Siti Rahayu</h5>
                                            <span class="text-xs text-gray-500">1 hari lalu</span>
                                        </div>
                                        <p class="text-gray-600 text-sm">Terima kasih sudah membagikan pengetahuan tentang budaya kita. Sangat bermanfaat!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/3">
                <!-- Related Content -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
                    <div class="p-6 md:p-6">
                        <h3 class="font-bold text-xl text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-thumbtack text-budanes mr-2"></i> Konten Terkait
                        </h3>

                        @if($relatedContents->count() > 0)
                            <div class="space-y-4">
                                @foreach($relatedContents as $related)
                                <a href="{{ route('kontenbudaya.show', $related->id) }}" class="flex gap-3 group">
                                    <div class="flex-shrink-0 w-16 h-16 rounded-lg bg-gray-200 overflow-hidden">
                                        @if($related->thumbnail)
                                            <img src="{{ asset('storage/' . $related->thumbnail) }}" alt="{{ $related->judul }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800 group-hover:text-budanes transition-colors line-clamp-2">
                                            {{ $related->judul }}
                                        </h4>
                                        <p class="text-xs text-gray-500 capitalize">{{ $related->kategori }}</p>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-sm">Belum ada konten terkait</p>
                        @endif
                    </div>
                </div>

                <!-- Share Section -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 md:p-6">
                        <h3 class="font-bold text-xl text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-share-alt text-budanes mr-2"></i> Bagikan
                        </h3>
                        <div class="flex gap-3">
                            {{-- Facebook --}}
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}"
                               target="_blank"
                               class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f"></i>
                            </a>

                            {{-- Twitter --}}
                            <a href="https://twitter.com/intent/tweet?text={{ $shareText }}&url={{ $shareUrl }}"
                               target="_blank"
                               class="w-10 h-10 rounded-full bg-blue-400 text-white flex items-center justify-center hover:bg-blue-500 transition-colors">
                                <i class="fab fa-twitter"></i>
                            </a>

                            {{-- Pinterest --}}
                            <a href="https://pinterest.com/pin/create/button/?url={{ $shareUrl }}&description={{ $shareText }}"
                               target="_blank"
                               class="w-10 h-10 rounded-full bg-red-600 text-white flex items-center justify-center hover:bg-red-700 transition-colors">
                                <i class="fab fa-pinterest-p"></i>
                            </a>

                            {{-- WhatsApp --}}
                            <a href="https://wa.me/?text={{ $shareText }}%20{{ $shareUrl }}"
                               target="_blank"
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

    /* Mobile responsive adjustments */
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
