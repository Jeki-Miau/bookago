<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Admin - BOOKAGO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="max-w-xl w-full">
            <div class="text-center mb-8">
                <a href="{{ route('landing') }}" class="inline-flex items-center space-x-2 mb-4">
                    <div class="w-10 h-10 rounded-md bg-green-500 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                        </svg>
                    </div>
                    <span class="text-2xl font-black text-gray-800">BOOKAGO</span>
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Hubungi Admin</h1>
                <p class="text-gray-500 mt-2">Kirim pesan langsung ke admin BOOKAGO</p>
            </div>

            @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('contact.admin.send') }}" method="POST" class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Admin</label>
                    <select name="admin_id" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition">
                        <option value="">-- Pilih Admin --</option>
                        @foreach($admins as $admin)
                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Subjek</label>
                    <input type="text" name="subject" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" placeholder="Contoh: Pertanyaan tentang akun, Laporan masalah, dll">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pesan</label>
                    <textarea name="content" rows="5" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" placeholder="Tulis pesan Anda..."></textarea>
                </div>
                <button type="submit" class="w-full bg-green-500 text-white py-3 rounded-lg font-semibold hover:bg-green-600 transition">
                    Kirim Pesan
                </button>
            </form>

            <div class="text-center mt-6">
                <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-green-600">Kembali ke Katalog</a>
            </div>
        </div>
    </div>
</body>
</html>