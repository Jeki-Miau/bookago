<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title' => 'Admin Panel - BOOKAGO']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['title' => 'Admin Panel - BOOKAGO']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .stat-card {
            animation: fade-in-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
        }
        
        .stat-card:nth-child(1) { animation-delay: 100ms; }
        .stat-card:nth-child(2) { animation-delay: 200ms; }
        .stat-card:nth-child(3) { animation-delay: 300ms; }
        .stat-card:nth-child(4) { animation-delay: 400ms; }
        .stat-card:nth-child(5) { animation-delay: 500ms; }
        .stat-card:nth-child(6) { animation-delay: 600ms; }

        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .hover-lift {
            transition: all 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.15);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, var(--color-brand-lime, #3b82f6) 0%, var(--color-brand-primary, #0f172a) 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
        
        .icon-bg {
            transition: all 0.3s ease;
        }
        
        .stat-card:hover .icon-bg {
            transform: scale(1.1) rotate(5deg);
        }
        
        @media (min-width: 768px) {
            .md-sidebar-fixed {
                position: fixed !important;
                top: 4rem !important; /* height of navbar */
                height: calc(100vh - 4rem) !important;
                flex-shrink: 0 !important;
            }
            .md-sidebar-margin {
                margin-left: 16rem !important;
            }
        }
    </style>
</head>
<body class="bg-brand-surface">
    <div class="min-h-screen flex flex-col items-stretch" x-data="{ sidebarOpen: false }">
        <!-- Top Navigation -->
        <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- Mobile Hamburger -->
                        <button @click="sidebarOpen = !sidebarOpen" class="md:hidden mr-2 p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    
                        <a href="<?php echo e(route('landing')); ?>" class="flex items-center space-x-2 group shrink-0">
                            <div class="w-8 h-8 rounded-md bg-brand-lime flex items-center justify-center shadow-sm group-hover:scale-105 transition">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                </svg>
                            </div>
                            <span class="text-lg sm:text-xl font-black text-brand-dark group-hover:text-brand-lime transition hidden sm:block">BOOKAGO</span>
                        </a>
                        <span class="ml-2 sm:ml-4 text-xs sm:text-sm font-bold text-gray-500 bg-gray-100 px-2 sm:px-3 py-1 rounded-full whitespace-nowrap">Admin <span class="hidden sm:inline">Panel</span></span>
                    </div>
                    
                    <div class="flex items-center space-x-2 sm:space-x-4">
                        <div class="hidden md:flex items-center space-x-4 mr-2">
                            <a href="<?php echo e(route('landing')); ?>" class="text-sm text-gray-600 hover:text-brand-lime font-semibold transition">Landing</a>
                            <a href="<?php echo e(route('home')); ?>" class="text-sm text-gray-600 hover:text-brand-lime font-semibold transition">Katalog</a>
                        </div>
                        <div class="flex items-center space-x-2 bg-gray-50 px-2 sm:px-3 py-1.5 rounded-full shrink-0">
                            <img class="w-7 h-7 sm:w-8 sm:h-8 rounded-full border-2 border-brand-lime shadow-sm" src="<?php echo e(auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=0f172a&color=fff'); ?>" alt="">
                            <span class="text-sm font-bold text-brand-dark hidden sm:block"><?php echo e(auth()->user()->name ?? 'Admin'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar & Content flex container -->
        <div class="flex flex-1 relative">
            
            <!-- Mobile overlay -->
            <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-50 z-30 md:hidden" @click="sidebarOpen = false"></div>

            <!-- Sidebar -->
            <div :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" class="w-64 bg-white shadow-sm border-r border-gray-200 md-sidebar-fixed fixed top-0 inset-y-0 left-0 h-screen overflow-y-auto z-40 transition-transform duration-300 md:translate-x-0">
                <div class="md:hidden flex items-center justify-center h-16 border-b border-gray-200">
                    <span class="text-xl font-black text-brand-dark">BOOKAGO ADMIN</span>
                </div>
                <nav class="mt-6 px-4 space-y-1">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center px-4 py-3 rounded-xl transition <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-brand-lime/10 text-brand-lime font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-brand-dark'); ?>">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        Dashboard
                    </a>
                    <a href="<?php echo e(route('admin.announcements')); ?>" class="flex items-center px-4 py-3 rounded-xl transition <?php echo e(request()->routeIs('admin.announcements*') ? 'bg-brand-lime/10 text-brand-lime font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-brand-dark'); ?>">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                        Pengumuman
                    </a>
                    <a href="<?php echo e(route('admin.messages')); ?>" class="flex items-center px-4 py-3 rounded-xl transition <?php echo e(request()->routeIs('admin.messages*') ? 'bg-brand-lime/10 text-brand-lime font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-brand-dark'); ?>">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Pesan Masuk
                    </a>
                    <a href="<?php echo e(route('admin.warnings')); ?>" class="flex items-center px-4 py-3 rounded-xl transition <?php echo e(request()->routeIs('admin.warnings*') ? 'bg-brand-lime/10 text-brand-lime font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-brand-dark'); ?>">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        Peringatan
                    </a>
                    <a href="<?php echo e(route('admin.users')); ?>" class="flex items-center px-4 py-3 rounded-xl transition <?php echo e(request()->routeIs('admin.users*') ? 'bg-brand-lime/10 text-brand-lime font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-brand-dark'); ?>">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Users
                    </a>
                    <a href="<?php echo e(route('admin.discussions')); ?>" class="flex items-center px-4 py-3 rounded-xl transition <?php echo e(request()->routeIs('admin.discussions*') ? 'bg-brand-lime/10 text-brand-lime font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-brand-dark'); ?>">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                        </svg>
                        Discussions
                    </a>
                    <a href="<?php echo e(route('forum.index')); ?>" class="flex items-center px-4 py-3 rounded-xl transition text-gray-600 hover:bg-gray-50 hover:text-brand-dark mt-4 border-t border-gray-100 pt-4">
                         <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                         </svg>
                        Pusat Forum
                    </a>
                </nav>
            </div>

            <!-- Main Content Container -->
            <div class="flex-1 p-4 sm:p-8 overflow-x-hidden w-full md-sidebar-margin">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                <div x-data="{ show: true }" x-show="show" x-transition class="mb-6 bg-brand-lime/10 border border-brand-lime/30 text-brand-lime px-4 py-3 rounded-xl font-semibold flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <?php echo e(session('success')); ?>

                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
                <div x-data="{ show: true }" x-show="show" x-transition class="mb-6 bg-red-100 border border-red-300 text-red-600 px-4 py-3 rounded-xl font-semibold flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <?php echo e(session('error')); ?>

                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php echo e($slot); ?>

            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\Jeki\Herd\bookago\resources\views/components/admin-layout.blade.php ENDPATH**/ ?>