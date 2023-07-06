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
                                            <a href="{{ route('create-press-release') }}"
                                            class="btn btn-primary btn-sm btn-add-new"><i class="mdi mdi-plus"></i>
                                                {{ __('Create Press Release') }}
                                            </a>
                                          
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="table-responsive all-pages">
                                <!-- Table Filter -->
                                 <div class="row table-filter-container m-b-20">
                                    <div class="col-sm-12">
                                        {!!  Form::open(['route' => 'filter-post-press','method' => 'GET']) !!}
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
                                        <th>{{ __('Link') }}</th>
                                        {{-- <th>{{ __('category') }}</th> --}}
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
                                            <td>{{ $post->id }}</td>
                                            <td>
                                             <a href="{{ route('event.detail', [$post->slug]) }}">{{ $post->title }} </a></td>
                                            <td class="td-post-type">
                                                <input type="hidden" value="{{ route('event.detail', [$post->slug]) }}" id="Copylink{{$post->id}}">
                                            <button class="btn btn-primary btn-small" onclick="Copylink({{$post->id}})">Copy Link</button>
                                                </td>
                                            {{-- <td>
                                                <label class="category-label m-r-5 label-table"
                                                      id="breaking-post-bgc">
                                                    {{ @$post->category['category_name'] }} </label>

                                            </td> --}}
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
                                                            @if(Sentinel::getUser()->hasAccess(['post_write']))
                                                                <li>
                                                                    <a href="{{ route('edit-press-release',['type'=>$post->post_type,'id'=>$post->id]) }}"><i
                                                                            class="fa fa-edit option-icon"></i>{{ __('edit') }}
                                                                    </a>
                                                                </li>

                                                                {{-- <li>
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
                                                                </li> --}}
                                                                


                                                            @endif
                                                            @if(Sentinel::getUser()->hasAccess(['post_delete']))
                                                                <li>
                                                                    <a href="javascript:void(0)"
                                                                       onclick="delete_item('press_releases','{{ $post->id }}')"><i
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


        function Copylink(id) {
            var copyText = document.getElementById("Copylink"+id);
            copyText.select();           
            navigator.clipboard.writeText(copyText.value);
            alert("Copied the text: " + copyText.value);
            }
    </script>

@endsection
