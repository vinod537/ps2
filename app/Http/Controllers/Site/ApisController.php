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

class ApisController extends Controller
{
	public function show($id='',$slug='')
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

	                    }elseif($key == 'ads' && $key != ""){

	                        $ads_info = Ad::find($item);

	                        if($ads_info->ad_type == 'image'){

	                            $detail = galleryImage::find($ads_info->ad_image_id);

	                        }elseif($ads_info->ad_type == 'code'){

	                            $detail = $ads_info->ad_code;

	                        }elseif($ads_info->ad_type == 'text'){

	                            $detail = $ads_info->ad_text;
	                        }

	                        $abc[] = [$key => $item, 'ads_type' => $ads_info->ad_type, 'detail' => $detail];
	                    }else{
	                        $abc[] = [$key => $item];
	                    }
	                }
	                $post_contents[] =[$content_type[0] => $abc];
	            }
	        }
	    endif;

		$categoryWithPost = Category::with(['post' => function ($query) use ($post) {
			return $query->limit(40)->orderBy('updated_at', 'desc')->where('id', '!=', $post->id);
		}])->find($post->category_id);

		// dd($post->category_id);
		$categoryName = '';
		if ($categoryWithPost) {
			$categoryName = $categoryWithPost->category_name;
		}

		// // echo $value;
		// 	// DB::enableQueryLog();

		// 	$AllPostByCompany = Post::with(['image'])
		// 	->where('company_name', 'like', "%$value%")
		// 	->where('id', '!=', $post->id)
		// 	->get();
		// 	// $quries = DB::getQueryLog();


		// Get relatedPost by  company_name 
		$comname =  explode(',', $post->company_name);
		$getAllPosts = [];
		foreach ($comname as $key => $value) {
			$AllPostByCompany = Post::with(['image'])
			->where('company_name', 'like', "%$value%")
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();				
			array_push($getAllPosts, $AllPostByCompany);
		}

		// Get relatedPost by  product 
		$productname =  explode(',', $post->product);
		foreach ($productname as $key => $value) {
			$AllPostProduct = Post::with(['image'])
			->where('product', 'like', "%$value%")
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
		if ($post->post_type == "audio"):
			foreach ($post->audio as $key => $audio):
				$audios_array[] =
					array(
						'track' => $key + 1,
						'name' => $audio->audio_name,
						'disk' => $audio->disk,
						'file' => $audio->original,
					);
			endforeach;
			if (!isset($audios_array)):
				$audios_array[] = array();
			endif;
		else:
			$audios_array[] = array();
		endif;

		// $tracks = json_encode($audios_array);
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




	

    public function search(Request $request)
    {		
        try{
            $posts = Post::with(['image', 'user'])->where(DB::raw('LOWER(title)'), 'like', '%' . strtolower($request->get('search')) . '%')->where('visibility', 1)
                ->when(Sentinel::check() == false, function ($query) {
                    $query->where('auth_required', 0);
                })
				->orderBy('updated_at', 'desc')
                ->paginate(50);

				if($posts){
					return response()->json([$posts]);
				}else{
					return response()->json(['error'=> '404']);
				}
           
        } catch (\Exception $e) {
			return response()->json(['error'=> '404']);

        }
    }



    public function allcategory(Request $request)
    {
        try{
            $posts = Category::with(['image'])
			->orderBy('updated_at', 'desc')
                ->paginate(30);

				if($posts){
					return response()->json([$posts]);
				}else{
					return response()->json(['error'=> '404']);
				}
           
        } catch (\Exception $e) {
			return response()->json(['error'=> '404']);

        }
    }





	public function SearchByCategory($slug)
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
				->paginate(30);
				if($posts){
					return response()->json([$posts]);
				}else{
					return response()->json(['error'=> '404']);
				}
				
		} catch (\Exception $e) {
			return response()->json(['error'=> '404']);
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
			$appendRow .= "<li><a href='" . route('article.date', date('Y-m-d', strtotime($post->updated_at))) . "'> " . $post->updated_at->format('F j, Y') . "</a></li>";
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
			
			$appendRow .= "<li><a href='" . route('article.date', date('Y-m-d', strtotime($post->updated_at))) . "'> " . $post->updated_at->format('F j, Y') . "</a></li>";
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
		
			$appendRow .= "<li><a href='" . route('article.date', date('Y-m-d', strtotime($post->updated_at))) . "'> " . $post->updated_at->format('F j, Y') . "</a></li>";
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
			$appendRow .= "<li><a href='" . route('article.date', date('Y-m-d', strtotime($post->updated_at))) . "'> " . $post->updated_at->format('F j, Y') . "</a></li>";
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


		$postCount = Post::where(DB::raw('LOWER(title)'), 'like', '%' . $request->search . '%')
		->where('visibility', 1)
		// ->where('category_id', 'not like', "%24%")
		// ->where('category_id', 'not like', "%21%")
		// ->where('category_id', 'not like', "%27%")
		// ->where('category_id', 'not like', "%28%")
		// ->where('category_id', 'not like', "%29%")
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
			->orderBy('updated_at', 'desc')
			->limit(6)->skip($skip)->get();


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
           
            $appendRow .= "<li><a href='" . route('article.date', date('Y-m-d', strtotime($post->updated_at))) . "'> " . $post->updated_at->format('F j, Y') . "</a></li>";
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
