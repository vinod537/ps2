<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\VisitorTracker;
use Illuminate\Http\Request;
use Modules\Gallery\Entities\Album;
use Modules\Gallery\Entities\GalleryImage;
use Modules\Gallery\Entities\ImageCategory;
use Modules\Social\Entities\SocialMedia;
use Modules\Page\Entities\Page;
use Modules\Post\Entities\Post;
use Validator;
use Modules\Contact\Entities\ContactMessage;
use Modules\Language\Entities\Language;
use Modules\Post\Entities\Category;
use Modules\Post\Entities\RssFeed;
use Modules\Post\Entities\SubCategory;
use DB;
use Sentinel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class PageController extends Controller
{
    public function page( $id )
    {
        try{
            $page               = Page::where('slug', $id)->first();
            $socialMedias       = SocialMedia::where('status', 1)->get();

            // $tracker = new VisitorTracker();
            // $tracker->page_type = \App\Enums\VisitorPageType::PageDetailPage;
            // $tracker->slug = $id;
            // $tracker->url = \Request::url();
            // $tracker->source_url = \url()->previous();
            // $tracker->ip = \Request()->ip();
            // $tracker->date = date('Y-m-d');
            // $tracker->agent_browser = UserAgentBrowser(\Request()->header('User-Agent'));
            // $tracker->save();

            if($page->page_type == 1):
                return view('site.pages.default_page', compact('page'));
            else:
                return view('site.pages.contact_us', compact('page', 'socialMedias'));
            endif;


        }
        catch (\Exception $e){
            return view('site.pages.404');
        }
    }


    
    public function sendMessage( Request $request )
    {
        if( settingHelper('captcha_visibility') == 1):
        	$validator                  = Validator::make($request->all(), [
                'name'                  => 'required',
                'email'                 => 'required',
                'message'               => 'required',
                'g-recaptcha-response'  => 'required'
            ]);
        else:

            // dd($request);

            if ($request->help_you =='Questions and Comments' || $request->help_you =='Partner with us' || $request->help_you =='Corrections/ Suggestion' || $request->help_you =='Write for us') {
                $validator                  = Validator::make($request->all(), [
                    'name'                  => 'required',
                    'email'                 => 'required',
                    'message'               => 'required'
                ]);
            }
            elseif ($request->help_you =='PharmaShots Bespoke') {
                $validator                  = Validator::make($request->all(), [
                    'name'                  => 'required',
                    'email'                 => 'required',
                    'job_title'             => 'required',
                    'phone'                 => 'required',
                    'company_name'          => 'required',
                    'company_type'          => 'required',
                    'area_of_interest'      => 'required',
                    'additional_details'    => 'required'
                ]);
            }
            elseif ($request->help_you =='PharmaShots Bespoke News Wire') {
                $validator                  = Validator::make($request->all(), [
                    'name'                  => 'required',
                    'email'                 => 'required',
                    'job_title'             => 'required',
                    'company_name'          => 'required',
                ]);
            }
            elseif ($request->help_you =='Report any issue') {
                $validator                  = Validator::make($request->all(), [
                    'name'                  => 'required',
                    'email'                 => 'required',
                    'message'               => 'required',                    
                    'issue_appears'         => 'required',
                    'use_browser'           => 'required'
                ]);
            }elseif ($request->help_you =='License PharmShots content') {
                $validator                  = Validator::make($request->all(), [
                    'name'                  => 'required',
                    'email'                 => 'required',
                    'job_title'             => 'required',
                    'company_name'          => 'required',
                    'article_url'           => 'required',
                    'requested_part'  => 'required',
                    'place_of_publication'  => 'required',
                    'format'                => 'required',                   
                    'other_information'     => 'required'
                ]);
            }elseif ($request->help_you =='PS Newswire' || $request->help_you =='Advertise with PharmaShots' || $request->help_you =='Media coverage') {
                $validator                  = Validator::make($request->all(), [
                    'name'                  => 'required',
                    'email'                 => 'required',
                    'message'               => 'required',
                    'job_title'             => 'required',
                    'company_name'          => 'required'
                ]);
            }      
        
          
          
        endif;

        if ($validator->fails()) :
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        endif;

    	 $message                       = new ContactMessage();

    	 $message->name                 = $request->name;
    	 $message->email                = $request->email;
    	 $message->message              = $request->message;
    	 $message->job_title              = $request->job_title;
    	 $message->phone              = $request->phone;
    	 $message->company_name              = $request->company_name;
    	 $message->company_type              = $request->company_type;
    	 $message->page_name              = $request->page_name;
    	 $message->estimated_number              = $request->estimated_number;
    	 $message->area_of_interest              = $request->area_of_interest;
    	 $message->additional_details              = $request->additional_details;
    	 $message->article_url              = $request->article_url;
    	 $message->requested_part                 = $request->requested_part;
    	 $message->requested_part_other              = $request->requested_part_other;
    	 $message->place_of_publication              = $request->place_of_publication;
    	 $message->format              = $request->format;
    	 $message->formate_other              = $request->formate_other;
    	 $message->issue_appears              = $request->issue_appears;
    	 $message->use_browser              = $request->use_browser;
    	 $message->other_information              = $request->other_information;

    	 $message->save();

        

            $to = 'connect@pharmashots.com';
            $subject = 'Enquiry About '.$request->help_you;        
            $from = 'emailtest@pharmashots.com';
            
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            
            // Create email headers
            $headers .= 'From: '.$from."\r\n".
                'Reply-To: '.$from."\r\n" .
                'X-Mailer: PHP/' . phpversion();
            
            // Compose a simple HTML email message
            $message = '<html><body>';
            $message .= '<h1>Hi Admin,</h1>';
            $message .= '<p>Enquiry About '.$request->help_you.'</p>';
            $message .= '<p>name - '.   $request->name.'</p>';
            $message .= '<p>email - '.  $request->email.'</p>';
            $message .= '<p>message - '.$request->message.'</p>';
            $message .= '<p>job_title - '.$request->job_title.'</p>';
            $message .= '<p>phone - '.$request->phone.'</p>';
            $message .= '<p>company_name - '.$request->company_name.'</p>';
            $message .= '<p>company_type - '.$request->company_type.'</p>';
            $message .= '<p>page_name - '.$request->page_name.'</p>';
            $message .= '<p>estimated_number - '.$request->estimated_number.'</p>';
            $message .= '<p>area_of_interest - '.$request->area_of_interest.'</p>';
            $message .= '<p>additional_details - '.$request->additional_details.'</p>';
            $message .= '<p>article_url - '.$request->article_url.'</p>';
            $message .= '<p>requested_part - '.   $request->requested_part.'</p>';
            $message .= '<p>requested_part_other - '.$request->requested_part_other.'</p>';
            $message .= '<p>place_of_publication - '.$request->place_of_publication.'</p>';
            $message .= '<p>format - '.$request->format.'</p>';
            $message .= '<p>formate_other - '.$request->formate_other.'</p>';
            $message .= '<p>issue_appears - '.$request->issue_appears.'</p>';
            $message .= '<p>use_browser - '.$request->use_browser.'</p>';
            $message .= '<p>other_information - '.$request->other_information.'</p>';
            $message .= '</body></html>';
            

            mail($to, $subject, $message, $headers); 

        // sendMailTo('connect@pharmashots.com', $data);


       
    	 return redirect()->back()->with('success', __('successfully_send'));
    }

    public function sendEventMessage( Request $request )
    {
        if( settingHelper('captcha_visibility') == 1):
                $validator                  = Validator::make($request->all(), [
                    'name'                  => 'required',
                    'email'                 => 'required',
                    'message'               => 'required',
                    'g-recaptcha-response'  => 'required'
                ]);
            else:

            // dd($request);

            $validator                  = Validator::make($request->all(), [
                'name'                  => 'required',
                'email'                 => 'required',
                'message'               => 'required',
                'job_title'             => 'required',
                'company_name'          => 'required'
            ]);  
        
          
          
        endif;

        if ($validator->fails()) :
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        endif;



    	 $message                       = new ContactMessage();
    	 $message->name                 = $request->name;
    	 $message->email                = $request->email;
    	 $message->message              = $request->message;
    	 $message->job_title              = $request->job_title;
    	 $message->phone              = $request->phone;
    	 $message->company_name              = $request->company_name;
    	 $message->company_type              = $request->company_type;
    	 $message->page_name              = $request->page_name;
    	 $message->estimated_number              = $request->estimated_number;
    	 $message->area_of_interest              = $request->area_of_interest;
    	 $message->additional_details              = $request->additional_details;
    	 $message->article_url              = $request->article_url;
    	 $message->requested_part                 = $request->requested_part;
    	 $message->requested_part_other              = $request->requested_part_other;
    	 $message->place_of_publication              = $request->place_of_publication;
    	 $message->format              = $request->format;
    	 $message->formate_other              = $request->formate_other;
    	 $message->issue_appears              = $request->issue_appears;
    	 $message->use_browser              = $request->use_browser;
    	 $message->other_information              = $request->other_information;
    	//  $message->save();



      


        $to = 'connect@pharmashots.com';
        $subject = 'Enquiry About Event Message';        
        $from = 'emailtest@pharmashots.com';
        
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // Create email headers
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();
        
        // Compose a simple HTML email message
        $message = '<html><body>';
        $message .= '<h1>Hi Admin,</h1>';
        $message .= '<p>Enquiry Event Message</p>';
        $message .= '<p>name - '.   $request->name.'</p>';
        $message .= '<p>email - '.  $request->email.'</p>';
        $message .= '<p>job title - '.$request->job_title.'</p>';
        $message .= '<p>company name - '.$request->company_name.'</p>';
        $message .= '<p>message - '.$request->message.'</p>';
        $message .= '</body></html>';
        

        mail($to, $subject, $message, $headers);      

    	 return redirect()->back()->with('success', __('successfully_send'));
    }

    public function imageAlbums(){
        $albums = Album::all();
        return view('site.pages.albums', compact('albums'));
    }

    public function imageGallery($slug){
        $album      = Album::where('slug',$slug)->first();

        if ($album != ''):
            $albumImages    = GalleryImage::where('album_id',$album->id)->orderBy('id','desc')->get();
            $tabs           = $album->tabs;
//            dd($tabs);
            return view('site.pages.album_gallery',compact('albumImages','tabs','album'));
        else:
            return view('site.pages.404');
        endif;

    }



    public function feeds(){
        $feeds = Post::where('visibility', 1)
        ->when(Sentinel::check() == false, function ($query) {
            $query->where('auth_required', 0);
        })
        ->where('category_id', 'not like', "%24%")
        ->where('category_id', 'not like', "%21%")
        ->where('category_id', 'not like', "%27%")
        ->where('category_id', 'not like', "%28%")
        ->where('category_id', 'not like', "%29%")
        ->orderBy('updated_at', 'desc')
        ->limit(10)->get(); 


        return response()
        ->view('site.pages.feedsPost', ['feeds' => $feeds])
        ->header('Content-Type', 'application/atom+xml');


        // return view('site.pages.feedsPost',compact('feeds'));
    }

    //function defination to convert array to xml
       public function array_to_xml($array, &$xml_user_info) {
            foreach($array as $key => $value) {
                if(is_array($value)) {
                    if(!is_numeric($key)){
                        $subnode = $xml_user_info->addChild("$key");
                        array_to_xml($value, $subnode);
                    }else{
                        $subnode = $xml_user_info->addChild("item$key");
                        array_to_xml($value, $subnode);
                    }
                }else {
                    $xml_user_info->addChild("$key",htmlspecialchars("$value"));
                }
            }
        }

        


    
    public function feed(){
        $feeds = Post::where('visibility', 1)
                ->when(Sentinel::check() == false, function ($query) {
                    $query->where('auth_required', 0);
                })				
				->orderBy('updated_at', 'desc')
                ->limit(10)->get();      

    return response()->view('site.pages.feedPost', ['feeds' => $feeds])->header('Content-Type', 'application/atom+xml');

        // return view('site.pages.feedPost',compact('feeds'));
    }




//     public function feed($id){
//         $feed = RssFeed::findOrfail($id); 
//         $url = $feed->feed_url;
//         $invalidurl = false;
//         if(@simplexml_load_file($url)){
//             $feeds = simplexml_load_file($url);
// //            dd($feeds);
//         }else{
//             $invalidurl = true;
//             return view('site.pages.404');
//         }
//         return view('site.pages.feed',compact('feeds','invalidurl'));
//     }
}
