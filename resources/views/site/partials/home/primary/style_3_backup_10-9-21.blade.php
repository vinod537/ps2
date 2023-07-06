<style>
.carousel-wrap {
  margin: 90px auto;
  padding: 0 5%;
  width: 80%;
  position: relative;
}
.banner__s .col-lg-12 {
	padding: 0px;
}
	.banner__s {
	margin-top: -31px;
}
	.sg-menu.menu-style-1 {
	position: relative;
	z-index: 99;
}
/* fix blank or flashing items on carousel */
.owl-carousel .item {
  position: relative;
  z-index: 100; 
  -webkit-backface-visibility: hidden; 
}

/* end fix */
.owl-nav > div {
  margin-top: -26px;
  position: absolute;
  top: 50%;
  color: #cdcbcd;
}

.owl-nav i {
  font-size: 52px;
}

.owl-nav .owl-prev {
  left: -30px;
}

.owl-nav .owl-next {
  right: -30px;
}
.owl-nav .owl-prev {
	left: 6px!important;
}
	.owl-nav > div {
	margin-top: -26px;
	position: absolute;
	top: 50%;
	color: #cdcbcd;
}
	.owl-nav .owl-next {
	right: 8px!important;
}
	.add__banners {
	margin-bottom: 28px;
}
	
	.daily__news__pro {
	background: #fff;
}
	
	.hdaily_s h3 {
	font-size: 16px;
	color: #222;
	font-weight: 500;
}
	
.loop-item-meta_0 {
	background: #EF3C0E;
	display: inline-block;
	color: #fff;
	padding: 0px 8px 2px 8px;
	border-radius: 34px;
	font-size: 12px;
	margin-top: 7px;
	margin-bottom: 9px;
}
	
	.hdaily_s {
	padding: 15px;
}
	.hdaily_s p {
	font-size: 13px;
}

	.all__heading {
	margin-bottom: 20px;
	margin-top: 37px;
}
.all__heading h3 {
	color: #000;
	font-size: 20px;
}
	
.all__heading::before {
	content: "";
	background: #0000004a;
	height: 1px;
	width: 88%;
	display: inline-block;
	float: right;
	position: relative;
	top: 21px;
}
	
	.sg-home-section {
	display: none;
}
	.daily__new {
	margin-bottom: 44px;
}
	.a__bac__l {
	border-radius: 20px;
	background-color: rgb(255, 255, 255);
	box-shadow: 0px 0px 94px 6px rgba(107, 83, 254, 0.1);
	padding: 80px 0;
	text-align: center;
}
	
	.forum__group input {
	background: rgb(233, 227, 254);
	border: 1px solid #0000001c;
	padding: 9px;
	font-size: 15px;
	width: 32%;
	border-radius: 7px;
	margin-bottom: 17px;
}
	.sub {
	background: #EF3C0E;
	border: none;
	color: #fff;
	padding: 7px 30px 7px 30px;
	border-radius: 7px;
}
	
	.a__bac__l h3 {
	color: #000;
	margin-bottom: 16px;
}
	
	.a__bac__l p {
	text-transform: uppercase;
	letter-spacing: 1px;
	margin-top: 23px;
	margin-bottom: 23px;
}
	
	.list__categories__list li {
	list-style: none;
}
.list__categories__list {
	padding: 7px;
}
	
	.list__categories__li_sting {
	background: #fff;
	padding: 6px;
	border-radius: 5px;
}
	.static_09 h3 {
	font-size: 14px;
	color: #000;
	padding: 10px;
	margin-bottom: 0px;
}
	
.list__categories__list li {
	display: inline-block;
	width: 16.4%;
	padding: 5px;
}
	.sg-main-content.mb-4 {
	display: none;
}
	
	.all__heading h3 {
	color: #000;
	font-size: 20px;
	text-transform: uppercase;
}
	.hdaily_s h3 {
	font-size: 13px;
	color: #222;
	font-weight: 400;
	line-height: 20px;
}
	.categories__list__s {
	padding-bottom: 36px;
	padding-top: 16px;
}
	
	.static_09 h3 {
	font-size: 14px;
	color: #000;
	padding: 10px;
	margin-bottom: 0px;
	font-weight: 500;
	line-height: 19px;
}
	.daily__new {
	margin-bottom: 44px;
	margin-top: 62px;
}
	.all__heading {
	margin-bottom: 33px;
	margin-top: 37px;
	text-align: center;
}
</style>

@php
    $blockPosts = $posts->take(4);
@endphp


