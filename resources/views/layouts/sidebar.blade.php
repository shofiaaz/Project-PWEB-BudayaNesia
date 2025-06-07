<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-300 sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto">
        <ul class="space-y-3 font-montserrat">
            <li>
                <a href="" class="flex items-center p-3 text-gray-300 rounded-lg hover:bg-gray-800 group transition-all duration-200 hover:text-budanes-dark hover:border-b-4 border-budanes-dark">
                    <i class="fas fa-tachometer-alt w-5 h-5 text-black group-hover:text-budanes-dark transition duration-200"></i>
                    <span class="group-hover:text-budanes-dark text-black font-bold ml-4">Dashboard</span>
                    <span class="flex-1 flex justify-end">
                        <i class="fas fa-chevron-right text-xs text-gray-500 group-hover:text-budanes-dark"></i>
                    </span>
                </a>
            </li>

            <li>
                <a href={{ route('admin.konten.index') }} class="flex items-center p-3 text-gray-300 rounded-lg hover:bg-gray-800 group transition-all duration-200 hover:text-budanes-dark hover:border-b-4 border-budanes-dark">
                    <i class="fas fa-box-open w-5 h-5 text-black group-hover:text-budanes-dark transition duration-200"></i>
                    <span class="group-hover:text-budanes-dark text-black font-bold ml-4">Konten</span>
                    <span class="flex-1 flex justify-end items-center">
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-gray-900 bg-budanes-dark rounded-full">{{ $total ?? 0 }}</span>
                        <i class="fas fa-chevron-right text-xs text-gray-500 group-hover:text-budanes-dark ml-2"></i>
                    </span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.events.index') }}" class="flex items-center p-3 text-gray-300 rounded-lg hover:bg-gray-800 group transition-all duration-200 hover:text-budanes-dark hover:border-b-4 border-budanes-dark">
                    <i class="fas fa-exchange-alt w-5 h-5 text-black group-hover:text-budanes-dark transition duration-200"></i>
                    <span class="group-hover:text-budanes-dark text-black font-bold ml-4">Event</span>
                    <span class="flex-1 flex justify-end items-center">
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-gray-900 bg-budanes-dark rounded-full">{{ $newTransactions ?? 0 }}</span>
                        <i class="fas fa-chevron-right text-xs text-gray-500 group-hover:text-budanes-dark ml-2"></i>
                    </span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.laporan.index')}}" class="flex items-center p-3 text-gray-300 rounded-lg hover:bg-gray-800 group transition-all duration-200 hover:text-budanes-dark hover:border-b-4 border-budanes-dark">
                    <i class="fas fa-chart-line w-5 h-5 text-black group-hover:text-budanes-dark transition duration-200"></i>
                    <span class="group-hover:text-budanes-dark text-black font-bold ml-4">Laporan</span>
                    <span class="flex-1 flex justify-end">
                        <i class="fas fa-chevron-right text-xs text-gray-500 group-hover:text-budanes-dark"></i>
                    </span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.profile')}}" class="flex items-center p-3 text-gray-300 rounded-lg hover:bg-gray-800 group transition-all duration-200 hover:text-budanes-dark hover:border-b-4 border-budanes-dark">
                    <i class="fas fa-user w-5 h-5 text-black group-hover:text-budanes-dark transition duration-200"></i>
                    <span class="group-hover:text-budanes-dark text-black font-bold ml-4">Akun</span>
                    <span class="flex-1 flex justify-end">
                        <i class="fas fa-chevron-right text-xs text-gray-500 group-hover:text-budanes-dark"></i>
                    </span>
                </a>
            </li>

            <li class="mt-8 pt-4 border-t border-gray-700">
                <a href="{{ route('logout') }}" class="flex items-center p-3 text-gray-300 rounded-lg hover:bg-gray-800 group transition-all duration-200 hover:text-red-400 hover:border-b-4 border-red-400" id="logout-button">
                    <i class="fas fa-sign-out-alt w-5 h-5 text-black group-hover:text-red-400 transition duration-200"></i>
                    <span class="group-hover:text-red-400 text-black font-bold ml-4">Keluar</span>
                    <span class="flex-1 flex justify-end">
                        <i class="fas fa-chevron-right text-xs text-gray-500 group-hover:text-red-400"></i>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<!-- Mobile menu button -->
<div class="sm:hidden fixed top-4 left-4 z-50">
    <button id="mobile-menu-button" class="text-gray-300 hover:text-budanes-dark focus:outline-none">
        <i class="fas fa-bars text-2xl"></i>
    </button>
</div>

<script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const sidebar = document.getElementById('default-sidebar');
        sidebar.classList.toggle('-translate-x-full');
    });

    // Logout confirmation
    document.getElementById('logout-button').addEventListener('click', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Konfirmasi Logout',
            text: "Apakah anda yakin ingin logout?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: 'var(--danger-color)',
            cancelButtonColor: 'var(--danger-color)',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal',
            backdrop: 'rgba(0,0,0,0.8)',
            customClass: {
                container: 'font-montserrat',
                title: 'text-gray-900',
                htmlContainer: 'text-black',
                confirmButton: 'bg-budanes hover:bg-budanes-dark-dark text-gray-50 font-medium',
                cancelButton: 'bg-gray-700 hover:bg-gray-600 text-gray-300 font-medium'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('default-sidebar');
        const mobileButton = document.getElementById('mobile-menu-button');

        if (!sidebar.contains(event.target) && event.target !== mobileButton && !mobileButton.contains(event.target)) {
            if (window.innerWidth < 640) {
                sidebar.classList.add('-translate-x-full');
            }
        }
    });
</script>
