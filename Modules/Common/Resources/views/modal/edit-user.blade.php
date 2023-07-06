@php
    $user= Modules\User\Entities\User::find($param[0]);
@endphp

{!!  Form::open(['route' => ['update-user-info',$param[0]], 'method' => 'post','enctype'=>'multipart/form-data']) !!}
    <div class="modal-body">

        <div class="form-group">
            <label for="first_name" class="col-form-label">{{ __('first_name') }}</label>
            <input id="first_name" name="first_name" value="{{ $user->first_name }}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="last_name" class="col-form-label">{{ __('last_name') }}</label>
            <input id="last_name" name="last_name" value="{{ $user->last_name }}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="email" class="col-form-label">{{ __('email') }}</label>
            <input id="email" disabled value="{{ $user->email }}" type="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="phone" class="col-form-label">{{ __('phone') }}</label>
            <input id="phone" name="phone" value="{{ $user->phone }}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="dob" class="col-form-label">{{ __('dob') }}</label>
            <input id="dob" name="dob" value="{{ $user->dob }}" type="date" max="{{ date('Y-m-d') }}" pattern="\d{4}-\d{2}-\d{2}" class="form-control">
        </div>

        <div class="form-group">
            <label for="social_media" class="col-form-label">{{ __('Linkedin') }}</label>
            <input id="social_media" name="social_media" value="{{ $user->social_media }}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="position" class="col-form-label">{{ __('Position') }}</label>
            <input id="position" name="position" value="{{ $user->position }}" type="text" class="form-control">
        </div>


        <div class="form-group">
            <label for="about" class="col-form-label">{{ __('about') }}</label>
            <textarea name="about" class="form-control">{{ $user->about }}</textarea>
        </div>


        <div class="form-group">
            <label for="newsletter" class="col-form-label">{{ __('gender') }}</label>
            <select class="form-control" name="gender" id="gender">
                <option>{{__('select_option')}}</option>
                @foreach (__('genders.genderType') as $value => $item)
                    <option @if($user->gender ==$value) Selected
                            @endif value="{{$value}}">{{$item}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="newsletter" class="col-form-label">{{ __('Status (About Page)') }}</label>
            <select class="form-control" name="status_about" id="status_about">
                <option value="">{{__('select_option')}}</option>
                <option @if($user->status_about =='show') Selected
                    @endif value="show">{{__('Show')}}</option>
                <option @if($user->status_about =='hide') Selected
                    @endif value="hide">{{__('Hide')}}</option>
                
            </select>
        </div>

        <div class="form-group">
            <label for="newsletter" class="col-form-label">{{ __('Order (About Page)') }}</label>
            <select class="form-control" name="order_about" id="order_about">
                <option value="">{{__('select_option')}}</option>                
                <option @if($user->order_about =='1') Selected
                    @endif value="1">1</option>
                <option @if($user->order_about =='2') Selected
                    @endif value="2">{{__('2')}}</option>
                <option @if($user->order_about =='3') Selected
                    @endif value="3">{{__('3')}}</option>
                <option @if($user->order_about =='4') Selected
                    @endif value="4">{{__('4')}}</option>
                <option @if($user->order_about =='5') Selected
                    @endif value="5">{{__('5')}}</option>
                <option @if($user->order_about =='6') Selected
                    @endif value="6">{{__('6')}}</option>
                <option @if($user->order_about =='7') Selected
                    @endif value="7">{{__('7')}}</option>
                <option @if($user->order_about =='8') Selected
                    @endif value="8">{{__('8')}}</option>
                <option @if($user->order_about =='9') Selected
                    @endif value="9">{{__('9')}}</option>
            </select>
        </div>


        <div class="form-group">
            <label for="newsletter" class="col-form-label">{{ __('newsletter') }}</label>
            <select name="newsletter_enable" class="form-control">
                <option value="0" @if($user->newsletter_enable==0) selected @endif>{{ __('disable') }}</option>
                <option value="1" @if($user->newsletter_enable==1) selected @endif>{{ __('enable') }}</option>
            </select>
        </div>

        <div class="form-group">
            <label for="profile_image" class="upload-file-btn btn btn-primary"><i
                    class="fa fa-folder input-file"
                    aria-hidden="true"></i> {{ __('select_image')}}</label>
            <input id="profile_image" name="profile_image" onChange="swapImage(this)" data-index="0"
                   type="file" class="form-control d-none" accept="image/*">
        </div>
        <div class="form-group text-center">
            @if(profile_exist($user->profile_image) && $user->profile_image!=null)
                <img src="{{static_asset($user->profile_image)}}" data-index="0"
                     height="200" width="200" alt="img">
            @else
                <img src="{{static_asset('default-image/user.jpg') }}" height="200" width="200" data-index="0" alt="user" class="img-responsive ">
            @endif
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="m-r-10 fas fa-window-close"></i>{{ __('close') }}</button>
        <button type="submit" class="btn btn-primary"><i class="m-r-10 mdi mdi-content-save-all"></i>{{ __('save') }}</button>
    </div>
{{ Form::close() }}
