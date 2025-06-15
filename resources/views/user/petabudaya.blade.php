@extends('layouts.appCus')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-budanes to-budanes-darker py-8">
    <div class="container mx-auto px-4">
        {{--  --}}
        <div class="text-center mb-12 animate-fade-in">
            <h1 class="text-4xl md:text-5xl font-bold text-white font-poppins mb-4">Peta Budaya Indonesia</h1>
            <p class="text-xl text-white font-montserrat max-w-3xl mx-auto">
                Jelajahi kekayaan budaya Indonesia melalui konten yang berasal dari berbagai provinsi melalui peta interaktif.
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Map Section -->
            <div class="lg:w-2/3 bg-white rounded-xl shadow-2xl overflow-hidden">
                <div id="map" class="w-full h-96 lg:h-[750px] rounded-xl"></div>
            </div>

            {{-- --}}
            <div class="lg:w-1/3">
                <div class="bg-white rounded-xl shadow-xl p-6 h-full">
                    <h2 class="text-2xl font-bold text-budanes-darker font-poppins mb-6 border-b pb-2">
                        <i class="fas fa-list-ul mr-2"></i> Daftar Konten Budaya
                    </h2>

                    {{-- --}}
                    <div class="mb-6">
                        <div class="flex flex-wrap gap-2 mt-3">
                            <button class="filter-btn active px-3 py-1 rounded-full text-sm bg-budanes text-white" data-filter="all">Semua</button>
                            <button class="filter-btn px-3 py-1 rounded-full text-sm bg-gray-200" data-filter="tarian">Tarian</button>
                            <button class="filter-btn px-3 py-1 rounded-full text-sm bg-gray-200" data-filter="musik">Musik</button>
                            <button class="filter-btn px-3 py-1 rounded-full text-sm bg-gray-200" data-filter="kuliner">Kuliner</button>
                            <button class="filter-btn px-3 py-1 rounded-full text-sm bg-gray-200" data-filter="upacara">Upacara</button>
                            <button class="filter-btn px-3 py-1 rounded-full text-sm bg-gray-200" data-filter="kerajinan">Kerajinan</button>
                            <button class="filter-btn px-3 py-1 rounded-full text-sm bg-gray-200" data-filter="situs budaya">Situs budaya</button>
                        </div>
                    </div>

                    {{----}}
                    <div id="content-list" class="overflow-y-auto max-h-[500px] pr-2">
                        @foreach($contents as $content)
                        <div class="content-item mb-4 p-4 rounded-lg border border-gray-300 hover:shadow-md transition-all cursor-pointer"
                             data-kategori="{{ $content->kategori }}"
                             data-provinsi="{{ $content->asal }}"
                             data-id="{{ $content->id }}">
                            <div class="flex items-start">
                                <img src="{{ $content->thumbnail ? asset('storage/' . $content->thumbnail) : asset('images/default-culture.jpg') }}"
                                     alt="{{ $content->judul }}"
                                     class="w-16 h-16 object-cover rounded-lg mr-4">
                                <div>
                                    <h3 class="font-semibold text-budanes-darker font-poppins">{{ $content->judul }}</h3>
                                    <div class="flex items-center text-sm text-gray-600 mt-1">
                                        <span class="capitalize bg-budanes bg-opacity-10 text-budanes px-2 py-0.5 rounded-full">{{ $content->kategori }}</span>
                                        <span class="mx-2">•</span>
                                        <span><i class="fas fa-map-marker-alt mr-1"></i> {{ $content->asal }}</span>
                                    </div>
                                    <p class="text-sm text-gray-700 mt-2 line-clamp-2">{{ Str::limit($content->isi, 100) }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--konten modal --}}
    <div id="content-modal" class="fixed inset-0 bg-black bg-opacity-50 z-[9999] hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <button id="close-modal" class="float-right text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
                <div id="modal-content" class="mt-2">
                    {{-- modal si konten --}}
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .leaflet-popup-content-wrapper {
        border-radius: 12px !important;
    }
    .leaflet-popup-content {
        margin: 12px !important;
    }
    .custom-popup .leaflet-popup-content-wrapper {
        background: #A41313;
        color: white;
        font-size: 14px;
    }
    .custom-popup .leaflet-popup-content-wrapper a {
        color: #fbbf24;
    }
    .custom-popup .leaflet-popup-tip-container {
        width: 30px;
        height: 15px;
    }
    .custom-popup .leaflet-popup-tip {
        background: #A41313;
    }
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.6s ease-out forwards;
    }
</style>

