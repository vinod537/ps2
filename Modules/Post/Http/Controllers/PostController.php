<?php



namespace Modules\Post\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Cache;

use Modules\Language\Entities\Language;
use Modules\Appearance\Entities\Slider;


use Modules\Post\Entities\Category;

use Modules\Post\Entities\QuizQuestion;

use Modules\Post\Entities\SubCategory;

use Validator;

use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;

use DB;

use Illuminate\Support\Facades\Mail;

use Modules\Post\Entities\Post;

use Modules\Post\Entities\Company;
use Modules\Post\Entities\Product;
use Modules\Post\Entities\CompanyProduct;


use Modules\Post\Entities\PreviewPost;
use Modules\Post\Entities\PressRelease;

use Activation;
use Sentinel;

use Carbon\Carbon;

use URL;

use Illuminate\Support\Facades\Storage;

use Aws\S3\Exception\S3Exception as S3;

use Modules\Gallery\Entities\Image as galleryImage;

use Modules\Gallery\Entities\Video;

use Modules\Gallery\Entities\Audio;

use LaravelLocalization;

use Input;
use Illuminate\Database\Eloquent\Relations\MorphMany;


use Modules\Ads\Entities\Ad;



class PostController extends Controller

{

    public function index()

    {

        $search_key = null;
        $to_date = null;
        $from_date = null;
        $category_id = null;

        $categories     = Category::all();
        $activeLang     = Language::where('status', 'active')->orderBy('name', 'ASC')->get();
        $posts          = Post::orderBy('id','desc')->with('image','video','category','subCategory','user')->paginate('15');
        $users          = User::orderBy('id','asc')->with(['withRoles', 'withActivation', 'image'])->where('user_type', 'admin')->paginate('500');

        return view('post::index',compact('users','posts','categories','activeLang','search_key', 'to_date', 'from_date', 'category_id'));

    }

    public function createArticle()
    {
        $categories     = Category::where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->get();
        $subCategories  = SubCategory::all();
        $activeLang     = Language::where('status', 'active')->orderBy('name', 'ASC')->get();
        $countImage     = galleryImage::count();
        $countVideo     = Video::count();
        $users          = User::orderBy('id','asc')->with(['withRoles', 'withActivation', 'image'])->where('user_type', 'admin')->paginate('500');

        return view('post::article_create',compact('users','categories', 'subCategories', 'activeLang', 'countImage', 'countVideo'));
    }
    
    // press release section
    public function press_release()
    {

        $search_key = null;
        $to_date = null;
        $from_date = null;
        $category_id = null;


        $categories     = Category::all();
        $activeLang     = Language::where('status', 'active')->orderBy('name', 'ASC')->get();
        $posts          = PressRelease::orderBy('id','desc')->with('image','video','category','subCategory','user')->paginate('15');
        $users          = User::orderBy('id','asc')->with(['withRoles', 'withActivation', 'image'])->where('user_type', 'admin')->paginate('500');

       return view('post::press_release',compact('users','posts','categories','activeLang','search_key', 'to_date', 'from_date', 'category_id'));
    }

    public function createPressRelease()
    {
        $categories     = Category::where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->get();
        $subCategories  = SubCategory::all();
        $activeLang     = Language::where('status', 'active')->orderBy('name', 'ASC')->get();
        $countImage     = galleryImage::count();
        $countVideo     = Video::count();
        $users          = User::orderBy('id','asc')->with(['withRoles', 'withActivation', 'image'])->where('user_type', 'admin')->paginate('500');

        return view('post::press_release_create',compact('users','categories', 'subCategories', 'activeLang', 'countImage', 'countVideo'));
    }



    
    public function fetchProduct(Request $request)

    {
        $output         = '<option value="">' . __('select_product') . '</option>';

        $select         = $request->get('select');
        $value          = $request->get('value');
        if (is_array($value)) {

            $data   = CompanyProduct::whereIn('company_id', $value)->get();
            
            if ($data && $data != null && $data != NULL && $data != 'null') {
                foreach ($data as $row) {
                    $dataP           = Product::where('id', $row->product_id)->get()->first();  
                    if ($dataP && $dataP != null && $dataP != NULL && $dataP != 'null') {                
                        $output     .= '<option value="' . $dataP->slug . '">' . $dataP->product_name . '</option>';
                    }
                }
            }
        }

        echo $output;
    }


    public function fetchCompany(Request $request)

