<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['book']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['book']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $userId = auth()->id() ?? 0;
    $bookSlug = $book->slug ?? \Illuminate\Support\Str::slug($book->title);
    $bookJson = json_encode([
        'slug' => $bookSlug,
        'title' => $book->title,
        'author' => $book->author ?? 'Penulis Anonim',
        'coverImage' => $book->cover_image ?? null,
        'previewUrl' => $book->preview_url ?? null,
    ]);
?>

<div x-data="{
        hover: false,
        saved: false,
        saving: false,
        userId: <?php echo e($userId); ?>,
        bookData: <?php echo e($bookJson); ?>,
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
        <img src="<?php echo e($book->cover_image ?? 'https://ui-avatars.com/api/?name=' . urlencode($book->title) . '&background=f8fafc&color=0f172a&size=400'); ?>"
            alt="<?php echo e($book->title); ?>"
            class="object-cover w-full h-full transition-transform duration-700 ease-out group-hover:scale-105"
            loading="lazy">

        <!-- Bookmark Button -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
            <button @click.stop="toggleSave()" :class="saving ? 'opacity-50 pointer-events-none' : ''"
                class="absolute top-2 right-2 z-20 w-8 h-8 rounded-full flex items-center justify-center transition-all duration-300 shadow-sm"
                :style="saved ? 'background: #4f46e5; color: white;' : 'background: white; color: #9ca3af;'">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                    <path x-show="saved" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                    <path x-show="!saved" fill="none" stroke="currentColor" stroke-width="2"
                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                </svg>
            </button>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <!-- White overlay slideup -->
        <div
            class="absolute inset-x-0 bottom-0 top-1/2 bg-gradient-to-t from-white via-white/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3 z-10">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($book->preview_url): ?>
                <a href="<?php echo e($book->preview_url); ?>" target="_blank" rel="noopener noreferrer"
                    class="w-full text-center bg-brand-primary text-white text-xs font-bold py-2 rounded-xl shadow-md transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 ease-out delay-75 hover:bg-opacity-90">
                    Mulai Membaca
                </a>
            <?php else: ?>
                <a href="<?php echo e(route('books.detail', $bookSlug)); ?>"
                    class="w-full text-center bg-brand-primary text-white text-xs font-bold py-2 rounded-xl shadow-md transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 ease-out delay-75 hover:bg-opacity-90">
                    Lihat Detail
                </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <!-- Info -->
    <div class="p-4 flex flex-col grow bg-white relative z-20">
        <div class="flex items-start justify-between">
            <h4 class="font-bold text-base text-brand-dark line-clamp-1 group-hover:text-brand-lime transition-colors">
                <?php echo e($book->title); ?>

            </h4>
        </div>

        <p class="text-[10px] font-semibold text-gray-400 mt-0.5 mb-2">
            Oleh <?php echo e($book->author ?? 'Penulis Anonim'); ?>

        </p>

        <!-- Categories Chips -->
        <div class="flex flex-wrap gap-1.5 mt-auto pt-3 border-t border-gray-50">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($book->categories && $book->categories->count() > 0): ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $book->categories->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <span
                        class="text-[8px] font-black uppercase tracking-wider bg-brand-surface text-brand-primary px-2 py-1 rounded-md border border-gray-200">
                        <?php echo e($category->name); ?>

                    </span>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <?php else: ?>
                <span
                    class="text-[8px] font-black uppercase tracking-wider bg-brand-surface text-brand-primary px-2 py-1 rounded-md border border-gray-200">
                    Fiksi Umum
                </span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div><?php /**PATH C:\Users\Jeki\Herd\bookago\resources\views/components/book-card.blade.php ENDPATH**/ ?>