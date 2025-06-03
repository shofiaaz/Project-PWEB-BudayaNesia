@extends('layouts.appAdmin')

@section('content')
    <div class=" mx-auto px-4 py-8 mt-14 sm:ml-64 overflow-x-hidden">
        <div class="flex justify-between pb-8 items-center">
            <h1 class="text-2xl font-bold">Daftar Konten</h1>
            <a href="{{ route('admin.konten.create') }}"
                class="border-b-8 border border-black px-8 py-3 bg-budanes text-white font-bold rounded-lg hover:text-black hover:bg-budanes-dark transition duration-300 animate-fade-in animate-delay-200 inline-flex items-center">
                <span x-text="slides[currentSlide].cta">Konten Baru</span>
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <div class="w-full border rounded-lg shadow bg-white">
            <div class="overflow-x-auto">
                <table class="min-w-[1000px] w-full table-auto">
                    <thead class="bg-gray-100 text-gray-700 font-semibold">
                        <tr>
                            <th class="px-4 py-2 border">Judul</th>
                            <th class="px-4 py-2 border">Deskripsi</th>
                            <th class="px-4 py-2 border">Kategori</th>
                            <th class="px-4 py-2 border">Status</th>
                            <th class="px-4 py-2 border">Asal</th>
                            <th class="px-4 py-2 border">Username</th>
                            <th class="px-4 py-2 border">Views</th>
                            <th class="px-4 py-2 border">Tanggal</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contents as $konten)
                            <tr class="text-sm text-gray-800 text-center hover:bg-gray-50">
                                <td class="border px-4 py-2">{{ $konten->judul }}</td>
                                <td class="border px-4 py-2 text-left">{{ Str::limit(strip_tags($konten->isi), 30) }}</td>
                                <td class="border px-4 py-2">{{ $konten->kategori }}</td>
                                <td class="border px-4 py-2">{{ $konten->status }}</td>
                                <td class="border px-4 py-2">{{ $konten->asal }}</td>
                                <td class="border px-4 py-2">{{ $konten->akun->username ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ $konten->views_count }}</td>
                                <td class="border px-4 py-2">{{ $konten->created_at->format('d M Y') }}</td>
                                <td class="border px-4 py-2 flex flex-col gap-1">
                                    <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600"
                                        onclick="openEditModal({{ $konten->id }})">Edit</button>

                                    <form action="{{ route('admin.konten.destroy', $konten->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus konten ini?')"
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
            <div class="bg-white w-[90%] max-w-md p-6 rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Edit Konten</h2>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="konten_id" id="modalKontenId">

                    <div id="adminFields" class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium">Judul</label>
                            <input type="text" name="judul" id="modalJudul" class="w-full border p-2 rounded" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Deskripsi</label>
                            <textarea name="isi" id="modalIsi" class="w-full border p-2 rounded" rows="4" required></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Kategori</label>
                            <input type="text" name="kategori" id="modalKategori" class="w-full border p-2 rounded"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Asal</label>
                            <input type="text" name="asal" id="modalAsal" class="w-full border p-2 rounded" required>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="block text-sm font-medium">Status</label>
                        <select name="status" id="modalStatus" class="w-full border p-2 rounded" required>
                            <option value="rejected">Rejected</option>
                            <option value="approved">Approved</option>
                        </select>
                    </div>

                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="button" onclick="closeEditModal()"
                            class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-4">
            {{ $contents->links() }}
        </div>
    </div>
@endsection
