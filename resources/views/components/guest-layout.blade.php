<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'BOOKAGO') }} - Perpustakaan Digital</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- CSS / JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @livewireStyles
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .bg-grid-pattern {
            background-image: linear-gradient(to right, #e5e7eb 1px, transparent 1px),
                linear-gradient(to bottom, #e5e7eb 1px, transparent 1px);
            background-size: 80px 80px;
            background-position: center top;
        }

        .underline-highlight {
            position: relative;
            display: inline-block;
        }

        .underline-highlight::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 4px;
            bottom: 4px;
            left: 0;
            background-color: var(--color-brand-primary);
            border-radius: 2px;
            z-index: -1;
        }

        /* Floating Pill Navbar */
        .pill-navbar {
            position: fixed;
            top: 16px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 100;
            width: max-content;
            max-width: 95vw;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .pill-navbar .pill-inner {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 9999px;
            padding: 6px 8px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.06), 0 1px 3px rgba(0, 0, 0, 0.04);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .pill-navbar.scrolled .pill-inner {
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.1), 0 2px 6px rgba(0, 0, 0, 0.05);
            border-color: rgba(0, 0, 0, 0.06);
        }

        /* Nav link pill indicator */
        .pill-nav-link {
            position: relative;
            padding: 8px 16px;
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 600;
            color: #6b7280;
            transition: all 0.25s ease;
            white-space: nowrap;
        }

        .pill-nav-link:hover {
            color: #0f172a;
            background: rgba(0, 0, 0, 0.04);
        }

        .pill-nav-link.active-pill {
            color: #0f172a;
            background: rgba(0, 0, 0, 0.06);
            font-weight: 700;
        }

        /* Elegant Entrance Animations */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 1s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-delay-100 {
            transition-delay: 100ms;
        }

        .reveal-delay-200 {
            transition-delay: 200ms;
        }

        .reveal-delay-300 {
            transition-delay: 300ms;
        }

        .reveal-delay-400 {
            transition-delay: 400ms;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float 6s ease-in-out infinite;
            animation-delay: 2s;
        }

        .animate-float-slow {
            animation: float 8s ease-in-out infinite;
            animation-delay: 1s;
        }

        /* Infinite Marquee Animation for Google Books */
        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(calc(-250px * 7));
            }
        }

        .animate-scroll {
            animation: scroll 40s linear infinite;
        }

        .animate-scroll:hover {
            animation-play-state: paused;
        }

        /* Mobile hamburger menu */
        .mobile-menu {
            transform: translateY(-10px);
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .mobile-menu.open {
            transform: translateY(0);
            opacity: 1;
            pointer-events: all;
        }
    </style>
</head>

<body class="bg-white text-brand-dark antialiased selection:bg-brand-lime selection:text-white overflow-x-hidden">

    <!-- Floating Pill Navbar -->
    <div class="pill-navbar" id="pillNavbar" x-data="{
            scrolled: false,
            mobileOpen: false,
            activeSection: '',
            init() {
                // Scroll detection
                window.addEventListener('scroll', () => {
                    this.scrolled = window.scrollY > 50;
                });

                // Active section detection via IntersectionObserver
                const sections = document.querySelectorAll('section[id]');
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            this.activeSection = entry.target.id;
                        }
                    });
                }, { rootMargin: '-40% 0px -40% 0px' });
                sections.forEach(s => observer.observe(s));
            }
        }" :class="{ 'scrolled': scrolled }">

        <div class="pill-inner flex items-center justify-between gap-1 w-full max-w-full">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-2 pl-2 pr-3 py-1 rounded-full hover:bg-black/[0.03] transition">
                <div class="w-7 h-7 rounded-lg bg-brand-lime flex items-center justify-center shadow-sm">
                    <svg class="w-4 h-4 text-brand-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                        <path fill-rule="evenodd"
                            d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-sm font-extrabold tracking-tight text-brand-dark">BOOKAGO</span>
            </a>

            <!-- Divider -->
            <div class="hidden md:block w-px h-5 bg-gray-200 mx-1"></div>

            <!-- Nav Links (Desktop) -->
            <nav class="hidden md:flex items-center gap-0.5">
                <a href="#mengapa" class="pill-nav-link"
                    :class="{ 'active-pill': activeSection === 'mengapa' }">Mengapa</a>
                <a href="#fitur" class="pill-nav-link" :class="{ 'active-pill': activeSection === 'fitur' }">Fitur</a>
                <a href="#tentang" class="pill-nav-link"
                    :class="{ 'active-pill': activeSection === 'tentang' }">Tentang</a>
                <a href="#dukung" class="pill-nav-link" :class="{ 'active-pill': activeSection === 'dukung' }">
                    Dukung
                    <span class="inline-block ml-1 text-[10px]">🧡</span>
                </a>
            </nav>

            <!-- Divider -->
            <div class="hidden md:block w-px h-5 bg-gray-200 mx-1"></div>

            <!-- Auth Buttons -->
            <div class="hidden md:flex items-center gap-1.5">
                @auth
                    <a href="{{ route('home') }}"
                        class="text-xs font-bold text-white bg-brand-primary px-5 py-2 rounded-full hover:bg-opacity-90 hover:scale-105 active:scale-95 transition-all shadow-sm">Dasbor</a>
                @else
                    <a href="{{ route('login') }}" class="pill-nav-link text-gray-600">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="text-xs font-bold text-white bg-brand-primary px-5 py-2 rounded-full hover:bg-opacity-90 hover:scale-105 active:scale-95 transition-all shadow-sm">Daftar</a>
                @endauth
            </div>

            <!-- Mobile Hamburger -->
            <button @click="mobileOpen = !mobileOpen"
                class="md:hidden p-2 rounded-full hover:bg-black/[0.04] transition ml-1">
                <svg x-show="!mobileOpen" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="mobileOpen" x-cloak class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Dropdown -->
        <div class="mobile-menu md:hidden mt-2" :class="{ 'open': mobileOpen }">
            <div class="bg-white/95 backdrop-blur-xl rounded-2xl border border-gray-100 shadow-xl p-4 space-y-1">
                <a href="#mengapa" @click="mobileOpen = false"
                    class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-600 hover:bg-gray-50 hover:text-brand-dark transition">Mengapa
                    Kami</a>
                <a href="#fitur" @click="mobileOpen = false"
                    class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-600 hover:bg-gray-50 hover:text-brand-dark transition">Fitur</a>
                <a href="#tentang" @click="mobileOpen = false"
                    class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-600 hover:bg-gray-50 hover:text-brand-dark transition">Tentang</a>
                <a href="#dukung" @click="mobileOpen = false"
                    class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-600 hover:bg-gray-50 hover:text-brand-dark transition">Dukung
                    Kami 🧡</a>
                <div class="border-t border-gray-100 pt-3 mt-2 flex gap-2">
                    @auth
                        <a href="{{ route('home') }}"
                            class="flex-1 text-center text-sm font-bold text-white bg-brand-primary py-2.5 rounded-xl hover:bg-opacity-90 transition">Dasbor</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="flex-1 text-center text-sm font-bold text-gray-700 bg-gray-50 py-2.5 rounded-xl hover:bg-gray-100 transition">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="flex-1 text-center text-sm font-bold text-white bg-brand-primary py-2.5 rounded-xl hover:bg-opacity-90 transition">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="w-full flex flex-col">
        {{ $slot }}
    </main>

    <!-- Deep Dark Footer -->
    <footer class="bg-brand-footer pt-16 pb-8 border-t border-brand-dark/20 relative">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-2 md:grid-cols-5 gap-8 text-gray-400 text-xs">

            <div class="col-span-2 md:col-span-1 space-y-4">
                <div class="flex items-center space-x-2 mb-6">
                    <div class="w-6 h-6 rounded-md bg-brand-lime flex items-center justify-center">
                        <svg class="w-4 h-4 text-brand-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                            <path fill-rule="evenodd"
                                d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <a href="/" class="text-lg font-bold text-white tracking-tight">BOOKAGO</a>
                </div>
                <p>Platform perpustakaan digital Indonesia yang gratis dan open-source.</p>
                <p class="text-gray-500 mt-2">Jakarta, Indonesia</p>
            </div>

            <div class="col-span-1">
                <h4 class="text-white font-bold mb-4 uppercase tracking-wide">Platform</h4>
                <ul class="space-y-3 font-medium">
                    <li><a href="#mengapa" class="hover:text-brand-lime transition">Mengapa BOOKAGO</a></li>
                    <li><a href="#fitur" class="hover:text-brand-lime transition">Fitur Unggulan</a></li>
                    <li><a href="#tentang" class="hover:text-brand-lime transition">Tentang Kami</a></li>
                    <li><a href="#testimoni" class="hover:text-brand-lime transition">Testimoni</a></li>
                </ul>
            </div>

            <div class="col-span-1">
                <h4 class="text-white font-bold mb-4 uppercase tracking-wide">Komunitas</h4>
                <ul class="space-y-3 font-medium">
                    <li><a href="https://github.com/Jeki-Miau" target="_blank"
                            class="hover:text-brand-lime transition">GitHub</a></li>
                    <li><a href="#" class="hover:text-brand-lime transition">Discord</a></li>
                    <li><a href="#" class="hover:text-brand-lime transition">Komunitas Pembaca</a></li>
                    <li><a href="#" class="hover:text-brand-lime transition">Blog & Artikel</a></li>
                </ul>
            </div>

            <div class="col-span-1">
                <h4 class="text-white font-bold mb-4 uppercase tracking-wide">Dukung Kami</h4>
                <ul class="space-y-3 font-medium">
                    <li><a href="https://saweria.co/JekiMiau" target="_blank"
                            class="hover:text-brand-lime transition flex items-center gap-1">🧡 Saweria</a></li>
                    <li><a href="https://github.com/Jeki-Miau" target="_blank"
                            class="hover:text-brand-lime transition flex items-center gap-1">⭐ Star di GitHub</a></li>
                    <li><a href="#" class="hover:text-brand-lime transition">Pusat Bantuan</a></li>
                    <li><a href="#" class="hover:text-brand-lime transition">Kontak Kami</a></li>
                </ul>
            </div>
        </div>

        <div
            class="max-w-6xl mx-auto px-6 mt-16 pt-8 border-t border-gray-800 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-gray-500 font-medium">
            <p>© {{ date('Y') }} BOOKAGO Nusantara. Dibuat dengan ❤️ di Indonesia.</p>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-white transition">Syarat & Ketentuan</a>
                <a href="#" class="hover:text-white transition">Kebijakan Privasi</a>
                <a href="https://github.com/Jeki-Miau" target="_blank" class="hover:text-white transition">GitHub</a>
                <a href="https://saweria.co/JekiMiau" target="_blank" class="hover:text-white transition">Saweria</a>
            </div>
        </div>
    </footer>

    @livewireScripts
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.15
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        // Optional: unobserve after animating once
                        // observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
</body>

</html>