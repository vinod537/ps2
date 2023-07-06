<!-- msater layout -->

<!-- active menu -->
<?php $__env->startSection('users_management'); ?>
    active
<?php $__env->stopSection(); ?>
<!--  -->
<?php $__env->startSection('users_management_'); ?>
    aria-expanded="true"
<?php $__env->stopSection(); ?>
<?php $__env->startSection('u-show'); ?>
    show
<?php $__env->stopSection(); ?>
<?php $__env->startSection('user-list'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modal'); ?>
    <?php echo $__env->make('gallery::image-gallery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                                        <h2><?php echo e(__('users')); ?></h2>
                                    </div>
                                    <?php if(Sentinel::getUser()->hasAccess(['users_write'])): ?>
                                        <div class="col-6 text-right">
                                            <a href="<?php echo e(route('user-create')); ?>" class="btn btn-primary btn-sm"><i
                                                    class="m-r-10 mdi mdi-account-plus"></i><?php echo e(__('add_user')); ?></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="table-responsive all-pages">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr role="row">
                                            <th>#</th>
                                            <th><?php echo e(__('avatar')); ?></th>
                                            <th><?php echo e(__('name')); ?></th>
                                            <th><?php echo e(__('email')); ?></th>
                                            <th><?php echo e(__('role')); ?></th>
                                            <th><?php echo e(__('status')); ?></th>
                                            <th><?php echo e(__('About Page')); ?></th>
                                            <th><?php echo e(__('join_date')); ?></th>
                                            <?php if(Sentinel::getUser()->hasAccess(['users_read']) || Sentinel::getUser()->hasAccess(['users_write'])): ?>
                                                <th><?php echo e(__('options')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i = 0;
                                        ?>

                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php 
                                        $i ++;
                                        ?>
                                        <?php $__currentLoopData = $user->withRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($role->id != '4'): ?>

                                    
                                            <tr role="row" id="row_<?php echo e($user->id); ?>" class="odd">
                                                <td class="sorting_1"><?php 
                                                 echo  $i;
                                        ?></td>
                                                <td>
                                                    <?php if(profile_exist($user->profile_image) && $user->profile_image!=null): ?>
                                                        <img src=" <?php echo e(static_asset($user->profile_image)); ?> "
                                                            height="64" width="64" alt="<?php echo e($user->first_name); ?>"
                                                            class="img-responsive rounded-circle user-image">
                                                    <?php else: ?>
                                                        <img src="<?php echo e(static_asset('default-image/user.jpg')); ?>" height="64"
                                                             width="64" alt="<?php echo e($user->first_name); ?>" class="img-responsive rounded-circle">
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                                                    <br>
                                                    <?php if($user->social_media): ?>
                                                        <a target="_blank" href="<?php echo e($user->social_media); ?>"><i class="fa fa-linkedin" aria-hidden="true" style="
                                                            background: #00a0dc;
                                                            color: #fff;
                                                            padding: 6px;
                                                        "></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php echo e($user->email); ?>

                                                    <?php if($user->withActivation != null): ?>
                                                        <?php if($user->withActivation->completed==0): ?>
                                                            <small class="text-warning">(<?php echo e(__('unconfirmed')); ?>)</small>
                                                        <?php else: ?>
                                                            <small class="text-success">(<?php echo e(__('confirmed')); ?>)</small>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                </td>
                                                <td>
                                                    
                                                    <?php $__currentLoopData = $user->withRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <label class="label label-default"><?php echo e($role->name); ?></label>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </td>
                                                <td>
                                                <?php if($user->withActivation != null): ?>
                                                    <?php if($user->withActivation->completed==0): ?>
                                                        <label class="label btn-warning"><?php echo e(__('inactive')); ?></label>
                                                    <?php else: ?>
                                                        <?php if($user->is_user_banned == 0): ?>
                                                            <label class="label label-danger"><?php echo e(__('banned')); ?></label>
                                                        <?php else: ?>
                                                            <label class="label label-success"><?php echo e(__('active')); ?></label>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <label class="label btn-warning"><?php echo e(__('inactive')); ?></label>
                                                <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($user->status_about): ?>
                                                    <label class="label label-success"><?php echo e($user->status_about); ?></label>
                                                    <label class="label btn-warning"><?php echo e($user->order_about); ?></label>
                                                    <?php endif; ?>

                                                </td>

                                                <td><?php echo e($user->created_at->toDayDateTimeString()); ?></td>
                                                <?php if(Sentinel::getUser()->hasAccess(['users_write']) || Sentinel::getUser()->hasAccess(['users_delete'])): ?>
                                                    <td>
                                                        <?php if($user->id != 1): ?>
                                                            <div class="dropdown">
                                                                <button
                                                                    class="btn bg-primary dropdown-toggle btn-select-option"
                                                                    type="button" data-toggle="dropdown">... <span
                                                                        class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu options-dropdown">
                                                                    <?php if(Sentinel::getUser()->hasAccess(['users_write'])): ?>
                                                                        <?php if(Sentinel::getUser()->id != $user->id): ?>
                                                                        <li>
                                                                            <a href="javascript:void(0)"
                                                                               class="btn-list-button modal-menu"
                                                                               data-title="Change User Role"
                                                                               data-url="<?php echo e(route('edit-info',['page_name'=>'role-change','param1'=>$user->id,'param2'=> $user->withRoles[0]->id])); ?>"
                                                                               data-toggle="modal"
                                                                               data-target="#common-modal">
                                                                                <i class="fa fa-user option-icon"></i>
                                                                                <?php echo e(__('change_role')); ?>

                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                        <?php if($user->withActivation != null): ?>
                                                                            <?php if($user->withActivation->completed==1): ?>

                                                                                <?php if($user->is_user_banned == 1): ?>
                                                                                    <a href="<?php echo e(route('ban-user',['user_id'=> $user->id])); ?>"><i
                                                                                            class="fa fa-stop-circle option-icon"></i><?php echo e(__('ban_user')); ?>

                                                                                    </a>
                                                                                <?php else: ?>
                                                                                    <a href="<?php echo e(route('unban-user',['user_id'=> $user->id])); ?>"><i
                                                                                            class="fa fa-stop-circle option-icon"></i><?php echo e(__('unban_user')); ?>

                                                                                    </a>
                                                                                <?php endif; ?>

                                                                            <?php endif; ?>
                                                                       
                                                                        <?php endif; ?>

                                                                        </li>
                                                                        <?php endif; ?>
                                                                        <li>
                                                                            <a href="javascript:void(0)" class="modal-menu"
                                                                               data-title="Edit User Info"
                                                                               data-url="<?php echo e(route('edit-info',['page_name'=>'edit-user','param1'=>$user->id,'param2'=> $user->withRoles[0]->id])); ?>"
                                                                               data-toggle="modal"
                                                                               data-target="#common-modal"><i
                                                                                    class="fa fa-edit option-icon"></i><?php echo e(__('edit')); ?>

                                                                            </a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if(Sentinel::getUser()->hasAccess(['users_delete'])): ?>
                                                                        <li>
                                                                            <a href="javascript:void(0)"
                                                                               onclick="delete_item('users','<?php echo e($user->id); ?>')"><i
                                                                                    class="fa fa-trash option-icon"></i><?php echo e(__('delete')); ?>

                                                                            </a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                </ul>
                                                            </div>
                                                        <?php endif; ?>

                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                          
                                                
                                            <?php endif; ?>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="block-header">
                                        <h2><?php echo e(__('Showing')); ?> <?php echo e($users->firstItem()); ?> <?php echo e(__('to')); ?> <?php echo e($users->lastItem()); ?> <?php echo e(__('of')); ?> <?php echo e($users->total()); ?> <?php echo e(__('entries')); ?></h2>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-right">
                                    <div class="table-info-pagination float-right">
                                        <?php echo $users->render(); ?>


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

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/User/Providers/../Resources/views/users.blade.php ENDPATH**/ ?>