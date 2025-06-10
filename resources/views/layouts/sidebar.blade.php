<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-amber-50 border-r border-amber-200 sm:translate-x-0 shadow-lg" aria-label="Sidebar">
    <div class="h-full px-4 pb-4 overflow-y-auto">
        <div class="bg-white rounded-xl shadow-sm p-2 mb-4 border border-amber-100">
            <ul class="space-y-2 font-montserrat">
                <li>
                    <a href="{{ route('admin.dashboard')}}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-amber-100 group transition-all duration-200 hover:text-orange-700 hover:shadow-md">
                        <i class="fas fa-tachometer-alt w-5 h-5 text-orange-600 group-hover:text-orange-700 transition duration-200"></i>
                        <span class="group-hover:text-orange-700 text-gray-800 font-semibold ml-4">Dashboard</span>
                        <span class="flex-1 flex justify-end">
                            <i class="fas fa-chevron-right text-xs text-gray-400 group-hover:text-orange-600"></i>
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.konten.index') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-amber-100 group transition-all duration-200 hover:text-orange-700 hover:shadow-md">
                        <i class="fas fa-box-open w-5 h-5 text-orange-600 group-hover:text-orange-700 transition duration-200"></i>
                        <span class="group-hover:text-orange-700 text-gray-800 font-semibold ml-4">Konten</span>
                        <span class="flex-1 flex justify-end items-center">
                            <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full shadow-sm">{{ $total ?? 0 }}</span>
                            <i class="fas fa-chevron-right text-xs text-gray-400 group-hover:text-orange-600 ml-2"></i>
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.events.index') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-amber-100 group transition-all duration-200 hover:text-orange-700 hover:shadow-md">
                        <i class="fas fa-calendar-alt w-5 h-5 text-orange-600 group-hover:text-orange-700 transition duration-200"></i>
                        <span class="group-hover:text-orange-700 text-gray-800 font-semibold ml-4">Event</span>
                        <span class="flex-1 flex justify-end items-center">
                            <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full shadow-sm">{{ $totalEvents ?? 0 }}</span>
                            <i class="fas fa-chevron-right text-xs text-gray-400 group-hover:text-orange-600 ml-2"></i>
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.laporan.index') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-amber-100 group transition-all duration-200 hover:text-orange-700 hover:shadow-md">
                        <i class="fas fa-chart-line w-5 h-5 text-orange-600 group-hover:text-orange-700 transition duration-200"></i>
                        <span class="group-hover:text-orange-700 text-gray-800 font-semibold ml-4">Laporan</span>
                        <span class="flex-1 flex justify-end">
                            <i class="fas fa-chevron-right text-xs text-gray-400 group-hover:text-orange-600"></i>
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.profile') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-amber-100 group transition-all duration-200 hover:text-orange-700 hover:shadow-md">
                        <i class="fas fa-user w-5 h-5 text-orange-600 group-hover:text-orange-700 transition duration-200"></i>
                        <span class="group-hover:text-orange-700 text-gray-800 font-semibold ml-4">Akun</span>
                        <span class="flex-1 flex justify-end">
                            <i class="fas fa-chevron-right text-xs text-gray-400 group-hover:text-orange-600"></i>
                        </span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Logout Section -->
        <div class="bg-white rounded-xl shadow-sm p-2 border border-amber-100">
            <ul class="font-montserrat">
                <li>
                    <a href="{{ route('logout') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-red-50 group transition-all duration-200 hover:text-red-600 hover:shadow-md" id="logout-button">
                        <i class="fas fa-sign-out-alt w-5 h-5 text-red-500 group-hover:text-red-600 transition duration-200"></i>
                        <span class="group-hover:text-red-600 text-gray-800 font-semibold ml-4">Keluar</span>
                        <span class="flex-1 flex justify-end">
                            <i class="fas fa-chevron-right text-xs text-gray-400 group-hover:text-red-500"></i>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<!-- Mobile menu button -->
<div class="sm:hidden fixed top-4 left-4 z-50">
    <button id="mobile-menu-button" class="bg-amber-100 hover:bg-amber-200 p-2 rounded-lg shadow-md text-orange-600 hover:text-orange-700 focus:outline-none transition-all duration-200">
        <i class="fas fa-bars text-xl"></i>
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
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal',
            backdrop: 'rgba(0,0,0,0.8)',
            customClass: {
                container: 'font-montserrat',
                title: 'text-gray-900',
                htmlContainer: 'text-gray-700',
                confirmButton: 'bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg',
                cancelButton: 'bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg'
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

    // Add active state to current page
    document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname;
        const menuItems = document.querySelectorAll('#default-sidebar a[href]');

        menuItems.forEach(item => {
            if (item.getAttribute('href') === currentPath) {
                item.classList.add('bg-orange-100', 'text-orange-700', 'shadow-md');
                item.classList.remove('text-gray-700');
                const icon = item.querySelector('i');
                if (icon) {
                    icon.classList.add('text-orange-700');
                    icon.classList.remove('text-orange-600');
                }
            }
        });
    });
</script>
