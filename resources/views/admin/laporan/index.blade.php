@extends('layouts.appAdmin')

@section('content')
<div class="mx-auto px-4 py-8 mt-14 sm:ml-64 min-h-screen">
    <div class="max-w-7xl mx-auto">
        {{-- Header Section --}}
        <div class="mb-8 bg-white rounded-2xl p-6 border border-gray-200 shadow-lg">
            <div class="flex flex-col sm:flex-row justify-start items-center sm:items-center gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-black flex items-center">
                        <i class="fas fa-chart-line text-budanes mr-3"></i>
                        Laporan Kontribusi
                    </h1>
                    <p class="text-black mt-2">Analisis kontribusi pengguna dan performa konten</p>
                </div>
            </div>
        </div>

        {{-- Statistics Cards --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            {{-- Total Users --}}
            <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-all duration-300">
                <div class="w-16 h-16 mx-auto bg-gradient-to-r from-budanes to-budanes-darker rounded-full flex items-center justify-center text-white mb-4">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <h3 class="font-bold text-2xl text-gray-800 mb-1">{{ $totalakun }}</h3>
                <p class="text-gray-600 text-sm">Kontributor Aktif</p>
            </div>

            {{-- Total Contents --}}
            <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-all duration-300">
                <div class="w-16 h-16 mx-auto bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white mb-4">
                    <i class="fas fa-file-alt text-2xl"></i>
                </div>
                <h3 class="font-bold text-2xl text-gray-800 mb-1">{{ $totalkonten }}</h3>
                <p class="text-gray-600 text-sm">Konten Approved</p>
            </div>

            {{-- Total Events --}}
            <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-all duration-300">
                <div class="w-16 h-16 mx-auto bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center text-white mb-4">
                    <i class="fas fa-calendar-alt text-2xl"></i>
                </div>
                <h3 class="font-bold text-2xl text-gray-800 mb-1">{{ $totalEvents }}</h3>
                <p class="text-gray-600 text-sm">Event Approved</p>
            </div>

            {{-- Total Views --}}
            <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-all duration-300">
                <div class="w-16 h-16 mx-auto bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center text-white mb-4">
                    <i class="fas fa-eye text-2xl"></i>
                </div>
                <h3 class="font-bold text-2xl text-gray-800 mb-1">{{ number_format($totalViews) }}</h3>
                <p class="text-gray-600 text-sm">Total Views</p>
            </div>
        </div>

        {{-- User Contributions Section --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="p-6 border-b border-gray-200">
                <h2 class="font-bold text-2xl text-gray-800 flex items-center">
                    <i class="fas fa-user-friends text-budanes mr-3"></i> Kontribusi Pengguna
                </h2>
                <p class="text-gray-600 text-sm mt-1">Daftar pengguna dengan kontribusi konten dan event yang sudah disetujui</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pengguna</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Konten</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Event</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poin</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level Badge</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Kontribusi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($akunWithContributions as $index => $user)
                        @php
                            // Ambil data badge level user
                            $badgeLevel = $user->badgeLevel ?? (object)[
                                'poin' => 0,
                                'status' => 'Abdi'
                            ];

                            // Tentukan warna badge berdasarkan level
                            $badgeColor = 'bg-gray-100 text-gray-800';
                            if($badgeLevel->status == 'Panewu') {
                                $badgeColor = 'bg-yellow-100 text-yellow-800';
                            } elseif($badgeLevel->status == 'Adipati') {
                                $badgeColor = 'bg-blue-100 text-blue-800';
                            } elseif($badgeLevel->status == 'Mahapatih') {
                                $badgeColor = 'bg-purple-100 text-purple-800';
                            } elseif($badgeLevel->status == 'Sultan') {
                                $badgeColor = 'bg-red-100 text-red-800';
                            }
                        @endphp
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="w-8 h-8 rounded-full bg-budanes text-white flex items-center justify-center text-sm font-bold">
                                    {{ $index + 1 }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-budanes to-budanes-darker flex items-center justify-center text-white font-bold mr-3">
                                        {{ strtoupper(substr($user->username, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $user->username }}</div>
                                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-file-alt mr-1"></i>
                                    {{ $user->total_content }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    {{ $user->total_event }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-orange-100 text-orange-800">
                                    <i class="fas fa-star mr-1"></i>
                                    {{ $badgeLevel->poin }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $badgeColor }}">
                                    <i class="fas fa-award mr-1"></i>
                                    {{ $badgeLevel->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-budanes-dark text-budanes-darker">
                                    <i class="fas fa-trophy mr-1"></i>
                                    {{ $user->total_contribution }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Content Performance Section --}}
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
            {{-- Top Contents --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="font-bold text-2xl text-gray-800 flex items-center">
                        <i class="fas fa-fire text-budanes mr-3"></i> Konten Terpopuler
                    </h2>
                    <p class="text-gray-600 text-sm mt-1">Konten dengan views terbanyak</p>
                </div>
                <div class="max-h-96 overflow-y-auto">
                    @foreach($approvedkonten->take(10) as $index => $content)
                    <div class="p-4 border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white flex items-center justify-center font-bold mr-4 flex-shrink-0">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-gray-800 truncate">{{ $content->judul ?? $content->title ?? 'No Title' }}</p>
                                <p class="text-sm text-gray-500 flex items-center mt-1">
                                    <i class="fas fa-user text-xs mr-1"></i>
                                    {{ $content->akun->username ?? 'Unknown' }}
                                </p>
                            </div>
                            <div class="ml-4 text-right flex-shrink-0">
                                <div class="flex items-center text-budanes font-bold">
                                    <i class="fas fa-eye mr-1"></i>
                                    {{ number_format($content->views_count ?? 0) }}
                                </div>
                                <div class="text-xs text-gray-500 mt-1">views</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Top Events --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="font-bold text-2xl text-gray-800 flex items-center">
                        <i class="fas fa-star text-budanes mr-3"></i> Event Terpopuler
                    </h2>
                    <p class="text-gray-600 text-sm mt-1">Event dengan views terbanyak</p>
                </div>
                <div class="max-h-96 overflow-y-auto">
                    @foreach($approvedEvents->take(10) as $index => $event)
                    <div class="p-4 border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-500 to-green-600 text-white flex items-center justify-center font-bold mr-4 flex-shrink-0">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-gray-800 truncate">{{ $event->judul ?? $event->title ?? 'No Title' }}</p>
                                <p class="text-sm text-gray-500 flex items-center mt-1">
                                    <i class="fas fa-user text-xs mr-1"></i>
                                    {{ $event->akun->username ?? 'Unknown' }}
                                </p>
                            </div>
                            <div class="ml-4 text-right flex-shrink-0">
                                <div class="flex items-center text-budanes font-bold">
                                    <i class="fas fa-eye mr-1"></i>
                                    {{ number_format($event->views_count ?? 0) }}
                                </div>
                                <div class="text-xs text-gray-500 mt-1">views</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
        animation: fadeIn 0.6s ease-out forwards;
    }

</style>

<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'budanes': '#A41313',
                    'budanes-dark': '#e4e00c',
                    'budanes-darker': '#c30000',
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
</script>

@endsection
