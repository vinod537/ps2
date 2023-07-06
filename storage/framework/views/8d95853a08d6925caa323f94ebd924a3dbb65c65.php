<?php $__env->startSection('content'); ?>

    <div class="sg-main-content mb-4">

        <div class="container">

            <div class="row">

                <div class="col-md-7 col-lg-8 sg-sticky">

                    <div class="theiaStickySidebar">



                            <div class="sg-section">

                                <div class="section-content">

                                    <div class="latest-post-area">

                                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <div class="sg-post medium-post-style-1">

                                            <div class="entry-header">

                                                <div class="entry-thumbnail">

                                                    <a href="<?php echo e(route('article.detail', ['id' => $post->slug])); ?>">

                                                        <?php if(isFileExist($post->image, $result =  @$post->image->medium_image)): ?>

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

                                                        <li><a  class="<?php echo e($post->category->slug); ?>"  href="<?php echo e(url('category',$post->category->slug)); ?>"><?php echo e($post->category->category_name); ?></a></li>

                                                    <?php endif; ?>

                                                </ul>

                                            </div>

                                            <div class="entry-content align-self-center">

                                                <h3 class="entry-title"><a

                                                        href="<?php echo e(route('article.detail', ['id' => $post->slug])); ?>"><?php echo \Illuminate\Support\Str::limit($post->title, 65); ?></a>

                                                </h3>

                                                <div class="entry-meta mb-2">

                                                    <ul class="global-list">

                                                        <li><?php echo e(__('post_by')); ?> <a href="<?php echo e(route('site.author',['id' => $post->user->id])); ?>"><?php echo e($post->user->first_name); ?> </a></li>

                                                        <li><?php echo e($post->updated_at->format('F j, Y')); ?></li>

                                                    </ul>

                                                </div>

                                                <p><?php echo strip_tags(\Illuminate\Support\Str::limit($post->content, 120)); ?></p>

                                            </div>

                                        </div>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </div>

                                    <?php if($posts->count() != 0): ?>

                                        <input type="hidden" id="last_id" value="1">

                                        <input type="hidden" id="sub_category_id" value="<?php echo e($id); ?>">

                                        <div class="col-sm-12 col-xs-12 d-none" id="latest-preloader-area">

                                            <div class="row latest-preloader">

                                                <div class="col-md-7 offset-md-5">

                                                    <img src="<?php echo e(static_asset('site/images/')); ?>/preloader-2.gif" alt="Image" class="tr-preloader img-fluid">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-sm-12 col-xs-12">

                                            <div class="row">

                                                <button class="btn-load-more <?php echo e($totalPostCount > 6? '':'d-none'); ?>" id="btn-load-more-subcategory"> <?php echo e(__('load_more')); ?> </button>

                                                <!-- <button class="btn-load-more <?php echo e($totalPostCount > 6? 'd-none':''); ?>" id="no-more-data">

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
         var scrn = 800;
         $(window).scroll(function () {
              var scrns = $(window).scrollTop() - scrn;
              var higt = scrns + $(window).height();
             if ( higt >= $(document).height()) {
                 page++;
                 scrn =  scrn+800;
                 infinteLoadMore(page);                
             }
         });        
    });

    
    function infinteLoadMore(page) {

        var url = $("#url").val();
        var formData = {
            last_id: page,
            category_id: $('#sub_category_id').val()
        };  
        $.ajax({
            type: "GET",
            dataType: 'json',
            data: formData,
            url: url + '/' + 'get-read-more-post-subcategory',
            success: function (data) {

                $.each(data[0], function (key, value) {
                    $(".latest-post-area").append(value);
                });

                if (data[1] == 1) {
                    $("#btn-load-more-category").hide();
                    $("#no-more-data").removeClass('d-none');
                    $("#no-more-data-home").removeClass('d-none');
                    $("#event-form-data").removeClass('d-none');
                }

                last_id = parseInt($('#last_id').val());
                $('#last_id').val(last_id + 1);
                $("#btn-load-more-category").prop("disabled", false);

                $("#latest-preloader-area").addClass('d-none');               

            },
            error: function (data) {
                // console.log('Error:', data);
            }
        });
        }
</script>
<?php $__env->stopSection(); ?>






<?php echo $__env->make('site.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/site/pages/sub_category_posts.blade.php ENDPATH**/ ?>