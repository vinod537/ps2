<?php $__env->startSection('users_management'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('users_management_'); ?>
    aria-expanded="true"
<?php $__env->stopSection(); ?>
<?php $__env->startSection('u-show'); ?>
    show
<?php $__env->stopSection(); ?>
<?php $__env->startSection('user-create'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modal'); ?>
    <?php echo $__env->make('gallery::image-gallery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            <?php echo Form::open(['route' => 'user-store','method' => 'post', 'enctype'=>'multipart/form-data']); ?>


            <?php echo csrf_field(); ?>
            <div class="row clearfix">
                <div class="col-12">
                    <div class="row">
                        <!-- Main Content section start -->
                        <div class="col-12 col-lg-6">
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2><?php echo e(__('add_user')); ?></h2>
                                </div>
                                <?php if(session('error')): ?>
                                    <div id="error_m" class="alert alert-danger">
                                        <?php echo e(session('error')); ?>

                                    </div>
                                <?php endif; ?>
                                <?php if(session('success')): ?>
                                    <div id="success_m" class="alert alert-success">
                                        <?php echo e(session('success')); ?>

                                    </div>
                                <?php endif; ?>
                                <?php if($errors->any()): ?>
                                    <div class="alert alert-danger">
                                        <ul>
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="first_name"
                                                   class="col-form-label"><?php echo e(__('first_name')); ?> *</label>
                                            <input id="first_name" name="first_name" value="<?php echo e(old('first_name')); ?>"
                                                   type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="last_name" class="col-form-label"><?php echo e(__('last_name')); ?>  *</label>
                                            <input id="last_name" name="last_name" value="<?php echo e(old('last_name')); ?>"
                                                   type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email" class="col-form-label"><?php echo e(__('email')); ?>  *</label>
                                            <input id="email" name="email" type="email" value="<?php echo e(old('email')); ?>"
                                                   class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone" class="col-form-label"><?php echo e(__('phone')); ?>  *</label>
                                            <input id="phone" name="phone" type="phone" value="<?php echo e(old('phone')); ?>"
                                                   class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="dob" class="col-form-label"><?php echo e(__('dob')); ?>  *</label>
                                            <input id="dob" name="dob" type="date" max="<?php echo e(date("Y-m-d")); ?>"
                                                   pattern="\d{4}-\d{2}-\d{2}" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="gender" class="col-form-label"><?php echo e(__('gender')); ?>  *</label>
                                            <select class="form-control" id="gender" name="gender" >
                                                <option><?php echo e(__('select_option')); ?></option>
                                                <?php $__currentLoopData = __('genders.genderType'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($value); ?>"><?php echo e($item); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="user_role"><?php echo e(__('role')); ?>  *</label>
                                            <select class="form-control" id="user_role" name="user_role" required>
                                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <option value="<?php echo e($role->slug); ?>"><?php echo e($role->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="password" class="col-form-label"><?php echo e(__('password')); ?>  *</label>
                                            <input id="password" name="password" value="<?php echo e(old('password')); ?>"
                                                   type="password" class="form-control"
                                                   data-parsley-minlength="6"
                                                   data-parsley-required
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="password_confirmation"
                                                   class="col-form-label"><?php echo e(__('password_confirmation')); ?>  *</label>
                                            <input id="password_confirmation" name="password_confirmation"
                                                   value="<?php echo e(old('password_confirmation')); ?>" type="password"
                                                   class="form-control"
                                                   data-parsley-equalto="#password"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="profile_image" class="upload-file-btn btn btn-primary"><i
                                                    class="fa fa-folder input-file"
                                                    aria-hidden="true"></i> <?php echo e(__('select_image')); ?></label>
                                            <input id="profile_image" name="profile_image" onChange="swapImage(this)" data-index="0"
                                                   type="file" class="form-control d-none" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-group text-center">
                                                <img src="<?php echo e(static_asset('default-image/user.jpg')); ?> " data-index="0"
                                                     width="200" height="200" alt="image"
                                                     class="img-responsive img-thumbnail">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 m-t-20">
                                        <div class="form-group form-float form-group-sm text-right">
                                            <button type="submit" name="status" value="1"
                                                    class="btn btn-primary pull-right"><i
                                                    class="m-r-10 mdi mdi-account-plus"></i><?php echo e(__('add_user')); ?>

                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Main Content section end -->
                    </div>
                </div>
            </div>
        <?php echo e(Form::close()); ?>

        <!-- page info end-->
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/User/Providers/../Resources/views/add-user.blade.php ENDPATH**/ ?>