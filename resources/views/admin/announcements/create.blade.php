<x-admin-layout title="Buat Pengumuman - Admin">
                <div class="max-w-2xl mx-auto">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6">Buat Pengumuman Baru</h1>

                    <form action="{{ route('admin.announcements.store') }}" method="POST" class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                        @csrf
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
                            <a href="{{ route('admin.announcements') }}" class="px-6 py-2.5 border border-gray-200 rounded-lg font-semibold text-gray-600 hover:bg-gray-50 transition">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
</x-admin-layout>