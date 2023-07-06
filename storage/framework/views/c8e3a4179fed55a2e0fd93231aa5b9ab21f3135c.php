 <?php $__env->startSection('content'); ?>
    <div class="ragister-account text-center">
        <div class="container">
            <div class="account-content">
                <h1><?php echo e(__('forgot_password')); ?></h1> 
                <form class="ragister-form" name="ragister-form" method="post" action="<?php echo e(route('do-forget-password')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group text-left mb-0">
                        <input name="email" type="email" value="<?php echo e(old('email')); ?>" class="form-control" required="required" placeholder="<?php echo e(__('email')); ?>" autocomplete="off">
                    </div>
                    <button type="submit"><?php echo e(__('send_code')); ?></button>
                </form>
                
            </div>
            
        </div>
        
    </div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/site/auth/forgot_password.blade.php ENDPATH**/ ?>