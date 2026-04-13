<x-admin-layout title="Berikan Peringatan - Admin">
                <div class="max-w-2xl mx-auto">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6">Berikan Peringatan ke User</h1>

                    <form action="{{ route('admin.warnings.store') }}" method="POST" class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih User</label>
                            <select name="user_id" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition">
                                <option value="">-- Pilih User --</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alasan</label>
                            <input type="text" name="reason" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition" placeholder="Contoh: Spam, Ujaran Kebencian, dll">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="description" rows="4" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition" placeholder="Jelaskan detail peringatan..."></textarea>
                        </div>
                        <div class="flex gap-3">
                            <button type="submit" class="bg-red-500 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-red-600 transition">
                                Berikan Peringatan
                            </button>
                            <a href="{{ route('admin.warnings') }}" class="px-6 py-2.5 border border-gray-200 rounded-lg font-semibold text-gray-600 hover:bg-gray-50 transition">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
</x-admin-layout>