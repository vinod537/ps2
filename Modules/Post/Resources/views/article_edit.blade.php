@extends('common::layouts.master')

@section('post-aria-expanded')

    aria-expanded="true"

@endsection

@section('post-show')

    show

@endsection

@section('post')

    active

@endsection

@section('post-active')

    active

@endsection

@section('modal')

    @include('gallery::image-gallery')

    @include('gallery::video-gallery')

@endsection





@section('content')



    <div class="dashboard-ecommerce">

        <div class="container-fluid dashboard-content ">

            <!-- page info start-->

            {!!  Form::open(['route'=>['update-post','article',$post->id],'method' => 'post','enctype'=>'multipart/form-data']) !!}

            <input type="hidden" id="images" value="{{ $countImage }}">

            <input type="hidden" id="videos" value="{{ $countVideo }}">

            <input type="hidden" id="imageCount" value="1">

            <div class="row clearfix">

                <div class="col-12">

                    <div class="add-new-header clearfix m-b-20">

                        <div class="row">

                            <div class="col-6">

                                <div class="block-header">

                                    <h2>{{ __('update_post') }}</h2>

                                </div>

                            </div>

                            {{-- <div class="col-6 text-right">

                                <a href="{{ route('post') }}" class="btn btn-primary btn-add-new"><i

                                        class="fas fa-list"></i> {{ __('posts') }}

                                </a>

                            </div> --}}

                            <div class="col-6 text-right">
                                <div class="form-group">
                                    <label class="custom-control" for="btnSubmit"></label>
                                    <button type="submit" name="btnSubmit" class="btn btn-primary pull-right"><i
                                            class="m-r-10 mdi mdi-content-save-all"></i>{{ __('update_post') }}
                                    </button>
                                    <label class="" for="btnSubmit"></label>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12">

                            @if(session('error'))

                                <div id="error_m" class="alert alert-danger">

                                    {{session('error')}}

                                </div>

                            @endif

                            @if(session('success'))

                                <div id="success_m" class="alert alert-success">

                                    {{session('success')}}

                                </div>

                            @endif

                            @if ($errors->any())

                                <div class="alert alert-danger">

                                    <ul>

                                        @foreach ($errors->all() as $error)

                                            <li>{{ $error }}</li>

                                        @endforeach

                                    </ul>

                                </div>

                            @endif

                        </div>



                        <!-- Main Content section start -->

                        <div class="col-12 col-lg-9">

                            <div class="add-new-page  bg-white p-20 m-b-20">

                                <div class="block-header">

                                    <h2>{{ __('posts_details') }}</h2>

                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <label for="post_title" class="col-form-label">{{ __('title') }}*</label>

                                        <input id="post_title" name="title" value="{{ $post->title }}" type="text"

                                               class="form-control" required>

                                    </div>

                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <label for="post-slug" class="col-form-label"><b>{{ __('slug') }}</b>

                                            ({{ __('slug_message') }})</label>

                                        <input id="post-slug" value="{{ $post->slug }}" name="slug" type="text"

                                               class="form-control">

                                    </div>

                                </div>
                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <label for="post-press_release_link" class="col-form-label"><b>{{ __('Press Release Link') }}</b>

                                            ({{ __('Press Release Link') }})</label>

                                        <input id="post-press_release_link" value="{{ $post->press_release_link }}" name="press_release_link" type="text"

                                               class="form-control">

                                    </div>

                                </div>


                                <div class="col-sm-12">

                                    <div class="form-group">
                                        <label for="post_company" class="col-form-label">{{ __('company') }}</label>

                                        <select class="form-control  select2  select2 company-multiple"
                                            multiple="multiple" id="company_name" name="company_name[]" name="company_name"
                                            data-dependent="product_name" required>
                                            @foreach (\Modules\Post\Entities\Company::get() as $company)
                                                @php                                               
                                                   $companyNM =  json_decode($post->company_name2);
                                                @endphp
                                                    <option @if($companyNM) @if(in_array($company->slug , $companyNM)) selected @endif @endif data-slug="{{ $company->id }}"  value="{{ $company->slug }}">{{ $company->company_name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>


                                <div class="col-sm-12">

                                <div class="form-group">
                                        <label for="post_product_name" class="col-form-label">{{ __('Product') }}</label>
                                        {{-- <input id="post_product_name"  value="{{ $post->product_name2 }}" name="product_name" type="text" value="{{ old('product_name') }}"
                                               data-role="tagsinput" class="form-control"/> --}}

                                        <select class="form-control select2  select2 product-multiple"
                                            multiple="multiple" id="product_name" name="product_name[]"
                                            data-dependent="company_name">

                                            @php

                                                $CompanyNM = [];
                                                if($post->company_name2 && $post->company_name2 !='' && $post->company_name2 !='0' && $post->company_name2 != NULL && $post->company_name2 !='null'){
                                                    $CompanyNM =  json_decode($post->company_name2);
                                                }

                                                $ProductNM = [];

                                                if($post->product2 && $post->product2 !='' && $post->product2 !='0' && $post->product2 != NULL && $post->product2 !='null'){
                                                    $ProductNM =  json_decode($post->product2);
                                                }

                                                echo  '<option value="">' . __('Select Product') . '</option>';

                                                if ($CompanyNM) {
                                                if (is_array($CompanyNM) && count($CompanyNM) > 0) {
                                                    $FProduct       = \Modules\Post\Entities\Company::whereIn('slug', $CompanyNM)->pluck('id')->toArray();
                                                   
                                                    $data           = \Modules\Post\Entities\CompanyProduct::whereIn('company_id', $FProduct)->get();

                                                    

                                                    if ($data) {
                                                        foreach ($data as $row) {
                                                            $dataP           = \Modules\Post\Entities\Product::where('id', $row->product_id)->get()->first();
                                                            if($dataP){
                                                                $selected = '';

                                                                if($ProductNM){
                                                                    if (is_array($ProductNM)) {
                                                                        if (in_array($dataP->slug, $ProductNM)) {
                                                                            $selected = "selected";
                                                                            }
                                                                        }
                                                                }
                                                                echo '<option '.$selected.'  value="' . $dataP->slug . '">' . $dataP->product_name . '</option>';
                                                            }
                                                        }
                                                    }
                                                }
                                                }


                                                @endphp


                                                                                        
                                        </select>

                                    </div>
                                </div>

                                

                                

                                <!-- tinemcey start -->

                                <div class="row p-l-15">

                                    <div class="col-12">

                                        <label for="post_content" class="col-form-label">{{ __('content') }}*</label>

                                        <textarea name="content" required value="{{ $post->content }}" id="post_content_article"

                                                  cols="30" rows="5">

                                                        {!! $post->content !!}

                                                    </textarea>

                                    </div>

                                </div>

                                <!-- tinemcey end -->

                            </div>

                            <div class="add-new-page  bg-white p-20 m-b-20 add-new-content">

                                <div class="block-header">

                                    <h2>{{ __('add_content') }}</h2>

                                </div>

                                <div class="row pb-3">

                                    <div class="col-md-2 text-center area">

                                        <div class="item" onclick="addContent('text')">

                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/text.png') }}"><br>

                                            <label>{{ __('text') }}</label>

                                        </div>

                                    </div>

                                    <div class="col-md-2 text-center area">

                                        <div class="item" onclick="addContent('image')">

                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/image.png') }}"><br>

                                            <label>{{ __('image') }}</label>

                                        </div>

                                    </div>

                                    <div class="col-md-2 text-center area">

                                        <div class="item" onclick="addContent('image-text')">

                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/image-text.png') }}"><br>

                                            <label>{{ __('image_left') }}</label>

                                        </div>

                                    </div>

                                    <div class="col-md-2 text-center area">

                                        <div class="item" onclick="addContent('text-image')">

                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/text-image.png') }}"><br>

                                            <label>{{ __('image_right') }}</label>

                                        </div>

                                    </div>

                                    <div class="col-md-2 text-center area">

                                        <div class="item" onclick="addContent('text-image-text')">

                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/text-image-text.png') }}"><br>

                                            <label>{{ __('image_center') }}</label>

                                        </div>

                                    </div>

                                    <div class="col-md-2 text-center area">

                                        <div class="item" onclick="addContent('video')">

                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/video.png') }}"><br>

                                            <label>{{ __('video') }}</label>

                                        </div>

                                    </div>



                                </div>

                                <div class="row pb-3">

                                    <div class="col-md-2 text-center area">

                                        <div class="item" onclick="addContent('ads')">

                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/ads.png') }}"><br>

                                            <label>{{ __('ads') }}</label>

                                        </div>

                                    </div>

                                </div>

                                <div class="block-header">

                                    <h2>{{ __('embadded') }}</h2>

                                </div>

                                <div class="row">

                                    <div class="col-md-2 text-center area">

                                        <div class="item" onclick="addContent('code')">

                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/code.png') }}"><br>

                                            <label>{{ __('code') }}</label>

                                        </div>

                                    </div>

                                    <div class="col-md-2 text-center area">

                                        <div class="item" onclick="addContent('twitter-embed')">

                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/twitter.png') }}"><br>

                                            <label>{{ __('twitter') }}</label>

                                        </div>

                                    </div>

                                    <div class="col-md-2 text-center area">

                                        <div class="item" onclick="addContent('vimeo-embed')">

                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/vimeo.png') }}"><br>

                                            <label>{{ __('vimeo') }}</label>

                                        </div>

                                    </div>

                                    <div class="col-md-2 text-center area">

                                        <div class="item" onclick="addContent('youtube-embed')">

                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/youtube.png') }}"><br>

                                            <label>{{ __('youtube') }}</label>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="content-area">

                                {{-- all content  --}}

                                @php

                                    $content_count = 0;

                                @endphp

                                @foreach($post_contents as $page => $content)

                                    @php

                                    $page = array_keys($content);

                                    $content_count++;



                                    @endphp

                                    @include('post::contents/'.$page[0], compact('content_count', 'content'))

                                @endforeach

                                {{-- all content  --}}

                            </div>

                            <!-- visibility section start -->

                            <div class="add-new-page  bg-white p-20 m-b-20">

                                <div class="block-header">

                                    <h2>{{ __('visibility') }}</h2>

                                </div>

                                <div class="row p-l-15">

                                    <div class="col-12 col-md-4">

                                        <div class="form-title">

                                            <label for="visibility">{{ __('visibility') }}</label>

                                        </div>

                                    </div>

                                    <div class="col-3 col-md-2">

                                        <label class="custom-control custom-radio custom-control-inline">

                                            <input type="radio" @if($post->visibility==1) checked

                                                   @endif name="visibility" id="visibility_show" value="1"

                                                   class="custom-control-input">

                                            <span class="custom-control-label">{{ __('show') }}</span>

                                        </label>

                                    </div>

                                    <div class="col-3 col-md-2">

                                        <label class="custom-control custom-radio custom-control-inline">

                                            <input type="radio" @if($post->visibility==0) checked

                                                   @endif name="visibility" id="visibility_hide" value="0"

                                                   class="custom-control-input">

                                            <span class="custom-control-label">{{ __('hide') }}</span>

                                        </label>

                                    </div>

                                </div>

                                <div class="row p-l-15">

                                    <div class="col-8 col-md-4">

                                        <div class="form-title">

                                            <label for="featured_post">{{ __('add_to_featured') }}</label>

                                        </div>

                                    </div>

                                    <div class="col-4 col-md-2">

                                        <label class="custom-control custom-checkbox">

                                            <input type="checkbox" @if($post->featured==1) checked

                                                   @endif id="featured_post" name="featured"

                                                   class="custom-control-input">

                                            <span class="custom-control-label"></span>

                                        </label>

                                    </div>

                                </div>

                                <div class="row p-l-15">

                                    <div class="col-8 col-md-4">

                                        <div class="form-title">

                                            <label for="add_to_breaking">{{ __('add_to_breaking') }}</label>

                                        </div>

                                    </div>

                                    <div class="col-4 col-md-2">

                                        <label class="custom-control custom-checkbox">

                                            <input type="checkbox" id="add_to_breaking" @if($post->breaking==1) checked

                                                   @endif name="breaking" class="custom-control-input">

                                            <span class="custom-control-label"></span>

                                        </label>

                                    </div>

                                </div>

                                <div class="row p-l-15">

                                    <div class="col-8 col-md-4">

                                        <div class="form-title">

                                            <label for="add_to_slide">{{ __('add_to_slider') }}</label>

                                        </div>

                                    </div>

                                    <div class="col-4 col-md-2">

                                        <label class="custom-control custom-checkbox">

                                            <input type="checkbox" id="add_to_slide" @if($post->slider==1) checked

                                                   @endif name="slider" class="custom-control-input">

                                            <span class="custom-control-label"></span>

                                        </label>

                                    </div>

                                </div>

                                <div class="row p-l-15">

                                    <div class="col-8 col-md-4">

                                        <div class="form-title">

                                            <label for="recommended">{{ __('add_to_recommended') }}</label>

                                        </div>

                                    </div>

                                    <div class="col-4 col-md-2">

                                        <label class="custom-control custom-checkbox">

                                            <input type="checkbox" id="recommended" @if($post->recommended==1) checked

                                                   @endif name="recommended" class="custom-control-input">

                                            <span class="custom-control-label"></span>

                                        </label>

                                    </div>

                                </div>

                                <div class="row p-l-15">

                                    <div class="col-8 col-md-4">

                                        <div class="form-title">

                                            <label for="editor_picks">{{ __('add_to_editor_picks') }}</label>

                                        </div>

                                    </div>

                                    <div class="col-4 col-md-2">

                                        <label class="custom-control custom-checkbox">

                                            <input type="checkbox" id="editor_picks" name="editor_picks"

                                                   class="custom-control-input" @if($post->editor_picks==1) checked

                                                   @endif>

                                            <span class="custom-control-label"></span>

                                        </label>

                                    </div>

                                </div>

                                <div class="row p-l-15">

                                    <div class="col-8 col-md-4">

                                        <div class="form-title">

                                            <label

                                                for="auth_required">{{ __('show_only_to_authenticate_users') }}</label>

                                        </div>

                                    </div>

                                    <div class="col-4 col-md-2">

                                        <label class="custom-control custom-checkbox">

                                            <input type="checkbox" id="auth_required"

                                                   @if($post->auth_required==1) checked @endif name="auth_required"

                                                   class="custom-control-input">

                                            <span class="custom-control-label"></span>

                                        </label>

                                    </div>

                                </div>


                                
                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label
                                                for="top_20">{{ __('top_20') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="top_20" name="top_20"
                                                   class="custom-control-input" @if($post->top_20==1) checked @endif >
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>


                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label
                                                for="insights_plus">{{ __('insights_plus') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="insights_plus" name="insights_plus"
                                            class="custom-control-input" @if($post->insights_plus==1) checked @endif >
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>


                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label
                                                for="viewpoint">{{ __('viewpoint') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="viewpoint" name="viewpoint"
                                            class="custom-control-input" @if($post->viewpoint==1) checked @endif >
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>


                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label
                                                for="events">{{ __('events') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="events" name="events"
                                            class="custom-control-input" @if($post->events==1) checked @endif >
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label
                                                for="advertisement">{{ __('advertisement') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="advertisement" name="advertisement"
                                            class="custom-control-input" @if($post->advertisement==1) checked @endif >
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>


                            </div>

                            <!-- visibility section end -->

                            <!-- SEO section start -->

                            <div class="add-new-page  bg-white p-20 m-b-20">

                                <div class="block-header">

                                    <h2>{{ __('seo_details') }}</h2>

                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <label for="meta_title"><b>{{ __('title') }}</b> ({{ __('meta_title') }})</label>

                                        <input class="form-control meta" value="{{ $post->meta_title ?? $post->title }}"

                                               id="meta_title" name="meta_title" data-type="title">

                                        <p class="display-nothing alert alert-danger mt-2" role="alert">

                                            {{__('current_characters')}}: <span class="characters"></span>, {{ __('meta_title').' '. __('should_bd') .' '. __('in_between') .' '. '30-60 ' . __('characters') }}

                                        </p>

                                        <p class="display-nothing alert alert-success mt-2" role="alert">

                                            {{__('current_characters')}}: <span class="characters"></span>

                                        </p>

                                    </div>

                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <label for="post-keywords" class="col-form-label"><b>{{ __('keywords') }}</b>

                                            </label>

                                        <input id="post-keywords" name="meta_keywords" value="{{ $post->meta_keywords }}" type="text" class="form-control">
                                        <input id="" name="daily_news" value="{{ $post->daily_news }}" type="hidden" class="form-control">
                                        <input id="" name="viewpoint" value="{{ $post->viewpoint }}" type="hidden" class="form-control">
                                        <input id="" name="advertisement" value="{{ $post->advertisement }}" type="hidden" class="form-control">

                                    </div>

                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <label for="post_tags" class="col-form-label">{{ __('tags') }}({{ __('meta_tag') }})</label>

                                        <input id="post_tags" name="tags" type="text" value="{{ $post->tags }}"

                                               data-role="tagsinput" class="form-control"/>

                                    </div>

                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <label for="post_desc"><b>{{ __('description') }}</b> ({{ __('meta_description') }}

                                            )</label>

                                        <textarea class="form-control meta" id="meta_description" name="meta_description" data-type="description"

                                                  rows="3">{{ $post->meta_description }}</textarea>

                                        <p class="display-nothing alert alert-danger mt-2" role="alert">

                                            {{__('current_characters')}}: <span class="characters"></span>, {{ __('meta_title').' '. __('should_bd') .' '. __('in_between') .' '. '30-60 ' . __('characters') }}

                                        </p>

                                        <p class="display-nothing alert alert-success mt-2" role="alert">

                                            {{__('current_characters')}}: <span class="characters"></span>

                                        </p>

                                    </div>

                                </div>

                            </div>

                            <!-- SEO section end -->

                        </div>

                        <!-- Main Content section end -->



                        <!-- right sidebar start -->

                        <div class="col-12 col-lg-3">

                            <div class="add-new-page  bg-white p-20 m-b-20">

                                <div class="block-header">

                                    <h2>{{ __('image') }}</h2>

                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <!-- Large modal -->

                                        <button type="button" id="btn_image_modal"

                                                class="btn btn-primary btn-image-modal" data-id="1" data-toggle="modal"

                                                data-target=".image-modal-lg">{{ __('add_image') }}</button>

                                        <input id="image_id" value="{{ $post->image_id }}" name="image_id" type="hidden"

                                               class="form-control image_id">

                                    </div>

                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <div class="form-group text-center">

                                            @if(isFileExist($post->image, $result = @$post->image->thumbnail))

                                                <img src=" {{basePath($post->image)}}/{{ $result }} "

                                                     id="image_preview" width="200" height="200"

                                                     class="img-responsive img-thumbnail image_preview" alt="{!! $post->title !!}">

                                            @else

                                                <img src="{{static_asset('default-image/default-100x100.png') }} " id="image_preview"

                                                     width="200" height="200" class="img-responsive img-thumbnail image_preview"

                                                     alt="{!! $post->title !!}">

                                            @endif

                                        </div>

                                    </div>

                                </div>
                                

                            </div>

                            <div class="add-new-page  bg-white p-20 m-b-20">


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="alt_tag">{{ __('Alt Tag') }}</label>
                                        <input type="text" value="{{ $post->alt_tag }}" name="alt_tag" id="alt_tag"  class="form-control">
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="old_id">{{ __('Old ID') }}</label>
                                        <input type="text" value="{{ $post->old_id }}" name="old_id" id="old_id"  class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <label for="post_language">{{ __('select_language') }}*</label>

                                        <select class="form-control dynamic-category" id="post_language" name="language"

                                         data-dependent="category_id">

                                            @foreach ($activeLang as  $lang)

                                                <option

                                                    @if($post->language==$lang->code) Selected

                                                    @endif value="{{ $lang->code }}">{{ $lang->name }}

                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_language">{{ __('Date') }}*</label>
                                        <?php
                                        
                                        $date =      date('Y-m-d\TH:i', strtotime($post->created_at));
                                        ?>
                                        <input type="datetime-local" name="update_date" value="{{$date}}"id="update_date" required class="form-control">
                                    </div>
                                </div>

                           
                                        <?php  $date =      date('Y-m-d\TH:i', strtotime($post->created_at)); ?>
                                        <input type="hidden" name="update_date_new" value="{{$date}}"id="update_date" class="form-control">
                                  

                                <div class="col-sm-12">
                                    <div class="form-group">
                                            <label for="post_user_id">{{ __('Select User') }}*</label>
                                            <?php 
                                            // print_r($users);
                                            ?>
                                            <select class="form-control dynamic-category" id="post_user_id" name="user_id"
                                            required>
                                            <?php
                                            $keys = 0;
                                            ?>
                                            @foreach ($users as $user)

                                            @if($user->withActivation != null)
                                        
                                            @foreach ($user->withRoles as $role)
                                            <?php  $keys++; ?>
                                                @if($role->role_id !='4') 
                                                    <option  @if($user->id == $post->user_id) Selected  @endif value="{{ $user->id }}"> {{ $user->first_name }} {{ $user->last_name }}  </option>
                                                @endif 
                                                @endforeach
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">
                                    <label for="post_user_id">{{ __('Select Category') }}*</label>

                                        <?php 
                                         $postcategory = json_decode($post->category_id);
                                        ?>
                                        <select class="form-control dynamic select2 category-multiple" multiple="multiple" id="category_id" name="category_id[]"

                                                data-dependent="sub_category_id" required>

                                            <option value="">{{ __('select_category') }}</option>

                                            @foreach ($categories as $category)

                                                <option @if(in_array($category->id, $postcategory)) Selected

                                                    @endif value="{{ $category->id }}">{{ $category->category_name }}</option>

                                            @endforeach

                                        </select>

                                    </div>

                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <label for="sub_category_id">{{ __('sub_category') }}</label>

                                        <select class="form-control dynamic" id="sub_category_id" name="sub_category_id">

                                            <option value="">{{ __('select_sub_category') }}</option>

                                            @foreach ($subCategories as $subCategory)

                                                <option @if($post->sub_category_id == $subCategory->id) Selected

                                                        @endif value="{{ $subCategory->id }}">{{ $subCategory->sub_category_name }}</option>

                                            @endforeach

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="add-new-page  bg-white p-20 m-b-20">

                                <div class="col-md-12">

                                    <div class="block-header">

                                        <h2>{{ __('article_detail') }}</h2>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label class="custom-control custom-radio detail-control-inline">

                                                {{--                                            {{(data_get($activeTheme, 'options.detail_style') == "style_1"? 'checked':'')}}--}}

                                                <input type="radio" name="layout" id="detail_style_1" value="default" {{@$post->layout=="default" ? 'checked': ''}}  class="custom-control-input">

                                                <span class="custom-control-label"></span>

                                            </label>

                                            <img src="{{static_asset('default-image/Detail/detail_1.png') }}" alt="" class="img-responsive cat-block-img">

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label class="custom-control custom-radio detail-control-inline">

                                                <input type="radio" name="layout" id="detail_style_2" value="style_2" {{@$post->layout=="style_2" ? 'checked': ''}}  class="custom-control-input">

                                                <span class="custom-control-label"></span>

                                            </label>

                                            <img src="{{static_asset('default-image/Detail/detail_2.png') }}" alt="" class="img-responsive cat-block-img">

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label class="custom-control custom-radio detail-control-inline">

                                                <input type="radio" name="layout" id="detail_style_3" value="style_3" {{@$post->layout=="style_3" ? 'checked': ''}}  class="custom-control-input">

                                                <span class="custom-control-label"></span>

                                            </label>

                                            <img src="{{static_asset('default-image/Detail/detail_3.png') }}" alt="" class="img-responsive cat-block-img">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="add-new-page  bg-white p-20 m-b-20">

                                <div class="block-header">

                                    <h2>{{ __('publish') }}*</h2>

                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <select class="form-control" id="post_status" name="status" required>

                                            <option @if($post->status==1 && $post->scheduled==0) selected

                                                    @endif value="1">{{ __('published') }}</option>

                                             <option @if($post->status==0 && $post->scheduled==0) selected

                                                    @endif value="0">{{ __('draft') }}</option> 

                                             <option @if($post->status==0 && $post->scheduled==1) selected

                                                    @endif value="2">{{ __('scheduled') }}</option> 

                                        </select>

                                    </div>

                                </div>

                                <div class="col-sm-12 divScheduleDate"

                                     @if($post->post_status==0 && $post->scheduled==1) @else id="display-nothing" @endif>

                                    <label for="scheduled_date">{{ __('schedule_date') }}</label>

                                    <div class="input-group">

                                        <label class="input-group-text" for="scheduled_date"><i

                                                class="fa fa-calendar-alt"></i></label>

                                        <input type="text" class="form-control date" id="scheduled_date"

                                               value="{{ Carbon\Carbon::parse($post->scheduled_date)->format('m/d/Y g:i A') }}"

                                               name="scheduled_date"/>

                                    </div>

                                </div>

                              
                            </div>

                        </div>

                        <!-- right sidebar end -->

                    </div>

                </div>

            </div>

        {!! Form::close() !!}

        <!-- page info end-->

        </div>

    </div>



<input type="hidden" value="{{ $content_count }}" id="content_number">



@endsection

@section('script')

    <script>

        $(document).ready(function () {

            $(".category-multiple").select2({
                placeholder: "Select a Category"
            });


            
            $(".product-multiple").select2({
                placeholder: "Select a Product"
            });


            $(".company-multiple").select2({
                placeholder: "Select a Company"
            });



             $('.dynamic-category').change(function () {

                if ($(this).val() != '') {

                    var select = $(this).attr("id");

                    var value = $(this).val();

                    var dependent = $(this).data('dependent');

                    var _token = "{{ csrf_token() }}";

                    $.ajax({

                        url: "{{ route('category-fetch') }}",

                        method: "POST",

                        data: {select: select, value: value, _token: _token},

                        success: function (result) {

                            $('#' + dependent).html(result);

                        }



                    })

                }

            });



            $('#post_language').change(function () {

                $('#category_id').val('');

                $('#sub_category_id').val('');

            });







            $('.dynamic').change(function () {

                if ($(this).val() != '') {

                    var select = $(this).attr("id");

                    var value = $(this).val();

                    var dependent = $(this).data('dependent');

                    var _token = "{{ csrf_token() }}";

                    $.ajax({

                        url: "{{ route('subcategory-fetch') }}",

                        method: "POST",

                        data: {select: select, value: value, _token: _token},

                        success: function (result) {

                            $('#' + dependent).html(result);

                        }



                    })

                }

            });



            $('#category_id').change(function () {

                $('#sub_category_id').val('');

            });


            // $('.product-multiple').change(function () {
            //         var select = $(this).attr("id");
            //         //  var value = $(this).val();
            //          var value = $(".product-multiple option:selected").map(function() {
            //             return $(this).data("slug");
            //             }).get();
            //         var dependent = $(this).data('dependent');
            //         var _token = "{{ csrf_token() }}";
            //         $.ajax({
            //             url: "{{ route('company-fetch') }}",
            //             method: "POST",
            //             data: {select: select, value: value, _token: _token},
            //             success: function (result) {
            //                 $('#' + dependent).html(result);
            //             }

            //         })
            // });


            
            $('.company-multiple').change(function () {
                var select = $(this).attr("id");
                //  var value = $(this).val();
                    var value = $(".company-multiple option:selected").map(function() {
                    return $(this).data("slug");
                    }).get();
                var dependent = $(this).data('dependent');
                var _token = "{{ csrf_token() }}";
                
                $.ajax({
                    url: "{{ route('product-fetch') }}",
                    method: "POST",
                    data: {select: select, value: value, _token: _token},
                    success: function (result) {
                        $('#' + dependent).html(result);
                    }

                })
            });





        });



    </script>

    <script>

        addContent = function(value) {



            var content_number = $("#content_number").val();

            content_number++;



            $.ajax({

                url: "{{ route('add-content') }}",

                method: "GET",

                data: {value: value, content_count:content_number},

                success: function (result) {

                    $('.content-area').append(result);

                    $("#content_number").val(content_number);



                    // auto scrolling to newly added element

                    var newlyAdded = 'content_'+content_number;

                    $('body, html').animate({ scrollTop: $('.'+newlyAdded).offset().top }, 1000);

                }



            });

        }





        $(document).on("click", ".add-new-page .row_remove", function () {

            let element = $(this).parents('.add-new-page');

            //element.remove(1000);

            element.hide("slow", function(){ $(this).remove(); })

        });

    </script>



    <script type="text/javascript" src="{{static_asset('js/post.js')}}"></script>

    <script src="{{static_asset('js/tagsinput.js')}}"></script>


    <!-- <script src="{{static_asset('vendor/tinymce/tinymce.min.js')}}"></script> -->
    <script src="https://cdn.ckeditor.com/4.17.1/standard-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('post_content_article', {

        // allowedContent: {
        //     'b i ul ol big small': true,
        //     'h1 h2 h3 p blockquote li': {
        //         styles: 'text-align'
        //     },
        //     a: { attributes: '!href,target' },
        //     img: {
        //         attributes: '!src,alt',
        //         styles: 'width,height',
        //         classes: 'left,right'
        //     }
        // },
        extraPlugins: 'image2, uploadimage, sourcedialog, iframe',

        toolbar: [{
                name: 'clipboard',
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            },
            {
                name: 'document',
                items: ['Source', '-', 'Save', 'NewPage', 'ExportPdf', 'Preview', 'Print', '-', 'Templates']
            },
            {
                name: 'styles',
                items: ['Styles', 'Format', 'Font', 'FontSize']
            },
            {
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat']
            },
            {
                name: 'paragraph',
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']
            },
            {
                name: 'links',
                items: ['Link', 'Unlink', 'Anchor']
            },
            {
                name: 'insert',
                items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']
            },
            {
                name: 'tools',
                items: ['Maximize', 'ShowBlocks']
            },
            {
                name: 'colors',
                items: ['TextColor', 'BGColor']
            },
            {
                name: 'forms',
                items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField']
            },
            {
                name: 'editing',
                items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
            }
        ],

       

        // Configure your file manager integration. This example uses CKFinder 3 for PHP.
        filebrowserBrowseUrl: '/apps/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '/apps/ckfinder/ckfinder.html?type=Images',
        filebrowserUploadUrl: '/apps/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '/apps/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

        // Upload dropped or pasted images to the CKFinder connector (note that the response type is set to JSON).
        uploadUrl: '/apps/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

        // Reduce the list of block elements listed in the Format drop-down to the most commonly used.
        format_tags: 'p;h1;h2;h3;pre',
        // Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
        removeDialogTabs: 'image:advanced;link:advanced',
        height: 450,
        removeButtons: 'PasteFromWord'
    });
</script>

    
<!-- <script src="https://cdn.tiny.cloud/1/nnd7pakaxqr7isf3oqefsdlew1jsidgl78umfeus6tg21ng0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->

@endsection

