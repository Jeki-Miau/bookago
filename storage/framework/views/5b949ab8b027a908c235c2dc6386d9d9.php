<?php if (isset($component)) { $__componentOriginal4619374cef299e94fd7263111d0abc69 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4619374cef299e94fd7263111d0abc69 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="max-w-7xl mx-auto space-y-8 pb-12">

        <!-- Header -->
        <section x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)" x-show="show"
            x-transition:enter="transition ease-out duration-700 transform"
            x-transition:enter-start="opacity-0 translate-y-8"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="relative bg-white border border-gray-100 rounded-2xl p-6 lg:p-10 overflow-hidden shadow-sm">
            <div class="absolute -top-32 -right-32 w-96 h-96 bg-brand-lime/10 blur-3xl rounded-full pointer-events-none"></div>
            <div class="relative z-10 max-w-2xl space-y-3">
                <p class="text-[10px] font-black uppercase tracking-widest text-brand-lime font-mono">Koleksi Pribadi</p>
                <h1 class="text-2xl lg:text-3xl font-extrabold text-brand-dark tracking-tight leading-tight">
                    Buku Tersimpan <span class="text-brand-lime" x-text="'(' + savedCount + ')'"></span>
                </h1>
                <p class="text-sm text-gray-500 font-medium max-w-lg leading-relaxed">
                    Semua buku yang telah Anda tandai akan tersinkronisasi secara otomatis di seluruh perangkat Anda melalui Firebase.
                </p>
            </div>
        </section>

        <!-- Saved Books Grid (real-time from Firestore) -->
        <section
            x-data="{
                savedBooks: [],
                savedCount: 0,
                loading: true,
                userId: <?php echo e(auth()->id() ?? 0); ?>,
                init() {
                    if (!this.userId || !window.firebaseHelpers) {
                        this.loading = false;
                        return;
                    }
                    window.firebaseHelpers.onSavedBooksChange(this.userId, (books) => {
                        this.savedBooks = books;
                        this.savedCount = books.length;
                        this.loading = false;
                    });
                },
                async removeSaved(slug) {
                    await window.firebaseHelpers.unsaveBook(this.userId, slug);
                }
            }"
            class="space-y-6"
        >
            <!-- Loading State -->
            <div x-show="loading" class="flex items-center justify-center py-32">
                <div class="animate-spin rounded-full h-10 w-10 border-4 border-brand-lime border-t-transparent"></div>
            </div>

            <!-- Empty State -->
            <div x-show="!loading && savedBooks.length === 0"
                 x-transition
                 class="py-32 flex flex-col items-center justify-center bg-white rounded-3xl border border-gray-100 shadow-sm text-center">
                <svg class="w-24 h-24 text-gray-200 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>
                <h3 class="text-2xl font-black text-brand-dark mb-2">Belum ada buku tersimpan</h3>
                <p class="text-gray-500 font-medium max-w-sm mt-2">Klik ikon bookmark pada kartu buku di katalog untuk mulai menyimpan.</p>
                <a href="<?php echo e(route('home')); ?>" class="mt-8 px-6 py-3 bg-brand-primary text-white text-sm font-bold rounded-full hover:bg-opacity-90 transition transform hover:-translate-y-1 shadow-lg">Jelajahi Katalog</a>
            </div>

            <!-- Books Grid -->
            <div x-show="!loading && savedBooks.length > 0"
                 x-transition
                 class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">
                <template x-for="book in savedBooks" :key="book.slug">
                    <div class="group relative flex flex-col bg-white border border-gray-100 rounded-3xl overflow-hidden shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                        <!-- Cover -->
                        <div class="relative w-full aspect-[2/3] overflow-hidden bg-gray-50 border-b border-gray-100">
                            <img :src="book.coverImage || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(book.title) + '&background=f8fafc&color=0f172a&size=400'"
                                 :alt="book.title"
                                 class="object-cover w-full h-full transition-transform duration-700 ease-out group-hover:scale-105"
                                 loading="lazy">
                            
                            <!-- Remove Button -->
                            <button @click="removeSaved(book.slug)"
                                class="absolute top-3 right-3 z-20 w-9 h-9 rounded-full bg-red-500 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 shadow-md hover:bg-red-600 hover:scale-110">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>

                            <!-- Read Button -->
                            <div class="absolute inset-x-0 bottom-0 top-1/2 bg-gradient-to-t from-white via-white/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4 z-10">
                                <a :href="book.previewUrl || '/search?q=' + encodeURIComponent(book.title)"
                                   target="_blank"
                                   class="w-full text-center bg-brand-primary text-white text-sm font-bold py-3 rounded-2xl shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 ease-out delay-75 hover:bg-opacity-90">
                                    Mulai Membaca
                                </a>
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="p-5 flex flex-col grow bg-white relative z-20">
                            <h4 class="font-bold text-lg text-brand-dark line-clamp-1 group-hover:text-brand-lime transition-colors" x-text="book.title"></h4>
                            <p class="text-xs font-semibold text-gray-400 mt-1 mb-3" x-text="'Oleh ' + book.author"></p>
                            <div class="flex flex-wrap gap-2 mt-auto pt-4 border-t border-gray-50">
                                <span class="text-[9px] font-black uppercase tracking-widest bg-green-50 text-green-600 px-2.5 py-1.5 rounded-lg border border-green-100">
                                    ✓ Tersimpan
                                </span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </section>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $attributes = $__attributesOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__attributesOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $component = $__componentOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__componentOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Jeki\Herd\bookago\resources\views/books/saved.blade.php ENDPATH**/ ?>