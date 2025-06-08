@extends('layouts.appCus')

@section('content')

<div class="min-h-screen bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 font-montserrat">Konten Budaya Saya</h1>
                <p class="text-gray-600 font-poppins">Daftar konten budaya yang telah Anda ajukan</p>
            </div>
            <a href="{{ route('konten.create') }}" class="border-b-4 border-black px-4 py-2 bg-budanes text-white rounded-lg font-bold font-poppins hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                <i class="fas fa-plus mr-2"></i>Tambah Baru
            </a>
        </div>

        <!-- Content List -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            @if($contents->isEmpty())
                <div class="p-8 text-center">
                    <i class="fas fa-box-open text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-600 font-poppins">Anda belum memiliki konten budaya</p>
                    <a href="{{ route('konten.create') }}" class="mt-4 inline-block px-6 py-2 bg-budanes text-white rounded-lg font-medium font-poppins">
                        Buat Konten Pertama
                    </a>
                </div>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach($contents as $content)
                    <li class="p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex flex-col md:flex-row md:items-center">
                            <div class="flex-shrink-0 mb-4 md:mb-0 md:mr-4">
                                @if($content->thumbnail)
                                    <img src="{{ asset('storage/' . $content->thumbnail) }}" alt="{{ $content->judul }}" class="w-24 h-24 object-cover rounded-lg">
                                @else
                                    <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-bold text-lg text-gray-800 font-montserrat">{{ $content->judul }}</h3>
                                        <span class="inline-block px-2 py-1 text-xs rounded-full
                                            @if($content->status == 'approved') bg-green-100 text-green-800
                                            @elseif($content->status == 'rejected') bg-red-100 text-red-800
                                            @else bg-yellow-100 text-yellow-800 @endif">
                                            {{ ucfirst($content->status) }}
                                        </span>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-eye mr-1"></i> {{ $content->views_count }} views
                                    </div>
                                </div>
                                <p class="text-gray-600 mt-2 font-poppins line-clamp-2">{{ $content->isi }}</p>
                                <div class="mt-2 flex flex-wrap gap-2">
                                    <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">
                                        <i class="fas fa-tag mr-1"></i> {{ ucfirst($content->kategori) }}
                                    </span>
                                    <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">
                                        <i class="far fa-clock mr-1"></i> {{ $content->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                @if($content->status === 'pending')
                                    <div class="mt-2 flex items-center space-x-4">
                                        <form action="{{ route('konten.destroy', $content->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ml-2 text-red-500 hover:text-red-700 text-sm">
                                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                                            </button>
                                        </form>

                                        <a href="{{ route('konten.edit', $content->id) }}" class="text-blue-500 hover:text-blue-700 text-sm">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                    </div>

                                @endif

                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Pagination -->
        @if($contents->hasPages())
        <div class="mt-6">
            {{ $contents->links() }}
        </div>
        @endif
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Memeriksa apakah ada pesan sukses dari session
    @if(Session::has('success'))
        Swal.fire({
            icon: 'success',
            title: '{{ Session::get('success') }}',
            text: '{{ Session::get('message') }}',
            showConfirmButton: false,
            timer: 3000
        });
    @endif

    @if(Session::has('error'))
        Swal.fire({
            icon: 'error',
            title: '{{ Session::get('error') }}',
            text: '{{ Session::get('message') }}',
        });
    @endif

    @if(Session::has('info'))
        Swal.fire({
            icon: 'info',
            title: '{{ Session::get('info') }}',
            text: '{{ Session::get('message') }}',
        });
    @endif

    @if(Session::has('warning'))
        Swal.fire({
            icon: 'warning',
            title: '{{ Session::get('warning') }}',
            text: '{{ Session::get('message') }}',
        });
    @endif
</script>
@endsection
