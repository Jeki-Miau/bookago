<?php if (isset($component)) { $__componentOriginale0f1cdd055772eb1d4a99981c240763e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0f1cdd055772eb1d4a99981c240763e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin-layout','data' => ['title' => 'Baca Pesan - Admin']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Baca Pesan - Admin']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 mb-6">
                    <div class="border-b border-gray-100 pb-4 mb-4">
                        <h1 class="text-xl font-bold text-gray-800"><?php echo e($message->subject); ?></h1>
                        <p class="text-sm text-gray-500 mt-1">Dari: <?php echo e($message->user->name); ?> (<?php echo e($message->user->email); ?>) | <?php echo e($message->created_at->format('d M Y H:i')); ?></p>
                    </div>
                    <div class="text-gray-700">
                        <?php echo e($message->content); ?>

                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Balas Pesan</h3>
                    <form action="<?php echo e(route('admin.messages.reply', $message->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <textarea name="content" rows="4" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition mb-4" placeholder="Tulis balasan..."></textarea>
                        <button type="submit" class="bg-green-500 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-green-600 transition">
                            Kirim Balasan
                        </button>
                    </form>
                </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0f1cdd055772eb1d4a99981c240763e)): ?>
<?php $attributes = $__attributesOriginale0f1cdd055772eb1d4a99981c240763e; ?>
<?php unset($__attributesOriginale0f1cdd055772eb1d4a99981c240763e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0f1cdd055772eb1d4a99981c240763e)): ?>
<?php $component = $__componentOriginale0f1cdd055772eb1d4a99981c240763e; ?>
<?php unset($__componentOriginale0f1cdd055772eb1d4a99981c240763e); ?>
<?php endif; ?><?php /**PATH C:\Users\Jeki\Herd\bookago\resources\views/admin/messages/show.blade.php ENDPATH**/ ?>