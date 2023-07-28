<?php



namespace Modules\Appearance\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Cache;

use Modules\Appearance\Entities\Theme;
use Modules\Appearance\Entities\Youtube;
use Modules\Appearance\Entities\Slider;
use Modules\Appearance\Entities\ThemeSection;

use Validator;

use Modules\Appearance\Enums\ThemeVisivilityStatus;

use Carbon\Carbon;

use Illuminate\Support\Facades\Storage;

use Aws\S3\Exception\S3Exception as S3;

use Modules\Gallery\Entities\Image as galleryImage;

use Modules\User\Entities\User;

use DB;

use Illuminate\Support\Facades\Mail;

use Modules\Post\Entities\Post;

use Sentinel;


use URL;




use Modules\Gallery\Entities\Video;

use Modules\Gallery\Entities\Audio;

use LaravelLocalization;

use Input;
use DateInterval;

use Modules\Ads\Entities\Ad;

class ThemeController extends Controller

{

    public function themes()

    {

        $themes=Theme::where('status', 1)->get();



        return view('appearance::themes',[

            'themes'    => $themes

        ]);

    }


    public function youtube_change_status(Request $request){

        $Youtube             = Youtube::find($request->id);
        if ($request->status == '1') {
            $Youtube->status    = 0;
        }else{
            $Youtube->status    = 1; 
        }
         

        if ($Youtube->save()) {
            return json_encode(['status'=>'success', 'message'=> 'Fetch Successfully']);
        }else{
            return json_encode(['status'=>'error',  'message'=> 'Error']);
        }

    }



    public function ajax_get_video_details(Request $request){

        $video_details = $this->getVideoDetails($request->video_url);

        return json_encode(['status'=>'success', 'data'=> $video_details,  'message'=> 'Fetch Successfully']);

    }


    function getVideoDetails($url)

    {

        $host = explode('.', str_replace('www.', '', strtolower(parse_url($url, PHP_URL_HOST))));

        $host = isset($host[0]) ? $host[0] : $host;


        $youtube_api_key = 'AIzaSyDEv5dDvzr68zx6gwPEpNrPbYydX9Kfs6o';

 

        if ($host == 'vimeo') {

            $video_id = substr(parse_url($url, PHP_URL_PATH), 1);

            $options = array('http' => array(

                'method'  => 'GET',

                'header' => 'Authorization: Bearer '.$vimeo_api_key

            ));

            $context  = stream_context_create($options);

 

            $hash = json_decode(file_get_contents("https://api.vimeo.com/videos/{$video_id}",false, $context));

 

            //header("Content-Type: text/plain");

            return array(

                'provider'          => 'Vimeo',

                'video_id'          => $video_id,

                'title'             => $hash->name,

                'description'       => str_replace(array("<br>", "<br/>", "<br />"), NULL, $hash->description),

                'description_nl2br' => str_replace(array("\n", "\r", "\r\n", "\n\r"), NULL, $hash->description),

                'thumbnail'         => $hash->pictures->sizes[0]->link,

                'video'             => $hash->link,

                'embed_video'       => "https://player.vimeo.com/video/" . $video_id,

                'duration'          =>  gmdate("H:i:s", $hash->duration)

            );

        }elseif ('youtube' || 'youtu') {

            $video_id = $this->get_youtube_video_id($url);

            // file_get_contents isn't working. So, I used curl instead.
            // $hash = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails&id=" . $video_id . "&key=" . $youtube_api_key));

            $url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails&id=' . $video_id . '&key=' . $youtube_api_key;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            
            $hash = json_decode($response);

            if (!$hash) {

                return;

            }

 

           // print_r($hash);

            //header("Content-Type: text/plain");

 
            $duration = new DateInterval($hash->items[0]->contentDetails->duration);

            return array(

                'provider'          => 'YouTube',

                'video_id'          => $video_id,

                'title'             => $hash->items[0]->snippet->title,

                'published_at'      => $hash->items[0]->snippet->publishedAt,

                'description'       => str_replace(array("", "<br/>", "<br />"), NULL, $hash->items[0]->snippet->description),

                'description_nl2br' => str_replace(array("\n", "\r", "\r\n", "\n\r"), NULL, nl2br($hash->items[0]->snippet->description)),

                'thumbnail'         => 'https://i.ytimg.com/vi/'.$hash->items[0]->id.'/hqdefault.jpg',

                'video'             => "https://www.youtube.com/watch?v=" . $hash->items[0]->id,

                'embed_video'       => "https://www.youtube.com/embed/" . $hash->items[0]->id,

                'duration'          => $duration->format('%H:%I:%S'),

            );

        }

    }


    function get_youtube_video_id($embed_url = '') {

        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $embed_url, $match);

        $video_id = $match[1];

