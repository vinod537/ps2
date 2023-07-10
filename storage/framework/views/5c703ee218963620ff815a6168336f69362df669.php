

<div class="sg-widget news__0f1245">


	
	<div class="widget-newsletter text-center">
                    
		<h3 class="widget-title"><?php echo e(__('Join the PharmaShots family of 12000+ subscribers')); ?></h3>

<!--
		<p style="text-transform: uppercase;
				margin-top: -19px;
				margin-bottom: 24px;"><?php echo e(__('Join the PharmaShots Family')); ?></p>
-->

		<!-- <form action="<?php echo e(route('subscribe.newsletter')); ?>" class="tr-form" method="POST">
			<?php echo csrf_field(); ?>
			<label for="news" class="d-none">Newsletter</label>
			<input name="email" id="news" type="email" class="form-control" placeholder="<?php echo e(__('email_address')); ?>" required>
			<button class="b__9656" type="submit">Subscribe Now<span class="d-none"><?php echo e(__('email_address')); ?></span></button>
		</form> -->

		<div class="tr-form homenewsletter1">
			<label for="news" class="d-none">Newsletter</label>
			<input name="email" id="homenews1" type="email" class="form-control" placeholder="<?php echo e(__('email_address')); ?>" required>
			<button class="b__9656 homenewsletterclick1">Subscribe Now</button>
			<div class="newslettercheckboc" style="float: left;"><input type="checkbox"  name="accept" id="accept"> I accept the <a style="color: #ef3a0b" target="_blank" href="https://pharmashots.com/terms-conditions">Terms and Conditions</a></div>

			<div class="errorclass1"></div>
		</div>
	</div>
</div>
<style>
    @media  screen and (min-width:1000px) and (max-width:1450px){
        .news__lettersd .sg-sidebar.theiaStickySidebar {
	width: 97%;
	margin-right: 17px;
}
    }
.widget-newsletter {
	border-radius: 20px;
	background-color: rgb(255, 255, 255);
	box-shadow: 0px 0px 94px 6px rgba(107, 83, 254, 0.1);
	padding: 80px 0;
	text-align: center;
}
	.widget-title {
	font-weight: 500;
	color: #000;
	font-size: 27px;
	padding: 8px 20px;
	margin-bottom: 20px;
	text-transform: uppercase;
	background-color: transparent;
}
	
	.news__lettersd {
	float: left;
	width: 100%;
	background: #f4f8fb;
}
	
#news {
	background: rgb(233, 227, 254);
	border: 1px solid #0000001c;
	padding: 9px;
	font-size: 15px;
	width: 70%;
	border-radius: 7px;
	margin-bottom: 17px;
}
	
	.b__9656 {
	background:#073c65!important;
  
	border: none;
	color: #fff!important;
	padding: 7px 30px 7px 30px!important;
	border-radius: 7px!important;
}
	
	.tr-form {
	width: 44%;
	margin-left: auto;
	margin-right: auto;
}
	
		.news__lettersd .container {
	width: 68%;
}
	
	.tr-form {
	width: 60%;
	margin-left: auto;
	margin-right: auto;
}
    .section_app4 {
	float: left;
	width: 100%;
	padding-top: 0px;
	padding-bottom: 40px;
}
</style><?php /**PATH H:\xampp\htdocs\Notion\ps2\resources\views/site/widgets/newsletter.blade.php ENDPATH**/ ?>