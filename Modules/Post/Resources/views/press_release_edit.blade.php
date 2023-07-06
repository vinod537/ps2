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

            {!!  Form::open(['route'=>['update-press-release','article',$post->id],'method' => 'post','enctype'=>'multipart/form-data']) !!}

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

                                <a href="{{ route('press-release') }}" class="btn btn-primary btn-add-new"><i

                                        class="fas fa-list"></i> {{ __('posts') }}

                                </a>

                            </div> --}}

                            <div class="col-6 text-right">

                                <div class="form-group">

                                    <label class="custom-control" for="btnSubmit"></label>

                                    <button type="submit" name="btnSubmit" class="btn btn-primary pull-right"><i

                                            class="m-r-10 mdi mdi-content-save-all"></i>{{ __('Update Press Release') }}

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
                                        <label for="post_company_name" class="col-form-label">{{ __('company_name') }}
                                            ({{ __('company_name') }})</label>
                                        <input id="post_company_name"  value="{{ $post->company_name }}" name="company_name" type="text" value="{{ old('company_name') }}"
                                               data-role="tagsinput" class="form-control"/>

                                    </div>
                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">
                                        <label for="post_product" class="col-form-label">{{ __('product') }}
                                            ({{ __('product') }})</label>
                                        <input id="post_product"   value="{{ $post->product }}" name="product" type="text" value="{{ old('product') }}"
                                               data-role="tagsinput" class="form-control"/>

                                    </div>
                                </div>

                                <!-- tinemcey start -->

                                <div class="row p-l-15">
                                    <div class="col-12">
                                        <label for="post_contentnews" class="col-form-label">{{ __('Content') }}*</label>
                                        <textarea name="post_contentnews"  value="{{ old('post_contentnews') }}" id="post_contentnews"
                                                  cols="30" rows="5">{!! $post->content !!}</textarea>
                                    </div>
                                </div>

                                

                                <!-- tinemcey end -->

                            </div>


                        

                     

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

                                        <input id="post-keywords" name="meta_keywords"

                                               value="{{ $post->meta_keywords }}" type="text" class="form-control">

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

                                        <label for="category_id">{{ __('category') }}*</label>
                                        <?php 
                                        $postcategory = json_decode($post->category_id);
                                       // print_r($postcategory);
                             
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

                                            {{-- <option @if($post->status==0 && $post->scheduled==0) selected

                                                    @endif value="0">{{ __('draft') }}</option> --}}

                                            {{-- <option @if($post->status==0 && $post->scheduled==1) selected

                                                    @endif value="2">{{ __('scheduled') }}</option> --}}

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





@section('script')

    <script>
        $(document).ready(function () {

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

            $(".category-multiple").select2({
                placeholder: "Select a Category"
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


            $('#category').change(function () {
                $('#sub_category_id').val('');
            });
        });
    </script>
    <script type="text/javascript" src="{{static_asset('js/post.js') }}"></script>
    <script type="text/javascript" src="{{static_asset('js/tagsinput.js') }}"></script>
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
<script src="https://cdn.ckeditor.com/4.17.1/standard-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('post_contentnews', {
        extraPlugins: 'image2, uploadimage, sourcedialog, iframe',

        toolbar: [{
                name: 'clipboard',
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            },
            {
                name: 'insert',
                items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']
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
   

@endsection





@endsection

@section('script')

    <script>

        $(document).ready(function () {



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

@endsection

