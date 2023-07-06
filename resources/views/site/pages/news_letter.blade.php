<style>
    .col-md-2asfasf.new_search_on {
	position: absolute !important;
	right: 0px !important;
}
    .col-md-2asfasf .search-form.d__rtt {
	width: 251px;
	margin-top: -34px;
	position: absolute;
	z-index: 9999;
	left: -165px!important;
}
    @media screen and (min-width:320px) and (max-width:767px){
        .col-md-2asfasf.new_search_on {
	margin-right: 116px !important;
	margin-top: -7px !important;
}
        .news__letter_form {
	background: #fff;
	width: 100%!important;
	margin-left: auto;
	margin-right: auto;
	box-shadow: 0 0 2px 2px #0000001c;
	padding: 34px;
}
        .we_policy h2 {
	color: #073c65;
	font-size: 18px!important;
	padding-bottom: 16px;
	padding-top: 16px;
	line-height: 26px;
}
        .we_policy p {
	font-size: 14px;
	line-height: 23px;
	padding-bottom: 10px;
	color: #000;
}
        .we_cookies h2 {
	color: #000;
	font-size: 18px!important;
	padding-bottom: 20px;
}
        .we_policy h3 {
	color: #000;
	padding-bottom: 20px;
	font-size: 18px!important;
}
        .global-list.d-flex {
	margin-left: -114px!important;
}
    }
    
    .forum__group_9.submit_button {
	text-align: center;
	padding-top: 13px;
}
    .sub__09d {
	background: #073c65;
	color: #fff;
	border: 1px solid #073c65;
	padding: 5px 10px;
	border-radius: 5px;
}
    .hdgfd {
	margin-top: -35px !important;
	padding-bottom: 33px !important;
	text-align: center;
}
      
.privacy_policy {
	margin-top: 99px;
	padding-bottom: 50px;
}
 .we_policy h2 {
	color: #073c65;
	font-size: 74px;
	padding-bottom: 30px;
	padding-top: 30px;
	text-transform: uppercase;
	text-align: center;
}
    .we_policy h5 {
	color: #000;
}    
.we_policy h3 {
	color: #000;
	padding-bottom: 20px;
	font-size: 20px;
}  
   .we_policy p {
	font-size: 16px;
	line-height: 30px;
	padding-bottom: 10px;
       color:#444
}
    .we_cookies h2 {
	color: #073c65;
}
    .we_policy h5 {
	color: #000;
	font-weight: 600;
	font-size: 16px;
	padding-bottom: 14px;
	
}
    .we_cookies h2 {
	color: #073c65;
	font-size: 24px;
	padding-bottom: 20px;
}
    .we_cookies p {
	font-size: 16px;
	line-height: 30px;
	padding-bottom: 10px;
       color:#444;
}
    .we_policy.app ol li {
	color: #000;
	
}
    .we_policy.app ul li {
	color: #444;
}
    @media screen and (min-width:1100px) and (max-width:1500px){
        .global-list.d-flex {
	margin-left: -47px!important;
}
        .col-md-2asfasf .search-form.d__rtt {
	left: -39px!important;
}
        .global-list.d-flex {
	margin-left: -40px !important;
}
    }
	
	.news__letter_form {
	background: #fff;
	width: 30%;
	margin-left: auto;
	margin-right: auto;
	box-shadow: 0 0 2px 2px #0000001c;
	padding: 34px;
}
	
	.forum__group_9 input {
	padding: 7px;
	width: 100%;
	visibility: ;
	border: 1px solid #22222240;
	border-radius: 5px;
}
	
	.ch__09 input {
	width: auto;
}
    .forum__group_9.text_email {
	padding-bottom: 16px;
}
    .global-list.d-flex {
	margin-left: -78px!important;
}
    .col-md-2asfasf .search-form.d__rtt {
	width: 251px;
	margin-top: -34px;
	position: absolute;
	z-index: 9999;
	left: -126px;
}
    .search__click_09 {
	/* position: relative; */
	/* z-index: 9999; */
	cursor: pointer;
	margin-right: -47px!important;
}
    .col-md-2asfasf {
	position: absolute;
	right: -17px !important;
	float: right;
	text-align: right;
	top: 13px !important;
	z-index: 99;
}
</style>


@extends('site.layouts.app')
@section('content')

 <section class="privacy_policy">
<div class="container">
   <div class="we_policy">
       <h2> Newsletter</h2>
   
<div class="news__letter_form">
	
	
	<form>
	<div class="forum__group_9 text_email">
		<input type="email" name="email" placeholder="Enter Email Id" />
		
		</div>
		<div class="forum__group_9">
			<div class="ch__09">
		 <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
<label for="vehicle1"> Daily </label>
			</div>
				<div class="ch__09">
			<input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
<label for="vehicle2">Weekly</label>
			</div>
		
		</div>
		
		
			<div class="forum__group_9">
		
				<div class="ch__09">
			<input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
<label for="vehicle2">accept terms and conditions</label>
			</div>
		
		</div>
			<div class="forum__group_9 submit_button">
		
				<button type="submit" name="submit" class="sub__09d"> Subscribe Now</button>
		
		</div>
		
	</form>
	   
	   </div>
    </div>  
    </div>


</section>

@endsection