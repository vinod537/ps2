<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $__env->yieldContent('title'); ?></title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(static_asset('site/css/minimal.css')); ?>">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="code">
                <?php echo $__env->yieldContent('code'); ?>
            </div>

            <div class="message p-3">
                <?php echo $__env->yieldContent('message'); ?>
            </div>
        </div>
    </body>
</html>
<?php /**PATH H:\xampp\htdocs\Notion\ps2\resources\views/errors/minimal.blade.php ENDPATH**/ ?>