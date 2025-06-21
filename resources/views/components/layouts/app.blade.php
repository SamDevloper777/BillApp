<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Jewelry Billing System' }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50">
    <div class="flex flex-col min-h-screen">
        <!-- Header -->
        <header class="sticky top-0 z-50 bg-white shadow">
            <x-admin.header />
        </header>

        <div class="flex flex-1 overflow-hidden">
            <!-- Sidebar Overlay for Mobile -->
            <div id="sidebar-overlay" onclick="closeSidebar()" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-30 md:hidden hidden"></div>

            <!-- Sidebar -->
            <aside id="sidebar"
                class="fixed inset-y-0 left-0 w-64 bg-white border-r transform -translate-x-full md:translate-x-0 md:relative transition-transform duration-300 ease-in-out z-40 md:z-0">
                <x-admin.sidebar />
            </aside>

            <!-- Main Content -->
            <main class="flex-1 overflow-auto">
                <div class="container mx-auto p-4 md:p-6 lg:p-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Sidebar Toggle Script -->
    <script>
        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenu) {
                mobileMenu.addEventListener('click', () => {
                    document.getElementById('sidebar').classList.toggle('-translate-x-full');
                    document.getElementById('sidebar-overlay').classList.toggle('hidden');
                });
            }
        });
    </script>
<x-admin.toster/>
</body>

</html>
