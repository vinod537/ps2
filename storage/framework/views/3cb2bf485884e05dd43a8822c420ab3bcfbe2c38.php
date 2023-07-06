<?php $__env->startSection('content'); ?>


<style>
.account-content {
	margin-top: 113px;
	margin-bottom: 92px;
}
	.account-content button {
	width: 100%;
	font-size: 14px;
	font-weight: 600;
	height: 45px;
	color: #fff;
	margin-bottom: 20px;
	border-radius: 4px;
	text-transform: uppercase;
	background-color: rgb(85, 65, 206);
	border: 1px solid rgb(85, 65, 206);
}
	.form-control {
	height: 33px;
	border-radius: 4px;
	padding: 6px 10px;
	margin-bottom: 9px;
	border: 1px solid #d8e2e9;
	font-size: 14px;
}
</style>



    <div class="ragister-account text-center">
        <div class="container">
            <div class="account-content">
                <h1><?php echo e(__('sign_up')); ?></h1>
                
                <form class="ragister-form" name="ragister-form" method="post" action="<?php echo e(route('site.register')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group text-left mb-0">
                        <label><?php echo e(__('first_name')); ?> *</label>
                        <input name="first_name" type="text" class="form-control" required="required" placeholder="<?php echo e(__('first_name')); ?>">
                    </div>
                    <div class="form-group text-left mb-0">
                        <label><?php echo e(__('last_name')); ?> *</label>
                        <input name="last_name" type="text" class="form-control" required="required" placeholder="<?php echo e(__('last_name')); ?>">
                    </div>
                    <div class="form-group text-left mb-0">
                        <label><?php echo e(__('email')); ?> *</label>
                        <input name="email" type="email" class="form-control" required="required" placeholder="<?php echo e(__('input_email')); ?>">
                    </div>
                    <div class="form-group text-left mb-0">
                        <label><?php echo e(__('phone')); ?> </label>
                        <input name="phone" type="text" class="form-control" placeholder="+880123-5488578">
                    </div>
                    <div class="form-group text-left mb-0">
                        <label><?php echo e(__('dob')); ?> *</label>
                        <input name="dob" type="date" max="<?php echo e(date("Y-m-d")); ?>" pattern="\d{4}-\d{2}-\d{2}" class="form-control" required>
                    </div>
                    <div class="form-group text-left mb-0">
                        <label><?php echo e(__('gender')); ?> *</label>
                        <select class="form-control" name="gender" id="gender">
                            <option><?php echo e(__('select_option')); ?></option>
                            <?php $__currentLoopData = __('genders.genderType'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value); ?>"><?php echo e($item); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group text-left mb-0">
                        <label><?php echo e(__('password')); ?> *</label>
                        <input name="password" type="password" class="form-control" required="required" placeholder="***********">
                    </div>
                    <?php if( settingHelper('captcha_visibility') == 1 ): ?>
                        <div class="col-lg-12 text-center px-0 mb-4">
                              <?php echo NoCaptcha::renderJs(); ?>

                              <?php echo NoCaptcha::display(); ?>

                        </div>
                    <?php endif; ?>
                    <button type="submit"><?php echo e(__('sign_up')); ?></button>
                    <div class="middle-content">
                        <p><?php echo e(__('already_have_an_account')); ?> <a href="<?php echo e(route('site.login.form')); ?>"><?php echo e(__('login')); ?></a></p> 
                    </div>
                </form>
                <div class="widget-social">
                    <ul class="global-list">
                        <?php if(settingHelper('facebook_visibility') == 1): ?>
                            <li class="facebook login"><a href="<?php echo e(url('/login/facebook')); ?>" style="background:#056ED8"><span style="background:#0061C2"><i class="fa fa-facebook" aria-hidden="true"></i></span><?php echo e(__('sign_up_with_facebook')); ?> </a></li>
                        <?php endif; ?>
                        <?php if(settingHelper('google_visibility') == 1): ?>
                            <li class="google login"><a href="<?php echo e(url('/login/google')); ?>" style="background:#FF5733"><span style="background:#CD543A"><i class="fa fa-google" aria-hidden="true"></i></span><?php echo e(__('sign_up_with_google')); ?></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                
            </div>
            
        </div> 
    </div> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if(defaultModeCheck() == 'sg-dark'): ?>
        <script type="text/javascript">
            jQuery(function($){
                $('.g-recaptcha').attr('data-theme', 'dark');
            });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pharmashots\resources\views/site/auth/register.blade.php ENDPATH**/ ?>