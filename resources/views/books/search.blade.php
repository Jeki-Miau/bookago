<x-app-layout>
    <div class="max-w-7xl mx-auto space-y-8 py-12 px-6">
        <section class="space-y-6 pt-6">
            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                <h2 class="text-2xl font-extrabold flex items-center space-x-3">
                    <span class="w-2 h-8 bg-brand-primary rounded-full inline-block shadow-sm"></span>
                    <span class="text-brand-dark">Hasil Pencarian: <span class="text-brand-primary">"{{ $query }}"</span></span>
                </h2>
                <a href="{{ route('home') }}" class="text-sm font-bold text-gray-500 hover:text-brand-dark transition inline-flex items-center">
                    <svg class="mr-1 w-4 h-4 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    Kembali ke Katalog
                </a>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6 pt-4">
                @forelse ($results as $book)
                    <x-book-card :book="$book" />
                @empty
                    <div class="col-span-full py-32 flex flex-col items-center justify-center bg-white rounded-3xl border border-gray-100 shadow-sm text-center">
                        <svg class="w-24 h-24 text-gray-200 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-2xl font-black text-brand-dark mb-2">Buku tidak ditemukan</h3>
                        <p class="text-gray-500 font-medium max-w-sm mt-2">Kami tidak dapat menemukan buku dengan kata kunci "{{ $query }}". Coba gunakan kata kunci lain seputar judul, penulis, atau topik.</p>
                        
                        <a href="{{ route('landing') }}" class="mt-8 px-6 py-3 bg-brand-bg border-2 border-brand-primary text-brand-primary text-sm font-bold rounded-full hover:bg-brand-primary hover:text-white transition-all transform hover:-translate-y-1 shadow-sm">Coba Pencarian Baru</a>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</x-app-layout>
