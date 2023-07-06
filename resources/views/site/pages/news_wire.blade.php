<style>
    
  textarea#text-message {
    font-size: 14px;
    padding-left: 8px;
    padding-top: 4px;
}  
    
.brespokle_form {
	box-shadow: 0 0 11px 3px #00000014;
	padding: 30px 30px;
	background: #fff;
}
	
	.radio_button ul {
	padding: 0px;
	/* line-height: normal; */
	list-style: none;
}
.brespokle_form input {
	width: 100%;
	color: #000;
	border: 1px solid #06060640;
	font-size: 13px;
	padding: 7px;
	border-radius: 4px;
}
	.brespokle_form select {
	width: 100%;
	background: #fff;
	border: 1px solid #2222222e;
	font-size: 13px;
	padding: 6px;
	border-radius: 4px;
}
	.brespokle_form .col-md-12 {
	margin-bottom: 13px;
}
	.brespokle_form {
	box-shadow: 0 0 11px 3px #00000024;
	padding: 30px 30px;
	border-radius: 5px;
}
	.radio_button input {
	width: auto;
	float: left;
}
	.radio_button label {
	float: left;
	width: auto;
	font-size: 13px;
}
	.radio_button ul li {
	display: ;
	float: left;
	width: 50%;
}
	.radio_button input {
	width: auto;
	float: left;
	/* padding-left: 13px; */
	margin-right: 12px;
}
	.radio_button p {
	font-size: 12px;
	color: #555;
	margin-top: 12px;
	display: inline-block;
}
	.ser {
	font-size: 13px;
	text-transform: uppercase;
	margin-top: 16px;
}
	.radio_button input {
	width: auto;
	float: left;
}
	.we__bespoke p {
	color: #222!important;
	font-size: 13px!important;
	width: 94%!important;
}
	.we__bespoke ul {
	padding: 0px;
	list-style: none;
	
		
}
	
	.we__bespoke ul li {
	color: #222!important;
	font-size: 13px!important;
	font-weight: normal;
	line-height: 19px;
}
	.we__bespoke h2 {
	color: #073c65;
	font-size: 18px;
	padding-bottom: 10px;
	text-decoration: underline;
	padding-top: 18px;
}
    @media screen and (min-width:320px) and (max-width:767px){
      .radio_button ul  input[type="radio"] {
	margin: 5px 0 0 !important;
	margin-top: 1px;
	line-height: normal;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	padding: 0;
}
    }

	.container.minssinglescontct {
    display: none;
}

.bespoke_page {
    margin-top: 0px !important;
    padding-bottom: 50px!important;
    padding-top: 120px!important;
}

p.error {
    width: 35.5rem;
    font-size: 11px;
    margin: 0px;
    color: red;
}

p.error {
    color: red !important;
    width: 100%;
}
	
	.we__bespoke li {
	list-style: disc;
	margin-left: 13px;
}
	
	.we__bespoke ul li {
	color: #222 !important;
	font-size: 14px !important;
	font-weight: normal;
	line-height: 19px;
	margin-bottom: 5px;
}
	.we__bespoke h2 {

	text-decoration: initial;
	
}
	.we__bespoke h2 {
	color: #073c65;
	font-size: 24px;
	padding-bottom: 10px;
	text-decoration: inherit!important;
	padding-top: 18px;
}
	.btn.btnf-primary {
	background: #073c65;
	color: #fff;
	width: 100%;
	margin-top: 10px;
}
	.btn.btnf-primary:hover{
		color: #fff;
	}
</style>
@extends('site.layouts.app')
@section('content')
<section class="bespoke_page" id="top_0">
<div class="container">
	<div class="row">
		<div class="col-md-8">
   <div class="we__bespoke">
   <div class="jhfgj"> <h2 
        style="text-transform: uppercase;
	font-size: 72px;
	color: #073C65 !important;">PharmaShots Newswire</h2></div>
	   

  
       <ul>
 <li>PharmaShots Newswire is trusted news distribution solution curated dedicatedly for Life Science industry</li>
                                <li>Authentic news, reaching to the targeted audience at a very cost-effective price
</li>    
                                <li>Team of experienced life sciences professionals
