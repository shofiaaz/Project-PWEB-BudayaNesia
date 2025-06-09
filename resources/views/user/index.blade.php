@extends('layouts.appCus')

@section('content')
    @auth
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('alert_tampil'))
                const username = "{{ session('nama_login') }}";
                Swal.fire({
                    title: 'Login Berhasil!',
                    text: `Selamat datang, ${username}!`,
                    icon: 'success',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'confirm',
                    },
                    buttonsStyling: false,
                });
                @php
                    session()->forget('alert_tampil');
                    session()->forget('nama_login');
                @endphp
            @endif
        });
    </script>
    @endauth
    <!-- Hero Section -->
    <section class="relative h-screen max-h-[800px] overflow-hidden">
        <div class="absolute inset-0 bg-black/30 z-10"></div>
        <template x-for="(slide, index) in slides" :key="index">
            <div
                x-show="currentSlide === index"
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-1000"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0 w-full h-full"
            >
                <img :src="slide.image" :alt="slide.title" class="w-full h-full object-cover">
            </div>
        </template>

        <div class="relative z-20 h-full flex items-center">
            <div class="container mx-auto px-4 text-white">
                <div class="max-w-2xl">
                    <h1 x-text="slides[currentSlide].title" class="text-4xl md:text-6xl font-bold mb-4 font-montserrat animate-fade-in"></h1>
                    <p x-text="slides[currentSlide].subtitle" class="text-xl md:text-2xl mb-8 animate-fade-in animate-delay-100"></p>
                    <a href="{{route('konten.index')}}"
                        class="border-b-8 border border-black px-8 py-3 bg-budanes text-white font-bold rounded-lg hover:text-black hover:bg-budanes-dark transition duration-300 animate-fade-in animate-delay-200 inline-flex items-center">
                        <span x-text="slides[currentSlide].cta"></span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>

                </div>
            </div>
        </div>

        <!-- Slider Controls -->
        <button @click="prevSlide" class="absolute left-4 top-1/2 z-30 -translate-y-1/2 bg-white/30 text-white p-3 rounded-full hover:bg-white/50 transition">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button @click="nextSlide" class="absolute right-4 top-1/2 z-30 -translate-y-1/2 bg-white/30 text-white p-3 rounded-full hover:bg-white/50 transition">
            <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Slider Indicators -->
        <div class="absolute bottom-8 left-1/2 z-30 -translate-x-1/2 flex space-x-2">
            <template x-for="(slide, index) in slides" :key="index">
                <button
                    @click="currentSlide = index"
                    class="w-3 h-3 rounded-full transition duration-300"
                    :class="{'bg-budanes w-6': currentSlide === index, 'bg-white/50': currentSlide !== index}"
                ></button>
            </template>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4 font-montserrat">Kenali Fitur <span class="border-b-4 border-black text-white rounded-lg py-2 px-4 bg-budanes">BudayaNesia</span></h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Temukan berbagai fitur menarik yang membantu Anda mengenal dan melestarikan budaya Indonesia</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border-b-4 border-budanes transform hover:-translate-y-2 transition duration-300">
                    <div class="p-6">
                        <div class="w-16 h-16 bg-budanes rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-book-open text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-2">Konten Budaya</h3>
                        <p class="text-gray-600">Jelajahi berbagai konten budaya dari seluruh nusantara dalam bentuk konten, foto, dan video.</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border-b-4 border-budanes transform hover:-translate-y-2 transition duration-300">
                    <div class="p-6">
                        <div class="w-16 h-16 bg-budanes rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-calendar-alt text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-2">Event Budaya</h3>
                        <p class="text-gray-600">Temukan dan ikuti berbagai event budaya terdekat untuk pengalaman langsung.</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border-b-4 border-budanes transform hover:-translate-y-2 transition duration-300">
                    <div class="p-6">
                        <div class="w-16 h-16 bg-budanes rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-history text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-2">Histori</h3>
                        <p class="text-gray-600">Lacak aktivitas dan pencapaian Anda dalam menjelajahi budaya nusantara.</p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border-b-4 border-budanes transform hover:-translate-y-2 transition duration-300">
                    <div class="p-6">
                        <div class="w-16 h-16 bg-budanes rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-trophy text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-2">Badge Level</h3>
                        <p class="text-gray-600">Dapatkan badge sebagai bukti partisipasi dan pengetahuan budaya Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

