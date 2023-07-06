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
            <form action="#" method="post">
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
                            <div class="col-12 col-lg-5">
                                {!!  Form::open(['route'=>'save-new-product','method' => 'post']) !!}
                                <div class="add-new-page  bg-white p-20 m-b-20">
                                    <div class="block-header">
                                        <h2>{{ __('Add Product') }}</h2>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="language">{{ __('select_language') }}*</label>


                                            <select class="form-control dynamic-company" id="language" name="language"
                                        data-dependent="company_id" required>
                                            @foreach ($activeLang as  $lang)
                                                <option
                                                    @if(App::getLocale()==$lang->code) Selected
                                                    @endif value="{{ $lang->code }}">{{ $lang->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="company_id">{{ __('parent_company') }}*</label>
                                            <select class="form-control dynamic" id="company_id" name="company_id" required>
                                            <option value="">{{ __('select_company') }}</option>
                                            @foreach ($companies as $company)
                                                <option
                                                    value="{{ $company->id }}">{{ $company->company_name }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="product-name"
                                                   class="col-form-label">{{ __('Product Name') }}*</label>
                                            <input id="product-name" name="product_name" type="text"
                                                   class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="company-name" class="col-form-label">{{ __('company Name') }} </label>

                                            <select class="form-control dynamic select2  select2 company-multiple"
                                                multiple="multiple" id="company_id" name="company_id[]" name="company_id"
                                                data-dependent="sub_company_id" required>
                                                <option value="">{{ __('select company') }}</option>
                                                <?php 
                                               // dd($companies);
                                                ?>
                                                
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="product-slug"
                                                   class="col-form-label"><b>{{ __('Slug') }}</b>
                                                ({{ __('Slug Message') }})</label>
                                            <input id="product-slug" name="slug" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="product-desc"
                                                   class="col-form-label"><b>{{ __('Description') }}</b>
                                                ({{ __('Meta Tag') }})</label>
                                            <input id="product-desc" name="meta_description" type="text"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="product-keywords"
                                                   class="col-form-label"><b>{{ __('Keywords') }}</b>
                                                ({{ __('Meta Tag') }})</label>
                                            <input id="product-keywords" name="meta_keywords" type="text"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 m-t-20">
                                            <div class="form-group form-float form-group-sm text-right">
                                                <button type="submit" name="btnSubmit"
                                                        class="btn btn-primary pull-right"><i
                                                        class="m-r-10 mdi mdi-plus"></i>{{ __('Add Product') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                {!! Form::close() !!}
                            </div>
                            <!-- Main Content section end -->

                            <!-- right sidebar start -->
                            <div class="col-12 col-lg-7">
                                <div class="add-new-page row  bg-white p-20 m-b-20">

                                <div class="col-12 col-lg-12">

{!!  Form::open(['route' => 'products','method' => 'GET']) !!}

<div class="item-table-filter  col-sm-8">
    <p class="text-muted"><small>{{__('search')}}</small></p>
    <input name="search_key" class="form-control" placeholder="{{__('Type Product Name')}}"
            type="search"  value="{{$search_key}}">
</div>

<div class="item-table-filter md-top-10 item-table-style  col-sm-2">
    <p>&nbsp;</p>
    <button type="submit" class="btn bg-primary">{{ __('filter') }}</button>
</div>
{!! Form::close() !!}
</div>


                                    <div class="block-header m-b-20 col-lg-12">
                                        <h2>{{ __('Products') }}</h2>
                                    </div>
                                        


                                    <div class="table-responsive all-pages">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr role="row">
                                                <th>#</th>
                                                <th>{{ __('Product Name') }}</th>
                                                {{-- <th>{{ __('parent_company') }}</th> --}}
                                                @if(Sentinel::getUser()->hasAccess(['sub_category_write']) || Sentinel::getUser()->hasAccess(['sub_category_delete']))
                                                    <th>{{ __('options') }}</th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($products as $product)
                                                <tr role="row" class="odd" id="row_{{ $product->id }}">
                                                    <td class="sorting_1">{{ $product->id }}</td>
                                                    <td>{{ $product->product_name }}</td>
                                                    {{-- <td> {{ $product->company['company_name'] }} </td> --}}
                                                    @if(Sentinel::getUser()->hasAccess(['sub_category_write']) || Sentinel::getUser()->hasAccess(['sub_category_delete']))
                                                        <td>
                                                            <div class="dropdown">
                                                                <button
                                                                    class="btn bg-primary dropdown-toggle btn-select-option"
                                                                    type="button" data-toggle="dropdown">...<span
                                                                        class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu options-dropdown">
                                                                    @if(Sentinel::getUser()->hasAccess(['sub_category_write']))
                                                                        <li>
                                                                            <a href="{{ route('edit-product',['id'=>$product]) }}"><i
                                                                                    class="fa fa-edit option-icon"></i>{{ __('edit') }}
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                    @if(Sentinel::getUser()->hasAccess(['sub_category_delete']))
                                                                        <li>
                                                                            <a href="javascript:void(0)"
                                                                               onclick="delete_item('products','{{ $product->id }}')"><i
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
                                                <h2>{{ __('showing')}} {{ $products->firstItem()}} {{ __('to') }} {{ $products->lastItem()}}
                                                    of {{ $products->total()}} {{ __('entries') }}</h2>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 text-right">
                                            <div class="table-info-pagination float-right">
                                                <nav aria-label="Page navigation example">
                                                    <!-- {!! $products->render() !!} -->
                                                    {{ $products->appends(request()->query())->links() }}
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
            </form>
            <!-- page info end-->
        </div>
    </div>
@section('script')

    <script>
        $(document).ready(function () {

            $('.dynamic-company').change(function () {
                if ($(this).val() != '') {
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var _token = "{{ csrf_token() }}";
                    $.ajax({
                        url: "{{ route('company-fetch') }}",
                        method: "POST",
                        data: {select: select, value: value, _token: _token},
                        success: function (result) {
                            $('#' + dependent).html(result);
                        }

                    })
                }
            });

            $('#language').change(function () {
                $('#company_id').val('');
            });
        });
    </script>


<script>
        $(document).ready(function () {


            $(".company-multiple").select2({
                placeholder: "Select a Company"
            });

        });
    </script>
    @endsection
@endsection
