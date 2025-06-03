@extends('layouts.appCus')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 font-montserrat mb-2">Tambah Konten Budaya Baru</h1>
            <p class="text-gray-600 font-poppins">Bagikan kekayaan budaya Indonesia dengan komunitas kami</p>
        </div>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <form action="{{ route('konten.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-6">
                        <label for="judul" class="block text-sm font-medium text-gray-700 font-poppins mb-2">
                            <i class="fas fa-heading mr-2"></i> Judul Konten
                        </label>
                        <input type="text" id="judul" name="judul" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-budanes focus:border-transparent transition-all font-poppins"
                            placeholder="Contoh: Tari Kecak Bali">
                    </div>

                    <div class="mb-6">
                        <label for="asal" class="block text-sm font-medium text-gray-700 font-poppins mb-2">
                            <i class="fas fa-map-marker-alt mr-2"></i> Asal Provinsi
                        </label>
                        <select id="asal" name="asal" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-budanes focus:border-transparent transition-all font-poppins">
                            <option value="" disabled selected>Pilih Provinsi</option>
                            <option value="Aceh">Aceh</option>
                            <option value="Sumatera Utara">Sumatera Utara</option>
                            <option value="Sumatera Barat">Sumatera Barat</option>
                            <option value="Riau">Riau</option>
                            <option value="Jambi">Jambi</option>
                            <option value="Sumatera Selatan">Sumatera Selatan</option>
                            <option value="Bengkulu">Bengkulu</option>
                            <option value="Lampung">Lampung</option>
                            <option value="Kepulauan Bangka Belitung">Kepulauan Bangka Belitung</option>
                            <option value="Kepulauan Riau">Kepulauan Riau</option>
                            <option value="DKI Jakarta">DKI Jakarta</option>
                            <option value="Jawa Barat">Jawa Barat</option>
                            <option value="Jawa Tengah">Jawa Tengah</option>
                            <option value="DI Yogyakarta">DI Yogyakarta</option>
                            <option value="Jawa Timur">Jawa Timur</option>
                            <option value="Banten">Banten</option>
                            <option value="Bali">Bali</option>
                            <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                            <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                            <option value="Kalimantan Barat">Kalimantan Barat</option>
                            <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                            <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                            <option value="Kalimantan Timur">Kalimantan Timur</option>
                            <option value="Kalimantan Utara">Kalimantan Utara</option>
                            <option value="Sulawesi Utara">Sulawesi Utara</option>
                            <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                            <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                            <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                            <option value="Gorontalo">Gorontalo</option>
                            <option value="Sulawesi Barat">Sulawesi Barat</option>
                            <option value="Maluku">Maluku</option>
                            <option value="Maluku Utara">Maluku Utara</option>
                            <option value="Papua Barat">Papua Barat</option>
                            <option value="Papua">Papua</option>
                        </select>
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
                            <option value="situs budaya">Situs Budaya</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="isi" class="block text-sm font-medium text-gray-700 font-poppins mb-2">
                            <i class="fas fa-align-left mr-2"></i> Isi Konten
                        </label>
                        <textarea id="isi" name="isi" rows="8" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-budanes focus:border-transparent transition-all font-poppins"
                            placeholder="Tuliskan konten budaya Anda secara detail..."></textarea>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 font-poppins mb-2">
                            <i class="fas fa-image mr-2"></i> Thumbnail Konten
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
                        <a href="{{ route('konten.index') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium font-poppins hover:bg-gray-50 transition-all">
                            Batal
                        </a>
                        <button type="submit" class="border-b-4 border-black px-6 py-3 bg-budanes text-white rounded-lg font-medium font-poppins hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                            Ajukan Konten
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
