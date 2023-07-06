<?php $__env->startSection('rss'); ?>
    active
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
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
            <!-- page info start-->
            <div class="admin-section">
                <div class="row clearfix m-t-30">
                    <div class="col-12">
                        <div class="navigation-list bg-white p-20">
                            <div class="add-new-header clearfix m-b-20">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="block-header">
                                            <h2><?php echo e(__('rss_feeds')); ?></h2>
                                        </div>
                                    </div>
                                    <?php if(Sentinel::getUser()->hasAccess(['rss_write'])): ?>
                                        <div class="col-6 text-right">
                                            <a href="<?php echo e(route('import-rss')); ?>"
                                               class="btn btn-primary btn-sm btn-add-new"><i class="mdi mdi-plus"></i>
                                                <?php echo e(__('add_rss_source')); ?>

                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="table-responsive all-pages">
                                <!-- Table Filter -->
                                <div class="row table-filter-container m-b-20">
                                    <div class="col-sm-12">
                                        <?php echo Form::open(['route' => 'filter-rss','method' => 'GET']); ?>

                                        <div class="item-table-filter">
                                            <p class="text-muted"><small><?php echo e(__('language')); ?></small></p>
                                            <select class="form-control" name="language">
                                                <option value=""><?php echo e(__('all')); ?></option>
                                                <?php $__currentLoopData = $activeLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($lang->code); ?>"><?php echo e($lang->name); ?> </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="item-table-filter">
                                            <p class="text-muted"><small><?php echo e(__('search')); ?></small></p>
                                            <input name="search_key" class="form-control" placeholder="<?php echo e(__('search')); ?>"
                                                   type="search"  value="">
                                        </div>

                                        <div class="item-table-filter md-top-10 item-table-style">
                                            <p>&nbsp;</p>
                                            <button type="submit" class="btn bg-primary"><?php echo e(__('filter')); ?></button>
                                        </div>
                                        <?php echo Form::close(); ?>

                                    </div>
                                </div>
                                <!-- Table Filter -->
                                <table class="table table-bordered table-striped" role="grid">
                                    <thead>
                                        <tr role="row">
                                            <th>#</th>
                                            <th><?php echo e(__('feed_name')); ?></th>
                                            <th><?php echo e(__('feed_url')); ?></th>
                                            <th><?php echo e(__('language')); ?></th>
                                            <th><?php echo e(__('category')); ?></th>
                                            <th><?php echo e(__('posts')); ?></th>
                                            <th><?php echo e(__('auto_update')); ?></th>
                                            <th></th>
                                            <th><?php echo e(__('added_date')); ?></th>
                                            <?php if(Sentinel::getUser()->hasAccess(['rss_write']) || Sentinel::getUser()->hasAccess(['rss_delete'])): ?>
                                                <th><?php echo e(__('options')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $feeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $feed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="row_<?php echo e($feed->id); ?>">
                                            <td><?php echo e($key + 1); ?></td>
                                            <td><?php echo e($feed->name); ?></td>
                                            <td><?php echo e($feed->feed_url); ?></td>
                                            <td><?php echo e($feed->language); ?> </td>
                                            <td>
                                                <label class="category-label m-r-5 label-table"
                                                       id="breaking-post-bgc">
                                                    <?php echo e(@$feed->category['category_name']); ?> </label>

                                            </td>
                                            <td><?php echo e($feed->post_limit); ?></td>
                                            <td class="justify-content-between">
                                                <?php if($feed->auto_update): ?>
                                                    <?php echo e(__('yes')); ?>


                                                <?php else: ?>
                                                    <?php echo e(__('no')); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('manually-feeding',['id'=>$feed->id])); ?>"
                                                   class="btn btn-primary btn-sm btn-add-new"><i class="fa fa-refresh"></i>
                                                    <?php echo e(__('update')); ?>

                                                </a>

                                            </td>
                                            <td><?php echo e($feed->created_at); ?></td>
                                            <?php if(Sentinel::getUser()->hasAccess(['post_write']) || Sentinel::getUser()->hasAccess(['post_delete'])): ?>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn bg-primary dropdown-toggle btn-select-option"
                                                                type="button" data-toggle="dropdown">...<span
                                                                class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu options-dropdown">
                                                            <?php if(Sentinel::getUser()->hasAccess(['rss_write'])): ?>
                                                                <li>
                                                                    <a href="<?php echo e(route('edit-rss',['id'=>$feed->id])); ?>"><i
                                                                            class="fa fa-edit option-icon"></i><?php echo e(__('edit')); ?>

                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>
                                                            <?php if(Sentinel::getUser()->hasAccess(['rss_delete'])): ?>
                                                                <li>
                                                                    <a href="javascript:void(0)"
                                                                       onclick="delete_item('rss_feeds','<?php echo e($feed->id); ?>')"><i
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
                                        <h2><?php echo e(__('Showing')); ?> <?php echo e($feeds->firstItem()); ?> <?php echo e(__('to')); ?> <?php echo e($feeds->lastItem()); ?> <?php echo e(__('of')); ?> <?php echo e($feeds->total()); ?> <?php echo e(__('entries')); ?></h2>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-right">
                                    <div class="table-info-pagination float-right">
                                        <?php echo $feeds->render(); ?>

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
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {

            $('.dynamic').change(function () {
                if ($(this).val() != '') {
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var _token = "<?php echo e(csrf_token()); ?>";
                    $.ajax({
                        url: "<?php echo e(route('subcategory-fetch')); ?>",
                        method: "POST",
                        data: {select: select, value: value, _token: _token},
                        success: function (result) {
                            $('#' + dependent).html(result);
                        }

                    })
                }
            });

            $('#category').change(function () {
                $('#sub_category').val('');
            });


        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Post/Providers/../Resources/views/rss_feeds.blade.php ENDPATH**/ ?>