<?php $__env->startSection('rolePermission_'); ?>
    aria-expanded="true"
<?php $__env->stopSection(); ?>
<?php $__env->startSection('p-show'); ?>
    show
<?php $__env->stopSection(); ?>

<?php $__env->startSection('rolePermission'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('permissions'); ?>
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
                                        <div class="row">
                                            <div class="block-header col-6">
                                                <h2><?php echo e(__('roles_&_permissions')); ?></h2>
                                            </div>
                                            <?php if(Sentinel::getUser()->hasAccess(['role_write'])): ?>
                                                <div class="col-6 text-right">
                                                    <a href="<?php echo e(route('new-role-add')); ?>" class="btn btn-primary btn-sm">
                                                        <i class="m-r-10 mdi mdi-plus"></i><?php echo e(__('add_role')); ?>

                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                    <div class="col-md-12 pt-1" id="success_m">
                                        <?php if(session('error')): ?>
                                            <div id="error_m" class="alert alert-danger">
                                                <?php echo e(session('error')); ?>

                                            </div>
                                        <?php endif; ?>
                                        <?php if(session('success')): ?>
                                            <div class="alert alert-success">
                                                <?php echo e(session('success')); ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive all-pages">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr role="row">
                                        <th><?php echo e(__('module')); ?></th>
                                        <th><?php echo e(__('role')); ?></th>
                                        <th><?php echo e(__('read')); ?></th>
                                        <th><?php echo e(__('write')); ?></th>
                                        <th><?php echo e(__('delete')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $i=0;
                                        ?>
                                        <tr>
                                            <td rowspan="<?php echo e($noOfRole); ?>">
                                                <strong><?php echo e($permission->name); ?></strong>
                                            </td>
                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <td><?php echo e($role->name); ?></td>
                                                <td>
                                                    <?php
                                                        ++$i;

                                                        $rolePermissions    = $role->permissions;
                                                        if($rolePermissions == null){
                                                            $rolePermissions = array();
                                                        }
                                                    ?>

                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                               onclick="change_item('<?php echo e($permission->name); ?>_read','<?php echo e($role->id); ?>')"
                                                               <?php if(array_key_exists($permission->name.'_read',$rolePermissions)): ?> checked
                                                               <?php endif; ?>
                                                               name="post" class="custom-control-input">

                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                               onclick="change_item('<?php echo e($permission->name); ?>_write','<?php echo e($role->id); ?>')"
                                                               <?php if(array_key_exists($permission->name.'_write',$rolePermissions)): ?> checked
                                                               <?php endif; ?>  name="post" class="custom-control-input">
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                               onclick="change_item('<?php echo e($permission->name); ?>_delete','<?php echo e($role->id); ?>')"
                                                               <?php if(array_key_exists($permission->name.'_delete',$rolePermissions)): ?> checked
                                                               <?php endif; ?>  name="post" class="custom-control-input">
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                </td>

                                        </tr>
                                        <?php if($noOfRole>$i): ?>
                                            <tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="block-header">
                                        <h2><?php echo e(__('Showing')); ?> <?php echo e($permissions->firstItem()); ?> <?php echo e(__('to')); ?> <?php echo e($permissions->lastItem()); ?> <?php echo e(__('of')); ?> <?php echo e($permissions->total()); ?> <?php echo e(__('entries')); ?></h2>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-right">
                                    <div class="table-info-pagination float-right">
                                        <?php echo $permissions->render(); ?>


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

    <script>

        function change_item(permission_name, role_id) {
            var token = "<?php echo e(csrf_token()); ?>";
            url = "<?php echo e(route('change-role-permission-by-module')); ?>"
            $.ajax({
                url: url,
                type: 'POST',
                data: {"_token": token, "permission_name": permission_name, "role_id": role_id},
                dataType: 'json'
            })
                .done(function (response) {
                    console.log(response);

                    if (response.status == "success") {
                        $.notify(response.message, response.status);
                    } else {
                        $.notify(response.message, "danger");
                    }
                })
                .fail(function () {
                    $.notify('Something went wrong with ajax !', "danger");
                })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/User/Providers/../Resources/views/permissions.blade.php ENDPATH**/ ?>