    {
        $output         = '<option value="">' . __('select_Company') . '</option>';

        $select         = $request->get('select');
        $value          = $request->get('value');
        if (is_array($value)) {
            $data           = CompanyProduct::whereIn('product_id', $value)->get();
            if ($data && $data != null && $data != NULL && $data != 'null') {
                foreach ($data as $row) {
                    $dataP           = Company::where('id', $row->company_id)->get()->first();
                    if ($dataP && $dataP != null && $dataP != NULL && $dataP != 'null') {
                        $output     .= '<option value="' . $dataP->slug . '">' . $dataP->company_name . '</option>';
                    }
                }
            }
        }

        echo $output;
    }

    
    public function saveNewPressRelease(Request $request,$type){
        Validator::make($request->all(), [
            'title'             => 'required|min:2|unique:press_releases',
            'post_contentnews'           => 'required',
            'category_id'       => 'required',
            'slug'              => 'nullable|unique:press_releases',
        ])->validate();


        $post               =   new PressRelease();
        $post->title        =   strip_tags($request->title);

        if ($request->slug != null) :
            $post->slug = $this->make_slug($request->slug);
        else :
            $post->slug = $this->make_slug($request->title);
        endif;



        $post->created_at=Carbon::parse($request->update_date);
        $post->updated_at=Carbon::parse($request->update_date);

        $post->user_id      = $request->user_id;
        // $post->user_id      = Sentinel::getUser()->id;
        $post->content      = $request->post_contentnews;
        $post->visibility   = $request->visibility;
        $post->layout       = $request->layout;
        if(isset($request->featured)):
            $post->featured = 1;
        else :
            $post->featured = 0;
        endif;



        if(isset($request->breaking)):
            $post->breaking = 1;
        else :
            $post->breaking = 0;
        endif;


        if(isset($request->slider)):

            $post->slider   = 1;

        else :

            $post->slider   = 0;

         endif;



        if(isset($request->recommended)):

            $post->recommended  = 1;

        else :

            $post->recommended  = 0;

        endif;



        if(isset($request->editor_picks)):

            $post->editor_picks  = 1;

        else :

            $post->editor_picks  = 0;

        endif;



        if(isset($request->auth_required)):

            $post->auth_required  = 1;

        else :

            $post->auth_required  = 0;

        endif;


        
      
        if(isset($request->top_20)):
            $post->top_20 = 1;
        else :
            $post->top_20 = 0;
        endif;

        if(isset($request->insights_plus)):
            $post->insights_plus = 1;
        else :
            $post->insights_plus = 0;
        endif;

        if(isset($request->daily_news)):
            $post->daily_news = 1;
        else :
            $post->daily_news = 0;
        endif;

        if(isset($request->viewpoint)):
            $post->viewpoint = 1;
        else :
            $post->viewpoint = 0;
        endif;

        if(isset($request->events)):
            $post->events = 1;
        else :
            $post->events = 0;
        endif;

        if(isset($request->advertisement)):
            $post->advertisement = 1;
        else :
            $post->advertisement = 0;
        endif;


        




      

        $post->meta_title       = strip_tags($request->meta_title);

        $post->meta_keywords    = $request->meta_keywords;

        $post->tags             = $request->tags;
        $post->company_name     = $request->company_name;
        $post->product             = $request->product;

        $post->meta_description = strip_tags($request->meta_description);

        $post->language         = $request->language;

        $categoryIDSMain = [];                    
        $excat = $request->category_id;
        // foreach ($excat as $keyCat => $valueCat) {
        //     $categoryIDS1 =  Category::where('category_name', trim($valueCat))->first(); 
        //     if($categoryIDS1){
        //         $categoryIDS      = $categoryIDS1->id; 
        //         $categoryIDS = json_encode($categoryIDS);
        //         array_push($categoryIDSMain, $categoryIDS);

        //     }                        
        // }                        
       
        $categoryIDS = json_encode($excat);


       
        $post->category_id      = $categoryIDS;

        $post->sub_category_id  = $request->sub_category_id;

        $post->image_id         = $request->image_id;

        $post->post_type            = 'article';


        if($request->status == 2) :

            $post->status           = 0;
            $post->scheduled        = 1;
            $post->scheduled_date   = Carbon::parse($request->scheduled_date);

        else :

            $post->status           = $request->status;

        endif;



        if(isset($request->scheduled)):

            $post->scheduled=1;

        endif;



        $post->contents = $request->new_content;
        
        
       
        $post->save();





        Cache::forget('primarySectionPosts');
        Cache::forget('primarySectionPostsAuth');
        Cache::forget('sliderPostsAuth');
        Cache::forget('sliderPosts');

        Cache::forget('sideWidgets');
        Cache::forget('headerWidgets');
        Cache::forget('footerWidgets');

        Cache::forget('categorySections');
        Cache::forget('totalPostCount');
        Cache::forget('latest_posts');


        Cache::forget('breakingNewss');
        Cache::forget('breakingNewssAuth');
        Cache::forget('lastPost');
        Cache::forget('menuDetails');
        Cache::forget('primary_menu');
        return redirect()->back()->with('success',__('successfully_added'));

    }


    public function editPressRelease($type,$id){

        // $activeLang     = Language::where('status', 'active')->orderBy('name', 'ASC')->get();

        $post           = PressRelease::where('id',$id)->first();      

        $categories     = Category::where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->get();
        $subCategories  = SubCategory::all();
        $activeLang     = Language::where('status', 'active')->orderBy('name', 'ASC')->get();
        $countImage     = galleryImage::count();
        $countVideo     = Video::count();
        $users          = User::orderBy('id','asc')->with(['withRoles', 'withActivation', 'image'])->where('user_type', 'admin')->paginate('500');


       


            return view('post::press_release_edit',compact('users','post', 'categories','subCategories','activeLang', 'countImage','countVideo'));


    }

    public function updatePressRelease(Request $request,$type,$id){

        // return $request;
        //dd($request);
        Validator::make($request->all(), [

            'title'             => 'required|min:2',
            'post_contentnews'           => 'required',
            'category_id'       => 'required',

        ])->validate();



        $post           = PressRelease::find($id);

        $post->title    = $request->title;



        if ($request->slug != null) :

            $post->slug = $this->make_slug($request->slug);

        else :

            $post->slug = $this->make_slug($request->title);

        endif;



        $post->content      = $request->post_contentnews;

        $post->visibility   = 1;

        $post->layout       = $request->layout;



        if(isset($request->featured)):

            $post->featured = 1;

        else :

            $post->featured = 0;

        endif;



        if(isset($request->breaking)):

            $post->breaking = 1;

        else :

            $post->breaking = 0;

        endif;



        if(isset($request->slider)):

            $post->slider   = 1;

        else :

            $post->slider   = 0;

         endif;



        if(isset($request->recommended)):

            $post->recommended  = 1;

        else :

            $post->recommended  = 0;

        endif;



        if(isset($request->editor_picks)):

            $post->editor_picks  = 1;

        else :

            $post->editor_picks  = 0;

        endif;



        if(isset($request->auth_required)):

            $post->auth_required=1;



        else :

            $post->auth_required=0;

        endif;


        if(isset($request->top_20)):
            $post->top_20 = 1;
        else :
            $post->top_20 = 0;
        endif;

        if(isset($request->insights_plus)):
            $post->insights_plus = 1;
        else :
            $post->insights_plus = 0;
        endif;
        if(isset($request->daily_news)):
            $post->daily_news = 1;
        else :
            $post->daily_news = 0;
        endif;

        if(isset($request->viewpoint)):
            $post->viewpoint = 1;
        else :
            $post->viewpoint = 0;
        endif;

        if(isset($request->events)):
            $post->events = 1;
        else :
            $post->events = 0;
        endif;

        if(isset($request->advertisement)):
            $post->advertisement = 1;
        else :
            $post->advertisement = 0;
        endif;


        $post->created_at=Carbon::parse($request->update_date);
        $post->updated_at=Carbon::parse($request->update_date);

        $post->user_id      = $request->user_id;

        $post->meta_title       = $request->meta_title;

        $post->meta_keywords    = $request->meta_keywords;

        $post->tags             = $request->tags;
        $post->company_name             = $request->company_name;
        $post->product             = $request->product;

        $post->meta_description = $request->meta_description;

        $post->language         = $request->language;

        $post->category_id      = $request->category_id;

        $post->sub_category_id  = $request->sub_category_id;

        $post->image_id         = $request->image_id;





       


        if(isset($request->scheduled)):

            $post->scheduled=1;

        endif;
                // dd($post);
        $post->save();
        
        $dataUpdate['updated_at'] = Carbon::parse($request->update_date);

        PressRelease::where('id', $id)->update($dataUpdate);


        Cache::forget('primarySectionPosts');

        Cache::forget('primarySectionPostsAuth');

        Cache::forget('sliderPostsAuth');

        Cache::forget('sliderPosts');



        Cache::forget('sideWidgets');

        Cache::forget('headerWidgets');

        Cache::forget('footerWidgets');



        Cache::forget('categorySections');

        Cache::forget('totalPostCount');

        Cache::forget('latest_posts');



        Cache::forget('breakingNewss');

        Cache::forget('breakingNewssAuth');

        Cache::forget('lastPost');

        Cache::forget('menuDetails');

        Cache::forget('primary_menu');



        return redirect()->back()->with('success',__('successfully_updated'));

    }


    


