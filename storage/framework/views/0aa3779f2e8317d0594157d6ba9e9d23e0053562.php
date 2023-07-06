<div class="add-new-page content_<?php echo e($content_count); ?> bg-white p-20 m-b-20">
    <div class="row">
        <div class="col-12">
            <div class="right"><button type="button" class="btn btn-danger px-1 py-0 float-right row_remove"><i class="m-r-0 mdi mdi-minus"></i></button></div>
        </div>
        <div class="col-12 p-t-20 p-l-15">
            <div class="row">
                <div class="col-md-12">
                    <label for="" class="col-form-label"><?php echo e(__('code')); ?>*</label>
                    <textarea class="form-control" name="new_content[<?php echo e($content_count); ?>][code][code]" id=""
                      cols="40" rows="5"><?php echo e(isset($content)? $content['code'][0]['code']:''); ?></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/Modules/Post/Providers/../Resources/views/contents/code.blade.php ENDPATH**/ ?>