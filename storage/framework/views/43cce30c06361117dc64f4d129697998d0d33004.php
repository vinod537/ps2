<?php $__env->startSection('settings'); ?>
    aria-expanded="true"
<?php $__env->stopSection(); ?>
<?php $__env->startSection('s-show'); ?>
    show
<?php $__env->stopSection(); ?>
<?php $__env->startSection('settings_active'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('setting-company'); ?>
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

                                        <a class="nav-item nav-link" id="general-settings"
                                           href="<?php echo e(route('setting-general')); ?>"
                                           role="tab"><?php echo e(__('general_settings')); ?></a>
                                        <a class="nav-item nav-link active" id="contact-settings"
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
                                    <!--  another tab content -->
                                    <div class="tab-pane fade show active" id="contact-settings" role="tabpanel">
                                        <?php echo Form::open(['route' => 'update-settings', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'update-settings']); ?>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="settings_language"><?php echo e(__('language')); ?></label>
                                                <select class="form-control" name="company_language"
                                                        id="company_language">
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
                                                <label for="application_name"
                                                       class="col-form-label"><?php echo e(__('application_name')); ?></label>
                                                <input id="application_name" name="application_name"
                                                       value="<?php echo e(settingHelper('application_name')); ?>" type="text"
                                                       class="form-control" placeholder="Spagreen">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="address" class="col-form-label"><?php echo e(__('address')); ?></label>
                                                <input id="address" name="address"
                                                       value="<?php echo e(settingHelper('address')); ?>" type="text"
                                                       class="form-control"
                                                       placeholder="Lower Pacific Heights San Francisco">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="email" class="col-form-label"><?php echo e(__('email')); ?></label>
                                                <input id="email" name="email" type="email"
                                                       value="<?php echo e(settingHelper('email')); ?>" class="form-control"
                                                       placeholder="edward_test@domain.com">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="phone" class="col-form-label"><?php echo e(__('phone')); ?></label>
                                                <input id="phone" name="phone" value="<?php echo e(settingHelper('phone')); ?>"
                                                       type="text" class="form-control" placeholder="(541) 754-3010">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="zip_code"
                                                       class="col-form-label"><?php echo e(__('zip_code')); ?></label>
                                                <input id="zip_code" name="zip_code"
                                                       value="<?php echo e(settingHelper('zip_code')); ?>" type="text"
                                                       class="form-control" placeholder="1207">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="city" class="col-form-label"><?php echo e(__('city')); ?></label>
                                                <input id="city" name="city" value="<?php echo e(settingHelper('city')); ?>"
                                                       type="text" class="form-control" placeholder="1207">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="state" class="col-form-label"><?php echo e(__('state')); ?></label>
                                                <input id="state" name="state" value="<?php echo e(settingHelper('state')); ?>"
                                                       type="text" class="form-control" placeholder="State">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="country" class="col-form-label"><?php echo e(__('country')); ?></label>
                                                <select class="form-control" name="country" id="country">
                                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php if(settingHelper('country')==$country->name->common): ?> Selected
                                                            <?php endif; ?>
                                                            value="<?php echo e($country->name->common); ?>">
                                                            <?php echo e($country->name->common); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="website" class="col-form-label"><?php echo e(__('website')); ?></label>
                                                <input id="website" name="website"
                                                       value="<?php echo e(settingHelper('website')); ?>" type="text"
                                                       class="form-control" placeholder="Website">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="company_registration"
                                                       class="col-form-label"><?php echo e(__('company_registration')); ?></label>
                                                <input id="company_registration" name="company_registration"
                                                       value="<?php echo e(settingHelper('company_registration')); ?>" type="text"
                                                       class="form-control" placeholder="Company Registration">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="tax_number"
                                                       class="col-form-label"><?php echo e(__('tax_number')); ?></label>
                                                <input id="tax_number" name="tax_number"
                                                       value="<?php echo e(settingHelper('tax_number')); ?>" type="text"
                                                       class="form-control" placeholder="Tax Number">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="seo_meta_description"
                                                       class="col-form-label"><?php echo e(__('about_site')); ?></label>
                                                <textarea id="about_us_description" class="form-control"
                                                          name="about_us_description"><?php echo e(settingHelper('about_us_description')); ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="copyright_text"
                                                       class="col-form-label"><?php echo e(__('copyright_text')); ?></label>
                                                <input id="copyright_text" name="copyright_text"
                                                       value="<?php echo e(settingHelper('copyright_text')); ?>" type="text"
                                                       class="form-control" placeholder="<?php echo e(__('copyright_text')); ?>">
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
                                    <!-- single tab content end -->
                                </div>
                            </div>

                        </div>
                    </div>

                    <!--  tab end -->
                </div>
            </div>
            <!-- Main Content Section End -->
        </div>
    </div>

    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Setting/Providers/../Resources/views/company_information.blade.php ENDPATH**/ ?>