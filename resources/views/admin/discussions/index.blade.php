<x-admin-layout title="Kelola Forum - Admin">

                <h1 class="text-2xl font-bold text-gray-800 mb-6">Kelola Forum Diskusi</h1>

                @if($discussions->count() > 0)
                    <div class="space-y-4">
                        @foreach($discussions as $discussion)
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $discussion->title }}</h3>
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $discussion->content }}</p>
                                    <div class="flex items-center gap-4 text-xs text-gray-400">
                                        <span>by {{ $discussion->user->name }}</span>
                                        <span>{{ $discussion->views }} views</span>
                                        <span>{{ $discussion->replies->count() }} replies</span>
                                        <span>{{ $discussion->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                                <div class="ml-4 flex gap-2">
                                    <a href="{{ route('forum.show', $discussion->slug) }}" class="px-3 py-1.5 text-sm font-semibold rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200">
                                        Lihat
                                    </a>
                                    <form action="{{ route('admin.discussions.destroy', $discussion->id) }}" method="POST" onsubmit="return confirm('Yakin hapus diskusi ini beserta semua balasan?')">
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
                        <p class="text-gray-500">Belum ada diskusi.</p>
                    </div>
                @endif
</x-admin-layout>