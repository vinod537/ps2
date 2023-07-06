
<style>
    .footer.footer-style-1 {
    margin-top: 22px!important;
}
    .topads {
    padding-bottom: 45px;
    margin-right: auto;
    width: 71%;
    margin-left: 191px;
}
    .sg-main-content.mb-4 .container {
	width: 95%!important;
}
    .topads {
	padding-bottom: 45px;
}
    .leftads {
	position: fixed;
	left: 95px;
}
    .rightads {
	position: fixed;
	right: 101px;
}
.medium-post-style-1, .post-style-1 {

	display: inline-block!important;
}
	.sg-post.medium-post-style-1 {
	width: 100%;
}
	.medium-post-style-1 .entry-thumbnail {
	width: 100%;
}
	body {
	background: #f2f2f2;
}
	
	.sg-main-content.mb-4 .container {
	width: 63%;
}
	
	.sg-widget {
	display: none;
}
	.entry-content.align-self-center .entry-title a {
	font-size: 17px;
}
	.entry-meta li, .entry-meta li a {
	color: #fff;
	background: #EF3C0E;
	border-radius: 36px;
	padding: 0px 5px 3px 5px;
	line-height: 21px !important;
}
	.entry-title.d_-0999 {
	height: 116px !important;
}
	.sg-post .entry-content {
	padding: 12px 16px;
	font-size: 14px;
	height:210px;
}
	.sg-post.medium-post-style-1 {
	border-radius: 5px;
}
	.entry-meta li, .entry-meta li a {
	color: #fff!important;
}
	
	.sg-main-content.mb-4 {
	margin-top: 125px;
}
	
	.d_-0999 a {
	color: #333;
	font-size: 19px;
	font-weight: 600;
}
	
	.entry-meta li, .entry-meta li a{
	margin-top: 28px;
	color: #777;
	
}
	.entry-meta li, .entry-meta li a {
	color: #777 !important;
	font-size: 14px!important;
}
	.entry-meta li, .entry-meta li a {
	color: #fff;
	background: transparent;
	border-radius: 36px;
	padding: 0px 5px 3px 0px;
	line-height: 0px !important;
}
	
	.entry-meta.mb-2.fhf {
	margin-top:39px;
}
    /* .entry-header.new_image_category img {
	width: 100%;
	height: auto !important;
} */
    @media screen and (min-width:1000px) and (max-width:1500px){
        
        .sg-main-content.mb-4 .container {
	width: 81%;
}
        
    }
.entry-content.align-self-center p {
	display: none;
}
	
	.sg-main-content.mb-4 .container {
	width: 75%;
}
   .global-list.d-flex {
	margin-left: -88px!important;
} 
    
    @media screen and (min-width:320px) and (max-width:767px){
      .global-list.d-flex {
	margin-left: -118px!important;
}  
        .entry-content.align-self-center .entry-title a {
	font-size: 14px!important;
}
    .sg-main-content.mb-4 .container {
	width: 90%!important;
}
    }
    
    .rightads {
	position: fixed;
	right: 101px;
}
	.leftads {
	position: fixed;
	left: 95px;
}
	.topads img {
	box-shadow: 0 0 4px 2px #0000004f;
}
	
	.leftads img {
	box-shadow: 0 0 2px 3px #0000003d;
}
	
	.rightads img {
	box-shadow: 0 0 2px 3px #0000003d;
}
    
 
.header_top.sticky {
	position: fixed;
	background: #fff;
	z-index: 9999;
	box-shadow: 0 0 2px 2px #0000001a;
	height: 79px;
}
    
.row.containerdg {

	margin-left: auto;
	margin-right: auto;
}
	

	
		.category__page_0 .entry-title.d_-0999 {
	
	margin-bottom: -6px;
}
	
	.header-bottom {
	padding: 9px 0!important;

}
		
		.category__page_0  .medium-post-style-1 .entry-thumbnail {
	width: 100%;
	height: 188px;
	overflow: hidden;
	border-bottom: 1px solid #0000001a;
}

