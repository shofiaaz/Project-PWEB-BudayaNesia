@extends('layouts.appCus')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-budanes to-dark py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center">
                <h1 class="font-lily text-4xl md:text-5xl text-white mb-2 animate-fade-in">Sistem Badge Level</h1>
                <p class="font-poppins text-lg text-white opacity-90">Kelola level kontribusimu dan lihat ranking antar kontrinutor berdasarkan setiap aktivitas yang telah kamu lakukan</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- POP-UP / MODAL --}}
        <div id="quizCompletedModal" class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center hidden z-50">
            <div class="bg-white p-6 rounded-lg shadow-xl text-center max-w-sm mx-auto">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Pemberitahuan!</h3>
                <p class="text-gray-700 mb-6">Anda sudah mengerjakan kuis ini.</p>
                <button id="closeModalBtn" class="px-5 py-2 bg-budanes text-white rounded-lg hover:bg-budanes-dark transition-colors">
                    Oke
                </button>
            </div>
        </div>

        <!-- Quiz Promotion Section -->
        <div class="bg-gradient-to-r from-dark to-budanes-darker rounded-xl shadow-lg overflow-hidden mb-8 p-6 text-white">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="mb-4 md:mb-0">
                    <h2 class="font-bold text-2xl flex items-center mb-2">
                        <i class="fas fa-arrow-up mr-3"></i> Tingkatkan Badge
                    </h2>
                    <p class="opacity-90">Kerjakan kuis interaktif untuk menambah poin Anda!</p>
                </div>
                <a href="{{ route('badge.quiz') }}" id="start-quiz-btn"
                    class="px-6 py-3 bg-white text-budanes-darker font-bold rounded-lg hover:bg-gray-100 transition-colors flex items-center no-underline"> <i class="fas fa-play mr-2"></i> Kerjakan Kuis
                </a>
            </div>
        </div>

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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const startQuizBtn = document.getElementById('start-quiz-btn');
        const quizCompletedModal = document.getElementById('quizCompletedModal');
        const closeModalBtn = document.getElementById('closeModalBtn');

        // Ambil status quizCompleted dari PHP ke JavaScript
        const quizCompletedStatus = {{ $quizCompleted ? 'true' : 'false' }};

        // Jika kuis sudah selesai
        if (quizCompletedStatus) {
            startQuizBtn.addEventListener('click', function(event) {
                event.preventDefault();
                quizCompletedModal.classList.remove('hidden');
            });
        } else {

        }

        closeModalBtn.addEventListener('click', function() {
            quizCompletedModal.classList.add('hidden');
        });

        quizCompletedModal.addEventListener('click', function(event) {
            if (event.target === quizCompletedModal) {
                quizCompletedModal.classList.add('hidden');
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle quiz result popup
        @if(session('quiz_submission_status'))
            const status = "{{ session('quiz_submission_status') }}";
            const message = "{{ session('quiz_submitted_message') }}";
            const score = parseInt("{{ session('quiz_submitted_score', 0) }}");

            if (status === 'success') {
                // Determine result message based on score
                let resultMessage = '';
                let resultImage = '';

                if (score >= 80) {
                    resultMessage = 'Luar biasa! Anda sangat memahami budaya Indonesia.';
                    resultImage = 'https://i.pinimg.com/originals/ab/4b/8e/ab4b8e151241dd9e30ac691a7bdd1287.gif';
                } else if (score >= 60) {
                    resultMessage = 'Bagus! Pengetahuan Anda tentang budaya Indonesia cukup baik.';
                    resultImage = 'https://i.pinimg.com/originals/8c/8c/97/8c8c97dacf1e7936bb86faff609ebf3c.gif';
                } else {
                    resultMessage = 'Ish ish ish! Pelajari lagi budaya Indonesia dan coba lagi.';
                    resultImage = 'https://i.pinimg.com/originals/c0/8a/95/c08a953a7b7e293c9fa5b68abb6d135f.gif';
                }

                // Show result popup after short delay
                setTimeout(() => {
                    Swal.fire({
                        title: 'Hasil Kuis Anda',
                        html: `
                        <div style="text-align: center;">
                            <p>${message}</p>

                            <div style="font-size: 3rem; font-weight: bold; color: #A41313; margin: 20px 0;">
                                Skor: ${score}/100
                            </div>

                            <p>${resultMessage}</p>

                            ${resultImage ? `<img src="${resultImage}" style="display: block; margin: 15px auto 0 auto; max-width: 50%; height: auto; border-radius: 8px;">` : ''}
                        </div>
                        `,
                        confirmButtonText: 'Mengerti',
                        confirmButtonColor: '#A41313',
                        width: 600,
                        padding: '3em',
                        backdrop: `
                            rgba(20,0,0,0.4)
                            url("https://i.pinimg.com/originals/cf/50/6d/cf506d6998d68de01e9171f30fc4e287.gif")
                            center center / cover
                            no-repeat
                        `
                    });
                }, 500);
            } else if (status === 'error') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: message,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            }
        @endif
    });
    </script>
@endsection
