<?php $__env->startSection('social'); ?>
    active
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
    <?php echo $__env->make('gallery::image-gallery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            <?php echo Form::open(['route'=>'store-social','method' => 'post', 'enctype'=>'multipart/form-data']); ?>


            <div class="row clearfix">
                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">
                        <div class="add-new-header clearfix">
                            <div class="row">
                                <div class="col-6">
                                    <div class="block-header">
                                        <h2><?php echo e(__('create_social')); ?></h2>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="<?php echo e(route('socials')); ?>" class="btn btn-primary btn-add-new btn-sm"><i
                                            class="fas fa-arrow-left"></i>
                                        <?php echo e(__('back_to_socials')); ?>

                                    </a>
                                </div>
                            </div>
                        </div>
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
                </div>
                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">

                        <div class="block-header">
                            <div class="form-group">
                                <h4 class="border-bottom"><?php echo e(__('social_details')); ?></h4>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="name" class="col-form-label"><?php echo e(__('name')); ?></label>
                                <input id="name" value="<?php echo e(old('name')); ?>" name="name" type="text" class="form-control"
                                       required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="url" class="col-form-label"><?php echo e(__('url')); ?></label>
                                <input id="url" name="url" value="<?php echo e(old('url')); ?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="page-title" class="col-form-label"><?php echo e(__('icon')); ?>

                                    (<?php echo e(__('use_class_of_font_awesome_icon')); ?>) <a class="text-primary"
                                                                                  href="https://fontawesome.com/"><?php echo e(__('click_me_to_visit_site')); ?></a>
                                </label>
                                <input id="page-title" value="<?php echo e(old('icon')); ?>" name="icon" type="text"
                                       class="form-control" required placeholder="e.g. fa fa-facebook">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="page-title" class="col-form-label"><?php echo e(__('icon_bg_color')); ?></label>
                                <input id="page-title" value="<?php echo e(old('icon_bg_color')); ?>" name="icon_bg_color"
                                       type="color" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="page-title" class="col-form-label"><?php echo e(__('text_bg_color')); ?></label>
                                <input id="page-title" value="<?php echo e(old('text_bg_color')); ?>" name="text_bg_color"
                                       type="color" class="form-control" required>
                            </div>
                        </div>

                        <div class="row p-l-15">
                            <div class="col-12 col-md-4">
                                <div class="form-title">
                                    <label for="status"><?php echo e(__('status')); ?></label>
                                </div>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="status" id="status_yes" value="1" checked
                                           class="custom-control-input">
                                    <span class="custom-control-label"><?php echo e(__('active')); ?></span>
                                </label>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="status" id="status_no" value="0"
                                           class="custom-control-input">
                                    <span class="custom-control-label"><?php echo e(__('inactive')); ?></span>
                                </label>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <div class="form-group form-float form-group-sm">
                                    <button type="submit" class="btn btn-primary float-right m-t-20"><i
                                            class="mdi mdi-plus"></i> <?php echo e(__('create_social')); ?></button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <?php echo e(Form::close()); ?>

        <!-- page info end-->
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Social/Providers/../Resources/views/social_create.blade.php ENDPATH**/ ?>