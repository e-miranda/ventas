<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="text-2xl font-bold text-white">Catálogo de Producto</h2>
     <?php $__env->endSlot(); ?>    

    <div class="max-w-7xl mx-auto p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="border rounded-lg shadow hover:shadow-lg transition bg-white">
                <a href="<?php echo e(route('catalogo.show', $producto)); ?>">
                    <?php if($producto->imagen): ?>
                        <img src="<?php echo e(asset('storage/'.$producto->imagen)); ?>" class="w-full h-48 object-cover rounded-t w-">
                    <?php endif; ?>
                </a>

                <div class="p-4">
                    <h3 class="font-semibold text-lg"><?php echo e($producto->nombre); ?></h3>
                    <p class="text-gray-600 text-sm mb-2">Stock: <?php echo e($producto->cantidad); ?></p>
                    <p class="text-xl font-bold mb-3">Bs <?php echo e(number_format($producto->precio,2)); ?></p>

                    <a href="<?php echo e(route('catalogo.show', $producto)); ?>"
                       class="block text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                        Ver / Comprar
                    </a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /var/www/resources/views/catalogo/index.blade.php ENDPATH**/ ?>