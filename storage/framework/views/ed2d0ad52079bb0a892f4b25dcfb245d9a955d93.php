<div class="add-new-page content_<?php echo e($content_count); ?> bg-white p-20 m-b-20">
    <div class="row">
        <div class="col-12">
            <div class="right"><button type="button" class="btn btn-danger px-1 py-0 float-right row_remove"><i class="m-r-0 mdi mdi-minus"></i></button></div>
        </div>
        <div class="col-12 p-t-20 p-l-15">
            <label for="post_content" class="col-form-label"><?php echo e(__('content')); ?>*</label>
            <textarea class="form-control" name="new_content[<?php echo e($content_count); ?>][text][text]" id="post_content_1"
                    cols="30" rows="5"
                    ><?php echo e(isset($content)? $content['text'][0]['text']:''); ?></textarea>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/Modules/Post/Providers/../Resources/views/contents/text.blade.php ENDPATH**/ ?>