    public function sliders() {
        // echo "test";
        // die;
        $sliders=Slider::with('adImage')->paginate(10);
        return view('post::sliders',compact('sliders'));
    }


    public function createslider() {
        $countImage     = galleryImage::count();
        return view('post::sliders_create', compact('countImage'));
    }

  


    public function edit($id) {
        $slider     = Slider::where('id',$id)->with('adImage')->first();
        $countImage     = galleryImage::count();
        return view('post::sliders_edit',compact('slider', 'countImage'));

    }

    
    public function update(Request $request, $id) {
        Validator::make($request->all(), [
            'type' => 'required',
        ])->validate();

         // dd($request);
        $slider             = Slider::find($id);
        $slider->type    = $request->type;
        $slider->order_type    = $request->order_type;
        $slider->show_hide    = $request->show_hide;
        $slider->url1     = $request->url1;
        $slider->url2     = $request->url2;
        $slider->content1     = $request->content1;
        $slider->content2     = $request->content2;
        $slider->title     = $request->title;
        $slider->content     = $request->content;



        Validator::make($request->all(), ['image_id' => 'required' ])->validate();
        $slider->image_id=$request->image_id;

      //  dd($slider);
        $slider->save();



        Cache::forget('adLocations');

        Cache::forget('categorySections');

        Cache::forget('categorySectionsAuth');

        Cache::forget('footerWidgets');

        Cache::forget('headerWidgets');

        Cache::forget('sideWidgets');

        Cache::forget('primary_menu');



        return redirect()->back()->with('success',__('successfully_updated'));

    }


    public function store(Request $request){
        Validator::make($request->all(), [
            'type'   => 'required',
        ])->validate();        

        //dd($request);
        $slider             = new Slider();
        $slider->type    = $request->type;
        $slider->url1     = $request->url1;
        $slider->url2     = $request->url2;
        $slider->content1     = $request->content1;
        $slider->content2     = $request->content2;
        $slider->title     = $request->title;
        $slider->order_type     = $request->order_type;
        $slider->show_hide     = $request->show_hide;
        $slider->content     = $request->content;

        Validator::make($request->all(), ['image_id' => 'required' ])->validate();
        $slider->image_id=$request->image_id;
        $slider->save();



        Cache::forget('adLocations');
        Cache::forget('categorySections');
        Cache::forget('categorySectionsAuth');
        Cache::forget('footerWidgets');
        Cache::forget('headerWidgets');
        Cache::forget('sideWidgets');
        Cache::forget('primary_menu');
        return redirect()->back()->with('success',__('successfully_added'));

    }


    
    public function saveNewPostpreview(Request $request,$type){

        $validator =  Validator::make($request->all(), [
            'title'             => 'required|min:2|unique:posts',
            'content'           => 'required',
            'language'          => 'required',
            'category_id'       => 'required',
            'update_date'       => 'required',
            'slug'              => 'nullable|unique:posts',
        ],
        
        [
            'update_date.required' => 'Date is required'

        ]);


        if ($validator->fails()) {
            $errs =   view('site.layouts.error_messages', compact('validator'))->render();
            return json_encode(['status'=>'0', 'message'=> $errs]);
        }

        PreviewPost::getQuery()->delete();

        if ($request->slug != null) :
            $slug = $this->make_slug($request->slug);
        else :
            $slug = $this->make_slug($request->title);
        endif;
            
        $getdetails = PreviewPost::where('slug', $slug)->first();
           
        if($getdetails){
            $post  =   PreviewPost::find($getdetails->id);
        }else{
            $post  =   new PreviewPost();
        }

        $post->title        =   $request->title;
        if ($request->slug != null) :
            $post->slug = $slug;
        else :
            $post->slug = $slug;

        endif;

        $post->old_id    = $request->old_id;
        $post->created_at=Carbon::parse($request->update_date);
        $post->updated_at=Carbon::parse($request->update_date);

        $post->user_id      = $request->user_id;

        $post->content      = $request->content;
        $post->press_release_link      = $request->press_release_link;



        $post->visibility   = $request->visibility;



        $post->layout       = $request->layout;





        if(isset($request->featured)):

            $post->featured = 1;

        else :

            $post->featured = 0;

        endif;



        if(isset($request->breaking)):

            $post->breaking = 1;

        else :

            $post->breaking = 0;

        endif;



        if(isset($request->slider)):

            $post->slider   = 1;

        else :

            $post->slider   = 0;

         endif;



        if(isset($request->recommended)):

            $post->recommended  = 1;

        else :

            $post->recommended  = 0;

        endif;



        if(isset($request->editor_picks)):

            $post->editor_picks  = 1;

        else :

            $post->editor_picks  = 0;

        endif;



        if(isset($request->auth_required)):

            $post->auth_required  = 1;

        else :

            $post->auth_required  = 0;

        endif;

        
      
        if(isset($request->top_20)):
            $post->top_20 = 1;
        else :
            $post->top_20 = 0;
        endif;

        if(isset($request->insights_plus)):
            $post->insights_plus = 1;
        else :
            $post->insights_plus = 0;
        endif;

        if(isset($request->daily_news)):
            $post->daily_news = 1;
        else :
            $post->daily_news = 0;
        endif;

        if(isset($request->viewpoint)):
            $post->viewpoint = 1;
        else :
            $post->viewpoint = 0;
        endif;

        if(isset($request->events)):
            $post->events = 1;
        else :
            $post->events = 0;
        endif;

        if(isset($request->advertisement)):
            $post->advertisement = 1;
        else :
            $post->advertisement = 0;
        endif;


        





        $post->meta_title       = $request->meta_title;

        $post->meta_keywords    = $request->meta_keywords;

        $post->tags             = $request->tags;
        $post->company_name             = $request->company_name;
        $post->product             = $request->product;

        $post->meta_description = $request->meta_description;

        $post->language         = $request->language;

        $post->category_id      = json_encode($request->category_id);

        $post->sub_category_id  = $request->sub_category_id;

        $post->image_id         = $request->image_id;

        if($type == 'video'):

            if($request->video_url_type != null){

                Validator::make($request->all(), [

                    'video_thumbnail_id' => 'required'

                ])->validate();

            }

            $post->post_type            = 'video';

            $post->video_id             = $request->video_id;

            $post->video_url_type       = $request->video_url_type;

            $post->video_url            = $request->video_url;

            $post->video_thumbnail_id   = $request->video_thumbnail_id;



        elseif($type == 'audio'):



            Validator::make($request->all(), [

                'audio' => 'required'

            ])->validate();



            $post->post_type            = 'audio';

            $post->audio()->attach($request->audio_id);

        else:

            $post->post_type            = 'article';

        endif;



        if($request->status == 2) :

            $post->status           = 0;

            $post->scheduled        = 1;

            $post->scheduled_date   = Carbon::parse($request->scheduled_date);

        else :

            $post->status           = $request->status;

        endif;



        if(isset($request->scheduled)):

            $post->scheduled=1;

        endif;

        

        $post->contents = $request->new_content;
        
        
        $post->save();



        if($type == 'audio'):

            $post->audio()->attach($request->audio);

        endif;

        $redirectURl = route('article.detail.preview',[$post->id, $post->slug]);
        return json_encode(['status'=>'1', 'url'=> $redirectURl]);




    }



    

