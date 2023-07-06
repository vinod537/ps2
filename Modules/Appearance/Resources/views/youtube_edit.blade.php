@extends('common::layouts.master')
@section('ads-aria-expanded')
    aria-expanded="true"
@endsection
@section('ads-show')
    show
@endsection
@section('sliders')
    active
@endsection
@section('ads_active')
    active
@endsection
@section('modal')
    @include('gallery::image-gallery')
@endsection

@section('content')

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            {!!  Form::open(['route'=>['update-slider',$slider->id],'method' => 'post', 'enctype'=>'multipart/form-data']) !!}
            <input type="hidden" id="imageCount" value="1">
            <div class="row clearfix">

                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">
                        <div class="add-new-header clearfix">
                            <div class="row">
                                <div class="col-6">
                                    <div class="block-header">
                                        <h2>{{ __('edit') }}</h2>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('sliders') }}" class="btn btn-primary btn-add-new btn-sm"><i class="fas fa-arrow-left"></i>
                                        {{ __('back') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

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

                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">
                        <div class="block-header">
                            <div class="form-group">
                                <h4 class="border-bottom">{{ __('details') }}</h4>
                            </div>
                        </div>
                 
                  

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="type" class="col-form-label">{{ __('type') }}*</label>
                                <select id="type" name="type" class="form-control" required>
                                    <!-- <option value=""> {{ __('select_option') }}</option> -->
                                    <option value="Slider_1" @if($slider->type=='Slider_1') selected @endif> {{ __('Slider 1') }}</option>
                                    <!-- <option value="Slider_2" @if($slider->type=='Slider_2') selected @endif> {{ __('Slider 2') }}</option>
                                    <option value="Slider_3" @if($slider->type=='Slider_3') selected @endif> {{ __('Slider 3') }}</option> -->
                                </select>
                            </div>
                        </div>    
                       
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button type="button" id="btn_image_modal" class="btn btn-primary btn-image-modal" data-id="1" data-toggle="modal" data-target=".image-modal-lg">{{ __('update_image') }}*</button>
                                <input id="image_id" value="{{ $slider->image_id }}" name="image_id" type="hidden" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group text-center">
                            @if(isFileExist(@$slider->adImage, $result = @$slider->adImage->thumbnail))
                                        <img src="{{basePath($slider->adImage)}}/{{ $result }}" data-src="{{basePath($slider->adImage)}}/{{ $result }}" alt="" id="image_preview"  width="200" height="200" alt="image" class="img-responsive img-thumbnail">
                                    @else
                                        <img src="{{static_asset('default-image/default-image/default-100x100.png') }} "  id="image_preview"  width="200" height="200" alt="image" class="img-responsive img-thumbnail">
                                    @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="title" class="col-form-label">{{ __('Title') }}</label>
                                <input id="title" name="title"  value="{{ $slider->title }}" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="post_content" class="col-form-label">{{ __('content') }}</label>
                                        <textarea name="content" value="{{ old('content') }}" id="post_content"
                                                  cols="30" rows="5">{{ $slider->content }}</textarea> 
                                   </div>
                        </div>

                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="content1" class="col-form-label">{{ __('content1') }}</label>
                                <input id="content1" name="content1"  value="{{ $slider->content1 }}" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="url1" class="col-form-label">{{ __('url1') }}</label>
                                <input id="url1" name="url1"  value="{{ $slider->url1 }}" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="content2" class="col-form-label">{{ __('content2') }}</label>
                                <input id="content2" name="content2"  value="{{ $slider->content2 }}" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="url2" class="col-form-label">{{ __('url2') }}</label>
                                <input id="url2" name="url2"  value="{{ $slider->url2 }}" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group form-float form-group-sm">
                                    <button type="submit" class="btn btn-primary float-right m-t-20"><i class="mdi mdi-plus"></i> {{ __('update_ad') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        {{ Form::close() }}
        <!-- page info end-->
        </div>
    </div>




@endsection

@section('script')
 


    <script type="text/javascript" src="{{static_asset('js/post.js')}}"></script>

    <script src="{{static_asset('js/tagsinput.js')}}"></script>
    @endsection