<?php $__env->startSection('sections'); ?>
    active
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
                <div class="row clearfix">
                    <div class="col-12">
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
                            <!-- Main Content section start -->
                            <div class="col-12 col-lg-5">
                                <?php echo Form::open(['route'=>'save-new-section','method' => 'post', 'id' => 'save-new-section']); ?>

                                    <div class="add-new-page  bg-white p-20 m-b-20">
                                        <div class="block-header">
                                            <h2><?php echo e(__('add_section')); ?></h2>
                                        </div>


                                        

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="type"><?php echo e(__('type')); ?></label>
                                                <select class="form-control" name="type" id="type" required>
                                                    
                                                        <option value="<?php echo e(\Modules\Appearance\Enums\ThemeSectionType::CATEGORY); ?>" selected><?php echo e(__('category')); ?></option>
                                                        <option value="<?php echo e(\Modules\Appearance\Enums\ThemeSectionType::VIDEO); ?>"><?php echo e(__('videos')); ?></option>
                                                        <option value="<?php echo e(\Modules\Appearance\Enums\ThemeSectionType::LATEST_POST); ?>"><?php echo e(__('latest_post')); ?></option>
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-12" id="category-area">
                                            <div class="form-group">
                                                <label for="category_id"><?php echo e(__('category')); ?></label>
                                                <select class="form-control" name="category_id" id="category_id" required>
                                                    <option value=""><?php echo e(__('select_category')); ?></option>
                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="category-order" class="col-form-label"><?php echo e(__('order')); ?></label>
                                                <input id="category-order" value="1" name="order" type="number" class="form-control">
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
                                                    <input type="radio" name="status" id="status_yes" value="1" checked class="custom-control-input">
                                                    <span class="custom-control-label"><?php echo e(__('active')); ?></span>
                                                </label>
                                            </div>
                                            <div class="col-3 col-md-2">
                                                <label class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" name="status" id="status_no" value="0" class="custom-control-input">
                                                    <span class="custom-control-label"><?php echo e(__('inactive')); ?></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row p-l-15" id="section-style">
                                            <div class="col-12 col-md-12">
                                                <div class="form-title">
                                                    <label for="section_style"><?php echo e(__('section_style')); ?></label>
                                                </div>
                                            </div>
                                            <div class="row p-l-15">
                                                <div class="col-12 col-md-4">
                                                    <div class="section_section_style">
                                                        <label class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" name="section_style" id="section_section_style_1" value="style_1" checked class="custom-control-input">
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                        <img src="<?php echo e(static_asset('default-image/Section/Section_1.png')); ?>" alt="" class="img-responsive cat-block-img">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="section_section_style">
                                                        <label class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" name="section_style" id="section_section_style_2" value="style_2" class="custom-control-input">
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                        <img src="<?php echo e(static_asset('default-image/Section/Section_2.png')); ?>" alt="" class="img-responsive cat-block-img">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="section_section_style">
                                                        <label class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" name="section_style" id="section_section_style_3" value="style_3" class="custom-control-input">
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                        <img src="<?php echo e(static_asset('default-image/Section/Section_3.png')); ?>" alt="" class="img-responsive cat-block-img">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="section_section_style">
                                                        <label class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" name="section_style" id="section_section_style_4" value="style_4" class="custom-control-input">
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                        <img src="<?php echo e(static_asset('default-image/Section/Section_4.png')); ?>" alt="" class="img-responsive cat-block-img">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="section_section_style">
                                                        <label class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" name="section_style" id="section_section_style_5" value="style_5" class="custom-control-input">
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                        <img src="<?php echo e(static_asset('default-image/Section/Section_5.png')); ?>" alt="" class="img-responsive cat-block-img">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12" id="ad-area">
                                                <div class="form-group">
                                                    <label for="language"><?php echo e(__('show_ad_in_bottom')); ?>?</label>
                                                    <select class="form-control" name="ad" id="ad">
                                                        <option value=""><?php echo e(__('none')); ?></option>
                                                        <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($ad->id); ?>"><?php echo e($ad->ad_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 m-t-20">
                                                <div class="form-group form-float form-group-sm text-right">
                                                    <button type="submit" name="btnsubmit" class="btn btn-primary pull-right"><i class="m-r-10 mdi mdi-plus"></i><?php echo e(__('add_section')); ?></button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <?php echo Form::close(); ?>

                                </div>
                            <!-- Main Content section end -->

                            <!-- right sidebar start -->
                            <div class="col-12 col-lg-7">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="add-new-page  bg-white p-20 m-b-20">
                                            <div class="block-header m-b-20">
                                                <h2><?php echo e(__('primary_section')); ?></h2>
                                            </div>
                                            <?php echo Form::open(['route'=>'update-primary-section','method' => 'post']); ?>

                                                <div class="row p-l-15">

                                                    <div class="col-12 col-md-4">
                                                        <div class="primary_section_style">
                                                            <label class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" name="primary_section_style" id="primary_section_style_1" value="style_1" <?php if($primarySection->section_style == "style_1"): ?> checked="" <?php endif; ?> class="custom-control-input">
                                                                <span class="custom-control-label"></span>
                                                            </label>
                                                            <img src="<?php echo e(static_asset('default-image/primary_section/Style_1.png')); ?>" alt="image" class="img-responsive cat-block-img">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="primary_section_style">
                                                            <label class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" name="primary_section_style" id="primary_section_style_2" value="style_2" <?php if($primarySection->section_style == "style_2"): ?> checked="" <?php endif; ?> class="custom-control-input">
                                                                <span class="custom-control-label"></span>
                                                            </label>
                                                            <img src="<?php echo e(static_asset('default-image/primary_section/Style_2.png')); ?>" alt="image" class="img-responsive cat-block-img">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="primary_section_style">
                                                            <label class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" name="primary_section_style" id="primary_section_style_3" value="style_3" <?php if($primarySection->section_style == "style_3"): ?> checked="" <?php endif; ?> class="custom-control-input">
                                                                <span class="custom-control-label"></span>
                                                            </label>
                                                            <img src="<?php echo e(static_asset('default-image/primary_section/Style_3.png')); ?>" alt="image" class="img-responsive cat-block-img">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="primary_section_style">
                                                            <label class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" name="primary_section_style" id="primary_section_style_none" value="" <?php if($primarySection->section_style == null): ?> checked="" <?php endif; ?> class="custom-control-input">
                                                                <span class="custom-control-label"></span>
                                                            </label>
                                                            <span><?php echo e(__('none')); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 m-t-20">
                                                        <div class="form-group form-float form-group-sm text-right">
                                                            <button type="submit" name="btnsubmit" class="btn btn-primary pull-right"><i class="m-r-10 mdi mdi-content-save-all"></i><?php echo e(__('update_section')); ?></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php echo Form::close(); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="add-new-page  bg-white p-20 m-b-20">
                                            <div class="block-header m-b-20">
                                            <h2><?php echo e(__('sections')); ?></h2>
                                            </div>
                                            <div class="table-responsive all-pages">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr role="row">
                                                            <th><?php echo e(__('section_label')); ?></th>
                                                            <th><?php echo e(__('status')); ?></th>
                                                            <th><?php echo e(__('show_ad_in_bottom')); ?></th>
                                                            <th><?php echo e(__('order')); ?></th>
                                                            <th><?php echo e(__('section_style')); ?></th>
                                                            <?php if(Sentinel::getUser()->hasAccess(['theme_section_write']) || Sentinel::getUser()->hasAccess(['theme_section_delete'])): ?>
                                                            <th><?php echo e(__('options')); ?></th>
                                                            <?php endif; ?>
                                                        </tr>
                                                    </thead>
                                                    
                                                    <tbody>
                                                        <form action="<?php echo e(route('update-section-order')); ?>" method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <input type="hidden" name="sections[]" value="<?php echo e($section->id); ?>">
                                                            <tr role="row" class="odd" id="row_<?php echo e($section->id); ?>">
                                                                <td><?php echo e($section->type == 1? $section->label: __($section->label)); ?></td>
                                                                <td>
                                                                    <?php if($section->status == 1): ?>
                                                                        <label class="label label-success label-table"><?php echo e(__('active')); ?></label>
                                                                    <?php else: ?>
                                                                        <label class="label label-default label-table"><?php echo e(__('inactive')); ?></i></label>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td><?php echo e($section->ad->ad_name ?? __('none')); ?></td>
                                                                <td><input type="number" name="orders[<?php echo e($section->id); ?>]" class="form-control" value="<?php echo e($section->order); ?>"></td>
                                                                <td><?php echo e($section->section_style); ?></td>
                                                                <?php if(Sentinel::getUser()->hasAccess(['theme_section_write']) || Sentinel::getUser()->hasAccess(['theme_section_delete'])): ?>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <button class="btn bg-primary dropdown-toggle btn-select-option" type="button" data-toggle="dropdown">...
                                                                                <span class="caret"></span>
                                                                            </button>
                                                                            <ul class="dropdown-menu options-dropdown">
                                                                                <?php if(Sentinel::getUser()->hasAccess(['theme_section_write'])): ?>
                                                                                    <li>
                                                                                        <a href="<?php echo e(route('edit-theme-section',['id'=>$section->id])); ?>"><i class="fa fa-edit option-icon"></i><?php echo e(__('edit')); ?></a>
                                                                                    </li>
                                                                                <?php endif; ?>
                                                                                <?php if(Sentinel::getUser()->hasAccess(['theme_section_delete'])): ?>
                                                                                    <li>
                                                                                        <a href="javascript:void(0)" onclick="delete_item('theme_sections','<?php echo e($section->id); ?>')"><i class="fa fa-trash option-icon"></i><?php echo e(__('delete')); ?></a>
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
                                                <div class="row mb-3">
                                                    <div class="col-12 m-t-20">
                                                        <div class="form-group form-float form-group-sm text-right">
                                                            <button type="submit" name="btnsubmit" class="btn btn-primary pull-right"><i class="m-r-10 mdi mdi-content-save-all"></i><?php echo e(__('update')); ?></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="block-header">
                                                        <h2><?php echo e(__('showing')); ?> <?php echo e($sections->firstItem()); ?> <?php echo e(__('to')); ?> <?php echo e($sections->lastItem()); ?>

                                                            of <?php echo e($sections->total()); ?> <?php echo e(__('entries')); ?></h2>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 text-right">
                                                    <div class="table-info-pagination float-right">
                                                        <nav aria-label="Page navigation example">
                                                            <?php echo $sections->render(); ?>

                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- right sidebar end -->
                        </div>
                    </div>
                </div>
            <!-- page info end-->
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Appearance/Providers/../Resources/views/theme_section.blade.php ENDPATH**/ ?>