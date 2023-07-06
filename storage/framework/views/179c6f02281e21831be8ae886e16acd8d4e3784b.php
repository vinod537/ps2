<style>
    .entry-meta.mb-2 {
	margin-bottom: 16px!important;
	margin-top: -3px!important;
	margin-left: 20px;
}
    .entry-content.align-self-center a {
	color: #333;
}
    .entry-title {
	height: 126px!important;
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
	.entry-content.align-self-center .entry-title a {
	font-size: 14px;
}
	.sg-widget {
	display: none;
}
	.entry-content.align-self-center .entry-title a {
	font-size: 17px;
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
	height:170px;
}
	.sg-post.medium-post-style-1 {
	border-radius: 5px;
}
	.entry-meta li, .entry-meta li a {
	color: #fff!important;
}
	
	.sg-page-content .container {
	width: 63%;
}
	
	.medium-post-style-1 .entry-thumbnail {
	width: 100%;
	height: 176px !important;
	border-bottom: 1px solid #22222214;
}
	
	.latest-post-area.row {
	margin-top: 130px;
}
	.sg-page-content {
	padding-bottom: 52px;
}
	.header-bottom {
	padding: 23px 0;
	background-color: transparent;
	padding-bottom: 1px;
	position: absolute;
	width: 100%;
	z-index: 999;
}
	.sg-page-content .container {
    width: 76%;
}
	
	.entry-meta li, .entry-meta li a {
    color: #444!important;
    background: transparent;
    border-radius: 36px;
    padding: 0px 5px 3px 5px;
    line-height: 21px !important;
}
.entry-meta li, .entry-meta li a {
    color: #444!important;
    font-size: 12px;
    margin-left: -4px;
}
    .global-list.d-flex {
	margin-left: -81px!important;
}
    @media  screen and (min-width:1100px) and (max-width:1450px){
     .global-list.d-flex {
	margin-left: -57px !important;
}
      
    }
    @media  screen and (min-width:320px)and (max-width:767px){
          .sg-post.medium-post-style-1 .entry-thumbnail.new_erathumbnail img {
	width: 100%;
	height: auto!important;
}
     .global-list.d-flex {
	margin-left: -106px !important;
}   
    }
</style>




<?php $__env->startSection('content'); ?>
    <div class="sg-page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 sg-sticky">
                    <div class="theiaStickySidebar">
                        <div class="sg-section mb-2">
                            <div class="section-content search-content">
<!--
                                <div class="sg-search" style="width: 100%;">
                                    <div class="search-form">
                                        <form action="<?php echo e(route('article.search')); ?>" id="search" method="GET">
                                            <input class="form-control" name="search" type="text" value="<?php echo e(request()->get('search', '')); ?>" placeholder="<?php echo e(__('search')); ?>">
                                            <button type="submit"><i class="fa fa-search"></i></button>
                                        </form>
                                    </div>
                                </div>
-->
                                <div class="latest-post-area row">
                                    <?php if(!blank($posts)): ?>
                                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="col-md-4">
                                            <div class=" sg-post medium-post-style-1">
                                                <div class="entry-header">
                                                    <div class="entry-thumbnail new_erathumbnail">
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
                                                            <li><a href="<?php echo e(url('category',$post->category->slug)); ?>"><?php echo e($post->category->category_name); ?></a></li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
-->
                                                <div class="entry-content align-self-center">
                                                    
                                                  
													<h3 class="entry-title"><a
                                                            href="<?php if($post->old_id): ?> <?php echo e(route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ])); ?> <?php else: ?> <?php echo e(route('article.detail', ['id' => $post->id, 'slug' => $post->slug ])); ?> <?php endif; ?>"><?php echo \Illuminate\Support\Str::limit($post->title, 130); ?></a>
                                                    </h3>
                                                     <div class="entry-meta mb-2">
                                                        <ul class="global-list">
                                                    <!--  <li><?php echo e(__('post_by')); ?> <a href="<?php echo e(route('site.author',['id' => $post->user->id])); ?>"><?php echo e($post->user->first_name); ?> </a></li>-->
                                                            <li> <?php echo e($post->updated_at->format('F j, Y')); ?></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
										</div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <?php if($posts->count() != 0): ?>
                                    <input type="hidden" id="last_id" value="1">
                                    <input type="hidden" id="searching" value="<?php echo e(request()->get('search', '')); ?>">

                                    
                                    <div class="col-sm-12 col-xs-12 d-none" id="latest-preloader-area">
                                        <div class="row latest-preloader">
                                            <div class="col-md-7 offset-md-5">
                                                <img src="<?php echo e(static_asset('site/images/')); ?>/preloader-2.gif" alt="Image" class="tr-preloader img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="row">
                                            <button class="btn-load-more <?php echo e($totalPostCount > 6? '':'d-none'); ?>" id="btn-load-more-search"> <?php echo e(__('load_more')); ?> </button>
                                            
                                                <button class="btn-load-more <?php echo e($totalPostCount > 6? 'd-none':''); ?>" id="no-more-data-home">
                                                    <a href="<?php echo e(url('/')); ?>/newshome"><?php echo e(__('Back to Home')); ?></a> </button>
                                            <input type="hidden" id="url" value="<?php echo e(url('')); ?>">
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Data Loader -->
                             <!-- <div class="auto-load text-center">
                                <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                                    <path fill="#000"
                                        d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                            from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                                    </path>
                                </svg>
                            </div>  -->
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
         var scrn = 800;
         $(window).scroll(function () {
              var scrns = $(window).scrollTop() - scrn;
              var higt = scrns + $(window).height();
             // console.log(scrns);     
             if ( higt >= $(document).height()) {
                console.log(higt);
                console.log($(document).height());
                 page++;
                 scrn =  scrn+500;
                 infinteLoadMore(page);                
             }
         });        
    });

    
    function infinteLoadMore(page) {

        var url = $("#url").val();
        var ps = "<?php echo $ps; ?>";
        if(ps == '0'){
            var formData = {
                last_id: page,
            };  
        }else{
            var formData = {
                last_id: page,
                search: $("#searching").val()
            };  
        }
       

        $.ajax({
            url: url + "/get-read-more-post-search",
                dataType: "json",
                type: "GET",
                data: formData,
                beforeSend: function () {
                    $('.auto-load').show();
                }
            })
            .done(function (data) {                
               // console.log(data), 
                $.each(data[0], function(a, b) {
                    $(".latest-post-area").append(b)
                }), 1 == data[1] && ($("#btn-load-more-search").hide(), $("#no-more-data-search").removeClass("d-none"));
                var last_id = parseInt($("#last_id").val());
                $("#last_id").val(last_id + 1), 
                $("#btn-load-more-search").prop("disabled", !1), 
                $("#latest-preloader-area").addClass("d-none"), 
                $("#no-more-data-home").removeClass('d-none');

                $('.auto-load').hide();
                // $("#data-wrapper").append(response);
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
        }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pharmashots\resources\views/site/pages/search.blade.php ENDPATH**/ ?>