<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- font awesom --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <style>
        .confirm {
            padding-top: 0.3rem;
            padding-bottom: 0.3rem;
            padding-left: 0.8rem;
            padding-right: 0.8rem;
            background: rgb(53, 206, 15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: rgb(0, 0, 0);
            transition: all 0.3s ease;
        }

        :root {
            --primary-color: #4CAF50;
            /* Green 500 */
            --danger-color: #F44336;
            /* Red 500 */
            --background-color: #f3f4f6;
            /* gray-100 */
            --text-color: #6b7280;
            /* gray-500 */
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'budanes': '#A41313',
                        'budanes-dark': '#e4e00c',
                        'budanes-darker': '#c30000',
                        'dark': '#111827',
                        'darker': '#0D1321'
                    },
                    fontFamily: {
                        'montserrat': ['Montserrat', 'sans-serif'],
                        'poppins': ['Poppins', 'sans-serif'],
                        'lily': ['"Lily Script One"', 'cursive']
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out forwards',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 text-gray-900 font-montserrat">
    @include('layouts.navbarAdmin')

    <div class="min-h-screen">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function openEditModal(id) {
            fetch(`/admin/konten/${id}/edit`)
                .then(res => res.json())
                .then(data => {
                    const konten = data.konten;
                    const isAdmin = data.isAdmin;
                    const isUser = data.isUser;

                    const form = document.getElementById('editForm');
                    form.action = `/admin/konten/${id}`;

                    document.getElementById('modalKontenId').value = konten.id;
                    document.getElementById('modalJudul').value = konten.judul;
                    document.getElementById('modalIsi').value = konten.isi;
                    document.getElementById('modalKategori').value = konten.kategori;
                    document.getElementById('modalAsal').value = konten.asal;
                    document.getElementById('modalStatus').value = konten.status;

                    const adminFields = document.getElementById('adminFields');
                    if (isAdmin) {
                        adminFields.style.display = 'block';
                    } if (isUser) {
                        adminFields.style.display = 'none';
                    }

                    document.getElementById('editModal').classList.remove('hidden');
                    document.getElementById('editModal').classList.add('flex');
                });
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editModal').classList.remove('flex');
        }
    </script>
    @include('layouts.sidebar')
</body>

</html>