    public function ViewPostpreview(Request $request, $slug){

        $getdetails = PreviewPost::where('slug', $slug)->first();
    }


    public function saveNewPost(Request $request,$type){

        

        Validator::make($request->all(), [
            'title'             => 'required|min:2|unique:posts',
            'content'           => 'required',
            'language'          => 'required',
            'category_id'       => 'required',
            // 'slug'              => 'nullable|min:2|unique:posts|regex:/^\S*$/u',
            'slug'              => 'nullable|unique:posts',
        ])->validate();


         
           
        $post  =   new Post();
        $post->title        =   $request->title;
        $post->alt_tag        =   $request->alt_tag;
        if ($request->slug != null) :
            $post->slug = $this->make_slug($request->slug);
        else :

            $post->slug = $this->make_slug($request->title);

        endif;

        $post->old_id    = $request->old_id;
        $post->created_at=Carbon::parse($request->update_date);
        $post->updated_at=Carbon::parse($request->update_date);

        $post->user_id      = $request->user_id;

        $post->content      = $request->content;
        $post->press_release_link      = $request->press_release_link;



        $post->visibility   = $request->visibility;



        $post->layout       = $request->layout;





        if(isset($request->featured)):

            $post->featured = 1;

        else :

            $post->featured = 0;

        endif;



        if(isset($request->breaking)):

            $post->breaking = 1;

        else :

            $post->breaking = 0;

        endif;



        if(isset($request->slider)):

            $post->slider   = 1;

        else :

            $post->slider   = 0;

         endif;



        if(isset($request->recommended)):

            $post->recommended  = 1;

        else :

            $post->recommended  = 0;

        endif;



        if(isset($request->editor_picks)):

            $post->editor_picks  = 1;

        else :

            $post->editor_picks  = 0;

        endif;



        if(isset($request->auth_required)):

            $post->auth_required  = 1;

        else :

            $post->auth_required  = 0;

        endif;

        
      
        if(isset($request->top_20)):
            $post->top_20 = 1;
        else :
            $post->top_20 = 0;
        endif;

        if(isset($request->insights_plus)):
            $post->insights_plus = 1;
        else :
            $post->insights_plus = 0;
        endif;

        if(isset($request->daily_news)):
            $post->daily_news = 1;
        else :
            $post->daily_news = 0;
        endif;

        if(isset($request->viewpoint)):
            $post->viewpoint = 1;
        else :
            $post->viewpoint = 0;
        endif;

        if(isset($request->events)):
            $post->events = 1;
        else :
            $post->events = 0;
        endif;

        if(isset($request->advertisement)):
            $post->advertisement = 1;
        else :
            $post->advertisement = 0;
        endif;


        





        $post->meta_title       = $request->meta_title;

        $post->meta_keywords    = $request->meta_keywords;

        $post->tags             = $request->tags;
        $post->company_name2     = json_encode($request->company_name);
        $post->product2          = json_encode($request->product_name);

        $post->meta_description = $request->meta_description;

        $post->language         = $request->language;

        $post->category_id      = json_encode($request->category_id);

        $post->sub_category_id  = $request->sub_category_id;

        $post->image_id         = $request->image_id;

        if($type == 'video'):

            if($request->video_url_type != null){

                Validator::make($request->all(), [

                    'video_thumbnail_id' => 'required'

                ])->validate();

            }

            $post->post_type            = 'video';

            $post->video_id             = $request->video_id;

            $post->video_url_type       = $request->video_url_type;

            $post->video_url            = $request->video_url;

            $post->video_thumbnail_id   = $request->video_thumbnail_id;



        elseif($type == 'audio'):



            Validator::make($request->all(), [

                'audio' => 'required'

            ])->validate();



            $post->post_type            = 'audio';

            $post->audio()->attach($request->audio_id);

        else:

            $post->post_type            = 'article';

        endif;



        if($request->status == 2) :

            $post->status           = 0;

            $post->scheduled        = 1;

            $post->scheduled_date   = Carbon::parse($request->scheduled_date);

        else :

            $post->status           = $request->status;

        endif;



        if(isset($request->scheduled)):

            $post->scheduled=1;

        endif;

        

        $post->contents = $request->new_content;
        
        
        $post->save();



        if($type == 'audio'):

            $post->audio()->attach($request->audio);

        endif;



        Cache::forget('primarySectionPosts');

        Cache::forget('primarySectionPostsAuth');

        Cache::forget('sliderPostsAuth');

        Cache::forget('sliderPosts');



        Cache::forget('sideWidgets');

        Cache::forget('headerWidgets');

        Cache::forget('footerWidgets');



        Cache::forget('categorySections');

        Cache::forget('totalPostCount');

        Cache::forget('latest_posts');



        Cache::forget('breakingNewss');

        Cache::forget('breakingNewssAuth');

        Cache::forget('lastPost');

        Cache::forget('menuDetails');

        Cache::forget('primary_menu');



        return redirect()->back()->with('success',__('successfully_added'));

    }



