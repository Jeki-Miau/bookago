<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-8">
        <a href="{{ route('forum.show', $discussion->slug) }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-brand-dark mb-6 group transition-colors">
            <svg class="w-4 h-4 mr-1.5 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Diskusi
        </a>

        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
            <div class="mb-8">
                <h1 class="text-2xl font-extrabold text-brand-dark">Edit Topik Diskusi</h1>
                <p class="text-sm font-medium text-gray-500 mt-1">Perbarui topik diskusi agar relevan dengan audiens.</p>
            </div>

            <form action="{{ route('forum.update', $discussion->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label for="title" class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Judul Topik <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $discussion->title) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-primary focus:ring focus:ring-brand-primary/20 transition-all shadow-sm font-semibold text-brand-dark placeholder-gray-400">
                    @error('title')
                        <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="content" class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Isi Topik <span class="text-red-500">*</span></label>
                    <textarea name="content" id="content" rows="8" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-primary focus:ring focus:ring-brand-primary/20 transition-all shadow-sm resize-y text-sm text-brand-dark">{{ old('content', $discussion->content) }}</textarea>
                    @error('content')
                        <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="image" class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Perbarui Gambar (Opsional)</label>
                    
                    @if($discussion->image)
                        <div class="mb-3">
                            <img src="{{ Storage::url($discussion->image) }}" alt="Current Image" class="w-32 h-32 object-cover rounded-xl border border-gray-200 shadow-sm">
                            <label class="inline-flex items-center mt-2">
                                <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                <span class="ml-2 text-xs font-bold text-red-500 uppercase tracking-wide">Hapus Gambar Ini</span>
                            </label>
                        </div>
                    @endif

                    <input type="file" name="image" id="image" accept="image/*"
                        class="block w-full text-sm text-gray-500 file:cursor-pointer cursor-pointer file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-primary file:text-white hover:file:bg-opacity-90 file:shadow-sm file:transition-all hover:file:-translate-y-0.5 border border-dashed border-gray-300 rounded-xl p-2 bg-gray-50/50">
                    @error('image')
                        <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end pt-4 border-t border-gray-100">
                    <button type="submit" class="px-8 py-3 bg-brand-primary text-white font-bold rounded-xl shadow-sm hover:shadow-lg hover:bg-opacity-90 transform hover:-translate-y-0.5 transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
