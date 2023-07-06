<?php $__env->startSection('content'); ?>
<div class="container-fluid ">
	<div class="text-center my-5">
	    <div class="error mx-auto" data-text="405"><?php echo e(__('405')); ?></div>
	    <p class="lead text-gray-800 mb-5"><?php echo e(__('bad_request')); ?></p>
	    <p class="text-gray-500 mb-0"><?php echo e(__('405_message')); ?></p>
	    <a href="<?php echo e(url('')); ?>">← <?php echo e(__('back_to_home')); ?></a>
	 </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/site/pages/405.blade.php ENDPATH**/ ?>