    public function fetchCategory(Request $request)

    {

        $select         = $request->get('select');

        $value          = $request->get('value');

        $data           = Category::where('language', $value)->get();

        $output         = '<option value="">' . __('select_category') . '</option>';

        foreach ($data as $row) :

            $output     .= '<option value="' . $row->id . '">' . $row->category_name . '</option>';

        endforeach;



        echo $output;

    }



    public function fetchSubcategory(Request $request)

    {

        $select         = $request->get('select');

        $value          = $request->get('value');

        $data           = SubCategory::where('category_id', $value)->get();

        $output         = '<option value="">' . __('select_sub_category') . '</option>';

        foreach ($data as $row) :

            $output     .= '<option value="' . $row->id . '">' . $row->sub_category_name . '</option>';

        endforeach;



        echo $output;

    }



    public function slider()

    {

         $posts     = Post::orderBy('id','desc')->where('posts.slider',1)->with('image','category','subCategory','user')->paginate('15');



        return view('post::slider_posts',compact('posts'));

    }



    public function featuredPosts(){

         $posts     = Post::orderBy('id','desc')->where('posts.featured',1)->with('image','category','subCategory','user')->paginate('15');



        return view('post::featured_posts',compact('posts'));

    }



    public function breakingPosts(){

         $posts     = Post::orderBy('id','desc')->where('posts.breaking',1)->with('image','category','subCategory','user')->paginate('15');



        return view('post::breaking_posts',compact('posts'));

    }

    public function topPosts(){

         $posts     = Post::orderBy('id','desc')->where('posts.top_20',1)->with('image','category','subCategory','user')->paginate('15');
        return view('post::top_posts',compact('posts'));

    }
    public function insightsPosts(){

         $posts     = Post::orderBy('id','desc')->where('posts.insights_plus',1)->with('image','category','subCategory','user')->paginate('15');
        return view('post::insights_posts',compact('posts'));

    }

    public function dailyPosts(){

         $posts     = Post::orderBy('id','desc')->where('posts.daily_news',1)->with('image','category','subCategory','user')->paginate('15');
        return view('post::daily_posts',compact('posts'));

    }
    public function viewpointPosts(){

         $posts     = Post::orderBy('id','desc')->where('posts.viewpoint',1)->with('image','category','subCategory','user')->paginate('15');
        return view('post::viewpoint_posts',compact('posts'));

    }

    public function eventsPosts(){

         $posts     = Post::orderBy('id','desc')->where('posts.events',1)->with('image','category','subCategory','user')->paginate('15');
        return view('post::events_posts',compact('posts'));

    }
    public function advertisementPosts(){

         $posts     = Post::orderBy('id','desc')->where('posts.advertisement',1)->with('image','category','subCategory','user')->paginate('15');
        return view('post::advertisement_posts',compact('posts'));

    }



    public function recommendedPosts(){

         $posts     = Post::orderBy('id','desc')->where('posts.recommended',1)->with('image','category','subCategory','user')->paginate('15');



        return view('post::recommended_posts',compact('posts'));

    }



    public function editorPicksPosts(){

         $posts     = Post::orderBy('id','desc')->where('posts.editor_picks',1)->with('image','category','subCategory','user')->paginate('15');



        return view('post::editor_picks',compact('posts'));

    }



    public function pendingPosts(){

         $posts     = Post::orderBy('id','desc')->where('posts.status',0)->with('image','category','subCategory','user')->paginate('15');

        return view('post::pending_posts',compact('posts'));

    }



    public function submittedPosts(){

         $posts     = Post::orderBy('id','desc')->where('posts.submitted',1)->with('image','category','subCategory','user')->paginate('15');



        return view('post::submitted_posts',compact('posts'));

    }



