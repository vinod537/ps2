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
                        <div class="col-12 col-lg-12">
                            {!! Form::open(['route' => 'update-company', 'method' => 'post']) !!}
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('update_company') }}</h2>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="language">{{ __('select_language') }}*</label>
                                        <select class="form-control" name="language" id="language">
                                            @foreach ($activeLang as $lang)
                                                <option @if ($company->language == $lang->code) Selected @endif
                                                    value="{{ $lang->code }}">{{ $lang->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="company-name" class="col-form-label">{{ __('company_name') }}
                                            *</label>
                                        <input id="company-name" name="company_name" value="{{ $company->company_name }}"
                                            type="text" class="form-control">
                                        <input name="company_id" value="{{ $company->id }}" type="hidden">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="company-slug" class="col-form-label"><b>{{ __('slug') }}</b>
                                            ({{ __('slug_message') }})</label>
                                        <input id="company-slug" name="slug" value="{{ $company->slug }}" type="text"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="company-desc" class="col-form-label"><b>{{ __('description') }}</b>
                                            ({{ __('meta_tag') }})</label>
                                        <input id="company-desc" name="meta_description"
                                            value="{{ $company->meta_description }}" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="company-keywords" class="col-form-label"><b>{{ __('keywords') }}</b>
                                            ({{ __('meta_tag') }})</label>
                                        <input id="company-keywords" name="meta_keywords"
                                            value="{{ $company->meta_keywords }}" type="text" class="form-control">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-12 m-t-20">
                                        <div class="form-group form-float form-group-sm text-right">
                                            <button type="submit" name="btnSubmit" class="btn btn-primary pull-right"><i
                                                    class="m-r-10 mdi mdi-content-save-all"></i>{{ __('update_company') }}
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

@endsection

@section('script')



    <script>
        $(document).ready(function () {


            $(".category-multiple").select2({
                placeholder: "Select a Product"
            });

        });
    </script>


@endsection