        return $video_id;

    }



        public function youtubes()
        {

            $youtubes=Youtube::get();

            return view('appearance::youtubes',[

                'youtubes'    => $youtubes
    
            ]);
    
        }



    public function createyoutube()
    {
        return view('appearance::youtube_create');
    }


    public function edityoutube($id)
    {
        return view('appearance::youtube_edit');
    }




     public function storeyoutube(Request $request){
        Validator::make($request->all(), [
            'video_provider'   => 'required',
            'video_id'   => 'required',
            'video_title'   => 'required',
            'video_url'   => 'required',
            'embed_video'   => 'required',
        ])->validate();        

        $youtubevideo             = new Youtube();
        $youtubevideo->video_provider    = $request->video_provider;
        $youtubevideo->video_id     = $request->video_id;
        $youtubevideo->video_title     = $request->video_title;
        $youtubevideo->published_at     = $request->published_at;
        $youtubevideo->video_description     = $request->video_description;
        $youtubevideo->description_nl2br     = $request->description_nl2br;
        $youtubevideo->video_thumbnail     = $request->video_thumbnail;
        $youtubevideo->video_url     = $request->video_url;
        $youtubevideo->embed_video     = $request->embed_video;
        $youtubevideo->video_duration     = $request->video_duration;
        $youtubevideo->video_link     = $request->video_link;
    
        $youtubevideo->save();

        return redirect()->back()->with('success',__('successfully_added'));

    }



    //   public function updateyoutube(Request $request, $id) {
    //     Validator::make($request->all(), [
    //         'type' => 'required',
    //     ])->validate();

    //     // dd($request);
    //     $slider             = Youtube::find($id);
    //     $slider->type    = $request->type;
    //     $slider->url1     = $request->url1;
    //     $slider->url2     = $request->url2;
    //     $slider->content1     = $request->content1;
    //     $slider->content2     = $request->content2;
    //     $slider->title     = $request->title;
    //     $slider->content     = $request->content;



    //     Validator::make($request->all(), ['image_id' => 'required' ])->validate();
    //     $slider->image_id=$request->image_id;

    //   //  dd($slider);
    //     $slider->save();
    //     return redirect()->back()->with('success',__('successfully_updated'));

    // }


    // sliders  
    // public function sliders() {
    //     $sliders=Slider::with('adImage')->paginate(10);
    //     return view('appearance::index',compact('sliders'));
    // }
    // public function createslider() {
    //     $countImage     = galleryImage::count();
    //     return view('appearance::sliders_create', compact('countImage'));
    // }

    // public function store(Request $request){
    //     Validator::make($request->all(), [
    //         'type'   => 'required',
    //     ])->validate();        

    //     $slider             = new Slider();
    //     $slider->type    = $request->type;
    //     $slider->url1     = $request->url1;
    //     $slider->url2     = $request->url2;
    //     $slider->content1     = $request->content1;
    //     $slider->content2     = $request->content2;
    //     $slider->title     = $request->title;
    //     $slider->content     = $request->content;

    //     Validator::make($request->all(), ['image_id' => 'required' ])->validate();
    //     $slider->image_id=$request->image_id;
    //     $slider->save();



    //     Cache::forget('adLocations');
    //     Cache::forget('categorySections');
    //     Cache::forget('categorySectionsAuth');
    //     Cache::forget('footerWidgets');
    //     Cache::forget('headerWidgets');
    //     Cache::forget('sideWidgets');
    //     Cache::forget('primary_menu');
    //     return redirect()->back()->with('success',__('successfully_added'));

    // }


    // public function edit($id) {
    //     $slider     = Slider::where('id',$id)->with('adImage')->first();
    //     $countImage     = galleryImage::count();
    //     return view('appearance::sliders_edit',compact('slider', 'countImage'));

    // }


    // public function update(Request $request, $id) {
    //     Validator::make($request->all(), [
    //         'type' => 'required',
    //     ])->validate();

    //     // dd($request);
    //     $slider             = Slider::find($id);
    //     $slider->type    = $request->type;
    //     $slider->url1     = $request->url1;
    //     $slider->url2     = $request->url2;
    //     $slider->content1     = $request->content1;
    //     $slider->content2     = $request->content2;
    //     $slider->title     = $request->title;
    //     $slider->content     = $request->content;



    //     Validator::make($request->all(), ['image_id' => 'required' ])->validate();
    //     $slider->image_id=$request->image_id;

    //   //  dd($slider);
    //     $slider->save();



    //     Cache::forget('adLocations');

    //     Cache::forget('categorySections');

    //     Cache::forget('categorySectionsAuth');

    //     Cache::forget('footerWidgets');

    //     Cache::forget('headerWidgets');

    //     Cache::forget('sideWidgets');

    //     Cache::forget('primary_menu');



    //     return redirect()->back()->with('success',__('successfully_updated'));

    // }



    



    public function updateCurrentTheme(Request $request)

    {

        $themes=Theme::all();

        foreach ($themes as $theme) :

            if($theme->id != $request->block_style):

                $theme->currtent=0;

                $theme->save();

            else:

                $theme->currtent=1;

                $theme->save();

            endif;

        endforeach;



        Cache::forget('activeTheme');

        Cache::forget('primarySection');



        return redirect()->back();



    }



    public function updatePrimarySection(Request $request)

    {



        // Validator::make($request->all(), [

        //     'primary_section_style' => 'required'

        // ])->validate();



        $theme = Theme::where('status', 1)->first();



        $data = [

            'theme_id'      => $theme->id,

            'label'         => 'Primary Section',

            'order'         => 1,

            'post_amount'   => 10,

            'section_style' => $request->get('primary_section_style', 'style_1'),

            'is_primary'    => 1,

            'status'        => 1

        ];



        ThemeSection::updateOrCreate([

            'theme_id'      => $theme->id,

            'is_primary'    => 1,

        ], $data);



        Cache::forget('activeTheme');

        Cache::forget('primarySection');



        return redirect()->back()->with('success', __('successfully_updated'));

    }



    public function themeOption()

    {

        $activeTheme = Theme::where('status', 1)->first();



        return view('appearance::theme_option', compact('activeTheme'));

    }



    public function updateThemeOption(Request $request)

    {

        Validator::make($request->all(), [

            'header_style' => 'required',

            'footer_style' => 'required'

        ])->validate();



        $inputs             = $request->except(['_token']);



        $theme              = Theme::where('status', ThemeVisivilityStatus::ACTIVE)->where('name', 'theme_one')->first();



        $theme->options     = $inputs;

        $theme->save();



        Cache::forget('activeTheme');

        Cache::forget('primarySection');



        return redirect()->back()->with('success', __('successfully_updated'));

    }

}

