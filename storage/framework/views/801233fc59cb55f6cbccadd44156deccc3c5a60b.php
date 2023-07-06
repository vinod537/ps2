<?php $__env->startSection('post-aria-expanded'); ?>
    aria-expanded="true"
<?php $__env->stopSection(); ?>
<?php $__env->startSection('post-show'); ?>
    show
<?php $__env->stopSection(); ?>
<?php $__env->startSection('post'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pending-post-active'); ?>
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
                                                <h2><?php echo e(__('pending_posts')); ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive all-pages"> 
                                <!-- Table Filter -->
                                    <table class="table table-bordered table-striped" role="grid">
                                        <thead>
                                        <tr role="row">
                                            
                                            <th width="20">#</th>
                                            <th><?php echo e(__('post')); ?></th>
                                            <th><?php echo e(__('language')); ?></th>
                                            <th><?php echo e(__('post_type')); ?></th>
                                            <th><?php echo e(__('category')); ?></th>
                                            <th><?php echo e(__('post_by')); ?></th>
                                            <th><?php echo e(__('visibility')); ?></th>
                                            <th><?php echo e(__('view')); ?></th>
                                            <th><?php echo e(__('schedule')); ?></th>
                                            <th><?php echo e(__('added_date')); ?></th>
                                            <?php if(Sentinel::getUser()->hasAccess(['post_write'])): ?>
                                                <th><?php echo e(__('options')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr id="row_<?php echo e($post->id); ?>">
                                                
                                                <td><?php echo e($post->id); ?></td>
                                                <td>
                                                    <div class="post-image">
                                                        <?php if(isFileExist(@$post->image, $result = @$post->image->thumbnail)): ?>
                                                            <img
                                                                src=" <?php echo e(basePath($post->image)); ?>/<?php echo e($result); ?> "
                                                                data-src="<?php echo e(basePath($post->image)); ?>/<?php echo e($result); ?>"
                                                                alt="image" class="img-responsive img-thumbnail lazyloaded">

                                                        <?php else: ?>
                                                            <img src="<?php echo e(static_asset('default-image/default-100x100.png')); ?> " width="200"
                                                                 height="200" alt="image"
                                                                 class="img-responsive img-thumbnail">
                                                        <?php endif; ?>
                                                    </div> <?php echo e($post->title); ?> </td>
                                                <td><?php echo e($post->language); ?> </td>
                                                <td class="td-post-type"><?php echo e($post->post_type); ?></td>
                                                <td>
                                                    <label class="category-label m-r-5 label-table"
                                                        id="breaking-post-bgc">
                                                        <?php echo e(@$post->category->category_name); ?> </label>

                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="table-user-link">
                                                        <strong>
                                                            <?php
                                                                $roles=Sentinel::findById($post->user_id)->roles->first();
                                                            ?>
                                                            <?php echo e($roles->name); ?>

                                                        </strong>
                                                    </a>
                                                </td>
                                                <td class="td-post-sp">
                                                    <?php if($post->visibility==1): ?>
                                                        <label class="label label-success label-table"><i
                                                                class="fa fa-eye"></i></label>
                                                    <?php else: ?>
                                                        <label class="label label-default label-table"><i
                                                                class="fa fa-eye-slash"></i></label>
                                                    <?php endif; ?>
                                                    <?php if($post->breaking==1): ?>
                                                        <label
                                                            class="label bg-red label-table"><?php echo e(__('breaking')); ?></label>
                                                    <?php endif; ?>
                                                    <?php if($post->featured==1): ?>
                                                        <label
                                                            class="label bg-warning label-table"><?php echo e(__('featured')); ?></label>
                                                    <?php endif; ?>
                                                    <?php if($post->recommended==1): ?>
                                                        <label
                                                            class="label bg-aqua label-table"><?php echo e(__('recommended')); ?></label>
                                                    <?php endif; ?>
                                                    <?php if($post->editor_picks==1): ?>
                                                    <label class="label bg-teal label-table"><?php echo e(__('editor_picks')); ?></label>
                                                <?php endif; ?>
                                                    <?php if($post->slider==1): ?>
                                                        <label
                                                            class="label bg-teal label-table"><?php echo e(__('slider')); ?></label>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($post->total_hit); ?></td>
                                                <td><?php echo e($post->scheduled_date); ?></td>
                                                <td><?php echo e($post->created_at); ?></td>
                                                <?php if(Sentinel::getUser()->hasAccess(['post_write'])): ?>
                                                    <td>
                                                        <a href="javascript:void(0)"
                                                           onclick="add_post_to('status','<?php echo e($post->id); ?>')"
                                                           name="option" class="btn btn-light active btn-xs">
                                                            <i class="fa fa-check option-icon"></i> <?php echo e(__('published')); ?>

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
                                            <h2><?php echo e(__('Showing')); ?> <?php echo e($posts->firstItem()); ?> <?php echo e(__('to')); ?> <?php echo e($posts->lastItem()); ?> <?php echo e(__('of')); ?> <?php echo e($posts->total()); ?> <?php echo e(__('entries')); ?></h2>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 text-right">
                                        <div class="table-info-pagination float-right">
                                            <?php echo $posts->render(); ?>


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

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Post/Providers/../Resources/views/pending_posts.blade.php ENDPATH**/ ?>