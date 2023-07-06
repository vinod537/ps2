<div class="col-md-4">
    <h1>Settings</h1>
    <div class="author-menu">
        <ul class="global-list">
            <li><a class="<?php echo $__env->yieldContent('my-profile-edit'); ?>" href="<?php echo e(route('site.profile.form')); ?>"><?php echo e(__('edit_profile')); ?></a></li>
            <li><a class="<?php echo $__env->yieldContent('author-socials'); ?>" href="<?php echo e(route('site.author.socials')); ?>"><?php echo e(__('socials')); ?></a></li>
            <li><a class="<?php echo $__env->yieldContent('author-preference'); ?>" href="<?php echo e(route('site.author.preference')); ?>"><?php echo e(__('preference_setting')); ?></a></li>
            <li><a class="<?php echo $__env->yieldContent('author-password'); ?>" href="<?php echo e(route('site.author.password')); ?>"><?php echo e(__('change_password')); ?></a></li>
        </ul>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\pharmashots\resources\views/site/pages/author/sidebar.blade.php ENDPATH**/ ?>