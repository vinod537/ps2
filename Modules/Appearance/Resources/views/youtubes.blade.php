@extends('common::layouts.master')
@section('ads-aria-expanded')
    aria-expanded="true"
@endsection
@section('ads-show')
    show
@endsection
@section('youtubes')
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
                                            <h2>{{ __('youtubes') }}</h2>
                                        </div>
                                    </div>
                                    @if(Sentinel::getUser()->hasAccess(['ads_write']))
                                        <div class="col-6 text-right">
                                            <a href="{{ route('create-youtube') }}" class="btn btn-primary btn-sm btn-add-new"><i class="mdi mdi-plus"></i>
                                                {{ __('create_youtube') }}
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
                                        <th>{{ __('title') }}</th>
                                        <th>{{ __('Change status') }}</th>
                                        <th>{{ __('video') }}</th>
                                        <th>{{ __('options') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($youtubes as $youtube)
                                        <tr role="row" id="row_{{ $youtube->id }}" class="odd">
                                            <td class="sorting_1">{{ $youtube->id }}</td>
                                            <td> {{ $youtube->video_title }} </td>

                                            <td>
                                           <div class="statuschange">
                                                <?php 
                                                if($youtube->status == '0'){
                                                    $classes = 'danger';
                                                    $classescontent = 'Pending';
                                                }else{
                                                    $classes = 'success';
                                                    $classescontent = 'Approved';
                                                }
                                                ?>  
                                                <p data-id="{{ $youtube->id }}" data-status="{{$youtube->status}}" class="updatestatus updatestatus{{ $youtube->id }} btn btn-small btn-{{$classes}}">
                                                    {{$classescontent}}
                                                </p>  
                                           </div>
                                            </td>
                                            <td> 
                                        
                                            <iframe width="200" height="200" src="{{ $youtube->embed_video }}" title="LIFE SCIENCES DAILY NEWS OCTOBER 13, 2022" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </td>
                                            
                                            @if(Sentinel::getUser()->hasAccess(['ads_write']) || Sentinel::getUser()->hasAccess(['ads_delete']) )
                                                <td>
                                                  
                                                    @if(Sentinel::getUser()->hasAccess(['ads_delete']))
                                                        <a href="javascript:void(0)" class="btn btn-light active btn-xs"
                                                           onclick="delete_item('youtubes','{{ $youtube->id }}')"><i
                                                                class="fa fa-trash"></i>
                                                            {{ __('delete') }}
                                                        </a>
                                                    @endif

                                                    <p data-id="{{ $youtube->id }}" data-status="{{$youtube->status}}" class="changestatus changestatus{{ $youtube->id }} btn btn-small btn-primary">
                                                        Change Status
                                                    </p> 
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <!-- page info end-->
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script>

$('body').on('click', '.changestatus', function(){

   var dataid =  $(this).data('id')
   var datastatus =  $(this).data('status')

    youtube_change_status(dataid, datastatus)
})


function youtube_change_status(id, status) {
    $.ajax({
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
                    },
            type: "POST",
            url: "{{ route('admin.youtube_change_status') }}",
            data : {id : id,status:status},
            success: function(response){
                response = JSON.parse(response)
                if (response.status == 'success') {   
                    if(status == 1){
                        $('.updatestatus'+id).removeClass('btn-success') 
                        $('.updatestatus'+id).addClass('btn-danger') 
                        $('.updatestatus'+id).text('Pending') 
                        $('.changestatus'+id).data('status', 0) 
                    }else{
                        $('.updatestatus'+id).removeClass('btn-danger') 
                        $('.updatestatus'+id).addClass('btn-success') 
                        $('.updatestatus'+id).text('Approved') 
                        $('.changestatus'+id).data('status', 1) 

                    }
                    
                }else{}  
            }
        });

}





    </script>
@endsection
