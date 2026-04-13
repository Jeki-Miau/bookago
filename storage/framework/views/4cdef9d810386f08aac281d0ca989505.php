<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengumuman - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center space-x-2">
                            <div class="w-8 h-8 rounded-md bg-green-500 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                </svg>
                            </div>
                            <span class="text-xl font-black text-gray-800">BOOKAGO</span>
                        </a>
                        <span class="ml-4 text-sm font-bold text-gray-500">/ Buat Pengumuman</span>
                    </div>
                    <div class="flex items-center">
                        <a href="<?php echo e(route('admin.announcements')); ?>" class="text-sm text-gray-600 hover:text-green-600 mr-4">Kembali</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex">
            <div class="w-64 bg-white shadow-sm min-h-screen border-r border-gray-200">
                <nav class="mt-6 px-4">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center px-4 py-3 rounded-xl transition <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-green-50 text-green-600 font-semibold' : 'text-gray-600 hover:bg-gray-50'); ?>">
                        Dashboard
                    </a>
                    <a href="<?php echo e(route('admin.announcements')); ?>" class="flex items-center px-4 py-3 rounded-xl mt-2 transition <?php echo e(request()->routeIs('admin.announcements*') ? 'bg-green-50 text-green-600 font-semibold' : 'text-gray-600 hover:bg-gray-50'); ?>">
                        Pengumuman
                    </a>
                    <a href="<?php echo e(route('admin.messages')); ?>" class="flex items-center px-4 py-3 rounded-xl mt-2 transition <?php echo e(request()->routeIs('admin.messages*') ? 'bg-green-50 text-green-600 font-semibold' : 'text-gray-600 hover:bg-gray-50'); ?>">
                        Pesan Masuk
                    </a>
                    <a href="<?php echo e(route('admin.warnings')); ?>" class="flex items-center px-4 py-3 rounded-xl mt-2 transition <?php echo e(request()->routeIs('admin.warnings*') ? 'bg-green-50 text-green-600 font-semibold' : 'text-gray-600 hover:bg-gray-50'); ?>">
                        Peringatan
                    </a>
                    <a href="<?php echo e(route('admin.users')); ?>" class="flex items-center px-4 py-3 rounded-xl mt-2 transition <?php echo e(request()->routeIs('admin.users*') ? 'bg-green-50 text-green-600 font-semibold' : 'text-gray-600 hover:bg-gray-50'); ?>">
                        Users
                    </a>
                </nav>
            </div>

            <div class="flex-1 p-8">
                <div class="max-w-2xl mx-auto">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6">Buat Pengumuman Baru</h1>

                    <form action="<?php echo e(route('admin.announcements.store')); ?>" method="POST" class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                        <?php echo csrf_field(); ?>
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul</label>
                            <input type="text" name="title" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" placeholder="Judul pengumuman...">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Konten</label>
                            <textarea name="content" rows="6" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" placeholder="Isi pengumuman..."></textarea>
                        </div>
                        <div class="flex gap-3">
                            <button type="submit" class="bg-green-500 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-green-600 transition">
                                Buat Pengumuman
                            </button>
                            <a href="<?php echo e(route('admin.announcements')); ?>" class="px-6 py-2.5 border border-gray-200 rounded-lg font-semibold text-gray-600 hover:bg-gray-50 transition">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\Jeki\Herd\bookago\resources\views/admin/announcements/create.blade.php ENDPATH**/ ?>