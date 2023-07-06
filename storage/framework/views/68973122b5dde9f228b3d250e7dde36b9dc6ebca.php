<?php $__env->startSection('settings'); ?>
    aria-expanded="true"
<?php $__env->stopSection(); ?>
<?php $__env->startSection('s-show'); ?>
    show
<?php $__env->stopSection(); ?>
<?php $__env->startSection('settings_active'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('setting-general'); ?>
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

            
            <input type="hidden" name="url" id="url" value="<?php echo e(url('/')); ?>">

            <div class="row clearfix">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="add-new-page  bg-white p-0 m-b-20">

                                <nav>
                                    <div class="nav m-b-20 setting-tab" id="nav-tab" role="tablist">

                                        <a class="nav-item nav-link active" id="general-settings"
                                           href="<?php echo e(route('setting-general')); ?>"
                                           role="tab"><?php echo e(__('general_settings')); ?></a>
                                        <a class="nav-item nav-link" id="contact-settings"
                                           href="<?php echo e(route('setting-company')); ?>"
                                           role="tab"><?php echo e(__('company_informations')); ?></a>
                                        <a class="nav-item nav-link" id="mail-settings"
                                           href="<?php echo e(route('setting-email')); ?>" role="tab"><?php echo e(__('email_settings')); ?></a>
                                        <a class="nav-item nav-link" id="storage-settings"
                                           href="<?php echo e(route('setting-storage')); ?>"
                                           role="tab"><?php echo e(__('storage_settings')); ?></a>
                                        <a class="nav-item nav-link" id="seo-settings" href="<?php echo e(route('setting-seo')); ?>"
                                           role="tab"><?php echo e(__('seo_settings')); ?></a>
                                        <a class="nav-item nav-link" id="recaptcha-settings"
                                           href="<?php echo e(route('setting-recaptcha')); ?>"
                                           role="tab"><?php echo e(__('recaptcha_settings')); ?></a>
                                        <a class="nav-item nav-link" id="setting-url" href="<?php echo e(route('settings-url')); ?>"
                                           role="tab"><?php echo e(__('url_settings')); ?></a>
                                        <a class="nav-item nav-link" id="setting-ffmpeg"
                                           href="<?php echo e(route('settings-ffmpeg')); ?>" role="tab"><?php echo e(__('ffmpeg_settings')); ?></a>

                                        <a class="nav-item nav-link" id="setting-custom"
                                           href="<?php echo e(route('setting-custom-header-footer')); ?>"><?php echo e(__('custom_header_footer')); ?></a>
                                        <a class="nav-item nav-link" id="cron-information"
                                           href="<?php echo e(route('cron-information')); ?>"><?php echo e(__('cron_information')); ?></a>
                                        <a class="nav-item nav-link" id="preference-control"
                                           href="<?php echo e(route('preferene-control')); ?>"><?php echo e(__('preference_setting')); ?></a>
                                        <a class="nav-item nav-link" id="setting-social-login"
                                           href="<?php echo e(route('setting-social-login')); ?>"><?php echo e(__('social_login_settings')); ?></a>   
                                           <a class="nav-item nav-link" id="update-database"
                                           href="<?php echo e(route('update-database')); ?>"><?php echo e(__('update')); ?></a>
                                    </div>
                                </nav>


                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="general_settings" role="tabpanel">
                                        <?php echo Form::open(['route' => 'update-settings', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'update-settings']); ?>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="settings_language"><?php echo e(__('default_language')); ?></label>
                                                <select class="form-control" name="default_language"
                                                        id="settings_language">
                                                    <?php $__currentLoopData = $activeLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if(settingHelper('default_language')==$lang->code): ?> Selected
                                                            <?php endif; ?> value="<?php echo e($lang->code); ?>"><?php echo e($lang->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="timezone"
                                                       class="col-form-label"><?php echo e(__('timezone')); ?></label>
                                                <?php
                                                    $selected = settingHelper('timezone');
                                                    $placeholder = 'Select a timezone';
                                                    $formAttributes = array('class' => 'form-control', 'name' => 'timezone');
                                                    $optionAttributes = array('customValue' => 'true');
                                                ?>
                                                <?php echo Timezone::selectForm($selected, $placeholder, $formAttributes, $optionAttributes); ?>

                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="logo" class="upload-file-btn btn btn-primary"><i
                                                        class="fa fa-folder input-file"
                                                        aria-hidden="true"></i> <?php echo e(__('add_logo')); ?></label>
                                                <input id="logo" name="logo" onChange="swapImage(this)" data-index="0"
                                                       type="file" class="form-control d-none" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group text-center">
                                                <?php if(settingHelper('logo') != Null): ?>
                                                    <img src="<?php echo e(static_asset(settingHelper('logo'))); ?>" data-index="0"
                                                         height="64" width="auto" alt="img">
                                                <?php else: ?>
                                                    <img src="<?php echo e(static_asset('default-image/default-100x100.png')); ?>" height="64"
                                                         width="auto" data-index="0" alt="user" class="img-responsive ">
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="favicon" class="upload-file-btn btn btn-primary"><i
                                                        class="fa fa-folder input-file"
                                                        aria-hidden="true"></i> <?php echo e(__('add_favicon')); ?></label>

                                                <input id="favicon" name="favicon" onChange="swapImage(this)"
                                                       data-index="1" type="file" class="form-control d-none"
                                                       accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group text-center">
                                                <?php if(settingHelper('favicon') != Null): ?>
                                                    <img src="<?php echo e(static_asset(settingHelper('favicon'))); ?>" data-index="1"
                                                         height="64" width="auto" alt="img">
                                                <?php else: ?>
                                                    <img src="<?php echo e(static_asset('default-image/default-100x100.png')); ?>" height="64"
                                                         width="auto" data-index="1" alt="user" class="img-responsive ">
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 m-t-20">
                                                <div class="form-group form-float form-group-sm text-right">
                                                    <button type="submit" name="status"
                                                            class="btn btn-primary pull-right"><i
                                                            class="m-r-10 mdi mdi-content-save-all"></i><?php echo e(__('save_changes')); ?>

                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php echo e(Form::close()); ?>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--  tab end -->
                </div>
            </div>
            <!-- right sidebar end -->
        </div>
    </div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Setting/Providers/../Resources/views/general.blade.php ENDPATH**/ ?>