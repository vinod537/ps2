<style>
    @media  screen and (min-width:320px) and (max-width:767px){
        .entry-meta li, .entry-meta li a {
    color: #777 !important;
    font-size: 11px !important;
}
    }
 
    .entry-meta.mb-2.fhf {
	margin-top: 33px;
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
	
.sg-post .entry-content {
	height: 160px !important;
}
	.sg-main-content.mb-4 .container {
	width: 63%;
}
	.entry-content.align-self-center .entry-title a {
	font-size: 17px;
        color:#333;
}
	.sg-widget {
	display: none;
}
	
	.entry-meta li, .entry-meta li a {
	color: #fff;
	background: #EF3C0E;
	border-radius: 36px;
	padding: 0px 5px 3px 5px;
	line-height: 21px !important;
}
	
	.sg-post .entry-content {
	padding: 12px 16px;
	font-size: 14px;
	height: 101px;
}
	.sg-post.medium-post-style-1 {
	border-radius: 5px;
}
	.entry-meta li, .entry-meta li a {
	color: #fff!important;
}
	.sg-main-content.mb-4 .container {
	width: 72%;
}
	
    .global-list.d-flex {
	margin-left: -83px;
}
    .global-list.d-flex {
	margin-left: -85px!important;
}
    @media  screen and (min-width:320px) and (max-width:767px){
        .all__heading h3 {
	color: #000;
	font-size: 27px !important;
	text-transform: uppercase;
}
    }
    @media  screen and (min-width:1100px) and (max-width:1450px){
        .col-md-2asfasf .search-form.d__rtt.new_drtt {
	width: 179px !important;
}
        .sg-post .entry-content {
	height: 174px !important;
}
        .entry-meta.mb-2.fhf {
	margin-top: 45px!important;
}
    }
</style>




<?php $__env->startSection('content'); ?>
    <div class="sg-main-content mb-4">
        <div class="container">
			
				<div class="all__heading" style="margin-bottom: 68px;
margin-top: 108px;">
         <h3 style=""> All Posts by Date</h3>
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
                                        <!-- 
                                            <div class="category">
                                                <ul class="global-list">
                                                    <?php if(isset($post->category->category_name)): ?>
                                                        <li><a class="<?php echo e($post->category->slug); ?>" href="<?php echo e(url('category',$post->category->slug)); ?>"><?php echo e($post->category->category_name); ?></a></li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div> -->

                                            <div class="entry-content align-self-center">
                                             
                                              
												   <h3 class="entry-title"><a
                                                        href="<?php if($post->old_id): ?> <?php echo e(route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ])); ?> <?php else: ?> <?php echo e(route('article.detail', ['id' => $post->id, 'slug' => $post->slug ])); ?> <?php endif; ?>"><?php echo \Illuminate\Support\Str::limit($post->title, 130); ?></a>
                                                </h3>
												  <div class="entry-meta mb-2 fhf">
                                                    <ul class="global-list">
<!--                                                        <li><?php echo e(__('post_by')); ?> <a href="<?php echo e(route('site.author',['id' => $post->user->id])); ?>"><?php echo e($post->user->first_name); ?> </a></li>-->
                                                        <li><?php echo e($post->updated_at->format('F j, Y')); ?></li>
                                                    </ul>
                                                </div>
<!--                                                <p><?php echo strip_tags(\Illuminate\Support\Str::limit($post->content, 120)); ?></p>-->
                                            </div>
                                        </div>
										</div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <?php if($posts->count() != 0): ?>
                                    <input type="hidden" id="last_id" value="1">
                                    <input type="hidden" id="date" value="<?php echo e($date); ?>">
                                    <div class="col-sm-12 col-xs-12 d-none" id="latest-preloader-area">
                                        <div class="row latest-preloader">
                                            <div class="col-md-7 offset-md-5">
                                                <img src="<?php echo e(static_asset('site/images/')); ?>/preloader-2.gif" alt="Image" class="tr-preloader img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="row">
                                            <button class="btn-load-more <?php echo e($totalPostCount > 6? '':'d-none'); ?>" id="btn-load-more-date"> <?php echo e(__('load_more')); ?> </button>
                                            <!-- <button class="btn-load-more <?php echo e($totalPostCount > 6? 'd-none':''); ?>" id="no-more-data-date">
                                                <?php echo e(__('no_more_records')); ?>                                            </button> -->

                                                <button class="btn-load-more <?php echo e($totalPostCount > 6? 'd-none':''); ?>" id="no-more-data-home">
                                                    <a href="<?php echo e(url('/')); ?>/newshome"><?php echo e(__('Back to Home')); ?></a> </button>

                                                <input type="hidden" id="url" value="<?php echo e(url('')); ?>">
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4 sg-sticky">
                    <div class="sg-sidebar theiaStickySidebar">
                        <?php echo $__env->make('site.partials.right_sidebar_widgets', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
         var scrn = 500;
         $(window).scroll(function () {
              var scrns = $(window).scrollTop() - scrn;
              var higt = scrns + $(window).height();
             if ( higt >= $(document).height()) {
                 page++;
                 scrn =  scrn+500;
                 infinteLoadMore(page);                
             }
         });        
    });

    
    function infinteLoadMore(page) {

        var url = $("#url").val();
        var formData = {
            last_id: page,
            date: $('#date').val()
        };  
        $.ajax({
                type: "GET",
                dataType: 'json',
                data: formData,
                url: url + '/' + 'get-read-more-post-date',
                success: function (data) {
                    console.log(data);

                    $.each(data[0], function (key, value) {
                        $(".latest-post-area").append(value);
                    });

                    if (data[1] == 1) {
                        $("#btn-load-more-date").hide();
                        $("#no-more-data-date").removeClass('d-none');
                        $("#no-more-data-home").removeClass('d-none');
                        $("#event-form-data").removeClass('d-none');
                    }

                    var last_id = parseInt($('#last_id').val());
                    $('#last_id').val(last_id + 1);
                    $("#btn-load-more-date").prop("disabled", false);

                    $("#latest-preloader-area").addClass('d-none');

                    

                },
                error: function (data) {
                    // console.log('Error:', data);
                }
            });
        }
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('site.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/site/pages/date_posts.blade.php ENDPATH**/ ?>