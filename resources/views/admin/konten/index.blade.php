@extends('layouts.appAdmin')

@section('content')
    <div class="mx-auto px-4 py-8 mt-14 sm:ml-64 overflow-x-hidden bg-white min-h-screen">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between pb-8 items-center">
                <h1 class="text-2xl font-bold text-red-600">Daftar Konten</h1>
                <a href="{{ route('admin.konten.create') }}"
                    class="border-b-8 border border-black px-8 py-3 bg-red-600 text-white font-bold rounded-lg hover:text-black hover:bg-red-700 transition duration-300 inline-flex items-center">
                    <span>Konten Baru</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="w-full border rounded-lg shadow bg-cream-50 border-amber-200">
                <div class="overflow-x-auto">
                    <table class="min-w-[1000px] w-full table-auto bg-white rounded-lg overflow-hidden">
                        <thead class="bg-orange-100 text-orange-800 font-semibold">
                            <tr>
                                <th class="px-4 py-3 border border-orange-200 text-left">Judul</th>
                                <th class="px-4 py-3 border border-orange-200 text-left">Deskripsi</th>
                                <th class="px-4 py-3 border border-orange-200 text-center">Kategori</th>
                                <th class="px-4 py-3 border border-orange-200 text-center">Status</th>
                                <th class="px-4 py-3 border border-orange-200 text-center">Asal</th>
                                <th class="px-4 py-3 border border-orange-200 text-center">Username</th>
                                <th class="px-4 py-3 border border-orange-200 text-center">Views</th>
                                <th class="px-4 py-3 border border-orange-200 text-center">Tanggal</th>
                                <th class="px-4 py-3 border border-orange-200 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contents as $konten)
                                <tr class="text-sm text-gray-800 hover:bg-gray-50">
                                    <td class="border px-4 py-3 font-medium">{{ $konten->judul }}</td>
                                    <td class="border px-4 py-3 text-left max-w-xs">
                                        <div class="truncate" title="{{ strip_tags($konten->isi) }}">
                                            {{ Str::limit(strip_tags($konten->isi), 50) }}
                                        </div>
                                    </td>
                                    <td class="border px-4 py-3 text-center">{{ $konten->kategori }}</td>
                                    <td class="border px-4 py-3 text-center">
                                        @if ($konten->status == 'approved')
                                            <span
                                                class="px-2 py-1 bg-green-500 text-white rounded-full text-xs font-medium">
                                                Approved
                                            </span>
                                        @elseif($konten->status == 'rejected')
                                            <span class="px-2 py-1 bg-red-500 text-white rounded-full text-xs font-medium">
                                                Rejected
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-1 bg-gray-200 text-gray-800 rounded-full text-xs font-medium">
                                                {{ $konten->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="border px-4 py-3 text-center">{{ $konten->asal }}</td>
                                    <td class="border px-4 py-3 text-center">{{ $konten->akun->username ?? '-' }}</td>
                                    <td class="border px-4 py-3 text-center font-medium">
                                        {{ number_format($konten->views_count) }}</td>
                                    <td class="border px-4 py-3 text-center">{{ $konten->created_at->format('d M Y') }}</td>
                                    <td class="border px-4 py-3">
                                        <div class="flex flex-col gap-2 items-center">
                                            <button
                                                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 inline-flex items-center justify-center text-xs w-full"
                                                onclick="openEditModal({{ $konten->id }})">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </button>

                                            <form action="{{ route('admin.konten.destroy', $konten->id) }}" method="POST"
                                                class="w-full">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Yakin ingin menghapus konten ini?')"
                                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 inline-flex items-center justify-center text-xs w-full">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6 flex justify-center bg-white p-4">
                {{ $contents->links() }}
            </div>
        </div>
    </div>

    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white w-[90%] max-w-md p-6 rounded-lg shadow-xl">
            <h2 class="text-xl font-semibold mb-4">Edit Konten</h2>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="konten_id" id="modalKontenId">

                <div id="adminFields" class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium mb-1">Judul</label>
                        <input type="text" name="judul" id="modalJudul"
                            class="w-full border border-gray-300 p-2 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Deskripsi</label>
                        <textarea name="isi" id="modalIsi"
                            class="w-full border border-gray-300 p-2 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500"
                            rows="4" required></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Kategori</label>
                        <input type="text" name="kategori" id="modalKategori"
                            class="w-full border border-gray-300 p-2 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Asal</label>
                        <input type="text" name="asal" id="modalAsal"
                            class="w-full border border-gray-300 p-2 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500"
                            required>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select name="status" id="modalStatus"
                        class="w-full border border-gray-300 p-2 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500"
                        required>
                        <option value="rejected">Rejected</option>
                        <option value="approved">Approved</option>
                    </select>
                </div>

                <div class="mt-4 flex justify-end space-x-2">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400 transition">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id) {
            // Get content data via AJAX
            fetch(`/admin/konten/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modalKontenId').value = data.id;
                    document.getElementById('modalJudul').value = data.judul;
                    document.getElementById('modalIsi').value = data.isi;
                    document.getElementById('modalKategori').value = data.kategori;
                    document.getElementById('modalAsal').value = data.asal;
                    document.getElementById('modalStatus').value = data.status;

                    document.getElementById('editForm').action = `/admin/konten/${id}`;
                    document.getElementById('editModal').style.display = 'flex';
                });
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
@endsection
