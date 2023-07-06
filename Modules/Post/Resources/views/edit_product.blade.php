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
@section('product-active')
    active
@endsection

@section('content')

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            <div class="row clearfix">
                <div class="col-12">
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
                        <div class="col-12 col-lg-12">
                            {!!  Form::open(['route'=>'update-product','method' => 'post']) !!}
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('update_product') }}</h2>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="language">{{ __('select_language') }}*</label>
                                        <select class="form-control  dynamic-category" name="language" id="language"
                                        data-dependent="category_id" required>
                                            @foreach ($activeLang as  $lang)
                                                <option
                                                    @if($product->language==$lang->code) Selected
                                                    @endif value="{{$lang->code}}">{{$lang->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="product"
                                               class="col-form-label">{{ __('product_name') }}*</label>
                                        <input id="product" value="{{ $product->product_name }}"
                                               name="product_name" type="text" class="form-control" required>
                                        <input value="{{ $product->id }}" name="product_id" type="hidden"
                                               required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="company-name" class="col-form-label">{{ __('Company Name') }} </label>
                                        <select class="form-control dynamic company-multiple select2  select2 category-multiple"
                                            multiple="multiple" id="company_id" name="company_id[]" name="company_id"
                                            data-dependent="company_id" required>
                                            <option value="">{{ __('select_company') }}</option>
                                            @foreach ($companies as $company)
                                                <option @if(in_array($company->id, $CompanyProduct)) selected @endif value="{{ $company->id }}">{{ $company->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="product-slug" class="col-form-label"><b>{{ __('slug') }}</b>
                                            ({{ __('slug_message') }})</label>
                                        <input id="product-slug" value="{{ $product->slug }}" name="slug"
                                               type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="product-desc"
                                               class="col-form-label"><b>{{ __('description') }}</b>
                                            ({{ __('meta_tag') }})</label>
                                        <input id="product-desc" value="{{ $product->meta_description }}"
                                               name="meta_description" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="product-keywords"
                                               class="col-form-label"><b>{{ __('keywords') }}</b> ({{ __('meta_tag') }})</label>
                                        <input id="product-keywords" name="meta_keywords"
                                               value="{{ $product->meta_keywords }}" type="text"
                                               class="form-control">
                                    </div>
                                </div>
                                {{-- <div class="row p-l-15">
                                    <div class="col-12 col-md-4">
                                        <div class="form-title">
                                            <label for="show_on_menu">{{ __('show_on_menu') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-3 col-md-2">
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" name="show_on_menu"
                                                   @if($product->show_on_menu==1) checked
                                                   @endif id="show_on_menu_yes" value="1" checked=""
                                                   class="custom-control-input">
                                            <span class="custom-control-label">{{ __('yes') }}</span>
                                        </label>
                                    </div>
                                    <div class="col-3 col-md-2">
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" name="show_on_menu" id="show_on_menu_no" value="0"
                                                   @if($product->show_on_menu==0) checked
                                                   @endif class="custom-control-input">
                                            <span class="custom-control-label">{{ __('no') }}</span>
                                        </label>
                                    </div>
                                </div> --}}

                                <div class="row">
                                    <div class="col-12 m-t-20">
                                        <div class="form-group form-float form-group-sm text-right">
                                            <button type="submit" name="btnSubmit" class="btn btn-primary pull-right"><i
                                                    class="m-r-10 mdi mdi-content-save-all"></i>{{ __('update_product') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- Main Content section end -->
                    </div>
                </div>
            </div>

            <!-- page info end-->
        </div>
    </div>

@section('script')
<script>
    $(document).ready(function () {


        $(".company-multiple").select2({
            placeholder: "Select a Company"
        });

    });
</script>
@endsection

@endsection
