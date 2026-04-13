<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'BOOKAGO') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <meta name="color-scheme" content="light only">
    <meta name="darkreader-lock">

    <!-- CSS / JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @livewireStyles
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-brand-dark antialiased selection:bg-brand-lime selection:text-white" style="background-color: #f8fafc;" x-data="{ sidebarOpen: false }">

    <!-- Mobile overlay -->
    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-50 z-30 md:hidden" @click="sidebarOpen = false" x-cloak></div>

    <!-- White Theme Sidebar -->
    <x-sidebar />

    <!-- Main Content Area Container -->
    <div class="md:pl-64 flex flex-col min-h-screen transition-all duration-300 w-full bg-slate-50">
        <!-- Bright White Navbar -->
        <x-navbar />

        <main class="flex-1 px-4 sm:px-6 py-8 overflow-x-hidden">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>
