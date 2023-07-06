<?php $__env->startSection('language-setting'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
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

            <div class="row clearfix">
                <div class="col-12">
                    <div class="row">
                        <!-- Main Content section start -->
                        <div class="col-12 col-lg-5">
                            <?php echo Form::open(['route' => 'set-default-language', 'method' => 'post']); ?>


                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2><?php echo e(__('default_language')); ?></h2>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="language"><?php echo e(__('language')); ?></label>
                                        <select class="form-control" name="default_language" id="language">
                                            <?php $__currentLoopData = $activeLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option
                                                    <?php if(settingHelper('default_language')==$lang->code): ?> Selected
                                                    <?php endif; ?> value="<?php echo e($lang->code); ?>"><?php echo e($lang->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 m-t-20">
                                        <div class="form-group form-float form-group-sm text-right">
                                            <button type="submit" name="status" value="1" class="btn btn-primary pull-right">
                                                <i class="m-r-10 mdi mdi-content-save-all"></i><?php echo e(__('save_changes')); ?>

                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>


                            <?php if(Sentinel::getUser()->hasAccess(['language_settings_write'])): ?>
                                <div class="add-new-page  bg-white p-20 m-b-20">
                                    <div class="block-header">
                                        <div>
                                        <span class="text-warning"><?php echo e(__('please_make_sure_you_have_set_writable_permision_following_folder')); ?></span>
                                        </div>
                                        <strong><span>./resources/lang</span></strong>

                                        <h2><?php echo e(__('add_language')); ?></h2>
                                    </div>
                                    <?php echo Form::open(['route' => 'add-new-language', 'method' => 'post']); ?>


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name" class="col-form-label"><?php echo e(__('language_name')); ?>*</label>
                                            <input id="name" name="name" type="text" value="<?php echo e(old('name')); ?>"
                                                   class="form-control" placeholder="<?php echo e(__('language_name')); ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="code" class="col-form-label"><?php echo e(__('short_form')); ?>*</label>
                                            <input id="code" name="code" type="text" value="<?php echo e(old('code')); ?>"
                                                   class="form-control" placeholder="en" maxlength='5' minlength='2'
                                                   required>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="icon_class" class="col-form-label"><?php echo e(__('flag')); ?>*</label>
                                            <select name="icon_class" class="form-control selectpicker text-uppercase"
                                                    required>
                                                <option value=""> <?php echo e(__('select_option')); ?></option>
                                                <?php $__currentLoopData = $flagIcons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($icon->icon_class); ?>"
                                                            data-icon="<?php echo e($icon->icon_class); ?>"
                                                            class=""> <?php echo e($icon->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="script" class="col-form-label"><?php echo e(__('script')); ?></label>
                                            <input id="script" name="script" type="text" value="<?php echo e(old('script')); ?>"
                                                   class="form-control" placeholder="Latn">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="native" class="col-form-label"><?php echo e(__('native')); ?></label>
                                            <input id="native" name="native" type="text" value="<?php echo e(old('native')); ?>"
                                                   class="form-control" placeholder="English">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="regional" class="col-form-label"><?php echo e(__('regional')); ?></label>
                                            <input id="regional" name="regional" type="text"
                                                   value="<?php echo e(old('regional')); ?>" class="form-control"
                                                   placeholder="en_GB">
                                        </div>
                                    </div>

                                    <div class="row p-l-15">
                                        <div class="col-12 col-md-4">
                                            <div class="form-title">
                                                <label for="text_direction"><?php echo e(__('text_direction')); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-3 col-md-2">
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="text_direction"
                                                       id="text_direction_left_to_right" value="LTR"
                                                       class="custom-control-input" checked="checked">
                                                <span class="custom-control-label"><?php echo e(__('ltr')); ?></span>
                                            </label>
                                        </div>
                                        <div class="col-3 col-md-2">
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="text_direction"
                                                       id="text_direction_right_to_left" value="RTL"
                                                       class="custom-control-input">
                                                <span class="custom-control-label"><?php echo e(__('rtl')); ?></span>
                                            </label>
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
                                                <input type="radio" name="status" id="status_active" value="active"
                                                       class="custom-control-input" checked="checked">
                                                <span class="custom-control-label"><?php echo e(__('active')); ?></span>
                                            </label>
                                        </div>
                                        <div class="col-3 col-md-2">
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="status" id="status_inactive" value="inactive"
                                                       class="custom-control-input">
                                                <span class="custom-control-label"><?php echo e(__('inactive')); ?></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 m-t-20">
                                            <div class="form-group form-float form-group-sm text-right">
                                                <button type="submit"
                                                        class="btn btn-primary pull-right"><i
                                                        class="m-r-10 mdi mdi-plus"></i><?php echo e(__('add_language')); ?>

                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo e(Form::close()); ?>


                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- Main Content section end -->

                        <!-- right sidebar start -->
                        <div class="col-12 col-lg-7">
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header m-b-20">
                                    <h2><?php echo e(__('languages')); ?></h2>
                                </div>
                                <div class="table-responsive all-pages m-t-20">
                                    <table class="table table-bordered table-striped dataTable no-footer"
                                           id="cs_datatable" role="grid" aria-describedby="cs_datatable_info">
                                        <thead>
                                            <tr role="row">
                                                <th><?php echo e(__('language_name')); ?></th>
                                                <th><?php echo e(__('code')); ?></th>
                                                <th><?php echo e(__('status')); ?></th>
                                                <?php if(Sentinel::getUser()->hasAccess(['language_settings_write']) || Sentinel::getUser()->hasAccess(['language_settings_delete'])): ?>
                                                    <th><?php echo e(__('options')); ?></th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr role="row" class="odd" id="row_<?php echo e($lang->id); ?>">
                                                    <td><i class="<?php echo e($lang->icon_class); ?>"></i> <?php echo e($lang->name); ?>&nbsp;</td>
                                                    <td><?php echo e($lang->code); ?></td>
                                                    <td><label
                                                            class="label <?php if($lang->status=='active'): ?> label-success <?php else: ?> label-danger  <?php endif; ?> lbl-lang-status"><?php echo e($lang->status); ?></label>
                                                    </td>
                                                    <?php if(Sentinel::getUser()->hasAccess(['language_settings_write']) || Sentinel::getUser()->hasAccess(['language_settings_delete'])): ?>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button
                                                                    class="btn bg-primary dropdown-toggle btn-select-option"
                                                                    type="button" data-toggle="dropdown"
                                                                    aria-expanded="false"><?php echo e(__('...')); ?> <span
                                                                        class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu options-dropdown">
                                                                    <?php if(Sentinel::getUser()->hasAccess(['language_settings_write'])): ?>
                                                                        <li>
                                                                            <a href="<?php echo e(route('edit-language-info',['id'=>$lang->id])); ?>"><i
                                                                                    class="fa fa-edit option-icon"></i><?php echo e(__('edit')); ?>

                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="<?php echo e(route('edit-phrase-list',['id'=>$lang->id])); ?>"><i
                                                                                    class="fa fa-edit option-icon"></i><?php echo e(__('edit_phrase')); ?>

                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="<?php echo e(route('edit-default-messages',['id'=>$lang->id])); ?>"><i
                                                                                    class="fa fa-edit option-icon"></i><?php echo e(__('default_messages')); ?>

                                                                            </a>
                                                                        </li>
                                                                    <?php endif; ?>

                                                                    <?php if(Sentinel::getUser()->hasAccess(['language_settings_delete'])): ?>
                                                                        <li>
                                                                            <a href="javascript:void(0)"
                                                                               onclick="delete_language('<?php echo e($lang->id); ?>')"><i
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
                                            <h2><?php echo e(__('showing')); ?> <?php echo e($languages->firstItem()); ?> <?php echo e(__('to')); ?> <?php echo e($languages->lastItem()); ?>

                                                of <?php echo e($languages->total()); ?> <?php echo e(__('entries')); ?></h2>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 text-right">
                                        <div class="table-info-pagination float-right">
                                            <nav aria-label="Page navigation example">
                                                <?php echo $languages->render(); ?>

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
    <script type="text/javascript">
        function delete_language(row_id) {
            var table_row = '#row_' + row_id
            var token = "<?php echo e(csrf_token()); ?>";
            url = "<?php echo e(route('language-delete')); ?>"
            swal({
                title: 'Are you sure?',
                text: "It will be deleted permanently!",
                icon: "warning",
                buttons: true,
                buttons: ["Cancel", "Delete"],
                dangerMode: true,
                closeOnClickOutside: false
            })
                .then(function (confirmed) {
                    if (confirmed) {
                        $.ajax({
                            url: url,
                            type: 'delete',
                            data: {"_token": token, "id": row_id},
                            dataType: 'json'
                        })
                            .done(function (response) {
                                swal.stopLoading();
                                if (response.status == "success") {
                                    swal("Deleted!", response.message, response.status);
                                    $(table_row).fadeOut(2000);
                                } else {
                                    swal("Error!", response.message, response.status);
                                }
                            })
                            .fail(function () {
                                swal('Oops...', 'Something went wrong with ajax !', 'error');
                            })
                    }
                })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Language/Providers/../Resources/views/index.blade.php ENDPATH**/ ?>