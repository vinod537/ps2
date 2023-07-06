
<div class="container-fluid  dashboard-content">

        <div class="row">
        
            <!-- ============================================================== -->
            <!-- end total views   -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- total followers   -->
            <!-- ============================================================== -->
            <!-- <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-inline-block">
                            <h5 class="text-muted">{{ __('total_register_users') }}</h5>
                            <h2 class="mb-0"> {{ number_format($data['registeredUsers']->count()) }}</h2>
                        </div>
                        <div class="float-right icon-circle-medium  icon-box-lg  bg-primary-light mt-1">
                            <i class="fa fa-user fa-fw fa-sm text-primary"></i>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- ============================================================== -->
            <!-- end total followers   -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- partnerships   -->
            <!-- ============================================================== -->
           
            <!-- ============================================================== -->
            <!-- end partnerships   -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- total earned   -->
            <!-- ============================================================== -->
            
            <!-- ============================================================== -->
            <!-- end total earned   -->
            <!-- ============================================================== -->
        </div>

        <!-- Visit vs Visitor  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-8 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">{{ __('visit_vs_visitor') }}</h5>
                    <div class="card-body">
                        <canvas id="revenue" width="400" height="150"></canvas>
                    </div>
                    <div class="card-body border-top">
                        <div class="row">
                            <div class="offset-xl-1 col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 p-3">
                                <h4> {{ __('total_unique_visitors') }}({{ date('Y') }}): {{ number_format(8124) }}</h4>
                                <p>{{ __('total_unique_visits') }}({{date('Y')}}): {{ number_format(6555) }}</p>
                            </div>
                            <div class="offset-xl-1 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 p-3">
                                <h2 class="font-weight-normal mb-3"><span>{{number_format(5842)}}</span>                                                    </h2>
                                <div class="mb-0 mt-3 legend-item">
                                    <span class="fa-xs text-primary mr-1 legend-title "><i class="fas fa-fw fa-square-full"></i></span>
                                    <span class="legend-text">{{ __('total_visits') }}</span></div>
                            </div>
                            <div class="offset-xl-1 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 p-3">
                                <h2 class="font-weight-normal mb-3">
                                    <span>{{number_format(5574)}}</span>
                                </h2>
                                <div class="text-muted mb-0 mt-3 legend-item"> <span class="fa-xs text-secondary mr-1 legend-title"><i class="fas fa-fw fa-square-full"></i></span><span class="legend-text">{{ __('total_visitors') }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end reveune  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- total sale  -->
            <!-- ============================================================== -->
           
            <!-- ============================================================== -->
            <!-- end total sale  -->
            <!-- ============================================================== -->
        </div>
        <div class="row">
            <!-- ============================================================== -->
            <!-- top selling products  -->
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="navigation-list bg-white p-20">
                                <div class="add-new-header clearfix m-b-20">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="block-header">
                                                <h2>{{ __('top_hits_post') }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive all-pages">
                                    <table class="table">
                                <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">#</th>
                                    <th class="border-0">{{ __('post') }}</th>
                                    <th class="border-0">{{ __('language') }}</th>
                                    <th class="border-0">{{ __('post_type') }}</th>
                                    <th class="border-0">{{ __('total_visits') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data['posthits'] as $key => $value)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $value->title }} </td>
                                    <td>{{ $value->language }} </td>
                                    <td>{{ $value->post_type }} </td>

                                    <td>{{ $value->total_hit }} </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                                </div>
                                <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="block-header">
                                        <h2>{{ __('Showing') }} {{ $data['posthits']->firstItem()}} {{  __('to') }} {{ $data['posthits']->lastItem()}} {{ __('of') }} {{ $data['posthits']->total()}} {{ __('entries') }}</h2>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-right">
                                    <div class="table-info-pagination float-right">
                                        {!! $data['posthits']->render() !!}

                                    </div>
                                </div>
                            </div>
                            </div>
            </div>
            <!-- ============================================================== -->
            <!-- end top selling products  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- revenue locations  -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- end revenue locations  -->
            <!-- ============================================================== -->
        </div>

    </div>
