<?php if(!blank($section)): ?>
    <?php
    $posts = $posts->where('visibility', 1)
    	->where('status', 1);

    $viewFile = 'site.partials.home.primary.'.$section->section_style ?? 'style_1'; ?>

    <?php if(view()->exists($viewFile)): ?>
        <?php echo $__env->make($viewFile, ['posts' => $posts, 'breakingNewss' => $breakingNewss, 'language' => $language], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/site/partials/home/primary_section.blade.php ENDPATH**/ ?>