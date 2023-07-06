<div class="entry-header">
	
	
	    
	
	
    <div class="entry-thumbnail" height="100%">
        <?php echo $__env->make('site.pages.article.partials.detail_image', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

	
	<div class="author-top-content d-md-flex new__lis__078899">
		                <div class="row">
							<div class="col-md-4">  
                    <div class="author d_09rr">
                        <?php if(@$author->profile_image != null): ?>
                            <img src="<?php echo e(static_asset('default-image/user.jpg')); ?>" data-original=" <?php echo e(static_asset(@$author->profile_image)); ?>" id="profile-img" class="img-fluid"   >
                        <?php else: ?>
                            <img src="<?php echo e(static_asset('default-image/user.jpg')); ?>"   id="profile-img" class="img-fluid">
                        <?php endif; ?>
                    </div>   
                    <div class="author-info">   
						<?php
							//dd($author);
						?>
                        <h2><a href="<?php echo e(url('page/about-us#our_team')); ?>"><?php echo e($author->first_name.' '.$author->last_name); ?></a>
                       
                        </h2>      
							</div>
							</div>   
						<div class="col-md-4">
						 <span class="new_datedfg">
							 <div class="entry-meta mb-2 datesdsf new__sdat">
							<ul class="global-listfg">
								<li><i class="fa fa-calendar-minus-o" aria-hidden="true"></i>
									<?php echo e($post->updated_at->format('M j, Y')); ?>

								</li>
							</ul>
						</div>
							</span>
							</div>        
							<div class="col-md-4">       
						<h3 class="entry-title categoryforsingle dfhdgd">    
							<?php
							
								if($post->category_id){
									$categoryids = json_decode($post->category_id);
									foreach($categoryids as $category){
									$dataCat = 	\Modules\Post\Entities\Category::find($category);
									?>
									<a class="<?php echo e($dataCat->slug); ?>" href="<?php echo e(url('category',$dataCat->slug)); ?>"><?php echo e($dataCat->category_name); ?></a>

									<?php						
									}
								}
							?>
						<!-- <?php if(isset($post->category->category_name)): ?>
							<a class="<?php echo e($dataCat->slug); ?>" href="<?php echo e(url('category',$dataCat->slug)); ?>"><?php echo e($dataCat->category_name); ?></a>
						<?php endif; ?> -->
							</h3>
							</div>
						
						</div>   
<!--
                        <div class="<?php echo e(Sentinel::check($author->id) ? "active":"away"); ?>">
                            <span><?php echo e(__('last_login')); ?>: <?php echo e(date('l, d F Y, h:i a' , strtotime(Sentinel::findById($author->id)->last_login))); ?></span>
                        </div>
-->
<!--   
                        <p><?php echo e($author->about_us); ?></p>
                        <div class="entry-meta">
                            <ul class="global-list">
                                <li><a href="#"><?php echo e(__('member_since')); ?> <?php echo e($author->created_at->format('F j, Y')); ?></a></li>
                                <?php if(@$author->permissions['email_show'] == 1): ?>
                                    <li><i class="fa fa-envelope-o"></i><a href="mailto: <?php echo e($author->email); ?>"><?php echo e($author->email); ?></a></li>
                                <?php endif; ?>
                            </ul>
-->
                        </div><!-- /.entry-meta -->
                    </div>
                </div>
	
	
	<h3 class="entry-title dse"><?php echo $post->title ?? ''; ?></h3>
	
	
</div>


				

<div class="entry-content p-4 add__class__088">
    

    <?php if(@$post->post_type == 'audio'): ?>
        <?php echo $__env->make('site.pages.article.partials.audio', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <div class="paragraph">
        <?php echo $post->content; ?>

    </div>
	
	<?php if($post->press_release_link): ?>
		<div class="readpressrealease">
			<a href="<?php echo e($post->press_release_link); ?>">Click here</a>&nbsp;to&shy; read the full press release&nbsp;
			
			</a>
		</div>
	<?php endif; ?>
    <?php if(isset($post->read_more_link)): ?>
        <div class="rss-content-actual-link">
            <a href="<?php echo e($post->read_more_link); ?>" class="btn btn-primary" target="_blank"><?php echo e(__('read_actual_content')); ?> <i class="fa fa-long-arrow-right"></i>
            </a>
        </div>
    <?php endif; ?>
    <?php echo $__env->make('site.pages.article.partials.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(settingHelper('adthis_option')==1 and settingHelper('addthis_public_id')!=null and settingHelper('addthis_toolbox')!=null): ?>
        <?php echo base64_decode(settingHelper('addthis_toolbox')); ?>

    <?php endif; ?>

    <?php if(@$post->post_type == 'trivia-quiz'): ?>
        <?php echo $__env->make('site.pages.article.partials.trivia-quiz', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(@$post->post_type == 'personality-quiz'): ?>
        <?php echo $__env->make('site.pages.article.partials.personality-quiz', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <!-- <?php if(@$post->user->permissions['author_show'] == 1): ?>
        <?php echo $__env->make('site.pages.article.partials.author', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?> -->

</div>


<style>

body {
	background: #fff;
}
	.sg-post {
	
	box-shadow: none;
}
	


	.datesdsf .global-list li a {
	color: #c12323 !important;
	font-size: 15px;
	letter-spacing: 3px;
	text-transform: uppercase;
}
	

	
	.entry-title.dse {
	text-align: left;
	color: #000;
	font-size: 39px;
	margin-bottom: 90px;
	font-weight: 600;
}
	.theiaStickySidebar.post-details .sg-post {
	padding-bottom: 15px!important;
}

	
	.entry-content.p-4.add__class__088 {
	background: #fff;
	padding: 0px !important;
}
	
	.entry-content.p-4.add__class__088 {
	float: left;
	width: 100%;
	/* background: red; */
}
	
	.add__class__088 ul {
	padding: 0px;
}
	
	.entry-content.p-4.add__class__088 {
	position: relative;
	z-index: 99;
	background: #fff;
}

	.paragraph ul li span {
	font-style: italic;
	font-size: 14px;
	line-height: 22px;
	margin-bottom: 9px !important;
	display: inline-block;
}
	
		.section-title {
	margin-bottom: 0px;
	border-bottom: none;
}
	.contact-form, .sg-comments-area, .tagcloud-style-1 {
	padding: 3px;
	background-color: #fff;
	-webkit-box-shadow: 0 6px 12px rgba(0,0,0,.075);
	-moz-box-shadow: 0 6px 12px rgba(0,0,0,.075);
	-ms-box-shadow: 0 6px 12px rgba(0,0,0,.075);
	-o-box-shadow: 0 6px 12px rgba(0,0,0,.075);
	box-shadow: none;
}
	.author.d_09rr #profile-img {
	width: 40px !important;
	height:40px !important;
	border-radius: 115%;
	border: 1px solid #0000001f;
}
	.author-top-content .author {
	min-width: 49px;
	margin-right: 30px;
}
	
	.author-top-content .author {
	min-width: 28px;
	margin-right: 13px;
}
	
	.author-top-content {
	margin-bottom: 24px;
}
	
	.author-info {
	padding-top: 10px;
	font-size: 14px !important;
}
	

.entry-title.categoryforsingle.dfh {
	position: absolute;
	right: 7px;
	margin-top: -48px;
	color: #fff;
	padding: 0 16px 3px 13px;
	border-radius: 29px;
	margin-top: -32px;
}

.entry-title.categoryforsingle.dfh a {
	color: #fff;
	display: block;
	padding: 4px 15px 7px 15px !important;
	border-radius: 39px;
}
/*
    .global-list {
	display: none;
}
*/
    .global-list.d-flex {
	margin-left: -81px!important;
}
    @media  screen and (min-width:1000px) and (max-width:1450px){

        .global-list.d-flex.newest {
	margin-left: -48px !important;
}

        .theiaStickySidebar.post-details .sg-post {
	padding-bottom: 68px!important;
}
    }
    @media  screen and (min-width:320px) and (max-width:767px){
        .author-info h2 {
	font-size: 12px!important;
}
.entry-title.categoryforsingle.dfh a {
	color: #fff;
	display: block;
	padding: 4px 15px 7px 15px !important;
	border-radius: 39px;
}

           .post-details .entry-title {
	font-size: 21px !important;
}
      .sg-post.post-style-2  .views__relaed .s__088f .entry-thumbnail img {
	height: auto !important;
}
        .entry-meta li, .entry-meta li a {
	color: #777 !important;
	font-size: 10px !important;
}
    .entry-title.categoryforsingle.dfh {
	position: absolute;
	right: -14px!important;
	margin-top: -48px;
	/* background: #fd8709; */
	color: #fff;
	padding: 4px 16px 3px 13px;
	border-radius: 29px;
	margin-top: -37px;
	margin-left: 0px !important;
	position: absolute;
}
        .entry-title.categoryforsingle.dfh a {
	font-size:9px!important;
}
    }
    #st-2 .st-btn > img {
	display: inline-block;
	height: 26px!important;
	width: 26px!important;
	position: relative;
	top: 10px;
	vertical-align: top;
}
    @media  screen and (min-width:360px) and (max-width:800px){

    }


	a.pharma {
    background: #ff6767 !important;
}

a.animal-health {
    background: #0c9141 !important;
}

a.biosimilars {
    background: #7639ef !important;
}


a.clinical-trials {
    background: #63bfb2 !important;
}

    .entry-title.categoryforsingle.dfh {
	margin-top: -39px!important;
}
    
    .news__lettersd__top {

	z-index: 99999;
	
}
    
    
    
    @media  screen and (min-width:320px) and (max-width:767px) {
        
        .author-top-content .author {
	min-width: 28px;
	margin-right: 13px;
	float: left;
}
        .post-details .entry-title {
	font-size: 17px !important;
	float: left;
	/* width: 100%; */
}
        
        .entry-meta.mb-2 {
	margin-bottom: 16px !important;
	margin-top: 1px !important;
	margin-left: 9px;
	float: left;
	text-align: left;
}
        .entry-meta.mb-2.datesdsf.new__sdat {
	position: absolute;
	left: -126px;
	margin-top: 43px !important;
}
        .entry-title.categoryforsingle.dfh {
	margin-top: -31px !important;
}
        .entry-title.dse {
	margin-top: 19px;
}
        .sg-main-content.mb-4 .container {
	width: 100%!important;
}
        .container {
	width: 100% !important;
}
    }
	
	
	.new__lis__078899 .row {
	width: 100%;
}
	.entry-title.categoryforsingle.dfhdgd {
	float: right;
}
	.categoryforsingle .ma {
	color: #fff;
	padding: 2px 11px;      
	border-radius: 6px;
}
	.global-listfg {
	padding-left: 0px;
}     
	.global-listfg li {      
	
	list-style: none;   
	text-align: center;
	width: 100%;
}   
	.author.d_09rr {
	float: left;
}
	
	.dfhdgd a {
	padding: 4px 12px;
	color: #fff;
	border-radius: 6px;
}
	.global-listfg {
	margin-bottom: 0px;
	padding-top: 10px;
}
	.entry-title.categoryforsingle.dfhdgd {
	margin-top: 8px;
}
	
	@media  screen and (min-width:320px) and (max-width:767px) {
		.entry-meta.mb-2.datesdsf.new__sdat {
	position: relative;
	left: initial;
	margin-top: 0px !important;
}
		.new__lis__078899 .col-md-4 {
	float: left;
	width: 33.33%;
}
		.new_datedfg {
	float: left;
	width: 100%;
}
		.new__sdat .global-listfg {
	width: max-content;
}
		.new__lis__078899 .col-md-4 {
	padding-right: 0px;
}
		.new_datedfg {
	float: left;
	width: 100%;
	padding-top: 4px;
}
		.author-info {
	padding-top: 4px;
	font-size: 11px !important;   
}
		.categoryforsingle .ma {
	color: #fff;
	padding: 3px 11px;   
	border-radius: 5px;
	font-size: 12px;   
}   
		.dfhdgd a {   
	padding: 4px 7px;
	color: #fff;
	border-radius: 6px;
	font-size: 11px;
	margin-bottom: 5px;   
	display: inline-block;      
}
		.entry-title.categoryforsingle.dfhdgd {   
	float: right;  
	text-align: right;      
}   
		.author-top-content {
	margin-bottom: 0px;
}
	}     
</style><?php /**PATH C:\xampp\htdocs\pharmashots\resources\views/site/pages/article/style_1.blade.php ENDPATH**/ ?>