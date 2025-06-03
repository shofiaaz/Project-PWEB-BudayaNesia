@extends('layouts.appCus')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-budanes-darker to-budanes-dark py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center">
                <h1 class="font-lily text-4xl md:text-5xl text-white mb-2 animate-fade-in">Sistem Badge Level</h1>
                <p class="font-poppins text-lg text-white opacity-90">Kelola level kontribusimu dan lihat ranking antar kontrinutor berdasarkan setiap aktivitas yang telah kamu lakukan</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- User Current Badge Section -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="p-6 border-b border-gray-200">
                <h2 class="font-bold text-2xl text-gray-800 flex items-center">
                    <i class="fas fa-user-circle text-budanes mr-3"></i> Status Badge Saya
                </h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Current Badge -->
                    <div class="bg-gradient-to-br from-gray-100 to-gray-50 rounded-xl p-6 text-center border border-gray-200">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-r {{ $badgeInfo['current']['color'] ?? 'from-gray-300 to-gray-400' }} rounded-full flex items-center justify-center text-white mb-4">
                            <i class="{{ $badgeInfo['current']['icon'] ?? 'fas fa-user' }} text-4xl"></i>
                        </div>
                        <h3 class="font-bold text-xl text-gray-800 mb-2">{{ $badgeInfo['current']['name'] ?? 'Abdi' }}</h3>
                        <p class="text-gray-600 text-sm mb-3">{{ $badgeInfo['currentPoin'] }} Poin</p>
                        <span class="inline-block px-3 py-1 bg-budanes-dark text-budanes-darker rounded-full text-xs font-bold">
                            LEVEL {{ $badgeInfo['current']['level'] ?? 1 }}
                        </span>
                    </div>

                    <!-- Progress to Next Level -->
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6">
                        <h4 class="font-bold text-lg text-gray-800 mb-4">Progress ke Level Berikutnya</h4>
                        @if($badgeInfo['next'])
                            <div class="mb-4">
                                <div class="flex justify-between text-sm text-gray-600 mb-2">
                                    <span>{{ $badgeInfo['current']['name'] }}</span>
                                    <span>{{ $badgeInfo['next']['name'] }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-budanes to-budanes-dark h-3 rounded-full transition-all"
                                         style="width: {{ $badgeInfo['progress'] }}%"></div>
                                </div>
                                <p class="text-sm text-gray-600 mt-2">
                                    {{ number_format($badgeInfo['progress'], 1) }}% menuju {{ $badgeInfo['next']['name'] }}
                                </p>
                            </div>
                            <p class="text-sm text-gray-600">
                                Butuh {{ $badgeInfo['next']['min'] - $badgeInfo['currentPoin'] }} poin lagi
                            </p>
                        @else
                            <div class="text-center">
                                <i class="fas fa-crown text-4xl text-yellow-500 mb-2"></i>
                                <p class="text-gray-600">Anda sudah mencapai level tertinggi!</p>
                            </div>
                        @endif
                    </div>

                    <!-- User Stats -->
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6">
                        <h4 class="font-bold text-lg text-gray-800 mb-4">Statistik Saya</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Konten Approved:</span>
                                <span class="font-bold text-budanes-darker">{{ $userBadge->konten_approved ?? 0 }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Total Poin:</span>
                                <span class="font-bold text-budanes-darker">{{ $userBadge->poin ?? 0 }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Badge Level:</span>
                                <span class="font-bold text-budanes-darker">{{ $userBadge->status ?? 'Abdi' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Badge Level Section -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="p-6 border-b border-gray-200">
                <h2 class="font-bold text-2xl text-gray-800 flex items-center">
                    <i class="fas fa-medal text-budanes mr-3"></i> Tingkat Badge Pengguna
                </h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                    <!-- Abdi Badge -->
                    <div class="bg-gradient-to-br from-gray-100 to-gray-50 rounded-xl p-6 text-center border border-gray-200 hover:shadow-md transition-all">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-r from-gray-300 to-gray-400 rounded-full flex items-center justify-center text-white mb-4">
                            <i class="fas fa-user text-4xl"></i>
                        </div>
                        <h3 class="font-bold text-xl text-gray-800 mb-2">Abdi</h3>
                        <p class="text-gray-600 text-sm mb-3">0 - 100 Poin</p>
                        <span class="inline-block px-3 py-1 bg-budanes-dark text-budanes-darker rounded-full text-xs font-bold">LEVEL 1</span>
                    </div>

                    <!-- Panewu Badge -->
                    <div class="bg-gradient-to-br from-gray-100 to-gray-50 rounded-xl p-6 text-center border border-gray-200 hover:shadow-md transition-all">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-r from-yellow-200 to-yellow-400 rounded-full flex items-center justify-center text-white mb-4">
                            <i class="fas fa-user-shield text-4xl"></i>
                        </div>
                        <h3 class="font-bold text-xl text-gray-800 mb-2">Panewu</h3>
                        <p class="text-gray-600 text-sm mb-3">101 - 500 Poin</p>
                        <span class="inline-block px-3 py-1 bg-budanes-dark text-budanes-darker rounded-full text-xs font-bold">LEVEL 2</span>
                    </div>

                    <!-- Adipati Badge -->
                    <div class="bg-gradient-to-br from-gray-100 to-gray-50 rounded-xl p-6 text-center border border-gray-200 hover:shadow-md transition-all">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-r from-blue-300 to-blue-500 rounded-full flex items-center justify-center text-white mb-4">
                            <i class="fas fa-crown text-4xl"></i>
                        </div>
                        <h3 class="font-bold text-xl text-gray-800 mb-2">Adipati</h3>
                        <p class="text-gray-600 text-sm mb-3">501 - 1000 Poin</p>
                        <span class="inline-block px-3 py-1 bg-budanes-dark text-budanes-darker rounded-full text-xs font-bold">LEVEL 3</span>
                    </div>

                    <!-- Mahapatih Badge -->
                    <div class="bg-gradient-to-br from-gray-100 to-gray-50 rounded-xl p-6 text-center border border-gray-200 hover:shadow-md transition-all">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-r from-purple-300 to-purple-500 rounded-full flex items-center justify-center text-white mb-4">
                            <i class="fas fa-chess-queen text-4xl"></i>
                        </div>
                        <h3 class="font-bold text-xl text-gray-800 mb-2">Mahapatih</h3>
                        <p class="text-gray-600 text-sm mb-3">1001 - 2000 Poin</p>
                        <span class="inline-block px-3 py-1 bg-budanes-dark text-budanes-darker rounded-full text-xs font-bold">LEVEL 4</span>
                    </div>

                    <!-- Sultan Badge -->
                    <div class="bg-gradient-to-br from-gray-100 to-gray-50 rounded-xl p-6 text-center border border-gray-200 hover:shadow-md transition-all">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-r from-red-400 to-budanes-darker rounded-full flex items-center justify-center text-white mb-4">
                            <i class="fas fa-gem text-4xl"></i>
                        </div>
                        <h3 class="font-bold text-xl text-gray-800 mb-2">Sultan</h3>
                        <p class="text-gray-600 text-sm mb-3">2000+ Poin</p>
                        <span class="inline-block px-3 py-1 bg-budanes-dark text-budanes-darker rounded-full text-xs font-bold">LEVEL 5</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Ranking Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Top Users by Points -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="font-bold text-2xl text-gray-800 flex items-center">
                        <i class="fas fa-trophy text-budanes mr-3"></i> Ranking Pengguna
                    </h2>
                    <p class="text-gray-600 text-sm mt-1">Top 10 pengguna dengan poin tertinggi</p>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($topUsers as $index => $user)
                    <div class="p-4 hover:bg-gray-50 transition-colors {{ Auth::id() == $user->akun_id ? 'bg-budanes-light border-l-4 border-budanes' : '' }}">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full {{ Auth::id() == $user->akun_id ? 'bg-budanes-darker' : 'bg-budanes' }} text-white flex items-center justify-center font-bold mr-4">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-gray-800 truncate">
                                    {{ $user->username }}
                                    @if(Auth::id() == $user->akun_id)
                                        <span class="text-xs bg-budanes-darker text-white px-2 py-1 rounded-full ml-2">Anda</span>
                                    @endif
                                </p>
                                <p class="text-sm text-gray-500 flex items-center">
                                    <span class="inline-block w-2 h-2 rounded-full bg-budanes mr-1"></span>
                                    {{ $user->status ?? 'Abdi' }}
                                </p>
                            </div>
                            <div class="ml-4">
                                <span class="px-3 py-1 bg-budanes-dark text-budanes-darker rounded-full text-sm font-bold">
                                    {{ $user->poin ?? 0 }} Poin
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center text-gray-500">
                        <i class="fas fa-trophy text-4xl mb-4 opacity-50"></i>
                        <p>Belum ada data ranking pengguna</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- My Top Contents -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="font-bold text-2xl text-gray-800 flex items-center">
                        <i class="fas fa-eye text-budanes mr-3"></i> Konten Populer Saya
                    </h2>
                    <p class="text-gray-600 text-sm mt-1">Top 10 konten approved Anda dengan view terbanyak</p>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($topContents as $index => $content)
                    <div class="p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-budanes text-white flex items-center justify-center font-bold mr-4">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-gray-800 truncate">{{ $content->judul }}</p>
                                <p class="text-sm text-gray-500 flex items-center">
                                    <span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-1"></span>
                                    {{ $content->kategori }} • {{ $content->views_count }} views
                                    <span class="ml-2 text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Approved</span>
                                </p>
                            </div>
                            <div class="ml-4">
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-medium capitalize">
                                    {{ $content->asal }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center text-gray-500">
                        <i class="fas fa-file-alt text-4xl mb-4 opacity-50"></i>
                        <p>Belum ada konten yang approved</p>
                        <p class="text-sm mt-2">Upload konten untuk mendapatkan poin badge!</p>
                    </div>
                    @endforelse
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

    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }

    /* Mobile responsive adjustments */
    @media (max-width: 640px) {
        .grid-cols-5 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .grid-cols-2 {
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    }
</style>

@endsection
