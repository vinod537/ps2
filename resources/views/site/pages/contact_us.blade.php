@extends('site.layouts.app')



@section('content')

<style>
     .f__contact .fjk a {
	position: relative!important;
	top: 0px!important;
}
    .fjk a {
	position: relative;
	top: 0px !important;
}
    .new_button_submit {
	background: #073C65 !important;
	color: #fff;
	border: #073C65 !important;
	padding: 5px 20px;
	border-radius: 5px;
}
    .new_lst_2 .fa.fa-home.mr-2 {
	position: relative;
	top: 1px!important;
}
    .global-list.new_lst_2 .fa.fa-volume-control-phone.mr-2 {
	position: relative;
	top: 0px!important;
}
    .new_lst_2 li:nth-child(2) {
	margin-bottom: 8px;
}
    #headdf .search__click_09 {
	cursor: pointer;
	margin-right: 31px!important;
}
    .header-bottom {
	padding: 23px 0;
	background-color: transparent;
	padding-bottom: 1px;
	position: absolute;
	width: 100%;
	z-index: 99999;
}
    .paragraph.p-t-20 a {
	color: #000;
	font-weight: 600;
}
    .global-list.d-flex {
	margin-left: -85px!important;
}
    @media screen and (min-width:1100px) and (max-width:1500px){
        .global-list.d-flex.newest {
	margin-left: -35px !important;
}
        .f__contact a {
	color: #444;
	font-size: 12px;
	position: relative!important;
	top: -9px!important;
}
        .footer.footer-style-1 .play_buttons {
	float: left;
	margin-left: -37px;
	margin-top: -41px;
}
        #headdf .search__click_09 {
	cursor: pointer;
	margin-right: 54px !important;
}
        
    }
    .f__contact a {
	color: #444;
	font-size: 12px;
	position: relative!important;
	top: -9px!important;
}
   .footer.footer-style-1 .fa {
	display: inline-block;
	font: normal normal normal 14px/1 FontAwesome;
	font-size: inherit;
	text-rendering: auto;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	position: relative;
	top: -9px;
}
    .sticky-top {
	position: -webkit-sticky;
	position: sticky;
	top: 0;
	z-index: 1020;
}
    label {
	display: inline-block;
	margin-bottom: .5rem;
	font-size: 30px;
	color: #000;
	text-transform: uppercase;
}
    .sticky-top {
	position: -webkit-sticky!important;
	position: sticky!important;
	top:90px!important;
	z-index: 1020!important;
}
    .entry-content.p-4.neww_contactcontent {
	margin-top: -58px;
}
    .section-title {
	margin-bottom: 20px;
	border-bottom: 3px solid var(--primary-color);
	display: none;
}
    #contact-form p {
	color: #000;
	font-size: 14px;
}
    .form-control {
	height: 45px;
	border-radius: 4px;
	padding: 6px 20px;
	margin-bottom: 4px;
	border: 1px solid #d8e2e9;
}
    #requested_part {
	width: 100%;
}
    #format {
	width: 100%;
}
.contact-form label, .ragister-form label {
	color: #000;
	font-size: 14px;
	font-weight: 400;
}
 .form-control {
	height: 37px;
	border-radius: 4px;
	padding: 6px 20px;
	margin-bottom: 4px;
	border: 1px solid #00000069;
}
    #company_type {
	width: 100%;
}
    .btn.btn-primary {
	font-size: 14px;
	color: #fff;
	font-weight: 600;
	padding: 15px 35px;
	letter-spacing: 4px;
	text-transform: uppercase;
	display: inline-block;
	border-radius: 4px;
	position: relative;
	z-index: 1;
	overflow: hidden;
	border-color: #073c65;
	background-color: #073c65 !important;
}
.col-md-12.col-lg-12.sg-sticky {
	margin-top: 40px;
}
   
    .sg-section {
	padding: 15px 15px 1px 15px !important;
}
    .col-md-12.col-lg-12.sg-sticky {
	margin-top: 40px;
	margin-bottom:43px;
}
    .breadcrumb {
	display: none;
}
    .entry-content.p-4 h3 {
	font-size: 60px;
	color: #000;
	text-transform: uppercase;
}
    .sg-post {
	position: relative;
	overflow: hidden;
	margin-bottom: 30px;
	background-color: transparent;
	-webkit-box-shadow: none;
	-moz-box-shadow: 0 6px 12px rgba(0,0,0,.075);
	-ms-box-shadow: 0 6px 12px rgba(0,0,0,.075);
	-o-box-shadow: 0 6px 12px rgba(0,0,0,.075);
	box-shadow:none;
}
.container.minssinglescontct {
    display: none;
}

