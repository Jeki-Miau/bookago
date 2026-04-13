<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - <?php echo e(config('app.name', 'BOOKAGO')); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body
    class="bg-white text-brand-dark font-sans antialiased min-h-screen flex selection:bg-brand-lime selection:text-white">

    <!-- Left Split: Authentication Form -->
    <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-8 sm:p-16 xl:p-24 relative bg-white z-10">

        <div class="absolute top-8 left-8 animate-fade-in-right">
            <a href="/" class="flex items-center space-x-2 group">
                <div
                    class="w-8 h-8 rounded-md bg-brand-primary flex items-center justify-center transform group-hover:scale-105 transition">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                        <path fill-rule="evenodd"
                            d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-xl font-black tracking-tight text-brand-dark">
                    BOOKAGO
                </span>
            </a>
        </div>

        <div class="w-full max-w-sm mt-12">
            <div class="animate-fade-in-up">
                <h1 class="text-3xl font-extrabold tracking-tight text-brand-dark mb-2">Selamat datang kembali</h1>
                <p class="text-sm text-gray-500 font-medium mb-10">Silakan masukkan kredensial Anda untuk mengakses
                    perpustakaan cerdas Anda.</p>
            </div>

            <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-6">
                <?php echo csrf_field(); ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                    <div class="p-4 rounded-xl bg-red-50 border border-red-100 text-red-600 text-sm">
                        <ul class="list-disc list-inside">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <li><?php echo e($error); ?></li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="space-y-1 animate-fade-in-up animation-delay-100">
                    <label for="email"
                        class="block text-xs font-bold text-gray-700 uppercase tracking-widest pl-1">Alamat
                        Surel</label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                        class="w-full px-5 py-3.5 bg-brand-surface border border-gray-200 rounded-xl text-brand-dark hover:border-brand-lime focus:outline-none focus:ring-2 focus:ring-brand-lime/50 focus:border-brand-lime transition-all duration-300 placeholder-gray-400 font-medium text-sm"
                        placeholder="anda@email.com">
                </div>

                <div class="space-y-1 animate-fade-in-up animation-delay-200">
                    <div class="flex items-center justify-between pl-1">
                        <label for="password"
                            class="block text-xs font-bold text-gray-700 uppercase tracking-widest">Kata Sandi</label>
                        <a href="#"
                            class="text-xs font-bold text-brand-lime hover:opacity-80 transition-all hover:underline">Lupa?</a>
                    </div>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="w-full px-5 py-3.5 bg-brand-surface border border-gray-200 rounded-xl text-brand-dark hover:border-brand-lime focus:outline-none focus:ring-2 focus:ring-brand-lime/50 focus:border-brand-lime transition-all duration-300 placeholder-gray-400 font-medium text-sm"
                        placeholder="••••••••">
                </div>

                <div class="flex items-center pl-1 animate-fade-in-up animation-delay-300">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4 w-4 bg-gray-50 border-gray-300 rounded text-brand-primary focus:ring-brand-primary focus:ring-offset-white transition-all">
                    <label for="remember" class="ml-2 block text-xs font-bold text-gray-500 cursor-pointer hover:text-brand-dark transition-colors">Ingat saya selama 30
                        hari</label>
                </div>

                <div class="animate-fade-in-up animation-delay-400">
                    <button type="submit"
                        class="w-full py-4 px-4 bg-brand-primary hover:opacity-90 text-white font-bold rounded-xl shadow-lg shadow-brand-primary/20 transition-all transform hover:-translate-y-0.5 mt-6 hover:scale-[1.02] active:scale-95">
                        Masuk ke Dasbor
                    </button>
                </div>
            </form>

            <div class="animate-fade-in-up animation-delay-500">
                <div class="mt-8 mb-6 relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 text-xs font-extrabold tracking-widest text-gray-400 uppercase bg-white">Atau
                            Masuk Dengan</span>
                    </div>
                </div>

                <a href="<?php echo e(route('auth.google')); ?>"
                    class="group flex items-center justify-center w-full py-3.5 px-4 bg-white hover:bg-gray-50 border border-gray-200 text-brand-dark font-bold rounded-xl transition-all duration-300 shadow-sm transform hover:-translate-y-0.5 hover:shadow-md hover:border-gray-300 active:scale-95">
                    <svg class="h-5 w-5 mr-3 transform group-hover:scale-110 transition-transform duration-300" viewBox="0 0 48 48">
                        <path fill="#FFC107"
                            d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z" />
                        <path fill="#FF3D00"
                            d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z" />
                        <path fill="#4CAF50"
                            d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.519-3.119-11.166-7.514l-6.529,5.034C9.539,39.675,16.215,44,24,44z" />
                        <path fill="#1976D2"
                            d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z" />
                    </svg>
                    Sign in with Google
                </a>
            </div>

            <p class="mt-8 text-center text-sm text-gray-500 font-medium animate-fade-in-up animation-delay-500">
                Belum memiliki akun?
                <a href="<?php echo e(route('register')); ?>"
                    class="font-bold text-brand-dark hover:text-brand-lime transition-all duration-300 hover:underline">
                    Daftar sekarang
                </a>
            </p>
        </div>
    </div>

    <!-- Right Split: Deep Navy Infographic -->
    <div class="hidden lg:flex lg:w-1/2 bg-brand-primary relative flex-col justify-between p-16 overflow-hidden">
        <div class="absolute inset-0 bg-brand-dark opacity-40 mix-blend-multiply pointer-events-none"></div>
        <div
            class="absolute -top-32 -right-32 w-96 h-96 bg-brand-lime opacity-20 blur-3xl rounded-full pointer-events-none animate-pulse-slow">
        </div>

        <div class="relative z-10 w-full max-w-lg mx-auto mt-24 animate-fade-in-left">
            <h2 class="text-4xl font-extrabold text-white leading-tight mb-6">"Pusat Komando untuk setiap Mahakarya
                Literasi."</h2>
            <p class="text-lg text-gray-400 mb-12">Bergabunglah dengan lebih dari 50,000 cendekiawan dan universitas
                kelas dunia dalam mendigitalisasi setiap katalog, catatan, dan riset Anda ke dalam satu platform
                BOOKAGO.</p>

            <!-- Floating Mini Card Mockups to replicate Enterprise SaaS vibes -->
            <div
                class="space-y-4 transform -rotate-3 hover:translate-x-2 transition-transform duration-700 cursor-pointer animate-float animation-delay-200">
                <div
                    class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 flex items-center justify-between shadow-2xl hover:bg-white/20 transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-brand-lime flex items-center justify-center shadow-lg shadow-brand-lime/30">
                            <span class="text-white font-black">10k+</span>
                        </div>
                        <div>
                            <p class="text-white font-bold">Koleksi Tesis 2024</p>
                            <p class="text-gray-400 text-xs">Sinkronisasi terakhir hari ini</p>
                        </div>
                    </div>
                    <span class="text-brand-lime text-xs font-bold uppercase tracking-wider animate-pulse-slow">Aktif</span>
                </div>
            </div>
        </div>

        <div
            class="relative z-10 mt-auto pt-16 flex items-center justify-between text-sm text-gray-500 w-full border-t border-white/10">
            <p>© <?php echo e(date('Y')); ?> BOOKAGO Nusantara.</p>
            <div class="flex space-x-6">
                <a href="#" class="hover:text-white transition">Bantuan</a>
                <a href="#" class="hover:text-white transition">Privasi</a>
            </div>
        </div>
    </div>

</body>

</html><?php /**PATH C:\Users\Jeki\Herd\bookago\resources\views/auth/login.blade.php ENDPATH**/ ?>