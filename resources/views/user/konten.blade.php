@extends('layouts.appCus')

@section('content')
<div class="min-h-screen bg-gray-50">
    {{-- <!-- Hero Section --> --}}
    <div class="bg-[url('https://media.istockphoto.com/id/1370966473/video/balinese-barong-ritual-dance-at-traditional-festival-in-ubud-village-bali-indonesia.jpg?s=640x640&k=20&c=q54ieSUWlatKV6rKXlepEj5DO7ufp3rAYOEx7m83A_s=')] bg-cover bg-center text-white py-48">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="font-lily text-4xl md:text-6xl mb-4 animate-fade-in">Warisan Budaya</h1>
                <p class="font-poppins text-lg md:text-xl opacity-90 max-w-2xl mx-auto">
                    Jelajahi kekayaan budaya Indonesia yang memukau dan penuh makna
                </p>
            </div>
        </div>
    </div>

    {{-- <!-- Action Bar --> --}}
    <div class="container mx-auto px-4 py-6">
        <form method="GET" action="{{ route('konten.index') }}">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                {{-- <!-- Search Bar --> --}}
                <div class="w-full md:w-auto flex-1 max-w-md">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari konten budaya..."
                               class="w-full px-4 py-3 pl-10 rounded-lg border border-gray-500 focus:ring-2 focus:ring-budanes focus:border-transparent transition-all">
                        <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                    </div>
                </div>

                {{-- <!-- Add Content --> --}}
                @auth
                <a href="{{route('konten.create')}}" class="text-white border-b-4 border-black w-full md:w-auto bg-budanes font-bold px-6 py-3 rounded-lg font-poppins hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center justify-center gap-2">
                    <i class="fas fa-plus"></i>
                    Tambah Konten
                </a>
                @endauth
            </div>
        </form>
    </div>

    {{-- <!-- Filter Section --> --}}
    <div class="container mx-auto px-4 mb-8">
        <form method="GET" action="{{ route('konten.index') }}" id="filterForm">
            {{-- <!-- Wrapper Flex  --> --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4 flex-wrap">
                {{-- <!-- Category --> --}}
                <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                    <button type="button" name="kategori" value="semua"
                        class="px-8 py-4 rounded-full text-sm font-medium transition-all
                        {{ !request('kategori') || request('kategori') == 'semua' ? 'bg-budanes text-white' : 'bg-white text-gray-700 border border-gray-500 hover:border-budanes hover:text-budanes' }}">
                        Semua
                    </button>
                    <button type="button" name="kategori" value="tarian"
                        class="px-8 py-4 rounded-full text-sm font-medium transition-all
                        {{ request('kategori') == 'tarian' ? 'bg-budanes text-white' : 'bg-white text-gray-700 border border-gray-500 hover:border-budanes hover:text-budanes' }}">
                        Tarian
                    </button>
                    <button type="button" name="kategori" value="musik"
                        class="px-8 py-4 rounded-full text-sm font-medium transition-all
                        {{ request('kategori') == 'musik' ? 'bg-budanes text-white' : 'bg-white text-gray-700 border border-gray-500 hover:border-budanes hover:text-budanes' }}">
                        Musik
                    </button>
                    <button type="button" name="kategori" value="kerajinan"
                        class="px-8 py-4 rounded-full text-sm font-medium transition-all
                        {{ request('kategori') == 'kerajinan' ? 'bg-budanes text-white' : 'bg-white text-gray-700 border border-gray-500 hover:border-budanes hover:text-budanes' }}">
                        Kerajinan
                    </button>
                    <button type="button" name="kategori" value="kuliner"
                        class="px-8 py-4 rounded-full text-sm font-medium transition-all
                        {{ request('kategori') == 'kuliner' ? 'bg-budanes text-white' : 'bg-white text-gray-700 border border-gray-500 hover:border-budanes hover:text-budanes' }}">
                        Kuliner
                    </button>
                    <button type="button" name="kategori" value="upacara"
                        class="px-8 py-4 rounded-full text-sm font-medium transition-all
                        {{ request('kategori') == 'upacara' ? 'bg-budanes text-white' : 'bg-white text-gray-700 border border-gray-500 hover:border-budanes hover:text-budanes' }}">
                        Upacara
                    </button>
                    <input type="hidden" name="kategori" id="kategoriInput" value="{{ request('kategori') }}">
                </div>

                <!-- Province Dropdown Filter -->
                <div>
                    <select name="asal" onchange="document.getElementById('filterForm').submit()"
                        class="w-full md:w-auto px-6 py-2 rounded-lg border border-gray-500 focus:ring-2 focus:ring-budanes focus:border-transparent transition-all font-poppins text-sm">
                        <option value="semua" {{ request('asal') == 'semua' || !request('asal') ? 'selected' : '' }}>Semua Provinsi</option>
                        @foreach($asalList as $asal)
                            <option value="{{ $asal }}" {{ request('asal') == $asal ? 'selected' : '' }}>{{ $asal }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Preserve search query -->
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
        </form>
    </div>


    <!-- Content Grid -->
    <div class="container mx-auto px-4 pb-16">
        @if($contents->isEmpty())
            <div class="text-center py-12">
                <i class="fas fa-info-circle text-4xl text-gray-400 mb-4"></i>
                <h3 class="font-montserrat font-bold text-xl text-gray-700 mb-2">Tidak ada konten ditemukan</h3>
                <p class="text-gray-500 font-poppins">Coba gunakan kata kunci atau filter yang berbeda</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($contents as $content)
                <a href="{{ route('kontenbudaya.show', $content->id) }}" class="block h-full">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 h-full flex flex-col">
                        <!-- Image Section with Fixed Height -->
                        <div class="relative h-48 bg-gradient-to-br from-budanes to-budanes-dark flex-shrink-0">
                            @if($content->thumbnail)
                                <img src="{{ asset('storage/' . $content->thumbnail) }}" alt="{{ $content->judul }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                    <i class="fas fa-image text-gray-300 text-4xl"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                            <div class="absolute bottom-4 left-4">
                                <span class="bg-white bg-opacity-90 text-budanes-darker px-3 py-1 rounded-full text-xs font-medium capitalize">
                                    {{ $content->kategori }}
                                </span>
                            </div>
                            <div class="absolute bottom-4 left-24">
                                <span class="bg-white bg-opacity-90 text-budanes-darker px-3 py-1 rounded-full text-xs font-medium">
                                    {{ $content->asal }}
                                </span>
                            </div>
                            <div class="absolute bottom-4 right-4">
                                <span class="bg-white bg-opacity-90 text-budanes-darker px-3 py-1 rounded-full text-xs font-medium">
                                    <i class="fas fa-eye text-budanes"></i> Jumlah views : {{ $content->views_count }}
                                </span>
                            </div>
                        </div>

                        <!-- Content Section with Flexible Height -->
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="font-montserrat font-bold text-xl text-gray-800 mb-2 line-clamp-1">{{ $content->judul }}</h3>
                            <p class="text-gray-600 font-poppins text-sm mb-4 line-clamp-3 flex-grow">
                                {{ Str::limit(strip_tags($content->isi), 120) }}
                            </p>
                            <div class="flex items-center justify-between mt-auto">
                                <div class="flex items-center text-gray-500 text-xs">
                                    <i class="far fa-clock mr-1"></i>
                                    {{ $content->created_at->diffForHumans() }}
                                </div>
                                <button class="text-budanes hover:text-budanes-dark transition-colors">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $contents->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

@endsection

<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'budanes': '#20f2f6',
                    'budanes-dark': '#2096f6',
                    'budanes-darker': '#1f00a8',
                    'dark': '#111827',
                    'darker': '#0D1321'
                },
                fontFamily: {
                    'montserrat': ['Montserrat', 'sans-serif'],
                    'poppins': ['Poppins', 'sans-serif'],
                    'lily': ['"Lily Script One"', 'cursive']
                },
                animation: {
                    'fade-in': 'fadeIn 0.6s ease-out forwards',
                }
            }
        }
    }

    // Add some interactive functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Heart button functionality
        const heartButtons = document.querySelectorAll('.fa-heart');
        heartButtons.forEach(heart => {
            heart.addEventListener('click', function() {
                if (this.classList.contains('far')) {
                    this.classList.remove('far');
                    this.classList.add('fas', 'text-red-500');
                } else {
                    this.classList.remove('fas', 'text-red-500');
                    this.classList.add('far');
                }
            });
        });
    });
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Pagination styling */
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
    }

    .pagination li {
        margin: 0 4px;
    }

    .pagination li a,
    .pagination li span {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 4px;
        border: 1px solid #e2e8f0;
        color: #4a5568;
        font-weight: 500;
        transition: all 0.2s;
    }

    .pagination li.active a {
        background-color: #20f2f6;
        border-color: #20f2f6;
        color: white;
    }

    .pagination li a:hover {
        background-color: #f7fafc;
        border-color: #cbd5e0;
    }

    /* Mobile responsive adjustments */
    @media (max-width: 640px) {
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .grid {
            gap: 1rem;
        }

        .pagination li a,
        .pagination li span {
            padding: 6px 12px;
            font-size: 0.875rem;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Category button functionality
        const categoryButtons = document.querySelectorAll('button[name="kategori"]');
        const kategoriInput = document.getElementById('kategoriInput');
        const filterForm = document.getElementById('filterForm');

        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Update the hidden input value
                kategoriInput.value = this.value;

                // Submit the form
                filterForm.submit();
            });
        });

        // Highlight active category button on page load
        const activeCategory = "{{ request('kategori') }}";
        if (activeCategory) {
            categoryButtons.forEach(button => {
                if (button.value === activeCategory) {
                    button.classList.add('bg-budanes', 'text-white');
                    button.classList.remove('bg-white', 'text-gray-700', 'border', 'border-gray-500');
                }
            });
        }
    });
</script>
