<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 flex flex-col z-40 transform md:translate-x-0 transition-transform duration-300 shadow-sm">
    <!-- Header -->
    <div class="h-16 flex items-center px-6 border-b border-gray-100">
        <!-- Simple Logo -->
        <a href="/" class="flex items-center space-x-2 px-2 group">
            <div
                class="w-8 h-8 rounded-md bg-brand-lime flex items-center justify-center transform group-hover:scale-105 transition shadow-sm">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                    <path fill-rule="evenodd"
                        d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <span
                class="text-xl font-black tracking-tight text-brand-dark group-hover:text-brand-lime transition">BOOKAGO</span>
        </a>
    </div>

    <!-- Navigation Area -->
    <nav class="flex-1 overflow-y-auto py-6 px-4">
        <ul>
            <li class="mb-6 border-b border-gray-100 pb-4">
                <a href="<?php echo e(route('landing')); ?>"
                    class="flex items-center px-3 py-2.5 rounded-xl text-gray-700 bg-gray-50 border border-gray-200 hover:bg-gray-100 hover:text-brand-lime font-bold shadow-sm transition">
                    <svg class="w-5 h-5 mr-3 text-brand-lime" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Halaman Utama (Landing)
                </a>
            </li>

            <li class="mb-2">
                <p class="px-3 text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Koleksi Saya</p>
                <a href="<?php echo e(route('home')); ?>"
                    class="flex items-center px-3 py-2.5 rounded-xl transition <?php echo e(request()->routeIs('home') ? 'text-brand-lime bg-gray-50 font-bold shadow-sm border border-gray-100' : 'text-gray-500 hover:text-brand-dark hover:bg-gray-50 font-semibold'); ?>">
                    <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                    Katalog Buku
                </a>
                <a href="<?php echo e(route('books.saved')); ?>" x-data="{
                        count: 0,
                        init() {
                            const userId = <?php echo e(auth()->id() ?? 0); ?>;
                            if (userId && window.firebaseHelpers) {
                                window.firebaseHelpers.onSavedBooksChange(userId, (books) => {
                                    this.count = books.length;
                                });
                            }
                        }
                    }"
                    class="flex items-center px-3 py-2.5 mt-1 rounded-xl transition <?php echo e(request()->routeIs('books.saved') ? 'text-brand-lime bg-gray-50 font-bold shadow-sm border border-gray-100' : 'text-gray-500 hover:text-brand-dark hover:bg-gray-50 font-semibold'); ?>">
                    <svg class="w-5 h-5 mr-3 <?php echo e(request()->routeIs('books.saved') ? 'text-brand-lime' : 'text-gray-400'); ?>"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                    </svg>
                    Tersimpan
                    <span x-show="count > 0" x-text="count" x-transition
                        class="ml-auto text-[10px] font-black bg-brand-lime text-white w-5 h-5 rounded-full flex items-center justify-center"></span>
                </a>
            </li>



            <li class="mt-8 mb-2">
                <p class="px-3 text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Kategori Utama</p>
                <div class="space-y-1">
                    <a href="<?php echo e(route('home', ['category' => 'Fiksi'])); ?>"
                        class="flex items-center px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-500 hover:text-brand-dark hover:bg-gray-50 transition"><span
                            class="w-2 h-2 rounded-full bg-blue-500 mr-3"></span>Fiksi</a>
                    <a href="<?php echo e(route('home', ['category' => 'Sains'])); ?>"
                        class="flex items-center px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-500 hover:text-brand-dark hover:bg-gray-50 transition"><span
                            class="w-2 h-2 rounded-full bg-purple-500 mr-3"></span>Sains &amp; Teknik</a>
                    <a href="<?php echo e(route('home', ['category' => 'Sejarah'])); ?>"
                        class="flex items-center px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-500 hover:text-brand-dark hover:bg-gray-50 transition"><span
                            class="w-2 h-2 rounded-full bg-yellow-500 mr-3"></span>Sejarah</a>
                    <a href="<?php echo e(route('home', ['category' => 'Biografi'])); ?>"
                        class="flex items-center px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-500 hover:text-brand-dark hover:bg-gray-50 transition"><span
                            class="w-2 h-2 rounded-full bg-brand-lime mr-3"></span>Biografi</a>
                </div>
            </li>

            <li class="mt-8 mb-2">
                <p class="px-3 text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Komunitas</p>
                <div class="space-y-1">
                    <a href="<?php echo e(route('forum.index')); ?>"
                        class="flex items-center px-3 py-2.5 rounded-xl text-sm transition group <?php echo e(request()->routeIs('forum.*') ? 'text-brand-lime bg-gray-50 font-bold shadow-sm border border-gray-100' : 'font-semibold text-gray-500 hover:text-brand-dark hover:bg-gray-50'); ?>">
                        <svg class="w-5 h-5 mr-3 <?php echo e(request()->routeIs('forum.*') ? 'text-brand-lime' : 'text-gray-400 group-hover:text-blue-500'); ?>"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                        </svg>
                        Forum Diskusi
                    </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!Auth::user()->is_admin): ?>
                    <a href="<?php echo e(route('contact.admin')); ?>"
                        class="flex items-center px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-500 hover:text-brand-dark hover:bg-gray-50 transition group">
                        <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-brand-primary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Hubungi Admin
                    </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </li>

            <?php
                $activeAnnouncements = \App\Models\Announcement::where('is_active', true)->latest()->take(3)->get();
            ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeAnnouncements->count() > 0): ?>
            <li class="mt-8 mb-2">
                <p class="px-3 text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Pengumuman</p>
                <div class="space-y-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $activeAnnouncements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="px-3 py-2.5 rounded-xl bg-yellow-50 border border-yellow-100">
                        <p class="text-xs font-bold text-yellow-800 line-clamp-1"><?php echo e($announcement->title); ?></p>
                        <p class="text-[10px] text-yellow-600 mt-1 line-clamp-2"><?php echo e($announcement->content); ?></p>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </li>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </ul>

        <!-- Dukung Kami Widget -->
        <div class="mt-8 mb-4 mx-2">
            <div
                class="relative bg-white border border-brand-primary/10 rounded-2xl p-5 overflow-hidden shadow-sm group hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                <!-- Decorative background elements -->
                <div
                    class="absolute -top-6 -right-6 w-24 h-24 bg-brand-lime/10 rounded-full blur-xl group-hover:bg-brand-primary/10 transition-colors">
                </div>
                <div class="absolute bottom-0 right-0 w-16 h-16 bg-brand-primary/5 rounded-tl-full blur-lg"></div>

                <div class="relative z-10 flex flex-col items-center text-center">
                    <div
                        class="w-10 h-10 bg-brand-surface text-brand-primary rounded-full flex items-center justify-center mb-3 group-hover:scale-110 group-hover:bg-brand-primary group-hover:text-white transition-all duration-300 shadow-sm">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h4 class="text-brand-dark font-extrabold text-sm mb-1">Dukung BOOKAGO</h4>
                    <p class="text-gray-500 text-[10px] font-medium leading-relaxed mb-4">
                        Bantu kami terus mengembangkan perpustakaan digital gratis untuk semua orang.
                    </p>
                    <a href="<?php echo e(route('landing')); ?>#dukung"
                        class="block w-full bg-brand-dark text-white text-xs font-bold py-2.5 rounded-lg hover:bg-brand-primary transition-colors shadow-sm">
                        💛 Beri Dukungan
                    </a>
                </div>
            </div>
        </div>
    </nav>
</aside><?php /**PATH C:\Users\Jeki\Herd\bookago\resources\views/components/sidebar.blade.php ENDPATH**/ ?>