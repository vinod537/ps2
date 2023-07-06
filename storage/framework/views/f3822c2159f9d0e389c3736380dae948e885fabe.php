<style>
.author-section .container {
	width: 63%;
}
	body {
	background: #f4f8fb;
}
	
	.sg-post {
	box-shadow: 8px 14px 38px rgba(39,44,49,.06),1px 3px 8px rgba(39,44,49,.03);
	border-radius: 6px;
}
	.entry-thumbnail img {
	width: 100%;
	height: 239px;
}
	
	.entry-header {
	height: 240px;
	border-bottom: 1px solid #0000001c;
}
	.entry-title p {
	color: #000;
	font-size: 16px;
	height: 43px;
}
	.author #profile-img {
	border-radius: 50%;
	height: 100px !important;
	width: 100px !important;
	border: 2px solid #0000003d;
	padding: 3px;
	background: #fff;
}
	.author-top-content .author {
	min-width: 102px;
	margin-right: 30px;
}
	
	.author-top-content.d-md-flex {
	background: transparent;
	padding: 12px 0 0px 0px;
	margin-bottom: 27px;
}
	
	.author-info h2 {
	color: #000;
	margin-bottom: 15px;
}
	
	.author-top-content .author {
	min-width: 105px!important;
	margin-right: 30px;
}
	
	.author-info .global-list a {
	background: #ef3c0d;
	color: #fff;
	padding: 3px 10px 4px 8px;
	border-radius: 32px;
}
</style>


<?php $__env->startSection('content'); ?>
    <div class="author-section">
        <div class="container">
            <div class="author-content">
                <div class="author-top-content d-md-flex">
                    <div class="author">
                        <?php if(@$author->profile_image != null): ?>
                            <img src="<?php echo e(static_asset('default-image/user.jpg')); ?>" data-original=" <?php echo e(static_asset(@$author->profile_image)); ?>" id="profile-img" class="img-fluid"   >
                        <?php else: ?>
                            <img src="<?php echo e(static_asset('default-image/user.jpg')); ?>"   id="profile-img" class="img-fluid">
                        <?php endif; ?>
                    </div>
                    <div class="author-info">
                        <h2><?php echo e($author->first_name.' '.$author->last_name); ?></h2>
                        <div class="<?php echo e(Sentinel::check($author->id) ? "active":"away"); ?>">
                            <span><?php echo e(__('last_login')); ?>: <?php echo e(date('l, d F Y, h:i a' , strtotime(Sentinel::findById($author->id)->last_login))); ?></span>
                        </div>
                        <p><?php echo e($author->about_us); ?></p>
                        <div class="entry-meta">
                            <ul class="global-list">
                                <li><a href="#"><?php echo e(__('member_since')); ?> <?php echo e($author->created_at->format('F j, Y')); ?></a></li>
                                <?php if(@$author->permissions['email_show'] == 1): ?>
                                    <li><i class="fa fa-envelope-o"></i><a href="mailto: <?php echo e($author->email); ?>"><?php echo e($author->email); ?></a></li>
                                <?php endif; ?>
                            </ul>
                        </div><!-- /.entry-meta -->
                        <div class="sg-social">
                            <ul class="global-list d-flex">
                                <?php if(@$author->social_media['facebook_url'] != null): ?>
                                    <li><a href="<?php echo e(@$author->social_media['facebook_url']); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                                <?php if(@$author->social_media['twitter_url'] != null): ?>
                                    <li><a href="<?php echo e(@$author->social_media['twitter_url']); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                                <?php if(@$author->social_media['instagram_url'] != null): ?>
                                    <li><a href="<?php echo e(@$author->social_media['instagram_url']); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                                <?php if(@$author->social_media['google_url'] != null): ?>
                                    <li><a href="<?php echo e(@$author->social_media['google_url']); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                                <?php if(@$author->social_media['pinterest_url'] != null): ?>
                                    <li><a href="<?php echo e(@$author->social_media['pinterest_url']); ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                                <?php if(@$author->social_media['youtube_url'] != null): ?>
                                    <li><a href="<?php echo e(@$author->social_media['youtube_url']); ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                                <?php if(@$author->social_media['linkedin_url'] != null): ?>
                                    <li><a href="<?php echo e(@$author->social_media['linkedin_url']); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                            </ul>
                        </div><!-- /.sg-social -->
                    </div>
                </div><!-- /.author-top-content -->
                <div class="row">
                    <div class="col-md-12">
                            <div class="row latest-post-area-profile">
                                <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-4">
                                        <div class="sg-post">
                                            <div class="entry-header">
                                                <div class="entry-thumbnail">
                                                    <a href="<?php echo e(route('article.detail', ['id' => @$post->slug])); ?>">
                                                        <?php if(isFileExist($post->image, $result =  @$post->image->medium_image)): ?>
                                                            <img src="<?php echo e(safari_check() ? basePath(@$post->image).'/'.$result : static_asset('default-image/default-358x215.png')); ?> " data-original=" <?php echo e(basePath($post->image)); ?>/<?php echo e($result); ?> " class="img-fluid lazy"   alt="<?php echo $post->title; ?>"  >
                                                        <?php else: ?>
                                                            <img src="<?php echo e(static_asset('default-image/default-358x215.png')); ?> "  class="img-fluid"   alt="<?php echo $post->title; ?>" >
                                                        <?php endif; ?>
                                                    </a>
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
                                            <div class="entry-content">
                                                <h3 class="entry-title"><a href="<?php echo e(route('article.detail', ['id' => $post->slug])); ?>"><p><?php echo \Illuminate\Support\Str::limit($post->title, 50); ?></p></a></h3>
                                                <div class="entry-meta mb-2">
                                                    <ul class="global-list">
                                                        <li><?php echo e(__('post_by')); ?> <a href="<?php echo e(route('site.author',['id' => $post->user->id])); ?>"><?php echo e(data_get($post, 'user.first_name')); ?></a></li>
                                                        <li><a href="<?php echo e(route('article.date', date('Y-m-d', strtotime($post->updated_at)))); ?>"><?php echo e($post->updated_at->format('F j, Y')); ?></a></li>
                                                    </ul>
                                                </div><!-- /.entry-meta -->
                                                <p> <?php echo strip_tags(\Illuminate\Support\Str::limit($post->content, 130)); ?></p>
                                            </div><!-- /.entry-content -->
                                        </div><!-- /.sg-post -->
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div><!-- /.more-post-area -->
                        <?php if($articles->count() != 0): ?>
                            <input type="hidden" id="last_id_profile" value="1">
                            <input type="hidden" id="author_id" value="<?php echo e($author->id); ?>">
                            <div class="col-sm-12 col-xs-12 d-none" id="latest-preloader-area-profile">
                                <div class="row latest-preloader">
                                    <div class="col-md-7 offset-md-5">
                                        <img src="<?php echo e(static_asset('site/images/')); ?>/preloader-2.gif" alt="Image" class="tr-preloader img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="row">

                                    <button class="btn-load-more <?php echo e($totalPostCount > 12? '':'d-none'); ?>" id="btn-load-more-profile"> <?php echo e(__('load_more')); ?> </button>


                                    <button class="btn-load-more <?php echo e($totalPostCount > 12? 'd-none':''); ?>" id="no-more-data-profile">
                                        <?php echo e(__('no_more_records')); ?>    </button>
                                    <input type="hidden" id="url" value="<?php echo e(url('')); ?>">

                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div><!-- /.author-content -->
        </div><!-- /.container -->
    </div><!-- /.author-section -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/site/pages/author/profile.blade.php ENDPATH**/ ?>