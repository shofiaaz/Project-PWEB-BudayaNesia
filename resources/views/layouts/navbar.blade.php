    <!-- Navbar -->
    <header class="sticky top-0 z-50" x-data="{
        scrollPosition: 0,
        updateScroll() {
            this.scrollPosition = window.scrollY;
        }
    }" @scroll.window="updateScroll()">
        <nav class="bg-white shadow-md transition-all duration-300" :class="{'shadow-lg': scrollPosition > 10}">
            <div class="container mx-auto px-4 py-3 flex justify-between items-center">
                <a href="/" class="inline-flex items-center transform hover:scale-105 transition-all duration-300">
                    <img src="{{ asset('assets/img/Budanes__1_-removebg-preview.png') }}" class="w-8 h-8 mr-2"> <span class="text-3xl font-extrabold tracking-tighter text-gray-900 font-monserrat">
                        Budaya
                    </span>
                    <span class="text-3xl font-extrabold tracking-tighter bg-budanes text-transparent bg-clip-text font-monserrat">
                        Nesia
                    </span>
                </a>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{route('home')}}" class="menu-item font-bold transition duration-200 hover:text-budanes">HOME</a>
                    <a href="{{route('konten.index')}}" class="menu-item font-bold transition duration-200 hover:text-budanes">KONTEN BUDAYA</a>
                    <a href="{{route('event.index')}}"  class="menu-item font-bold transition duration-200 hover:text-budanes">EVENT BUDAYA</a>
                    <a href="{{route('peta-budaya')}}"  class="menu-item font-bold transition duration-200 hover:text-budanes">PETA BUDAYA</a>

                    <div class="flex items-center space-x-4">
                        @auth
                            <div class="relative" x-data="{ menuOpen: false }">
                                <button @click="menuOpen = !menuOpen"
                                        @click.away="menuOpen = false"
                                        class="font-bold hover:text-budanes transition duration-200 flex items-center">LAINNYA
                                    <i class="fas fa-chevron-down w-3 h-3 ml-1 transition-transform duration-200"
                                       :class="{ 'transform rotate-180': menuOpen }"></i>
                                </button>
                                <div x-show="menuOpen"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute bg-white shadow-lg rounded-md mt-2 py-1 w-48 z-50 border-b-4 border-budanes">
                                    <a href="{{route('konten.histori')}}" class="block px-4 py-2 hover:text-white hover:bg-budanes transition duration-200">KONTRIBUSI KONTEN</a>
                                    <a href="{{route('event.histori')}}" class="block px-4 py-2 hover:bg-budanes hover:text-white transition duration-200">KONTRIBUSI EVENT</a>
                                    <a href="{{route('badge.index')}}" class="block px-4 py-2 hover:bg-budanes hover:text-white transition duration-200">BADGE LEVEL</a>
                                </div>
                            </div>

                            <div class="relative" x-data="{ accountOpen: false }">
                                <button @click="accountOpen = !accountOpen"
                                        @click.away="accountOpen = false"
                                        class="p-2 hover:text-budanes flex items-center">
                                    <i class="fas fa-user-circle text-xl"></i>
                                    <i class="fas fa-chevron-down w-3 h-3 ml-1 transition-transform duration-200"
                                       :class="{ 'transform rotate-180': accountOpen }"></i>
                                </button>
                                <div x-show="accountOpen"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute right-0 bg-white shadow-lg rounded-md mt-2 py-1 w-48 z-50 border-b-4 border-budanes">
                                    <a href="/profile" class="block px-4 py-2 hover:bg-budanes hover:text-white transition duration-200">Profil Saya</a>
                                    <form method="POST" action="/logout">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-budanes hover:text-white transition duration-200">Logout</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="/login" class="px-4 py-2 bg-budanes text-white rounded font-bold text-sm hover:bg-darker transition">
                                LOGIN / REGISTER
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="md:hidden flex items-center space-x-4">
                    @auth
                        <a href="/profile" class="p-2">
                            <i class="fas fa-user-circle text-xl"></i>
                        </a>
                    @else
                        <a href="/login" class="p-2">
                            <i class="fas fa-sign-in-alt text-xl"></i>
                        </a>
                    @endauth
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Mobile menu -->
        <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false"
            class="md:hidden bg-white shadow-lg absolute w-full z-50 border-b-4 border-budanes" x-cloak>
            <div class="container mx-auto px-4 py-4 flex flex-col space-y-4">
                <a href="/" class="py-2 font-bold border-b border-gray-100">HOME</a>
                <a href="{{route('konten.index')}} class="py-2 font-bold border-b border-gray-100">KONTEN BUDAYA</a>
                <a href="/event" class="py-2 font-bold border-b border-gray-100">EVENT BUDAYA</a>

                @auth
                    <div class="relative">
                        <button @click="mobileSubMenuOpen = !mobileSubMenuOpen" class="w-full py-2 font-bold border-b border-gray-100 flex justify-between items-center">
                            LAINNYA
                            <i :class="{'transform rotate-180': mobileSubMenuOpen}" class="fas fa-chevron-down transition-transform duration-200"></i>
                        </button>
                        <div x-show="mobileSubMenuOpen" class="pl-4 py-2 space-y-2">
                            <a href="{{route('konten.histori')}}" class="block px-4 py-2 hover:bg-budanes transition duration-200">KONTRIBUSI KONTEN</a>
                            <a href="" class="block px-4 py-2 hover:bg-budanes transition duration-200">KONTRIBUSI EVENT</a>
                            <a href="/badge" class="block py-1 transition duration-200">BADGE LEVEL</a>
                        </div>
                    </div>

                    <div class="relative">
                        <button @click="mobileAccountMenuOpen = !mobileAccountMenuOpen" class="w-full py-2 font-bold border-b border-gray-100 flex justify-between items-center">
                            AKUN SAYA
                            <i :class="{'transform rotate-180': mobileAccountMenuOpen}" class="fas fa-chevron-down transition-transform duration-200"></i>
                        </button>
                        <div x-show="mobileAccountMenuOpen" class="pl-4 py-2 space-y-2">
                            <a href="/profile" class="block py-1 transition duration-200">Profil Saya</a>
                            <form method="POST" action="/logout">
                                @csrf
                                <button type="submit" class="block py-1 transition duration-200">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="/login" class="block w-full text-center px-4 py-2 bg-dark text-budanes rounded font-bold text-sm hover:bg-darker transition">
                        LOGIN / REGISTER
                    </a>
                @endauth
            </div>
        </div>
    </header>
