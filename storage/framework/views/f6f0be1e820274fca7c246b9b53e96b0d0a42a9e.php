<?php $__env->startSection('ads-aria-expanded'); ?>
    aria-expanded="true"
<?php $__env->stopSection(); ?>
<?php $__env->startSection('ads-show'); ?>
    show
<?php $__env->stopSection(); ?>
<?php $__env->startSection('ads'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('ads_active'); ?>
    active
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            <div class="admin-section">
                <div class="row clearfix m-t-30">
                    <div class="col-12">
                        <div class="navigation-list bg-white p-20">
                            <div class="add-new-header clearfix m-b-20">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="block-header">
                                            <h2><?php echo e(__('Ads')); ?></h2>
                                        </div>
                                    </div>
                                    <?php if(Sentinel::getUser()->hasAccess(['ads_write'])): ?>
                                        <div class="col-6 text-right">
                                            <a href="<?php echo e(route('create-ad')); ?>" class="btn btn-primary btn-sm btn-add-new"><i class="mdi mdi-plus"></i>
                                                <?php echo e(__('create_ad')); ?>

                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="table-responsive all-pages">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th><?php echo e(__('ad_name')); ?></th>
                                        <th><?php echo e(__('ad_size')); ?></th>
                                        <th><?php echo e(__('ad_type')); ?></th>
                                        <th><?php echo e(__('ad_url')); ?></th>
                                        <th><?php echo e(__('ad_image')); ?></th>
                                        <?php if(Sentinel::getUser()->hasAccess(['ads_write']) || Sentinel::getUser()->hasAccess(['ads_delete']) ): ?>
                                            <th><?php echo e(__('options')); ?></th>
                                        <?php endif; ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr role="row" id="row_<?php echo e($ad->id); ?>" class="odd">
                                            <td class="sorting_1"><?php echo e($ad->id); ?></td>
                                            <td><?php echo e($ad->ad_name); ?></td>
                                            <td><?php echo e($ad->ad_size); ?></td>
                                            <td> <?php echo e($ad->ad_type); ?> </td>
                                            <td><?php echo e($ad->ad_url); ?></td>
                                            <td>
                                                <?php if(@$ad->ad_type == 'image'): ?>
                                                    <?php if(isFileExist(@$ad->adImage, $result = @$ad->adImage->thumbnail)): ?>
                                                        <img src="<?php echo e(basePath($ad->adImage)); ?>/<?php echo e($result); ?>" data-src="<?php echo e(basePath($ad->adImage)); ?>/<?php echo e($result); ?>" alt="<?php echo e($ad->ad_name); ?>" id="image_preview"  width="64" height="64" alt="image" class="img-responsive img-thumbnail">
                                                    <?php else: ?>
                                                        <img src="<?php echo e(static_asset('default-image/default-100x100.png')); ?> "  id="image_preview"  width="64" height="64" alt="image" class="img-responsive img-thumbnail">
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <img src="<?php echo e(static_asset('default-image/default-100x100.png')); ?> "  id="image_preview"  width="64" height="64" alt="image" class="img-responsive img-thumbnail">
                                                <?php endif; ?>
                                            </td>
                                            <?php if(Sentinel::getUser()->hasAccess(['ads_write']) || Sentinel::getUser()->hasAccess(['ads_delete']) ): ?>
                                                <td>
                                                    <?php if(Sentinel::getUser()->hasAccess(['ads_write'])): ?>
                                                        <a class="btn btn-light active btn-xs" href="<?php echo e(route('edit-ad',['id'=>$ad->id])); ?>"><i class="fa fa-edit"></i>
                                                            <?php echo e(__('edit')); ?>

                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if(Sentinel::getUser()->hasAccess(['ads_delete'])): ?>
                                                        <a href="javascript:void(0)" class="btn btn-light active btn-xs"
                                                           onclick="delete_item('ads','<?php echo e($ad->id); ?>')"><i
                                                                class="fa fa-trash"></i>
                                                            <?php echo e(__('delete')); ?>

                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="block-header">
                                        <h2><?php echo e(__('Showing')); ?> <?php echo e($ads->firstItem()); ?> <?php echo e(__('to')); ?> <?php echo e($ads->lastItem()); ?> <?php echo e(__('of')); ?> <?php echo e($ads->total()); ?> <?php echo e(__('entries')); ?></h2>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-right">
                                    <div class="table-info-pagination float-right">
                                        <?php echo $ads->render(); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page info end-->
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Ads/Providers/../Resources/views/index.blade.php ENDPATH**/ ?>