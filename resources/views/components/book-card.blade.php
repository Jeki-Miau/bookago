@props(['book'])

@php
    $userId = auth()->id() ?? 0;
    $bookSlug = $book->slug ?? \Illuminate\Support\Str::slug($book->title);
    $bookJson = json_encode([
        'slug' => $bookSlug,
        'title' => $book->title,
        'author' => $book->author ?? 'Penulis Anonim',
        'coverImage' => $book->cover_image ?? null,
        'previewUrl' => $book->preview_url ?? null,
    ]);
@endphp

<div x-data="{
        hover: false,
        saved: false,
        saving: false,
        userId: {{ $userId }},
        bookData: {{ $bookJson }},
        async toggleSave() {
            if (!this.userId || !window.firebaseHelpers) return;
            this.saving = true;
            try {
                if (this.saved) {
                    await window.firebaseHelpers.unsaveBook(this.userId, this.bookData.slug);
                    this.saved = false;
                } else {
                    await window.firebaseHelpers.saveBook(this.userId, this.bookData);
                    this.saved = true;
                }
            } catch (e) {
                console.error('Firebase save error:', e);
            }
            this.saving = false;
        },
        async checkSaved() {
            if (!this.userId || !window.firebaseHelpers) return;
            try {
                this.saved = await window.firebaseHelpers.isBookSaved(this.userId, this.bookData.slug);
            } catch(e) {}
        }
    }" x-init="checkSaved()" @mouseenter="hover = true" @mouseleave="hover = false"
    class="group relative flex flex-col bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl cursor-pointer">

    <!-- Cover Image -->
    <div class="relative w-full aspect-[2/3] overflow-hidden bg-gray-50 border-b border-gray-100">
        <img src="{{ $book->cover_image ?? 'https://ui-avatars.com/api/?name=' . urlencode($book->title) . '&background=f8fafc&color=0f172a&size=400' }}"
            alt="{{ $book->title }}"
            class="object-cover w-full h-full transition-transform duration-700 ease-out group-hover:scale-105"
            loading="lazy">

        <!-- Bookmark Button -->
        @auth
            <button @click.stop="toggleSave()" :class="saving ? 'opacity-50 pointer-events-none' : ''"
                class="absolute top-2 right-2 z-20 w-8 h-8 rounded-full flex items-center justify-center transition-all duration-300 shadow-sm"
                :style="saved ? 'background: #4f46e5; color: white;' : 'background: white; color: #9ca3af;'">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                    <path x-show="saved" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                    <path x-show="!saved" fill="none" stroke="currentColor" stroke-width="2"
                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                </svg>
            </button>
        @endauth

        <!-- White overlay slideup -->
        <div
            class="absolute inset-x-0 bottom-0 top-1/2 bg-gradient-to-t from-white via-white/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3 z-10">
            @if($book->preview_url)
                <a href="{{ $book->preview_url }}" target="_blank" rel="noopener noreferrer"
                    class="w-full text-center bg-brand-primary text-white text-xs font-bold py-2 rounded-xl shadow-md transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 ease-out delay-75 hover:bg-opacity-90">
                    Mulai Membaca
                </a>
            @else
                <a href="{{ route('books.detail', $bookSlug) }}"
                    class="w-full text-center bg-brand-primary text-white text-xs font-bold py-2 rounded-xl shadow-md transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 ease-out delay-75 hover:bg-opacity-90">
                    Lihat Detail
                </a>
            @endif
        </div>
    </div>

    <!-- Info -->
    <div class="p-4 flex flex-col grow bg-white relative z-20">
        <div class="flex items-start justify-between">
            <h4 class="font-bold text-base text-brand-dark line-clamp-1 group-hover:text-brand-lime transition-colors">
                {{ $book->title }}
            </h4>
        </div>

        <p class="text-[10px] font-semibold text-gray-400 mt-0.5 mb-2">
            Oleh {{ $book->author ?? 'Penulis Anonim' }}
        </p>

        <!-- Categories Chips -->
        <div class="flex flex-wrap gap-1.5 mt-auto pt-3 border-t border-gray-50">
            @if($book->categories && $book->categories->count() > 0)
                @foreach($book->categories->take(2) as $category)
                    <span
                        class="text-[8px] font-black uppercase tracking-wider bg-brand-surface text-brand-primary px-2 py-1 rounded-md border border-gray-200">
                        {{ $category->name }}
                    </span>
                @endforeach
            @else
                <span
                    class="text-[8px] font-black uppercase tracking-wider bg-brand-surface text-brand-primary px-2 py-1 rounded-md border border-gray-200">
                    Fiksi Umum
                </span>
            @endif
        </div>
    </div>
</div>