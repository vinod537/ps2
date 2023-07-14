<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\WidgetService;
use Aws\S3\Exception\S3Exception as S3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Modules\Appearance\Entities\ThemeSection;
use Modules\Gallery\Entities\Audio;
use Modules\Gallery\Entities\Video;
use Modules\Gallery\Entities\Image as galleryImage;
use Modules\Post\Entities\Category;
use Modules\Post\Entities\SubCategory;
use Modules\Post\Entities\Post;
use Modules\Post\Entities\PreviewPost;
use Modules\Post\Entities\PressRelease;
use Modules\Setting\Entities\Setting;
use File;
use Image;
use LaravelLocalization;
use App\VisitorTracker;
use App\Reaction;
use Sentinel;
use Modules\Ads\Entities\Ad;
use Modules\Ads\Entities\AdLocation;

class ArticleController extends Controller
{
	public function show($id='', $slug='')
	{
		
		$post = Post::with(['image', 'comments' => function ($query) {
			return $query->whereNull('comment_id');
		}, 'comments.reply.user', 'comments.user'])
			->where('slug', $slug)->first();

		if (!blank($post)) {
			$post->total_hit = $post->total_hit+1;
			$post->timestamps = false;

			$post->save();

			if ($post->auth_required == 1 && Sentinel::check() == false) {
				return view('site.pages.403');
			}
		} else {
			return view('site.pages.404');
		}

		$post  = Post::with(['image','quizQuestions','quizQuestions.quizAnswers','quizResults','comments'=> function ($query) {
										return $query->whereNull('comment_id');
									}, 'comments.reply.user', 'comments.user'])
									->where('slug', $slug)->first();

		

		$widgetService      = new WidgetService();
		$widgets            = $widgetService->getWidgetDetails();
		$socialLinks        = $this->socialLinks();
		
		// additional content
		$post_contents = [];
		// if(!blank($post->contents)):
	    //     foreach($post->contents as $key=>$content){
	    //         $content_type = array_keys($content);
	    //         //$post_contents[] = $type[0];
	    //         foreach($content as $value){

	    //             $abc = [];
	    //             foreach($value as $key => $item){

	    //                 if($key == 'image_id' && $key != ""){
	    //                     $image = galleryImage::find($item);
	    //                     $abc[] = [$key => $item, 'image' => $image];
	    //                 }elseif($key == 'video_thumbnail_id' && $key != ""){
	    //                     $image = galleryImage::find($item);
	    //                     $abc[] = [$key => $item, 'video_thumbnail' => $image];
	    //                 }elseif($key == 'video_id' && $key != ""){
	    //                     $video = Video::find($item);
	    //                     $abc[] = [$key => $item, 'video' => $video];

	    //                 }elseif($key == 'ads' && $key != ""){

	    //                     $ads_info = Ad::find($item);

	    //                     if($ads_info->ad_type == 'image'){

	    //                         $detail = galleryImage::find($ads_info->ad_image_id);

	    //                     }elseif($ads_info->ad_type == 'code'){

	    //                         $detail = $ads_info->ad_code;

	    //                     }elseif($ads_info->ad_type == 'text'){

	    //                         $detail = $ads_info->ad_text;
	    //                     }

	    //                     $abc[] = [$key => $item, 'ads_type' => $ads_info->ad_type, 'detail' => $detail];
	    //                 }else{
	    //                     $abc[] = [$key => $item];
	    //                 }
	    //             }
	    //             $post_contents[] =[$content_type[0] => $abc];
	    //         }
	    //     }
	    // endif;

		$categoryWithPost = Category::with(['post' => function ($query) use ($post) {
			return $query->limit(40)->orderBy('updated_at', 'desc')->where('id', '!=', $post->id);
		}])->find($post->category_id);

		// dd($post->category_id);
		$categoryName = '';
		if ($categoryWithPost) {
			$categoryName = $categoryWithPost->category_name;
		}

		$comname =  explode(',', $post->company_name2);
		$getAllPosts = [];
		foreach ($comname as $key => $value) {
			$AllPostByCompany = Post::with(['image'])
			->where('company_name2', 'like', "%$value%")
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();				
			array_push($getAllPosts, $AllPostByCompany);
		}

		// Get relatedPost by  product 
		$productname =  explode(',', $post->product2);
		foreach ($productname as $key => $value) {
			$AllPostProduct = Post::with(['image'])
			->where('product2', 'like', "%$value%")
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();				
			array_push($getAllPosts, $AllPostProduct);
		}

		// Get relatedPost by  tags 
		$tagsname =  explode(',', $post->tags);
		foreach ($tagsname as $key => $value) {
			$AllPosttags = Post::with(['image'])
			->where('tags', 'like', "%$value%")
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();				
			array_push($getAllPosts, $AllPosttags);
		}


		$AllPostBycategory = Post::with(['image'])
			->whereJsonContains('category_id', ["$post->category_id"])
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();
			
		$getAllPostsSameCategory=[];
		if(in_array("24", json_decode($post->category_id))){
			$AllPostBycategory1 = Post::with(['image'])
			->whereJsonContains('category_id', ["24"])
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();


			array_push($getAllPostsSameCategory, $AllPostBycategory1);
			$UniqueDocumentID = array();
			$mainsitems1 = [];
			
			foreach($getAllPostsSameCategory as $item1){
				foreach($item1 as $item){
					if(!in_array($item->id, $UniqueDocumentID)) {
						$UniqueDocumentID[] = $item->id;
						$mainsitems1[] = $item;
					}				
				}
			}

			$getAllPosts = $mainsitems1;
		}
		
		elseif(in_array("21", json_decode($post->category_id))){
			$AllPostBycategory1 = Post::with(['image'])
			->whereJsonContains('category_id', ["21"])
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();


			array_push($getAllPostsSameCategory, $AllPostBycategory1);
			$UniqueDocumentID = array();
			$mainsitems1 = [];
			
			foreach($getAllPostsSameCategory as $item1){
				foreach($item1 as $item){
					if(!in_array($item->id, $UniqueDocumentID)) {
						$UniqueDocumentID[] = $item->id;
						$mainsitems1[] = $item;
					}				
				}
			}

			$getAllPosts = $mainsitems1;
		}
		elseif(in_array("22", json_decode($post->category_id))){
			$AllPostBycategory1 = Post::with(['image'])
			->whereJsonContains('category_id', ["22"])
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();


			array_push($getAllPostsSameCategory, $AllPostBycategory1);
			$UniqueDocumentID = array();
			$mainsitems1 = [];
			
			foreach($getAllPostsSameCategory as $item1){
				foreach($item1 as $item){
					if(!in_array($item->id, $UniqueDocumentID)) {
						$UniqueDocumentID[] = $item->id;
						$mainsitems1[] = $item;
					}				
				}
			}

			$getAllPosts = $mainsitems1;
		}
		elseif(in_array("27", json_decode($post->category_id))){
			$AllPostBycategory1 = Post::with(['image'])
			->whereJsonContains('category_id', ["27"])
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();


			array_push($getAllPostsSameCategory, $AllPostBycategory1);
			$UniqueDocumentID = array();
			$mainsitems1 = [];
			
			foreach($getAllPostsSameCategory as $item1){
				foreach($item1 as $item){
					if(!in_array($item->id, $UniqueDocumentID)) {
						$UniqueDocumentID[] = $item->id;
						$mainsitems1[] = $item;
					}				
				}
			}

			$getAllPosts = $mainsitems1;
		}
		elseif(in_array("28", json_decode($post->category_id))){
			$AllPostBycategory1 = Post::with(['image'])
			->whereJsonContains('category_id', ["28"])
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();


			array_push($getAllPostsSameCategory, $AllPostBycategory1);
			$UniqueDocumentID = array();
			$mainsitems1 = [];
			
			foreach($getAllPostsSameCategory as $item1){
				foreach($item1 as $item){
					if(!in_array($item->id, $UniqueDocumentID)) {
						$UniqueDocumentID[] = $item->id;
						$mainsitems1[] = $item;
					}				
				}
			}

			$getAllPosts = $mainsitems1;
		}
		elseif(in_array("29", json_decode($post->category_id))){
			$AllPostBycategory1 = Post::with(['image'])
			->whereJsonContains('category_id', ["29"])
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();


			array_push($getAllPostsSameCategory, $AllPostBycategory1);
			$UniqueDocumentID = array();
			$mainsitems1 = [];
			
			foreach($getAllPostsSameCategory as $item1){
				foreach($item1 as $item){
					if(!in_array($item->id, $UniqueDocumentID)) {
						$UniqueDocumentID[] = $item->id;
						$mainsitems1[] = $item;
					}				
				}
			}

			$getAllPosts = $mainsitems1;
		}
		else{
			array_push($getAllPosts, $AllPostBycategory);
			
			$UniqueDocumentID = array();
			$mainsitems = [];
			foreach($getAllPosts as $item1){
				foreach($item1 as $item){
					if(!in_array($item->id, $UniqueDocumentID)) {
						$UniqueDocumentID[] = $item->id;
						$mainsitems[] = $item;
					}				
				}
			}
			$getAllPosts = $mainsitems;
		}

		
			

		
		$relatedPost = data_get($categoryWithPost, 'post');
		$data['is_you'] = Reaction::where('post_id', $post->id)->where('ip_address', \Request::ip())->first();
			// dd($getAllPosts);
		// if ($post->post_type == "audio"):
		// 	foreach ($post->audio as $key => $audio):
		// 		$audios_array[] =
		// 			array(
		// 				'track' => $key + 1,
		// 				'name' => $audio->audio_name,
		// 				'disk' => $audio->disk,
		// 				'file' => $audio->original,
		// 			);
		// 	endforeach;
		// 	if (!isset($audios_array)):
		// 		$audios_array[] = array();
		// 	endif;
		// else:
		// 	$audios_array[] = array();
		// endif;
		$audios_array[] = array();

		 $tracks = json_encode($audios_array);
		// $tracker = new VisitorTracker();
		// $tracker->page_type = \App\Enums\VisitorPageType::PostDetailPage;
		// $tracker->slug = $post->slug;
		// $tracker->url = \Request::url();
		// $tracker->source_url = \url()->previous();
		// $tracker->ip = \Request()->ip();
		// $tracker->date = date('Y-m-d');
		// $tracker->agent_browser = UserAgentBrowser(\Request()->header('User-Agent'));
		// $tracker->save();

				//		dd($author);

		$author  = [];
		if ($post->user_id) {
			$author  = Sentinel::findById($post->user_id);
		}
		
		//dd($categoryName);

		
		

		// $ads_info = Ad::find($item);
		$ads_AdLocation =  AdLocation::with('ad.adImage')
							->where('status', 1)
							->get()
							->keyBy('unique_name');

		return view('site.pages.article_detail', compact('getAllPosts','ads_AdLocation','categoryName','author', 'post', 'widgets', 'socialLinks', 'relatedPost', 'tracks', 'post_contents'));
	}


