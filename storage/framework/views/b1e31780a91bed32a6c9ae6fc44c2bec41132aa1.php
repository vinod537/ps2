<?php if($post->post_type=='video'): ?>
    <?php if($post->video_id != null): ?>

        <?php if(isFileExist(@$post->videoThumbnail, @$post->videoThumbnail->big_image_two)): ?>


            <video id='player' autoplay controls
                   poster="<?php echo e(basePath($post->videoThumbnail)); ?>/<?php echo e($post->videoThumbnail->big_image_two); ?> ">
                <?php else: ?>
                    <video id='player' autoplay controls
                           poster="<?php echo e(static_asset('default-image/default-730x400.png')); ?>">
                        <?php endif; ?>
                        
                        <?php if($post->video->v_144p==null and
                            $post->video->v_240p==null and
                            $post->video->v_360p==null and
                            $post->video->v_480p==null and
                            $post->video->v_720p==null and
                            $post->video->v_1080p==null
                        ): ?>
                            <source src="<?php echo e(basePath($post->video)); ?>/<?php echo e($post->video->original); ?>"
                                    type="video/<?php echo e($post->video->video_type); ?>"/>

                        <?php else: ?>
                            <?php $video_version = array('v_1080p', 'v_720p', 'v_480p', 'v_360p', 'v_240p', 'v_144p') ?>

                            <?php $__currentLoopData = $video_version; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $version): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($post->video->$version !=null): ?>
                                    <source src="<?php echo e(basePath($post->video)); ?>/<?php echo e($post->video->$version); ?>"
                                            size="<?php echo e(str_replace(array("v_1080p","v_720p","v_480p","v_360p","v_240p","v_144p"), array("1080", "720","576","480","360","240"), $version)); ?>"
                                            type="video/<?php echo e($post->video->video_type); ?>"/>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </video>

                    <?php else: ?>
                        <?php if($post->video_url_type == "youtube_url"): ?>
                            <div id="player" autoplay data-plyr-provider="youtube"
                                 data-plyr-embed-id="<?php echo e(get_id_youtube($post->video_url)); ?>"></div>
                        <?php elseif($post->video_url_type == "mp4_url"): ?>
                            <video id="player" autoplay playsinline controls
                                   data-poster="<?php echo e(basePath(@$post->image)); ?>/<?php echo e(@$post->image->big_image_two); ?>">
                                <source src="<?php echo e($post->video_url); ?>" type="video/mp4"/>
                            </video>
                        <?php else: ?>
                            <img class="img-fluid" src="<?php echo e(static_asset('default-image/default-730x400.png')); ?> "
                                 alt="<?php echo $post->alt_tag; ?>">
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php else: ?>
                    <?php
                       // print_r($post);
                       
                    ?>
                        <?php if(isFileExist(@$post->image, $result = @$post->image->original_image)): ?>
                            <img class="img-fluid"
                                 src="<?php echo e(safari_check() ? basePath(@$post->image).'/'.$result : static_asset('default-image/default-730x400.png')); ?> "
                                 data-original="<?php echo e(basePath(@$post->image)); ?>/<?php echo e($result); ?>"
                                 alt="<?php echo $post->alt_tag; ?>">
                        <?php else: ?>
                            <img class="img-fluid" src="<?php echo e(static_asset('default-image/default-730x400.png')); ?> "
                                 alt="<?php echo $post->alt_tag; ?>">
        <?php endif; ?>

    <?php endif; ?>
<?php /**PATH H:\xampp\htdocs\Notion\ps2\resources\views/site/pages/article/partials/detail_image.blade.php ENDPATH**/ ?>