<?php
$footerWidgets = data_get($widgets, \Modules\Widget\Enums\WidgetLocation::FOOTER, []);
?>


<?php echo $__env->make('site.partials.ads', ['ads' => $footerWidgets], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

 <?php echo $__env->make('site.layouts.footer.style_3', ['footerWidgets' => $footerWidgets], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php /**PATH H:\xampp\htdocs\Notion\ps2\resources\views/site/layouts/footer.blade.php ENDPATH**/ ?>