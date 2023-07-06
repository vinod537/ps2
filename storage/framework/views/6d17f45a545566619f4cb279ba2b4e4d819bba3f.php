<!-- ============================================================== -->
<!-- navbar -->
<!-- ============================================================== -->
<div class="dashboard-header">
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <?php if(Sentinel::getUser()->roles[0]->name != 'User' && Sentinel::getUser()->roles[0]->name != 'Subscriber'): ?>

            <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>">
            <img src="https://www.pharmashots.com/public/images/20211124174718_logo_6.png" alt="" sizes="" srcset="" style=" width: 233px; ">
            </a>

            <?php else: ?>

            <a class="navbar-brand" href="<?php echo e(route('user-account')); ?>"><?php echo e(settingHelper('application_name')); ?></a>

            <?php endif; ?>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right-top">
                    <li class="nav-item" >
                        <a class="nav-link" href="<?php echo e(url('/')); ?>" target="_blank"><i class="fas fa-globe"></i></a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link" href="<?php echo e(url('/')); ?>/Newsletter/public/" target="_blank">Newsletter</a>
                    </li>
                    <?php if(Sentinel::getUser()->roles[0]->name != 'User' && Sentinel::getUser()->roles[0]->name != 'Subscriber'): ?>
                    <li class="nav-item dropdown connection">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-language"></i>  </a>
                        <ul class="dropdown-menu dropdown-menu-right connection-dropdown">
                            <li class="connection-list">
                                <div class="row">
                                    <?php $__currentLoopData = $activeLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 align-center">
                                            <a href="<?php echo e(route('switch-language',['code'=> $lang->code])); ?>" class="connection-item <?php if(App::getLocale()== $lang->code): ?> active  <?php endif; ?>"><i class="fa-3x <?php echo e($lang->icon_class); ?>"></i> <span><?php echo e($lang->name); ?></span></a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <li class="nav-item dropdown nav-user">
                        <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <?php if(profile_exist(Sentinel::getUser()->profile_image) && Sentinel::getUser()->profile_image!=null): ?>
                                <img src="<?php echo e(static_asset(Sentinel::getUser()->profile_image)); ?>" class="user-avatar-md rounded-circle"   alt="<?php echo e(Sentinel::getUser()->first_name); ?>"  >
                            <?php else: ?>
                                <img src="<?php echo e(static_asset('default-image/user.jpg')); ?> "  class="user-avatar-md rounded-circle"  alt="<?php echo e(Sentinel::getUser()->first_name); ?>" >
                            <?php endif; ?>

                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo e(Sentinel::getUser() ? Sentinel::getUser()->first_name.' '.Sentinel::getUser()->last_name : ''); ?></h5>
                                </div>
                                <a class="dropdown-item" href="<?php echo e(route('user-account')); ?>"><i class="fas fa-user mr-2"></i><?php echo e(__('profile')); ?></a>
                                <a class="dropdown-item" href="<?php echo e(route('site.logout')); ?>"><i class="fas fa-power-off mr-2"></i><?php echo e(__('logout')); ?></a>

                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->
<?php /**PATH /var/www/html/Modules/Common/Providers/../Resources/views/layouts/header.blade.php ENDPATH**/ ?>