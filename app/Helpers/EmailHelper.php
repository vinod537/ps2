<?php

use Modules\Setting\Entities\EmailTemplate;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Mail;

if (!function_exists('DummyFunction')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function sendMail($user, $code, $emailTemplateName, $password = '')
    {
        $emailTemplate        = EmailTemplate::where('email_group', $emailTemplateName)
                                            ->where('lang', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                                            ->first();
                                            
        if($emailTemplateName       == 'activate_account'):
            $url = url('/') . '/activation/' . $user->email . '/' . $code;
        elseif($emailTemplateName   == 'forgot_password'):
            $url = url('/') . '/reset/' . $user->email . '/' . $code;
        else:
            $url = '';
        endif;

        //$imageUrl= settingHelper('logo');
        $imageUrl     = static_asset(settingHelper('logo'));
        $imageTeg     = "<a href='".url('/')."' target='_blank'><img class='logo-img' src=$imageUrl alt='logo' width='50%'></a>";

        $templateBody = str_replace('{SITE_LOGO}', $imageTeg, $emailTemplate->template_body);
        $templateBody = str_replace('{USERNAME}', $user->first_name, $templateBody);
        $templateBody = str_replace('{SITE_NAME}', settingHelper('application_name'), $templateBody);
        $templateBody = str_replace('{ACTIVATE_URL}', $url, $templateBody);
        $templateBody = str_replace('{USER_EMAIL}', $user->email, $templateBody);
        $templateBody = str_replace('{PASS_KEY_URL}', $url, $templateBody);
        $templateBody = str_replace('{PASSWORD}', $password, $templateBody);
        $templateBody = str_replace('{NEW_PASSWORD}', $password, $templateBody);
        $templateBody = str_replace('{SITE_URL}', url('/'), $templateBody);
        $templateBody = str_replace('{APP_AUTH}', rand(100000,999999), $templateBody);
        $templateBody = str_replace('{SIGNATURE}', settingHelper('signature'), $templateBody);
        try {

            // dd($emailTemplate->subject);
            $subject = $emailTemplate->subject;
            Mail::send('setting::email.email_template', compact('templateBody'), function ($message) use ($user, $subject) {

                $sub = "Forgot Password";
                $message->to($user->email)->subject(__($subject));
                $message->from(settingHelper('mail_address'));
                
            });
            // return "reeee";

            // return redirect()->back()->with('success', __('test_mail_success_message'));
        } catch (\Exception $e) {
            return $e->getMessage();
        
        }
       
        // Mail::send('setting::email.email_template', [
        //     'templateBody' => $templateBody
        // ], function ($message) use ($user, $emailTemplate) {
        //     $message    ->to($user->email);
        //     $message    ->subject($emailTemplate->subject);
        //     $message->from(settingHelper('mail_address'));
        // });
        
    }

    function sendMailTo($email, $data)
    {
        Mail::send('setting::email.email_template', [
            'templateBody' => $data->message
        ], function ($message) use ($email, $data) {
            $message    ->to($email);
            $message    ->subject($data->subject);
            $message->from(settingHelper('mail_address'));

        });
    }
}
