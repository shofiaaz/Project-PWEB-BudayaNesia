<div class="space-y-4">
    <!-- Thumbnail -->
    <div class="rounded-xl overflow-hidden h-48 w-full">
        <img src="{{ $content->thumbnail ? asset('storage/' . $content->thumbnail) : asset('images/default-culture.jpg') }}"
             alt="{{ $content->judul }}"
             class="w-full h-full object-cover">
    </div>

    <!-- Content Header -->
    <div class="flex justify-between items-start">
        <div>
            <h2 class="text-2xl font-bold text-budanes-darker font-poppins">{{ $content->judul }}</h2>
            <div class="flex items-center mt-1 space-x-2">
                <span class="px-3 py-1 rounded-full text-xs bg-budanes bg-opacity-10 text-budanes font-medium">
                    {{ ucfirst($content->kategori) }}
                </span>
                <span class="text-sm text-gray-600">
                    <i class="fas fa-map-marker-alt mr-1"></i> {{ $content->asal }}
                </span>
            </div>
        </div>
        <div class="text-sm text-gray-500">
            <i class="far fa-eye mr-1"></i> {{ $content->views_count }}x dilihat
        </div>
    </div>

    <!-- Author Info -->
    <div class="flex items-center space-x-3 pt-2 border-t border-gray-200">
        <img src="{{ $content->akun->profile_photo_path ? asset('storage/' . $content->akun->profile_photo_path) : asset('https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png') }}"
             alt="{{ $content->akun->username }}"
             class="w-10 h-10 rounded-full object-cover">
        <div>
            <p class="font-medium text-gray-900">{{ $content->akun->username }}</p>
            <p class="text-xs text-gray-500">{{ $content->created_at->format('d M Y') }}</p>
        </div>
    </div>

    <!-- Content Body -->
    <div class="prose max-w-none text-gray-700 pt-4">
        {!! nl2br(e($content->isi)) !!}
    </div>

    <!-- Action Buttons -->
    <div class="flex space-x-3 pt-6 border-t border-gray-200">
        <button class="flex items-center space-x-1 px-4 py-2 bg-budanes text-white rounded-lg hover:bg-budanes-darker transition">
            <i class="far fa-thumbs-up"></i>
            <span>Suka</span>
        </button>
        <button class="flex items-center space-x-1 px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
            <i class="far fa-comment"></i>
            <span>Komentar</span>
        </button>
        <button class="flex items-center space-x-1 px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
            <i class="fas fa-share"></i>
            <span>Bagikan</span>
        </button>
    </div>
</div>
