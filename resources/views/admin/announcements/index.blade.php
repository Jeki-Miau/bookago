<x-admin-layout title="Kelola Pengumuman - Admin">

                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Kelola Pengumuman</h1>
                    <a href="{{ route('admin.announcements.create') }}" class="bg-green-500 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-green-600 transition">
                        + Buat Pengumuman
                    </a>
                </div>

                @if($announcements->count() > 0)
                    <div class="space-y-4">
                        @foreach($announcements as $announcement)
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <h3 class="text-lg font-bold text-gray-800">{{ $announcement->title }}</h3>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $announcement->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                            {{ $announcement->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-3">{{ $announcement->content }}</p>
                                    <p class="text-xs text-gray-400">Dibuat oleh {{ $announcement->user->name }} | {{ $announcement->created_at->format('d M Y H:i') }}</p>
                                </div>
                                <div class="flex gap-2 ml-4">
                                    <form action="{{ route('admin.announcements.toggle', $announcement->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-3 py-1.5 text-sm font-semibold rounded-lg {{ $announcement->is_active ? 'bg-gray-100 text-gray-600 hover:bg-gray-200' : 'bg-green-100 text-green-600 hover:bg-green-200' }}">
                                            {{ $announcement->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.announcements.edit', $announcement->id) }}" class="px-3 py-1.5 text-sm font-semibold rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 text-sm font-semibold rounded-lg bg-red-100 text-red-600 hover:bg-red-200">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-xl p-8 text-center">
                        <p class="text-gray-500">Belum ada pengumuman.</p>
                    </div>
                @endif
</x-admin-layout>