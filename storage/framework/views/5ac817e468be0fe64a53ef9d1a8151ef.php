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

    <div class="max-w-5xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-brand-dark tracking-tight">Forum Diskusi</h1>
                <p class="text-gray-500 font-medium mt-1">Diskusikan buku, penulis, dan gagasan terbaru bersama komunitas.</p>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('forum.create')); ?>" class="inline-flex items-center px-5 py-2.5 bg-brand-primary text-white font-bold rounded-xl shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Topik Baru
                </a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-brand-dark font-bold rounded-xl hover:bg-gray-200 transition-colors">
                    Login untuk Berdiskusi
                </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <!-- Discussions List -->
        <div class="space-y-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $discussions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discussion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <a href="<?php echo e(route('forum.show', $discussion->slug)); ?>" class="block bg-white border border-gray-100 rounded-2xl p-5 hover:shadow-lg hover:border-brand-lime/30 transition-all group relative overflow-hidden">
                    <div class="flex items-start gap-4">
                        <img src="<?php echo e($discussion->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($discussion->user->name).'&background=f8fafc&color=0f172a'); ?>" alt="Avatar" class="w-12 h-12 rounded-full object-cover shadow-sm bg-gray-100">
                        <div class="flex-1">
                            <h2 class="text-lg font-bold text-brand-dark group-hover:text-brand-primary transition-colors leading-tight mb-1">
                                <?php echo e($discussion->title); ?>

                            </h2>
                            <p class="text-xs font-semibold tracking-wide text-gray-400 mb-3">
                                Oleh <span class="text-gray-600"><?php echo e($discussion->user->name); ?></span> • <?php echo e($discussion->created_at->diffForHumans()); ?>

                            </p>
                            <p class="text-sm text-gray-500 line-clamp-2 leading-relaxed">
                                <?php echo e(Str::limit(strip_tags($discussion->content), 150)); ?>

                            </p>
                        </div>
                        <div class="flex flex-col items-center justify-center bg-gray-50 rounded-xl px-4 py-3 min-w-[4rem] border border-gray-100/50">
                            <span class="text-lg font-black text-brand-dark"><?php echo e($discussion->replies_count); ?></span>
                            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">Balasan</span>
                        </div>
                    </div>
                </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="text-center py-20 bg-white border border-gray-100 rounded-3xl shadow-sm">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-extrabold text-brand-dark mb-2">Belum ada diskusi</h3>
                    <p class="text-sm font-medium text-gray-500 mb-6">Jadilah yang pertama untuk memulai percakapan di BOOKAGO!</p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('forum.create')); ?>" class="inline-flex items-center px-6 py-2 bg-brand-primary text-white text-sm font-bold rounded-full hover:shadow-lg transition">Mulai Diskusi</a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="mt-8">
            <?php echo e($discussions->links()); ?>

        </div>
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
<?php /**PATH C:\Users\Jeki\Herd\bookago\resources\views/forum/index.blade.php ENDPATH**/ ?>