    public function editPost($type,$id){

        $activeLang     = Language::where('status', 'active')->orderBy('name', 'ASC')->get();

        $post           = Post::where('id',$id)->with(['image','video','videoThumbnail','category','subCategory'])->first();

        $categories     = Category::where('language',$post->language)->get();

        $ads            = Ad::orderBy('id', 'desc')->get();
        $users          = User::orderBy('id','asc')->with(['withRoles', 'withActivation', 'image'])->where('user_type', 'admin')->paginate('500');



             /*     dd($post->category['id']);*/

        $subCategories  = [];

        if($post->category_id != ""){

            // $subCategories  = SubCategory::where('category_id',$post->category['id'])->get();

        }



        $post_contents = [];

        if(!blank($post->contents)):

            foreach($post->contents as $key=>$content){

                $content_type = array_keys($content);

                //$post_contents[] = $type[0];

                foreach($content as $value){



                    $abc = [];

                    foreach($value as $key => $item){



                        if($key == 'image_id' && $key != ""){
                            $image = galleryImage::find($item);
                            $abc[] = [$key => $item, 'image' => $image];
                        }elseif($key == 'video_thumbnail_id' && $key != ""){

                            $image = galleryImage::find($item);
                            $abc[] = [$key => $item, 'video_thumbnail' => $image];

                        }elseif($key == 'video_id' && $key != ""){
                            $video = Video::find($item);
                            $abc[] = [$key => $item, 'video' => $video];

                        }else{

                            $abc[] = [$key => $item];

                        }

                    }

                    $post_contents[] =[$content_type[0] => $abc];

                }

            }

        endif;



        $countImage  = galleryImage::count();

        $countAudio  = Audio::count();

        $countVideo  = Video::count();





        if($type == 'article') :

            return view('post::article_edit',compact('users','post','categories','subCategories','activeLang', 'countImage','countVideo', 'post_contents', 'ads'));

        elseif($type == 'video'):

            return view('post::video_post_edit',compact('post','categories','subCategories','activeLang', 'countImage', 'countVideo', 'post_contents', 'ads'));

        elseif($type == 'audio'):

            return view('post::audio_post_edit',compact('post','categories','subCategories','activeLang', 'countImage', 'countAudio', 'countVideo', 'post_contents', 'ads'));

        elseif($type == 'trivia-quiz'):

            $post           = Post::where('id',$id)->with(['image','video','videoThumbnail','category','subCategory','quizResults'])->first();

            $quiz_questions = QuizQuestion::with('quizAnswers')->where('post_id', $id)->get();

                //            dd($quiz_questions);

            return view('post::trivia_quiz_edit',compact('post','categories','subCategories','activeLang', 'countImage', 'countAudio', 'countVideo', 'post_contents','quiz_questions'));

        elseif($type == 'personality-quiz'):

            $post           = Post::where('id',$id)->with(['image','video','videoThumbnail','category','subCategory','quizResults'])->first();

            $quiz_questions = QuizQuestion::with('quizAnswers')->where('post_id', $id)->get();

            //            dd($quiz_questions);

            return view('post::personality_quiz_edit',compact('post','categories','subCategories','activeLang', 'countImage', 'countAudio', 'countVideo', 'post_contents','quiz_questions'));



        endif;

    }

    public function updatePost(Request $request,$type,$id){


        // return $request;

        Validator::make($request->all(), [

            'title'             => 'required|min:2',

            'content'           => 'required',

            'language'          => 'required',

            'category_id'       => 'required',

            'slug'              => 'nullable|unique:posts,slug,' . $id,

        ])->validate();



        $post           = Post::find($id);

    //    dd($request);

        $post->title    = $request->title;
        $post->alt_tag    = $request->alt_tag;



        if ($request->slug != null) :

            $post->slug = $this->make_slug($request->slug);

        else :

            $post->slug = $this->make_slug($request->title);

        endif;



        $post->content      = $request->content;
        $post->press_release_link      = $request->press_release_link;

        $post->visibility   = $request->visibility;

        $post->layout       = $request->layout;
       

        $post->old_id    = $request->old_id;
        if(isset($request->featured)):
            $post->featured = 1;
        else :
            $post->featured = 0;
        endif;



        if(isset($request->breaking)):
            $post->breaking = 1;
        else :
            $post->breaking = 0;
        endif;



        if(isset($request->slider)):

            $post->slider   = 1;

        else :

            $post->slider   = 0;

         endif;



        if(isset($request->recommended)):

            $post->recommended  = 1;

        else :

            $post->recommended  = 0;

        endif;



        if(isset($request->editor_picks)):

            $post->editor_picks  = 1;

        else :

            $post->editor_picks  = 0;

        endif;



        if(isset($request->auth_required)):

            $post->auth_required=1;



        else :

            $post->auth_required=0;

        endif;


        if(isset($request->top_20)):
            $post->top_20 = 1;
        else :
            $post->top_20 = 0;
        endif;

        if(isset($request->insights_plus)):
            $post->insights_plus = 1;
        else :
            $post->insights_plus = 0;
        endif;


        $post->daily_news = $request->daily_news;
        $post->viewpoint = $request->viewpoint;
        $post->advertisement = $request->advertisement;


        if(isset($request->events)):
            $post->events = 1;
        else :
            $post->events = 0;
        endif;



       
        $post->user_id      = $request->user_id;

        $post->meta_title       = $request->meta_title;

        $post->meta_keywords    = $request->meta_keywords;

        $post->tags             = $request->tags;

        $post->company_name2     = json_encode($request->company_name);
        $post->product2          = json_encode($request->product_name);


        $post->meta_description = $request->meta_description;

        $post->language         = $request->language;

        $post->category_id      = $request->category_id;

        $post->sub_category_id  = $request->sub_category_id;

        $post->image_id         = $request->image_id;



        if(isset($request->video_id)):

            $post->video_id     = $request->video_id;

        endif;



        if(isset($request->video_url_type)):

            $post->video_url_type    = $request->video_url_type;

        endif;



        if(isset($request->video_url)):

            $post->video_url=$request->video_url;

        endif;

        if(isset($request->video_thumbnail_id)):

            $post->video_thumbnail_id  = $request->video_thumbnail_id;

        endif;



        if($type == 'audio'):
            Validator::make($request->all(), [
                'audio' => 'required'
            ])->validate();

            $post->audio()->detach();
            $post->audio()->attach($request->audio);
        endif;

        if($request->status == 2) :
            $post->status   = 0;
            $post->scheduled= 1;
            $post->scheduled_date=Carbon::parse($request->scheduled_date);

        else :



            $post->status=$request->status;

        endif;



        if(isset($request->scheduled)):

            $post->scheduled=1;

        endif;



        $post->contents = $request->new_content;
        $post->created_at=Carbon::parse($request->update_date);
        $post->updated_at = Carbon::parse($request->update_date);
        
          
        $post->save();

        $dataUpdate['updated_at'] = Carbon::parse($request->update_date);

        Post::where('id', $id)->update($dataUpdate);


        Cache::forget('primarySectionPosts');

        Cache::forget('primarySectionPostsAuth');

        Cache::forget('sliderPostsAuth');

        Cache::forget('sliderPosts');



        Cache::forget('sideWidgets');

        Cache::forget('headerWidgets');

        Cache::forget('footerWidgets');



        Cache::forget('categorySections');

        Cache::forget('totalPostCount');

        Cache::forget('latest_posts');



        Cache::forget('breakingNewss');

        Cache::forget('breakingNewssAuth');

        Cache::forget('lastPost');

        Cache::forget('menuDetails');

        Cache::forget('primary_menu');



        return redirect()->back()->with('success',__('successfully_updated'));

    }



