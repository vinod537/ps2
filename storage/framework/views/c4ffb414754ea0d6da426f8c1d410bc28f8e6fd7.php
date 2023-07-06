<div class="add-new-page content_<?php echo e($content_count); ?> bg-white p-20 m-b-20" id="image_content_<?php echo e($content_count); ?>">
    <input type="hidden" value="<?php echo e($content_count); ?>" id="content_count">
    <div class="row">
        <div class="col-12">
            <div class="right"><button type="button" class="btn btn-danger px-1 py-0 float-right row_remove"><i class="m-r-0 mdi mdi-minus"></i></button></div>
        </div>
        <div class="col-12 p-t-20 p-l-15">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <!-- Large modal -->
                        <button type="button" id="btn_image_modal"
                                class="btn btn-primary btn-image-modal" data-id="1" data-toggle="modal"
                                data-target=".image-modal-lg"><?php echo e(__('add_image')); ?></button>
                        <input id="image_id_content" name="new_content[<?php echo e($content_count); ?>][image][image_id]" type="hidden" class="form-control image_id" value="<?php echo e(isset($content)? $content['image'][0]['image_id']:''); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group text-center">
                            <?php if(isset($content) && $content['image'][0]['image_id'] != ""): ?>
                            <?php
                            $image = $content['image'][0]['image'];
                            ?>
                            <?php if(isFileExist(@$image, $result = @$image->thumbnail)): ?>
                                <img src=" <?php echo e(basePath($image)); ?>/<?php echo e($result); ?> "  id="image_preview_content"
                                    width="200" height="200" alt="image"
                                    class="img-responsive img-thumbnail image_preview">
                            <?php else: ?>
                                <img src="<?php echo e(static_asset('default-image/default-100x100.png')); ?> " id="image_preview_content"
                                width="200" height="200" alt="image"
                                class="img-responsive img-thumbnail image_preview">
                            <?php endif; ?>
                            <?php else: ?>
                            <img src="<?php echo e(static_asset('default-image/default-100x100.png')); ?> " id="image_preview_content"
                                    width="200" height="200" alt="image"
                                    class="img-responsive img-thumbnail image_preview">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/Modules/Post/Providers/../Resources/views/contents/image.blade.php ENDPATH**/ ?>