<!-- msater layout -->

<!-- active menu -->
<?php $__env->startSection('widgets'); ?>
    active
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            <?php echo Form::open(['route' => ['update-widget',$widget->id],'method' => 'put', 'enctype'=>'multipart/form-data']); ?>

            <div class="row clearfix">
                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">
                        <div class="add-new-header clearfix">
                            <div class="row">
                                <div class="col-6">
                                    <div class="block-header">
                                        <h2><?php echo e(__('update_widget')); ?></h2>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="<?php echo e(route('widgets')); ?>" class="btn btn-primary btn-add-new btn-sm"><i
                                            class="fas fa-arrow-left"></i>
                                        <?php echo e(__('back_to_widgets')); ?>

                                    </a>
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
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="widget_title" class="col-form-label"><?php echo e(__('title')); ?>*</label>
                                <input id="widget_title" name="title" value="<?php echo e($widget->title); ?>" type="text"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="language"><?php echo e(__('language')); ?></label>
                                <select class="form-control" name="language" id="language">
                                    <?php $__currentLoopData = $activeLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            <?php if($widget->language==$lang->code): ?> Selected
                                            <?php endif; ?> value="<?php echo e($lang->code); ?>"><?php echo e($lang->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="language"><?php echo e(__('location')); ?></label>
                                <select class="form-control" name="location" id="location">
                                    <?php $__currentLoopData = __('widget::widget.location'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value); ?>"
                                                <?php if($widget->location == $value): ?> Selected <?php endif; ?>><?php echo e($item); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="language"><?php echo e(__('Content Type')); ?></label>
                                <select
                                    class="form-control <?php echo e($widget->location == \Modules\Widget\Enums\WidgetLocation::RIGHT_SIDEBAR? '':'d-none'); ?>"
                                    name="content_type" id="content_type">
                                    <?php $__currentLoopData = __('widget::widget.content_type'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value); ?>"
                                                <?php if($widget->content_type == $value): ?> Selected <?php endif; ?>><?php echo e($item); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <select
                                    class="form-control <?php echo e($widget->location == \Modules\Widget\Enums\WidgetLocation::FOOTER? '':'d-none'); ?>"
                                    name="content_type_footer" id="content_type_footer">
                                    <?php $__currentLoopData = __('widget::widget.content_type_footer'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value); ?>"
                                                <?php if($widget->content_type == $value): ?> Selected <?php endif; ?>><?php echo e($item); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <select
                                    class="form-control <?php echo e($widget->location == \Modules\Widget\Enums\WidgetLocation::HEADER? '':'d-none'); ?>"
                                    name="content_type_header" id="content_type_header">
                                    <?php $__currentLoopData = __('widget::widget.content_type_header'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value); ?>"
                                                <?php if($widget->content_type == $value): ?> Selected <?php endif; ?>><?php echo e($item); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 d-none" id="addBlocekerDetected">
                            <div class="form-group">
                                <label for="widget-order" class="col-form-label alert-danger">Please Unblock the
                                    adBlocker</label>
                            </div>
                        </div>
                        <div class="col-sm-12 <?php echo e($widget->content_type == \Modules\Widget\Enums\WidgetContentType::TAGS? '':'d-none'); ?>" id="tags_container">
                            <div class="form-group">
                                <label for="widget_title" class="col-form-label"><?php echo e(__('tags')); ?>*</label>
                                <input id="widget_title" name="tags" type="text" class="form-control" data-role="tagsinput" value="<?php echo e($widget->content); ?>">
                            </div>
                        </div>
                        <div
                            class="col-sm-12 <?php echo e($widget->content_type == \Modules\Widget\Enums\WidgetContentType::AD? '':'d-none'); ?>"
                            id="ad-area">
                            <div class="form-group">
                                <label for="language"><?php echo e(__('ad')); ?></label>
                                <select class="form-control" name="ad" id="ad">
                                    <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($ad->id); ?>"><?php echo e($ad->ad_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div
                            class="col-sm-12 <?php echo e($widget->content_type == \Modules\Widget\Enums\WidgetContentType::VOTING_POLL? '':'d-none'); ?>"
                            id="poll-area">
                            <div class="form-group">
                                <label for="language"><?php echo e(__('poll')); ?></label>
                                <select class="form-control" name="poll" id="poll">
                                    <?php $__currentLoopData = $polls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $poll): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($poll->id); ?>" <?php echo e($widget->poll_id == $poll->id? 'selected':''); ?>><?php echo e($poll->question); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="widget-order" class="col-form-label"><?php echo e(__('order')); ?></label>
                                <input id="widget-order" name="order" value="<?php echo e($widget->order); ?>" type="number"
                                       value="1" class="form-control">
                            </div>
                        </div>
                    <?php if(($widget->is_custom==1)): ?>
                        <!-- tinemcey start -->
                            <div
                                class="row p-l-15 <?php echo e(($widget->content_type != \Modules\Widget\Enums\WidgetContentType::CUSTOM) ? 'd-none':''); ?>"
                                id="content_container">
                                <div class="col-12 form-group">
                                    <label for="content" class="col-form-label"><?php echo e(__('content')); ?></label>
                                    <textarea id="content" name="content" cols="30"
                                              rows="5"><?php echo $widget->content; ?></textarea>
                                </div>
                            </div>
                            <!-- tinemcey end -->
                        <?php endif; ?>

                        <div class="row p-l-15">
                            <div class="col-12 col-md-4">
                                <div class="form-title">
                                    <label for="status"><?php echo e(__('status')); ?></label>
                                </div>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="status" value="1" <?php if($widget->status==1): ?> checked=""
                                           <?php endif; ?> class="custom-control-input">
                                    <span class="custom-control-label"><?php echo e(__('show')); ?></span>
                                </label>
                            </div>
                            <div class="col-3 col-md-2">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="status" value="0" <?php if($widget->status==0): ?> checked=""
                                           <?php endif; ?> class="custom-control-input">
                                    <span class="custom-control-label"><?php echo e(__('hide')); ?></span>
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group form-float form-group-sm">
                                    <button type="submit" class="btn btn-primary float-right m-t-20"><i
                                            class="m-r-10 mdi mdi-content-save-all"></i><?php echo e(__('update_widget')); ?>

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php echo Form::close(); ?>

        <!-- page info end-->
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('include_js'); ?>
    <script>
        $(document).ready(function () {
            $('#content_type').change(function () {
                let contentType = $(this).val();
                if (contentType == <?php echo e(\Modules\Widget\Enums\WidgetContentType::CUSTOM); ?>) {
                    $('#content_container').removeClass('d-none');
                } else {
                    $('#content_container').addClass('d-none');
                    tinymce.get('content').setContent('');
                }
            });


            $('#content_type').change(function () {
                let contentType = $(this).val();
                if (contentType == <?php echo e(\Modules\Widget\Enums\WidgetContentType::TAGS); ?>) {
                    $('#tags_container').removeClass('d-none');
                    $('#tags_container').removeClass('d-none');
                } else {
                    $('#tags_container').addClass('d-none');
                }
            });

            $('#location').change(function () {
                let location = $(this).val();
                if (location == <?php echo e(\Modules\Widget\Enums\WidgetLocation::RIGHT_SIDEBAR); ?>) {

                    if($('#content_type').val() == <?php echo e(\Modules\Widget\Enums\WidgetContentType::VOTING_POLL); ?>){
                        $('#poll-area').removeClass('d-none');
                    }

                    $('#content_type').removeClass('d-none');
                    $('#content_type_header').addClass('d-none');
                    $('#content_type_footer').addClass('d-none');
                    $('#ad-area').addClass('d-none');
                } else if (location == <?php echo e(\Modules\Widget\Enums\WidgetLocation::FOOTER); ?>) {
                    $('#content_type').addClass('d-none');
                    $('#content_type_header').addClass('d-none');
                    $('#content_type_footer').removeClass('d-none');
                    $('#ad-area').addClass('d-none');
                    $('#poll-area').addClass('d-none');
                } else {
                    $('#content_type').addClass('d-none');
                    $('#content_type_header').removeClass('d-none');
                    $('#content_type_footer').addClass('d-none');
                    $('#ad-area').removeClass('d-none');
                    $('#poll-area').addClass('d-none');
                }
            });

            $('#content_type, #content_type_footer, #content_type_header').change(function () {
                let type = $(this).val();
                if (type == <?php echo e(\Modules\Widget\Enums\WidgetContentType::AD); ?>) {
                    $('#ad-area').removeClass('d-none');
                    $('#ad-area').removeClass('d-none');
                    if (window.canRunAds === undefined) {
                        $('#addBlocekerDetected').removeClass('d-none');
                    }
                    if (window.canRunAds !== undefined) {
                        $('#addBlocekerDetected').addClass('d-none');
                    }
                } else {
                    $('#ad-area').addClass('d-none');
                    $('#addBlocekerDetected').addClass('d-none');
                }

                if (type == <?php echo e(\Modules\Widget\Enums\WidgetContentType::VOTING_POLL); ?>) {
                    $('#poll-area').removeClass('d-none');
                } else {
                    $('#poll-area').addClass('d-none');
                }
                });

            

        });
    </script>
    <script src="<?php echo e(static_asset('js/tagsinput.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Widget/Providers/../Resources/views/edit.blade.php ENDPATH**/ ?>