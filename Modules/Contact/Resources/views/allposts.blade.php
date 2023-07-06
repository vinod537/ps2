@extends('common::layouts.master')

@section('contact_message')
    active
@endsection

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">


    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            <form action="#" method="post">
                <div class="admin-section">
                    <div class="row clearfix m-t-30">
                        <div class="col-12">
                            <div class="navigation-list bg-white p-20">
                              
                                <div class="table-responsive all-pages">
                                    <table id="example" class="display nowrap" style="width:100%">
                                        <thead>
                                            <tr role="row">
                                                <th>#</th>
                                                <th>{{ __('title') }}</th>
                                                <th>{{ __('content') }}</th>
                                                <th>{{ __('tags') }}</th>
                                                <th>{{ __('company_name') }}</th>
                                                <th>{{ __('product') }}</th>
                                                <th>{{ __('category') }}</th>
                                                <th>{{ __('visibility') }}</th>
                                                <th>{{ __('total_hit') }}</th>
                                                <th>{{ __('created_at') }}</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contactMessages as $contactMessage)
                                            
                                                <tr role="row" id="row_{{ $contactMessage->id }}" class="odd">
                                                    <td class="sorting_1">{{ $contactMessage->id }}</td>
                                                    <td>{{ $contactMessage->title }}</td>                                                   
                                                    <td>{{ $contactMessage->content }}</td>                                                   
                                                    <td>{{ $contactMessage->tags }}</td>                                                   
                                                    <td>{{ $contactMessage->product }}</td>                                                   
                                                    <td>{{ $contactMessage->company_name }}</td>                                                   
                                                    <td>
                                                        <?php 
                                                          $category_id =   json_decode($contactMessage->category_id);
                                                          foreach ($category_id as $key => $value) { ?>
                                                              <label class="label label-success label-table">
                                                            {{\Modules\Post\Entities\Category::where('id', $value)->first()->category_name}}
                                                                
                                                                </label>
                                                          <?php }
                                                        ?>
        
                                                    </td>
                                                   
                                                    <td class="td-post-sp">
                                                        @if($contactMessage->visibility==1)
                                                            <label class="label label-success label-table"><i
                                                                    class="fa fa-eye"></i></label>
                                                        @else
                                                            <label class="label label-default label-table"><i
                                                                    class="fa fa-eye-slash"></i></label>
                                                        @endif
                                                        @if($contactMessage->breaking==1)
                                                            <label class="label bg-red label-table">{{ __('breaking') }}</label>
                                                        @endif
                                                        @if($contactMessage->featured==1)
                                                            <label
                                                                class="label bg-warning label-table">{{ __('featured') }}</label>
                                                        @endif
                                                        @if($contactMessage->recommended==1)
                                                            <label
                                                                class="label bg-aqua label-table">{{ __('recommended') }}</label>
                                                        @endif
                                                        @if($contactMessage->editor_picks==1)
                                                            <label
                                                                class="label bg-success label-table">{{ __('editor_picks') }}</label>
                                                        @endif
                                                        @if($contactMessage->slider==1)
                                                            <label class="label bg-teal label-table">{{ __('slider') }}</label>
                                                        @endif
        
                                                        @if($contactMessage->top_20==1)
                                                            <label class="label bg-teal label-table">{{ __('top_20') }}</label>
                                                        @endif
        
                                                        @if($contactMessage->insights_plus==1)
                                                            <label class="label bg-teal label-table">{{ __('insights_plus') }}</label>
                                                        @endif
        
                                                        @if($contactMessage->daily_news==1)
                                                            <label class="label bg-teal label-table">{{ __('daily_news') }}</label>
                                                        @endif
        
                                                        @if($contactMessage->viewpoint==1)
                                                            <label class="label bg-teal label-table">{{ __('viewpoint') }}</label>
                                                        @endif
        
                                                        @if($contactMessage->events==1)
                                                            <label class="label bg-teal label-table">{{ __('events') }}</label>
                                                        @endif
        
                                                        @if($contactMessage->advertisement==1)
                                                            <label class="label bg-teal label-table">{{ __('advertisement') }}</label>
                                                        @endif
                                                    </td>
                                                    <td>{{ $contactMessage->total_hit }}</td>
                                                    <td>{{ $contactMessage->created_at }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- page info end-->
        </div>
    </div>

@endsection


@section('script')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>

@endsection
