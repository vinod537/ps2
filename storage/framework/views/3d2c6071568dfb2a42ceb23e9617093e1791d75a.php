<?php $__env->startSection('ads-aria-expanded'); ?>
    aria-expanded="true"
<?php $__env->stopSection(); ?>
<?php $__env->startSection('ads-show'); ?>
    show
<?php $__env->stopSection(); ?>
<?php $__env->startSection('youtubes'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('ads_active'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modal'); ?>
    <?php echo $__env->make('gallery::image-gallery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            <?php echo Form::open(['route'=>'store-youtube','method' => 'post', 'enctype'=>'multipart/form-data']); ?>

            <input type="hidden" id="imageCount" value="1">
            <div class="row clearfix">
                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">
                        <div class="add-new-header clearfix">
                            <div class="row">
                                <div class="col-6">
                                    <div class="block-header">
                                        <h2><?php echo e(__('create')); ?></h2>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="<?php echo e(route('youtubes')); ?>" class="btn btn-primary btn-add-new btn-sm"><i class="fas fa-arrow-left"></i>
                                        <?php echo e(__('back_to_youtubes')); ?>

                                    </a>
                                </div>
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
                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">  

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="youtube_link" class="col-form-label"><?php echo e(__('Youtube Link')); ?></label>
                                <input type="text" id="video_url"  onblur="ajax_get_video_details(this.value)"  class="form-control" placeholder="<?php echo e(__('Youtube URL')); ?>" name="video_url" required>

<label class="form-label" id = "perloader" style ="margin-top: 4px; display: none;"><i class="mdi mdi-spin mdi-loading">&nbsp;</i><?php echo 'analyzing_the_url'; ?></label>

<label class="form-label" id = "invalid_url" style ="margin-top: 4px; color: red; display: none;"><?php echo 'invalid url'.'. '.'your video source has to be youtube'; ?></label>                            </div>
                        </div>


                        <div class="form-group">

                            <label><?php echo 'duration'; ?></label>

                            <input type="text" readonly name = "video_duration" id = "video_duration" class="form-control">

                            <input type="hidden" name = "video_provider" id = "video_provider" class="form-control">

                            <input type="hidden" name = "video_thumbnail" id = "video_thumbnail" class="form-control">

                            <input type="hidden" name = "video_link" id = "video_link" class="form-control">

                            <input type="hidden" name = "embed_video" id = "embed_video" class="form-control">

                            <input type="hidden" name = "video_id" id = "video_id" class="form-control">

                            <input type="hidden" name = "video_description" id = "video_description" class="form-control">
                            <input type="hidden" name = "video_title" id = "video_title" class="form-control">

                        </div>

                        <iframe id="youtubelinks" width="800" height="300" src=""  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>



                       

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group form-float form-group-sm">
                                    <button type="submit" disabled class="youtubesubmit btn btn-primary float-right m-t-20"><i class="mdi mdi-plus"></i> <?php echo e(__('Save')); ?></button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <?php echo e(Form::close()); ?>

        <!-- page info end-->
        </div>
    </div>


    <script>

function ajax_get_video_details(video_url) {

 

$('#perloader').show();

$('.youtubesubmit').attr('disabled', true)

if(checkURLValidity(video_url)){

   $.ajax({

           headers: {

           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

       },

       type: "POST",

       url: "<?php echo e(route('admin.ajax_get_video_details')); ?>",

       data : {video_url : video_url},

       success: function(response)

       {

           $('.youtubesubmit').attr('disabled', false)

           response = JSON.parse(response)

           $('#video_duration').val(response.data.duration);

           $('#embed_video').val(response.data.embed_video);
           $('#youtubelinks').attr('src', response.data.embed_video);

           $('#video_provider').val(response.data.provider);

           $('#video_thumbnail').val(response.data.thumbnail);

           $('#video_title').val(response.data.title);


           $('#video_link').val(response.data.video);

           $('#video_id').val(response.data.video_id);

           $('#video_description').val(response.data.description);

           $('#perloader').hide();

           $('#invalid_url').hide();

       }

   });

}else {

   $('.youtubesubmit').attr('disabled', true)

   $('#invalid_url').show();

   $('#perloader').hide();



   $('#video_duration').val('');

   $('#embed_video').val('');

   $('#video_provider').val('');

   $('#video_thumbnail').val('');

   $('#video_title').val('');

   $('#video_link').val('');

   $('#video_id').val('');

   $('#video_description').val('');



}

}



function checkURLValidity(video_url) {

var youtubePregMatch = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;

var vimeoPregMatch = /^(http\:\/\/|https\:\/\/)?(www\.)?(vimeo\.com\/)([0-9]+)$/;

if (video_url.match(youtubePregMatch)) {

   return true;

}

else if (vimeoPregMatch.test(video_url)) {

   return true;

}

else {

   return false;

}

}


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Appearance/Providers/../Resources/views/youtube_create.blade.php ENDPATH**/ ?>