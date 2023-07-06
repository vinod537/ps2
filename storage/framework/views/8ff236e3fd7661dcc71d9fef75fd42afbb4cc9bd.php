<?php $__env->startSection('ads-aria-expanded'); ?>
    aria-expanded="true"
<?php $__env->stopSection(); ?>
<?php $__env->startSection('ads-show'); ?>
    show
<?php $__env->stopSection(); ?>
<?php $__env->startSection('ad_location'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('ads_active'); ?>
    active
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            <?php echo Form::open(['route' => 'location-update','method' => 'put', 'enctype'=>'multipart/form-data']); ?>

            <div class="admin-section">
                <div class="row clearfix m-t-30">
                    <div class="col-12">
                        <div class="navigation-list bg-white p-20">
                            <div class="add-new-header clearfix m-b-20">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="block-header">
                                            <h2><?php echo e(__('ads_location')); ?></h2>
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
                            <div class="table-responsive all-pages">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th><?php echo e(__('title')); ?></th>
                                        <th><?php echo e(__('unique_name')); ?></th>
                                        <th><?php echo e(__('ads')); ?></th>
                                        <th><?php echo e(__('status')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $adLocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adLocation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr role="row" id="row_<?php echo e($adLocation->id); ?>" class="odd">
                                            <td class="sorting_1"><?php echo e($adLocation->id); ?></td>
                                            <td><?php echo e($adLocation->title); ?></td>
                                            <td><?php echo e($adLocation->unique_name); ?></td>
                                            <td>
                                                <input name="ad_location_id[]" type="hidden" value="<?php echo e($adLocation->id); ?>">
                                                <select class="form-control" name="ad_id[]">
                                                    <option value=""><?php echo e(__('select_option')); ?></option>
                                                    <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if($ad->id==$adLocation->ad_id): ?> selected <?php endif; ?> value="<?php echo e($ad->id); ?>"><?php echo e($ad->ad_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" name="status[]">
                                                    <option <?php if($adLocation->status==1): ?> selected <?php endif; ?> value="1"><?php echo e(__('enable')); ?></option>
                                                    <option <?php if($adLocation->status==0): ?> selected <?php endif; ?> value="0"><?php echo e(__('disable')); ?></option>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <div class="pull-right p-t-10">
                                    <button type="submit" class="btn btn-primary"><?php echo e(__('update')); ?></button>
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

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Ads/Providers/../Resources/views/ad_location.blade.php ENDPATH**/ ?>