	public function Previewshow($id='', $slug='')
	{
		
		$post = PreviewPost::with(['image'])
			->where('slug', $slug)->first();

		if (!blank($post)) {
			$post->total_hit = $post->total_hit+1;
			$post->timestamps = false;

			$post->save();

			if ($post->auth_required == 1 && Sentinel::check() == false) {
				return view('site.pages.403');
			}
		} else {
			return view('site.pages.404');
		}

		$post  = PreviewPost::with(['image'])
									->where('slug', $slug)->first();

		

		$widgetService      = new WidgetService();
		$widgets            = $widgetService->getWidgetDetails();
		$socialLinks        = $this->socialLinks();		
		$post_contents = [];

		$categoryWithPost = Category::with(['post' => function ($query) use ($post) {
			return $query->limit(40)->orderBy('updated_at', 'desc')->where('id', '!=', $post->id);
		}])->find($post->category_id);

		$categoryName = '';
		if ($categoryWithPost) {
			$categoryName = $categoryWithPost->category_name;
		}
		$comname =  explode(',', $post->company_name2);
		$getAllPosts = [];
		foreach ($comname as $key => $value) {
			$AllPostByCompany = PreviewPost::with(['image'])
			->where('company_name2', 'like', "%$value%")
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();				
			array_push($getAllPosts, $AllPostByCompany);
		}

		$productname =  explode(',', $post->product2);
		foreach ($productname as $key => $value) {
			$AllPostProduct = PreviewPost::with(['image'])
			->where('product2', 'like', "%$value%")
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();				
			array_push($getAllPosts, $AllPostProduct);
		}

		$tagsname =  explode(',', $post->tags);
		foreach ($tagsname as $key => $value) {
			$AllPosttags = PreviewPost::with(['image'])
			->where('tags', 'like', "%$value%")
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();				
			array_push($getAllPosts, $AllPosttags);
		}


		$AllPostBycategory = PreviewPost::with(['image'])
			->whereJsonContains('category_id', ["$post->category_id"])
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();
			
		$getAllPostsSameCategory=[];
		if(in_array("24", json_decode($post->category_id))){
			$AllPostBycategory1 = PreviewPost::with(['image'])
			->whereJsonContains('category_id', ["24"])
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();


			array_push($getAllPostsSameCategory, $AllPostBycategory1);
			$UniqueDocumentID = array();
			$mainsitems1 = [];
			
			foreach($getAllPostsSameCategory as $item1){
				foreach($item1 as $item){
					if(!in_array($item->id, $UniqueDocumentID)) {
						$UniqueDocumentID[] = $item->id;
						$mainsitems1[] = $item;
					}				
				}
			}

			$getAllPosts = $mainsitems1;
		}
		
		elseif(in_array("21", json_decode($post->category_id))){
			$AllPostBycategory1 = PreviewPost::with(['image'])
			->whereJsonContains('category_id', ["21"])
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();


			array_push($getAllPostsSameCategory, $AllPostBycategory1);
			$UniqueDocumentID = array();
			$mainsitems1 = [];
			
			foreach($getAllPostsSameCategory as $item1){
				foreach($item1 as $item){
					if(!in_array($item->id, $UniqueDocumentID)) {
						$UniqueDocumentID[] = $item->id;
						$mainsitems1[] = $item;
					}				
				}
			}

			$getAllPosts = $mainsitems1;
		}
		elseif(in_array("22", json_decode($post->category_id))){
			$AllPostBycategory1 = PreviewPost::with(['image'])
			->whereJsonContains('category_id', ["22"])
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();


			array_push($getAllPostsSameCategory, $AllPostBycategory1);
			$UniqueDocumentID = array();
			$mainsitems1 = [];
			
			foreach($getAllPostsSameCategory as $item1){
				foreach($item1 as $item){
					if(!in_array($item->id, $UniqueDocumentID)) {
						$UniqueDocumentID[] = $item->id;
						$mainsitems1[] = $item;
					}				
				}
			}

			$getAllPosts = $mainsitems1;
		}
		elseif(in_array("27", json_decode($post->category_id))){
			$AllPostBycategory1 = PreviewPost::with(['image'])
			->whereJsonContains('category_id', ["27"])
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();


			array_push($getAllPostsSameCategory, $AllPostBycategory1);
			$UniqueDocumentID = array();
			$mainsitems1 = [];
			
			foreach($getAllPostsSameCategory as $item1){
				foreach($item1 as $item){
					if(!in_array($item->id, $UniqueDocumentID)) {
						$UniqueDocumentID[] = $item->id;
						$mainsitems1[] = $item;
					}				
				}
			}

			$getAllPosts = $mainsitems1;
		}
		elseif(in_array("28", json_decode($post->category_id))){
			$AllPostBycategory1 = PreviewPost::with(['image'])
			->whereJsonContains('category_id', ["28"])
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();


			array_push($getAllPostsSameCategory, $AllPostBycategory1);
			$UniqueDocumentID = array();
			$mainsitems1 = [];
			
			foreach($getAllPostsSameCategory as $item1){
				foreach($item1 as $item){
					if(!in_array($item->id, $UniqueDocumentID)) {
						$UniqueDocumentID[] = $item->id;
						$mainsitems1[] = $item;
					}				
				}
			}

			$getAllPosts = $mainsitems1;
		}
		elseif(in_array("29", json_decode($post->category_id))){
			$AllPostBycategory1 = PreviewPost::with(['image'])
			->whereJsonContains('category_id', ["29"])
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();


			array_push($getAllPostsSameCategory, $AllPostBycategory1);
			$UniqueDocumentID = array();
			$mainsitems1 = [];
			
			foreach($getAllPostsSameCategory as $item1){
				foreach($item1 as $item){
					if(!in_array($item->id, $UniqueDocumentID)) {
						$UniqueDocumentID[] = $item->id;
						$mainsitems1[] = $item;
					}				
				}
			}

			$getAllPosts = $mainsitems1;
		}
		else{
			array_push($getAllPosts, $AllPostBycategory);
			
			$UniqueDocumentID = array();
			$mainsitems = [];
			foreach($getAllPosts as $item1){
				foreach($item1 as $item){
					if(!in_array($item->id, $UniqueDocumentID)) {
						$UniqueDocumentID[] = $item->id;
						$mainsitems[] = $item;
					}				
				}
			}
			$getAllPosts = $mainsitems;
		}

		
			

		
		$relatedPost = data_get($categoryWithPost, 'post');
		$data['is_you'] = Reaction::where('post_id', $post->id)->where('ip_address', \Request::ip())->first();
		$audios_array[] = array();

		 $tracks = json_encode($audios_array);	
		$author  = [];
		if ($post->user_id) {
			$author  = Sentinel::findById($post->user_id);
		}
		$ads_AdLocation =  AdLocation::with('ad.adImage')
							->where('status', 1)
							->get()
							->keyBy('unique_name');

		return view('site.pages.article_detail', compact('getAllPosts','ads_AdLocation','categoryName','author', 'post', 'widgets', 'socialLinks', 'relatedPost', 'tracks', 'post_contents'));
	}

