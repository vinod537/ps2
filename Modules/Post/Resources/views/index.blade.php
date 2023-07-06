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
                                            <h2>{{ __('posts') }}</h2>
                                        </div>
                                    </div>
                                    @if(Sentinel::getUser()->hasAccess(['post_write']))
                                        <div class="col-6 text-right">
                                            <a href="{{ route('create-article') }}"
                                            class="btn btn-primary btn-sm btn-add-new"><i class="mdi mdi-plus"></i>
                                                {{ __('create_article') }}
                                            </a>
                                            <a href="{{ route('create-video-post') }}"
                                               class="btn btn-primary btn-sm btn-add-new"><i class="mdi mdi-plus"></i>
                                                {{ __('create_video_post') }}
                                            </a>
                                            <a href="{{ route('create-audio-post') }}"
                                               class="btn btn-primary btn-sm btn-add-new"><i class="mdi mdi-plus"></i>
                                                {{ __('create_audio_post') }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="table-responsive all-pages">
                                <!-- Table Filter -->
                                <div class="row table-filter-container m-b-20">
                                    <div class="col-sm-12">
                                        {!!  Form::open(['route' => 'filter-post','method' => 'GET']) !!}
                                        <!-- <div class="item-table-filter">
                                            <p class="text-muted"><small>{{ __('language') }}</small></p>
                                            <select class="form-control" name="language">
                                                @foreach ($activeLang as  $lang)
                                                    <option value="{{ $lang->code }}">{{ $lang->name }} </option>
                                                @endforeach
                                            </select>
                                        </div> -->

                                        <!-- <div class="item-table-filter">
                                            <p class="text-muted"><small>{{ __('post_type') }}</small></p>
                                            <select name="post_type" class="form-control">
                                                <option value="">{{ __('all') }}</option>
                                                <option value="article">{{ __('article') }}</option>
                                                <option value="video">{{ __('video') }}</option>
                                            </select>
                                        </div> -->

                                        <div class="item-table-filter col-sm-2">
                                            <p class="text-muted"><small>{{ __('category') }}</small></p>
                                            <select class="form-control dynamic" id="category_id" name="category_id"
                                                    data-dependent="sub_category_id">
                                                <option value="">{{ __('all') }}</option>
                                                @foreach ($categories as $category)
                                                    <option @if($category_id == $category->id) selected @endif
                                                        value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- <div class="item-table-filter">
                                            <div class="form-group">
                                                <p class="text-muted"><small>{{ __('sub_category') }}</small></p>
                                                <select class="form-control dynamic" id="sub_category_id"
                                                        name="sub_category_id">
                                                    <option value="">{{ __('all') }}</option>
                                                </select>
                                            </div>
                                        </div> -->

                                        <div class="item-table-filter  col-sm-2">
                                            <div class="form-group">
                                                <p class="text-muted"><small>{{ __('From') }}</small></p>
                                                <input name="from_date" value="{{$from_date}}" class="form-control" placeholder="{{__('search')}}"
                                                   type="date">                                                
                                            </div>
                                        </div>

                                        <div class="item-table-filter  col-sm-2">
                                            <div class="form-group">
                                                <p class="text-muted"><small>{{ __('To') }}</small></p>
                                                <input name="to_date" value="{{$to_date}}"  class="form-control" placeholder="{{__('search')}}"
                                                   type="date">                                              
                                            </div>
                                        </div>

                                        <div class="item-table-filter  col-sm-2">
                                            <p class="text-muted"><small>{{__('search')}}</small></p>
                                            <input name="search_key" class="form-control" placeholder="{{__('search')}}"
                                                   type="search"  value="{{$search_key}}">
                                        </div>

                                        <div class="item-table-filter md-top-10 item-table-style  col-sm-2">
                                            <p>&nbsp;</p>
                                            <button type="submit" class="btn bg-primary">{{ __('filter') }}</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <!-- Table Filter -->
                                <table class="table table-bordered table-striped" role="grid">
                                    <thead>
                                    <tr role="row">
                                        {{-- <th width="20">
                                            <input type="checkbox" class="checkbox-table" id="checkAll">
                                        </th> --}}
                                        <th width="20">#</th>
                                        <th>{{ __('post') }}</th>
                                        <!-- <th>{{ __('language') }}</th> -->
                                        <th>{{ __('post_type') }}</th>
                                        <th>{{ __('Old ID') }}</th>
                                        <th>{{ __('Categories') }}</th>
                                        <th>{{ __('post_by') }}</th>
                                        <th>{{ __('visibility') }}</th>
                                        <th>{{ __('view') }}</th>
                                        <th>{{ __('added_date') }}</th>
                                        @if(Sentinel::getUser()->hasAccess(['post_write']) || Sentinel::getUser()->hasAccess(['post_delete']))
                                            <th>{{ __('options') }}</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($posts as $post)
                                        <tr id="row_{{ $post->id }}">
                                            {{-- <td>
                                                <input type="checkbox" id="table-checkbox" name="checkbox-table" class="filled-in chk-col-deep-purple" value="{{ $post->id }}">
                                                <label for="table-checkbox"></label>
                                            </td> --}}
                                            <td>{{ $post->id }}</td>
                                            <td>
                                                <div class="post-image">

                                                    @if(isFileExist(@$post->image, $result = @$post->image['thumbnail']))
                                                        <img
                                                            src=" {{basePath($post->image)}}/{{ $result }} "
                                                            data-src="{{basePath($post->image)}}/{{ $result }}"
                                                            alt="image" class="img-responsive img-thumbnail lazyloaded">

                                                    @else
                                                        <img src="{{static_asset('default-image/default-100x100.png') }} " width="200"
                                                             height="200" alt="image"
                                                             class="img-responsive img-thumbnail">
                                                    @endif
                                                </div> 
                                                <a href="@if($post->old_id) {{ route('article.detail', [$post->old_id, $post->slug]) }} @else {{ route('article.detail', [$post->id, $post->slug]) }} @endif">{{ $post->title }} </a>                                            </td>
                                            <!-- <td>{{ $post->language }} </td> -->
                                            <td class="td-post-type">{{ $post->post_type }}</td>
                                            <td>
                                                <label class="category-label m-r-5 label-table"
                                                      id="breaking-post-bgc">
                                                    {{ $post->old_id }} </label>

                                            </td>
                                            <td>
                                                <?php 
                                                  $category_id =   json_decode($post->category_id);
                                                  foreach ($category_id as $key => $value) { ?>
                                                      <label class="label label-success label-table">
                                                    {{\Modules\Post\Entities\Category::where('id', $value)->first()->category_name}}
                                                        
                                                        </label>
                                                  <?php }
                                                ?>

                                            </td>
                                            <td>
                                                <a href="#" target="_blank" class="table-user-link">
                                                    <strong>
                                                        @php
                                                            $roles=Sentinel::findById($post->user_id)->roles->first();
                                                        @endphp
                                                        {{ $roles->name }}
                                                    </strong>
                                                </a>
                                            </td>
                                            <td class="td-post-sp">
                                                @if($post->visibility==1)
                                                    <label class="label label-success label-table"><i
                                                            class="fa fa-eye"></i></label>
                                                @else
                                                    <label class="label label-default label-table"><i
                                                            class="fa fa-eye-slash"></i></label>
                                                @endif
                                                @if($post->breaking==1)
                                                    <label class="label bg-red label-table">{{ __('breaking') }}</label>
                                                @endif
                                                @if($post->featured==1)
                                                    <label
                                                        class="label bg-warning label-table">{{ __('featured') }}</label>
                                                @endif
                                                @if($post->recommended==1)
                                                    <label
                                                        class="label bg-aqua label-table">{{ __('recommended') }}</label>
                                                @endif
                                                @if($post->editor_picks==1)
                                                    <label
                                                        class="label bg-success label-table">{{ __('editor_picks') }}</label>
                                                @endif
                                                @if($post->slider==1)
                                                    <label class="label bg-teal label-table">{{ __('slider') }}</label>
                                                @endif

                                                @if($post->top_20==1)
                                                    <label class="label bg-teal label-table">{{ __('top_20') }}</label>
                                                @endif

                                                @if($post->insights_plus==1)
                                                    <label class="label bg-teal label-table">{{ __('insights_plus') }}</label>
                                                @endif

                                                @if($post->daily_news==1)
                                                    <label class="label bg-teal label-table">{{ __('daily_news') }}</label>
                                                @endif

                                                @if($post->viewpoint==1)
                                                    <label class="label bg-teal label-table">{{ __('viewpoint') }}</label>
                                                @endif

                                                @if($post->events==1)
                                                    <label class="label bg-teal label-table">{{ __('events') }}</label>
                                                @endif

                                                @if($post->advertisement==1)
                                                    <label class="label bg-teal label-table">{{ __('advertisement') }}</label>
                                                @endif
                                            </td>
                                            <td>{{ $post->total_hit }}</td>
                                            <td>{{ $post->created_at }}</td>
                                            @if(Sentinel::getUser()->hasAccess(['post_write']) || Sentinel::getUser()->hasAccess(['post_delete']))
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn bg-primary dropdown-toggle btn-select-option"
                                                                type="button" data-toggle="dropdown">...<span
                                                                class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu options-dropdown">
                                                            @if(Sentinel::getUser()->hasAccess(['post_delete']))
                                                                <li>
                                                                    <a href="javascript:void(0)"
                                                                       onclick="delete_item('posts','{{ $post->id }}')"><i
                                                                            class="fa fa-trash option-icon"></i>{{ __('delete') }}
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            @if(Sentinel::getUser()->hasAccess(['post_write']))
                                                                
                                                                <!-- <li>
                                                                    @if($post->slider==1)
                                                                        <a href="javascript:void(0)"
                                                                           onclick="remove_post_form('index','slider','{{ $post->id }}')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i>{{ __('slider') }}
                                                                        </a>

                                                                    @else
                                                                        <a href="javascript:void(0)"
                                                                           onclick="add_post_to('slider','{{ $post->id }}')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i>{{ __('slider') }}
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                                <li>

                                                                    @if($post->featured==1)
                                                                        <a href="javascript:void(0)"
                                                                           onclick="remove_post_form('index','featured','{{ $post->id }}')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i>{{ __('featured') }}
                                                                        </a>

                                                                    @else
                                                                        <a href="javascript:void(0)"
                                                                           onclick="add_post_to('featured','{{ $post->id }}')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i>{{ __('featured') }}
                                                                        </a>
                                                                    @endif
                                                                </li>

                                                                    <li>

                                                                    @if($post->top_20==1)
                                                                        <a href="javascript:void(0)"
                                                                        onclick="remove_post_form('index','top_20','{{ $post->id }}')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i>{{ __('top_20') }}
                                                                        </a>

                                                                    @else
                                                                        <a href="javascript:void(0)"
                                                                        onclick="add_post_to('top_20','{{ $post->id }}')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i>{{ __('top_20') }}
                                                                        </a>
                                                                    @endif
                                                                    </li>


                                                                    <li>

                                                                    @if($post->insights_plus==1)
                                                                        <a href="javascript:void(0)"
                                                                        onclick="remove_post_form('index','insights_plus','{{ $post->id }}')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i>{{ __('insights_plus') }}
                                                                        </a>

                                                                    @else
                                                                        <a href="javascript:void(0)"
                                                                        onclick="add_post_to('insights_plus','{{ $post->id }}')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i>{{ __('insights_plus') }}
                                                                        </a>
                                                                    @endif
                                                                    </li> -->

                                                                    <li>

                                                                    @if($post->daily_news==1)
                                                                        <a href="javascript:void(0)"
                                                                        onclick="remove_post_form('index','daily_news','{{ $post->id }}')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i>{{ __('daily_news') }}
                                                                        </a>

                                                                    @else
                                                                        <a href="javascript:void(0)"
                                                                        onclick="add_post_to('daily_news','{{ $post->id }}')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i>{{ __('daily_news') }}
                                                                        </a>
                                                                    @endif
                                                                    </li>


<!-- 
                                                                    <li>

                                                                    @if($post->viewpoint==1)
                                                                        <a href="javascript:void(0)"
                                                                        onclick="remove_post_form('index','viewpoint','{{ $post->id }}')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i>{{ __('viewpoint') }}
                                                                        </a>

                                                                    @else
                                                                        <a href="javascript:void(0)"
                                                                        onclick="add_post_to('viewpoint','{{ $post->id }}')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i>{{ __('viewpoint') }}
                                                                        </a>
                                                                    @endif
                                                                    </li>



                                                                    <li>

                                                                    @if($post->events==1)
                                                                        <a href="javascript:void(0)"
                                                                        onclick="remove_post_form('index','events','{{ $post->id }}')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i>{{ __('events') }}
                                                                        </a>

                                                                    @else
                                                                        <a href="javascript:void(0)"
                                                                        onclick="add_post_to('events','{{ $post->id }}')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i>{{ __('events') }}
                                                                        </a>
                                                                    @endif
                                                                    </li>

                                                                    <li>

                                                                    @if($post->advertisement==1)
                                                                        <a href="javascript:void(0)"
                                                                        onclick="remove_post_form('index','advertisement','{{ $post->id }}')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i>{{ __('advertisement') }}
                                                                        </a>

                                                                    @else
                                                                        <a href="javascript:void(0)"
                                                                        onclick="add_post_to('advertisement','{{ $post->id }}')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i>{{ __('advertisement') }}
                                                                        </a>
                                                                    @endif
                                                                    </li>



                                                                <li>

                                                                    @if($post->breaking==1)
                                                                        <a href="javascript:void(0)"
                                                                           onclick="remove_post_form('index','breaking','{{ $post->id }}')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i>{{ __('breaking') }}
                                                                        </a>

                                                                    @else
                                                                        <a href="javascript:void(0)"
                                                                           onclick="add_post_to('breaking','{{ $post->id }}')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i>{{ __('breaking') }}
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                                <li>

                                                                    @if($post->recommended==1)
                                                                        <a href="javascript:void(0)"
                                                                           onclick="remove_post_form('index','recommended','{{ $post->id }}')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i>{{ __('recommend') }}
                                                                        </a>
                                                                        {{-- <a href="{{ route('remove-form',['feature'=>'recommended','post_id'=>$post->id]) }}" name="option" class="btn-list-button">
                                                                          <i class="fa fa-minus option-icon"></i>{{ __('recommend') }} </a> --}}
                                                                    @else
                                                                        <a href="javascript:void(0)"
                                                                           onclick="add_post_to('recommended','{{ $post->id }}')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i>{{ __('recommend') }}
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                                <li>

                                                                    @if($post->editor_picks==1)
                                                                        <a href="javascript:void(0)"
                                                                           onclick="remove_post_form('index','editor_picks','{{ $post->id }}')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i>{{ __('editor_picks') }}
                                                                        </a>
                                                                        {{-- <a href="{{ route('remove-form',['feature'=>'recommended','post_id'=>$post->id]) }}" name="option" class="btn-list-button">
                                                                          <i class="fa fa-minus option-icon"></i>{{ __('recommend') }} </a> --}}
                                                                    @else
                                                                        <a href="javascript:void(0)"
                                                                           onclick="add_post_to('editor_picks','{{ $post->id }}')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i>{{ __('editor_picks') }}
                                                                        </a>
                                                                    @endif
                                                                </li> -->

                                                                <li>
                                                                    <a href="{{ route('edit-post',['type'=>$post->post_type,'id'=>$post->id]) }}"><i
                                                                            class="fa fa-edit option-icon"></i>{{ __('edit') }}
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    @if($post->visibility==1)
                                                                        <a href="javascript:void(0)"
                                                                           onclick="remove_post_form('index','visibility','{{ $post->id }}')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fas fa-eye-slash option-icon"></i>{{ __('invisibile') }}
                                                                        </a>
                                                                    @else
                                                                        <a href="javascript:void(0)"
                                                                           onclick="add_post_to('visibility','{{ $post->id }}')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-eye option-icon"></i> {{ __('visibile') }}
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                                <li>
                                                                    @if($post->status==1)
                                                                        <a href="javascript:void(0)"
                                                                           onclick="remove_post_form('index','status','{{ $post->id }}')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fas fa-times option-icon"></i></i>{{ __('unpublish') }}
                                                                        </a>

                                                                    @else
                                                                        <a href="javascript:void(0)"
                                                                           onclick="add_post_to('status','{{ $post->id }}')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-check option-icon"></i> {{ __('publish') }}
                                                                        </a>
                                                                    @endif
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
                                        <h2>{{ __('Showing') }} {{ $posts->firstItem()}} {{  __('to') }} {{ $posts->lastItem()}} {{ __('of') }} {{ $posts->total()}} {{ __('entries') }}</h2>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-right">
                                    <div class="table-info-pagination float-right">
                                    {{ $posts->appends(request()->query())->links() }}
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
@section('script')
    <script>
        $(document).ready(function () {

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
                $('#sub_category').val('');
            });


        });
    </script>

@endsection
