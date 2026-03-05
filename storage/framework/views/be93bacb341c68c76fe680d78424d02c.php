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
        <h2 class="text-xl font-semibold text-white">
            Listado de Ventas
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="p-6">
        <table class="min-w-full border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2">ID</th>
                    <th class="border px-3 py-2">Producto</th>
                    <th class="border px-3 py-2">Comprador</th>
                    <th class="border px-3 py-2">Cantidad</th>
                    <th class="border px-3 py-2">Total</th>
                    <th class="border px-3 py-2">Estado</th>
                    <th class="border px-3 py-2">Comprobante</th>
                    <th class="border px-3 py-2">Acción</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $ventas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="text-center  text-white">
                        <td class="border px-2 py-1"><?php echo e($venta->id); ?></td>
                        <td class="border px-2 py-1"><?php echo e($venta->producto->nombre); ?></td>
                        <td class="border px-2 py-1"><?php echo e($venta->nombre_comprador); ?></td>
                        <td class="border px-2 py-1"><?php echo e($venta->cantidad); ?></td>
                        <td class="border px-2 py-1">
                            Bs <?php echo e(number_format($venta->precio * $venta->cantidad, 2)); ?>

                        </td>

                        <td class="border px-2 py-1">
                            <?php
                                $colores = [
                                    0 => 'bg-yellow-100 text-yellow-800',
                                    1 => 'bg-green-100 text-green-800',
                                    2 => 'bg-red-100 text-red-800',
                                    3 => 'bg-blue-100 text-blue-800',
                                ];
                            ?>

                            <span class="px-2 py-1 rounded text-sm <?php echo e($colores[$venta->estado]); ?>">
                                <?php echo e(match($venta->estado) {
                                    0 => 'Pendiente',
                                    1 => 'Aprobada',
                                    2 => 'Rechazada',
                                    3 => 'Entregada'
                                }); ?>

                            </span>
                        </td>

                        <td class="border px-2 py-1">
                            <?php if($venta->imagen): ?>
                                <a href="<?php echo e(asset('storage/'.$venta->imagen)); ?>" target="_blank"
                                   class="text-blue-600 underline">
                                    Ver imagen
                                </a>
                            <?php endif; ?>
                        </td>

                        <td class="border px-2 py-1 space-x-1">
                            <?php if($venta->estado === \App\Models\Venta::PENDIENTE): ?>
                                <form action="<?php echo e(route('ventas.aprobar', $venta)); ?>" method="POST" class="inline" >
                                    <?php echo csrf_field(); ?>                                    
                                    <?php echo method_field('PUT'); ?>
                                    <button class="px-2 py-1 
                            bg-green-600 text-white 
                            border border-green-300
                            rounded shadow-lg
                            hover:bg-green-700
                            transition">
                                        Aprobar
                                    </button>
                                </form>

                                <form action="<?php echo e(route('ventas.rechazar', $venta)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <button class="bg-red-600 text-white px-2 py-1 rounded text-sm">
                                        Rechazar
                                    </button>
                                </form>                                
                            <?php endif; ?>

                            <?php if($venta->estado === \App\Models\Venta::APROBADA): ?>
                                <form action="<?php echo e(route('ventas.entregar', $venta)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <button class="bg-blue-600 text-white px-2 py-1 rounded text-sm">
                                        Entregar
                                    </button>
                                </form>
                            <?php endif; ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
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
<?php /**PATH /var/www/resources/views/ventas/index.blade.php ENDPATH**/ ?>