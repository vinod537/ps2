<?php $__env->startSection('gallery-aria-expanded'); ?>
    aria-expanded="true"
<?php $__env->stopSection(); ?>
<?php $__env->startSection('gallery-show'); ?>
    show
<?php $__env->stopSection(); ?>
<?php $__env->startSection('gallery'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('app-intro'); ?>
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
                            <?php echo Form::open(['route'=>'add-album','method' => 'post', 'enctype' => "multipart/form-data"]); ?>

                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2><?php echo e(__('add_album')); ?></h2>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="language"><?php echo e(__('select_language')); ?> *</label>
                                        <select class="form-control" name="language" id="language">
                                            <?php $__currentLoopData = $activeLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option
                                                    <?php if(App::getLocale()==$lang->code): ?> Selected
                                                    <?php endif; ?> value="<?php echo e($lang->code); ?>"><?php echo e($lang->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label"><?php echo e(__('album_name')); ?>

                                            *</label>
                                        <input id="name" name="name" type="text" class="form-control"
                                               required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="album-slug" class="col-form-label"><b><?php echo e(__('slug')); ?></b>
                                            (<?php echo e(__('slug_message')); ?>)</label>
                                        <input id="album-slug" name="slug" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_tags" class="col-form-label"><?php echo e(__('tabs')); ?> (<?php echo e(__('hit_enter')); ?>)</label>
                                        <input id="post_tags" name="tabs" type="text" value=""
                                               data-role="tagsinput" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="album-desc" class="col-form-label"><b><?php echo e(__('description')); ?></b>
                                            (<?php echo e(__('meta_tag')); ?>)</label>
                                        <input id="album-desc" name="meta_description" type="text"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="album-keywords"
                                               class="col-form-label"><b><?php echo e(__('keywords')); ?></b> (<?php echo e(__('meta_tag')); ?>)</label>
                                        <input id="album-keywords" name="meta_keywords" type="text"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="field" align="left">
                                        <label for="images" class="upload-file-btn btn btn-primary"><i
                                                class="fa fa-folder input-file"
                                                aria-hidden="true"></i> <?php echo e(__('select_cover_image')); ?> *
                                        </label><br>
                                        <input type="file" id="images" class="d-none " name="cover_image" required
                                               />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 m-t-20">
                                        <div class="form-group form-float form-group-sm text-right">
                                            <button type="submit" name="btnsubmit" class="btn btn-primary pull-right"><i
                                                    class="m-r-10 mdi mdi-plus"></i><?php echo e(__('add_album')); ?></button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php echo Form::close(); ?>

                        </div>
                        <!-- Main Content section end -->

                        <!-- right sidebar start -->
                        <div class="col-12 col-lg-7">
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header m-b-20">
                                    <h2><?php echo e(__('albums')); ?></h2>
                                </div>
                                <div class="table-responsive all-pages">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr role="row">
                                            <th>#</th>
                                            <th><?php echo e(__('album_name')); ?></th>
                                            <th><?php echo e(__('language')); ?></th>
                                            <th><?php echo e(__('tabs')); ?></th>
                                            <th><?php echo e(__('cover_image')); ?></th>
                                            <?php if(Sentinel::getUser()->hasAccess(['album_write']) || Sentinel::getUser()->hasAccess(['album_delete'])): ?>
                                                <th><?php echo e(__('options')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr role="row" class="odd" id="row_<?php echo e($album->id); ?>">
                                                <td class="sorting_1"><?php echo e($key+1); ?></td>
                                                <td><?php echo e($album->name); ?></td>
                                                <td><?php echo e($album->language); ?></td>
                                                <td class="text-capitalize"><?php echo e($album->tabs); ?></td>
                                                <td>
                                                    <div class="post-image">
                                                        <?php if(isFileExist(@$album, $result = @$album->thumbnail)): ?>
                                                            <img
                                                                src=" <?php echo e(basePath($album)); ?>/<?php echo e($result); ?> "
                                                                data-src="<?php echo e(basePath($album)); ?>/<?php echo e($result); ?>"
                                                                alt="image" class="img-responsive img-thumbnail lazyloaded">

                                                        <?php else: ?>
                                                            <img src="<?php echo e(static_asset('default-image/default-100x100.png')); ?> " width="200"
                                                                 height="200" alt="image"
                                                                 class="img-responsive img-thumbnail">
                                                        <?php endif; ?>
                                                </td>
                                                <?php if(Sentinel::getUser()->hasAccess(['album_write']) || Sentinel::getUser()->hasAccess(['album_delete'])): ?>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn bg-primary dropdown-toggle btn-select-option"
                                                                type="button" data-toggle="dropdown">...
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu options-dropdown">
                                                                <?php if(Sentinel::getUser()->hasAccess(['album_write'])): ?>
                                                                    <li>
                                                                        <a href="<?php echo e(route('edit-album',['id'=>$album->id])); ?>"><i
                                                                                class="fa fa-edit option-icon"></i><?php echo e(__('edit')); ?>

                                                                        </a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if(Sentinel::getUser()->hasAccess(['album_delete'])): ?>
                                                                    <li>
                                                                        <a href="javascript:void(0)"
                                                                           onclick="delete_item('albums','<?php echo e($album->id); ?>')"><i
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
                                            <h2><?php echo e(__('showing')); ?> <?php echo e($albums->firstItem()); ?> <?php echo e(__('to')); ?> <?php echo e($albums->lastItem()); ?>

                                                of <?php echo e($albums->total()); ?> <?php echo e(__('entries')); ?></h2>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 text-right">
                                        <div class="table-info-pagination float-right">
                                            <nav aria-label="Page navigation example">
                                                <?php echo $albums->render(); ?>

                                            </nav>
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

    <?php $__env->startSection('script'); ?>
        <script src="<?php echo e(static_asset('js/tagsinput.js')); ?>"></script>
        <script src="<?php echo e(static_asset('js/tagsinput.js')); ?>"></script>
    <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Gallery/Providers/../Resources/views/albums.blade.php ENDPATH**/ ?>