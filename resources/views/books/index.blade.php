<x-app-layout>
    <div class="max-w-7xl mx-auto space-y-8 pb-12">

        <!-- Dashboard Welcome Hero Section -->
        <section x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)" x-show="show"
            x-transition:enter="transition ease-out duration-700 transform"
            x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
            class="relative bg-white border border-gray-100 rounded-2xl p-6 lg:p-10 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-500">
            <!-- Subtle blue accent backdrop -->
            <div
                class="absolute -top-32 -right-32 w-80 h-80 bg-brand-lime/10 blur-3xl rounded-full pointer-events-none">
            </div>

            <div class="relative z-10 max-w-2xl space-y-2.5">
                <p class="text-[9px] font-black uppercase tracking-widest text-brand-lime font-mono">Ruang Kerja Saya
                </p>
                <h1 class="text-xl lg:text-2xl font-extrabold text-brand-dark tracking-tight leading-tight">
                    Selamat datang, <span class="text-brand-lime">{{ Auth::user()->name ?? 'Pembaca' }}</span>.
                </h1>
                <p class="text-xs text-gray-500 font-medium max-w-lg leading-relaxed">
                    Berikut ini adalah ringkasan dari sesi membaca aktif Anda, daftar bab yang tertunda, dan seluruh
                    karya sastra yang baru saja ditambahkan dari katalog perpustakaan digital ini.
                </p>
                <div class="pt-4 flex flex-wrap items-center gap-3">
                    <button
                        class="bg-brand-primary text-white px-6 py-2.5 rounded-full font-bold shadow hover:bg-opacity-90 transition hover:-translate-y-0.5 text-xs">
                        Lanjutkan Membaca
                    </button>
                    <button
                        class="bg-gray-50 text-gray-700 border border-gray-200 px-6 py-2.5 rounded-full font-bold hover:bg-gray-100 transition hover:-translate-y-0.5 text-xs">
                        Eksplorasi Katalog
                    </button>
                </div>
            </div>
        </section>

        <!-- Stats Overview Cards (Live from Firebase) -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-6"
            x-data="{
                savedCount: 0,
                readingCount: 0,
                totalProgress: 0,
                init() {
                    const userId = {{ auth()->id() ?? 0 }};
                    if (!userId || !window.firebaseHelpers) return;
                    window.firebaseHelpers.onSavedBooksChange(userId, (books) => {
                        this.savedCount = books.length;
                    });
                    window.firebaseHelpers.onReadingProgressChange(userId, (progress) => {
                        this.readingCount = progress.length;
                        this.totalProgress = progress.reduce((sum, p) => sum + (p.progressPercent || 0), 0);
                    });
                }
            }">
            <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)" x-show="show"
                x-transition:enter="transition ease-out duration-700 transform"
                x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
                class="bg-white p-4 lg:p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-0.5">Buku Tersimpan</p>
                    <p class="text-2xl font-black text-brand-dark" x-text="savedCount">0</p>
                </div>
                <div
                    class="w-10 h-10 bg-brand-surface rounded-xl flex items-center justify-center text-brand-primary group-hover:bg-brand-lime group-hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                    </svg>
                </div>
            </div>
            <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 450)" x-show="show"
                x-transition:enter="transition ease-out duration-700 transform"
                x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
                class="bg-white p-4 lg:p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-0.5">Sedang Dibaca</p>
                    <p class="text-2xl font-black text-brand-dark" x-text="readingCount">0</p>
                </div>
                <div
                    class="w-10 h-10 bg-brand-surface rounded-xl flex items-center justify-center text-brand-primary group-hover:bg-brand-lime group-hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
            </div>
            <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 600)" x-show="show"
                x-transition:enter="transition ease-out duration-700 transform"
                x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
                class="bg-white p-4 lg:p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-0.5">Progres Total</p>
                    <p class="text-2xl font-black text-brand-dark"><span x-text="totalProgress">0</span><span
                            class="text-base text-gray-400 font-bold ml-1">%</span></p>
                </div>
                <div
                    class="w-10 h-10 bg-brand-surface rounded-xl flex items-center justify-center text-brand-primary group-hover:bg-brand-lime group-hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
            </div>
        </section>

        <!-- Categories Filter Section -->
        <section class="pt-5 w-full overflow-x-auto no-scrollbar animate-fade-in-up" style="animation-delay: 200ms;">
            <div class="flex items-center gap-2.5 pb-2">
                <a href="{{ route('home') }}"
                    class="px-5 py-2.5 rounded-full text-xs font-bold whitespace-nowrap transition-all duration-300 {{ !$selectedCategory ? 'bg-brand-dark text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-100 hover:text-brand-dark border border-gray-200' }}">
                    <span class="mr-1">🔥</span> Semua Buku
                </a>
                @foreach ($categories as $cat)
                    <a href="{{ route('home', ['category' => $cat]) }}"
                        class="px-5 py-2.5 rounded-full text-xs font-bold whitespace-nowrap transition-all duration-300 {{ $selectedCategory == $cat ? 'bg-brand-lime text-brand-dark shadow-sm ring-2 ring-brand-lime ring-offset-1' : 'bg-white text-gray-500 hover:bg-gray-50 hover:text-brand-dark border border-gray-200 hover:border-gray-300 hover:shadow-sm' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Trending Section -->
        <section class="space-y-6 pt-6 animate-fade-in-up" style="animation-delay: 300ms;">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-extrabold flex items-center space-x-2">
                    <span class="w-1.5 h-5 {{ $selectedCategory ? 'bg-brand-primary' : 'bg-brand-lime' }} rounded-full inline-block shadow-sm"></span>
                    <span class="text-brand-dark">{{ $selectedCategory ? 'Kategori: ' . $selectedCategory : 'Sedang Populer' }}</span>
                </h2>
                <a href="#"
                    class="text-xs font-bold text-brand-lime hover:opacity-80 transition inline-flex items-center">Lihat
                    semua <svg class="ml-1 w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg></a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-6 gap-4">
                <!-- If database is empty, show placeholders -->
                @forelse ($trending as $book)
                    <x-book-card :book="$book" />
                @empty
                    <!-- Placeholder Generation directly in loop for Boilerplate visual -->
                    @for ($i = 0; $i < 6; $i++)
                        @php
                            $placeholderBook = new \App\Models\Book([
                                'title' => 'Mahakarya ' . ($i + 1),
                                'author' => 'Siti Cendekiawan',
                                'slug' => 'sample-' . $i,
                            ]);
                        @endphp
                        <x-book-card :book="$placeholderBook" />
                    @endfor
                @endforelse
            </div>
        </section>

        <!-- Recently Added Section -->
        @if ($recent->isNotEmpty())
        <section class="space-y-6 pt-8 animate-fade-in-up" style="animation-delay: 400ms;">
            <div class="flex items-center justify-between border-t border-gray-100 pt-6">
                <h2 class="text-lg font-extrabold flex items-center space-x-2">
                    <span class="w-1.5 h-5 bg-brand-primary rounded-full inline-block shadow-sm"></span>
                    <span class="text-brand-dark">Baru Ditambahkan</span>
                </h2>
                <a href="#"
                    class="text-xs font-bold text-gray-500 hover:text-brand-dark transition inline-flex items-center">Buka
                    katalog <svg class="ml-1 w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg></a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-6 gap-4">
                @forelse ($recent as $book)
                    <x-book-card :book="$book" />
                @empty
                    @for ($i = 0; $i < 6; $i++)
                        @php
                            $placeholderBook = new \App\Models\Book([
                                'title' => 'Penemuan Baru ' . ($i + 1),
                                'author' => 'Budi Peneliti',
                                'slug' => 'new-' . $i,
                            ]);
                        @endphp
                        <x-book-card :book="$placeholderBook" />
                    @endfor
                @endforelse
            </div>
        </section>
        @endif

    </div>
</x-app-layout>