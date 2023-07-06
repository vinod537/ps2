<?php $__env->startSection('post-aria-expanded'); ?>
    aria-expanded="true"
<?php $__env->stopSection(); ?>
<?php $__env->startSection('post-show'); ?>
    show
<?php $__env->stopSection(); ?>
<?php $__env->startSection('post'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('daily-post-active'); ?>
    active
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            <?php echo Form::open(['route'=>'update-daily-order','method' => 'post','enctype'=>'multipart/form-data']); ?>

            <div class="admin-section">
                <div class="row clearfix m-t-30">
                    <div class="col-12">
                        <div class="navigation-list bg-white p-20">
                            <div class="add-new-header clearfix m-b-20">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="block-header">
                                            <h2><?php echo e(__('daily_posts')); ?></h2>
                                        </div>
                                    </div>
                                    <div class="col-12">
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
                                        <th><?php echo e(__('post_by')); ?></th>
                                        <th><?php echo e(__('visibility')); ?></th>
                                        <th><?php echo e(__('order')); ?></th>
                                        <th><?php echo e(__('view')); ?></th>
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
                                                </div> 
                                                <a href="<?php if($post->old_id): ?> <?php echo e(route('article.detail', [$post->old_id, $post->slug])); ?> <?php else: ?> <?php echo e(route('article.detail', [$post->id, $post->slug])); ?> <?php endif; ?>"><?php echo e($post->title); ?> </a> </td>
                                            <td><?php echo e($post->language); ?> </td>
                                            <td class="td-post-type"><?php echo e($post->post_type); ?></td>
                                            
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
                                                    <label class="label bg-red label-table"><?php echo e(__('breaking')); ?></label>
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
                                                    <label
                                                        class="label bg-success label-table"><?php echo e(__('editor_picks')); ?></label>
                                                <?php endif; ?>
                                                <?php if($post->slider==1): ?>
                                                    <label class="label bg-teal label-table"><?php echo e(__('slider')); ?></label>
                                                <?php endif; ?>

                                                <?php if($post->top_20==1): ?>
                                                    <label class="label bg-teal label-table"><?php echo e(__('top_20')); ?></label>
                                                <?php endif; ?>

                                                <?php if($post->daily_news==1): ?>
                                                    <label class="label bg-teal label-table"><?php echo e(__('daily_news')); ?></label>
                                                <?php endif; ?>

                                                <?php if($post->viewpoint==1): ?>
                                                    <label class="label bg-teal label-table"><?php echo e(__('viewpoint')); ?></label>
                                                <?php endif; ?>

                                                <?php if($post->events==1): ?>
                                                    <label class="label bg-teal label-table"><?php echo e(__('events')); ?></label>
                                                <?php endif; ?>

                                                <?php if($post->advertisement==1): ?>
                                                    <label class="label bg-teal label-table"><?php echo e(__('advertisement')); ?></label>
                                                <?php endif; ?>
                                            </td>
                                            <td width="10%">
                                                <input type="number" class="form-control btn btn-light" name="order[]"
                                                       value="<?php echo e($post->daily_order); ?>">
                                                <input type="hidden" class="btn btn-light" name="post_id[]"
                                                       value="<?php echo e($post->id); ?>">
                                            </td>
                                            <td><?php echo e($post->total_hit); ?></td>
                                            <td><?php echo e($post->created_at); ?></td>
                                            <?php if(Sentinel::getUser()->hasAccess(['post_write'])): ?>
                                                <td>
                                                    <a href="javascript:void(0)"
                                                       onclick="remove_post_form('other','daily_news','<?php echo e($post->id); ?>')"
                                                       name="option" class="btn btn-light active btn-xs">
                                                        <i class="fa fa-minus option-icon"></i><?php echo e(__('remove')); ?> </a>
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
                        <?php if(Sentinel::getUser()->hasAccess(['post_write']) && $posts->count() > 0): ?>
                            <button type="submit" name="btnSubmit" class="btn btn-primary pull-right"><i
                                    class="m-r-10 mdi mdi-content-save-all"></i><?php echo e(__('update_order')); ?></button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php echo Form::close(); ?>

        <!-- page info end-->
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Post/Providers/../Resources/views/daily_posts.blade.php ENDPATH**/ ?>