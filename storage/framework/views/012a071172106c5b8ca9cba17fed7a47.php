<?php if (isset($component)) { $__componentOriginalcb8170ac00b272413fe5b25f86fc5e3a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcb8170ac00b272413fe5b25f86fc5e3a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.guest-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


    <!-- Hero Section -->
    <section class="relative bg-brand-bg bg-grid-pattern pt-40 lg:pt-52 pb-24 overflow-hidden border-b border-gray-100">
        <div class="max-w-5xl mx-auto px-6 text-center relative z-10">

            <!-- Floating Avatars -->
            <div class="hidden md:block absolute -left-12 top-10 transform translate-x-12 -translate-y-12 animate-float">
                <img src="https://ui-avatars.com/api/?name=Budi&background=e0e7ff&color=4f46e5&rounded=true"
                    alt="Pengguna" class="w-12 h-12 rounded-full border-2 border-white shadow-xl">
            </div>
            <div class="hidden md:block absolute -right-8 top-0 transform -translate-x-12 -translate-y-8 animate-float-delayed">
                <img src="https://ui-avatars.com/api/?name=Ani&background=fef3c7&color=d97706&rounded=true"
                    alt="Pengguna" class="w-14 h-14 rounded-full border-2 border-white shadow-xl">
            </div>
            <div class="hidden md:block absolute left-4 bottom-16 transform translate-x-12 translate-y-8 animate-float-slow">
                <img src="https://ui-avatars.com/api/?name=Siti&background=fce7f3&color=be185d&rounded=true"
                    alt="Pengguna" class="w-14 h-14 rounded-full border-2 border-white shadow-xl">
            </div>
            <div class="hidden md:block absolute right-8 bottom-4 transform -translate-x-12 translate-y-12 animate-float">
                <img src="https://ui-avatars.com/api/?name=Dika&background=dcfce7&color=15803d&rounded=true"
                    alt="Pengguna" class="w-16 h-16 rounded-full border-4 border-white shadow-xl">
            </div>

            <span
                class="relative z-10 reveal text-xs font-extrabold uppercase tracking-widest text-brand-dark bg-gradient-to-r from-brand-lime to-green-300 px-5 py-2 rounded-full shadow-[0_4px_20px_rgba(163,230,53,0.4)] mb-8 inline-block animate-bounce">✨ Versi
                2.0 Telah Rilis ✨</span>

            <h1
                class="relative z-10 reveal reveal-delay-100 text-4xl sm:text-5xl md:text-7xl font-extrabold tracking-tight text-brand-dark leading-[1.1] max-w-4xl mx-auto">
                Satu platform pengelola perpustakaan <span class="underline-highlight text-brand-dark whitespace-nowrap">digital</span>
                Anda
            </h1>

            <p class="reveal reveal-delay-200 mt-8 text-lg font-medium text-gray-500 max-w-2xl mx-auto leading-relaxed">
                Tempat perlindungan digital terbaik yang didesain untuk cendekiawan modern.
                Tingkatkan kedisiplinan membaca, pantau riwayat Anda, dan kelola semua koleksi buku dengan mudah.
            </p>

            <!-- Hero Search Bar -->
            <div class="reveal reveal-delay-300 mt-10 max-w-2xl mx-auto">
                <form action="<?php echo e(route('search')); ?>" method="GET" class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-6 w-6 text-gray-400 group-focus-within:text-brand-lime transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="q"
                        class="block w-full pl-12 pr-20 sm:pr-32 py-4 sm:py-5 border-2 border-gray-200 rounded-full text-sm sm:text-base placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-brand-lime/20 focus:border-brand-lime transition-all shadow-lg"
                        placeholder="Judul, penulis, ISBN...">
                    <button type="submit"
                        class="absolute right-2 top-2 bottom-2 bg-brand-primary text-white font-bold px-4 sm:px-6 rounded-full hover:bg-opacity-90 hover:scale-105 active:scale-95 transition-transform shadow-md flex items-center justify-center">
                        <span class="hidden sm:inline">Cari Buku</span>
                        <svg class="w-5 h-5 sm:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>

            <div
                class="reveal reveal-delay-400 mt-8 flex items-center justify-center gap-4 text-sm font-bold text-gray-500">
                <span>Atau,</span>
                <a href="<?php echo e(route('register')); ?>" class="text-brand-lime hover:underline">Daftar secara cuma-cuma
                    &rarr;</a>
            </div>
        </div>

        <!-- Google Books API Marquee Carousel -->
        <div class="reveal mt-28 max-w-full overflow-hidden relative">
            <div
                class="absolute inset-y-0 left-0 w-32 bg-gradient-to-r from-brand-bg to-transparent z-10 pointer-events-none">
            </div>
            <div
                class="absolute inset-y-0 right-0 w-32 bg-gradient-to-l from-brand-bg to-transparent z-10 pointer-events-none">
            </div>

            <div class="flex items-center gap-6 animate-scroll whitespace-nowrap px-4 py-4 w-[200%]">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $recommendedBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div
                        class="w-40 sm:w-48 aspect-[2/3] bg-white rounded-2xl border border-gray-200 shadow-md flex-none overflow-hidden group cursor-pointer hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                        <img src="<?php echo e($book['cover']); ?>" alt="<?php echo e($book['title']); ?>" class="w-full h-full object-cover">
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $recommendedBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div
                        class="w-40 sm:w-48 aspect-[2/3] bg-white rounded-2xl border border-gray-200 shadow-md flex-none overflow-hidden group cursor-pointer hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                        <img src="<?php echo e($book['cover']); ?>" alt="<?php echo e($book['title']); ?>" class="w-full h-full object-cover">
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>

        <!-- Logo Cloud -->
        <div class="reveal mt-16 max-w-5xl mx-auto px-6 relative z-10 text-center">
            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-8 font-sans">Dipercaya lebih
                dari 4,000+ perguruan tinggi</p>
            <div
                class="grid grid-cols-2 md:grid-cols-5 gap-8 items-center justify-center opacity-50 grayscale contrast-200 hover:grayscale-0 hover:opacity-100 transition-all duration-500">
                <span
                    class="text-xl font-black font-serif hover:scale-125 transition-transform duration-300 cursor-pointer hover:text-orange-500">Universitas
                    Indonesia</span>
                <span
                    class="text-xl font-bold font-sans hover:scale-125 transition-transform duration-300 cursor-pointer hover:text-green-600">ITB
                    Nusantara</span>
                <span
                    class="text-xl font-semibold font-mono tracking-tighter hover:scale-125 transition-transform duration-300 cursor-pointer hover:text-green-500">ugmYogya</span>
                <span
                    class="text-xl font-black lowercase hover:scale-125 transition-transform duration-300 cursor-pointer hover:text-blue-500">binus.edu</span>
                <span
                    class="text-xl font-bold capitalize hover:scale-125 transition-transform duration-300 cursor-pointer hover:text-gray-800">KampusMerdeka</span>
            </div>
        </div>
    </section>

    <!-- ===== WHY BOOKAGO SECTION ===== -->
    <section id="mengapa" class="py-28 bg-white relative overflow-hidden">
        <div class="max-w-6xl mx-auto px-6">
            <div class="reveal text-center max-w-2xl mx-auto mb-20">
                <span class="text-xs font-bold uppercase tracking-widest text-brand-lime mb-2 block">Mengapa
                    Kami?</span>
                <h2 class="text-4xl md:text-5xl font-extrabold text-brand-dark tracking-tight leading-tight">
                    Kenapa harus memilih <span class="underline-highlight">BOOKAGO</span>?
                </h2>
                <p class="mt-4 text-gray-500 font-medium">Platform yang dirancang dengan hati untuk para pecinta buku
                    Indonesia.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Reason 1 -->
                <div
                    class="reveal bg-gradient-to-br from-brand-surface to-white rounded-3xl p-8 border border-gray-100 shadow-sm group hover:shadow-xl hover:-translate-y-2 transition-all duration-500">
                    <div
                        class="w-14 h-14 bg-brand-lime/20 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-brand-lime group-hover:scale-110 transition-all duration-300">
                        <svg class="w-7 h-7 text-brand-lime group-hover:text-white transition" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-brand-dark mb-3">Gratis Selamanya</h3>
                    <p class="text-sm font-medium text-gray-500 leading-relaxed">Tidak perlu kartu kredit. Akses ribuan
                        buku digital Indonesia tanpa biaya apapun. Baca kapanpun, dimanapun.</p>
                </div>

                <!-- Reason 2 -->
                <div
                    class="reveal reveal-delay-100 bg-gradient-to-br from-brand-surface to-white rounded-3xl p-8 border border-gray-100 shadow-sm group hover:shadow-xl hover:-translate-y-2 transition-all duration-500">
                    <div
                        class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-indigo-500 group-hover:scale-110 transition-all duration-300">
                        <svg class="w-7 h-7 text-indigo-500 group-hover:text-white transition" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-brand-dark mb-3">Sinkronisasi Real-time</h3>
                    <p class="text-sm font-medium text-gray-500 leading-relaxed">Progres membaca dan koleksi tersimpan
                        disinkronkan secara otomatis berkat integrasi Firebase Cloud.</p>
                </div>

                <!-- Reason 3 -->
                <div
                    class="reveal reveal-delay-200 bg-gradient-to-br from-brand-surface to-white rounded-3xl p-8 border border-gray-100 shadow-sm group hover:shadow-xl hover:-translate-y-2 transition-all duration-500">
                    <div
                        class="w-14 h-14 bg-amber-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-amber-500 group-hover:scale-110 transition-all duration-300">
                        <svg class="w-7 h-7 text-amber-500 group-hover:text-white transition" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-brand-dark mb-3">Fokus Sastra Indonesia</h3>
                    <p class="text-sm font-medium text-gray-500 leading-relaxed">Dibangun khusus untuk ekosistem
                        literasi Indonesia. Dari Pramoedya hingga Tere Liye, semua ada di sini.</p>
                </div>

                <!-- Reason 4 -->
                <div
                    class="reveal bg-gradient-to-br from-brand-surface to-white rounded-3xl p-8 border border-gray-100 shadow-sm group hover:shadow-xl hover:-translate-y-2 transition-all duration-500">
                    <div
                        class="w-14 h-14 bg-rose-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-rose-500 group-hover:scale-110 transition-all duration-300">
                        <svg class="w-7 h-7 text-rose-500 group-hover:text-white transition" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-brand-dark mb-3">Privasi Terjamin</h3>
                    <p class="text-sm font-medium text-gray-500 leading-relaxed">Data Anda dienkripsi dan tersimpan
                        aman. Kami tidak pernah membagikan informasi pribadi kepada pihak ketiga.</p>
                </div>

                <!-- Reason 5 -->
                <div
                    class="reveal reveal-delay-100 bg-gradient-to-br from-brand-surface to-white rounded-3xl p-8 border border-gray-100 shadow-sm group hover:shadow-xl hover:-translate-y-2 transition-all duration-500">
                    <div
                        class="w-14 h-14 bg-cyan-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-cyan-500 group-hover:scale-110 transition-all duration-300">
                        <svg class="w-7 h-7 text-cyan-500 group-hover:text-white transition" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-brand-dark mb-3">Lintas Perangkat</h3>
                    <p class="text-sm font-medium text-gray-500 leading-relaxed">Baca di laptop, tablet, atau ponsel.
                        Antarmuka responsif yang selalu tampil optimal di layar apapun.</p>
                </div>

                <!-- Reason 6 -->
                <div
                    class="reveal reveal-delay-200 bg-gradient-to-br from-brand-surface to-white rounded-3xl p-8 border border-gray-100 shadow-sm group hover:shadow-xl hover:-translate-y-2 transition-all duration-500">
                    <div
                        class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-emerald-500 group-hover:scale-110 transition-all duration-300">
                        <svg class="w-7 h-7 text-emerald-500 group-hover:text-white transition" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-brand-dark mb-3">Open Source</h3>
                    <p class="text-sm font-medium text-gray-500 leading-relaxed">Kode sumber terbuka di GitHub.
                        Kontribusi, fork, atau gunakan untuk proyek perpustakaan Anda sendiri.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bento Box Overview Section -->
    <section id="fitur" class="py-24 bg-brand-surface relative overflow-hidden">
        <div class="max-w-6xl mx-auto px-6">
            <div class="reveal text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-brand-primary mb-2 block">Tinjauan
                    Platform</span>
                <h2 class="text-4xl md:text-5xl font-extrabold text-brand-dark tracking-tight leading-tight">
                    Teknologi termutakhir untuk menemani rutinitas membaca Anda
                </h2>
                <p class="mt-4 text-gray-500 font-medium">Temukan fitur unggulan yang dirancang khusus untuk efisiensi
                    literatur.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div
                    class="reveal md:col-span-2 bg-white rounded-3xl p-8 border border-gray-200 shadow-sm flex flex-col md:flex-row items-center justify-between overflow-hidden group hover:shadow-xl hover:-translate-y-1 transition-all duration-500">
                    <div class="max-w-xs z-10">
                        <h3 class="text-2xl font-bold text-brand-dark mb-4">Dasbor Dinamis</h3>
                        <p class="text-sm font-medium text-gray-500 mb-8 leading-relaxed">Sinkronisasi lintas perangkat
                            yang memastikan seluruh riwayat dan progres bacaan tersimpan tepat secara otomatis ke Cloud.
                        </p>
                        <a href="<?php echo e(route('home')); ?>"
                            class="px-6 py-2.5 bg-brand-primary text-white text-xs font-bold rounded-full hover:shadow-lg transition">Jelajahi
                            Fitur</a>
                    </div>
                    <div
                        class="relative w-full md:w-1/2 h-48 mt-10 md:mt-0 flex items-end justify-between px-4 sm:px-10 gap-2 opacity-80">
                        <div class="w-8 h-20 bg-gray-100 rounded-t-md transition-all duration-700 group-hover:h-24">
                        </div>
                        <div class="w-8 h-32 bg-gray-100 rounded-t-md transition-all duration-700 group-hover:h-36">
                        </div>
                        <div class="w-8 h-12 bg-gray-100 rounded-t-md transition-all duration-700 group-hover:h-16">
                        </div>
                        <div class="w-8 h-24 bg-gray-100 rounded-t-md transition-all duration-700 group-hover:h-20">
                        </div>
                        <div
                            class="w-10 h-40 bg-brand-primary rounded-t-md shadow-lg shadow-brand-primary/30 relative transform group-hover:-translate-y-2 transition-transform duration-700">
                            <div
                                class="absolute -top-6 left-1/2 transform -translate-x-1/2 w-4 h-4 bg-brand-lime border-2 border-white rounded-full shadow-sm animate-pulse">
                            </div>
                        </div>
                        <div class="w-8 h-16 bg-gray-100 rounded-t-md transition-all duration-700 group-hover:h-20">
                        </div>
                        <div class="w-8 h-28 bg-gray-100 rounded-t-md transition-all duration-700 group-hover:h-24">
                        </div>
                        <div class="w-8 h-20 bg-gray-100 rounded-t-md transition-all duration-700 group-hover:h-16">
                        </div>
                        <div class="w-8 h-10 bg-gray-100 rounded-t-md transition-all duration-700 group-hover:h-14">
                        </div>
                    </div>
                </div>

                <div
                    class="reveal reveal-delay-100 bg-white rounded-3xl p-8 border border-gray-200 shadow-sm group hover:shadow-xl hover:-translate-y-1 transition-all duration-500">
                    <h3 class="text-xl font-bold text-brand-dark mb-2">Notifikasi Cerdas</h3>
                    <p class="text-sm font-medium text-gray-500 mb-8 leading-relaxed">Selalu terhubung dengan jadwal
                        rilis karya penulis favorit Anda.</p>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                            <span class="text-xs font-bold text-brand-dark uppercase tracking-wide">Rilisan
                                Penulis</span>
                            <div
                                class="w-10 h-5 bg-brand-primary rounded-full relative shadow-sm cursor-pointer transition-transform ease-out group-hover:scale-110">
                                <span class="absolute right-1 top-1 bg-white w-3 h-3 rounded-full"></span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wide">Ringkasan
                                Harian</span>
                            <div class="w-10 h-5 bg-gray-200 rounded-full relative cursor-pointer"><span
                                    class="absolute left-1 top-1 bg-white w-3 h-3 rounded-full"></span></div>
                        </div>
                        <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                            <span class="text-xs font-bold text-brand-dark uppercase tracking-wide">Buku Baru
                                Rilis</span>
                            <div
                                class="w-10 h-5 bg-brand-primary rounded-full relative shadow-sm cursor-pointer transition-transform ease-out group-hover:scale-110 delay-75">
                                <span class="absolute right-1 top-1 bg-white w-3 h-3 rounded-full"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="reveal reveal-delay-200 bg-white rounded-3xl p-8 border border-gray-200 shadow-sm group hover:shadow-xl hover:-translate-y-1 transition-all duration-500">
                    <h3 class="text-xl font-bold text-brand-dark mb-2">Koleksi Tersimpan via Firebase</h3>
                    <p class="text-sm font-medium text-gray-500 mb-8 leading-relaxed">Simpan buku favorit ke cloud
                        dengan satu klik. Tersinkronisasi otomatis di semua perangkat Anda.</p>
                    <div class="space-y-4">
                        <div
                            class="bg-gray-50 p-4 rounded-xl flex items-start space-x-4 border border-gray-100 transition-colors group-hover:bg-brand-surface">
                            <div
                                class="w-8 h-8 bg-brand-lime rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-brand-dark">Brian Khrisna</h4>
                                <p class="text-xs text-gray-500 mt-1">Tersimpan ke Firestore ✓</p>
                            </div>
                        </div>
                        <div
                            class="bg-gray-50 p-4 rounded-xl flex items-start space-x-4 border border-gray-100 transition-colors group-hover:bg-brand-surface">
                            <div
                                class="w-8 h-8 bg-indigo-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                            </div>
                            <div class="w-full">
                                <div class="flex justify-between items-center">
                                    <h4 class="text-sm font-bold text-brand-dark">Tere Liye</h4>
                                    <span class="text-[10px] font-bold text-brand-lime">🔥 Real-time</span>
                                </div>
                                <div class="w-full bg-gray-200 h-1.5 rounded-full mt-3 overflow-hidden">
                                    <div
                                        class="w-3/4 bg-brand-primary h-full origin-left transform transition-transform duration-1000 scale-x-0 group-hover:scale-x-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== ABOUT US SECTION ===== -->
    <section id="tentang" class="py-28 bg-white relative overflow-hidden">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left: Text -->
                <div class="reveal">
                    <span class="text-xs font-bold uppercase tracking-widest text-brand-lime mb-4 block">Tentang
                        Kami</span>
                    <h2 class="text-4xl md:text-5xl font-extrabold text-brand-dark tracking-tight leading-tight mb-6">
                        Dibangun oleh pecinta buku, untuk pecinta buku.
                    </h2>
                    <p class="text-gray-500 font-medium leading-relaxed mb-6">
                        BOOKAGO lahir dari keprihatinan terhadap rendahnya minat baca di Indonesia.
                        Kami percaya bahwa akses terhadap literatur berkualitas seharusnya tidak dibatasi oleh biaya
                        atau lokasi.
                    </p>
                    <p class="text-gray-500 font-medium leading-relaxed mb-8">
                        Dengan teknologi modern seperti <strong class="text-brand-dark">Laravel</strong>, <strong
                            class="text-brand-dark">Firebase</strong>,
                        dan <strong class="text-brand-dark">Google Books API</strong>, kami membangun platform yang
                        tidak hanya cantik, tetapi juga
                        fungsional dan dapat diandalkan oleh komunitas literasi Indonesia.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <span
                            class="text-xs font-bold bg-brand-surface text-brand-primary px-4 py-2 rounded-full border border-gray-100">🇮🇩
                            Buatan Indonesia</span>
                        <span
                            class="text-xs font-bold bg-brand-surface text-brand-primary px-4 py-2 rounded-full border border-gray-100">🔓
                            Open Source</span>
                        <span
                            class="text-xs font-bold bg-brand-surface text-brand-primary px-4 py-2 rounded-full border border-gray-100">☁️
                            Cloud-Native</span>
                        <span
                            class="text-xs font-bold bg-brand-surface text-brand-primary px-4 py-2 rounded-full border border-gray-100">🔥
                            Firebase Powered</span>
                    </div>
                </div>

                <!-- Right: Stats Card -->
                <div class="reveal reveal-delay-200">
                    <div class="bg-brand-dark rounded-[2rem] p-10 text-white relative overflow-hidden shadow-2xl">
                        <div
                            class="absolute top-0 right-0 w-64 h-64 bg-brand-lime opacity-10 rounded-full blur-3xl -translate-y-20 translate-x-20">
                        </div>
                        <h3 class="text-lg font-bold text-brand-lime mb-8 uppercase tracking-widest text-[11px]">Dalam
                            Angka</h3>
                        <div class="space-y-8 relative z-10">
                            <div class="flex items-baseline justify-between border-b border-gray-700 pb-6">
                                <span class="text-gray-400 font-medium text-sm">Platform Didirikan</span>
                                <span class="text-4xl font-extrabold">2026</span>
                            </div>
                            <div class="flex items-baseline justify-between border-b border-gray-700 pb-6">
                                <span class="text-gray-400 font-medium text-sm">Judul Buku Tersedia</span>
                                <span class="text-4xl font-extrabold">50K<span
                                        class="text-brand-lime text-lg">+</span></span>
                            </div>
                            <div class="flex items-baseline justify-between border-b border-gray-700 pb-6">
                                <span class="text-gray-400 font-medium text-sm">Pengguna Aktif</span>
                                <span class="text-4xl font-extrabold">12K<span
                                        class="text-brand-lime text-lg">+</span></span>
                            </div>
                            <div class="flex items-baseline justify-between">
                                <span class="text-gray-400 font-medium text-sm">Perguruan Tinggi</span>
                                <span class="text-4xl font-extrabold">40<span
                                        class="text-brand-lime text-lg">+</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SUPPORT / SAWERIA SECTION ===== -->
    <section id="dukung" class="py-28 bg-brand-surface relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <div class="reveal">
                <span class="text-xs font-bold uppercase tracking-widest text-brand-lime mb-4 block">Dukung Kami</span>
                <h2 class="text-4xl md:text-5xl font-extrabold text-brand-dark tracking-tight leading-tight mb-6">
                    Bantu BOOKAGO tetap hidup ❤️
                </h2>
                <p class="text-gray-500 font-medium max-w-2xl mx-auto leading-relaxed mb-12">
                    BOOKAGO adalah proyek open-source yang dikelola secara sukarela.
                    Setiap dukungan Anda — sekecil apapun — membantu kami membayar server, membeli domain,
                    dan terus mengembangkan fitur baru untuk komunitas literasi Indonesia.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <!-- Saweria -->
                <a href="https://saweria.co/JekiMiau" target="_blank" rel="noopener noreferrer"
                    class="reveal group bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500 block text-left">
                    <div
                        class="w-14 h-14 bg-orange-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-orange-500 group-hover:scale-110 transition-all duration-300">
                        <span class="text-2xl">🧡</span>
                    </div>
                    <h3 class="text-xl font-bold text-brand-dark mb-2">Saweria</h3>
                    <p class="text-sm text-gray-500 font-medium leading-relaxed mb-4">Donasi via Saweria untuk mendukung
                        pengembangan BOOKAGO.</p>
                    <span class="text-sm font-bold text-orange-500 group-hover:underline">saweria.co/JekiMiau
                        &rarr;</span>
                </a>

                <!-- GitHub Sponsor -->
                <a href="https://github.com/Jeki-Miau" target="_blank" rel="noopener noreferrer"
                    class="reveal reveal-delay-100 group bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500 block text-left">
                    <div
                        class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-800 group-hover:scale-110 transition-all duration-300">
                        <svg class="w-7 h-7 text-gray-800 group-hover:text-white transition" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-brand-dark mb-2">GitHub</h3>
                    <p class="text-sm text-gray-500 font-medium leading-relaxed mb-4">Star repo kami di GitHub atau
                        kontribusi langsung ke kode sumber.</p>
                    <span class="text-sm font-bold text-gray-800 group-hover:underline">github.com/Jeki-Miau
                        &rarr;</span>
                </a>

                <!-- Share -->
                <div
                    class="reveal reveal-delay-200 group bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500 text-left">
                    <div
                        class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-500 group-hover:scale-110 transition-all duration-300">
                        <svg class="w-7 h-7 text-blue-500 group-hover:text-white transition" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-brand-dark mb-2">Sebarkan</h3>
                    <p class="text-sm text-gray-500 font-medium leading-relaxed mb-4">Bagikan BOOKAGO ke teman,
                        keluarga, atau komunitas literasi Anda.</p>
                    <span class="text-sm font-bold text-blue-500">Gratis & berdampak besar ✨</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section id="testimoni" class="max-w-4xl mx-auto px-6 py-24 text-center">
        <svg class="reveal mx-auto w-10 h-10 text-brand-lime opacity-80 mb-6" fill="currentColor" viewBox="0 0 24 24">
            <path
                d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z">
            </path>
        </svg>

        <h3
            class="reveal reveal-delay-100 text-2xl md:text-3xl font-bold text-brand-dark italic mb-8 max-w-3xl mx-auto leading-relaxed">
            "Hal yang menakjubkan tentang sastra hebat adalah bahwa sastra tersebut mengubah orang yang membacanya
            menjadi seperti kondisi orang yang menulisnya."
        </h3>

        <div class="reveal reveal-delay-200 flex items-center justify-center space-x-2">
            <div class="flex -space-x-2 group cursor-pointer">
                <img class="w-10 h-10 rounded-full border-2 border-white shadow-sm transform group-hover:-translate-y-2 group-hover:-translate-x-2 group-hover:scale-110 transition-all duration-300 z-10 group-hover:z-30"
                    src="https://ui-avatars.com/api/?name=E.M. Forster&background=f8fafc" alt="CEO">
                <img class="w-10 h-10 rounded-full border-2 border-white shadow-sm transform group-hover:-translate-y-2 group-hover:translate-x-2 group-hover:scale-110 transition-all duration-300 z-20"
                    src="https://ui-avatars.com/api/?name=Staf&background=0f172a&color=fff" alt="CTO">
            </div>
            <div class="ml-4 text-left">
                <p class="text-sm font-bold text-brand-dark">E.M. Forster</p>
                <p class="text-[10px] font-bold uppercase tracking-wider text-gray-500">novelis, esais, dan penulis
                    cerita pendek Inggris yang terkenal
                </p>
            </div>
        </div>
    </section>

    <!-- Bottom Deep Navy CTA -->
    <section class="reveal bg-brand-primary mt-12 py-24 px-6 relative overflow-hidden">
        <div
            class="absolute top-0 right-0 -m-16 w-64 h-64 bg-brand-lime opacity-10 rounded-full blur-3xl pointer-events-none">
        </div>
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-10 relative z-10">
            <h2 class="text-3xl md:text-5xl font-extrabold text-white max-w-lg leading-tight tracking-tight">
                Gali kapabilitas absolut dari fungsi bawaan <span class="underline-highlight text-white">BOOKAGO</span>
            </h2>
            <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="<?php echo e(route('register')); ?>"
                    class="w-full sm:w-auto px-10 py-4 bg-white text-brand-primary text-sm font-bold rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 active:scale-95">Mulai
                    Sekarang</a>
                <a href="#fitur"
                    class="w-full sm:w-auto px-10 py-4 bg-brand-lime text-brand-primary text-sm font-bold rounded-full shadow-lg hover:shadow-brand-lime/30 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105 active:scale-95">Pelajari
                    Lebih Jauh</a>
            </div>
        </div>
    </section>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcb8170ac00b272413fe5b25f86fc5e3a)): ?>
<?php $attributes = $__attributesOriginalcb8170ac00b272413fe5b25f86fc5e3a; ?>
<?php unset($__attributesOriginalcb8170ac00b272413fe5b25f86fc5e3a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcb8170ac00b272413fe5b25f86fc5e3a)): ?>
<?php $component = $__componentOriginalcb8170ac00b272413fe5b25f86fc5e3a; ?>
<?php unset($__componentOriginalcb8170ac00b272413fe5b25f86fc5e3a); ?>
<?php endif; ?><?php /**PATH C:\Users\Jeki\Herd\bookago\resources\views/welcome.blade.php ENDPATH**/ ?>