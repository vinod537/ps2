<?php $__env->startSection('poll'); ?>
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
                                                <h2><?php echo e(__('polls')); ?></h2>
                                            </div>
                                        </div>
                                        <?php if(Sentinel::getUser()->hasAccess(['polls_write'])): ?>
                                            <div class="col-6 text-right">
                                                <a href="<?php echo e(route('create-poll')); ?>"
                                                   class="btn btn-primary btn-sm btn-add-new"><i
                                                        class="mdi mdi-plus"></i>
                                                    <?php echo e(__('create_poll')); ?>

                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="table-responsive all-pages">
                                    <table class="table table-bordered table-striped" role="grid">
                                        <thead>
                                        <tr role="row">
                                            <th width="20">#</th>
                                            <th><?php echo e(__('question')); ?></th>
                                            <th><?php echo e(__('auth_required')); ?></th>
                                            <th><?php echo e(__('status')); ?></th>
                                            <th><?php echo e(__('start_date')); ?></th>
                                            <th><?php echo e(__('end_date')); ?></th>
                                            <th><?php echo e(__('added_date')); ?></th>
                                            <?php if(Sentinel::getUser()->hasAccess(['polls_write']) || Sentinel::getUser()->hasAccess(['polls_delete'])): ?>
                                                <th><?php echo e(__('options')); ?></th>
                                            <?php endif; ?>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $polls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $poll): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr id="row_<?php echo e($poll->id); ?>">
                                                <td><?php echo e($poll->id); ?></td>
                                                <td><?php echo e($poll->question); ?></td>
                                                <td><?php if($poll->auth_required==1): ?> <?php echo e(__('yes')); ?> <?php else: ?> <?php echo e(__('no')); ?> <?php endif; ?></td>
                                                <td><?php if($poll->status==1): ?> <?php echo e(__('active')); ?> <?php else: ?> <?php echo e(__('inactive')); ?> <?php endif; ?></td>
                                                <td><?php echo e(Carbon\Carbon::parse($poll->start_date)->format('F d, Y g:i A')); ?></td>
                                                <td><?php echo e(Carbon\Carbon::parse($poll->end_date)->format('F d, Y g:i A')); ?></td>
                                                <td><?php echo e($poll->created_at->toDayDateTimeString()); ?></td>
                                                <?php if(Sentinel::getUser()->hasAccess(['polls_write']) || Sentinel::getUser()->hasAccess(['polls_delete'])): ?>
                                                    <td>
                                                        <?php if(Sentinel::getUser()->hasAccess(['polls_write'])): ?>
                                                            <a class="btn btn-light active btn-xs"
                                                               href="<?php echo e(route('poll-edit',['id'=>$poll->id])); ?>"><i
                                                                    class="fa fa-edit"></i>
                                                                <?php echo e(__('edit')); ?>

                                                            </a>
                                                        <?php endif; ?>
                                                        <?php if(Sentinel::getUser()->hasAccess(['polls_delete'])): ?>
                                                            <a href="javascript:void(0)"
                                                               class="btn btn-light active btn-xs"
                                                               onclick="delete_item('polls','<?php echo e($poll->id); ?>')"><i
                                                                    class="fa fa-trash"></i>
                                                                <?php echo e(__('delete')); ?>

                                                            </a>
                                                        <?php endif; ?>
                                                        <a href="javascript:void(0)"
                                                           class="btn btn-light active btn-xs modal-menu"
                                                           data-title="<?php echo e($poll->question); ?>"
                                                           data-url="<?php echo e(route('edit-info',['page_name'=>'vote-result','param1'=>$poll->id])); ?>"
                                                           data-toggle="modal"
                                                           data-target="#common-modal"><i
                                                                class="mdi mdi-poll"></i><?php echo e(__('result')); ?>

                                                        </a>
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
                                            <h2><?php echo e(__('Showing')); ?> <?php echo e($polls->firstItem()); ?> <?php echo e(__('to')); ?> <?php echo e($polls->lastItem()); ?> <?php echo e(__('of')); ?> <?php echo e($polls->total()); ?> <?php echo e(__('entries')); ?></h2>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 text-right">
                                        <div class="table-info-pagination float-right">
                                            <?php echo $polls->render(); ?>


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

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Post/Providers/../Resources/views/polls.blade.php ENDPATH**/ ?>