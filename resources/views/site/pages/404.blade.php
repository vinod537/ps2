@extends('site.layouts.app')

@section('content')
<div class="container-fluid ">
	<div class="text-center my-5">
		
		<div class="cent_-imgdd">
		
		<img src="https://pharmashots.com/public/pana404.png" />
		</div>
<!--
	    <div class="error mx-auto" data-text="404">{{ __('404') }}</div>
	    <p class="lead text-gray-800 mb-5">{{ __('page_not_found') }}</p>
	    <p class="text-gray-500 mb-0">{{ __('404_message') }} </p>
	   
-->
		 <a style="border: 1px solid #073c654a;
padding: 7px 23px 8px 23px;
border-radius: 80px;" href="{{url('')}}">← {{ __('back_to_home') }}</a>
	 </div>
</div>
<style>
.cent_-imgdd img {
	width: 37%;
}
	
	@media screen and (min-width:320px) and (max-width:767px) {
		
		.cent_-imgdd img {
	width: 73%;
	margin-top: 36px;
}
	}
</style>
@endsection