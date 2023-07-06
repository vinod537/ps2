@extends('site.layouts.app') 
@section('content')
<style>
.account-content {
	margin-top: 113px;
	margin-bottom: 92px;
}
	.account-content button {
	width: 100%;
	font-size: 14px;
	font-weight: 600;
	height: 45px;
	color: #fff;
	margin-bottom: 20px;
	border-radius: 4px;
	text-transform: uppercase;
	background-color: rgb(85, 65, 206);
	border: 1px solid rgb(85, 65, 206);
}
    .search__click_09 {
	cursor: pointer;
	margin-right: 36px;
}
    @media screen and (min-width:1100px) and (max-width:1500px){
        .search__click_09 {
	cursor: pointer;
	margin-right: 55px!important;
}
    }
</style>

    <div class="ragister-account text-center">
        <div class="container">
            <div class="account-content">
                <h1>{{ __('login') }}</h1>
                {{-- @include('site.partials.error') --}}
                <form class="ragister-form" name="ragister-form" method="post" action="#">
                    @csrf
                    <div class="form-group text-left mb-0">
                        <label>{{ __('email') }}</label>
                        <input name="email" type="email" class="form-control" required="required" placeholder="{{ __('input_email') }}">
                    </div>
                    <div class="form-group text-left mb-0">
                        <label>{{ __('password') }}</label>
                        <input name="password" type="password" class="form-control" required="required" placeholder="***********">
                    </div>
                    @if( settingHelper('captcha_visibility') == 1 )
                        <div class="col-lg-12 text-center mb-4">
                            <div class="row">
                              {!! NoCaptcha::renderJs() !!}
                              {!! NoCaptcha::display() !!}
                          </div>
                        </div>
                    @endif
                    <button type="submit">{{ __('login') }}</button>
                    <div class="middle-content">
                        <p>{{ __('dont_have_an_account') }} <a href="{{ route('site.register.form') }}">{{ __('sign_up') }}</a></p> <a href="{{ route('forget-password') }}">{{__('forgot_password')}}</a>
                    </div>
                </form>
                <div class="widget-social">
                    <ul class="global-list">
                        @if(settingHelper('facebook_visibility') == 1)
                            <li class="facebook login"><a href="{{ url('/login/facebook') }}" style="background:#056ED8"><span style="background:#0061C2"><i class="fa fa-facebook" aria-hidden="true"></i></span>{{ __('login_with_facebook') }}</a></li>  
                        @endif
                        @if(settingHelper('google_visibility') == 1)    
                            <li class="google login"><a href="{{ url('/login/google') }}" style="background:#FF5733"><span style="background:#CD543A"><i class="fa fa-google" aria-hidden="true"></i></span>{{ __('login_with_google') }}</a></li>  
                        @endif
                    </ul>
                </div>
                {{--<!-- /.contact-form -->--}}
            </div>
            {{--<!-- /.account-content -->--}}
        </div>
        {{--<!-- /.container -->--}}
    </div>
    {{--<!-- /.ragister-account -->--}}
@endsection

@section('script')
    @if(defaultModeCheck() == 'sg-dark')
        <script type="text/javascript">
            jQuery(function($){
                $('.g-recaptcha').attr('data-theme', 'dark');
            });
        </script>
    @endif
@endsection
