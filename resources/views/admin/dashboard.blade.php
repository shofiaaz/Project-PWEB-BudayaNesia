@extends('layouts.appAdmin')

@section('content')
    <div class="mx-auto px-4 py-8 mt-14 sm:ml-64 overflow-x-hidden bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <div
                class="mb-8 bg-gradient-to-r from-white to-slate-100 rounded-2xl p-6 border border-slate-200 shadow-lg backdrop-blur-sm">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-800 mb-2 flex items-center">
                            <span
                                class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-2 rounded-xl mr-3 shadow-lg">
                                <i class="fas fa-tachometer-alt"></i>
                            </span>
                            Dashboard
                        </h1>
                        <p class="text-slate-600">Selamat datang kembali, <span
                                class="font-semibold text-blue-600">{{ Auth::user()->username }}</span></p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div
                    class="bg-white rounded-2xl shadow-lg p-6 flex items-center hover:shadow-xl transition-all duration-300 border border-slate-100 hover:-translate-y-1 group">
                    <div
                        class="w-16 h-16 rounded-2xl flex items-center justify-center mr-4 bg-gradient-to-br from-blue-400 to-blue-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center mb-1">
                            <div class="text-2xl font-bold text-slate-800">{{ number_format($stats['total_users']) }}</div>
                            @if ($stats['new_users_today'] > 0)
                                <span
                                    class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-lg font-medium">+{{ $stats['new_users_today'] }}</span>
                            @endif
                        </div>
                        <div class="text-sm text-slate-500 font-medium mb-1">Total Pengguna</div>
                        <div class="text-xs font-medium flex items-center text-green-600">
                            <i class="fas fa-arrow-up mr-1"></i> {{ $stats['new_users_today'] }} hari ini
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl shadow-lg p-6 flex items-center hover:shadow-xl transition-all duration-300 border border-slate-100 hover:-translate-y-1 group">
                    <div
                        class="w-16 h-16 rounded-2xl flex items-center justify-center mr-4 bg-gradient-to-br from-green-400 to-green-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-file-alt text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center mb-1">
                            <div class="text-2xl font-bold text-slate-800">{{ number_format($stats['total_content']) }}
                            </div>
                            @if ($stats['new_content_today'] > 0)
                                <span
                                    class="ml-2 px-2 py-1 bg-green-100 text-green-800 text-xs rounded-lg font-medium">+{{ $stats['new_content_today'] }}</span>
                            @endif
                        </div>
                        <div class="text-sm text-slate-500 font-medium mb-1">Total Konten</div>
                        <div class="text-xs font-medium flex items-center text-green-600">
                            <i class="fas fa-arrow-up mr-1"></i> {{ $stats['new_content_today'] }} hari ini
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl shadow-lg p-6 flex items-center hover:shadow-xl transition-all duration-300 border border-slate-100 hover:-translate-y-1 group">
                    <div
                        class="w-16 h-16 rounded-2xl flex items-center justify-center mr-4 bg-gradient-to-br from-purple-400 to-purple-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-calendar-alt text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center mb-1">
                            <div class="text-2xl font-bold text-slate-800">{{ number_format($stats['total_events']) }}</div>
                            @if ($stats['new_events_this_month'] > 0)
                                <span
                                    class="ml-2 px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-lg font-medium">+{{ $stats['new_events_this_month'] }}</span>
                            @endif
                        </div>
                        <div class="text-sm text-slate-500 font-medium mb-1">Total Event</div>
                        <div class="text-xs font-medium flex items-center text-green-600">
                            <i class="fas fa-arrow-up mr-1"></i> {{ $stats['new_events_this_month'] }} bulan ini
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl shadow-lg p-6 flex items-center hover:shadow-xl transition-all duration-300 border border-slate-100 hover:-translate-y-1 group">
                    <div
                        class="w-16 h-16 rounded-2xl flex items-center justify-center mr-4 bg-gradient-to-br from-amber-400 to-amber-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-eye text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center mb-1">
                            <div class="text-2xl font-bold text-slate-800">{{ number_format($stats['total_views']) }}</div>
                            <span
                                class="ml-2 px-2 py-1 bg-amber-100 text-amber-800 text-xs rounded-lg font-medium">Total</span>
                        </div>
                        <div class="text-sm text-slate-500 font-medium mb-1">Total Views</div>
                        <div class="text-xs font-medium flex items-center text-blue-600">
                            <i class="fas fa-chart-line mr-1"></i> Konten & Event
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-slate-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-green-600">{{ number_format($stats['approved_content']) }}
                            </div>
                            <div class="text-sm text-slate-500">Konten Disetujui</div>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 border border-slate-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-yellow-600">{{ number_format($stats['pending_content']) }}
                            </div>
                            <div class="text-sm text-slate-500">Menunggu Review</div>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-clock text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 border border-slate-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-red-600">{{ number_format($stats['rejected_content']) }}
                            </div>
                            <div class="text-sm text-slate-500">Konten Ditolak</div>
                        </div>
                        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-times-circle text-red-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-8">
                <div
                    class="bg-white rounded-2xl shadow-lg overflow-hidden border border-slate-100 hover:shadow-xl transition-all duration-300">
                    <div
                        class="px-6 py-4 bg-gradient-to-r from-slate-50 to-slate-100 border-b border-slate-100 flex justify-between items-center">
                        <div class="text-lg font-semibold text-slate-800 flex items-center">
                            <i class="fas fa-history text-blue-600 mr-2"></i>
                            Aktivitas Terbaru
                        </div>
                    </div>
                    <div class="p-0">
                        <div class="divide-y divide-slate-200">
                            @foreach ($recentActivities as $activity)
                                <div class="px-6 py-4 flex items-start hover:bg-slate-50 transition-colors duration-200">
                                    @php
                                        $iconClass = match ($activity['type']) {
                                            'new_user' => 'bg-gradient-to-br from-green-400 to-green-600 text-white',
                                            'new_content' => 'bg-gradient-to-br from-blue-400 to-blue-600 text-white',
                                            'comment' => 'bg-gradient-to-br from-purple-400 to-purple-600 text-white',
                                            'login' => 'bg-gradient-to-br from-yellow-400 to-yellow-600 text-white',
                                            'approval' => 'bg-gradient-to-br from-indigo-400 to-indigo-600 text-white',
                                            default => 'bg-gradient-to-br from-slate-400 to-slate-600 text-white',
                                        };

                                        $icon = match ($activity['type']) {
                                            'new_user' => 'fas fa-user-plus',
                                            'new_content' => 'fas fa-file-alt',
                                            'comment' => 'fas fa-comment',
                                            'login' => 'fas fa-sign-in-alt',
                                            'approval' => 'fas fa-check-circle',
                                            default => 'fas fa-bell',
                                        };
                                    @endphp

                                    <div
                                        class="w-10 h-10 rounded-full flex items-center justify-center mr-3 shadow-md {{ $iconClass }}">
                                        <i class="{{ $icon }}"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-slate-900">{{ $activity['message'] }}</p>
                                        <p class="text-sm text-slate-500 flex items-center mt-1">
                                            <span class="font-medium text-blue-600">{{ $activity['user'] }}</span>
                                            <span class="mx-2">·</span>
                                            <span class="flex items-center">
                                                <i class="far fa-clock mr-1 text-slate-400"></i>
                                                {{ $activity['time']->diffForHumans() }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