p.error {
    width: 35.5rem;
    font-size: 11px;
    margin: 0px;
    color: red;
}
    .entry-content.p-4 h3 {
	padding-top: 0px;
	padding-bottom: 32px;
}
    .sg-post.footer-widget {
	background: #fff;
	box-shadow: 0 2px 6px 3px #00000045;
}
    @media screen and (min-width:320px) and (max-width:767px){
          .sticky-top {
	position: -webkit-sticky;
	position: sticky;
	top: 0;
	z-index:9!important;
}
       .entry-content.p-4 h3 {
    font-size: 30px;
    color: #000;
    text-transform: uppercase;
} 
     .mt-5, .my-5 {
    margin-top: 0rem!important;
}   
        .col-md-12.col-lg-12.sg-sticky .sg-section label {
	display: inline-block;
	margin-bottom: -0.5rem;
	font-size: 16px;
	color: #000;
	text-transform: uppercase;
}
        .entry-content.p-4.neww_contactcontent {
	margin-top: 0px;
}
        .col-md-12.col-lg-12.sg-sticky .sg-section label {
	display: inline-block;
	margin-bottom: -0.5rem;
	font-size: 11px;
	color: #000;
	text-transform: uppercase;
	margin-bottom: 3px !important;
}
    }


	p.error {
    color: red !important;
}
</style>

 <div class="sg-page-content">

        <div class="container">

        	@if($page->show_breadcrumb == 1)

        	 <nav aria-label="breadcrumb">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="{{ url('') }}">{{ __('home') }}</a></li>

                        <li class="breadcrumb-item"><a href="#">{!! $page->title ?? '' !!}</a></li>

                    </ol>

                </nav>

                @endif

	            <div class="row">

	            	<div class="{{ $page->template == 2? 'col-md-7 col-lg-8':'col-md-12 col-lg-12'}} sg-sticky">

	            		<div class="row">

<!--
			                <div class="col-md-12 col-lg-12 sg-sticky">

			                    <div class="theiaStickySidebar post-details">

			                        <div class="sg-section">

			                            <div class="section-content">

			                                <div class="sg-post">

			                                    <div class="entry-content p-4">

			                                    	@if($page->show_title == 1)

			                                            <h3>{!! $page->title ?? '' !!}</h3>

			                                        @endif



			                                        <div class="paragraph p-t-20">

			                                            {!! settingHelper('about_us_description') !!} 

													   Please use the form below to send us news topics, stories, comments, critiques,
														advertising inquiries, and requests for corrections. To get in touch with individual team
														members, visit our Team page.
														To submit an article for insight+, please email it to contact@pharmashots.com. We
														really appreciate your feedback.

			                                        </div>

			                                    </div>

			                                </div>

			                            </div>

			                        </div>

			                    </div>

			                </div>
-->

			                <div class="col-md-12 col-lg-12 sg-sticky">

			                	<div class="row">
                                    <div class="{{ $page->template == 2? 'col-md-12':'col-md-6' }}">

			                			<div class="sg-section" style="margin-top: 39px;
background: #fff;
padding: 15px;">

				                            <div class="section-content">
											@if(session('success'))
												<div id="success_m" class="alert alert-success">
													{{session('success')}}
												</div>
											@endif
				                                <div class="section-title">

