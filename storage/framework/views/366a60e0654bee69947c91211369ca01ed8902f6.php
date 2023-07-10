<?php
    $rightWidgets = data_get($widgets, \Modules\Widget\Enums\WidgetLocation::RIGHT_SIDEBAR, []);
?>

<?php $__currentLoopData = $rightWidgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        //dd($widget['view']);
        $viewFile = 'site.widgets.'.$widget['view'];
    ?>
    <?php if(view()->exists($viewFile)): ?>
        <?php echo $__env->make($viewFile, $widget, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH H:\xampp\htdocs\Notion\ps2\resources\views/site/partials/right_sidebar_widgets.blade.php ENDPATH**/ ?>