<section class="banner__s">
  <div class="col-lg-12">
                <div id="home-carouselgfgfgfg" class=" ">
                    <div class="owl-carousel">
                        @foreach($sliderPosts as $post)
                            <div class="item @if($sliderPosts->first()->id == $post->id) active @endif">
                                <div class="sg-post featured-post style_1">
                                    <div class="entry-header">
                                        <div class="entry-thumbnail">
                                            <a href="{{ route('article.detail', ['id' => $post->slug]) }}">
                                                @if(isFileExist(@$post->image, $result = @$post->image->big_image_two))
                                                    <img src="{{ safari_check() ? basePath(@$post->image).'/'.$result : static_asset('default-image/default-730x400.png') }}"
                                                         data-original=" {{basePath($post->image)}}/{{ $result }} "
                                                         class="img-fluid image-thumb" alt="{!! $post->title !!}">
                                                @else
                                                    <img src="{{static_asset('default-image/default-730x400.png') }}"
                                                         class="img-fluid image-thumb" alt="{!! $post->title !!}">
                                                @endif
                                            </a>
                                        </div>
                                        @if($post->post_type=="video")
                                            <div class="video-icon">
                                                <img src="{{static_asset('default-image/video-icon.svg') }} " alt="video-icon">
                                            </div>
                                        @elseif($post->post_type=="audio")
                                            <div class="video-icon">
                                                <img src="{{static_asset('default-image/audio-icon.svg') }} " alt="audio-icon">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="entry-content absolute text-center">
                                        <div class="category" data-animation="animated pulse">
                                            <ul class="global-list justify-content-center">
                                                @isset($post->category->category_name)
                                                    <li>
                                                        <a href="{{ url('category',$post->category->slug) }}">{{ $post->category->category_name }}</a>
                                                    </li>
                                                @endisset
                                            </ul>
                                        </div>
                                        <h2 class="entry-title" data-animation="animated pulse">
                                            <a href="{{ route('article.detail', ['id' => $post->slug]) }}">{!! $post->title !!}</a>
                                        </h2>
                                        <div class="entry-meta" data-animation="animated pulse">
                                            <ul class="global-list justify-content-center">
                                                <li>{{ __('post_by') }} <a
                                                        href="{{ route('site.author',['id' => $post->user->id]) }}"> {{ data_get($post, 'user.first_name') }}</a>
                                                </li>
                                                <li>
                                                    <a href="{{route('article.date', date('Y-m-d', strtotime($post->updated_at)))}}">{{ $post->updated_at->format('F j, Y') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                  
                    
                </div>
            </div>
</section>

  
<div class="add__banners">

<div class="container">
	
		<div class="all__heading">
	<h3 style="width: 292px;
display: inline-block;
background: #f2f2f2;
position: relative;">Exclusive Interview</h3>
	</div>
	
	
	<div class="s__09d_0">
	<img src="{{static_asset('site/images/')}}/fg.png "/>
	</div>
	</div>
</div>




<section class="daily__new">

<div class="container">
	<div class="all__heading">
	<h3 style="width: 177px;
display: inline-block;
background: #f2f2f2;
position: relative;">Daily News</h3>
	</div>
	<div class="row">
	<div class="col-md-2">
		<div class="daily__news__pro">
		<div class="daily_img">
			<img src="{{static_asset('site/images/')}}/p1.jpg "/>
			
			</div>
				<div class="hdaily_s">
			
			<div class="loop-item-meta_0">
                                Sep 07, 2021
                            </div>
			
			
		<h3>Moderna’s Spikevax Receives TGA’s Provisional Approval to Treat COVID-19 in Patients Aged 12-17 Years</h3>
<!--					<p>Shots: Advent and GIC to acquire Sobi for ~$8B (SEK 69.4B) at $27.33/share (SEK 235) representing</p>-->
		</div>
		</div>
	
		
		</div>
		
		
		<div class="col-md-2">
		<div class="daily__news__pro">
		<div class="daily_img">
			<img src="{{static_asset('site/images/')}}/p2.jpg "/>
			
			</div>
				<div class="hdaily_s">
			
			<div class="loop-item-meta_0">
                                Sep 07, 2021
                            </div>
			
			
		<h3>Moderna’s Spikevax Receives TGA’s Provisional Approval to Treat COVID-19 in Patients Aged 12-17 Years</h3>
				
		</div>
		</div>
	
		
		</div>
	
		
		
		<div class="col-md-2">
		<div class="daily__news__pro">
		<div class="daily_img">
			<img src="{{static_asset('site/images/')}}/p3.jpg "/>
			
			</div>
				<div class="hdaily_s">
			
			<div class="loop-item-meta_0">
                                Sep 07, 2021
                            </div>
			
			
		<h3>Moderna’s Spikevax Receives TGA’s Provisional Approval to Treat COVID-19 in Patients Aged 12-17 Years</h3>
					
		</div>
		</div>
	
		
		</div>
		
		<div class="col-md-2">
		<div class="daily__news__pro">
		<div class="daily_img">
			<img src="{{static_asset('site/images/')}}/p4.jpg "/>
			
			</div>
				<div class="hdaily_s">
			
			<div class="loop-item-meta_0">
                                Sep 07, 2021
                            </div>
			
			
		<h3>Moderna’s Spikevax Receives TGA’s Provisional Approval to Treat COVID-19 in Patients Aged 12-17 Years</h3>
					
		</div>
		</div>
	
		
		</div>
		
		<div class="col-md-2">
		<div class="daily__news__pro">
		<div class="daily_img">
			<img src="{{static_asset('site/images/')}}/p1.jpg "/>
			
			</div>
				<div class="hdaily_s">
			
			<div class="loop-item-meta_0">
                                Sep 07, 2021
                            </div>
			
			
		<h3>Moderna’s Spikevax Receives TGA’s Provisional Approval to Treat COVID-19 in Patients Aged 12-17 Years</h3>
<!--					<p>Shots: Advent and GIC to acquire Sobi for ~$8B (SEK 69.4B) at $27.33/share (SEK 235) representing</p>-->
		</div>
		</div>
	
		
		</div>
		
		
		<div class="col-md-2">
		<div class="daily__news__pro">
		<div class="daily_img">
			<img src="{{static_asset('site/images/')}}/p2.jpg "/>
			
			</div>
				<div class="hdaily_s">
			
			<div class="loop-item-meta_0">
                                Sep 07, 2021
                            </div>
			
			
		<h3>Moderna’s Spikevax Receives TGA’s Provisional Approval to Treat COVID-19 in Patients Aged 12-17 Years</h3>
				
		</div>
		</div>
	
		
		</div>
	
	</div>
	
	
	</div>

</section>

<section class="news__letter">
<div class="container">
	<div class="a__bac__l">
	<h3>We Have a Viewership of 1,00,000 + Views</h3>
		
		<p>Join Ps Family</p>
		<form>
		<div class="forum__group">
		<input type="text" placeholder="Enter Your Email" />
		
			<button class="sub">Subscribe New</button>
		
		</div>
			
			</form>
	</div>
	
	
	</div>
</section>


<section class="categories__list__s">
<div class="container">
	
	<div class="all__heading">
	<h3 style="    width: 177px;
    display: inline-block;
    background: #f2f2f2;
    position: relative;">Categories</h3>
	</div>
		<div class="list__categories">
	<div class="row">
<ul class="list__categories__list">
		
		<li>
	<div class="list__categories__li_sting">
			<div class="img__08">
		<img src="{{static_asset('site/images/')}}/p1.jpg " />
		
		</div>
		
		<div class="static_09">
		<h3>What’s up with Deepak Nitrite? </h3>
		</div>
			
			</div>
	
	</li>
	
	
	<li>
	<div class="list__categories__li_sting">
			<div class="img__08">
		<img src="{{static_asset('site/images/')}}/p2.jpg " />
		
		</div>
		
		<div class="static_09">
		<h3>What’s up with Deepak Nitrite? </h3>
		</div>
			
			</div>
	
	</li>
	
	<li>
	<div class="list__categories__li_sting">
			<div class="img__08">
		<img src="{{static_asset('site/images/')}}/p3.jpg " />
		
		</div>
		
		<div class="static_09">
		<h3>What’s up with Deepak Nitrite? </h3>
		</div>
			
			</div>
	
	</li>
	
	<li>
	<div class="list__categories__li_sting">
			<div class="img__08">
		<img src="{{static_asset('site/images/')}}/p4.jpg " />
		
		</div>
		
		<div class="static_09">
		<h3>What’s up with Deepak Nitrite? </h3>
		</div>
			
			</div>
	
	</li>
	
	<li>
	<div class="list__categories__li_sting">
			<div class="img__08">
		<img src="{{static_asset('site/images/')}}/p1.jpg " />
		
		</div>
		
		<div class="static_09">
		<h3>What’s up with Deepak Nitrite? </h3>
		</div>
			
			</div>
	
	</li>
	
	<li>
	<div class="list__categories__li_sting">
			<div class="img__08">
		<img src="{{static_asset('site/images/')}}/p1.jpg " />
		
		</div>
		
		<div class="static_09">
		<h3>What’s up with Deepak Nitrite? </h3>
		</div>
			
			</div>
	
	</li>
	
	<li>
	<div class="list__categories__li_sting">
			<div class="img__08">
		<img src="{{static_asset('site/images/')}}/p1.jpg " />
		
		</div>
		
		<div class="static_09">
		<h3>What’s up with Deepak Nitrite? </h3>
		</div>
			
			</div>
	
	</li>
	
	<li>
	<div class="list__categories__li_sting">
			<div class="img__08">
		<img src="{{static_asset('site/images/')}}/p1.jpg " />
		
		</div>
		
		<div class="static_09">
		<h3>What’s up with Deepak Nitrite? </h3>
		</div>
			
			</div>
	
	</li>
	
	
	<li>
	<div class="list__categories__li_sting">
			<div class="img__08">
		<img src="{{static_asset('site/images/')}}/p2.jpg " />
		
		</div>
		
		<div class="static_09">
		<h3>What’s up with Deepak Nitrite? </h3>
		</div>
			
			</div>
	
	</li>
	
	<li>
	<div class="list__categories__li_sting">
			<div class="img__08">
		<img src="{{static_asset('site/images/')}}/p3.jpg " />
		
		</div>
		
		<div class="static_09">
		<h3>What’s up with Deepak Nitrite? </h3>
		</div>
			
			</div>
	
	</li>
	
		
	<li>
	<div class="list__categories__li_sting">
			<div class="img__08">
		<img src="{{static_asset('site/images/')}}/p1.jpg " />
		
		</div>
		
		<div class="static_09">
		<h3>What’s up with Deepak Nitrite? </h3>
		</div>
			
			</div>
	
	</li>
	
	<li>
	<div class="list__categories__li_sting">
			<div class="img__08">
		<img src="{{static_asset('site/images/')}}/p1.jpg " />
		
		</div>
		
		<div class="static_09">
		<h3>What’s up with Deepak Nitrite? </h3>
		</div>
			
			</div>
	
	</li>
	
		
		</ul>
		
		
		
		</div>
	</div>
	
	</div>
</section>

<!--
<div class="sg-home-section">
    <div class="container">
        <div class="row">
			

			
			
          

            <div class="col-lg-4">
                <div class="sg-breaking-news">
                    <div class="section-title">
                        <h1>{{ __('breaking_news') }}</h1>
                    </div>
                    <div class="breaking-news-slider">
                        @foreach($breakingNewss as $post)
                            <div class="sg-post">
                                <div class="entry-content">
                                    <div class="category">
                                        <ul class="global-list">
                                            @isset($post->category->category_name)
                                                <li>
                                                    <a href="{{ url('category',$post->category->slug) }}">{{ $post->category->category_name }}</a>
                                                </li>
                                            @endisset
                                        </ul>
                                    </div>
                                    <h2 class="entry-title">
                                        <a href="{{ route('article.detail', ['id' => $post->slug]) }}">{!! \Illuminate\Support\Str::limit($post->title,100) !!}</a>
                                    </h2>
                                    <div class="entry-meta">
                                        <ul class="global-list">
                                            <li>
                                                <a href="javascript:void(0)">{{ Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
	

		
        <div class="row">
            @foreach($blockPosts as $post)
                <div class="col-md-3">
                    <div class="sg-post">
                        <div class="entry-header">
                            <div class="entry-thumbnail">
                                <a href="{{ route('article.detail', ['id' => $post->slug]) }}">
                                    @if(isFileExist(@$post->image, @$post->image->medium_image))
                                        <img class="img-fluid"
                                             src="{{ safari_check() ? basePath(@$post->image).'/'.$result : static_asset('default-image/default-358x215.png') }} "
                                             data-original="{{basePath(@$post->image)}}/{{ $post->image->medium_image }}"
                                             alt="{!! $post->title !!}">
                                    @else
                                        <img src="{{static_asset('default-image/default-358x215.png') }} "
                                             class="img-fluid" alt="{!! $post->title !!}">
                                    @endif
                                </a>
                            </div>
                            @if($post->post_type=="video")
                                <div class="video-icon block">
                                    <img src="{{static_asset('default-image/video-icon.svg') }} " alt="video-icon">
                                </div>
                            @elseif($post->post_type=="audio")
                                <div class="video-icon block">
                                    <img src="{{static_asset('default-image/audio-icon.svg') }} " alt="audio-icon">
                                </div>
                            @endif
                            <div class="category">
                                <ul class="global-list">
                                    @isset($post->category->category_name)
                                        <li>
                                            <a href="{{ url('category',$post->category->slug) }}">{{ $post->category->category_name }}</a>
                                        </li>
                                    @endisset
                                </ul>
                            </div>
                        </div>
                        <div class="entry-content">
                            <a href="{{ route('article.detail', ['id' => $post->slug]) }}">
                                <p>{!! \Illuminate\Support\Str::limit($post->title, 50) !!}</p></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
-->