<!--				                                    <h1>{{ __('Contact Us') }}</h1>-->
													
				                                </div><!-- /.section-title -->
										<?php
																	
												$selects = '';
												if(isset($_GET)){
													if(isset($_GET['cont'])){                                    
														if($_GET['cont'] == 'PharmaShots-Bespoke'){
															$selects = "1";
														}
														if($_GET['cont'] == 'PS-Newswire'){
															$selects = "2";
														}
														if($_GET['cont'] == 'Advertise-with-PharmaShots'){
															$selects = "3";
														}
													}
												}
                                                
                                                ?>
												<div class="col-lg-12">
													<div class="form-group">
														<label for="one">{{ __('How can we help you?') }} *</label>
														<select name="help_you_change" id="help_you_change" class="form-control" >
															<option value="">Please Select</option>
															<option @if(old('help_you') == 'Questions and Comments') {{__('selected')}} @endif value="Questions and Comments">Questions and Comments</option>
															<option @if(old('help_you') == 'Corrections/ Suggestion') {{__('selected')}} @endif value="Corrections/ Suggestion">Corrections/ Suggestion</option>
															<option @if(old('help_you') == 'Write for us') {{__('selected')}} @endif value="Write for us">Write For Us</option>
															<option @if(old('help_you') == 'PharmaShots Bespoke') {{__('selected')}} @endif  @if($selects == '1' ) {{__('selected')}} @endif value="PharmaShots Bespoke">PharmaShots Bespoke</option>
															<option @if(old('help_you') == 'PS Newswire') {{__('selected')}} @endif  @if($selects == '2' ) {{__('selected')}} @endif
                                                               value="PS Newswire">PS Newswire</option>
															<option @if(old('help_you') == 'Advertise with PharmaShots' ) {{__('selected')}} @endif  @if($selects == '3' ) {{__('selected')}} @endif  value="Advertise with PharmaShots">Advertise With PharmaShots</option>
															<option @if(old('help_you') == 'Media coverage') {{__('selected')}} @endif value="Media coverage">Media Coverage</option>
															<option @if(old('help_you') == 'Partner with us') {{__('selected')}} @endif value="Partner with us">Partner With Us</option>
															<option @if(old('help_you') == 'License PharmShots content') {{__('selected')}} @endif value="License PharmShots content">License PharmShots Content</option>
															<option @if(old('help_you') == 'Report any issue') {{__('selected')}} @endif value="Report any issue">Report Any Issue</option>
														</select>
													</div>
												</div>
												<!-- style="display:none;"  -->
												
				                                <form class="contact-form" id="contact-form" name="contact-form" method="post" action="{{ route('site.send.message')}}">

				                                	@csrf

				                                    <div class="row">
				                                        <div class="col-lg-12  allhide" id="input1">
				                                            <div class="form-group">
				                                                <label for="name">{{ __('Name') }} *</label>
				                                                <input type="text" class="form-control" name="name" value="{{old('name')}}" id="name" placeholder="{{__('Name')}}">
				                                                <input type="hidden" class="form-control" name="help_you"  id="help_you" value="{{old('help_you')}}">
																@if($errors->has('name'))
																	<p class="error">{{ $errors->first('name') }}</p>
																@endif
															</div>
				                                        </div>
														<input type="hidden" name="page_name" id="page_name" value="contact" >

				                                        <div class="col-lg-12  allhide"  id="input2">
				                                            <div class="form-group">
				                                                <label for="two">{{ __('email') }} *</label>
				                                                <input type="email" class="form-control" name="email" id="two" placeholder="{{__('Email')}}">
																@if($errors->has('email'))
																	<p class="error">{{ $errors->first('email') }}</p>
																@endif
															</div>
				                                        </div>

				                                       

														<div class="col-lg-12  allhide" id="input4">
				                                            <div class="form-group">
				                                                <label for="job_title">{{ __('job title') }} </label>
				                                                <input type="text" class="form-control" name="job_title" id="job_title" placeholder="{{__('job title')}}">
																@if($errors->has('job_title'))
																	<p class="error">{{ $errors->first('job_title') }}</p>
																@endif
															</div>
				                                        </div>

														<div class="col-lg-12  allhide" id="input5">
				                                            <div class="form-group">
				                                                <label for="phone">{{ __('Phone') }} </label>
				                                                <input type="text" class="form-control" name="phone" id="phone" placeholder="{{__('phone')}}">
																@if($errors->has('phone'))
																	<p class="error">{{ $errors->first('phone') }}</p>
																@endif
															</div>
				                                        </div>
														<div class="col-lg-12  allhide" id="input6">
				                                            <div class="form-group">
				                                                <label for="company_name">{{ __('Organization/ Company name') }} </label>
				                                                <input type="text" class="form-control" name="company_name" id="company_name" placeholder="{{__('Organization/ Company name')}}">
																@if($errors->has('company_type'))
																	<p class="error">{{ $errors->first('company_type') }}</p>
																@endif
															</div>
				                                        </div>
														<div class="col-lg-12  allhide" id="input7">
				                                            <div class="form-group">
				                                                <label for="company_type">{{ __('Organization Type') }} </label>
																<select name="company_type" id="company_type" class="large gfield_select" aria-required="true" aria-invalid="false">
																	<option value="">Select Organization Type</option>
																	<option value="Academic Institution">Academic Institution</option>
																	<option value="Communications/Media Agency">Communications/Media Agency</option>
																	<option value="Consulting Services">Consulting Services</option>
																	<option value="Financial Services/VC Investment">Financial Services/VC Investment</option>
																	<option value="Government">Government</option>
																	<option value="Hospital">Hospital</option>
																	<option value="Insurance">Insurance</option>
																	<option value="Journalism/Press">Journalism/Press</option>
																	<option value="Legal Services">Legal Services</option>
																	<option value="Non-profit">Non-profit</option>
																	<option value="Pharmaceutical/Biotech">Pharmaceutical/Biotech</option>
																	<option value="Professional Association">Professional Association</option>
																	<option value="Other">Other</option>
																</select>				                                            
																@if($errors->has('company_type'))
																	<p class="error">{{ $errors->first('company_type') }}</p>
																@endif
															</div>
				                                        </div>

														<div class="col-lg-12  allhide" id="input8">
				                                            <div class="form-group">
				                                                <label for="Individual1">{{ __('Estimated number of subscriber') }} </label>
																
																<input type="radio" id="Individual" name="estimated_number" value="Individual">
																<label for="Individual">Individual</label><br>
																<input type="radio" id="team_of_5" name="estimated_number" value="Team of 5">
																<label for="team_of_5">Team of 5</label><br>
																<input type="radio" id="team_of_10" name="estimated_number" value="Team of 10">
																<label for="team_of_10">Team of 10</label><br>
																<input type="radio" id="team_of_50" name="estimated_number" value="Team of 50">
																<label for="team_of_50">Team of 50</label><br>
																<input type="radio" id="50_plus" name="estimated_number" value="50 Plus">
																<label for="50_plus">50+</label><br>
																<input type="radio" id="not_sure" name="estimated_number" value="Not Sure">
																<label for="not_sure">Not Sure</label><br>
																
																<p>Please select the option that you think best fits your needs. It&#39;s ok if you&#39;re not sure at the moment!</p>
																@if($errors->has('estimated_number'))
																	<p class="error">{{ $errors->first('estimated_number') }}</p>
																@endif
															</div>
				                                        </div>

														<div class="col-lg-12  allhide" id="input9">
				                                            <div class="form-group">
				                                                <label for="area_of_interest">{{ __('Indication or Therapy Area of interest') }} </label>
				                                                <input type="text" class="form-control" name="area_of_interest" id="area_of_interest" placeholder="{{__('Area of interest')}}">
																@if($errors->has('area_of_interest'))
																	<p class="error">{{ $errors->first('area_of_interest') }}</p>
																@endif
															</div>
				                                        </div>
														<div class="col-lg-12  allhide" id="input10">
				                                            <div class="form-group">
				                                                <label for="additional_details">{{ __('Additional Details') }} </label>
				                                                <input type="text" class="form-control" name="additional_details" id="additional_details" placeholder="{{__('Additional Details')}}">
																@if($errors->has('additional_details'))
																	<p class="error">{{ $errors->first('additional_details') }}</p>
																@endif
															</div>
				                                        </div>
														<div class="col-lg-12  allhide" id="input11">
				                                            <div class="form-group">
				                                                <label for="article_url">{{ __('Article URL') }}</label>
				                                                <input type="text" class="form-control" name="article_url" id="article_url" placeholder="{{__('Article URL')}}">
																@if($errors->has('article_url'))
																	<p class="error">{{ $errors->first('article_url') }}</p>
																@endif
															</div>
				                                        </div>

														<div class="col-lg-12  allhide" id="input12">
				                                            <div class="form-group">
				                                                <label for="requested_part">{{ __('Requested Part') }} </label>
																<select name="requested_part" id="requested_part" class="large gfield_select" aria-required="true" aria-invalid="false">
																	<option value="">Select Requested Part</option>
																	<option value="Full article">Full article</option>
																	<option value="Images/ charts">Images/ charts</option>																
																	<option value="Quotes">Quotes</option>																
																	<option value="Others">Others</option>
																</select>				                                            
																@if($errors->has('requested_part'))
																	<p class="error">{{ $errors->first('requested_part') }}</p>
																@endif
															</div>
				                                        </div>

														<div class="col-lg-12  allhide" id="input13">
				                                            <div class="form-group">
				                                                <label for="requested_part_other">{{ __('Other Requested Part') }} </label>
				                                                <input type="text" class="form-control" name="requested_part_other" id="requested_part_other" placeholder="{{__('Other')}}">
				                                            </div>
				                                        </div>

														<div class="col-lg-12  allhide" id="input14">
				                                            <div class="form-group">
				                                                <label for="place_of_publication">{{ __('Place of Publication or Distribution') }} </label>
				                                                <input type="text" class="form-control" name="place_of_publication" id="place_of_publication" placeholder="{{__('Place of Publication')}}">
				                                            	@if($errors->has('place_of_publication'))
																	<p class="error">{{ $errors->first('place_of_publication') }}</p>
																@endif
															</div>
															<p>Book, magazine, newsletter, conference, intranet, etc.</p>
				                                        </div>

														<div class="col-lg-12  allhide" id="input18">
				                                            <div class="form-group">
				                                                <label for="format">{{ __('Format') }} </label>
																<select name="format" id="format" class="large gfield_select" aria-required="true" aria-invalid="false">
																	<option value="">Select Requested Part</option>
																	<option value="Print">Print</option>
																	<option value="Digital">Digital</option>
																	<option value="Print &amp; Digital">Print &amp; Digital</option>
																	<option value="Other">Other</option>															
																</select>				                                            
																@if($errors->has('format'))
																	<p class="error">{{ $errors->first('format') }}</p>
																@endif
															</div>
				                                        </div>


														<div class="col-lg-12  allhide" id="input19">
				                                            <div class="form-group">
				                                                <label for="formate_other">{{ __('Other Format') }} </label>
				                                                <input type="text" class="form-control" name="formate_other" id="formate_other" placeholder="{{__('Other Format')}}">
				                                            	@if($errors->has('formate_other'))
																	<p class="error">{{ $errors->first('formate_other') }}</p>
																@endif
															</div>
				                                        </div>
														
														<div class="col-lg-12  allhide" id="input16">
				                                            <div class="form-group">
				                                                <label for="issue_appears">{{ __('What is the URL of the page where the issue appears?') }} </label>
				                                                <input type="text" class="form-control" name="issue_appears" id="issue_appears" placeholder="{{__('What is the URL of the page where the issue appears?')}}">
				                                            	@if($errors->has('issue_appears'))
																	<p class="error">{{ $errors->first('issue_appears') }}</p>
																@endif
															</div>
				                                        </div>
														<div class="col-lg-12 allhide" id="input17">
				                                            <div class="form-group">
				                                                <label for="use_browser">{{ __('Which browser do you use (Chrome, Firefox, Safari, Internet Explorer, etc.)?') }} </label>
				                                                <input type="text" class="form-control" name="use_browser" id="use_browser" placeholder="{{__('What is the URL of the page where the issue appears?')}}">
																@if($errors->has('use_browser'))
																	<p class="error">{{ $errors->first('use_browser') }}</p>
																@endif
															</div>
				                                        </div>


														<div class="col-lg-12  allhide" id="input15">
				                                            <div class="form-group">
				                                                <label for="other_information">{{ __('Other Information Relevant to your Request') }} </label>
				                                                <input type="text" class="form-control" name="other_information" id="other_information" placeholder="{{__('Other Information Relevant to your Request')}}">
				                                            	@if($errors->has('other_information'))
																	<p class="error">{{ $errors->first('other_information') }}</p>
																@endif
															</div>
				                                        </div>
														

														<div class="col-sm-12  allhide"  id="input3">
				                                            <div class="form-group">
				                                                <label for="four">{{ __('message') }} *</label>
				                                                <textarea name="message" class="form-control" rows="7" id="four" placeholder="{{__('Message')}}"></textarea>
																@if($errors->has('message'))
																	<p class="error">{{ $errors->first('message') }}</p>
																@endif
															</div>
				                                        </div>



				                                    </div>

				                                    <div class="form-group">

				                                        <button type="submit" class="new_button_submit">{{ __('submit_now') }}</button>

				                                    </div>

				                                </form>

				                            </div><!-- /.section-content -->

				                        </div><!-- /.sg-section -->

			                		</div>

	<div class="{{ $page->template == 2? 'col-md-12':'col-md-6' }} mt-5">

			                			<div class="theiaStickySidebar sticky-top">

					                        <div class="sg-section">

					                            <div class="section-content">

					                                <div class="sg-pofst footer-fgwidget">
