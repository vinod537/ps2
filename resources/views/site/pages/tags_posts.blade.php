<style>
    .entry-content.align-self-center .entry-title a {
	font-size: 17px;
	color: #333;
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
    .sg-post .entry-content {
	padding: 10px 15px;
	font-size: 14px;
	height: 170px;
}
    .entry-meta.mb-2 {
	margin-top: 44px;
}
	
		.entry-title {
	height: 117px!important;
}
    
        @media screen and (min-width:320px) and (max-width:767px) {

        .sg-main-content.mb-4 .container {
	width: 100%!important;
}
        .container {
	width: 100% !important;
}
    }
</style>


@extends('site.layouts.app')

@section('content')
    <div class="sg-main-content mb-4">
        <div class="container">
			
							<div class="all__heading" style="margin-bottom: 68px;
margin-top: 108px;">
         <h3 style=""> {{$name}}</h3>
		  <!-- <p style="padding-bottom: 26px;">Lorem Ipsum is simply dummy text of the printing and typesetting</p> -->
      </div>
			
			
            <div class="row">
                <div class="col-md-12 col-lg-12 sg-sticky">
                    <div class="theiaStickySidebar">

                            <div class="sg-section">
                                <div class="section-content">
                                    <div class="latest-post-area row">
                                        @foreach($posts as $post)
										<div class="col-md-4">
                                            <div class="sg-post medium-post-style-1">
                                                <div class="entry-header">
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
                                                <div class="category">
                                                    <ul class="global-list">
                                                        @isset($post->category->category_name)
                                                            <li><a class="{{$post->category->slug}}" href="{{ url('category',$post->category->slug) }}">{{ $post->category->category_name }}</a></li>
                                                        @endisset
                                                    </ul>
                                                </div>
                                                <div class="entry-content align-self-center">
                                                    <h3 class="entry-title"><a
                                                            href="@if($post->old_id) {{ route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ]) }} @else {{ route('article.detail', ['id' => $post->id, 'slug' => $post->slug ]) }} @endif">{!! \Illuminate\Support\Str::limit($post->title, 130) !!}</a>
                                                    </h3>
                                                    <div class="entry-meta mb-2">
                                                        <ul class="global-list">
<!--                                                            <li>{{ __('post_by') }} <a href="{{ route('site.author',['id' => $post->user->id]) }}">{{$post->user->first_name}} </a></li>-->
                                                            <li> {{ $post->updated_at->format('F j, Y') }}</li>
                                                        </ul>
                                                    </div>
            <!--                                                    <p>{!! strip_tags(\Illuminate\Support\Str::limit($post->content, 120)) !!}</p>-->
                                                </div>
                                            </div>
											</div>
                                        @endforeach
                                    </div>
                                    @if($posts->count() != 0)
                                        <input type="hidden" id="last_id" value="1">
                                        <input type="hidden" id="tag" value="{{$slug}}">
                                        <div class="col-sm-12 col-xs-12 d-none" id="latest-preloader-area">
                                            <div class="row latest-preloader">
                                                <div class="col-md-7 offset-md-5">
                                                    <img src="{{static_asset('site/images/')}}/preloader-2.gif" alt="Image" class="tr-preloader img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="row">
                                                <button class="btn-load-more {{ $totalPostCount > 6? '':'d-none'}}" id="btn-load-more-tags"> {{ __('load_more') }} </button>
                                                <!-- <button class="btn-load-more {{ $totalPostCount > 6? 'd-none':''}}" id="no-more-data-tags">
                                                    {{ __('no_more_records') }}                                            </button> -->

                                                    <button class="btn-load-more {{ $totalPostCount > 6? 'd-none':''}}" id="no-more-data-home">
                                                    <a href="{{url('/')}}/newshome">{{ __('Back to Home') }}</a> </button>

                                                    <input type="hidden" id="url" value="{{ url('') }}">
                                                    <input type="hidden" id="tags" value="{{ $tags }}">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection




@section('script')

<script>
    $(document).ready(function() {
         var ENDPOINT = "{{ url('/') }}";
         var page = 1;
         infinteLoadMore(page);
         var scrn = 600;
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
        var formData = {
            last_id: page,
            tags: $('#tags').val()
        };  
        $.ajax({
                type: "GET",
                dataType: 'json',
                data: formData,
                url: url + '/' + 'get-read-more-post-tags',
                success: function (data) {
                   // console.log(data);

                    $.each(data[0], function (key, value) {
                        $(".latest-post-area").append(value);
                    });

                    if (data[1] == 1) {
                        $("#btn-load-more-tags").hide();
                        $("#no-more-data-tags").removeClass('d-none');
                        $("#no-more-data-home").removeClass('d-none');
                    $("#event-form-data").removeClass('d-none');
                    }

                    var last_id = parseInt($('#last_id').val());
                    $('#last_id').val(last_id + 1);
                    $("#btn-load-more-tags").prop("disabled", false);

                    $("#latest-preloader-area").addClass('d-none');
                    $('.auto-load').hide();


                },
                error: function (data) {
                    // console.log('Error:', data);
                }
            });
        }
</script>
@endsection
