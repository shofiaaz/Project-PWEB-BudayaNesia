@extends('layouts.appCus')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 font-montserrat mb-2">Edit Event</h1>
            <p class="text-gray-600 font-poppins">Perbarui informasi event budaya Anda</p>
        </div>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <form action="{{ route('event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Judul --}}
                    <div class="mb-6">
                        <label for="judul" class="block text-sm font-medium text-gray-700 font-poppins mb-2">
                            <i class="fas fa-heading mr-2"></i> Judul Event
                        </label>
                        <input type="text" id="judul" name="judul" value="{{ $event->judul }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-budanes font-poppins">
                    </div>

                    {{-- Tempat --}}
                    <div class="mb-6">
                        <label for="tempat" class="block text-sm font-medium text-gray-700 font-poppins mb-2">
                            <i class="fas fa-map-marker-alt mr-2"></i> Tempat Event
                        </label>
                        <input type="text" id="tempat" name="tempat" value="{{ $event->tempat }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-budanes font-poppins">
                    </div>

                    {{-- Jadwal --}}
                    <div class="mb-6">
                        <label for="jadwal" class="block text-sm font-medium text-gray-700 font-poppins mb-2">
                            <i class="fas fa-calendar-alt mr-2"></i> Waktu Pelaksanaan
                        </label>
                        <input type="datetime-local" id="jadwal" name="jadwal" value="{{ date('Y-m-d\TH:i', strtotime($event->jadwal)) }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-budanes font-poppins">
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-6">
                        <label for="kategori" class="block text-sm font-medium text-gray-700 font-poppins mb-2">
                            <i class="fas fa-tags mr-2"></i> Kategori
                        </label>
                        <select id="kategori" name="kategori" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-budanes font-poppins">
                            <option value="" disabled>Pilih kategori</option>
                            @foreach(['tarian', 'musik', 'kerajinan', 'kuliner', 'upacara'] as $kategori)
                                <option value="{{ $kategori }}" {{ $event->kategori === $kategori ? 'selected' : '' }}>
                                    {{ ucfirst($kategori) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Isi --}}
                    <div class="mb-6">
                        <label for="isi" class="block text-sm font-medium text-gray-700 font-poppins mb-2">
                            <i class="fas fa-align-left mr-2"></i> Isi Event
                        </label>
                        <textarea id="isi" name="isi" rows="8" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-budanes font-poppins">{{ $event->isi }}</textarea>
                    </div>

                    {{-- Thumbnail --}}
                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 font-poppins mb-2">
                            <i class="fas fa-image mr-2"></i> Thumbnail Event
                        </label>
                        @if($event->thumbnail)
                            <img src="{{ asset('storage/' . $event->thumbnail) }}" class="h-32 rounded mb-2">
                        @endif
                        <input type="file" name="thumbnail" id="thumbnail"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                            file:rounded-lg file:border-0 file:text-sm file:font-semibold
                            file:bg-budanes file:text-white hover:file:bg-budanes-dark">
                        <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah thumbnail.</p>
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('event.histori') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-poppins hover:bg-gray-50">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 bg-budanes text-white rounded-lg font-poppins hover:shadow-lg">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