<div class="entry-content p-4 neww_contactcontent">

			                                    	
			                                            <h3>Contact Us</h3>

			                                        


			                                        <div class="paragraph p-t-20">

			                                            First Floor, B-66, Sector 63 Noida, Uttar Pradesh, INDIA - 201301 <br><br>

													   Please use the form  to send us news topics, stories, comments, critiques,
														advertising inquiries, and requests for corrections. To get in touch with individual team
														members, visit our <a href="https://makemaya-clients.com/pharmashots/page/about-us#our_team">Team page</a>.
														<br><br> To submit an article for insight+, please email it to<a href="mailto:connect@pharmashots.com"> connect@pharmashots.com</a>. <br><br> We
														really appreciate your feedback.

			                                        </div>

			                                    </div>
<!--
					                                    <div class="entry-content p-4">

					                                        <ul class="global-list">

								                                <li><i class="fa fa-home mr-2" aria-hidden="true"></i>{{ settingHelper('address') }}</li>

								                                <li><i class="fa fa-home mr-2" aria-hidden="true"></i>{{ settingHelper('city') }} {{ settingHelper('zip_code') }}</li>

								                                <li><i class="fa fa-volume-control-phone mr-2" aria-hidden="true"></i>{{ settingHelper('phone') }}</li>

								                                <li><i class="fa fa-envelope-o mr-2" aria-hidden="true"></i> <a href="#">{{ settingHelper('email') }}</a></li>

								                            </ul>

					                                    </div>
