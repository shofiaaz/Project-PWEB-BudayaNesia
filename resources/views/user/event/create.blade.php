@extends('layouts.appCus')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 font-montserrat mb-2">Tambah Event Baru</h1>
            <p class="text-gray-600 font-poppins">Bagikan kekayaan budaya Indonesia dengan komunitas kami</p>
        </div>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-6">
                        <label for="judul" class="block text-sm font-medium text-gray-700 font-poppins mb-2">
                            <i class="fas fa-heading mr-2"></i> Judul Event
                        </label>
                        <input type="text" id="judul" name="judul" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-budanes focus:border-transparent transition-all font-poppins"
                            placeholder="Contoh: Tari Kecak Bali">
                    </div>

                    <div class="mb-6">
                        <label for="tempat" class="block text-sm font-medium text-gray-700 font-poppins mb-2">
                            <i class="fas fa-map-marker-alt mr-2"></i> Tempat Event
                        </label>
                         <input type="text" id="tempat" name="tempat" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-budanes focus:border-transparent transition-all font-poppins"
                            placeholder="Contoh: Tempat perlakasanannya">
                    </div>
                    <div class="mb-6">
    <label for="waktu_pelaksanaan" class="block text-sm font-medium text-gray-700 font-poppins mb-2">
        <i class="fas fa-calendar-alt mr-2"></i> Waktu Pelaksanaan
    </label>
    <input type="datetime-local" id="jadwal" name="jadwal" required
        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-budanes focus:border-transparent transition-all font-poppins">
</div>

                    <div class="mb-6">
                        <label for="kategori" class="block text-sm font-medium text-gray-700 font-poppins mb-2">
                            <i class="fas fa-tags mr-2"></i> Kategori
                        </label>
                        <select id="kategori" name="kategori" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-budanes focus:border-transparent transition-all font-poppins">
                            <option value="" disabled selected>Pilih kategori</option>
                            <option value="tarian">Tarian</option>
                            <option value="musik">Musik</option>
                            <option value="kerajinan">Kerajinan</option>
                            <option value="kuliner">Kuliner</option>
                            <option value="upacara">Upacara</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="isi" class="block text-sm font-medium text-gray-700 font-poppins mb-2">
                            <i class="fas fa-align-left mr-2"></i> Isi Event
                        </label>
                        <textarea id="isi" name="isi" rows="8" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-budanes focus:border-transparent transition-all font-poppins"
                            placeholder="Tuliskan Event yang Anda ingin buat secara detail..."></textarea>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 font-poppins mb-2">
                            <i class="fas fa-image mr-2"></i> Thumbnail Event
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                            <div class="space-y-1 text-center">
                                <i class="fas fa-image mx-auto h-12 w-12 text-gray-400 text-5xl"></i>
                                <div class="flex text-sm text-gray-600">
                                    <label for="thumbnail" class="relative cursor-pointer bg-white rounded-md font-medium text-budanes hover:text-budanes-dark focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-budanes">
                                        <span>Upload thumbnail</span>
                                        <input id="thumbnail" name="thumbnail" type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF maksimal 2MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('event.index') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium font-poppins hover:bg-gray-50 transition-all">
                            Batal
                        </a>
                        <button type="submit" class="border-b-4 border-black px-6 py-3 bg-budanes text-white rounded-lg font-medium font-poppins hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                            Ajukan Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('thumbnail').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewContainer = document.querySelector('.border-dashed');

                // Sembunyikan elemen icon dan label upload
                const icon = previewContainer.querySelector('i');
                const label = previewContainer.querySelector('label');
                const text = previewContainer.querySelector('p');

                if (icon) icon.style.display = 'none';
                if (label) label.style.display = 'none';
                if (text) text.style.display = 'none';

                // Tambahkan elemen preview image jika belum ada
                if (!document.getElementById('preview-image')) {
                    const img = document.createElement('img');
                    img.id = 'preview-image';
                    img.src = e.target.result;
                    img.className = "mx-auto h-48 object-cover rounded-lg";
                    previewContainer.appendChild(img);
                }

                // Tambahkan tombol hapus jika belum ada
                if (!document.getElementById('remove-thumbnail-btn')) {
                    const removeBtn = document.createElement('button');
                    removeBtn.type = "button";
                    removeBtn.id = "remove-thumbnail-btn";
                    removeBtn.className = "mt-2 text-sm text-red-500 hover:text-red-700";
                    removeBtn.innerHTML = `<i class="fas fa-times mr-1"></i> Hapus Thumbnail`;
                    removeBtn.addEventListener('click', function () {
                        // Reset preview dan tampilkan kembali elemen semula
                        const input = document.getElementById('thumbnail');
                        input.value = "";

                        const img = document.getElementById('preview-image');
                        if (img) img.remove();
                        removeBtn.remove();

                        if (icon) icon.style.display = '';
                        if (label) label.style.display = '';
                        if (text) text.style.display = '';
                    });
                    previewContainer.appendChild(removeBtn);
                }
            };
            reader.readAsDataURL(file);
        }
    });
    </script>

@endsection
