@extends('layouts.appCus')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-8">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden transform transition-all duration-500 hover:shadow-3xl">
                <div class="relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 via-blue-600 to-indigo-600 opacity-95"></div>
                    <div class="absolute inset-0">
                        <div class="wave"></div>
                    </div>
                    <div class="relative z-10 p-4 sm:p-6 text-white">
                        <div class="flex items-center justify-between flex-col sm:flex-row gap-4">
                            <div class="text-center sm:text-left">
                                <h1 class="text-xl sm:text-2xl md:text-3xl font-bold flex items-center justify-center sm:justify-start gradient-text text-white">
                                    <i class="fas fa-map-marked-alt mr-2 sm:mr-3 island-pulse"></i>
                                    Petualangan Budaya Indonesia
                                </h1>
                                <p class="text-xs sm:text-sm md:text-base opacity-90 mt-1 sm:mt-2">
                                    Jelajahi pertanyaan dari beberapa pulau berbeda dan jawab pertanyaan untuk mendapatkan poin!
                                </p>
                            </div>
                            <div class="bg-white bg-opacity-20 rounded-full p-2 sm:p-3 backdrop-blur-sm">
                                <i class="fas fa-compass text-xl sm:text-2xl trophy-spin text-yellow-300"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 sm:p-6">
                    <div id="quiz-content">
                        <div id="adventure-map" class="mb-8 relative h-48 sm:h-56 md:h-64 adventure-map rounded-xl overflow-hidden shadow-inner"
                        style="background-image: url('https://static.vecteezy.com/system/resources/previews/005/498/520/non_2x/indonesia-map-asia-country-map-template-free-vector.jpg'); background-repeat: no-repeat; background-position: center center; background-size: cover;">
                            <div class="absolute inset-0">
                                <div class="absolute top-4 left-10 opacity-60 island-float">
                                    <i class="fa-solid fa-cloud text-white text-3xl"></i>
                                </div>
                                <div class="absolute top-8 right-16 opacity-40 island-float" style="animation-delay: 1s;">
                                    <i class="fa-solid fa-cloud text-white text-2xl"></i>
                                </div>
                                <div class="absolute top-6 left-1/3 opacity-50 island-float" style="animation-delay: 2s;">
                                    <i class="fa-solid fa-cloud text-white text-4xl"></i>
                                </div>
                            </div>

                            <div id="character" class="absolute bottom-0 character-size w-12 h-12 transform -translate-x-1/2 transition-all duration-1000 character-bounce">
                                <img src="https://static.vecteezy.com/system/resources/thumbnails/042/541/885/small_2x/illustration-of-a-little-boy-in-traditional-javanese-costume-png.png"
                                    alt="Kartun Petualang Indonesia"
                                    class="w-full h-full object-contain">
                            </div>

                            <div id="sumatera-marker" class="absolute top-12 left-[10%] transform -translate-x-1/2 text-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto shadow-md island-float">
                                    <i class="fas fa-mountain text-white text-sm"></i>
                                </div>
                                <span class="text-xs font-bold mt-1 text-white drop-shadow-lg">Sumatera</span>
                            </div>
                            <div id="jawa-marker" class="absolute top-48 left-[35%] transform -translate-x-1/2 text-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-full flex items-center justify-center mx-auto shadow-md island-float" style="animation-delay: 0.5s;">
                                    <i class="fas fa-gopuram text-white text-sm"></i>
                                </div>
                                <span class="text-xs font-bold mt-1 text-white drop-shadow-lg">Jawa</span>
                            </div>
                            <div id="bali-marker" class="absolute top-52 left-[45%] transform -translate-x-1/2 text-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-red-400 to-red-600 rounded-full flex items-center justify-center mx-auto shadow-md island-float" style="animation-delay: 1s;">
                                    <i class="fas fa-spa text-white text-sm"></i>
                                </div>
                                <span class="text-xs font-bold mt-1 text-white drop-shadow-lg">Bali</span>
                            </div>
                            <div id="kalimantan-marker" class="absolute top-16 left-[40%] transform -translate-x-1/2 text-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center mx-auto shadow-md island-float" style="animation-delay: 1.5s;">
                                    <i class="fas fa-tree text-white text-sm"></i>
                                </div>
                                <span class="text-xs font-bold mt-1 text-white drop-shadow-lg">Kalimantan</span>
                            </div>
                            <div id="papua-marker" class="absolute top-36 left-[90%] transform -translate-x-1/2 text-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center mx-auto shadow-md island-float" style="animation-delay: 2s;">
                                    <i class="fas fa-fire text-white text-sm"></i>
                                </div>
                                <span class="text-xs font-bold mt-1 text-white drop-shadow-lg">Papua</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6" id="quiz-container">
                        <div class="mb-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle text-blue-500"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        Kuis ini terdiri dari 5 pertanyaan tentang budaya Indonesia. Setiap jawaban benar memberi Anda 20 poin.
                                        Total maksimal 100 poin. Anda hanya bisa mengerjakan kuis ini sekali.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <form id="culture-quiz" action="{{ route('badge.submit-quiz') }}" method="POST">
                            @csrf

                            <div class="quiz-question mb-8 p-4 border border-gray-200 rounded-lg" data-question="1">
                                <h3 class="font-bold text-lg text-gray-800 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-budanes text-white rounded-full flex items-center justify-center mr-3">1</span>
                                    Tari Kecak berasal dari provinsi mana?
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <label class="quiz-option flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="question1" value="A" class="mr-3 h-5 w-5 text-budanes focus:ring-budanes">
                                        <span>Bali</span>
                                    </label>
                                    <label class="quiz-option flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="question1" value="B" class="mr-3 h-5 w-5 text-budanes focus:ring-budanes">
                                        <span>Jawa Tengah</span>
                                    </label>
                                    <label class="quiz-option flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="question1" value="C" class="mr-3 h-5 w-5 text-budanes focus:ring-budanes">
                                        <span>Sumatera Barat</span>
                                    </label>
                                    <label class="quiz-option flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="question1" value="D" class="mr-3 h-5 w-5 text-budanes focus:ring-budanes">
                                        <span>Nusa Tenggara Timur</span>
                                    </label>
                                </div>
                            </div>

                            <div class="quiz-question mb-8 p-4 border border-gray-200 rounded-lg" data-question="2">
                                <h3 class="font-bold text-lg text-gray-800 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-budanes text-white rounded-full flex items-center justify-center mr-3">2</span>
                                    Alat musik tradisional "Sasando" berasal dari pulau mana?
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <label class="quiz-option flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="question2" value="A" class="mr-3 h-5 w-5 text-budanes focus:ring-budanes">
                                        <span>Jawa</span>
                                    </label>
                                    <label class="quiz-option flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="question2" value="B" class="mr-3 h-5 w-5 text-budanes focus:ring-budanes">
                                        <span>Sumatera</span>
                                    </label>
                                    <label class="quiz-option flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="question2" value="C" class="mr-3 h-5 w-5 text-budanes focus:ring-budanes">
                                        <span>Rote</span>
                                    </label>
                                    <label class="quiz-option flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="question2" value="D" class="mr-3 h-5 w-5 text-budanes focus:ring-budanes">
                                        <span>Sulawesi</span>
                                    </label>
                                </div>
                            </div>

                            <div class="quiz-question mb-8 p-4 border border-gray-200 rounded-lg" data-question="3">
                                <h3 class="font-bold text-lg text-gray-800 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-budanes text-white rounded-full flex items-center justify-center mr-3">3</span>
                                    Rumah adat ini berasal dari daerah mana?
                                </h3>
                                <div class="mb-4">
                                    <img src="https://s3-ap-southeast-1.amazonaws.com/arsitagx-master-article/article-photo/109/unnamed.jpg" alt="Rumah Gadang" class="w-full md:w-1/2 mx-auto rounded-lg shadow-sm">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <label class="quiz-option flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="question3" value="A" class="mr-3 h-5 w-5 text-budanes focus:ring-budanes">
                                        <span>Sumatera Barat</span>
                                    </label>
                                    <label class="quiz-option flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="question3" value="B" class="mr-3 h-5 w-5 text-budanes focus:ring-budanes">
                                        <span>Jawa Timur</span>
                                    </label>
                                    <label class="quiz-option flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="question3" value="C" class="mr-3 h-5 w-5 text-budanes focus:ring-budanes">
                                        <span>Kalimantan Barat</span>
                                    </label>
                                    <label class="quiz-option flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="question3" value="D" class="mr-3 h-5 w-5 text-budanes focus:ring-budanes">
                                        <span>Papua</span>
                                    </label>
                                </div>
                            </div>

                            <div class="quiz-question mb-8 p-4 border border-gray-200 rounded-lg" data-question="4">
                                <h3 class="font-bold text-lg text-gray-800 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-budanes text-white rounded-full flex items-center justify-center mr-3">4</span>
                                    Pasangkan tarian dengan asalnya!
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="p-3 bg-gray-50 rounded-lg">
                                        <p class="font-medium mb-2">Tari Saman</p>
                                        <select name="question4a" class="w-full border border-gray-300 rounded-md p-2 focus:ring-budanes focus:border-budanes">
                                            <option value="">Pilih Asal</option>
                                            <option value="Aceh">Aceh</option>
                                            <option value="Bali">Bali</option>
                                            <option value="Jawa Barat">Jawa Barat</option>
                                            <option value="Papua">Papua</option>
                                        </select>
                                    </div>
                                    <div class="p-3 bg-gray-50 rounded-lg">
                                        <p class="font-medium mb-2">Tari Jaipong</p>
                                        <select name="question4b" class="w-full border border-gray-300 rounded-md p-2 focus:ring-budanes focus:border-budanes">
                                            <option value="">Pilih Asal</option>
                                            <option value="Aceh">Aceh</option>
                                            <option value="Bali">Bali</option>
                                            <option value="Jawa Barat">Jawa Barat</option>
                                            <option value="Papua">Papua</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="quiz-question mb-8 p-4 border border-gray-200 rounded-lg" data-question="5">
                                <h3 class="font-bold text-lg text-gray-800 mb-3 flex items-center">
                                    <span class="w-8 h-8 bg-budanes text-white rounded-full flex items-center justify-center mr-3">5</span>
                                    Pilih pernyataan yang BENAR tentang budaya Indonesia:
                                </h3>
                                <div class="space-y-3">
                                    <label class="quiz-option flex items-start p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="question5" value="A" class="mt-1 mr-3 h-5 w-5 text-budanes focus:ring-budanes">
                                        <span>Wayang Kulit diakui UNESCO sebagai Warisan Budaya Dunia</span>
                                    </label>
                                    <label class="quiz-option flex items-start p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="question5" value="B" class="mt-1 mr-3 h-5 w-5 text-budanes focus:ring-budanes">
                                        <span>Batik hanya berasal dari Yogyakarta</span>
                                    </label>
                                    <label class="quiz-option flex items-start p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="question5" value="C" class="mt-1 mr-3 h-5 w-5 text-budanes focus:ring-budanes">
                                        <span>Bahasa Indonesia adalah satu-satunya bahasa yang digunakan di seluruh Indonesia</span>
                                    </label>
                                    <label class="quiz-option flex items-start p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="question5" value="D" class="mt-1 mr-3 h-5 w-5 text-budanes focus:ring-budanes">
                                        <span>Semua tarian tradisional Indonesia menggunakan properti yang sama</span>
                                    </label>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="px-6 py-3 bg-budanes text-white font-bold rounded-lg hover:bg-red-500 transition-colors flex items-center">
                                    <i class="fas fa-paper-plane mr-2"></i> Kirim Jawaban
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(!$quizCompleted)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quizForm = document.getElementById('culture-quiz');
        const adventureMap = document.getElementById('adventure-map');

        // --- SweetAlert Pop-up untuk Hasil Kuis ---
        const quizSubmissionStatus = "{{ session('quiz_submission_status') }}";
        const quizSubmittedScore = parseInt("{{ session('quiz_submitted_score', 0) }}");
        const quizSubmittedMessage = "{{ session('quiz_submitted_message') }}";

        if (quizSubmissionStatus === 'success') {
            let resultMessage = '';
            let resultImage = '';

            if (quizSubmittedScore >= 80) {
                resultMessage = 'Luar biasa! Anda sangat memahami budaya Indonesia.';
                resultImage = 'https://i.imgur.com/Jc7GmZQ.jpg';
            } else if (quizSubmittedScore >= 60) {
                resultMessage = 'Bagus! Pengetahuan Anda tentang budaya Indonesia cukup baik.';
                resultImage = 'https://i.imgur.com/VQ4WzOi.jpg';
            } else {
                resultMessage = 'Jangan menyerah! Pelajari lagi budaya Indonesia dan coba lagi.';
                resultImage = 'https://i.imgur.com/3JYQZ7j.jpg';
            }

            // Tampilkan pop-up hasil kuis
            setTimeout(() => {
                Swal.fire({
                    title: 'Hasil Kuis Anda',
                    html: `
                        <div style="text-align: center;">
                            <p>${quizSubmittedMessage}</p>
                            <div style="font-size: 3rem; font-weight: bold; color: #4a6baf; margin: 20px 0;">
                                Skor: ${quizSubmittedScore}/100
                            </div>
                            <p>${resultMessage}</p>
                            ${resultImage ? `<img src="${resultImage}" style="max-width: 100%; height: auto; border-radius: 8px; margin-top: 15px;">` : ''}
                        </div>
                    `,
                    confirmButtonText: 'Mengerti',
                    confirmButtonColor: '#3085d6',
                    width: 600,
                    padding: '3em',
                    backdrop: `
                        rgba(0,0,123,0.4)
                        url("/images/confetti.gif")
                        center top
                        no-repeat
                    `
                });
            }, 500); // Delay
        } else if (quizSubmissionStatus === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: quizSubmittedMessage,
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        }

        // Inisialisasi peta petualangan
        function initQuiz() {
            if (adventureMap) {
                adventureMap.style.background = "url('https://static.vecteezy.com/system/resources/previews/005/498/520/non_2x/indonesia-map-asia-country-map-template-free-vector.jpg') no-repeat center center";
                adventureMap.style.backgroundSize = "cover";
            }
        }
        initQuiz();

        // Validasi form kuis
        quizForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Validasi semua pertanyaan terjawab
            const unansweredQuestions = [];
            const questions = document.querySelectorAll('.quiz-question');

            questions.forEach(question => {
                const questionNum = question.getAttribute('data-question');

                if (questionNum === '4') {
                    const select1 = question.querySelector('select[name="question4a"]');
                    const select2 = question.querySelector('select[name="question4b"]');
                    if (select1.value === '' || select2.value === '') {
                        unansweredQuestions.push(questionNum);
                    }
                } else {
                    const radioName = `question${questionNum}`;
                    const radios = question.querySelectorAll(`input[name="${radioName}"]:checked`);
                    if (radios.length === 0) {
                        unansweredQuestions.push(questionNum);
                    }
                }
            });

            if (unansweredQuestions.length > 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pertanyaan Belum Terjawab',
                    html: `Anda belum menjawab pertanyaan nomor: <strong>${unansweredQuestions.join(', ')}</strong>`,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Konfirmasi pengiriman
            Swal.fire({
                title: 'Kirim Jawaban?',
                text: "Anda hanya bisa mengerjakan kuis ini sekali!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kirim!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    quizForm.submit();
                }
            });
        });

        // Efek hover untuk opsi kuis
        const quizOptions = document.querySelectorAll('.quiz-option');
        quizOptions.forEach(option => {
            option.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
            });

            option.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.boxShadow = '';
            });
        });

    });
</script>

@endif

<style>
    /* style kuis */
    .quiz-option {
        transition: all 0.2s ease;
    }

    .quiz-option:hover {
        border-color: #4f46e5;
    }

    input[type="radio"]:checked + span {
        font-weight: bold;
        color: #4f46e5;
    }
    .character-bounce {
        animation: bounce 3s ease-in-out infinite;
    }

    .island-float {
        animation: float 4s ease-in-out infinite;
    }

    .island-pulse {
        animation: pulse 2s ease-in-out infinite;
    }
    @keyframes bounce {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        33% { transform: translateY(-10px) rotate(2deg); }
        66% { transform: translateY(-5px) rotate(-2deg); }
    }

    /* Responsive adjustments */
    @media (max-width: 640px) {
        .quiz-question {
            padding: 1rem;
        }

        .quiz-option {
            padding: 0.75rem;
        }
        .adventure-map {
            height: 200px !important;
        }

        .character-size {
            width: 40px !important;
            height: 40px !important;
        }
    }

</style>

@endsection

