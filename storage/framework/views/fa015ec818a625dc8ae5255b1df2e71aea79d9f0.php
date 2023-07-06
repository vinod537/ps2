<div class="sg-inner-image m-2">

	<?php if(!blank($post_contents)): ?>
	<?php
		$video_count = 99;
	?>
	    <?php $__currentLoopData = $post_contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	        <?php
	       
	        $page = array_keys($content);
	        if($page[0] == 'video'){
	        	 $video_count++;
	        }

	        ?>

	        <?php echo $__env->make('site.pages.article.partials.contents.'.$page[0], compact('content', 'video_count'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

</div>
<?php /**PATH /var/www/html/resources/views/site/pages/article/partials/content.blade.php ENDPATH**/ ?>