    public function removePostFrom(Request $request){

        $feature        = $request->feature;

        $post           = Post::find($request->post_id);

        $post->$feature = 0;



        Cache::forget('primarySectionPosts');

        Cache::forget('primarySectionPostsAuth');

        Cache::forget('sliderPostsAuth');

        Cache::forget('sliderPosts');



        Cache::forget('sideWidgets');

        Cache::forget('headerWidgets');

        Cache::forget('footerWidgets');



        Cache::forget('categorySections');

        Cache::forget('totalPostCount');

        Cache::forget('latest_posts');



        Cache::forget('breakingNewss');

        Cache::forget('breakingNewssAuth');



        $post->save();



        $data['status']     = "success";

        $data['message']    =  __('successfully_updated');



        echo json_encode($data);



        // return redirect()->back()->with('success',__('successfully_updated'));

    }



    public function addPostTo(Request $request){

        $feature            = $request->feature;

        $post               = Post::find($request->post_id);



        $post->$feature     = 1;



        $post->save();



        Cache::forget('primarySectionPosts');

        Cache::forget('primarySectionPostsAuth');

        Cache::forget('sliderPostsAuth');

        Cache::forget('sliderPosts');



        Cache::forget('sideWidgets');

        Cache::forget('headerWidgets');

        Cache::forget('footerWidgets');



        Cache::forget('categorySections');

        Cache::forget('totalPostCount');

        Cache::forget('latest_posts');



        Cache::forget('breakingNewss');

        Cache::forget('breakingNewssAuth');



        $data['status']     = "success";

        $data['message']    =  __('successfully_updated');



        echo json_encode($data);

    }



    public function updateSliderOrder(Request $request){



        for($i=0;$i<count($request->post_id);$i++):

            $post               =   Post::find($request->post_id[$i]);

            $post->slider_order = $request->order[$i];

            $post->save();

        endfor;



        Cache::forget('sliderPostsAuth');

        Cache::forget('sliderPosts');



        return redirect()->back()->with('success',__('successfully_updated'));

    }

    public function updateFeaturedOrder(Request $request){



        for($i=0;$i<count($request->post_id);$i++):

            $post                   = Post::find($request->post_id[$i]);

            $post->featured_order   = $request->order[$i];

            $post->save();

        endfor;



        return redirect()->back()->with('success',__('successfully_updated'));

    }

    public function updateBreakingOrder(Request $request){



        for($i=0;$i<count($request->post_id);$i++){

            $post                   = Post::find($request->post_id[$i]);

            $post->breaking_order   = $request->order[$i];

            $post->save();

        }



        Cache::forget('breakingNewss');

        Cache::forget('breakingNewssAuth');



        return redirect()->back()->with('success',__('successfully_updated'));

    }

    public function updateRecommendedOrder(Request $request){

        for($i=0;$i<count($request->post_id);$i++){

            $post                   = Post::find($request->post_id[$i]);

            $post->recommended_order= $request->order[$i];

            $post->save();

        }



        return redirect()->back()->with('success',__('successfully_updated'));

    }



    public function updateEditorPicksOrder(Request $request){
        for($i=0;$i<count($request->post_id);$i++):
            $post                   = Post::find($request->post_id[$i]);
            $post->editor_picks_order   = $request->order[$i];
            $post->save();
        endfor;
        return redirect()->back()->with('success',__('successfully_updated'));
    }

    public function updateTopOrder(Request $request){
        for($i=0;$i<count($request->post_id);$i++):
            $post                   = Post::find($request->post_id[$i]);
            $post->top_20   = $request->order[$i];
            $post->save();
        endfor;
        return redirect()->back()->with('success',__('successfully_updated'));
    }

    public function updateInsightsOrder(Request $request){
        for($i=0;$i<count($request->post_id);$i++):
            $post                   = Post::find($request->post_id[$i]);
            $post->insight_plus   = $request->order[$i];
            $post->save();
        endfor;
        return redirect()->back()->with('success',__('successfully_updated'));
    }
    public function updateDailyOrder(Request $request){
        for($i=0;$i<count($request->post_id);$i++):
            $post                   = Post::find($request->post_id[$i]);
            $post->daily_news   = $request->order[$i];
            $post->save();
        endfor;
        return redirect()->back()->with('success',__('successfully_updated'));
    }
    public function updateViewpointOrder(Request $request){
        for($i=0;$i<count($request->post_id);$i++):
            $post                   = Post::find($request->post_id[$i]);
            $post->viewpoint   = $request->order[$i];
            $post->save();
        endfor;
        return redirect()->back()->with('success',__('successfully_updated'));
    }
    public function updateEventsOrder(Request $request){
        for($i=0;$i<count($request->post_id);$i++):
            $post                   = Post::find($request->post_id[$i]);
            $post->events   = $request->order[$i];
            $post->save();
        endfor;
        return redirect()->back()->with('success',__('successfully_updated'));
    }
    public function updateAdvertisementOrder(Request $request){
        for($i=0;$i<count($request->post_id);$i++):
            $post                   = Post::find($request->post_id[$i]);
            $post->advertisement   = $request->order[$i];
            $post->save();
        endfor;
        return redirect()->back()->with('success',__('successfully_updated'));
    }



    public function createVideoPost(){

        $categories         = Category::where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->get();

        $subCategories      = SubCategory::all();

        $activeLang         = Language::where('status', 'active')->orderBy('name', 'ASC')->get();

        $countImage         = galleryImage::count();

        $countVideo         = Video::count();



        return view('post::video_post_create',compact('categories', 'subCategories', 'activeLang', 'countImage', 'countVideo'));

    }



    public function createAudioPost(){

        $categories         = Category::where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->get();

        $subCategories      = SubCategory::all();

        $activeLang         = Language::where('status', 'active')->orderBy('name', 'ASC')->get();

        $countImage         = galleryImage::count();

        $countAudio         = Audio::count();

        $countVideo         = Video::count();



        return view('post::audio_post_create',compact('categories', 'subCategories', 'activeLang', 'countImage', 'countAudio', 'countVideo'));

    }



    public function createTriviaQuiz()

    {

        $categories     = Category::where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->get();

        $subCategories  = SubCategory::all();

        $activeLang     = Language::where('status', 'active')->orderBy('name', 'ASC')->get();

        $countImage     = galleryImage::count();

        $countVideo     = Video::count();



        return view('post::trivia_quiz_create',compact('categories', 'subCategories', 'activeLang', 'countImage', 'countVideo'));

    }



