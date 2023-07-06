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

@section('content')

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            <div class="admin-section">
                <div class="row clearfix m-t-30">
                    <div class="col-12">
                        <div class="navigation-list bg-white p-20">
                            <div class="add-new-header clearfix m-b-20">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="block-header">
                                            <h2>{{ __('Sliders') }}</h2>
                                        </div>
                                    </div>
                                    @if(Sentinel::getUser()->hasAccess(['ads_write']))
                                        <div class="col-6 text-right">
                                            <a href="{{ route('create-slider') }}" class="btn btn-primary btn-sm btn-add-new"><i class="mdi mdi-plus"></i>
                                                {{ __('Create Slider') }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="table-responsive all-pages">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th>{{ __('Slider Order') }}</th>
                                        <th>{{ __('Show/Hide') }}</th>
                                        <th>{{ __('Button Type') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        @if(Sentinel::getUser()->hasAccess(['ads_write']) || Sentinel::getUser()->hasAccess(['ads_delete']) )
                                            <th>{{ __('options') }}</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($sliders as $slider)
                                        <tr role="row" id="row_{{ $slider->id }}" class="odd">
                                            <td class="sorting_1">{{ $slider->id }}</td>
                                            <td> {{ $slider->order_type }} </td>
                                            <td>    
                                                @if($slider->show_hide == '1')
                                                <button type="button" class="btn btn-success">Show</button>
                                                @else
                                                <button type="button" class="btn btn-danger">Hide</button>

                                                @endif
                                             </td>
                                            <td>                                                   
                                                <button type="button" class="btn btn-primary">{{$slider->button_type}}</button>
                                             </td>
                                            <td> {{ $slider->title }} </td>
                                            <td> {!! \Illuminate\Support\Str::limit(strip_tags($slider->content),170) !!}</td>
                                            <td>
                                                @if(isFileExist(@$slider->adImage, $result = @$slider->adImage->thumbnail))
                                                    <img src="{{basePath($slider->adImage)}}/{{ $result }}" data-src="{{basePath($slider->adImage)}}/{{ $result }}" alt="{{ $slider->ad_name }}" id="image_preview"  width="64" height="64" alt="image" class="img-responsive img-thumbnail">
                                                @else
                                                    <img src="{{static_asset('default-image/default-100x100.png') }} "  id="image_preview"  width="64" height="64" alt="image" class="img-responsive img-thumbnail">
                                                @endif
                                            </td>
                                            @if(Sentinel::getUser()->hasAccess(['ads_write']) || Sentinel::getUser()->hasAccess(['ads_delete']) )
                                                <td>
                                                    @if(Sentinel::getUser()->hasAccess(['ads_write']))
                                                        <a class="btn btn-light active btn-xs" href="{{ route('edit-slider',['id'=>$slider->id]) }}"><i class="fa fa-edit"></i>
                                                            {{ __('edit') }}
                                                        </a>
                                                    @endif
                                                    @if(Sentinel::getUser()->hasAccess(['ads_delete']))
                                                        <a href="javascript:void(0)" class="btn btn-danger active btn-xs"
                                                           onclick="delete_item('sliders','{{ $slider->id }}')"><i
                                                                class="fa fa-trash"></i>
                                                            {{ __('delete') }}
                                                        </a>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="block-header">
                                        <h2>{{ __('Showing') }} {{ $sliders->firstItem()}} {{  __('to') }} {{ $sliders->lastItem()}} {{ __('of') }} {{ $sliders->total()}} {{ __('entries') }}</h2>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-right">
                                    <div class="table-info-pagination float-right">
                                        {!! $sliders->render() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page info end-->
        </div>
    </div>

@endsection
