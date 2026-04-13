<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-8 pb-12">
        
        <!-- Header Section -->
        <section x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)" x-show="show"
            x-transition:enter="transition ease-out duration-700 transform"
            x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
            class="relative bg-white border border-gray-100 rounded-2xl p-6 lg:p-10 overflow-hidden shadow-sm">
            
            <div class="absolute -top-32 -right-32 w-96 h-96 bg-brand-lime/10 blur-3xl rounded-full pointer-events-none"></div>

            <div class="relative z-10 space-y-2">
                <p class="text-[10px] font-black uppercase tracking-widest text-brand-lime font-mono">Profil Pengguna</p>
                <h1 class="text-2xl lg:text-3xl font-extrabold text-brand-dark tracking-tight leading-tight">
                    Pengaturan Akun
                </h1>
                <p class="text-sm text-gray-500 font-medium leading-relaxed">
                    Perbarui foto profil, identitas publik, dan biografi Anda untuk menyesuaikan cara Anda tampil di Bookago.
                </p>
            </div>
        </section>

        <!-- Notification Success -->
        @if (session('status'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" 
                class="bg-green-50 border border-green-200 text-green-800 rounded-xl px-5 py-4 font-bold text-sm flex justify-between items-center shadow-sm">
                <span>{{ session('status') }}</span>
                <button @click="show = false" class="text-green-600 hover:text-green-900 transition">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        <!-- Form Section -->
        <section x-data="{ 
                show: false,
                imagePreview: '{{ $user->avatar ?? "https://ui-avatars.com/api/?name=" . urlencode($user->name) . "&background=0f172a&color=fff" }}',
                updatePreview(event) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imagePreview = e.target.result;
                    };
                    if (event.target.files.length) {
                        reader.readAsDataURL(event.target.files[0]);
                    }
                }
            }" x-init="setTimeout(() => show = true, 250)" x-show="show"
            x-transition:enter="transition ease-out duration-700 transform"
            x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
            class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
            
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="divide-y divide-gray-100">
                @csrf
                @method('PUT')

                <!-- Avatar Section -->
                <div class="p-6 lg:p-8 flex flex-col sm:flex-row gap-8 items-start sm:items-center">
                    <div class="relative group cursor-pointer shrink-0">
                        <!-- Outer Border ring -->
                        <div class="w-32 h-32 rounded-full border-4 border-white shadow-xl overflow-hidden bg-gray-50 flex items-center justify-center ring-2 ring-brand-lime/30 group-hover:ring-brand-lime transition duration-300">
                            <img :src="imagePreview" alt="Profile Preview" class="w-full h-full object-cover">
                        </div>
                        <!-- Upload Overlay -->
                        <div class="absolute inset-0 bg-brand-dark/60 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <input type="file" name="avatar_file" id="avatar_file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" @change="updatePreview">
                    </div>
                    
                    <div class="space-y-1">
                        <h3 class="text-lg font-bold text-brand-dark">Foto Profil</h3>
                        <p class="text-xs text-gray-500 font-medium pb-2">Unggah file berformat JPG, PNG, atau WebP. Dianjurkan ukuran 500x500px, maksimal 10MB.</p>
                        <label for="avatar_file" class="inline-flex items-center px-4 py-2 border border-brand-lime text-brand-lime rounded-full text-xs font-bold uppercase tracking-widest hover:bg-brand-lime hover:text-brand-primary transition cursor-pointer">
                            Pilih Gambar
                        </label>
                        @error('avatar_file') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Profile Info Section -->
                <div class="p-6 lg:p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div>
                            <label for="name" class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-semibold text-brand-dark focus:ring-2 focus:ring-brand-lime focus:border-brand-lime transition" required autocomplete="name">
                            @error('name') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Nama Pengguna (Username)</label>
                            <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-semibold text-brand-dark focus:ring-2 focus:ring-brand-lime focus:border-brand-lime transition" placeholder="johndoe_99">
                            @error('username') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Email Address (Readonly mostly, but shown for info) -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Alamat Surel (Email)</label>
                        <div class="flex items-center space-x-3 w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 opacity-70">
                            <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span class="text-sm font-semibold text-gray-600">{{ $user->email }}</span>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-1.5 font-bold">Alamat surel terikat pada akun Anda dan tidak dapat diubah di menu ini.</p>
                    </div>

                    <!-- Bio -->
                    <div>
                        <label for="bio" class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Biografi Singkat</label>
                        <textarea name="bio" id="bio" rows="4" 
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-semibold text-brand-dark focus:ring-2 focus:ring-brand-lime focus:border-brand-lime transition" placeholder="Ceritakan sedikit mengenai hobi membaca atau gelar akademik Anda...">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Footer / Action Area -->
                <div class="p-6 lg:p-8 bg-gray-50 flex items-center justify-end">
                    <button type="submit" 
                        class="bg-brand-primary text-white font-bold text-sm px-8 py-3 rounded-full hover:bg-opacity-90 shadow-md transition hover:-translate-y-0.5">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

        </section>

    </div>
</x-app-layout>
