@extends('layouts.appCus')

@section('content')
<div class="min-h-screen bg-gray-50">
    {{-- <!-- Hero Section with Most Viewed Content --> --}}
    @if($topContents->isNotEmpty())
    @php $topContent = $topContents->first(); @endphp
    <div class="relative h-screen max-h-[50vh] overflow-hidden">
        {{-- Label di pojok kanan atas --}}
        <div class="absolute top-6 right-6 z-40 bg-budanes text-white backdrop-blur-md px-5 py-2 rounded-full shadow-lg text-sm md:text-base font-semibold tracking-wide">
            Konten dengan views terbanyak
        </div>
        <div class="absolute inset-0 bg-black bg-opacity-40 z-10"></div>
        @if($topContent->thumbnail)
            <img src="{{ asset('storage/' . $topContent->thumbnail) }}" alt="{{ $topContent->judul }}"
                class="w-full h-full object-cover">
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-purple-900 to-blue-800">
                <i class="fas fa-image text-white text-6xl opacity-30"></i>
            </div>
        @endif
        <div class="absolute bottom-0 left-0 z-20 w-full h-1/2 bg-gradient-to-t from-black to-transparent"></div>
        <div class="absolute z-30 bottom-20 left-0 right-0 container mx-auto px-8 text-white">
            <div class="max-w-2xl">
                <span class="inline-block px-4 py-1 mb-4 text-xs font-semibold tracking-wider text-white uppercase bg-budanes rounded-full">
                    {{ $topContent->kategori }}
                </span>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 font-serif leading-tight">
                    {{ $topContent->judul }}
                </h2>
                <p class="text-lg md:text-xl mb-6 opacity-90 line-clamp-2">
                    {{ Str::limit(strip_tags($topContent->isi), 150) }}
                </p>
                <div class="flex items-center space-x-4">
                    <span class="flex items-center text-sm">
                        <i class="fas fa-map-marker-alt mr-2"></i> {{ $topContent->asal }}
                    </span>
                    <span class="flex items-center text-sm">
                        <i class="fas fa-eye mr-2"></i> {{ $topContent->views_count }} views
                    </span>
                </div>
                <a href="{{ route('kontenbudaya.show', $topContent->id) }}" class="mt-6 inline-block px-8 py-3 bg-budanes hover:bg-budanes-dark text-white font-medium rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Explore Now
                </a>
            </div>
        </div>
    </div>
    @endif

    {{-- <!-- Search and Filter Section --> --}}
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-8">
            <form method="GET" action="{{ route('konten.index') }}" class="mb-6">
                <div class="flex flex-col md:flex-row gap-6 items-center">
                    {{-- --}}
                    <div class="flex-1 w-full max-w-2xl">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Cari konten budaya..."
                                   class="w-full px-6 py-4 pl-14 rounded-full border-2 border-gray-200 focus:border-budanes focus:ring-0 transition-all text-lg">
                            <i class="fas fa-search absolute left-5 top-1/2 transform -translate-y-1/2 text-gray-400 text-xl"></i>
                        </div>
                    </div>

                    {{-- --}}
                    @auth
                    <a href="{{route('konten.create')}}"
                       class="w-full md:w-auto ml-auto bg-gradient-to-r from-budanes to-red-900 text-white font-bold px-8 py-4 rounded-full hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center gap-3">
                        <i class="fas fa-plus-circle text-xl"></i>
                        <span>Tambah Konten</span>
                    </a>
                    @endauth
                </div>
            </form>

            {{-- <!-- Filter Section --> --}}
            <form method="GET" action="{{ route('konten.index') }}" id="filterForm">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    {{-- <!-- Category Tabs --> --}}
                    <div class="flex flex-wrap gap-3">
                        <button type="button" name="kategori" value="semua"
                            class="px-6 py-2 rounded-full text-sm font-medium transition-all
                            {{ !request('kategori') || request('kategori') == 'semua' ? 'bg-budanes text-white shadow-md' : 'bg-white text-gray-700 border border-gray-200 hover:border-budanes hover:text-budanes' }}">
                            Semua
                        </button>
                        <button type="button" name="kategori" value="tarian"
                            class="px-6 py-2 rounded-full text-sm font-medium transition-all
                            {{ request('kategori') == 'tarian' ? 'bg-budanes text-white shadow-md' : 'bg-white text-gray-700 border border-gray-200 hover:border-budanes hover:text-budanes' }}">
                            Tarian
                        </button>
                        <button type="button" name="kategori" value="musik"
                            class="px-6 py-2 rounded-full text-sm font-medium transition-all
                            {{ request('kategori') == 'musik' ? 'bg-budanes text-white shadow-md' : 'bg-white text-gray-700 border border-gray-200 hover:border-budanes hover:text-budanes' }}">
                            Musik
                        </button>
                        <button type="button" name="kategori" value="kerajinan"
                            class="px-6 py-2 rounded-full text-sm font-medium transition-all
                            {{ request('kategori') == 'kerajinan' ? 'bg-budanes text-white shadow-md' : 'bg-white text-gray-700 border border-gray-200 hover:border-budanes hover:text-budanes' }}">
                            Kerajinan
                        </button>
                        <button type="button" name="kategori" value="kuliner"
                            class="px-6 py-2 rounded-full text-sm font-medium transition-all
                            {{ request('kategori') == 'kuliner' ? 'bg-budanes text-white shadow-md' : 'bg-white text-gray-700 border border-gray-200 hover:border-budanes hover:text-budanes' }}">
                            Kuliner
                        </button>
                        <button type="button" name="kategori" value="upacara"
                            class="px-6 py-2 rounded-full text-sm font-medium transition-all
                            {{ request('kategori') == 'upacara' ? 'bg-budanes text-white shadow-md' : 'bg-white text-gray-700 border border-gray-200 hover:border-budanes hover:text-budanes' }}">
                            Upacara
                        </button>
                        <button type="button" name="kategori" value="situs budaya"
                            class="px-6 py-2 rounded-full text-sm font-medium transition-all
                            {{ request('kategori') == 'situs budaya' ? 'bg-budanes text-white shadow-md' : 'bg-white text-gray-700 border border-gray-200 hover:border-budanes hover:text-budanes' }}">
                            Situs budaya
                        </button>
                        <input type="hidden" name="kategori" id="kategoriInput" value="{{ request('kategori') }}">
                    </div>

                    {{-- <!-- Province Dropdown --> --}}
                    <div class="w-full lg:w-auto">
                        <div class="relative">
                            <select name="asal" onchange="document.getElementById('filterForm').submit()"
                                class="appearance-none w-full lg:w-64 px-6 py-3 pr-10 rounded-full border-2 border-gray-200 focus:border-budanes focus:ring-0 transition-all font-medium text-gray-700 bg-white bg-clip-padding">
                                <option value="semua" {{ request('asal') == 'semua' || !request('asal') ? 'selected' : '' }}>Semua Provinsi</option>
                                @foreach($asalList as $asal)
                                    <option value="{{ $asal }}" {{ request('asal') == $asal ? 'selected' : '' }}>{{ $asal }}</option>
                                @endforeach
                            </select>
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
            </form>
        </div>
    </div>

    {{-- <!-- Content Grid --> --}}
    <div class="container mx-auto px-4 py-16">
        @if($contents->isEmpty())
            <div class="text-center py-20">
                <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-search text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">Tidak ada konten ditemukan</h3>
                <p class="text-gray-500 max-w-md mx-auto">Coba gunakan kata kunci atau filter yang berbeda untuk menemukan konten budaya yang menarik</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($contents as $content)
                <div class="group relative bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 h-full flex flex-col">
                    {{-- <!-- Image with Overlay --> --}}
                    <div class="relative h-64 overflow-hidden">
                        @if($content->thumbnail)
                            <img src="{{ asset('storage/' . $content->thumbnail) }}" alt="{{ $content->judul }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                <i class="fas fa-image text-gray-300 text-5xl"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute top-4 right-4 flex space-x-2">
                            <span class="bg-white/90 text-budanes-darker px-3 py-1 rounded-full text-xs font-medium capitalize shadow-sm">
                                {{ $content->kategori }}
                            </span>
                            <span class="bg-white/90 text-budanes-darker px-3 py-1 rounded-full text-xs font-medium shadow-sm">
                                {{ $content->asal }}
                            </span>
                        </div>
                    </div>

                    {{-- <!-- Content --> --}}
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 leading-snug">{{ $content->judul }}</h3>
                        <p class="text-gray-600 text-sm mb-5 line-clamp-3 flex-grow">
                            {{ Str::limit(strip_tags($content->isi), 120) }}
                        </p>
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center text-gray-500 text-xs">
                                    <i class="far fa-clock mr-1"></i>
                                    {{ $content->created_at->diffForHumans() }}
                                </div>
                                <div class="flex items-center text-gray-500 text-xs">
                                    <i class="fas fa-eye mr-1"></i>
                                    {{ $content->views_count }}
                                </div>
                            </div>
                            <a href="{{ route('kontenbudaya.show', $content->id) }}" class="text-sm font-medium text-budanes hover:text-budanes-dark transition-colors flex items-center">
                                Baca Selengkapnya
                                <i class="fas fa-chevron-right ml-1 text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- <!-- Pagination --> --}}
            <div class="mt-16">
                {{ $contents->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
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
                    'serif': ['"Playfair Display"', 'serif']
                }
            }
        }
    }

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

        // Heart button functionality
        document.querySelectorAll('.fa-heart').forEach(heart => {
            heart.addEventListener('click', function(e) {
                e.preventDefault();
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

