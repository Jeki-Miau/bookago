<x-admin-layout title="Edit Pengumuman - Admin">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Pengumuman</h1>

                    <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST" class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul</label>
                            <input type="text" name="title" value="{{ $announcement->title }}" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Konten</label>
                            <textarea name="content" rows="6" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition">{{ $announcement->content }}</textarea>
                        </div>
                        <div class="flex gap-3">
                            <button type="submit" class="bg-green-500 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-green-600 transition">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.announcements') }}" class="px-6 py-2.5 border border-gray-200 rounded-lg font-semibold text-gray-600 hover:bg-gray-50 transition">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
</x-admin-layout>