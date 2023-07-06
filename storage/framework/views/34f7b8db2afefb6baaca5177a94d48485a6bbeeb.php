<?php $__env->startSection('gallery-aria-expanded'); ?>
    aria-expanded="true"
<?php $__env->stopSection(); ?>
<?php $__env->startSection('gallery-show'); ?>
    show
<?php $__env->stopSection(); ?>
<?php $__env->startSection('gallery'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('all-images-active'); ?>
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
                                    <div class="col-6">
                                        <div class="block-header">
                                            <h2><?php echo e(__('gallery_images')); ?></h2>
                                        </div>
                                    </div>
                                    <?php if(Sentinel::getUser()->hasAccess(['album_write'])): ?>
                                        <div class="col-6 text-right">
                                            <a href="<?php echo e(route('add-gallery-image')); ?>"
                                               class="btn btn-primary btn-sm btn-add-new"><i class="mdi mdi-plus"></i>
                                                <?php echo e(__('add_image')); ?>

                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="table-responsive all-pages">
                                <!-- Table Filter -->
                                <div class="row table-filter-container m-b-20">
                                    <div class="col-sm-12">
                                        <?php echo Form::open(['route' => 'filter-image','method' => 'GET']); ?>

                                        <div class="item-table-filter">
                                            <p class="text-muted"><small><?php echo e(__('language')); ?></small></p>
                                            <select class="form-control dynamic-album" id="language" name="language" data-dependent="album_id">
                                                <?php $__currentLoopData = $activeLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option
                                                        <?php if(App::getLocale()==$lang->code): ?> Selected
                                                        <?php endif; ?> value="<?php echo e($lang->code); ?>"><?php echo e($lang->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="item-table-filter">
                                            <p class="text-muted"><small><?php echo e(__('album')); ?></small></p>
                                            <select class="form-control dynamic-album-tab text-capitalize" id="album_id" name="album_id"
                                                    data-dependent="album_tab" >
                                                <option value=""><?php echo e(__('all')); ?></option>
                                                <?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($album->id); ?>"><?php echo e($album->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="item-table-filter">
                                            <p class="text-muted"><small><?php echo e(__('tab')); ?></small></p>
                                            <select class="form-control dynamic text-capitalize" id="album_tab" name="tab">
                                                <option value=""><?php echo e(__('all')); ?></option>
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
                                        <th><?php echo e(__('image')); ?></th>
                                        <th><?php echo e(__('language')); ?></th>
                                        <th><?php echo e(__('album')); ?></th>
                                        <th><?php echo e(__('tab')); ?></th>
                                        <th><?php echo e(__('added_date')); ?></th>
                                        <?php if(Sentinel::getUser()->hasAccess(['album_write']) || Sentinel::getUser()->hasAccess(['album_delete'])): ?>
                                            <th><?php echo e(__('options')); ?></th>
                                        <?php endif; ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr id="row_<?php echo e($item->id); ?>">
                                            <td><?php echo e($key + 1); ?></td>
                                            <td>
                                                <div class="post-image">
                                                    <?php if(isFileExist(@$item, $result = @$item->thumbnail)): ?>
                                                        <img
                                                            src=" <?php echo e(basePath($item)); ?>/<?php echo e($result); ?> "
                                                            data-src="<?php echo e(basePath($item)); ?>/<?php echo e($result); ?>"
                                                            alt="image" class="img-responsive img-thumbnail lazyloaded">

                                                    <?php else: ?>
                                                        <img src="<?php echo e(static_asset('default-image/default-100x100.png')); ?> " width="200"
                                                             height="200" alt="image"
                                                             class="img-responsive img-thumbnail">
                                                    <?php endif; ?>
                                                </div> <?php echo e($item->title); ?>

                                            </td>
                                            <td> <?php echo e(@$item->album['language']); ?> </td>
                                            <td class="td-post-type"><?php echo e(@$item->album['name']); ?></td>
                                            <td class="td-post-type text-capitalize"><?php echo e(@$item->tab); ?></td>
                                            <td><?php echo e($item->created_at); ?></td>
                                            <?php if(Sentinel::getUser()->hasAccess(['album_write']) || Sentinel::getUser()->hasAccess(['album_delete'])): ?>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn bg-primary dropdown-toggle btn-select-option"
                                                                type="button" data-toggle="dropdown">...<span
                                                                class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu options-dropdown">
                                                           
                                                            <?php if(Sentinel::getUser()->hasAccess(['album_write'])): ?>
                                                                <li>
                                                                    <a href="<?php echo e(route('edit-gallery-image',['id'=>$item->id])); ?>"><i
                                                                            class="fa fa-edit option-icon"></i><?php echo e(__('edit')); ?>

                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>
                                                            <?php if(Sentinel::getUser()->hasAccess(['album_delete'])): ?>
                                                                <li>
                                                                    <a href="javascript:void(0)"
                                                                       onclick="delete_item('gallery_images','<?php echo e($item->id); ?>')"><i
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
                                        <h2><?php echo e(__('Showing')); ?> <?php echo e($galleryImages->firstItem()); ?> <?php echo e(__('to')); ?> <?php echo e($galleryImages->lastItem()); ?> <?php echo e(__('of')); ?> <?php echo e($galleryImages->total()); ?> <?php echo e(__('entries')); ?></h2>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-right">
                                    <div class="table-info-pagination float-right">
                                        <?php echo $galleryImages->render(); ?>

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

    <?php $__env->startSection('script'); ?>
        <script>
            $(document).ready(function () {

                $('.dynamic-album').change(function () {
                    if ($(this).val() != '') {
                        var select = $(this).attr("id");
                        var value = $(this).val();
                        var dependent = $(this).data('dependent');
                        var _token = "<?php echo e(csrf_token()); ?>";
                        $.ajax({
                            url: "<?php echo e(route('album-fetch')); ?>",
                            method: "POST",
                            data: {select: select, value: value, _token: _token},
                            success: function (result) {
                                $('#' + dependent).html(result);
                            }

                        })
                    }
                });


                $('.dynamic-album-tab').change(function () {
                    if ($(this).val() != '') {
                        var select = $(this).attr("id");
                        var value = $(this).val();
                        var dependent = $(this).data('dependent');
                        var _token = "<?php echo e(csrf_token()); ?>";
                        $.ajax({
                            url: "<?php echo e(route('album-tabs-fetch')); ?>",
                            method: "POST",
                            data: {select: select, value: value, _token: _token},
                            success: function (result) {
                                $('#' + dependent).html(result);
                            }

                        })
                    }
                });

                $('#language').change(function () {
                    $('#album_tab').val('');
                    $('#album_id').val('');
                });
            });

            function set_cover(row_id) {
                var table_row = '#row_' + row_id
                var token =  "<?php echo e(csrf_token()); ?>";
                url = "<?php echo e(route('set-cover')); ?>"

                swal({
                    title: "<?php echo e(__('are_you_sure?')); ?>",
                    text: "<?php echo e(__('it_will_be_set_as_album_cover')); ?>",
                    icon: "info",
                    buttons: true,
                    buttons: ["<?php echo e(__('cancel')); ?>", "<?php echo e(__('add')); ?>"],
                    dangerMode: false,
                    closeOnClickOutside: false
                })
                    .then(function(confirmed){
                        if (confirmed){
                            $.ajax({
                                url: url,
                                type: 'post',
                                data: 'image_id=' + row_id +'&_token='+token,
                                dataType: 'json'
                            })
                                .done(function(response){
                                    swal.stopLoading();
                                    if(response.status == "success"){
                                        console.log(response);
                                        swal("<?php echo e(__('added')); ?>!", response.message, response.status);
                                        window.location.reload();
                                    }else{
                                        swal("Error!", response.message, response.status);
                                    }
                                })
                                .fail(function(){
                                    swal('Oops...', '<?php echo e(__('something_went_wrong_with_ajax')); ?>', 'error');
                                })
                        }
                    })
            }
        </script>
    <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Gallery/Providers/../Resources/views/gallery.blade.php ENDPATH**/ ?>