	public function eventshow($id)
	{
		
		$post = PressRelease::where('slug', $id)->first();

		if (!blank($post)) {

			$post->total_hit = $post->total_hit+1;
			$post->timestamps = false;

			$post->save();

			if ($post->auth_required == 1 && Sentinel::check() == false) {
				return view('site.pages.403');
			}
		} else {
			return view('site.pages.404');
		}
		$post  = PressRelease::with(['image'])
									->where('slug', $id)->first();

		
		$widgets = '';
		// $widgetService      = new WidgetService();
		// $widgets            = $widgetService->getWidgetDetails();
		$socialLinks        = $this->socialLinks();

	
		$categoryWithPost = Category::with(['post' => function ($query) use ($post) {
			return $query->limit(40)->orderBy('updated_at', 'desc')->where('id', '!=', $post->id);
		}])->find($post->category_id);

		$categoryName = '';
		if ($categoryWithPost) {
			$categoryName = $categoryWithPost->category_name;
		}

		$comname =  explode(',', $post->company_name2);
		
		$getAllPosts = [];
		

		
		if (count($comname) > 1) {		
			$getAllPosts = Post::with(['image'])  ->where('id', '!=', $post->id)            
			->where(function ($query) use($comname) {
				foreach ($comname as $key => $value) {

					
					if ($key == 0) {
						$query->where('company_name2', 'like',  '%' . $value .'%');
					}else{
						$query->orWhere('company_name2', 'like',  '%' . $value .'%');
					}
				}      
			})
			->get();
		}

		

		$productname =  explode(',', $post->product2);
		


		if (count($productname) > 1) {		
			$getAllPosts = Post::with(['image'])  ->where('id', '!=', $post->id)            
			->where(function ($query) use($productname) {
				foreach ($productname as $key => $value) {

					
					if ($key == 0) {
						$query->where('product2', 'like',  '%' . $value .'%');
					}else{
						$query->orWhere('product2', 'like',  '%' . $value .'%');
					}
				}      
			})
			->get();
		}
		
		$tagsname =  explode(',', $post->tags);
		

		if (count($tagsname) > 1) {		
			$getAllPosts = Post::with(['image'])  ->where('id', '!=', $post->id)            
			->where(function ($query) use($tagsname) {
				foreach ($tagsname as $key => $value) {

					
					if ($key == 0) {
						$query->where('tags', 'like',  '%' . $value .'%');
					}else{
						$query->orWhere('tags', 'like',  '%' . $value .'%');
					}
				}      
			})
			->get();
		}
	

		$AllPostBycategory = Post::with(['image'])
			->whereJsonContains('category_id', [$post->category_id])
			->where('id', '!=', $post->id)
			->get();			
			
	
		$relatedPost = data_get($categoryWithPost, 'post');

		

		$author  = [];
		if ($post->user_id) {
			$author  = Sentinel::findById($post->user_id);
		}
		
		$ads_AdLocation =  AdLocation::with('ad.adImage')
                                ->where('status', 1)
                                ->get()
                                ->keyBy('unique_name');		

		return view('site.pages.event_detail', compact('getAllPosts','ads_AdLocation','categoryName','author', 'post', 'widgets', 'socialLinks', 'relatedPost'));
	}


	

	public function upload(Request $request){
		
		$imageName = time().'.'.$request->upload->extension();       
        $request->upload->move(public_path('otherimages'), $imageName);		
		
		$function_number = $_GET['CKEditorFuncNum'];
		$url = '../../../public/otherimages/'.$imageName;
		$message = '';   
		echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";

    }

	private function socialLinks()
	{
		$socialLinkTitle = [
			'fb_url',
			'twitter_url',
			'google_url',
			'instagram_url',
			'pinterest_url',
			'linkedin_url',
			'youtube_url',
		];

		return Setting::whereIn('title', $socialLinkTitle)->get()->pluck('value', 'title');
	}

	public function submitNewsForm()
	{
		if (settingHelper('submit_news_status') == 1):
			if (!Sentinel::check()):
				return redirect()->route('site.login.form');
			endif;

			$widgetService = new WidgetService();
			$widgets = $widgetService->getWidgetDetails();

			return view('site.pages.submit_news', compact('widgets'));
		else:
			return response()->view('site.pages.404');
		endif;
	}

	//compressing image to and making webp
	public function compressImage($image, $type)
	{
		if ($type):
			$newImage = imagecreatefromjpeg($image);
			imagepalettetotruecolor($newImage);
			imagealphablending($newImage, true);
			imagesavealpha($newImage, true);
			imagewebp($newImage, $image, 80);
			return $newImage;
			imagedestroy($newImage);
		endif;
	}

