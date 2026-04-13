<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8 relative" x-data="{ confirmingDelete: false }">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('forum.index') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-brand-dark group transition-colors">
                <svg class="w-4 h-4 mr-1.5 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Komunitas
            </a>
            
            @if(auth()->check() && (auth()->id() === $discussion->user_id || auth()->user()->is_admin))
                <div class="flex items-center gap-2">
                    @if(auth()->id() === $discussion->user_id)
                        <a href="{{ route('forum.edit', $discussion->slug) }}" class="p-2 text-gray-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-colors tooltip-trigger" title="Edit Diskusi">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                    @endif
                    @if(auth()->user()->is_admin)
                        <form action="{{ route('admin.discussions.destroy', $discussion->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus diskusi ini beserta semua balasannya?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors tooltip-trigger" title="Hapus (Admin)">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('forum.destroy', $discussion->slug) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus diskusi ini beserta semua balasannya?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors tooltip-trigger" title="Hapus Diskusi">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    @endif
                </div>
            @endif
        </div>

        @if(session('success'))
            <div class="mb-6 bg-brand-lime/10 border border-brand-lime/20 text-brand-lime px-4 py-3 rounded-xl shadow-sm text-sm font-bold flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Main Discussion Poster -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-100 shadow-sm mb-8 relative">
            <div class="flex items-center gap-4 mb-6">
                <img src="{{ $discussion->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($discussion->user->name).'&background=f8fafc&color=0f172a' }}" alt="Avatar" class="w-14 h-14 rounded-full object-cover shadow-sm bg-gray-100">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-brand-dark leading-tight">{{ $discussion->title }}</h1>
                    <div class="flex items-center gap-3 mt-2 text-xs font-semibold text-gray-400 tracking-wide uppercase">
                        <span class="text-brand-primary">{{ $discussion->user->name }}</span>
                        <span class="w-1 h-1 rounded-full bg-gray-200"></span>
                        <span>{{ $discussion->created_at->translatedFormat('d M Y, H:i') }}</span>
                    </div>
                </div>
            </div>

            <div class="prose prose-sm sm:prose-base max-w-none text-gray-600 leading-relaxed font-medium">
                {!! nl2br(e($discussion->content)) !!}
            </div>

            @if($discussion->image)
                <div class="mt-6">
                    <img src="{{ Storage::url($discussion->image) }}" alt="Diskusi Image" class="rounded-2xl max-h-96 object-cover border border-gray-100 shadow-sm">
                </div>
            @endif

            <div class="mt-8 pt-4 border-t border-gray-100 flex items-center gap-4 text-xs font-bold text-gray-400 uppercase tracking-widest">
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    {{ $discussion->views }} Tayangan
                </span>
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                    {{ $discussion->replies->count() }} Balasan
                </span>
            </div>
        </div>

        <!-- Replies Section -->
        <h3 class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-6 flex items-center gap-3">
            Balasan Komunitas <span class="bg-gray-200 text-gray-600 px-2 py-0.5 rounded-full text-[10px]">{{ $discussion->replies->count() }}</span>
        </h3>

        <div class="space-y-4 mb-10 pl-0 sm:pl-8 border-l-0 sm:border-l-2 border-gray-100">
            @forelse($discussion->replies as $reply)
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm relative group" x-data="{ editing: false }">
                    <!-- Connector line for desktop -->
                    <div class="hidden sm:block absolute -left-8 top-8 w-8 h-0.5 bg-gray-100"></div>
                    
                    <div class="flex items-start gap-4">
                        <img src="{{ $reply->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($reply->user->name).'&background=f8fafc&color=0f172a' }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover bg-gray-100">
                        <div class="flex-1">
                            <div class="flex items-baseline justify-between gap-2 mb-1">
                                <div class="flex items-baseline gap-2">
                                    <span class="text-sm font-bold text-brand-dark">{{ $reply->user->name }}</span>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $reply->created_at->diffForHumans() }}</span>
                                </div>
                                @if(auth()->check() && (auth()->id() === $reply->user_id || auth()->user()->is_admin))
                                    <div class="flex items-center space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                        @if(auth()->id() === $reply->user_id)
                                            <button @click="editing = !editing" class="p-1 text-gray-400 hover:text-blue-500 rounded tooltip-trigger" title="Edit">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                            </button>
                                        @endif
                                        @if(auth()->user()->is_admin)
                                            <form action="{{ route('admin.replies.destroy', $reply->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus balasan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1 text-gray-400 hover:text-red-500 rounded tooltip-trigger" title="Hapus (Admin)">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('forum.reply.destroy', $reply->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus balasan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1 text-gray-400 hover:text-red-500 rounded tooltip-trigger" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div x-show="!editing">
                                <div class="text-sm text-gray-600 leading-relaxed font-medium mt-1">
                                    {!! nl2br(e($reply->content)) !!}
                                </div>
                                @if($reply->image)
                                    <div class="mt-3">
                                        <img src="{{ Storage::url($reply->image) }}" alt="Reply Image" class="rounded-xl max-h-48 object-cover border border-gray-100 shadow-sm">
                                    </div>
                                @endif
                            </div>

                            @if(auth()->check() && auth()->id() === $reply->user_id)
                                <div x-show="editing" class="mt-3" style="display: none;">
                                    <form action="{{ route('forum.reply.update', $reply->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <textarea name="content" rows="3" required class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-brand-primary focus:ring focus:ring-brand-primary/20 text-sm mb-2">{{ $reply->content }}</textarea>
                                        
                                        @if($reply->image)
                                            <div class="mb-2">
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                                    <span class="ml-2 text-xs font-bold text-red-500 uppercase tracking-wide">Hapus Gambar</span>
                                                </label>
                                            </div>
                                        @endif
                                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mt-3">
                                            <input type="file" name="image" accept="image/*" class="block w-full sm:w-auto text-[10px] text-gray-500 cursor-pointer file:cursor-pointer file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:font-bold file:bg-brand-primary file:text-white file:shadow-sm hover:file:-translate-y-0.5 hover:file:bg-opacity-90 file:transition-all border border-dashed border-gray-300 rounded-lg p-1.5 bg-gray-50/50">
                                            
                                            <div class="flex gap-2">
                                                <button type="button" @click="editing = false" class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-lg hover:bg-gray-200">Batal</button>
                                                <button type="submit" class="px-3 py-1 bg-brand-primary text-white text-xs font-bold rounded-lg hover:bg-brand-dark">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                    <p class="text-sm font-medium text-gray-500">Belum ada balasan. Ayo jadi yang pertama memberikan tanggapan!</p>
                </div>
            @endforelse
        </div>

        <!-- Add Reply Form -->
        <div class="bg-brand-surface rounded-3xl p-6 sm:p-8 border border-gray-100">
            <h3 class="text-lg font-bold text-brand-dark mb-4">Berikan Balasan Anda</h3>
            @auth
                <form action="{{ route('forum.reply.store', $discussion->slug) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <textarea name="content" rows="4" required placeholder="Tuliskan gagasan, ide, atau tanggapan Anda di sini..."
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-primary focus:ring focus:ring-brand-primary/20 transition-all shadow-sm resize-y text-sm text-brand-dark mb-4"></textarea>
                    
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="w-full sm:w-auto">
                            <input type="file" name="image" id="reply_image" accept="image/*"
                                class="block w-full text-xs text-gray-500 cursor-pointer file:cursor-pointer file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:font-bold file:bg-brand-primary file:text-white hover:file:bg-opacity-90 file:shadow-sm file:transition-all hover:file:-translate-y-0.5 border border-dashed border-gray-300 rounded-xl p-2 bg-gray-50/50">
                        </div>
                        <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-brand-dark text-white text-sm font-bold rounded-xl shadow-sm hover:shadow-lg hover:bg-brand-primary transform hover:-translate-y-0.5 transition-all">
                            Kirim Balasan
                        </button>
                    </div>
                </form>
            @else
                <div class="text-center py-6 bg-white rounded-xl border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 mb-4">Anda harus login terlebih dahulu untuk ikut berdiskusi.</p>
                    <a href="{{ route('login') }}" class="inline-block px-6 py-2 bg-brand-primary text-white text-sm font-bold rounded-full hover:shadow-lg transition-all">
                        Login Sekarang
                    </a>
                </div>
            @endauth
        </div>
    </div>
</x-app-layout>
