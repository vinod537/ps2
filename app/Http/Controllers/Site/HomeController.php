<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Ads\Entities\AdLocation;
use Modules\Ads\Entities\Ads;
use Modules\Appearance\Entities\ThemeSection;
use Modules\Appearance\Entities\Youtube;
use Modules\Post\Entities\Post;
use Modules\Appearance\Entities\Slider;

use Illuminate\Http\Request;

use LaravelLocalization;
use App\VisitorTracker;
use App\Newpost;
use Illuminate\Support\Facades\Input;
use Sentinel;
use DB;
use Modules\Post\Entities\Category;

class HomeController extends Controller
{


    public function UpdatePressReleaseByAuto(Request $request)
    {
        if ($request->page) {
           $page = $request->page;
        }else{
            $page = 1;
        }

       $skip = $page * 500;
       $all_posts = Post::limit(500)
       ->skip($skip)
       ->orderBY('id', 'asc')
       ->get();
      
       foreach ($all_posts as $key => $value) {   
            if (str_contains($value->content_old_one, 'href="https://pharmashots.com/press-releases')) {               
                    $htmlString = $value->content_old_one;
                    $htmlDom = new \DOMDocument();
                    @$htmlDom->loadHTML($htmlString);
                    $anchorTags = $htmlDom->getElementsByTagName('a');
                    $extractedAnchors = array();
                    foreach($anchorTags as $anchorTag){
                        $aHref = $anchorTag->getAttribute('href');
                        $aTitle = $anchorTag->getAttribute('title');
                            $extractedAnchors[] = array(
                                'href' => $aHref,
                                'title' => $aTitle
                            );
                    }
                    $extractedAnchors =  end($extractedAnchors);
                    $PressReleaseLink   = $extractedAnchors['href'];
                   
                    //echo "Updated string: " . substr_replace($value->content ,"",-300) . "\n";
                    
                   $str = $value->content_old_one;
                   
                  

                   $str = preg_replace('#^(.*)<a[^>]*?>(.*?)</a>(.*?)#im', '$1$2$3', $str);         
                   $str = str_replace('Click here',"",$str);
                   $str = str_replace('to­ read full press release/ article',"",$str);

                 if (str_contains($str, 'to­ read the full press release/ article')) { 
                   
                    $str = str_replace('to­ read the full press release/ article',"",$str);
                 }
                 if (str_contains($str, 'to read full press release/ article')) { 
                
                    $str = str_replace('to read full press release/ article',"",$str);
                 }
                 if (str_contains($str, 'to­ read the full press release')) { 
                    
                    $str = str_replace('to­ read the full press release',"",$str);
                 }
             
                 if (str_contains($str, 'read full press release/ article')) { 
                    
                    $str = str_replace('read full press release/ article',"",$str);
                 }
                 if (str_contains($str, 'Cclick here')) { 
                    
                    $str = str_replace('Cclick here',"",$str);
                 }
                 if (str_contains($str, '| Ref')) { 
                    
                    $str = str_replace('| Ref',"Ref",$str);
                 }
                 if (str_contains($str, '|Ref')) { 
                    
                    $str = str_replace('|Ref',"Ref",$str);
                 }
             
                 if (str_contains($str, 'read the full press release')) { 
                    
                    $str = str_replace('read the full press release',"",$str);
                 }

                 if (str_contains($str, '&nbsp;to&shy;')) { 
                    
                    $str = str_replace('&nbsp;to&shy;',"",$str);
                 }
                 if (str_contains($str, '  |&nbsp;')) { 
                    
                    $str = str_replace('  |&nbsp;',"",$str);
                 }
                 if (str_contains($str, '&nbsp; |&nbsp;')) { 
                    
                    $str = str_replace('&nbsp; |&nbsp;',"",$str);
                 }

                //  if (str_contains($str, 'to­ 5ttt')) { 
                    
                //     $str = str_replace('to­ 5ttt',"",$str);
                //  }
             
               
             
                  echo $str;
                //  die;

                $dataUpdate['content'] = $str;
                $dataUpdate['press_release_link'] = $PressReleaseLink;
                Post::where('id', $value->id)->update($dataUpdate);

                // echo "fd";
                // dd($value);
               
            }else{
                
                // echo "ddddddd";
                // dd($value);
               
                   $str = $value->content_old_one;
                   

                $dataUpdate['content'] = $str;
                $dataUpdate['press_release_link'] = null;
                Post::where('id', $value->id)->update($dataUpdate);
               
            }
           
            
            
           
       }
       echo "Successfully updated";
    }


    
    public function home()
    {

       $AllscheduledPost =  Post::where('scheduled', 1)->get();

       foreach ($AllscheduledPost as $key => $value) {
            // echo $value->scheduled_date;
            // echo date('Y-m-d h:i:s');
            $scheduled_date  =  strtotime($value->scheduled_date);
            $curdate         =  strtotime(date('Y-m-d h:i:s'));
            if ($scheduled_date <= $curdate) {
                # code...
                $postSave = Post::where('id', $value->id)->first();
                $postSave->visibility = 1;
                $postSave->status = 1;
                $postSave->scheduled = 0;
                $postSave->save();
            }

       }

        $primarySection  = Cache::rememberForever('primarySection', function (){
            return ThemeSection::where('is_primary', 1)->first();
        });


        if (Sentinel::check()):

            if($primarySection->status == 1):

                $primarySectionPosts    = Cache::remember('primarySectionPostsAuth', $seconds = 1200, function () {
                    return Post::with(['category', 'image', 'user'])
                        ->where('visibility', 1)
                        ->where('status', 1)
                        ->where('slider', '!=', 1)
                        ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                        ->orderBY('id', 'desc')
                        ->limit(10)->get();
                });
            else:

                $primarySectionPosts = [];

            endif;

            $sliderPosts      = Cache::remember('sliderPostsAuth', $seconds = 1200, function () {
                return  Post::with(['category', 'image', 'user'])
                    ->where('visibility', 1)
                    ->where('slider', 1)
                    ->where('status', 1)
                    ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                    ->orderBY('id', 'desc')
                    ->limit(5)->get();
            });

          


            // $categories = Category::with('Image')
            //         ->orderBy('order','ASC')
            //         ->get();

           

            $categorySections       = Cache::remember('categorySectionsAuth', $seconds = 1200, function () {
                return ThemeSection::with('ad')
                    ->with(['category'])
                    ->where('is_primary', '<>', 1)->orderBy('order', 'ASC')
                    ->where(function ($query) {
                        $query->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->orWhere('language', null);
                    })
                    ->get();
            });

            $categorySections->each(function($section){
                $section->load('post');
            });

            $video_posts     = Cache::remember('video_postsAuth', $seconds = 1200, function () {
                return Post::with('category', 'image', 'user')
                    ->where('post_type', 'video')
                    ->where('visibility', 1)
                    ->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                    ->limit(8)
                    ->get();
            });

            $latest_posts       = Cache::remember('latest_postsAuth', $seconds = 1200, function () {
                return Post::with('category', 'image', 'user')
                    ->where('visibility', 1)
                    ->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                    ->limit(6)
                    ->get();
            });

            $totalPostCount     = Cache::remember('totalPostCountAuth', $seconds = 1200, function () {
                return Post::where('visibility', 1)
                    ->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                    ->count();
            });

        else:
            if($primarySection->status == 1):

                $primarySectionPosts    = Cache::remember('primarySectionPosts', $seconds = 1200, function () {
                    return Post::with(['category', 'image', 'user'])
                        ->where('visibility', 1)
                        ->where('status', 1)
                        ->where('slider', '!=', 1)
                        ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                        ->orderBY('id', 'desc')
                        ->when(Sentinel::check() == false, function ($query) {
                            $query->where('auth_required', 0);
                        })
                        ->limit(10)->get();
                });
            else:

                $primarySectionPosts = [];

            endif;

            $sliderPosts  = Cache::remember('sliderPosts', $seconds = 1200, function () {
                return  Post::with(['category', 'image', 'user'])
                    ->where('visibility', 1)
                    ->where('slider', 1)
                    ->where('status', 1)
                    ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                    ->when(Sentinel::check() == false, function ($query) {
                        $query->where('auth_required', 0);
                    })
                    ->orderBY('id', 'desc')
                    ->limit(5)->get();
            });

            $categorySections       = Cache::remember('categorySections', $seconds = 1200, function () {
                return ThemeSection::with('ad')
                    ->with(['category'])
                    ->where('is_primary', '<>', 1)->orderBy('order', 'ASC')
                    ->where(function ($query) {
                        $query->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->orWhere('language', null);
                    })
                    ->get();
            });

            $categorySections->each(function($section){
                $section->load('post');
            });

            $video_posts     = Cache::remember('video_posts', $seconds = 1200, function () {
                return Post::with('category', 'image', 'user')
                    ->where('post_type', 'video')
                    ->where('visibility', 1)
                    ->where('status', 1)
                    ->when(Sentinel::check() == false, function ($query) {
                        $query->where('auth_required', 0);
                    })
                    ->orderBy('id', 'desc')
                    ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                    ->limit(8)
                    ->get();
            });

            $latest_posts       = Cache::remember('latest_posts', $seconds = 1200, function () {
                return Post::with('category', 'image', 'user')
                    ->where('visibility', 1)
                    ->where('status', 1)
                    ->when(Sentinel::check() == false, function ($query) {
                        $query->where('auth_required', 0);
                    })
                    ->orderBy('id', 'desc')
                    ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                    ->limit(6)
                    ->get();
            });

            $totalPostCount     = Cache::remember('totalPostCount', $seconds = 1200, function () {
                return Post::where('visibility', 1)
                    ->where('status', 1)
                    ->when(Sentinel::check() == false, function ($query) {
                        $query->where('auth_required', 0);
                    })
                    ->orderBy('id', 'desc')
                    ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                    ->count();
            });
        endif;


        $slider1   = Slider::with('adImage')
        ->where('type','Slider_1')
        ->where('show_hide','1')
        ->orderBY('order_type', 'asc')
        ->get();

        $slider2            =   Slider::with('adImage')
                ->where('type','Slider_2')
                ->orderBY('id', 'desc')
                ->get();
                
        $slider3 =  Slider::with('adImage')
                ->where('type','Slider_3')
                ->orderBY('id', 'desc')
                ->get();


        $interviewsAds =  AdLocation::with('ad.adImage')
                ->where('status', 1)
                ->where('unique_name','home_page_middle')
                ->orderBY('id', 'desc')
                ->get();

        $interviewsAdsMobile =  AdLocation::with('ad.adImage')
                ->where('status', 1)
                ->where('unique_name','home_page_middle_mobile')
                ->orderBY('id', 'desc')
                ->get();


        $interviewsAds2 =  AdLocation::with('ad.adImage')
                ->where('status', 1)
                ->where('unique_name','home_page_middle2')
                ->orderBY('id', 'desc')
                ->get();

        $interviewsAdsMobile2 =  AdLocation::with('ad.adImage')
                ->where('status', 1)
                ->where('unique_name','home_page_middle_mobile2')
                ->orderBY('id', 'desc')
                ->get();


        $categories =  Category::with('image')
                ->orderBY('order', 'desc')
                ->limit(10)
                ->get();

        $dailynews =  Post::with('category', 'image', 'user')
            ->where('daily_news', 1)
            ->where('status', 1)           
            ->orderBy('id', 'desc')
            ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
            ->limit(6)
            ->get();
       
        $ads_AdLocation =  AdLocation::with('ad.adImage')
            ->where('status', 1)
            ->get()
            ->keyBy('unique_name');


        $youtubevideos =  Youtube::where('status', 1)->limit('2')->get();

        
        // $tracker                 = new VisitorTracker();
        // $tracker->page_type      = \App\Enums\VisitorPageType::HomePage;
        // $tracker->url            = \Request::url();
        // $tracker->source_url     = \url()->previous();
        // $tracker->ip             = \Request()->ip();
        // $tracker->agent_browser  = UserAgentBrowser(\Request()->header('User-Agent'));

        // $tracker->save();

        
        //  dd($categories);


        return view('site.pages.home', compact('dailynews','youtubevideos','ads_AdLocation','categories','interviewsAdsMobile','interviewsAds','interviewsAdsMobile2','interviewsAds2','slider1','slider2','slider3','primarySection','primarySectionPosts', 'categorySections', 'sliderPosts', 'video_posts', 'latest_posts', 'totalPostCount'));
    }
    
    public function appprivacypolicy(){
        return view('site.pages.privacy_policy');
    }
    public function termsconditions(){
        return view('site.pages.terms_conditions');
    }
     public function newbespoke(){
        return view('site.pages.be_spoke');
    }
    public function pharmaapps(){
        return view('site.pages.pharma_apps');
    }
     public function grievanceredressal(){
        return view('site.pages.grievance_redressal');
    }
     public function newsletter(){
        return view('site.pages.news_letter');
    }
    public function newswire(){
        return view('site.pages.news_wire');
    }
}
