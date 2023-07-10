<?php $__env->startSection('content'); ?>
    <?php if(!blank($primarySectionPosts)): ?>
    <?php echo $__env->make('site.partials.home.primary_section', [
        'section' => $primarySection,
        'posts' => $primarySectionPosts,
        'sliderPosts' => $sliderPosts,
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <div class="sg-main-content mb-4">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-8 sg-sticky">
                    <div class="theiaStickySidebar">
                        <?php echo $__env->make('site.partials.home.category_section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
    
    <div class="ps-testimonial-slider-section">
        <div class="container">
            <div class="all__heading">
                <h3>Testimonial</h3>
            </div>
            <div class="owl-carousel owl-theme ps-testimonial-slider">
                <div class="item">
                    <div class="ps-testimonial-slide">
                        <div class="ps-testimonial-img">
                            <img src="http://localhost/Notion/ps2/public/default-image/default-358x215.png" alt="">
                        </div>
                        <div class="ps-testimonial-body">
                            <p class="ps-testimonial-description">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corrupti explicabo distinctio, nam quasi natus ullam nostrum ratione asperiores a qui ex adipisci voluptates. Voluptatum quisquam sapiente consectetur. Ex, commodi fugit?</p>
                            <h4 class="ps-testimonial-user">- User Name</h4>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="ps-testimonial-slide">
                        <div class="ps-testimonial-img">
                            <img src="http://localhost/Notion/ps2/public/default-image/default-358x215.png" alt="">
                        </div>
                        <div class="ps-testimonial-body">
                            <p class="ps-testimonial-description">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corrupti explicabo distinctio, nam quasi natus ullam nostrum ratione asperiores a qui ex adipisci voluptates. Voluptatum quisquam sapiente consectetur. Ex, commodi fugit?</p>
                            <h4 class="ps-testimonial-user">- User Name</h4>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="ps-testimonial-slide">
                        <div class="ps-testimonial-img">
                            <img src="http://localhost/Notion/ps2/public/default-image/default-358x215.png" alt="">
                        </div>
                        <div class="ps-testimonial-body">
                            <p class="ps-testimonial-description">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corrupti explicabo distinctio, nam quasi natus ullam nostrum ratione asperiores a qui ex adipisci voluptates. Voluptatum quisquam sapiente consectetur. Ex, commodi fugit?</p>
                            <h4 class="ps-testimonial-user">- User Name</h4>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="ps-testimonial-slide">
                        <div class="ps-testimonial-img">
                            <img src="http://localhost/Notion/ps2/public/default-image/default-358x215.png" alt="">
                        </div>
                        <div class="ps-testimonial-body">
                            <p class="ps-testimonial-description">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corrupti explicabo distinctio, nam quasi natus ullam nostrum ratione asperiores a qui ex adipisci voluptates. Voluptatum quisquam sapiente consectetur. Ex, commodi fugit?</p>
                            <h4 class="ps-testimonial-user">- User Name</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<style>
body, html {
	font-weight: 400;
	color: #484848;
	font-size: 16px;	
	background:url(<?php echo e(static_asset('site/images/background__s.jpg')); ?>)!important;
	background-size: 100% 100% !important;
}
.form-control::placeholder {
	color: #6c757d;
	opacity: 1;
	background: #fffffff7;
}
    .s__09d_0.exccinte .item img {
	width: 81% !important;
	margin-top: 26px;
}
.video_sections__pro {
    width: 77%;
    margin: auto;
}
	@media  screen and (min-width:320px) and (max-width:767px) {
		 
	
			.exclusiveintheading {
	font-size: 22px !important;
}
.banner__s.d__059i.new_slider .container {
	width: 100% !important;
}	
		
	}

    .newsleehomepage #homenews1 {
    width: 96%;
}




.newsleehomepage .widget-newsletter.text-center {
    background-size: cover!important;
    height: 500px;
    margin-top: -14px;
    padding-top: 41px!important;
}

.newsleehomepage  .tr-form.homenewsletter1 {
    width: 53%!important;
    margin-top: 26px;
    margin-bottom: 25px!important;
}

.newsleehomepage .widget-newsletter.text-center {
    background-size: cover!important;
    height: 400px;
    margin-top: -14px;
    padding-top: 41px!important;
}

.newsleehomepage .sg-widget.news__0f1245 h3.widget-title {
    padding-top: 77px;
    width: 70%;
    margin-left: auto;
    margin-right: auto;
    font-size: 39px;
}
.newsleehomepage .newslettercheckboc {
    margin-top: 0;
}

.newsleehomepage  .sg-widget.news__0f1245 .b__9656 {
    background: #073c65!important;
}

section#newsletters {
    padding-top: 45px;
}
.newsleehomepage h3.widget-title.d__999 {
    display: none;
}
.newsleehomepage  .errorclass1 {
    width: 100% !important;
    float: left;
    padding-top: 10px;
    color: red;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\xampp\htdocs\Notion\ps2\resources\views/site/pages/home.blade.php ENDPATH**/ ?>