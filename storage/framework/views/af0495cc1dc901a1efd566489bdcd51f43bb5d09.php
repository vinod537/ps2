<!-- msater layout -->

<!-- active menu -->
<?php $__env->startSection('widgets'); ?>
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
                                <div class="row">
                                    <div class="block-header col-6">
                                        <h2><?php echo e(__('widgets')); ?></h2>
                                    </div>
                                    
                                    <div class="col-6 text-right">
                                        <a href="<?php echo e(route('create-widget')); ?>" class="btn btn-primary btn-sm"><i
                                                class="m-r-10 mdi mdi-plus"></i><?php echo e(__('add_widget')); ?></a>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="table-responsive all-pages">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th><?php echo e(__('title')); ?></th>
                                        <th><?php echo e(__('content_type')); ?></th>
                                        <th><?php echo e(__('language')); ?></th>
                                        <th><?php echo e(__('location')); ?></th>
                                        <th><?php echo e(__('order')); ?></th>
                                        <th><?php echo e(__('type')); ?></th>
                                        <th><?php echo e(__('status')); ?></th>
                                        <th><?php echo e(__('added_date')); ?></th>
                                        <?php if(Sentinel::getUser()->hasAccess(['widget_write']) || Sentinel::getUser()->hasAccess(['widget_delete'])): ?>
                                            <th><?php echo e(__('options')); ?></th>
                                        <?php endif; ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $widgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr role="row" id="row_<?php echo e($widget->id); ?>" class="odd">
                                            <td class="sorting_1"><?php echo e($widget->id); ?></td>
                                            <td><?php echo e($widget->title); ?></td>
                                            <td>
                                                <?php if($widget->content_type == Modules\Widget\Enums\WidgetContentType::POPULAR_POST): ?>
                                                    <?php echo e('Popular Posts'); ?>

                                                <?php elseif($widget->content_type == Modules\Widget\Enums\WidgetContentType::TAGS): ?>
                                                    <?php echo e('Tags'); ?>

                                                <?php elseif($widget->content_type == Modules\Widget\Enums\WidgetContentType::CUSTOM): ?>
                                                    <?php echo e('Custom'); ?>

                                                <?php elseif($widget->content_type == Modules\Widget\Enums\WidgetContentType::NEWS_LETTER): ?>
                                                    <?php echo e('News Letter'); ?>

                                                <?php elseif($widget->content_type == Modules\Widget\Enums\WidgetContentType::RECENT_POST): ?>
                                                    <?php echo e('Recent Posts'); ?>

                                                <?php elseif($widget->content_type == Modules\Widget\Enums\WidgetContentType::RECOMMENDED_POSTS): ?>
                                                    <?php echo e('Recommended Posts'); ?>

                                                <?php elseif($widget->content_type == Modules\Widget\Enums\WidgetContentType::VOTING_POLL): ?>
                                                    <?php echo e('Voting Poll'); ?>

                                                <?php elseif($widget->content_type == Modules\Widget\Enums\WidgetContentType::AD): ?>
                                                    <?php echo e('Ad'); ?>

                                                 <?php elseif($widget->content_type == Modules\Widget\Enums\WidgetContentType::CATEGORIES): ?>
                                                    <?php echo e('Categories'); ?>

                                                <?php elseif($widget->content_type == Modules\Widget\Enums\WidgetContentType::EDITORS_PICKS): ?>
                                                    <?php echo e('Editor Picks'); ?>

                                                <?php elseif($widget->content_type == Modules\Widget\Enums\WidgetContentType::FEATURED_POST): ?>
                                                    <?php echo e('Featured Posts'); ?>


                                                <?php elseif($widget->content_type == Modules\Widget\Enums\WidgetContentType::FOLLOW_US): ?>
                                                    <?php echo e('Follow Us'); ?>

                                                <?php elseif($widget->content_type == Modules\Widget\Enums\WidgetContentType::ARCHIVE): ?>
                                                    <?php echo e('Archive'); ?>

                                                <?php elseif($widget->content_type == Modules\Widget\Enums\WidgetContentType::QUIZ): ?>
                                                    <?php echo e('Quiz'); ?>

                                                <?php endif; ?>

                                            </td>
                                            <td><?php echo e($widget->language); ?></td>
                                            <td>
                                                <?php if($widget->location ==  \Modules\Widget\Enums\WidgetLocation::HEADER): ?>
                                                    <?php echo e(__('header')); ?>

                                                <?php elseif($widget->location ==  \Modules\Widget\Enums\WidgetLocation::FOOTER): ?>
                                                    <?php echo e(__('footer')); ?>

                                                <?php else: ?>
                                                    <?php echo e(__('right_sidebar')); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($widget->order); ?></td>
                                            <td><?php if($widget->is_custom==1): ?> <?php echo e(__('custom')); ?> <?php else: ?> <?php echo e(__('default')); ?> <?php endif; ?></td>
                                            <td><?php if($widget->status==1): ?> <?php echo e(__('active')); ?> <?php else: ?> <?php echo e(__('inactive')); ?> <?php endif; ?></td>
                                            <td><?php echo e($widget->created_at->toDayDateTimeString()); ?></td>
                                            <?php if(Sentinel::getUser()->hasAccess(['widget_write']) || Sentinel::getUser()->hasAccess(['widget_delete'])): ?>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn bg-primary dropdown-toggle btn-select-option"
                                                                type="button" data-toggle="dropdown">... <span
                                                                class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu options-dropdown">
                                                            <?php if(Sentinel::getUser()->hasAccess(['widget_write'])): ?>
                                                                <li>
                                                                    <a href="<?php echo e(route('edit-widget',['id'=>$widget->id])); ?>"><i
                                                                            class="fa fa-edit option-icon"></i><?php echo e(__('edit')); ?>

                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>
                                                            <?php if(Sentinel::getUser()->hasAccess(['widget_delete'])): ?>
                                                                <li>
                                                                    <a href="javascript:void(0)"
                                                                       onclick="delete_item('widgets','<?php echo e($widget->id); ?>')"><i
                                                                            class="fa fa-trash option-icon"></i><?php echo e(__('delete')); ?>

                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
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
                                        <h2><?php echo e(__('Showing')); ?> <?php echo e($widgets->firstItem()); ?> <?php echo e(__('to')); ?> <?php echo e($widgets->lastItem()); ?> <?php echo e(__('of')); ?> <?php echo e($widgets->total()); ?> <?php echo e(__('entries')); ?></h2>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-right">
                                    <div class="table-info-pagination float-right">
                                        <?php echo $widgets->render(); ?>

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

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Widget/Providers/../Resources/views/widgets.blade.php ENDPATH**/ ?>