    public function createPersonalityQuiz()

    {

        $categories     = Category::where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->get();

        $subCategories  = SubCategory::all();

        $activeLang     = Language::where('status', 'active')->orderBy('name', 'ASC')->get();

        $countImage     = galleryImage::count();

        $countVideo     = Video::count();



        return view('post::personality_quiz_create',compact('categories', 'subCategories', 'activeLang', 'countImage', 'countVideo'));

    }


    
    public function filterPostPress(Request $request){
        

        $search_key = null;
        $to_date = null;
        $from_date = null;
        $category_id = null;

        if($request->search_key != null && $request->search_key != ''){
            $search_key = $request->search_key;
        }
        if($request->to_date != null){
            $to_date = $request->to_date;
        }
        if($request->from_date != null){
            $from_date = $request->from_date;
        }
        if($request->category_id != null){
            $category_id = $request->category_id;
        }


       
    $categories         = Category::all();
    if($request->category_id == null):
        $subCategories  = [];
    else:
        $subCategories  = SubCategory::where('category_id', $request->category_id)->get();
    endif;
    // return $subCategories;

    //  $start_date = date('Y-m-d 00:00:00', strtotime($request->from_date));
    //  $end_date = date('Y-m-d 23:59:59', strtotime($request->to_date));

    // ->where('created_at', '>=', $start_date)
    // ->where('created_at', '<=', $end_date) 

//    $start_date = Carbon::parse($request->from_date)->startOfDay();
//     $end_date   = Carbon::parse($request->to_date)->endOfDay();
  
    $activeLang         = Language::where('status', 'active')->orderBy('name', 'ASC')->get();
    $search_query       = $request;
    $request->language = 'en';
   // DB::enableQueryLog();

    $posts = PressRelease::where('status', '1')                
                ->when($request->has('category_id'), function($query) use ($category_id) {  
                    if($category_id != null && $category_id != ''){
                        $query->where('category_id', 'like', '%"' . $category_id .'"%');
                    }
                }) 
                ->when($request->has('search_key'), function($query) use ($search_key) {  
                    if($search_key != null && $search_key != ''){
                        $query->where('title', 'like', '%' . $search_key .'%');
                    }
                }) 
                ->when($request->has('from_date'), function($query) use ($from_date) {  
                    if($from_date != null && $from_date != ''){
                        $query->where('created_at', '>=', date('Y-m-d', strtotime($from_date)));
                    }
                }) 
                
                ->when($request->has('to_date'), function($query) use ($to_date) {   
                    if($to_date != null && $to_date != ''){                   
                        $query->where('created_at', '<=', date('Y-m-d', strtotime("+1 day", strtotime($to_date))));
                    } 
                }) 
                // DB::enableQueryLog(); // Enable query log

                // // Your Eloquent query executed by using get()
                
                // dd(DB::getQueryLog()); // Show results of log
                      
            ->orderBy('id','desc')
            ->with('image','video','category','subCategory','user')
            ->paginate('15');


            //return $search_query;             
             //dd(DB::getQueryLog());
        return view('post::press_release',compact('posts','categories','activeLang','search_query','subCategories','search_key', 'to_date', 'from_date', 'category_id'));
    }



    public function filterPost(Request $request){
            $search_key = null;
            $to_date = null;
            $from_date = null;
            $category_id = null;

            if($request->search_key != null && $request->search_key != ''){
                $search_key = $request->search_key;
            }
            if($request->to_date != null){
                $to_date = $request->to_date;
            }
            if($request->from_date != null){
                $from_date = $request->from_date;
            }
            if($request->category_id != null){
                $category_id = $request->category_id;
            }


           
        $categories         = Category::all();
        if($request->category_id == null):
            $subCategories  = [];
        else:
            $subCategories  = SubCategory::where('category_id', $request->category_id)->get();
        endif;
        // return $subCategories;

        //  $start_date = date('Y-m-d 00:00:00', strtotime($request->from_date));
        //  $end_date = date('Y-m-d 23:59:59', strtotime($request->to_date));

        // ->where('created_at', '>=', $start_date)
        // ->where('created_at', '<=', $end_date) 

    //    $start_date = Carbon::parse($request->from_date)->startOfDay();
    //     $end_date   = Carbon::parse($request->to_date)->endOfDay();
      
        $activeLang         = Language::where('status', 'active')->orderBy('name', 'ASC')->get();
        $search_query       = $request;
        $request->language = 'en';
        //DB::enableQueryLog();
        $posts = Post::where('status', '1')
                    
                    ->when($request->has('category_id'), function($query) use ($category_id) {  
                        if($category_id != null && $category_id != ''){
                            $query->where('category_id', 'like', '%"' . $category_id .'"%');
                        }
                    }) 
                    ->when($request->has('search_key'), function($query) use ($search_key) {  
                        if($search_key != null && $search_key != ''){
                            $query->where('title', 'like', '%' . $search_key .'%');
                        }
                    }) 
                    ->when($request->has('from_date'), function($query) use ($from_date) {  
                        if($from_date != null && $from_date != ''){
                            $query->where('created_at', '>=', date('Y-m-d', strtotime($from_date)));
                        }
                    }) 
                    
                    ->when($request->has('to_date'), function($query) use ($to_date) {   
                        if($to_date != null && $to_date != ''){                   
                            $query->where('created_at', '<=', date('Y-m-d', strtotime("+1 day", strtotime($to_date))));
                        } 
                    }) 
                    // DB::enableQueryLog(); // Enable query log

                    // // Your Eloquent query executed by using get()
                    
                     //dd(DB::getQueryLog()); // Show results of log
                          
                ->orderBy('id','desc')
                ->with('image','video','category','subCategory','user')
                ->paginate('15');
                 //return $search_query;
                 
                // dd(DB::getQueryLog());
                 
        return view('post::index',compact('posts','categories','activeLang','search_query','subCategories','search_key', 'to_date', 'from_date', 'category_id'));
    }



    private function make_slug($string, $delimiter = '-') {



        $string = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\|\\\]/", "", $string);



        $string = preg_replace("/[\/_|+ -]+/", $delimiter, $string);

        $result = mb_strtolower($string);



        if ($result):

            return $result;

        else:

            return $string;

        endif;

    }

}