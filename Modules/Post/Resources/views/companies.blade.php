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
@section('company-active')
    active
@endsection

@section('modal')
    @include('gallery::image-gallery')
    @include('gallery::video-gallery')
    {{-- @include('gallery::image-gallery-content') --}}
@endsection

@section('content')

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            <div class="row clearfix">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            @if (session('error'))
                                <div id="error_m" class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div id="success_m" class="alert alert-success">
                                    {{ session('success') }}
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
                        <div class="col-12 col-lg-5">
                            {!! Form::open(['route' => 'save-new-company', 'method' => 'post']) !!}
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('Add Company') }}</h2>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="language">{{ __('select_language') }}*</label>
                                        <select class="form-control" name="language" id="language">
                                            @foreach ($activeLang as $lang)
                                                <option @if (App::getLocale() == $lang->code) Selected @endif
                                                    value="{{ $lang->code }}">{{ $lang->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="company-name" class="col-form-label">{{ __('Company Name ') }}
                                            *</label>
                                        <input id="company-name" name="company_name" type="text" class="form-control"
                                            required>
                                    </div>
                                </div>

                                {{-- <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="company-name" class="col-form-label">{{ __('Product Name') }} </label>

                                        <select class="form-control dynamic select2  select2 product-multiple"
                                            multiple="multiple" id="product_id" name="product_id[]" name="product_id"
                                            data-dependent="sub_product_id" required>
                                            <option value="">{{ __('select product') }}</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="company-slug" class="col-form-label"><b>{{ __('slug') }}</b>
                                            ({{ __('slug_message') }})</label>
                                        <input id="company-slug" name="slug" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="company-desc" class="col-form-label"><b>{{ __('description') }}</b>
                                            ({{ __('meta_tag') }})</label>
                                        <input id="company-desc" name="meta_description" type="text"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="company-keywords" class="col-form-label"><b>{{ __('keywords') }}</b>
                                            ({{ __('meta_tag') }})</label>
                                        <input id="company-keywords" name="meta_keywords" type="text"
                                            class="form-control">
                                    </div>
                                </div>
                                {{-- <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="company-order" class="col-form-label">{{ __('order') }}</label>
                                    <input id="company-order" value="1" name="order" type="number" class="form-control">
                                </div>
                            </div> --}}
                                {{-- <div class="col-sm-12">
                                <div class="block-header">
                                    <h2>{{__('featured')}}</h2>
                                </div>
                                <div class="row p-l-15">
                                    <div class="col-12 col-md-4">
                                        <div class="form-title">
                                            <label for="is_featured">{{__('status')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-3 col-md-2">
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" name="is_featured" id="visibility_show" value="1" class="custom-control-input" data-parsley-multiple="visibility">
                                            <span class="custom-control-label">{{__('yes')}}</span>
                                        </label>
                                    </div>
                                    <div class="col-3 col-md-2">
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" name="is_featured" id="visibility_hide" checked value="0" class="custom-control-input" data-parsley-multiple="visibility">
                                            <span class="custom-control-label">{{__('no')}}</span>
                                        </label>
                                    </div>
                                </div>
                            </div> --}}
                                {{-- <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('image') }}</h2>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <!-- Large modal -->
                                        <button type="button" id="btn_image_modal" class="btn btn-primary btn-image-modal" data-id="1" data-toggle="modal" data-target=".image-modal-lg">{{ __('add_image') }}</button>
                                        <input id="image_id" name="image_id" type="hidden" class="form-control image_id">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-group text-center">
                                            <img src="{{static_asset('default-image/default-100x100.png') }} " id="image_preview" width="200" height="200" alt="image" class="img-responsive img-thumbnail image_preview">
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                                {{-- <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('API Image') }}</h2>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <!-- Large modal -->
                                        <button type="button" id="btn_image_modal" class="btn btn-primary btn-image-modal" data-id="2" data-toggle="modal" data-target=".image-modal-lg">{{ __('add_image') }}</button>
                                        <input id="image_id_api" name="image_id_api" type="hidden" class="form-control image_id_api">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-group text-center">
                                            <img src="{{static_asset('default-image/default-100x100.png') }} " id="image_preview_api" width="200" height="200" alt="image" class="img-responsive img-thumbnail image_preview_api">
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                                <div class="row">
                                    <div class="col-12 m-t-20">
                                        <div class="form-group form-float form-group-sm text-right">
                                            <button type="submit" name="btnsubmit" class="btn btn-primary pull-right"><i
                                                    class="m-r-10 mdi mdi-plus"></i>{{ __('Add Company') }}</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- Main Content section end -->

                        <!-- right sidebar start -->
                            <div class="col-12 col-lg-7">   
                            <div class="add-new-page  row bg-white p-20 m-b-20  col-12 col-lg-12">
                                <div class="col-12 col-lg-12">

                                {!!  Form::open(['route' => 'companies','method' => 'GET']) !!}

                                <div class="item-table-filter  col-sm-8">
                                    <p class="text-muted"><small>{{__('search')}}</small></p>
                                    <input name="search_key" class="form-control" placeholder="{{__('Type Company Name')}}"
                                            type="search"  value="{{$search_key}}">
                                </div>

                                <div class="item-table-filter md-top-10 item-table-style  col-sm-2">
                                    <p>&nbsp;</p>
                                    <button type="submit" class="btn bg-primary">{{ __('filter') }}</button>
                                </div>
                            {!! Form::close() !!}
                            </div>

                                <div class="block-header m-b-20 col-lg-12">
                                    <h2>{{ __('Companies') }}</h2>
                                </div>
                                <div class="table-responsive all-pages">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr role="row">
                                                <th>#</th>
                                                <th>{{ __('Company Name') }}</th>
                                                <th>{{ __('Language') }}</th>

                                                {{-- <th>{{ __('is_featured') }}</th> --}}
                                                @if (Sentinel::getUser()->hasAccess(['category_write']) || Sentinel::getUser()->hasAccess(['category_delete']))
                                                    <th>{{ __('options') }}</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($companies as $company)
                                                <tr role="row" class="odd" id="row_{{ $company->id }}">
                                                    <td class="sorting_1">{{ $company->id }}</td>
                                                    <td>{{ $company->company_name }}</td>
                                                    <td>{{ $company->language }}</td>

                                                    {{-- <td>{{ $company->is_featured ? __('yes') : __('no') }}</td> --}}
                                                    @if (Sentinel::getUser()->hasAccess(['category_write']) || Sentinel::getUser()->hasAccess(['category_delete']))
                                                        <td>
                                                            <div class="dropdown">
                                                                <button
                                                                    class="btn bg-primary dropdown-toggle btn-select-option"
                                                                    type="button" data-toggle="dropdown">...
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu options-dropdown">
                                                                    @if (Sentinel::getUser()->hasAccess(['category_write']))
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('edit-company', ['id' => $company->id]) }}"><i
                                                                                    class="fa fa-edit option-icon"></i>{{ __('edit') }}
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                    @if (Sentinel::getUser()->hasAccess(['category_delete']))
                                                                        <li>
                                                                            <a href="javascript:void(0)"
                                                                                onclick="delete_item('companies','{{ $company->id }}')"><i
                                                                                    class="fa fa-trash option-icon"></i>{{ __('delete') }}
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                </ul>
                                                            </div>
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
                                            <h2>{{ __('showing') }} {{ $companies->firstItem() }} {{ __('to') }}
                                                {{ $companies->lastItem() }}
                                                of {{ $companies->total() }} {{ __('entries') }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 text-right">
                                        <div class="table-info-pagination float-right">
                                            <nav aria-label="Page navigation example">
                                                <!-- {!! $companies->render() !!} -->
                                                {{ $companies->appends(request()->query())->links() }}
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- right sidebar end -->
                    </div>
                </div>
            </div>
            <!-- page info end-->
        </div>
    </div>

@endsection


@section('script')



    <script>
        $(document).ready(function () {


            $(".product-multiple").select2({
                placeholder: "Select a Product"
            });

        });
    </script>


@endsection

