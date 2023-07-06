<?php $__env->startSection('social'); ?>
    active
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            <form action="#" method="post">
                <div class="admin-section">
                    <div class="row clearfix m-t-30">
                        <div class="col-12">
                            <div class="navigation-list bg-white p-20">
                                <div class="add-new-header clearfix m-b-20">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="block-header">
                                                <h2><?php echo e(__('socials')); ?></h2>
                                            </div>
                                        </div>
                                        <?php if(Sentinel::getUser()->hasAccess(['socials_write'])): ?>
                                            <div class="col-6 text-right">
                                                <a href="<?php echo e(route('create-social')); ?>"
                                                   class="btn btn-primary btn-sm btn-add-new"><i
                                                        class="mdi mdi-plus"></i>
                                                    <?php echo e(__('create_social')); ?>

                                                </a>
                                            </div>
                                        <?php endif; ?>
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
                                <div class="table-responsive all-pages">
                                    <table class="table table-bordered table-striped" role="grid">
                                        <thead>
                                        <tr role="row">
                                            <th width="20">#</th>
                                            <th><?php echo e(__('name')); ?></th>
                                            <th><?php echo e(__('url')); ?></th>
                                            <th><?php echo e(__('icon')); ?></th>
                                            <th><?php echo e(__('icon_bg_color')); ?></th>
                                            <th><?php echo e(__('text_bg_color')); ?></th>
                                            <th><?php echo e(__('status')); ?></th>
                                            <?php if(Sentinel::getUser()->hasAccess(['socials_write']) || Sentinel::getUser()->hasAccess(['socials_delete'])): ?>
                                                <th><?php echo e(__('options')); ?></th>
                                            <?php endif; ?>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $socialMedias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialMedia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr id="row_<?php echo e($socialMedia->id); ?>">
                                                <td><?php echo e($socialMedia->id); ?></td>
                                                <td><?php echo e($socialMedia->name); ?></td>
                                                <td><?php echo e($socialMedia->url); ?></td>
                                                <td><i class="<?php echo e($socialMedia->icon); ?>" aria-hidden="true"></i></td>
                                                <td><?php echo e($socialMedia->icon_bg_color); ?></td>
                                                <td><?php echo e($socialMedia->text_bg_color); ?></td>
                                                <td><?php if($socialMedia->status==1): ?> <?php echo e(__('active')); ?> <?php else: ?> <?php echo e(__('inactive')); ?> <?php endif; ?></td>

                                                <?php if(Sentinel::getUser()->hasAccess(['socials_write']) || Sentinel::getUser()->hasAccess(['socials_delete'])): ?>
                                                    <td>
                                                        <?php if(Sentinel::getUser()->hasAccess(['socials_write'])): ?>
                                                            <a class="btn btn-light active btn-xs"
                                                               href="<?php echo e(route('social-edit',['id'=>$socialMedia->id])); ?>"><i
                                                                    class="fa fa-edit"></i>
                                                                <?php echo e(__('edit')); ?>

                                                            </a>
                                                        <?php endif; ?>
                                                        <?php if(Sentinel::getUser()->hasAccess(['socials_delete'])): ?>
                                                            <a href="javascript:void(0)"
                                                               class="btn btn-light active btn-xs"
                                                               onclick="delete_item('social_media','<?php echo e($socialMedia->id); ?>')"><i
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
                                            <h2><?php echo e(__('Showing')); ?> <?php echo e($socialMedias->firstItem()); ?> <?php echo e(__('to')); ?> <?php echo e($socialMedias->lastItem()); ?> <?php echo e(__('of')); ?> <?php echo e($socialMedias->total()); ?> <?php echo e(__('entries')); ?></h2>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 text-right">
                                        <div class="table-info-pagination float-right">
                                            <?php echo $socialMedias->render(); ?>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- page info end-->
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Social/Providers/../Resources/views/socials.blade.php ENDPATH**/ ?>