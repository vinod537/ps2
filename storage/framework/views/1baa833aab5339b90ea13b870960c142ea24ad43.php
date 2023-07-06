<?php if(!blank($ads)): ?>
    <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $headerWidget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(data_get($headerWidget, 'view') == 'ad_widget'): ?>
            <?php
                $ad = data_get($headerWidget, 'detail.ad');
            ?>
            <div class="sg-ad">
                <div class="container">
                    <div class="ad-content">
                        <?php if(@$ad->ad_type == 'image'): ?>
                            <a href="<?php echo e(data_get($ad, 'ad_url', '#') ?  data_get($ad, 'ad_url', '#') : '#'); ?>">
                                <?php if(isFileExist(@$ad->adImage, $result = @$ad->adImage->original_image)): ?>
                                    <img class="img-fluid lazy" src="<?php echo e(safari_check() ? basePath(@$ad->adImage).'/'.$result : static_asset('default-image/default-add-728x90.png')); ?> " data-original="<?php echo e(basePath($ad->adImage)); ?>/<?php echo e($result); ?>" alt="<?php echo e($ad->ad_name); ?>">
                                <?php else: ?>
                                    <img src="<?php echo e(static_asset('default-image/default-add-728x90.png')); ?> "  class="img-fluid lazy"   alt="<?php echo $ad->ad_name; ?>" >
                                <?php endif; ?>
                            </a>
                        <?php elseif(@$ad->ad_type == 'code'): ?>
                            <?php echo $ad->ad_code ?? ''; ?>

                        <?php elseif(@$ad->ad_type == 'text'): ?>
                            <?php echo $ad->ad_text ?? ''; ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\pharmashots\resources\views/site/partials/ads.blade.php ENDPATH**/ ?>