	public function saveNews(Request $request)
	{
		if (settingHelper('submit_news_status') != 1):
			return response()->view('site.pages.404');
		endif;

		Validator::make($request->all(), [
			'title' => 'required|min:2|unique:posts',
			'content' => 'required',
			'image' => 'required|mimes:jpg,JPG,JPEG,jpeg,png|max:5120'
		])->validate();

		try {

			DB::beginTransaction();
			$post = new Post();
			$post->title = $request->get('title');
			$post->slug = $this->make_slug($request->title);
			$post->user_id = Sentinel::getUser()->id;
			$post->content = $request->get('content');
			$post->post_type = 'article';
			$post->submitted = 1;
			$post->language = app()->getLocale();

			if ($request->hasFile('image')):
				$post->image_id = $this->imageUpload($request);
			endif;

			$post->save();

			DB::commit();

			return redirect()->back()->with('success', __('successfully_added'));
		} catch (\Exception $e) {

			DB::rollBack();

			return view('site.pages.500');
		}
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

	public function imageUpload($request)
	{
		$validation = Validator::make($request->all(), [
			'image' => 'required|mimes:jpg,JPG,JPEG,jpeg,png|max:5120',
		])->validate();

		try {
			$image = new galleryImage();
			$requestImage = $request->file('image');
			$fileType = $requestImage->getClientOriginalExtension();

			$originalImageName = date('YmdHis') . "_original_" . rand(1, 50) . '.' . 'webp';
			$ogImageName = date('YmdHis') . "_ogImage_" . rand(1, 50) . '.' . $fileType;
			$thumbnailImageName = date('YmdHis') . "_thumbnail_100x100_" . rand(1, 50) . '.' . 'webp';
			$bigImageName = date('YmdHis') . "_big_1080x1000_" . rand(1, 50) . '.' . 'webp';
			$bigImageNameTwo = date('YmdHis') . "_big_730x400_" . rand(1, 50) . '.' . 'webp';
			$mediumImageName = date('YmdHis') . "_medium_358x215_" . rand(1, 50) . '.' . 'webp';
			$mediumImageNameTwo = date('YmdHis') . "_medium_350x190_" . rand(1, 50) . '.' . 'webp';
			$mediumImageNameThree = date('YmdHis') . "_medium_255x175_" . rand(1, 50) . '.' . 'webp';
			$smallImageName = date('YmdHis') . "_small_123x83_" . rand(1, 50) . '.' . 'webp';


			if (strpos(php_sapi_name(), 'cli') !== false || settingHelper('default_storage') == 's3' || defined('LARAVEL_START_FROM_PUBLIC')) :
				$directory = 'images/';
			else:
				$directory = 'public/images/';
			endif;

			$originalImageUrl = $directory . $originalImageName;
			$ogImageUrl = $directory . $ogImageName;
			$thumbnailImageUrl = $directory . $thumbnailImageName;
			$bigImageUrl = $directory . $bigImageName;
			$bigImageUrlTwo = $directory . $bigImageNameTwo;
			$mediumImageUrl = $directory . $mediumImageName;
			$mediumImageUrlTwo = $directory . $mediumImageNameTwo;
			$mediumImageUrlThree = $directory . $mediumImageNameThree;
			$smallImageUrl = $directory . $smallImageName;


			if (settingHelper('default_storage') == 's3'):

				//ogImage
				$imgOg = Image::make($requestImage)->fit(730, 400)->stream();

				//jpg. jpeg, JPEG, JPG compression
				if ($fileType == 'jpeg' or $fileType == 'jpg' or $fileType == 'JPEG' or $fileType == 'JPG'):
					$imgOriginal = Image::make(imagecreatefromjpeg($requestImage))->encode('webp', 80);
					$imgThumbnail = Image::make(imagecreatefromjpeg($requestImage))->fit(100, 100)->encode('webp', 80);
					$imgBig = Image::make(imagecreatefromjpeg($requestImage))->fit(1080, 1000)->encode('webp', 80);
					$imgBigTwo = Image::make(imagecreatefromjpeg($requestImage))->fit(730, 400)->encode('webp', 80);
					$imgMedium = Image::make(imagecreatefromjpeg($requestImage))->fit(358, 215)->encode('webp', 80);
					$imgMediumTwo = Image::make(imagecreatefromjpeg($requestImage))->fit(350, 190)->encode('webp', 80);
					$imgMediumThree = Image::make(imagecreatefromjpeg($requestImage))->fit(255, 175)->encode('webp', 80);
					$imgSmall = Image::make(imagecreatefromjpeg($requestImage))->fit(123, 83)->encode('webp', 80);

				//png compression
				elseif ($fileType == 'PNG' or $fileType == 'png'):

					$imgOriginal = Image::make(imagecreatefrompng($requestImage))->encode('webp', 80);
					$imgThumbnail = Image::make(imagecreatefrompng($requestImage))->fit(100, 100)->encode('webp', 80);
					$imgBig = Image::make(imagecreatefrompng($requestImage))->fit(1080, 1000)->encode('webp', 80);
					$imgBigTwo = Image::make(imagecreatefrompng($requestImage))->fit(730, 400)->encode('webp', 80);
					$imgMedium = Image::make(imagecreatefrompng($requestImage))->fit(358, 215)->encode('webp', 80);
					$imgMediumTwo = Image::make(imagecreatefrompng($requestImage))->fit(350, 190)->encode('webp', 80);
					$imgMediumThree = Image::make(imagecreatefrompng($requestImage))->fit(255, 175)->encode('webp', 80);
					$imgSmall = Image::make(imagecreatefrompng($requestImage))->fit(123, 83)->encode('webp', 80);

				endif;

				try {
					Storage::disk('s3')->put($originalImageUrl, $imgOriginal);
					Storage::disk('s3')->put($ogImageUrl, $imgOg);
					Storage::disk('s3')->put($thumbnailImageUrl, $imgThumbnail);
					Storage::disk('s3')->put($bigImageUrl, $imgBig);
					Storage::disk('s3')->put($bigImageUrlTwo, $imgBigTwo);
					Storage::disk('s3')->put($mediumImageUrl, $imgMedium);
					Storage::disk('s3')->put($mediumImageUrlTwo, $imgMediumTwo);
					Storage::disk('s3')->put($mediumImageUrlThree, $imgMediumThree);
					Storage::disk('s3')->put($smallImageUrl, $imgSmall);

				} catch (S3 $e) {
					$data['status'] = 'error';
					$data['message'] = $e->getMessage();
					return Response()->json($data);
				}
			elseif (settingHelper('default_storage') == 'local'):
				Image::make($requestImage)->fit(730, 400)->save($ogImageUrl);


				if ($fileType == 'jpeg' or $fileType == 'jpg' or $fileType == 'JPEG' or $fileType == 'JPG'):
					Image::make(imagecreatefromjpeg($requestImage))->save($originalImageUrl, 80);

					Image::make(imagecreatefromjpeg($requestImage))->fit(100, 100)->save($thumbnailImageUrl, 80);
					Image::make(imagecreatefromjpeg($requestImage))->fit(1080, 1000)->save($bigImageUrl, 80);
					Image::make(imagecreatefromjpeg($requestImage))->fit(730, 400)->save($bigImageUrlTwo, 80);
					Image::make(imagecreatefromjpeg($requestImage))->fit(358, 215)->save($mediumImageUrl, 80);
					Image::make(imagecreatefromjpeg($requestImage))->fit(350, 190)->save($mediumImageUrlTwo, 80);
					Image::make(imagecreatefromjpeg($requestImage))->fit(255, 175)->save($mediumImageUrlThree, 80);
					Image::make(imagecreatefromjpeg($requestImage))->fit(123, 83)->save($smallImageUrl, 80);

				elseif ($fileType == 'PNG' or $fileType == 'png'):
					Image::make(imagecreatefrompng($requestImage))->save($originalImageUrl, 80);

					Image::make(imagecreatefrompng($requestImage))->fit(100, 100)->save($thumbnailImageUrl, 80);
					Image::make(imagecreatefrompng($requestImage))->fit(1080, 1000)->save($bigImageUrl, 80);
					Image::make(imagecreatefrompng($requestImage))->fit(730, 400)->save($bigImageUrlTwo, 80);
					Image::make(imagecreatefrompng($requestImage))->fit(358, 215)->save($mediumImageUrl, 80);
					Image::make(imagecreatefrompng($requestImage))->fit(350, 190)->save($mediumImageUrlTwo, 80);
					Image::make(imagecreatefrompng($requestImage))->fit(255, 175)->save($mediumImageUrlThree, 80);
					Image::make(imagecreatefrompng($requestImage))->fit(123, 83)->save($smallImageUrl, 80);
				endif;
			endif;

			$image->original_image = str_replace("public/", "", $originalImageUrl);
			$image->og_image = str_replace("public/", "", $ogImageUrl);
			$image->thumbnail = str_replace("public/", "", $thumbnailImageUrl);
			$image->big_image = str_replace("public/", "", $bigImageUrl);
			$image->big_image_two = str_replace("public/", "", $bigImageUrlTwo);
			$image->medium_image = str_replace("public/", "", $mediumImageUrl);
			$image->medium_image_two = str_replace("public/", "", $mediumImageUrlTwo);
			$image->medium_image_three = str_replace("public/", "", $mediumImageUrlThree);
			$image->small_image = str_replace("public/", "", $smallImageUrl);

			$image->disk = settingHelper('default_storage');
			$image->save();
			$image = galleryImage::latest()->first();

			return $image->id;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return null;
		}
	}

	//post by category

    public function search(Request $request)
    {
        try{

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


			
			$Serah = $request->get('search');
			// check if its a category and get its id
			$cat = Category::select('id')->where('slug', $Serah)->first();
			
			if (isset($Serah)) {
				$ps = '1';

				if (gettype($cat) === "object") {
					$posts = Post::where('category_id', 'like', "%$cat->id%")
					->when(Sentinel::check() == false, function ($query) {
						$query->where('auth_required', 0);
					})
					->orderBy('updated_at', 'desc')
					->limit(6)->get();
	
					$totalPostCount = Post::where('category_id', 'like', "%$cat->id%")
					->where('visibility', 1)->where('status', 1)
					->when(Sentinel::check() == false, function ($query) {
						$query->where('auth_required', 0);
					})
					->count();
				} else {
					$posts = Post::where(DB::raw('LOWER(title)'), 'like', '%' . strtolower($request->get('search')) . '%')->where('visibility', 1)->where('status', 1)
					->when(Sentinel::check() == false, function ($query) {
						$query->where('auth_required', 0);
					})
					->orderBy('updated_at', 'desc')
					->limit(6)->get();
	
					$totalPostCount = Post::where(DB::raw('LOWER(title)'), 'like', '%' . strtolower($request->get('search')) . '%')
					->where('visibility', 1)->where('status', 1)
					->when(Sentinel::check() == false, function ($query) {
						$query->where('auth_required', 0);
					})
					->count();
				}
			}else{
				
				$ps = '0';

				$posts = Post::where(DB::raw('LOWER(title)'), 'like', '%' . strtolower($request->get('search')) . '%')->where('visibility', 1)->where('status', 1)
                ->when(Sentinel::check() == false, function ($query) {
                    $query->where('auth_required', 0);
                })
				->where('category_id', 'not like', "%24%")
				->where('category_id', 'not like', "%21%")
				->where('category_id', 'not like', "%27%")
				->where('category_id', 'not like', "%28%")
				->where('category_id', 'not like', "%29%")
				->where('category_id', 'not like', "%31%")
				->where('category_id', 'not like', "%32%")
				->where('category_id', 'not like', "%22%")
				->orderBy('updated_at', 'desc')
                ->limit(6)->get();

            $totalPostCount = Post::where(DB::raw('LOWER(title)'), 'like', '%' . strtolower($request->get('search')) . '%')->where('status', 1)
				->where('visibility', 1)
				->where('category_id', 'not like', "%24%")
				->where('category_id', 'not like', "%21%")
				->where('category_id', 'not like', "%27%")
				->where('category_id', 'not like', "%28%")
				->where('category_id', 'not like', "%29%")
				->where('category_id', 'not like', "%31%")
				->where('category_id', 'not like', "%32%")
				->where('category_id', 'not like', "%22%")

                ->when(Sentinel::check() == false, function ($query) {
                    $query->where('auth_required', 0);
                })
				//  ->whereNotIn('category_id','!=', '24')
				->count();
			}

           


			//dd($posts);
            return view('site.pages.search', compact('posts','totalPostCount','ps'));
        } catch (\Exception $e) {
            return view('site.pages.404');
        }
    }

	public function postByCategory($slug)
	{
		try {
			$id = Category::where('slug', $slug)->first()->id;
			$name = Category::where('slug', $slug)->first()->category_name;
			//DB::enableQueryLog();
			$posts = Post::with(['image', 'user'])->whereJsonContains('category_id', ["$id"])->where('visibility', 1)
				->where('status', 1)
				->when(Sentinel::check() == false, function ($query) {
					$query->where('auth_required', 0);
				})
				->orderBy('updated_at', 'desc')
				->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->limit(6)
				->get();
			//	$quries = DB::getQueryLog();

			// dd(end($quries));

		 	$totalPostCount = Post::whereJsonContains('category_id', ["$id"])->where('visibility', 1)
				->where('status', 1)
				->when(Sentinel::check() == false, function ($query) {
					$query->where('auth_required', 0);
				})
				->orderBy('updated_at', 'desc')
				->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
				->count();

			$widgetService = new WidgetService();
			$widgets = $widgetService->getWidgetDetails();

			//dd($relatedPost);

			$ads_AdLocation =  AdLocation::with('ad.adImage')
            ->where('status', 1)
            ->get()
            ->keyBy('unique_name');

			// $tracker = new VisitorTracker();
			// $tracker->page_type = \App\Enums\VisitorPageType::PostByCategoryPage;
			// $tracker->url = \Request::url();
			// $tracker->source_url = \url()->previous();
			// $tracker->ip = \Request()->ip();
			// $tracker->agent_browser = UserAgentBrowser(\Request()->header('User-Agent'));
			// $tracker->save();

			return view('site.pages.category_posts', compact('posts','ads_AdLocation','name', 'widgets', 'totalPostCount', 'id'));
		} catch (\Exception $e) {
			return view('site.pages.404');
		}
	}

	//post by sub category

	public function getReadMorePostCategory(Request $request)
	{
		$skip = $request->last_id * 6;
		//  DB::enableQueryLog();

	 	 $postCount = Post::whereJsonContains('category_id', [$request->category_id])->where('visibility', 1)
			->where('status', 1)
			->when(Sentinel::check() == false, function ($query) {
				$query->where('auth_required', 0);
			})
			->orderBy('updated_at', 'desc')
			->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
			->count();
				// 			 $quries = DB::getQueryLog();

				//  dd(end($quries));

		$hideReadMore = 0;
		if ($skip >= $postCount) {
			$hideReadMore = 1;
		}


		$posts = Post::with(['image', 'user'])->whereJsonContains('category_id', [$request->category_id])->where('visibility', 1)
			->where('status', 1)
			->when(Sentinel::check() == false, function ($query) {
				$query->where('auth_required', 0);
			})
			->orderBy('updated_at', 'desc')
			->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->limit(6)->skip($skip)->get();
			
		$allPosts = [];
		foreach ($posts as $post) {
			$appendRow = '';
			$appendRow .= "<div class='col-md-4'>";
			$appendRow .= "<div class='sg-post medium-post-style-1'>";
			$appendRow .= "<div class='entry-header'>";
			$appendRow .= "<div class='entry-thumbnail'>";
			if($post->old_id) {
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ]) . "'>";				 
			}else{ 				 
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug ]) . "'>";
			}
			if (isFileExist($post->image, $result = @$post->image->original_image)) {
				$appendRow .= "<img  src=' " . basePath($post->image) . '/' . $result . "  ' class='img-fluid'   alt='" . $post->title . "  '>";
			} else {
				$appendRow .= "<img src='" . static_asset('default-image/default-240x160.png') . " '  class='img-fluid'   alt='" . $post->title . "' >";
			}
			$appendRow .= "</a>";
			$appendRow .= "</div>";
			if ($post->post_type == "video"):
				$appendRow .= "<div class='video-icon large-block'>";
				$appendRow .= "<img src='" . static_asset('default-image/video-icon.svg') . " ' alt='video-icon' >";
				$appendRow .= "</div>";
			elseif ($post->post_type == "audio"):
				$appendRow .= "<div class='video-icon large-block'>";
				$appendRow .= "<img src='" . static_asset('default-image/audio-icon.svg') . " ' alt='audio-icon' >";
				$appendRow .= "</div>";
			endif;
							//            $appendRow .= "<div class='category'>";
							//            $appendRow .= "<ul class='global-list'>";
							//            if ($post->category != "") :
							//                $appendRow .= "<li><a href='" . url('category', $post->category->slug) . "'> " . $post->category->category_name . "</a></li>";
							//            endif;
							//            $appendRow .= "</ul>";
							//            $appendRow .= "</div>";
			$appendRow .= "</div>";
			$appendRow .= "<div class='entry-content align-self-center'>";
		

		
				$appendRow .= "<h3 class='entry-title d_-0999'>";
				if($post->old_id) {
					$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ]) . "'>" . \Illuminate\Support\Str::limit($post->title, 130) . " ";				 
				}else{ 				 
					$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug ]) . "'>" . \Illuminate\Support\Str::limit($post->title, 130) . " ";
				}
			// $appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug]) . " '> " . \Illuminate\Support\Str::limit($post->title, 130) . " ";
			$appendRow .= "</a>";
			$appendRow .= "</h3>";
			$appendRow .= "<div class='entry-meta mb-2 fhf'>";
			$appendRow .= "<ul class='global-list'>";
		
			$appendRow .= "<li>" . $post->updated_at->format('F j, Y') . "</li>";
			$appendRow .= "</ul>";
			$appendRow .= "</div> ";
			$appendRow .= "</div>";
			$appendRow .= "</div>";
			$appendRow .= "</div>";

			$allPosts[] = $appendRow;

		}
		return response()->json([$allPosts, $hideReadMore]);
	}

	public function postBySubCategory($slug)
	{
		try {
			$id = SubCategory::where('slug', $slug)->first()->id;

			$posts = Post::with(['image', 'user'])->where('sub_category_id', $id)->where('visibility', 1)
				->where('status', 1)
				->when(Sentinel::check() == false, function ($query) {
					$query->where('auth_required', 0);
				})
				->orderBy('updated_at', 'desc')
				->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->limit(6)
				->get();

			$totalPostCount = Post::where('sub_category_id', $id)->where('visibility', 1)
				->where('status', 1)
				->when(Sentinel::check() == false, function ($query) {
					$query->where('auth_required', 0);
				})
				->orderBy('updated_at', 'desc')
				->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
				->count();


			$widgetService = new WidgetService();
			$widgets = $widgetService->getWidgetDetails();

			//dd($relatedPost);

			// $tracker = new VisitorTracker();
			// $tracker->page_type = \App\Enums\VisitorPageType::PostBySubCategoryPage;
			// $tracker->url = \Request::url();
			// $tracker->source_url = \url()->previous();
			// $tracker->ip = \Request()->ip();
			// $tracker->agent_browser = UserAgentBrowser(\Request()->header('User-Agent'));
			// $tracker->save();

			return view('site.pages.sub_category_posts', compact('posts', 'widgets', 'totalPostCount', 'id'));
		} catch (\Exception $e) {
			return view('site.pages.404');
		}
	}

	//post by tags

	public function getPostSubcategory(Request $request)
	{

		$skip = $request->last_id * 6;
		$postCount = Post::where('sub_category_id', $request->sub_category_id)->where('visibility', 1)
			->where('status', 1)
			->when(Sentinel::check() == false, function ($query) {
				$query->where('auth_required', 0);
			})
			->orderBy('updated_at', 'desc')
			->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
			->count();

		$hideReadMore = 0;
		if ($skip >= $postCount) {
			$hideReadMore = 1;
		}
		$posts = Post::with(['image', 'user'])->where('sub_category_id', $request->sub_category_id)->where('visibility', 1)
			->where('status', 1)
			->when(Sentinel::check() == false, function ($query) {
				$query->where('auth_required', 0);
			})
			->orderBy('updated_at', 'desc')
			->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->limit(6)->skip($skip)
			->get();

		$allPosts = [];
		foreach ($posts as $post) {
			$appendRow = '';
			$appendRow .= "<div class='col-md-4'>";
			$appendRow .= "<div class='sg-post medium-post-style-1'>";
			$appendRow .= "<div class='entry-header'>";
			$appendRow .= "<div class='entry-thumbnail'>";
			// $appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug]) . "'>";

			if($post->old_id) {
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ]) . "'>";				 
			}else{ 				 
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug ]) . "'>";
			}

			if (isFileExist($post->image, $result = @$post->image->original_image)) {
				$appendRow .= "<img  src=' " . basePath($post->image) . '/' . $result . " ' class='img-fluid'   alt='" . $post->title . "  '>";
			} else {
				$appendRow .= "<img src='" . static_asset('default-image/default-240x160.png') . " '  class='img-fluid'   alt='" . $post->title . "' >";
			}
			$appendRow .= "</a>";
			$appendRow .= "</div>";
			if ($post->post_type == "video"):
				$appendRow .= "<div class='video-icon large-block'>";
				$appendRow .= "<img src='" . static_asset('default-image/video-icon.svg') . " ' alt='video-icon' >";
				$appendRow .= "</div>";
			elseif ($post->post_type == "audio"):
				$appendRow .= "<div class='video-icon large-block'>";
				$appendRow .= "<img src='" . static_asset('default-image/audio-icon.svg') . " ' alt='audio-icon' >";
				$appendRow .= "</div>";
			endif;
			$appendRow .= "<div class='category'>";
			$appendRow .= "<ul class='global-list'>";
			if ($post->category != "") :
				$appendRow .= "<li><a  class=".$post->category->slug." href='" . url('category', $post->category->slug) . "'> " . $post->category->category_name . "</a></li>";
			endif;
			$appendRow .= "</div>";
			$appendRow .= "<div class='entry-content align-self-center'>";
			$appendRow .= "<h3 class='entry-title d_-0999'>";
			if($post->old_id) {
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ]) . "'>" . \Illuminate\Support\Str::limit($post->title, 130) . " ";				 
			}else{ 				 
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug ]) . "'>" . \Illuminate\Support\Str::limit($post->title, 130) . " ";
			}
			// $appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug]) . " '> " . \Illuminate\Support\Str::limit($post->title, 130) . " ";
			$appendRow .= "</a>";
			$appendRow .= "</h3>";

			$appendRow .= "<div class='entry-meta mb-2 fhf'>";
			$appendRow .= "<ul class='global-list'>";
			$appendRow .= "<li>" . $post->updated_at->format('F j, Y') . "</li>";
			$appendRow .= "</ul>";
			$appendRow .= "</div> ";
			$appendRow .= "</div>";
			$appendRow .= "</div>";
			$appendRow .= "</div>";

			$allPosts[] = $appendRow;

		}
		return response()->json([$allPosts, $hideReadMore]);
	}

	public function postByTags($slug)
	{

		
		try {

			$posts = Post::with(['image', 'user'])->whereRaw("FIND_IN_SET('$slug',tags)")->where('visibility', 1)
				->where('status', 1)
				->when(Sentinel::check() == false, function ($query) {
					$query->where('auth_required', 0);
				})
				->orderBy('updated_at', 'desc')
				->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->limit(6)->get();

			$totalPostCount = Post::whereRaw("FIND_IN_SET('$slug',tags)")->where('visibility', 1)
				->where('status', 1)
				->when(Sentinel::check() == false, function ($query) {
					$query->where('auth_required', 0);
				})
				->orderBy('updated_at', 'desc')
				->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->count();

			$name = $slug;
			$widgetService = new WidgetService();
			$widgets = $widgetService->getWidgetDetails();

			$tags = $slug;
			//dd($relatedPost);

			// $tracker = new VisitorTracker();
			// $tracker->page_type = \App\Enums\VisitorPageType::PostByTagsPage;
            // $tracker->slug = $slug;
			// $tracker->url = \Request::url();
			// $tracker->source_url = \url()->previous();
			// $tracker->ip = \Request()->ip();
			// $tracker->agent_browser = UserAgentBrowser(\Request()->header('User-Agent'));
			// $tracker->save();

			return view('site.pages.tags_posts', compact('name','posts','tags', 'widgets', 'totalPostCount', 'slug'));
		} catch (\Exception $e) {
			return view('site.pages.404');
		}
	}

	//post by author

	public function getReadMorePostTags(Request $request)
	{

		$skip = $request->last_id * 6;
		$postCount = Post::where('tags', 'like', '%' . $request->tags . '%')->where('visibility', 1)
			->where('status', 1)
			->when(Sentinel::check() == false, function ($query) {
				$query->where('auth_required', 0);
			})
			->orderBy('updated_at', 'desc')
			->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->count();

		$hideReadMore = 0;
		if ($skip >= $postCount) {
			$hideReadMore = 1;
		}
		$posts = Post::with(['image', 'user'])->where('tags', 'like', '%' . $request->tags . '%')->where('visibility', 1)
			->where('status', 1)
			->when(Sentinel::check() == false, function ($query) {
				$query->where('auth_required', 0);
			})
			->orderBy('updated_at', 'desc')
			->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->limit(6)->skip($skip)->get();


		$allPosts = [];
		foreach ($posts as $post) {
			$appendRow = '';
			$appendRow = '<div class="col-md-4">';
			$appendRow .= "<div class='sg-post medium-post-style-1'>";
			$appendRow .= "<div class='entry-header'>";
			$appendRow .= "<div class='entry-thumbnail'>";
			// $appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug]) . "'>";
			if($post->old_id) {
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ]) . "'>";				 
			}else{ 				 
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug ]) . "'>";
			}

			if (isFileExist($post->image, $result = @$post->image->original_image)) {
				$appendRow .= "<img  src=' " . basePath($post->image) . '/' . $result . " ' class='img-fluid'   alt='" . $post->title . "  '>";
			} else {
				$appendRow .= "<img src='" . static_asset('default-image/default-240x160.png') . " '  class='img-fluid'   alt='" . $post->title . "' >";
			}
			$appendRow .= "</a>";
			$appendRow .= "</div>";
			if ($post->post_type == "video"):
				$appendRow .= "<div class='video-icon large-block'>";
				$appendRow .= "<img src='" . static_asset('default-image/video-icon.svg') . " ' alt='video-icon' >";
				$appendRow .= "</div>";
			elseif ($post->post_type == "audio"):
				$appendRow .= "<div class='video-icon large-block'>";
				$appendRow .= "<img src='" . static_asset('default-image/audio-icon.svg') . " ' alt='audio-icon' >";
				$appendRow .= "</div>";
			endif;
			$appendRow .= "<div class='category'>";
			$appendRow .= "<ul class='global-list'>";
			if ($post->category != "") :
				$appendRow .= "<li><a  class=".$post->category->slug." href='" . url('category', $post->category->slug) . "'> " . $post->category->category_name . "</a></li>";
			endif;
			$appendRow .= "</ul>";
			$appendRow .= "</div>";
			$appendRow .= "</div>";
			$appendRow .= "<div class='entry-content align-self-center'>";
			$appendRow .= "<h3 class='entry-title d_-0999'>";
			if($post->old_id) {
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ]) . "'>" . \Illuminate\Support\Str::limit($post->title, 130) . " ";				 
			}else{ 				 
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug ]) . "'>" . \Illuminate\Support\Str::limit($post->title, 130) . " ";
			}
			// $appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug]) . " '> " . \Illuminate\Support\Str::limit($post->title, 130) . " ";
			$appendRow .= "</a>";
			$appendRow .= "</h3>";

			$appendRow .= "<div class='entry-meta mb-2 fhf'>";
			$appendRow .= "<ul class='global-list'>";
			$appendRow .= "<li>" . $post->updated_at->format('F j, Y') . "</li>";
			$appendRow .= "</ul>";
			$appendRow .= "</div> ";
			$appendRow .= "</div>";
			$appendRow .= "</div>";
			$appendRow .= "</div>";

			$allPosts[] = $appendRow;
		}
		return response()->json([$allPosts, $hideReadMore]);

	}

	//post by author
	public function postByAuthor($id){
		try{
		$posts               =  Post::with(['image', 'user'])->where('user_id',$id)->where('visibility', 1)
								->where('status', 1)
								->when(Sentinel::check()== false, function ($query) {
									$query->where('auth_required',0); })
								->orderBy('updated_at', 'desc')
								->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->paginate(10);

			$widgetService      = new WidgetService();
			$widgets            = $widgetService->getWidgetDetails();

			//dd($relatedPost);

			// $tracker = new VisitorTracker();
			// $tracker->page_type = \App\Enums\VisitorPageType::PostByAuthorPage;
			// $tracker->url = \Request::url();
			// $tracker->source_url = \url()->previous();
			// $tracker->ip = \Request()->ip();
			// $tracker->agent_browser = UserAgentBrowser(\Request()->header('User-Agent'));
			// $tracker->save();

			return view('site.pages.category_posts', compact('posts', 'widgets'));
		} catch (\Exception $e) {
			return view('site.pages.404');
		}
	}

	//post by date
	public function postByDate($date){


		try{
			$posts =  Post::with(['image', 'user'])->whereDate('updated_at', $date)
								->where('visibility', 1)
								->where('status', 1)
								->when(Sentinel::check()== false, function ($query) {
									$query->where('auth_required',0); })
								->orderBy('updated_at', 'desc')
								->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->limit(6)->get();


			$totalPostCount = Post::whereDate('updated_at', $date)
				->where('visibility', 1)
				->where('status', 1)
				->when(Sentinel::check() == false, function ($query) {
					$query->where('auth_required', 0);
				})
				->orderBy('updated_at', 'desc')
				->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->count();


			$widgetService = new WidgetService();
			$widgets = $widgetService->getWidgetDetails();

			//dd($relatedPost);

			// $tracker = new VisitorTracker();
			// $tracker->page_type = \App\Enums\VisitorPageType::PostByDatePage;
			// $tracker->url = \Request::url();
			// $tracker->source_url = \url()->previous();
			// $tracker->ip = \Request()->ip();
			// $tracker->agent_browser = UserAgentBrowser(\Request()->header('User-Agent'));
			// $tracker->save();


			return view('site.pages.date_posts', compact('posts', 'widgets', 'totalPostCount', 'date'));
		} catch (\Exception $e) {
			return view('site.pages.404');
		}
	}

	public function getReadMorePostDate(Request $request)
	{
		$skip = $request->last_id * 6;

		$postCount = Post::whereDate('updated_at', $request->date)
			->where('visibility', 1)
			->where('status', 1)
			->when(Sentinel::check() == false, function ($query) {
				$query->where('auth_required', 0);
			})
			->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->count();

		$hideReadMore = 0;
		if ($skip >= $postCount) {
			$hideReadMore = 1;
		}

		$posts = Post::with(['image', 'user', 'category'])->whereDate('updated_at', $request->date)
			->where('status', 1)
			->when(Sentinel::check() == false, function ($query) {
				$query->where('auth_required', 0);
			})
			->orderBy('updated_at', 'desc')
			->limit(6)
			->skip($skip)
			->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->get();


		$allPosts = [];
		foreach ($posts as $post) {
			$appendRow = '';
			$appendRow = "<div class='col-md-4'>";
			$appendRow .= "<div class='sg-post medium-post-style-1'>";
			$appendRow .= "<div class='entry-header'>";
			$appendRow .= "<div class='entry-thumbnail'>";
			// $appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug]) . "'>";
			if($post->old_id) {
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ]) . "'>";				 
			}else{ 				 
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug ]) . "'>";
			}

			if (isFileExist($post->image, $result = @$post->image->original_image)) {
				$appendRow .= "<img  src=' " . basePath($post->image) . '/' . $result . " ' class='img-fluid'   alt='" . $post->title . "  '>";
			} else {
				$appendRow .= "<img src='" . static_asset('default-image/default-240x160.png') . " '  class='img-fluid'   alt='" . $post->title . "' >";
			}
			$appendRow .= "</a>";
			$appendRow .= "</div>";
			if ($post->post_type == "video"):
				$appendRow .= "<div class='video-icon large-block'>";
				$appendRow .= "<img src='" . static_asset('default-image/video-icon.svg') . " ' alt='video-icon' >";
				$appendRow .= "</div>";
			elseif ($post->post_type == "audio"):
				$appendRow .= "<div class='video-icon large-block'>";
				$appendRow .= "<img src='" . static_asset('default-image/audio-icon.svg') . " ' alt='audio-icon' >";
				$appendRow .= "</div>";
			endif;
			$appendRow .= "<div class='category'>";
		
			$appendRow .= "</div>";
			$appendRow .= "</div>";
			$appendRow .= "<div class='entry-content align-self-center'>";
			$appendRow .= "<h3 class='entry-title d_-0999'>";
			if($post->old_id) {
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ]) . "'>" . \Illuminate\Support\Str::limit($post->title, 130) . " ";				 
			}else{ 				 
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug ]) . "'>" . \Illuminate\Support\Str::limit($post->title, 130) . " ";
			}
			// $appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug]) . " '> " . \Illuminate\Support\Str::limit($post->title, 130) . " ";
			$appendRow .= "</a>";
			$appendRow .= "</h3>";

			$appendRow .= "<div class='entry-meta mb-2 fhf'>";
			$appendRow .= "<ul class='global-list'>";
			
			$appendRow .= "<li>" . $post->updated_at->format('F j, Y') . "</li>";
			$appendRow .= "</ul>";
			$appendRow .= "</div> ";
			$appendRow .= "</div>";
			$appendRow .= "</div>";
			$appendRow .= "</div>";

			$allPosts[] = $appendRow;
		}
		return response()->json([$allPosts, $hideReadMore]);
	}

	public function getReadMorePost(Request $request)
	{
		$skip = $request->last_id * 6;
		$postCount = Post::where('visibility', 1)
			->where('status', 1)
			->when(Sentinel::check() == false, function ($query) {
				$query->where('auth_required', 0);
			})
			->orderBy('updated_at', 'desc')
			->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->count();
		$hideReadMore = 0;
		if ($skip >= $postCount) {
			$hideReadMore = 1;
		}
		$posts = Post::with(['image', 'user', 'category'])->where('visibility', 1)
			->where('status', 1)
			->when(Sentinel::check() == false, function ($query) {
				$query->where('auth_required', 0);
			})
			->orderBy('updated_at', 'desc')
			->limit(6)
			->skip($skip)
			->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->get();


		$allPosts = [];
		foreach ($posts as $post) {
			$appendRow = '';
			$appendRow .= "<div class='col-md-4'>";
			$appendRow .= "<div class='sg-post medium-post-style-1'>";
			$appendRow .= "<div class='entry-header'>";
			$appendRow .= "<div class='entry-thumbnail'>";
			// $appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug]) . "'>";
			if($post->old_id) {
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ]) . "'>";				 
			}else{ 				 
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug ]) . "'>";
			}

			if (isFileExist($post->image, $result = @$post->image->original_image)) {
				$appendRow .= "<img  src=' " . basePath($post->image) . '/' . $result . " ' class='img-fluid'   alt='" . $post->title . "  '>";
			} else {
				$appendRow .= "<img src='" . static_asset('default-image/default-240x160.png') . " '  class='img-fluid'   alt='" . $post->title . "' >";
			}
			$appendRow .= "</a>";
			$appendRow .= "</div>";
			if ($post->post_type == "video"):
				$appendRow .= "<div class='video-icon large-block'>";
				$appendRow .= "<img src='" . static_asset('default-image/video-icon.svg') . " ' alt='video-icon' >";
				$appendRow .= "</div>";
			elseif ($post->post_type == "audio"):
				$appendRow .= "<div class='video-icon large-block'>";
				$appendRow .= "<img src='" . static_asset('default-image/audio-icon.svg') . " ' alt='audio-icon' >";
				$appendRow .= "</div>";
			endif;
			
			$appendRow .= "</div>";
			$appendRow .= "<div class='entry-content align-self-center'>";
			$appendRow .= "<h3 class='entry-title d_-0999'>";
			if($post->old_id) {
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ]) . "'>" . \Illuminate\Support\Str::limit($post->title, 130) . " ";				 
			}else{ 				 
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug ]) . "'>" . \Illuminate\Support\Str::limit($post->title, 130) . " ";
			}
			// $appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug]) . " '> " . \Illuminate\Support\Str::limit($post->title, 130) . " ";
			$appendRow .= "</a>";
			$appendRow .= "</h3>";

			$appendRow .= "<div class='entry-meta mb-2 fhf'>";
			$appendRow .= "<ul class='global-list'>";
		
			$appendRow .= "<li>" . $post->updated_at->format('F j, Y') . "</li>";
			$appendRow .= "</ul>";
			$appendRow .= "</div> ";
			$appendRow .= "</div>";
			$appendRow .= "</div>";
			$appendRow .= "</div>";

			$allPosts[] = $appendRow;
		}
		return response()->json([$allPosts, $hideReadMore]);
	}

	public function getReadMorePostProfile(Request $request)
	{
		$skip = $request->last_id_profile * 12;
		$author_id = $request->author_id;
		$postCount = Post::where('user_id', $author_id)->where('visibility', 1)
			->where('status', 1)
			->when(Sentinel::check() == false, function ($query) {
				$query->where('auth_required', 0);
			})
			->orderBy('updated_at', 'desc')
			->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->count();
		$hideReadMore = 0;
		if ($skip >= $postCount) {
			$hideReadMore = 1;
		}
		$articles = Post::with(['image', 'user', 'category'])->where('visibility', 1)
			->where('status', 1)
			->when(Sentinel::check() == false, function ($query) {
				$query->where('auth_required', 0);
			})
			->orderBy('updated_at', 'desc')
			->limit(12)
			->skip($skip)
			->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->get();


		$allPosts = [];

		foreach ($articles as $post) {
			$appendRow = "<div class='col-lg-4'>";
			$appendRow .= "<div class='sg-post'>";
			$appendRow .= "<div class='entry-header'>";
			$appendRow .= "<div class='entry-thumbnail'>";
			// $appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug]) . "'>";
			if($post->old_id) {
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ]) . "'>";				 
			}else{ 				 
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug ]) . "'>";
			}

			if (isFileExist($post->image, $result = @$post->image->original_image)):

				$appendRow .= "<img  src=' " . basePath($post->image) . '/' . $result . " ' data-original=' " . basePath($post->image) . '/' . $result . " ' class='img-fluid'   alt='" . $post->title . "  '>";
			else:
				$appendRow .= "<img src='" . static_asset('default-image/default-358x215.png') . " '  class='img-fluid'   alt='" . $post->title . "' >";
			endif;

			$appendRow .= " </a>";
			$appendRow .= "</div>";
			$appendRow .= "<div class='category'>";
			$appendRow .= "<ul class='global-list'>";
			if ($post->category != "") :
				$appendRow .= "<li><a  class=".$post->category->slug." href='" . url('category', $post->category->slug) . "'> " . $post->category->category_name . "</a></li>";
			endif;
			$appendRow .= " </ul>";
			$appendRow .= "</div>";
			if ($post->post_type == "video"):
				$appendRow .= "<div class='video-icon large-block'>";
				$appendRow .= "<img src='" . static_asset('default-image/video-icon.svg') . " ' alt='video-icon' >";
				$appendRow .= "</div>";
			elseif ($post->post_type == "audio"):
				$appendRow .= "<div class='video-icon large-block'>";
				$appendRow .= "<img src='" . static_asset('default-image/audio-icon.svg') . " ' alt='audio-icon' >";
				$appendRow .= "</div>";
			endif;
			$appendRow .= "</div>";

			$appendRow .= "<div class='entry-content'>";
			$appendRow .= "<h3 class='entry-title d_-0999'>";
			if($post->old_id) {
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ]) . "'>" . \Illuminate\Support\Str::limit($post->title, 130) . " ";				 
			}else{ 				 
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug ]) . "'>" . \Illuminate\Support\Str::limit($post->title, 130) . " ";
			}
			// $appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug]) . " '> " . \Illuminate\Support\Str::limit($post->title, 130) . " ";
			$appendRow .= "</a>";
			$appendRow .= "</h3>";

			$appendRow .= "<div class='entry-meta mb-2 fhf'>";
			$appendRow .= "<ul class='global-list'>";
			$appendRow .= "<li>" . $post->updated_at->format('F j, Y') . "</li>";
			$appendRow .= "</ul>";
			$appendRow .= "</div> ";
			$appendRow .= "</div>";
			$appendRow .= "</div>";
			$appendRow .= "</div>";
			$allPosts[] = $appendRow;
		}

		return response()->json([$allPosts, $hideReadMore]);
	}

    public function getReadMorePostSearch(Request $request)
    {

        $skip = $request->last_id * 6;
        // $postCount = Post::where('title', 'like', '%' . $request->search . '%')->where('visibility', 1)
        //     ->where('status', 1)
        //     ->when(Sentinel::check() == false, function ($query) {
        //         $query->where('auth_required', 0);
        //     })
        //     ->orderBy('updated_at', 'desc')
        //     ->count();
		$Serah = $request->search;
		if (isset($Serah)) {		
			$postCount = Post::where(DB::raw('LOWER(title)'), 'like', '%' . $request->search . '%')
		->where('visibility', 1)
		// ->where('category_id', 'not like', "%24%")
		// ->where('category_id', 'not like', "%21%")
		// ->where('category_id', 'not like', "%27%")
		// ->where('category_id', 'not like', "%28%")
		// ->where('category_id', 'not like', "%29%")
		// ->where('category_id', 'not like', "%31%")
			->when(Sentinel::check() == false, function ($query) {
				$query->where('auth_required', 0);
			})->count();
			

        $hideReadMore = 0;
        if ($skip >= $postCount) {
            $hideReadMore = 1;
        }
        // $posts = Post::with(['image', 'user'])->where('title', 'like', '%' . $request->search . '%')->where('visibility', 1)
        //     ->where('status', 1)
        //     ->when(Sentinel::check() == false, function ($query) {
        //         $query->where('auth_required', 0);
        //     })
        //     ->orderBy('updated_at', 'desc')
        //     ->limit(6)->skip($skip)->get();

		$posts = Post::with(['image', 'user'])->where(DB::raw('LOWER(title)'), 'like', '%' . $request->search . '%')
			->where('visibility', 1)
			->when(Sentinel::check() == false, function ($query) {
				$query->where('auth_required', 0);
			})
			// ->where('category_id', 'not like', "%24%")
			// ->where('category_id', 'not like', "%21%")
			// ->where('category_id', 'not like', "%27%")
			// ->where('category_id', 'not like', "%28%")
			// ->where('category_id', 'not like', "%29%")
			// ->where('category_id', 'not like', "%31%")
			->orderBy('updated_at', 'desc')
			->limit(6)->skip($skip)->get();
		}else{
			$postCount = Post::where(DB::raw('LOWER(title)'), 'like', '%' . $request->search . '%')
		->where('visibility', 1)
		->where('category_id', 'not like', "%24%")
		->where('category_id', 'not like', "%21%")
		->where('category_id', 'not like', "%27%")
		->where('category_id', 'not like', "%28%")
		->where('category_id', 'not like', "%29%")
		->where('category_id', 'not like', "%31%")
		->where('category_id', 'not like', "%32%")
		->where('category_id', 'not like', "%22%")
			->when(Sentinel::check() == false, function ($query) {
				$query->where('auth_required', 0);
			})->count();
			

        $hideReadMore = 0;
        if ($skip >= $postCount) {
            $hideReadMore = 1;
        }
        // $posts = Post::with(['image', 'user'])->where('title', 'like', '%' . $request->search . '%')->where('visibility', 1)
        //     ->where('status', 1)
        //     ->when(Sentinel::check() == false, function ($query) {
        //         $query->where('auth_required', 0);
        //     })
        //     ->orderBy('updated_at', 'desc')
        //     ->limit(6)->skip($skip)->get();

		$posts = Post::with(['image', 'user'])->where(DB::raw('LOWER(title)'), 'like', '%' . $request->search . '%')
			->where('visibility', 1)
			->when(Sentinel::check() == false, function ($query) {
				$query->where('auth_required', 0);
			})
			->where('category_id', 'not like', "%24%")
			->where('category_id', 'not like', "%21%")
			->where('category_id', 'not like', "%27%")
			->where('category_id', 'not like', "%28%")
			->where('category_id', 'not like', "%29%")
			->where('category_id', 'not like', "%31%")
			->where('category_id', 'not like', "%32%")
			->where('category_id', 'not like', "%22%")
			->orderBy('updated_at', 'desc')
			->limit(6)->skip($skip)->get();
		}

		


        $allPosts = [];
        foreach ($posts as $post) {
            $appendRow = '';
            $appendRow .= "<div class='col-md-4'>";
            $appendRow .= "<div class='sg-post medium-post-style-1'>";
            $appendRow .= "<div class='entry-header'>";
            $appendRow .= "<div class='entry-thumbnail'>";
            // $appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug]) . "'>";

			if($post->old_id) {
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ]) . "'>";				 
			}else{ 				 
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug ]) . "'>";
			}

            if (isFileExist($post->image, $result = @$post->image->original_image)) {
                $appendRow .= "<img  src=' " . basePath($post->image) . '/' . $result . " ' class='img-fluid'   alt='" . $post->title . "  '>";
            } else {
                $appendRow .= "<img src='" . static_asset('default-image/default-240x160.png') . " '  class='img-fluid'   alt='" . $post->title . "' >";
            }
            $appendRow .= "</a>";
            $appendRow .= "</div>";
            if ($post->post_type == "video"):
                $appendRow .= "<div class='video-icon large-block'>";
                $appendRow .= "<img src='" . static_asset('default-image/video-icon.svg') . " ' alt='video-icon' >";
                $appendRow .= "</div>";
            elseif ($post->post_type == "audio"):
                $appendRow .= "<div class='video-icon large-block'>";
                $appendRow .= "<img src='" . static_asset('default-image/audio-icon.svg') . " ' alt='audio-icon' >";
                $appendRow .= "</div>";
            endif;
            $appendRow .= "<div class='category'>";
          
            $appendRow .= "</div>";
            $appendRow .= "</div>";
            $appendRow .= "<div class='entry-content align-self-center'>";
            $appendRow .= "<h3 class='entry-title d_-0999'>";
			if($post->old_id) {
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ]) . "'>" . \Illuminate\Support\Str::limit($post->title, 130) . " ";				 
			}else{ 				 
				$appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug ]) . "'>" . \Illuminate\Support\Str::limit($post->title, 130) . " ";
			}
            // $appendRow .= "<a href=' " . route('article.detail', ['id' => $post->id, 'slug' => $post->slug]) . " '> " . \Illuminate\Support\Str::limit($post->title, 130) . " ";
            $appendRow .= "</a>";
            $appendRow .= "</h3>";

            $appendRow .= "<div class='entry-meta mb-2 fhf'>";
            $appendRow .= "<ul class='global-list'>";
           
            $appendRow .= "<li>" . $post->updated_at->format('F j, Y') . "</li>";
            $appendRow .= "</ul>";
            $appendRow .= "</div> ";
         
            $appendRow .= "</div>";
            $appendRow .= "</div>";
            $appendRow .= "</div>";

            $allPosts[] = $appendRow;
        }
        return response()->json([$allPosts, $hideReadMore]);

    }

}
