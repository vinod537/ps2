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
            {!!  Form::open(['route'=>'store-slider','method' => 'post', 'enctype'=>'multipart/form-data']) !!}
            <input type="hidden" id="images" value="{{ $countImage }}">
            <input type="hidden" id="imageCount" value="1">
            <div class="row clearfix">
                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">
                        <div class="add-new-header clearfix">
                            <div class="row">
                                <div class="col-6">
                                    <div class="block-header">
                                        <h2>{{ __('create') }}</h2>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('sliders') }}" class="btn btn-primary btn-add-new btn-sm"><i class="fas fa-arrow-left"></i>
                                        {{ __('back_to_sliders') }}
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
                                    <option value="Slider_1"> {{ __('Slider 1') }}</option>
                                    <!-- <option value="Slider_2"> {{ __('Slider 2') }}</option>
                                    <option value="Slider_3"> {{ __('Slider 3') }}</option> -->
                                </select>
                            </div>
                        </div>                   

                        <div class="col-sm-12">
                            <div class="form-group">
                                <button type="button" id="btn_image_modal" class="btn btn-primary btn-image-modal" data-id="1" data-toggle="modal" data-target=".image-modal-lg">{{ __('image') }}*</button>
                                <input id="image_id" name="image_id" type="hidden" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group text-center">
                                <img src="{{static_asset('default-image/default-100x100.png') }} " id="image_preview"  width="200" height="200" alt="image" class="img-responsive img-thumbnail">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="title" class="col-form-label">{{ __('Title') }}</label>
                                <input id="title" name="title"  value="{{ old('title') }}" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="content" class="col-form-label">{{ __('content') }}</label>
                                        <textarea name="content" value="{{ old('content') }}" id="content"
                                                  cols="30" rows="5"></textarea> 
                                   </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="order_type" class="col-form-label">{{ __('Slider Order') }}</label>
                                <input id="order_type" name="order_type" required  value="{{ old('order_type') }}" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="show_hide" class="col-form-label">{{ __('Show/Hide') }}</label>
                                <select id="show_hide" name="show_hide" required type="number" class="form-control">
                                    <option value="1">Show</option>
                                    <option value="0">Hide</option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-sm-12">
                            <div class="form-group">
                                <label for="button_type" class="col-form-label">{{ __('Button Type') }}</label>
                                <select id="button_type" name="button_type"  type="number" class="form-control">
                                    <option value="ContactUrl">Contact Url</option>
                                    <option value="Newsletter">Newsletter</option>
                                    <option value="MobileApps">Mobile Apps</option>
                                </select>
                            </div>
                        </div> --}}

                        <div class="col-sm-12 urls">
                            <div class="form-group">
                                <label for="content1" class="col-form-label">{{ __('Button content 1') }}</label>
                                <input id="content1" name="content1"  value="{{ old('content1') }}" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12 urls">
                            <div class="form-group">
                                <label for="url1" class="col-form-label">{{ __('url1') }}</label>
                                <input id="url1" name="url1"  value="{{ old('url1') }}" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-12 urls">
                            <div class="form-group">
                                <label for="content2" class="col-form-label">{{ __('Button content 2') }}</label>
                                <input id="content2" name="content2"  value="{{ old('content2') }}" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12 urls">
                            <div class="form-group">
                                <label for="url2" class="col-form-label">{{ __('url2') }}</label>
                                <input id="url2" name="url2"  value="{{ old('url2') }}" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group form-float form-group-sm">
                                    <button type="submit" class="btn btn-primary float-right m-t-20"><i class="mdi mdi-plus"></i> {{ __('create') }}</button>
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

    <script>
        $('#button_type').change(function(){
            var btntype = $(this).val();
            if (btntype == 'ContactUrl') {
                $('.urls').show();    
            }else{
                $('.urls').hide(); 
            }
        })

    </script>

@endsection
