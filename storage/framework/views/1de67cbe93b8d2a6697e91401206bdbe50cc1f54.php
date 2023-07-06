<?php $__env->startSection('content'); ?>
    <div class="container-fluid ">
        <div class="text-center my-5">
            <div class="error mx-auto" data-text="404"><?php echo e(__('404')); ?></div>
            <p class="lead text-gray-800 mb-5"><?php echo e(__('page_not_found')); ?></p>
            <p class="text-gray-500 mb-0"><?php echo e(__('404_message')); ?> </p>
            <a href="<?php echo e(url('')); ?>">← <?php echo e(__('back_to_home')); ?></a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/errors/404.blade.php ENDPATH**/ ?>