<script>
    // Initialize the map
    document.addEventListener('DOMContentLoaded', function() {
        const map = L.map('map').setView([-2.5489, 118.0149], 5);

        // Add tile layer (using OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const provinceCoordinates = {
            'Aceh': [4.6951, 96.7494],
            'Sumatera Utara': [2.1154, 99.5451],
            'Sumatera Barat': [-0.7397, 100.8000],
            'Riau': [0.2933, 101.7068],
            'Jambi': [-1.4852, 102.4380],
            'Sumatera Selatan': [-3.3194, 103.9144],
            'Bengkulu': [-3.5778, 102.3464],
            'Lampung': [-4.5586, 105.4068],
            'Bangka Belitung': [-2.4961, 106.4396],
            'Kepulauan Riau': [3.9456, 108.1429],
            'DKI Jakarta': [-6.2088, 106.8456],
            'Jawa Barat': [-6.9147, 107.6098],
            'Jawa Tengah': [-7.1509, 110.1403],
            'DI Yogyakarta': [-7.7956, 110.3695],
            'Jawa Timur': [-7.5361, 112.2384],
            'Banten': [-6.4058, 106.0640],
            'Bali': [-8.3405, 115.0920],
            'Nusa Tenggara Barat': [-8.6529, 117.3616],
            'Nusa Tenggara Timur': [-8.6574, 121.0794],
            'Kalimantan Barat': [-0.2788, 111.4753],
            'Kalimantan Tengah': [-1.6815, 113.3824],
            'Kalimantan Selatan': [-3.0926, 115.2838],
            'Kalimantan Timur': [0.5389, 116.4194],
            'Kalimantan Utara': [3.0738, 116.0414],
            'Sulawesi Utara': [0.6247, 123.9750],
            'Sulawesi Tengah': [-1.4300, 121.4456],
            'Sulawesi Selatan': [-3.6688, 119.9741],
            'Sulawesi Tenggara': [-3.5491, 121.7270],
            'Gorontalo': [0.6999, 122.4467],
            'Sulawesi Barat': [-2.8441, 119.2321],
            'Maluku': [-3.2385, 130.1453],
            'Maluku Utara': [1.5709, 127.8088],
            'Papua Barat': [-1.3361, 133.1747],
            'Papua': [-4.2699, 138.0804]
        };

        // MARKER BUAT KONTEN
        const markers = {};
        @foreach($contents as $content)
            @if(array_key_exists($content->asal, $provinceCoordinates))
                const marker{{ $content->id }} = L.marker([{{ $provinceCoordinates[$content->asal][0] }}, {{ $provinceCoordinates[$content->asal][1] }}], {
                    icon: L.divIcon({
                        className: 'custom-marker',
                        html: `<div class="relative">
                            <div class="w-8 h-8 bg-budanes-dark rounded-full flex items-center justify-center text-white font-bold shadow-lg">${getCategoryIcon('{{ $content->kategori }}')}</div>
                            <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-l-transparent border-r-transparent border-t-budanes-dark"></div>
                        </div>`,
                        iconSize: [32, 32],
                        iconAnchor: [16, 32]
                    })
                }).addTo(map);

                marker{{ $content->id }}.on('click', function() {
                    document.querySelector(`.content-item[data-id="{{ $content->id }}"]`).scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                    const item = document.querySelector(`.content-item[data-id="{{ $content->id }}"]`);
                    item.classList.add('ring-2', 'ring-budanes');
                    setTimeout(() => {
                        item.classList.remove('ring-2', 'ring-budanes');
                    }, 2000);
                });

                markers['{{ $content->id }}'] = marker{{ $content->id }};
            @endif
        @endforeach

        // Add click event konten
        document.querySelectorAll('.content-item').forEach(item => {
            item.addEventListener('click', function() {
                const contentId = this.getAttribute('data-id');
                const provinsi = this.getAttribute('data-provinsi');

                // Fly to the marker
                if (markers[contentId] && provinceCoordinates[provinsi]) {
                    map.flyTo(markers[contentId].getLatLng(), 7);

                    // Open popup
                    markers[contentId].openPopup();

                    // bounce effect
                    markers[contentId].setIcon(
                        L.divIcon({
                            className: 'custom-marker-bounce',
                            html: `<div class="relative animate-bounce">
                                <div class="w-8 h-8 bg-budanes-dark rounded-full flex items-center justify-center text-white font-bold shadow-lg">${getCategoryIcon(this.getAttribute('data-kategori'))}</div>
                                <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-l-transparent border-r-transparent border-t-budanes-dark"></div>
                            </div>`,
                            iconSize: [32, 32],
                            iconAnchor: [16, 32]
                        })
                    );

                    setTimeout(() => {
                        markers[contentId].setIcon(
                            L.divIcon({
                                className: 'custom-marker',
                                html: `<div class="relative">
                                    <div class="w-8 h-8 bg-red-400 rounded-full flex items-center justify-center text-white font-bold shadow-lg">${getCategoryIcon(this.getAttribute('data-kategori'))}</div>
                                    <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-l-transparent border-r-transparent border-t-red-400"></div>
                                </div>`,
                                iconSize: [32, 32],
                                iconAnchor: [16, 32]
                            })
                        );
                    }, 1500);
                }

                // Load content via AJAX
                fetch(`/konten/${contentId}`)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('modal-content').innerHTML = html;
                        document.getElementById('content-modal').classList.remove('hidden');
                    });
            });
        });

        // Close modal
        document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('content-modal').classList.add('hidden');
        });

        // Filter functionality
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');

                // Update active button
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active', 'bg-budanes', 'text-white'));
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.add('bg-gray-200'));
                this.classList.add('active', 'bg-budanes', 'text-white');
                this.classList.remove('bg-gray-200');

                // Filter content
                document.querySelectorAll('.content-item').forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-kategori') === filter) {
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                    }
                });
            });
        });

        // Function to get category icon
        function getCategoryIcon(kategori) {
            const icons = {
                'tarian': '🕺',
                'musik': '🎵',
                'kuliner': '🍲',
                'upacara': '🎎',
                'kerajinan': '🧶',
                'situs budaya': '🏛'
            };
            return icons[kategori] || '🌟';
        }
    });
</script>
@endsection
