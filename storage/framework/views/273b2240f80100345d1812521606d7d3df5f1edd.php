<?php $__env->startSection('comments-show'); ?>
    show
<?php $__env->stopSection(); ?>

<?php $__env->startSection('comments'); ?>
    active
<?php $__env->stopSection(); ?>

<?php $__env->startSection('comments_active'); ?>
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
                                                <h2><?php echo e(__('comments')); ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive all-pages">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr role="row">
                                            <th>#</th>
                                            <th><?php echo e(__('name')); ?></th>
                                            <th><?php echo e(__('email')); ?></th>
                                            <th><?php echo e(__('post')); ?></th>
                                            <th><?php echo e(__('comment')); ?></th>
                                            <th><?php echo e(__('comment_at')); ?></th>
                                            <?php if(Sentinel::getUser()->hasAccess(['comments_delete'])): ?>
                                                <th><?php echo e(__('options')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr role="row" id="row_<?php echo e($comment->id); ?>" class="odd">
                                                <td class="sorting_1"><?php echo e($comment->id); ?></td>
                                                <td><?php echo e($comment->user->first_name); ?></td>
                                                <td><?php echo e($comment->user->email); ?></td>
                                                <td><?php echo e($comment->post->title); ?></td>
                                                <td> <?php echo e($comment->comment); ?> </td>
                                                <td>
                                                    <?php if($comment->created_at != null): ?>
                                                        <?php echo e(Carbon\Carbon::parse($comment->created_at)->toDayDateTimeString()); ?>

                                                    <?php endif; ?>
                                                </td>

                                                <?php if(Sentinel::getUser()->hasAccess(['comments_delete'])): ?>
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn btn-light active btn-xs"
                                                           onclick="delete_item('comments','<?php echo e($comment->id); ?>')"><i
                                                                class="fa fa-trash"></i>
                                                            <?php echo e(__('delete')); ?>

                                                        </a>
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
                                            <h2><?php echo e(__('Showing')); ?> <?php echo e($comments->firstItem()); ?> <?php echo e(__('to')); ?> <?php echo e($comments->lastItem()); ?> <?php echo e(__('of')); ?> <?php echo e($comments->total()); ?> <?php echo e(__('entries')); ?></h2>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 text-right">
                                        <div class="table-info-pagination float-right">
                                            <?php echo $comments->render(); ?>

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

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Post/Providers/../Resources/views/comments.blade.php ENDPATH**/ ?>