-->



<!--
								                        <div class="d-flex justify-content-lg-center footer-content">

										                    <div class="sg-socail">

										                        <ul class="global-list d-flex">

										                            @foreach($socialMedias as $socialMedia)

										                                <li><a href="{{$socialMedia->url}}" target="_blank"><i class="{{$socialMedia->icon}}" aria-hidden="true"></i></a></li>

										                            @endforeach



										                        </ul>

										                    </div>

										                </div>
-->

					                                </div>

					                            </div>

					                        </div>

					                    </div>

			                	</div>
			                		
			                	

			                </div>

			            </div>

			        </div>

		        </div>

		        @if($page->template == 2)

                <div class="col-md-5 col-lg-4 sg-sticky">

                    <div class="sg-sidebar theiaStickySidebar">

                        @include('site.partials.right_sidebar_widgets')

                    </div>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>


   
@endsection



@section('script')

<script>

$(document).ready(function(){
	const vl =$("select#help_you_change option").filter(":selected").val();
	change_show_dt(vl)

})

$('#help_you_change').change(function(){
	const vl = this.value;	
	change_show_dt(vl)	
})

function change_show_dt(vl) {
	//alert(vl)
	$('.allhide').hide();
	$('#contact-form').show();
	if(vl == ''){
		$('#contact-form').hide();
	}
	$('#help_you').val(vl)

	if (vl=='Questions and Comments' || vl=='Partner with us'|| vl=='Corrections/ Suggestion' || vl=='Write for us') {
		$('#input1, #input2, #input3').show();
	}


	if (vl=='PharmaShots Bespoke') {
		$('#input1, #input2, #input4, #input5, #input6, #input7, #input8, #input9, #input10').show();
	}

	if (vl=='Report any issue') {
		$('#input1, #input2, #input16, #input17, #input3').show();
	}


	if (vl=='License PharmShots content') {
		$('#input1, #input2, #input4, #input6, #input11, #input12, #input14, #input18, #input15').show();
	}

	if (vl=='PS Newswire' || vl=='Advertise with PharmaShots' || vl=='Media coverage') {
		$('#input1, #input2, #input3, #input4, #input6').show();
	}
}

</script>
	@if(defaultModeCheck() == 'sg-dark')

		<script type="text/javascript">

		    jQuery(function($){

		        $('.g-recaptcha').attr('data-theme', 'dark');

			
		    });

		</script>

	@endif

@endsection

