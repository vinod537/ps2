<style>
    .entry-content.align-self-center .entry-title a {
	font-size: 17px;
	color: #333;
}
.medium-post-style-1, .post-style-1 {

	display: inline-block!important;
}
	.sg-post.medium-post-style-1 {
	width: 100%;
}
	.medium-post-style-1 .entry-thumbnail {
	width: 100%;
}
	body {
	background: #f2f2f2;
}
	
	.sg-main-content.mb-4 .container {
	width: 63%;
}
	
	.sg-widget {
	display: none;
}
    .sg-post .entry-content {
	padding: 10px 15px;
	font-size: 14px;
	height: 170px;
}
    .entry-meta.mb-2 {
	margin-top: 44px;
}
	
		.entry-title {
	height: 117px!important;
}
    
        @media  screen and (min-width:320px) and (max-width:767px) {

        .sg-main-content.mb-4 .container {
	width: 100%!important;
}
        .container {
	width: 100% !important;
}
    }
</style>




<?php $__env->startSection('content'); ?>
    <div class="sg-main-content mb-4">
        <div class="container">
			
							<div class="all__heading" style="margin-bottom: 68px;
margin-top: 108px;">
         <h3 style=""> <?php echo e($name); ?></h3>
		  <!-- <p style="padding-bottom: 26px;">Lorem Ipsum is simply dummy text of the printing and typesetting</p> -->
      </div>
			
			
            <div class="row">
                <div class="col-md-12 col-lg-12 sg-sticky">
                    <div class="theiaStickySidebar">

                            <div class="sg-section">
                                <div class="section-content">
                                    <div class="latest-post-area row">
                                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="col-md-4">
                                            <div class="sg-post medium-post-style-1">
                                                <div class="entry-header">
                                                    <div class="entry-thumbnail">
                                                        <a href="<?php if($post->old_id): ?> <?php echo e(route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ])); ?> <?php else: ?> <?php echo e(route('article.detail', ['id' => $post->id, 'slug' => $post->slug ])); ?> <?php endif; ?>">
                                                            <?php if(isFileExist($post->image, $result =  @$post->image->original_image)): ?>
                                                                <img src="<?php echo e(safari_check() ? basePath(@$post->image).'/'.$result : static_asset('default-image/default-358x215.png')); ?> " data-original=" <?php echo e(basePath($post->image)); ?>/<?php echo e($result); ?> " class="img-fluid"   alt="<?php echo $post->title; ?>"  >
                                                            <?php else: ?>
                                                                <img src="<?php echo e(static_asset('default-image/default-358x215.png')); ?> "  class="img-fluid"   alt="<?php echo $post->title; ?>" >
                                                            <?php endif; ?>
                                                        </a>
                                                    </div>
                                                    <?php if($post->post_type=="video"): ?>
                                                        <div class="video-icon large-block">
                                                            <img src="<?php echo e(static_asset('default-image/video-icon.svg')); ?> " alt="video-icon">
                                                        </div>
                                                    <?php elseif($post->post_type=="audio"): ?>
                                                        <div class="video-icon large-block">
                                                            <img src="<?php echo e(static_asset('default-image/audio-icon.svg')); ?> " alt="audio-icon">
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="category">
                                                    <ul class="global-list">
                                                        <?php if(isset($post->category->category_name)): ?>
                                                            <li><a class="<?php echo e($post->category->slug); ?>" href="<?php echo e(url('category',$post->category->slug)); ?>"><?php echo e($post->category->category_name); ?></a></li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="entry-content align-self-center">
                                                    <h3 class="entry-title"><a
                                                            href="<?php if($post->old_id): ?> <?php echo e(route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ])); ?> <?php else: ?> <?php echo e(route('article.detail', ['id' => $post->id, 'slug' => $post->slug ])); ?> <?php endif; ?>"><?php echo \Illuminate\Support\Str::limit($post->title, 130); ?></a>
                                                    </h3>
                                                    <div class="entry-meta mb-2">
                                                        <ul class="global-list">
<!--                                                            <li><?php echo e(__('post_by')); ?> <a href="<?php echo e(route('site.author',['id' => $post->user->id])); ?>"><?php echo e($post->user->first_name); ?> </a></li>-->
                                                            <li> <?php echo e($post->updated_at->format('F j, Y')); ?></li>
                                                        </ul>
                                                    </div>
            <!--                                                    <p><?php echo strip_tags(\Illuminate\Support\Str::limit($post->content, 120)); ?></p>-->
                                                </div>
                                            </div>
											</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <?php if($posts->count() != 0): ?>
                                        <input type="hidden" id="last_id" value="1">
                                        <input type="hidden" id="tag" value="<?php echo e($slug); ?>">
                                        <div class="col-sm-12 col-xs-12 d-none" id="latest-preloader-area">
                                            <div class="row latest-preloader">
                                                <div class="col-md-7 offset-md-5">
                                                    <img src="<?php echo e(static_asset('site/images/')); ?>/preloader-2.gif" alt="Image" class="tr-preloader img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="row">
                                                <button class="btn-load-more <?php echo e($totalPostCount > 6? '':'d-none'); ?>" id="btn-load-more-tags"> <?php echo e(__('load_more')); ?> </button>
                                                <!-- <button class="btn-load-more <?php echo e($totalPostCount > 6? 'd-none':''); ?>" id="no-more-data-tags">
                                                    <?php echo e(__('no_more_records')); ?>                                            </button> -->

                                                    <button class="btn-load-more <?php echo e($totalPostCount > 6? 'd-none':''); ?>" id="no-more-data-home">
                                                    <a href="<?php echo e(url('/')); ?>/newshome"><?php echo e(__('Back to Home')); ?></a> </button>

                                                    <input type="hidden" id="url" value="<?php echo e(url('')); ?>">
                                                    <input type="hidden" id="tags" value="<?php echo e($tags); ?>">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>




<?php $__env->startSection('script'); ?>

<script>
    $(document).ready(function() {
         var ENDPOINT = "<?php echo e(url('/')); ?>";
         var page = 1;
         infinteLoadMore(page);
         var scrn = 600;
         $(window).scroll(function () {
              var scrns = $(window).scrollTop() - scrn;
              var higt = scrns + $(window).height();
             if ( higt >= $(document).height()) {
                 page++;
                 scrn =  scrn+600;
                 infinteLoadMore(page);                
             }
         });        
    });

    
    function infinteLoadMore(page) {

        var url = $("#url").val();
        var formData = {
            last_id: page,
            tags: $('#tags').val()
        };  
        $.ajax({
                type: "GET",
                dataType: 'json',
                data: formData,
                url: url + '/' + 'get-read-more-post-tags',
                success: function (data) {
                   // console.log(data);

                    $.each(data[0], function (key, value) {
                        $(".latest-post-area").append(value);
                    });

                    if (data[1] == 1) {
                        $("#btn-load-more-tags").hide();
                        $("#no-more-data-tags").removeClass('d-none');
                        $("#no-more-data-home").removeClass('d-none');
                    $("#event-form-data").removeClass('d-none');
                    }

                    var last_id = parseInt($('#last_id').val());
                    $('#last_id').val(last_id + 1);
                    $("#btn-load-more-tags").prop("disabled", false);

                    $("#latest-preloader-area").addClass('d-none');
                    $('.auto-load').hide();


                },
                error: function (data) {
                    // console.log('Error:', data);
                }
            });
        }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/site/pages/tags_posts.blade.php ENDPATH**/ ?>