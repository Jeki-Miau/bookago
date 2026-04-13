<header
    class="sticky top-0 z-30 w-full px-6 py-4 bg-white/80 backdrop-blur-md border-b border-gray-200 shadow-sm transition-all duration-300">
    <div class="flex items-center justify-between mx-auto w-full">

        <div class="flex items-center w-full max-w-lg">
            <!-- Mobile Menu Toggler -->
            <button @click="sidebarOpen = !sidebarOpen" type="button" class="md:hidden mr-3 p-2 text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-brand-lime transition">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Search Bar -->
            <form action="{{ route('search') }}" method="GET"
                class="flex items-center w-full bg-gray-50 border border-gray-200 rounded-full px-5 py-2.5 transition focus-within:ring-2 focus-within:ring-brand-lime shadow-sm">
            <svg class="w-5 h-5 text-gray-400 flex-shrink-0 transition" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input type="text" name="q" placeholder="Cari judul, penulis, atau ISBN..."
                class="w-full bg-transparent border-none focus:ring-0 text-brand-dark font-medium placeholder-gray-400 ml-3 text-sm">
            </form>
        </div>

        <!-- Auth Navigation -->
        @auth
            <div class="flex items-center space-x-4 ml-auto">
                <a href="{{ route('home') }}"
                    class="hidden md:flex items-center px-4 py-2 text-sm font-bold text-gray-600 bg-gray-50 border border-gray-200 rounded-full hover:bg-gray-100 hover:text-brand-lime transition">
                    Dasbor
                </a>

                <div class="flex items-center">
                    @livewire('notifications')
                </div>

                <div x-data="{ open: false }" class="relative inline-block text-left">
                    <button @click="open = !open" type="button"
                        class="group inline-flex w-full justify-center text-sm font-bold text-brand-dark hover:text-brand-lime transition items-center bg-transparent border-none">
                        <img class="w-10 h-10 rounded-full shadow-md border-2 border-white flex-shrink-0 object-cover group-hover:border-brand-lime transition"
                            src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0f172a&color=fff' }}"
                            alt="Avatar">
                        <span class="ml-3 hidden sm:block">{{ Auth::user()->name }}</span>
                        <svg class="-mr-1 h-5 w-5 text-gray-400 group-hover:text-brand-lime ml-1 hidden sm:block transition"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" @click.away="open = false" x-transition.opacity
                        class="absolute right-0 z-50 mt-3 w-56 origin-top-right rounded-2xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none border border-gray-100 overflow-hidden">
                        <div class="px-4 py-3 border-b border-gray-50 bg-gray-50/50">
                            <p class="text-xs text-gray-500 font-medium">Masuk sebagai</p>
                            <p class="text-sm font-bold text-brand-dark truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="py-1">
                            @if(Auth::user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}"
                                    class="block px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-brand-lime transition">Panel Admin</a>
                            @else
                                <a href="{{ route('contact.admin') }}"
                                    class="block px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-brand-lime transition">Hubungi Admin</a>
                            @endif
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-brand-lime transition">Pengaturan
                                Akun</a>
                            <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-50 mt-1">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2.5 text-sm font-bold text-red-600 hover:bg-red-50 transition">Keluar
                                    Aplikasi</button>
                            </form>
                        </div>
                    </div>
                </div>
        @else
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}"
                        class="text-sm font-bold text-gray-600 hover:text-brand-primary transition">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="text-sm font-bold bg-brand-primary text-white px-5 py-2.5 rounded-full hover:bg-opacity-90 transition shadow-sm">Daftar</a>
                </div>
            @endauth

        </div>
</header>