<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran - {{ config('app.name', 'BOOKAGO') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

    <!-- Right Split: Registration Form (Reverse of Login) -->
    <div
        class="w-full lg:w-1/2 flex flex-col items-center justify-center p-8 sm:p-16 xl:p-24 relative bg-white z-10 order-1 lg:order-2">

        <div class="absolute top-8 right-8 animate-fade-in-left">
            <a href="/" class="flex items-center space-x-2 group">
                <span class="text-xl font-black tracking-tight text-brand-dark">BOOKAGO</span>
                <div
                    class="w-8 h-8 rounded-md bg-brand-primary flex items-center justify-center transform group-hover:scale-105 transition">
                    <svg class="w-5 h-5 text-brand-lime" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                        <path fill-rule="evenodd"
                            d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </a>
        </div>

        <div class="w-full max-w-sm mt-12">
            <div class="animate-fade-in-up">
                <h1 class="text-3xl font-extrabold tracking-tight text-brand-dark mb-2">Buat akun baru</h1>
                <p class="text-sm text-gray-500 font-medium mb-10">Mulai bangun dan atur perpustakaan digital perdana
                    Anda hari ini, sepenuhnya gratis.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                @if ($errors->any())
                    <div class="p-4 rounded-xl bg-red-50 border border-red-100 text-red-600 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-1 animate-fade-in-up animation-delay-100">
                    <label for="name" class="block text-xs font-bold text-gray-700 uppercase tracking-widest pl-1">Nama
                        Lengkap</label>
                    <input id="name" name="name" type="text" autocomplete="name" required
                        class="w-full px-5 py-3.5 bg-brand-surface border border-gray-200 rounded-xl text-brand-dark hover:border-brand-lime focus:outline-none focus:ring-2 focus:ring-brand-lime/50 focus:border-brand-lime transition-all duration-300 placeholder-gray-400 font-medium text-sm"
                        placeholder="John Doe">
                </div>

                <div class="space-y-1 animate-fade-in-up animation-delay-200">
                    <label for="email"
                        class="block text-xs font-bold text-gray-700 uppercase tracking-widest pl-1">Alamat
                        Surel</label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                        class="w-full px-5 py-3.5 bg-brand-surface border border-gray-200 rounded-xl text-brand-dark hover:border-brand-lime focus:outline-none focus:ring-2 focus:ring-brand-lime/50 focus:border-brand-lime transition-all duration-300 placeholder-gray-400 font-medium text-sm"
                        placeholder="anda@email.com">
                </div>

                <div class="space-y-1 animate-fade-in-up animation-delay-300">
                    <label for="password"
                        class="block text-xs font-bold text-gray-700 uppercase tracking-widest pl-1">Kata Sandi</label>
                    <input id="password" name="password" type="password" required
                        class="w-full px-5 py-3.5 bg-brand-surface border border-gray-200 rounded-xl text-brand-dark hover:border-brand-lime focus:outline-none focus:ring-2 focus:ring-brand-lime/50 focus:border-brand-lime transition-all duration-300 placeholder-gray-400 font-medium text-sm"
                        placeholder="Minimal 8 karakter">
                </div>

                <div class="animate-fade-in-up animation-delay-400">
                    <button type="submit"
                        class="w-full py-4 px-4 bg-brand-primary hover:opacity-90 text-white font-bold rounded-xl shadow-lg shadow-brand-primary/20 transition-all transform hover:-translate-y-0.5 mt-6 hover:scale-[1.02] active:scale-95">
                        Mulai Sekarang
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
                            Daftar Dengan</span>
                    </div>
                </div>

                <a href="{{ route('auth.google') }}"
                    class="group flex items-center justify-center w-full py-3.5 px-4 bg-white hover:bg-gray-50 border border-gray-200 text-brand-dark font-bold rounded-xl transition-all duration-300 shadow-sm transform hover:-translate-y-0.5 hover:shadow-md hover:border-gray-300 active:scale-95">
                    <svg class="h-5 w-5 mr-3 transform group-hover:scale-110 transition-transform duration-300"
                        viewBox="0 0 48 48">
                        <path fill="#FFC107"
                            d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z" />
                        <path fill="#FF3D00"
                            d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z" />
                        <path fill="#4CAF50"
                            d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.519-3.119-11.166-7.514l-6.529,5.034C9.539,39.675,16.215,44,24,44z" />
                        <path fill="#1976D2"
                            d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z" />
                    </svg>
                    Sign up with Google
                </a>
            </div>

            <p class="mt-8 text-center text-sm text-gray-500 font-medium animate-fade-in-up animation-delay-500">
                Sudah memiliki akun?
                <a href="{{ route('login') }}"
                    class="font-bold text-brand-dark hover:text-brand-lime transition-all duration-300 hover:underline">Masuk
                    di sini</a>
            </p>
        </div>
    </div>

    <!-- Left Split: Deep Navy Infographic -->
    <div
        class="hidden lg:flex lg:w-1/2 bg-brand-primary relative flex-col justify-between p-16 overflow-hidden order-2 lg:order-1 border-r border-brand-dark shadow-2xl">
        <div class="absolute inset-0 bg-brand-dark opacity-30 mix-blend-multiply pointer-events-none"></div>
        <div
            class="absolute top-1/2 left-0 w-96 h-96 bg-brand-lime/20 blur-3xl rounded-full pointer-events-none transform -translate-y-1/2 -translate-x-1/2 animate-pulse-slow">
        </div>

        <div class="relative z-10 w-full max-w-lg mx-auto animate-fade-in-right">
            <div
                class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center border border-white/20 mb-10 shadow-xl animate-float animation-delay-100 hover:bg-white/20 transition-all duration-300">
                <svg class="w-8 h-8 text-brand-lime animate-pulse-slow" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>

            <h2 class="text-4xl font-extrabold text-white leading-tight mb-8">Manajemen agenda membaca kini sepenuhnya
                otomatis.</h2>

            <div class="space-y-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <svg class="h-6 w-6 text-brand-lime" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <p class="ml-4 text-gray-300">Sinkronisasi metadata buku secara instan via API pihak ketiga,
                        termasuk Google Books.</p>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        <svg class="h-6 w-6 text-brand-lime" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <p class="ml-4 text-gray-300">Akses koleksi perpustakaan universitas Anda dari pelbagai jenis media
                        di manapun berada.</p>
                </div>
            </div>
        </div>

        <div
            class="relative z-10 mt-auto pt-16 flex items-center justify-between text-sm text-gray-500 w-full border-t border-white/10">
            <p>© {{ date('Y') }} BOOKAGO Nusantara.</p>
            <div class="flex space-x-6">
                <a href="#" class="hover:text-white transition">Persyaratan</a>
            </div>
        </div>
    </div>

</body>

</html>