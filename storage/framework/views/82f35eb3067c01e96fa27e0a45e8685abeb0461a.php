
<?php $__currentLoopData = $categorySections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorySection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            if($categorySection->type != 3):
                $viewFile = 'site.partials.home.category.'. data_get($categorySection, 'section_style', 'style_1');
            else:
                $viewFile = 'site.partials.home.category.latest_posts';
            endif;
        ?>

    <?php
        if($categorySection->type == 1):
            $posts = data_get($categorySection, 'post', collect([]));
        elseif($categorySection->type == 2):
            $posts = $video_posts;
        elseif($categorySection->type == 3):
            $posts = $latest_posts;
        endif;
    ?>

    <?php if(!blank($posts)): ?>
        <?php if(view()->exists($viewFile)): ?>
            <?php echo $__env->make($viewFile, [
                '$categorySection' => $categorySection,
                '$posts' => $posts
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if(data_get($categorySection, 'ad') != ""): ?>
            <?php echo $__env->make('site.partials.home.category.ad_section', ["ad" => data_get($categorySection, 'ad')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH H:\xampp\htdocs\Notion\ps2\resources\views/site/partials/home/category_section.blade.php ENDPATH**/ ?>