</li> 
                                     <li>We understand your business and provide the custom press release writing services
</li>
                                <li>More than three years of experience in delivering curated, customized news to our readers. 
</li>  
                                     <li>Reach us for PharmaShots Newswire and custom PR writing service.</li>
       </ul>
<div class="button_newswire">
       <a href="{{url('/')}}/page/contact-us?cont=PS-Newswire">Contact Us</a>
       </div>
       <!--<p>For any enquiries, please write us:<a href="mailto:bespoke@pharmashots.com">bespoke@pharmashots.com</a>   or fill your details
		   <a style="text-decoration: underline;" href="#top_0">here.</a></p>-->
    </div> 
    </div>
		
		<div class="col-md-4">
		 <div class="brespokle_form">
		 @if(session()->has('success'))
			<div class="alert alert-success">
				{{ session()->get('success') }}
			</div>
		@endif
		 <form  method="post" action="{{ route('site.send.message')}}">

@csrf
    <div class="row">
    <div class ="col-md-12">
 
  <input type="text" id="fname"  value="{{old('name')}}" name="name" placeholder="Name">

  <input type="hidden" name="page_name" id="page_name" value="Be Spoke" >
  <input type="hidden" name="help_you" id="help_you" value="PharmaShots Bespoke News Wire" >
	@if($errors->has('name'))
	<p class="error">{{ $errors->first('name') }}</p>
	@endif

</div>
   <!-- <div class ="col-md-12">

  <input type="text" id="fname" name="fname" placeholder="Last Name"></div> -->
      <div class="col-md-12">
<!--<label for="email">Email:</label>-->
  <input type="email" id="email"  value="{{old('email')}}" name="email" placeholder="Email Address">
  @if($errors->has('email'))
																	<p class="error">{{ $errors->first('email') }}</p>
																@endif
</div>
         <div class="col-md-12">
  
  <input type="text" id="jobtitle"  value="{{old('job_title')}}" name="job_title" placeholder="Job Title">
  @if($errors->has('job_title'))
																	<p class="error">{{ $errors->first('job_title') }}</p>
																@endif
</div>
          <div class="col-md-12">

  <input type="text" id="organize_company"  value="{{old('company_name')}}" name="company_name" placeholder="Organization/ Company name">
  @if($errors->has('company_type'))
	<p class="error">{{ $errors->first('company_name') }}</p>
@endif	
</div>
      <div class="col-md-12">

<!--
  <input type="text" id="phone" value="{{old('phone')}}" name="phone" placeholder="Phone">
  @if($errors->has('phone'))
																	<p class="error">{{ $errors->first('phone') }}</p>
																@endif
-->
          
           <textarea id="text-message" name="text-message" rows="4" cols="50" placeholder="Message"></textarea>
</div>
       
           
        <div class="col-md-12">
            <div class="submit_buttond">
			<button type="submit" class="btn btnf-primary">{{ __('submit_now') }}</button>

  <!-- <input class="sub__088" type="submit" value="Submit now"> -->

</div></div>
</div>
</form>
    </div>
		
		</div>
		</div>
    </div>

</section>


