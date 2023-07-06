

@extends('site.layouts.app')
@section('content')

<section class="terms_company">
<div class="container">
    <div class="row">
    <div class="col-md-6">
    <div class="l__contents1 newhead_new">
        <h1>PharmaShots App</h1>
        <p><i>Life sciences summarized news on the go!
</i></p>
        
        <p> 
We know that you have a lot to do in a limited time and you can’t go through every news of your interest. We have summarized the news in three shots so that, you can keep yourself informed and focus on your business activities. Pharmashots app is designed for busy life sciences professional who wants news on the go.
</p>
           <div class="mainclasssliderimg">
                                            <ul>
											<li><a href="https://play.google.com/store/apps/details?id=com.pharmashotsapp"> <img src="{{static_asset('site/images/')}}/gp.png"></a></li>
											<li><a href="https://apps.apple.com/in/app/pharma-shots/id1526497705\"> <img src="{{static_asset('site/images/')}}/as.png"></a></li>
                                        
											
											</ul>
                                         </div>
        </div>
    </div>
        <div class="col-md-6">
        <div class="jhjwe">
            <img src="{{static_asset('site/images/Psappimage.png') }} "  >
            
            </div>
        
        </div>
     </div>    </div>
</section>


@endsection
<style>
    .mainclasssliderimg ul li a img {
	width:96% !important;
}
    .mainclasssliderimg {
	margin-top: 45px;
	margin-left: -30px;
}
  .mainclasssliderimg ul li {
	list-style: none;
	float: left;
	width: 30%;
}
.terms_company {
	margin-top: 217px;
	padding-bottom: 158px;
}
    .terms_company h1 {
	color: #073c65;
	font-size: 30px;
	padding-bottom: 30px;
}
    .terms_company p {
	color: #000;
	font-size: 14px;
	line-height: 22px;
}
    .terms_company ol li {
	color: #000;
}
    .terms_company ul li {
	color: #000;
	font-size: 14px;
}
       .global-list.d-flex {
	margin-left: -87px!important;
}
    @media screen and (min-width:360px) and (max-width:800px){
        .terms_company {
	margin-top: 113px!important;
	padding-bottom: 158px;
}
        .l__contents1 {
	padding-top: 0px!important;
}
    }
  @media screen and (min-width:1100px) and (max-width:1500px){
        .global-list.d-flex {
	margin-left: -47px!important;
}
    }
</style>
