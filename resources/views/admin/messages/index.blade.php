<x-admin-layout title="Pesan Masuk - Admin">

                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Pesan Masuk</h1>
                    @if($messages->count() > 0)
                    <form action="{{ route('admin.messages.clear') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus semua pesan dari user?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 text-sm font-semibold text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition">
                            Hapus Semua
                        </button>
                    </form>
                    @endif
                </div>

                @if($messages->count() > 0)
                    <div class="space-y-4">
                        @foreach($messages as $message)
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 {{ !$message->is_read ? 'border-l-4 border-l-green-500' : '' }}">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <h3 class="text-lg font-bold text-gray-800">{{ $message->subject }}</h3>
                                        @if(!$message->is_read)
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">Baru</span>
                                        @endif
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $message->sender_type === 'user' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                                            {{ $message->sender_type === 'user' ? 'Dari User' : 'Balasan Admin' }}
                                        </span>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-3">{{ $message->content }}</p>
                                    <p class="text-xs text-gray-400">Dari: {{ $message->user->name }} | {{ $message->created_at->format('d M Y H:i') }}</p>
                                </div>
                                <a href="{{ route('admin.messages.show', $message->id) }}" class="ml-4 px-4 py-2 text-sm font-semibold rounded-lg bg-green-100 text-green-600 hover:bg-green-200">
                                    Lihat & Balas
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-xl p-8 text-center">
                        <p class="text-gray-500">Belum ada pesan.</p>
                    </div>
                @endif
</x-admin-layout>