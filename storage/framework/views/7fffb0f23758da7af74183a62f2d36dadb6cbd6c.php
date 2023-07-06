<?php $__env->startSection('contact_message'); ?>
    active
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            <form action="#" method="post">
                <div class="admin-section">
                    <div class="row clearfix m-t-30">
                        <div class="col-12">
                            <div class="navigation-list bg-white p-20">
                                <div class="add-new-header clearfix m-b-20">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="block-header">
                                                <h2><?php echo e(__('contact_messages')); ?></h2>
                                            </div>
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
                                <div class="table-responsive all-pages">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr role="row">
                                                <th>#</th>
                                                <th><?php echo e(__('name')); ?></th>
                                                <th><?php echo e(__('email')); ?></th>
                                                <th><?php echo e(__('message')); ?></th>
                                                <th><?php echo e(__('send_date')); ?></th>
                                                <th><?php echo e(__('status')); ?></th>
                                                <?php if(Sentinel::getUser()->hasAccess(['contact_message_delete']) || Sentinel::getUser()->hasAccess(['contact_message_write'])
                                                    || Sentinel::getUser()->hasAccess(['contact_message_read'])): ?>
                                                    <th><?php echo e(__('options')); ?></th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $contactMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contactMessage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr role="row" id="row_<?php echo e($contactMessage->id); ?>" class="odd">
                                                    <td class="sorting_1"><?php echo e($contactMessage->id); ?></td>
                                                    <td><?php echo e($contactMessage->name); ?></td>
                                                    <td><?php echo e($contactMessage->email); ?></td>
                                                    <td> <?php echo e($contactMessage->message); ?> </td>
                                                    <td><?php echo e($contactMessage->created_at->toDayDateTimeString()); ?></td>
                                                    <td><?php if($contactMessage->message_seen == 0): ?> <?php echo e(__('unseen')); ?> <?php else: ?> <?php echo e(__('seen')); ?><?php endif; ?></td>

                                                    <?php if(Sentinel::getUser()->hasAccess(['contact_message_delete']) || Sentinel::getUser()->hasAccess(['contact_message_write'])
                                                        || Sentinel::getUser()->hasAccess(['contact_message_read'])): ?>
                                                    <td>
                                                        <?php if(Sentinel::getUser()->hasAccess(['contact_message_read'])): ?>
                                                            <a href="javascript:void(0)" class="modal-menu btn btn-light active btn-xs"
                                                                data-title="View Mesage"
                                                                data-url="<?php echo e(route('edit-info',['page_name'=>'view-message','param1'=>$contactMessage->id])); ?>"
                                                                data-toggle="modal"
                                                                data-target="#common-modal"><i
                                                                class="fa fa-eye"></i>
                                                                <?php echo e(__('view')); ?>

                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if(Sentinel::getUser()->hasAccess(['contact_message_write'])): ?>
                                                            <a href="javascript:void(0)" class="modal-menu btn btn-light active btn-xs"
                                                                data-title="Reply Message"
                                                                data-url="<?php echo e(route('edit-info',['page_name'=>'replay-contact-message','param1'=>$contactMessage->id])); ?>"
                                                                data-toggle="modal"
                                                                data-target="#common-modal">
                                                                <i class="fas fa-reply"></i>
                                                                <?php echo e(__('replay')); ?>

                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if(Sentinel::getUser()->hasAccess(['contact_message_delete'])): ?>
                                                            <a href="javascript:void(0)" class="btn btn-light active btn-xs"
                                                                onclick="delete_item('contact_messages','<?php echo e($contactMessage->id); ?>')"><i
                                                                class="fa fa-trash"></i>
                                                                <?php echo e(__('delete')); ?>

                                                            </a>
                                                        <?php endif; ?>
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
                                            <h2><?php echo e(__('Showing')); ?> <?php echo e($contactMessages->firstItem()); ?> <?php echo e(__('to')); ?> <?php echo e($contactMessages->lastItem()); ?> <?php echo e(__('of')); ?>

                                                <?php echo e($contactMessages->total()); ?> <?php echo e(__('entries')); ?></h2>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 text-right">
                                        <div class="table-info-pagination float-right">
                                            <?php echo $contactMessages->render(); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- page info end-->
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Contact/Providers/../Resources/views/index.blade.php ENDPATH**/ ?>