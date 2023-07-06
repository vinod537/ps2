@php
$headerWidgets = data_get($widgets, \Modules\Widget\Enums\WidgetLocation::HEADER, []);
@endphp



    @include('site.layouts.header.style_6', ['headerWidgets' => $headerWidgets])


<style>

.paragraph ul li span {
    font-style: normal !important;
    display: block !important;
}
</style>

@if(data_get(activeTheme(), 'options.header_style') != 'header_1')
<div class="container minssinglescontct">
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
            @if(isset($errors))
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endif


<style>
.navbar-brand {
	max-width: 275px;
}
	
	.footer-content .sg-socail li a {
	width: 35px;
	height: 35px;
	line-height: 32px;
	display: block;
	text-align: center;
	border-radius: 100%;
	color: #333;
	font-size: 15px;
	border: 1px solid #3d9be140;
	line-height: 26px !important;
	padding-top: 10px;
}
	

</style>