.new_button_submit {
    background: #073C65 !important;
    color: #fff;
    border: #073C65 !important;
    padding: 5px 20px;
    border-radius: 5px;
}
	
	
</style>


@extends('site.layouts.app')

@section('content')
    <div class="sg-main-content mb-4 category__page_0">
        
        
        
      <div class="leftads">
				@foreach($ads_AdLocation as $key => $ads_AdLocations)
					@if($ads_AdLocations->unique_name == 'listing_page_left')
						@if($ads_AdLocations->ad->ad_type == 'image')
						<a href="{{$ads_AdLocations->ad->ad_url}}">
								<img src=" {{static_asset($ads_AdLocations->ad->adImage->original_image)}}" alt="" style="">	
							</a>	
						@endif

						@if($ads_AdLocations->ad->ad_type == 'code')
							{{$ads_AdLocations->ad->ad_code}}	
						@endif

						@if($ads_AdLocations->ad->ad_type == 'text')
							<div class="textads">
								{{$ads_AdLocations->ad->ad_text}}
							</div>	
						@endif
					@endif
					
				@endforeach
			</div>


		<div class="rightads">
				@foreach($ads_AdLocation as $key => $ads_AdLocations)
					@if($ads_AdLocations->unique_name == 'listing_page_right')
						@if($ads_AdLocations->ad->ad_type == 'image')
						<a href="{{$ads_AdLocations->ad->ad_url}}">
								<img src=" {{static_asset($ads_AdLocations->ad->adImage->original_image)}}" alt="" style="">	
							</a>
						@endif

						@if($ads_AdLocations->ad->ad_type == 'code')
							{{$ads_AdLocations->ad->ad_code}}	
						@endif

						@if($ads_AdLocations->ad->ad_type == 'text')
							<div class="textads">
								{{$ads_AdLocations->ad->ad_text}}
							</div>	
						@endif
					@endif
					
				@endforeach
			</div>
        
         
      
        
        <div class="container">   
            
            {{-- @if ($id=='22')
				@if(session('success'))
					<div id="success_m" class="alert alert-success">
						{{session('success')}}
					</div>
				@endif
			@endif --}}
           
            
            
			
			<div class="all__heading" style="margin-bottom: 56px;">
         <h3 style="">{{$name}}</h3>
		  <!-- <p style="padding-bottom: 26px;">Lorem Ipsum is simply dummy text of the printing and typesetting</p> -->
      </div>
			
			   <div class="topads">
			
						@foreach($ads_AdLocation as $key => $ads_AdLocations)
							@if($ads_AdLocations->unique_name == 'listing_page_top')
								@if($ads_AdLocations->ad->ad_type == 'image')
									<a href="{{$ads_AdLocations->ad->ad_url}}">
										<img src=" {{static_asset($ads_AdLocations->ad->adImage->original_image)}}" alt="" style="">	
									</a>
								@endif

								@if($ads_AdLocations->ad->ad_type == 'code')
									{{$ads_AdLocations->ad->ad_url}}	
								@endif

								@if($ads_AdLocations->ad->ad_type == 'text')
									<div class="textads">
										{{$ads_AdLocations->ad->ad_text}}
									</div>	
								@endif
							@endif
							
						@endforeach
					</div>
            <div class="row containerdg">
				
                <div class="col-md-12 col-lg-12 sg-sticky">
                    <div class="theiaStickySidebar">

                            <div class="sg-section">
                                <div class="section-content">
                                    <div class="latest-post-area row">
                                        @foreach($posts as $post)
										<div class="col-md-4">
                                        <div class="sg-post medium-post-style-1">
                                            <div class="entry-header new_image_category">
                                                <div class="entry-thumbnail">
                                                    <a href="@if($post->old_id) {{ route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ]) }} @else {{ route('article.detail', ['id' => $post->id, 'slug' => $post->slug ]) }} @endif">
													

                                                        @if(isFileExist($post->image, $result =  @$post->image->original_image))
           <img src="{{safari_check() ? basePath(@$post->image).'/'.$result : static_asset('default-image/default-358x215.png') }} " data-original=" {{basePath($post->image)}}/{{ $result }} " class="img-fluid"   alt="{!! $post->title !!}"  >
                                                        @else
                                                            <img src="{{static_asset('default-image/default-358x215.png') }} "  class="img-fluid"   alt="{!! $post->title !!}" >
                                                        @endif
                                                    </a>
                                                </div>
                                                @if($post->post_type=="video")
                                                <div class="video-icon large-block">
                                                    <img src="{{static_asset('default-image/video-icon.svg') }} " alt="video-icon">
                                                </div>
                                                @elseif($post->post_type=="audio")
                                                    <div class="video-icon large-block">
                                                        <img src="{{static_asset('default-image/audio-icon.svg') }} " alt="audio-icon">
                                                    </div>
                                                @endif
                                            </div>
{{--                                            <div class="category">--}}
{{--                                                <ul class="global-list">--}}
{{--                                                    @isset($post->category->category_name)--}}
{{--                                                        <li><a  class="{{$post->category->slug}}"  href="{{ url('category',$post->category->slug) }}">{{ $post->category->category_name }}</a></li>--}}
{{--                                                    @endisset--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
                                            <div class="entry-content align-self-center">
                                            
                                            
												    <h3 class="entry-title d_-0999"><a
                                                        href="@if($post->old_id) {{ route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ]) }} @else {{ route('article.detail', ['id' => $post->id, 'slug' => $post->slug ]) }} @endif">{!! \Illuminate\Support\Str::limit($post->title, 130) !!}</a>
                                                </h3>
												    <div class="entry-meta mb-2 fhf">
                                                    <ul class="global-list">
                                                        <li> {{ $post->updated_at->format('F j, Y') }}</li>
                                                    </ul>
                                                </div>
                                                <p>{!! strip_tags(\Illuminate\Support\Str::limit($post->content, 120)) !!}</p>
                                            </div>
                                        </div>
											</div>
                                        @endforeach
                                    </div>
                                    @if($posts->count() != 0)
                                        <input type="hidden" id="last_id" value="1">
                                        <input type="hidden" id="category_id" value="{{$id}}">
                                        <div class="col-sm-12 col-xs-12 d-none" id="latest-preloader-area">
                                            <div class="row latest-preloader">
                                                <div class="col-md-7 offset-md-5">
                                                    <img src="{{static_asset('site/images/')}}/preloader-2.gif" alt="Image" class="tr-preloader img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="row">
                                                <button class="btn-load-more {{ $totalPostCount > 6? '':'d-none'}}" id="btn-load-more-category"> {{ __('load_more') }} </button>
												@if ($id !='22')
													{{-- <button class="btn-load-more {{ $totalPostCount > 6? 'd-none':''}}" id="no-more-data">
                                                    {{ __('no_more_records') }} </button> --}}
													<button class="btn-load-more {{ $totalPostCount > 6? 'd-none':''}}" id="no-more-data-home">
                                                    <a href="{{url('/')}}/newshome">{{ __('Back to Home') }}</a> </button>
												@endif	
                                                    <input type="hidden" id="url" value="{{ url('') }}">

												@if ($id=='22')
													@if(session('success'))
														<div id="success_m" class="alert alert-success">
															{{session('success')}}
														</div>
													@endif
													<div id="event-form-data" class="d-none">
														<label for="one" style="
														font-size: 30px;
														text-align: center;
														width: 100%;
														text-transform: uppercase;
														color: #073C65!important;
														font-weight: bolder;
													">Connect with us </label>
														<form class="contact-form" id="contact-form" name="contact-form" method="post" action="{{ route('site.send.eventmessage')}}">
															@csrf		
															<div class="row">
																<div class="col-lg-12  allhide" id="input1">
																	<div class="form-group">
																		<label for="name">{{ __('Name') }} *</label>
																		<input required type="text" class="form-control" name="name" value="{{old('name')}}" id="name" placeholder="{{__('Name')}}">
																		<input type="hidden" class="form-control" name="help_you"  id="help_you" value="{{old('help_you')}}">
																		@if($errors->has('name'))
																			<p class="error">{{ $errors->first('name') }}</p>
																		@endif
																	</div>
																</div>
																<input type="hidden" name="page_name" id="page_name" value="contact" >
		
																<div class="col-lg-12  allhide"  id="input2">
																	<div class="form-group">
																		<label for="two">{{ __('Email') }} *</label>
																		<input required type="email" class="form-control" name="email" id="two" placeholder="{{__('Email')}}">
																		@if($errors->has('email'))
																			<p class="error">{{ $errors->first('email') }}</p>
																		@endif
																	</div>
																</div>
		
															   
		
																<div class="col-lg-12  allhide" id="input4">
																	<div class="form-group">
																		<label for="job_title">{{ __('Job Title') }} </label>
																		<input required type="text" class="form-control" name="job_title" id="job_title" placeholder="{{__('job title')}}">
																		@if($errors->has('job_title'))
																			<p class="error">{{ $errors->first('job_title') }}</p>
																		@endif
																	</div>
																</div>
		
																
																<div class="col-lg-12  allhide" id="input6">
																	<div class="form-group">
																		<label for="company_name">{{ __('Organization/ Company name') }} </label>
																		<input required type="text" class="form-control" name="company_name" id="company_name" placeholder="{{__('Organization/ Company name')}}">
																		@if($errors->has('company_type'))
																			<p class="error">{{ $errors->first('company_type') }}</p>
																		@endif
																	</div>
																</div>																
		
																<div class="col-sm-12  allhide"  id="input3">
																	<div class="form-group">
																		<label for="four">{{ __('Message') }} *</label>
																		<textarea required name="message" class="form-control" rows="7" id="four" placeholder="{{__('Message')}}"></textarea>
																		@if($errors->has('message'))
																			<p class="error">{{ $errors->first('message') }}</p>
																		@endif
																	</div>
																</div>
		
		
		
															</div>
		
															<div class="form-group">
		
																<button type="submit" class="new_button_submit">{{ __('submit_now') }}</button>
		
															</div>
		
														</form>	
													</div>
												@endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>


                    </div>
                </div></div>
		
		</div>
                
</div>
                <script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("headdf");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>
                
            
@endsection


@section('script')

<script>
    $(document).ready(function() {
         var ENDPOINT = "{{ url('/') }}";
         var page = 1;
         infinteLoadMore(page);
         var scrn = 800;
         $(window).scroll(function () {
              var scrns = $(window).scrollTop() - scrn;
              var higt = scrns + $(window).height();
             if ( higt >= $(document).height()) {
                 page++;
                 scrn =  scrn+600;
                 infinteLoadMore(page);                
             }
         });        
    });

    
    function infinteLoadMore(page) {

        var url = $("#url").val();
		//alert(url)
        var formData = {
            last_id: page,
            category_id: $('#category_id').val()
        };  
        $.ajax({
            type: "GET",
            dataType: 'json',
            data: formData,
            url: url + '/' + 'get-read-more-post-category',
            success: function (data) {

                $.each(data[0], function (key, value) {
                    $(".latest-post-area").append(value);
                });

                if (data[1] == 1) {
                    $("#btn-load-more-category").hide();
                    $("#no-more-data").removeClass('d-none');
                    $("#no-more-data-home").removeClass('d-none');
                    $("#event-form-data").removeClass('d-none');
                }

                last_id = parseInt($('#last_id').val());
                $('#last_id').val(last_id + 1);
                $("#btn-load-more-category").prop("disabled", false);

                $("#latest-preloader-area").addClass('d-none');
			},
                
            error: function (data) {
                // console.log('Error:', data);
            }
        });
        }
</script>
@endsection



