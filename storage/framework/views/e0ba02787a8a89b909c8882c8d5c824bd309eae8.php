<?php
$headerWidgets = data_get($widgets, \Modules\Widget\Enums\WidgetLocation::HEADER, []);
?>



    <?php echo $__env->make('site.layouts.header.style_6', ['headerWidgets' => $headerWidgets], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<style>

.paragraph ul li span {
    font-style: normal !important;
    display: block !important;
}
</style>

<?php if(data_get(activeTheme(), 'options.header_style') != 'header_1'): ?>
<div class="container minssinglescontct">
    <div class="row">
        <div class="col-12">
            <?php if(session('error')): ?>
                <div id="error_m" class="alert alert-danger">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>
            <?php if(session('success')): ?>
                <div id="success_m" class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <?php if(isset($errors)): ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>


<style>
.navbar-brand {
	max-width: 275px;
}
	
	.footer-content .sg-socail li a {
	width: 35px;
	height: 35px;
	line-height: 32px;
	display: block;
	text-align: center;
	border-radius: 100%;
	color: #333;
	font-size: 15px;
	border: 1px solid #3d9be140;
	line-height: 26px !important;
	padding-top: 10px;
}
	

</style>
<?php /**PATH H:\xampp\htdocs\Notion\ps2\resources\views/site/layouts/header.blade.php ENDPATH**/ ?>