{{-- Konten --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4 font-montserrat">Konten Populer</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Temukan budaya-budaya yang sedang populer di kalangan pengguna</p>
            </div>

            @if($popularContents->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($popularContents as $content)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden border-b-4 border-budanes">
                        @if($content->thumbnail)
                            <img src="{{ asset('storage/' . $content->thumbnail) }}" alt="{{ $content->judul }}" class="w-full h-48 object-cover">
                        @else
                            <img src="https://via.placeholder.com/400x200?text=No+Thumbnail" alt="No Thumbnail" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <div class="flex items-center mb-2">
                                <span class="px-2 py-1 bg-budanes-dark text-dark text-xs font-bold rounded">{{ $content->kategori }}</span>
                                <span class="ml-2 text-xs text-gray-500">{{ $content->views_count }} pengunjung</span>
                            </div>
                            <h3 class="text-xl font-bold text-dark mb-2">{{ $content->judul }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($content->isi, 100) }}</p>
                            <a href="{{ route('kontenbudaya.show', $content->id) }}" class="text-budanes-darker font-semibold hover:underline flex items-center">
                                Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500">Belum ada konten yang tersedia</p>
                </div>
            @endif

            <div class="text-center mt-12">
                <a href="{{ route('konten.index') }}" class="inline-block px-8 py-3 bg-budanes text-white font-bold rounded-lg hover:bg-darker transition duration-300">
                    Lihat Semua Budaya <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- Event --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4 font-montserrat">Event Mendatang</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Ikuti event budaya menarik yang akan datang</p>
            </div>

            @if($upcomingEvents->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($upcomingEvents as $event)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden border-b-4 border-budanes flex flex-col md:flex-row">
                        <div class="md:w-1/3">
                            @if($event->thumbnail)
                                <img src="{{ asset('storage/' . $event->thumbnail) }}" alt="{{ $event->judul }}" class="w-full h-full object-cover">
                            @else
                                <img src="https://via.placeholder.com/400x200?text=No+Thumbnail" alt="No Thumbnail" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="p-6 md:w-2/3">
                            <div class="flex items-center mb-2">
                                <span class="px-2 py-1 bg-budanes-dark text-dark text-xs font-bold rounded">{{ $event->tempat }}</span>
                                <span class="ml-2 text-xs text-gray-500">{{ $event->jadwal->format('d M Y') }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-dark mb-2">{{ $event->judul }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($event->isi, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-semibold text-budanes-darker">
                                    @if($event->harga > 0)
                                        Rp {{ number_format($event->harga, 0, ',', '.') }}
                                    @else
                                        Gratis
                                    @endif
                                </span>
                                <a href="{{ route('event.show', $event->id) }}" class="text-sm font-semibold text-dark hover:underline flex items-center">
                                    Detail <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500">Belum ada event mendatang</p>
                </div>
            @endif

            <div class="text-center mt-12">
                <a href="{{ route('event.index') }}" class="inline-block px-8 py-3 bg-budanes text-white font-bold rounded-lg hover:bg-darker transition duration-300">
                    Lihat Semua Event <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4 font-montserrat">Apa Kata Mereka?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Testimoni dari pengguna BudayaNesia</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-6 rounded-lg shadow-lg border-b-4 border-budanes">
                    <div class="flex items-center mb-4">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-dark">Sarah Wijaya</h4>
                            <div class="flex text-budanes-darker">
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"BudayaNesia membantu saya menemukan berbagai event budaya yang tidak saya ketahui sebelumnya. Sangat informatif!"</p>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white p-6 rounded-lg shadow-lg border-b-4 border-budanes">
                    <div class="flex items-center mb-4">
                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="User" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-dark">Budi Santoso</h4>
                            <div class="flex text-budanes-darker">
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Saya suka fitur badge level-nya, membuat saya termotivasi untuk terus belajar tentang budaya Indonesia."</p>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white p-6 rounded-lg shadow-lg border-b-4 border-budanes">
                    <div class="flex items-center mb-4">
                        <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="User" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-dark">Dewi Lestari</h4>
                            <div class="flex text-budanes-darker">
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Konten-konten budaya di sini sangat lengkap dan mudah dipahami. Cocok untuk semua usia!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    @auth

    @else
        <section class="py-16 bg-budanes text-white">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 font-montserrat">Siap Memulai Perjalanan Budaya Anda?</h2>
                <p class="text-xl mb-8 max-w-2xl mx-auto">Bergabunglah dengan ribuan orang yang telah menjelajahi kekayaan budaya Indonesia melalui BudayaNesia</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{'login'}}" class="px-8 py-3 bg-budanes-dark text-dark font-bold rounded-lg hover:text-white hover:bg-budanes-darker transition duration-300">
                        Daftar Sekarang
                    </a>
                    <a href="/about" class="px-8 py-3 border-2 border-white text-white font-bold rounded-lg hover:text-black hover:bg-white transition duration-300">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </section>
    @endauth

@endsection
