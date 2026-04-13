<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-brand-dark tracking-tight">Forum Diskusi</h1>
                <p class="text-gray-500 font-medium mt-1">Diskusikan buku, penulis, dan gagasan terbaru bersama komunitas.</p>
            </div>
            @auth
                <a href="{{ route('forum.create') }}" class="inline-flex items-center px-5 py-2.5 bg-brand-primary text-white font-bold rounded-xl shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Topik Baru
                </a>
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-brand-dark font-bold rounded-xl hover:bg-gray-200 transition-colors">
                    Login untuk Berdiskusi
                </a>
            @endauth
        </div>

        <!-- Discussions List -->
        <div class="space-y-4">
            @forelse($discussions as $discussion)
                <a href="{{ route('forum.show', $discussion->slug) }}" class="block bg-white border border-gray-100 rounded-2xl p-5 hover:shadow-lg hover:border-brand-lime/30 transition-all group relative overflow-hidden">
                    <div class="flex items-start gap-4">
                        <img src="{{ $discussion->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($discussion->user->name).'&background=f8fafc&color=0f172a' }}" alt="Avatar" class="w-12 h-12 rounded-full object-cover shadow-sm bg-gray-100">
                        <div class="flex-1">
                            <h2 class="text-lg font-bold text-brand-dark group-hover:text-brand-primary transition-colors leading-tight mb-1">
                                {{ $discussion->title }}
                            </h2>
                            <p class="text-xs font-semibold tracking-wide text-gray-400 mb-3">
                                Oleh <span class="text-gray-600">{{ $discussion->user->name }}</span> • {{ $discussion->created_at->diffForHumans() }}
                            </p>
                            <p class="text-sm text-gray-500 line-clamp-2 leading-relaxed">
                                {{ Str::limit(strip_tags($discussion->content), 150) }}
                            </p>
                        </div>
                        <div class="flex flex-col items-center justify-center bg-gray-50 rounded-xl px-4 py-3 min-w-[4rem] border border-gray-100/50">
                            <span class="text-lg font-black text-brand-dark">{{ $discussion->replies_count }}</span>
                            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">Balasan</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="text-center py-20 bg-white border border-gray-100 rounded-3xl shadow-sm">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-extrabold text-brand-dark mb-2">Belum ada diskusi</h3>
                    <p class="text-sm font-medium text-gray-500 mb-6">Jadilah yang pertama untuk memulai percakapan di BOOKAGO!</p>
                    @auth
                        <a href="{{ route('forum.create') }}" class="inline-flex items-center px-6 py-2 bg-brand-primary text-white text-sm font-bold rounded-full hover:shadow-lg transition">Mulai Diskusi</a>
                    @endauth
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $discussions->links() }}
        </div>
    </div>
</x-app-layout>
