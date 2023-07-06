<style>
.author-section {
	padding-top: 130px;
}
	.author-section .container {
	max-width: 66%;
}
	.author #profile-img {
	height: 50px !important;
	width: 50px !important;
	border-radius: 91%;
	border: 1px solid #00000038;
}
	.author-top-content .author {
	min-width: 55px;
	margin-right: 30px;
}
.latest-post-area-profile .sg-post .entry-content {
    height: 210px;
}
</style>


<?php $__env->startSection('my-profile'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="author-section">
        <div class="container">
            <div class="author-content">
                <div class="author-top-content d-md-flex">
                    <div class="author" style="min-width: 52px !important;">
                        <?php if(Sentinel::getUser()->profile_image != null): ?>
                            <img src="<?php echo e(static_asset('default-image/user.jpg')); ?>"
                                 data-original=" <?php echo e(static_asset(Sentinel::getUser()->profile_image)); ?>" id="profile-img"
                                 class="img-fluid">
                        <?php else: ?>
                            <img src="<?php echo e(static_asset('default-image/user.jpg')); ?>" id="profile-img" class="img-fluid">
                        <?php endif; ?>
                    </div>
                    <div class="author-info">
                        <h2><?php echo e(Sentinel::getUser() ? Sentinel::getUser()->first_name.' '.Sentinel::getUser()->last_name : ''); ?></h2>
                        <div class="active">
                            <span><?php echo e(__('last_login')); ?>: <?php echo e(date('l, d F Y, h:i a' , strtotime(Sentinel::getUser()->last_login))); ?></span>
                        </div>
                        <p><?php echo e(Sentinel::getUser()->about_us); ?></p>

                        <div class="entry-meta">
                            <ul class="global-list">
                                <li>
                                    <i class="fa fa-birthday-cake" aria-hidden="true"></i> <a href="#"><?php echo e(date('d F, Y', strtotime(Sentinel::getUser()->dob))); ?></a>
                                </li>
                                <li><i class="fa fa-mars" aria-hidden="true"></i>
                                    <a href="#">
                                        <?php if(Sentinel::getUser()->gender == \App\Enums\GenderType::Male): ?>
                                            <?php echo e('Male'); ?>

                                        <?php elseif(Sentinel::getUser()->gender == \App\Enums\GenderType::Female): ?>
                                            <?php echo e('Female'); ?>

                                        <?php else: ?>
                                            <?php echo e('Other'); ?>

                                        <?php endif; ?>
                                    </a>
                                </li>
                            </ul>
                        </div><!-- /.entry-meta -->
                        <div class="entry-meta mt-4 ml-0">
                            <ul class="global-list">
                                <li>
                                    <a href="#"><?php echo e(__('member_since')); ?>: <?php echo e(Sentinel::getUser()->created_at->format('F j, Y')); ?></a>
                                </li>
                                <li><i class="fa fa-envelope-o"></i><a href="#"><?php echo e(Sentinel::getUser()->email); ?></a>
                                </li>
                            </ul>
                        </div><!-- /.entry-meta -->
                        <div class="sg-social">
                            <ul class="global-list d-flex">
                                <?php if(@Sentinel::getUser()->social_media['facebook_url'] != null): ?>
                                    <li><a href="<?php echo e(@Sentinel::getUser()->social_media['facebook_url']); ?>"><i
                                                class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                                <?php if(@Sentinel::getUser()->social_media['twitter_url'] != null): ?>
                                    <li><a href="<?php echo e(@Sentinel::getUser()->social_media['twitter_url']); ?>"><i
                                                class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                                <?php if(@Sentinel::getUser()->social_media['instagram_url'] != null): ?>
                                    <li><a href="<?php echo e(@Sentinel::getUser()->social_media['instagram_url']); ?>"><i
                                                class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                                <?php if(@Sentinel::getUser()->social_media['google_url'] != null): ?>
                                    <li><a href="<?php echo e(@Sentinel::getUser()->social_media['google_url']); ?>"><i
                                                class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                                <?php if(@Sentinel::getUser()->social_media['pinterest_url'] != null): ?>
                                    <li><a href="<?php echo e(@Sentinel::getUser()->social_media['pinterest_url']); ?>"><i
                                                class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                                <?php if(@Sentinel::getUser()->social_media['youtube_url'] != null): ?>
                                    <li><a href="<?php echo e(@Sentinel::getUser()->social_media['youtube_url']); ?>"><i
                                                class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                                <?php if(@Sentinel::getUser()->social_media['linkedin_url'] != null): ?>
                                    <li><a href="<?php echo e(@Sentinel::getUser()->social_media['linkedin_url']); ?>"><i
                                                class="fa fa-linkedin" aria-hidden="true"></i></a></li>
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
                                                <a href="<?php echo e(route('article.detail', ['id' => $post->id, 'slug' => $post->slug])); ?>">
                                                    <?php if(isFileExist($post->image, $result = @$post->image->medium_image)): ?>
                                                        <img
                                                            src="<?php echo e(safari_check() ? basePath(@$post->image).'/'.$result : static_asset('default-image/default-358x215.png')); ?> "
                                                            data-original=" <?php echo e(basePath($post->image)); ?>/<?php echo e($result); ?> "
                                                            class="img-fluid" alt="<?php echo $post->title; ?>">
                                                    <?php else: ?>
                                                        <img
                                                            src="<?php echo e(static_asset('default-image/default-358x215.png')); ?> "
                                                            class="img-fluid" alt="<?php echo $post->title; ?>">
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                            <div class="category">
                                                <ul class="global-list">
                                                    <?php if(isset($post->category->category_name)): ?>
                                                        <li><a href="<?php echo e(url('category',$post->category->slug)); ?>"><?php echo e($post->category->category_name); ?></a></li>
                                                    <?php endif; ?>
                                                </ul>
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
                                        <div class="entry-content">
                                            <h3 class="entry-title"><a
                                                    href="<?php echo e(route('article.detail', ['id' => $post->id, 'slug' => $post->slug])); ?>">
                                                    <p><?php echo \Illuminate\Support\Str::limit($post->title, 50); ?></p></a>
                                            </h3>
                                            <div class="entry-meta mb-2 ml-0">
                                                <ul class="global-list">
                                                    <li><?php echo e(__('post_by')); ?> <a
                                                            href="<?php echo e(route('site.author',['id' => $post->user->id])); ?>"><?php echo e(data_get($post, 'user.first_name')); ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo e(route('article.date', date('Y-m-d', strtotime($post->updated_at)))); ?>"><?php echo e($post->updated_at->format('F j, Y')); ?></a>
                                                    </li>
                                                </ul>
                                            </div><!-- /.entry-meta -->
                                            <p> <?php echo strip_tags(\Illuminate\Support\Str::limit($post->content, 130)); ?></p>
                                        </div><!-- /.entry-content -->
                                    </div><!-- /.sg-post -->
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div><!-- /.row -->
                        <?php if($articles->count() != 0): ?>
                            <input type="hidden" id="last_id_profile" value="1">
                            <input type="hidden" id="author_id" value="<?php echo e(Sentinel::getUser()->id); ?>">
                            <div class="col-sm-12 col-xs-12 d-none" id="latest-preloader-area-profile">
                                <div class="row latest-preloader">
                                    <div class="col-md-7 offset-md-5">
                                        <img src="<?php echo e(static_asset('site/images/')); ?>/preloader-2.gif" alt="Image"
                                             class="tr-preloader img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="row">

                                    <button class="btn-load-more <?php echo e($totalPostCount > 12? '':'d-none'); ?>"
                                            id="btn-load-more-profile"> <?php echo e(__('load_more')); ?> </button>


                                    <button class="btn-load-more <?php echo e($totalPostCount > 12? 'd-none':''); ?>"
                                            id="no-more-data-profile">
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



<?php echo $__env->make('site.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pharmashots\resources\views/site/pages/author/my_profile.blade.php ENDPATH**/ ?>