@endsection
<style>
	p.error {
    color: red !important;
}
    @media screen and (min-width:320px) and (max-width:767px){
        .jhfgj h2 {
	font-size: 24px !important;
}
       input[type="radio"] {
	margin: 19px 0 1 !important;
	margin-top: 1px\9;
	line-height: normal;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	padding: 0;
}
        .col-md-6.radio_button li {
	margin-right: 0px !important;
}
        .col-md-6.radio_button ul li {
	display: flex !important;
	list-style: none;
}
        .col-md-6.radio_button ul {
	margin-bottom: 0px;  
	margin-left: -115px !important;  
}
        .col-md-6.radio_button li label {
	font-size: 12px;
	margin-left: -90px!important;
	margin-top: 11px!important;
}
        .global-list.d-flex {
	margin-left: -116px!important;
}
        .submit_button {
	width: 46%!important;
	margin-right: auto;
	margin-left: auto;
	padding-top: 25px;
	font-size: 13px;
}
    }
    
    .global-list.d-flex {
	margin-left: -86px!important;
}
.bespoke_page {
	margin-top: 100px;
	padding-bottom: 50px;
}
    .we__bespoke h2 {
	color: #073c65;
	font-size: 24px;
	padding-bottom: 10px;
}
    .we__bespoke p {
	color: #000;
	font-size: 16px;
}
    .we__bespoke ul li {
	color: #000;
	font-size: 16px;
}
    .we__bespoke h2 {
	color: #073c65;
	font-size: 24px;
	padding-bottom: 10px;
	text-decoration: underline;
	padding-top: 18px;
}
    .brespokle_form select {
	width:100%;
}
    .brespokle_form input {
	width: 100%;
        color: #000;
}
   .brespokle_form label {
	width: 100%;
	color: #000;
}
  .brespokle_form {
	box-shadow: 0 0 11px 3px #00000069;
	padding: 30px 30px;
      margin-top: 75px;
}
   .be_spoke_form {
	padding-bottom: 50px;
	padding-top: 50px;
}
    .col-md-6.radio_button ul li {
	display: inline-block;
	list-style: none;
}
    .col-md-6.radio_button p {
	font-size: 12px;
	color: #000;
	margin-top: 0px !important;
	padding-top:  !important;
}
    .col-md-6.radio_button li label {
	font-size: 12px;
}
    .col-md-6.radio_button li {
	margin-right: 17px;
}
    .submit_button {
	width: 30%;
	margin-right: auto;
	margin-left: auto;
	padding-top: 25px;
}
    .col-md-6 select {
	color: #000;
}
    .submit_button input {
	background: #073c65;
	color: #fff !important;
	padding: 10px 10px;
	border: none;
}
    .col-md-6.radio_button ul {
	margin-bottom: 0px;
}
</style>


<style>
.brespokle_form {
	box-shadow: 0 0 11px 3px #00000014;
	padding: 30px 30px;
	background: #fff;
}
	
	.radio_button ul {
	padding: 0px;
	/* line-height: normal; */
	list-style: none;
}
.brespokle_form input {
	width: 100%;
	color: #000;
	border: 1px solid #06060640;
	font-size: 13px;
	padding: 7px;
	border-radius: 4px;
}
	.brespokle_form select {
	width: 100%;
	background: #fff;
	border: 1px solid #2222222e;
	font-size: 13px;
	padding: 6px;
	border-radius: 4px;
}
	.brespokle_form .col-md-12 {
	margin-bottom: 13px;
}
	.brespokle_form {
	box-shadow: 0 0 11px 3px #00000024;
	padding: 30px 30px;
	border-radius: 5px;
}
	.radio_button input {
	width: auto;
	float: left;
}
	.radio_button label {
	float: left;
	width: auto;
	font-size: 13px;
}
	.radio_button ul li {
	display: ;
	float: left;
	width: 50%;
}
	.radio_button input {
	width: auto;
	float: left;
	/* padding-left: 13px; */
	margin-right: 12px;
}
	.radio_button p {
	font-size: 12px;
	color: #555;
	margin-top: 12px;
	display: inline-block;
}
	.ser {
	font-size: 13px;
	text-transform: uppercase;
	margin-top: 16px;
}
	.radio_button input {
	width: auto;
	float: left;
}
	
	.radio_button label {
	float: left;
	width: auto;
	font-size: 12px;
	margin-left: 5px;
}
	.ser {
	margin-left: 0px !important;
}
	
	.radio_button ul {
	margin-top: 7px;
	display: inline-block;
}
	.submit_button {
	width: 100%;
	margin-right: auto;
	margin-left: auto;
	padding-top: 8px;
	margin-bottom: -20px;
}
    #text-message {
	border-radius: 5px;
	border: 1px solid #00000045;
}
    .button_newswire a {
	background: #073c65;
	padding: 5px 20px;
	border-radius: 5px;
	color: #fff;
}
    .button_newswire {
	text-align: left;
	padding-bottom: 28px;
	margin-top: 11px !important;
	padding-left: 12px;
}
    .we__bespoke ul {
	padding-bottom: 11px;
}
  .button_newswire  a:hover {
	color: #fff;
}
</style>
