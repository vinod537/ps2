<?php

namespace Modules\Api\Http\Controllers;

use App\Traits\ApiReturnFormat;
use App\Traits\PostAttributeSetTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Modules\Post\Entities\Category;
use Modules\Gallery\Entities\Image;
use Modules\User\Entities\User;
use JWTAuth;
use Modules\Post\Entities\Post;
use Illuminate\Support\Facades\Validator;
use Sentinel;

class CategoryController extends Controller
{
    use ApiReturnFormat;
    use PostAttributeSetTrait;

    public function discover(Request $request)
    {
        $language   = $request->lang ?? settingHelper('default_language');

        $recommended_categories = Category::whereHas('post', function (Builder $query) use ($language){
                                        $query->where('category_id', '!=', '')
                                            ->where('language',$language)
                                            ->where('recommended',1)
                                            ->where('status', 1)
                                            ->where('visibility', 1);
                                    })->select('id','category_name','image_id_api','slug')->get();

        foreach ($recommended_categories as $recommended):
            $recommended['image'] =  static_asset('default-image/default-123x83.png');
        endforeach;

        $data['recommended_categories'] = $recommended_categories ?? '';

        $featured_categories = Category::whereHas('post', function (Builder $query) use ($language){
                                        $query->where('category_id', '!=', '')
                                            ->where('language',$language)
                                            ->where('featured',1)
                                            ->where('status', 1)
                                            ->where('visibility', 1);
                                        })->select('id','category_name','image_id_api','slug')->get();

        foreach ($featured_categories as $featured):
            $featured['image'] =  static_asset('default-image/default-123x83.png');
        endforeach;

        $data['featured_categories'] = $featured_categories ?? '';

        // $discover_by_categories = Category::with('subCategory:id,sub_category_name,category_id')
        $discover_by_categories = Category::where('language',$language)
                                            ->get(['id','image_id_api', 'category_name']);

        $data['discover_by_categories'] = $discover_by_categories;

        return $this->responseWithSuccess(__('successfully_found'), $data, 200);
    }


    public function category(Request $request)
    {
        $language   = $request->lang ?? settingHelper('default_language');

        
        $discover_by_categories = Category::with('subCategory:id,sub_category_name,category_id')
                                            ->where('language',$language)
                                            ->get(['id', 'category_name','slug','created_at','image_id','image_id_api']);

        // $data['discover_by_categories'] = $discover_by_categories;

        $user = JWTAuth::parseToken()->authenticate();
       // dd($user);
        if($user->user_intrest !== '' && $user->user_intrest !== null){
          //  echo "fds";
            $userIntrest = json_decode($user->user_intrest);
        }else{
            $userIntrest = [];
        }

       // dd($userIntrest);
      
        $allcategories = [];
        foreach ($discover_by_categories as $key => $value) { 
            //dd($value->image_id_api->original_image);
            $imagesDetail = Image::where('id', $value->image_id_api)->first();
          
            if($imagesDetail){
                $image =    static_asset($imagesDetail->original_image);
            }else{
                $image =  static_asset('default-100x100.png');
            }
           
            $data['id'] = $value->id;
            $data['category_name'] = $value->category_name;
            $data['image'] = $image;
            $data['slug'] = $value->slug;
            $data['created_at'] = $value->created_at;

            if (in_array($value->id, $userIntrest)) {
               $data['is_intrested'] = 1;
            }else{
               $data['is_intrested'] = 0;
            }
            array_push($allcategories, $data);  
        }

        $dataUser['discover_by_user'] = $allcategories;
        return $this->responseWithSuccess(__('successfully_found'), $dataUser, 200);
    }


    public function CategoryWithPost(Request $request)
    {
        $language   = $request->lang ?? settingHelper('default_language');

        
        $discover_by_categories = Category::with('subCategory:id,sub_category_name,category_id')
                                            ->where('language',$language)
                                            ->get(['id', 'category_name','slug','created_at','image_id_api','image_id']);

        // $data['discover_by_categories'] = $discover_by_categories;

        $user = JWTAuth::parseToken()->authenticate();
        if($user->user_intrest != '' && $user->user_intrest != null){
            $userIntrest = json_decode($user->user_intrest);
        }else{
            $userIntrest = [];
        }
      
      
        $allcategories = [];
        $categorydetail = [];
        foreach ($discover_by_categories as $key => $value) { 
           
            $category_id = $value->id;

            $language   = $request->lang ?? settingHelper('default_language');
            $page   = $request->page ?? 1;
            $offset = ( $page * 15 ) - 15;
            $limit  = 4;

            $posts = Post::with('image','user:id,first_name,last_name')
                ->where('visibility', 1)
                ->where('status', 1)
                ->where('language',$language)
                ->when(Sentinel::check() == false, function ($query) {
                    $query->where('auth_required', 0);
                })
                ->where('category_id', 'like', '%"' . $category_id . '"%') 
       
                ->select('id','old_id','category_id','press_release_link','image_id','user_id','title','title2','slug','slug2','content','content2','daily_news','post_type','tags','product2','company_name2','created_at')
                ->orderBy('id', 'desc')
                ->offset($offset)
                ->take($limit)
                ->get();
            
                $imagesDetail = Image::where('id', $value->image_id_api)->first();
          
                if($imagesDetail){
                    $image =    static_asset($imagesDetail->original_image);
                }else{
                    $image =  static_asset('default-100x100.png');
                }
            
            
            $data['id'] = $value->id;
            $data['category_name'] = $value->category_name;
            $data['image'] = $image;
            $data['slug'] = $value->slug;
            if (in_array($value->id, $userIntrest)) {
                $data['is_intrested'] = 1;
             }else{
                $data['is_intrested'] = 0;
             }
            $data['created_at'] = $value->created_at;
            
            $posts = $this->imageUrlset($this->commentsCount($this->dateToHuman($posts)));
            $data['posts'] =  $this->AllPostsWithCategoriesDetails($posts);

           
            array_push($allcategories, $data); 
            
        }

        $dataUser['discover_by_user'] = $allcategories;

        return $this->responseWithSuccess(__('successfully_found'), $dataUser, 200);
    }



    public function discoverUserIntrestPosts(Request $request)
    {
        $language   = $request->lang ?? settingHelper('default_language');
        $page   = $request->page ?? 1;
        $offset = ( $page * 15 ) - 15;
        $limit  = 10;

        $user = JWTAuth::parseToken()->authenticate();
        if($user->user_intrest != '' && $user->user_intrest != null){
            $userIntrest = json_decode($user->user_intrest);
        }else{
            $userIntrest = [];
        }

        $posts = Post::with('image','user:id,first_name,last_name')
                //->where('category_id', $request->category)
                ->where('visibility', 1)
                ->where('status', 1)
                ->where('language',$language)
                ->when(Sentinel::check() == false, function ($query) {
                    $query->where('auth_required', 0);
                })
                ->where('category_id', 'not like', "%24%")
				->where('category_id', 'not like', "%21%")
				->where('category_id', 'not like', "%27%")
				->where('category_id', 'not like', "%28%")
				->where('category_id', 'not like', "%29%")
				->where('category_id', 'not like', "%31%")
				->orderBy('updated_at', 'desc')
                ->when($userIntrest, function ($query) use ($userIntrest){
                    if(count($userIntrest) > 0){

                        foreach ($userIntrest as $key => $category_id) {
                            if($key == 0){
                                $query->where('category_id', 'like', '%"' . $category_id . '"%');
                            }else{
                                $query->orWhere('category_id', 'like', '%"' . $category_id . '"%');
                            }                        
                        } 
                    }                   
                })                
                ->select('id','old_id','category_id','press_release_link','image_id','user_id','title','title2','slug','slug2','content','content2','daily_news','post_type','tags','product2','company_name2','created_at')
                ->orderBy('id', 'desc')
                ->offset($offset)
                ->take($limit)
                ->get();


        $posts =    $this->imageUrlset($this->commentsCount($this->dateToHuman($posts)));
        $posts =  $this->AllPostsWithCategoriesDetails($posts);

        return $this->responseWithSuccess(__('successfully_found'), $posts, 200);
    }


    public function DailyNews(Request $request)
    {
        $language   = $request->lang ?? settingHelper('default_language');
        $page   = $request->page ?? 1;
        $offset = ( $page * 15 ) - 15;
        $limit  = 6;

        $user = JWTAuth::parseToken()->authenticate();
        if($user->user_intrest != '' && $user->user_intrest != null){
            $userIntrest = json_decode($user->user_intrest);
        }else{
            $userIntrest = [];
        }

        $posts = Post::with('image','user:id,first_name,last_name')
                //->where('category_id', $request->category)
                ->where('visibility', 1)
                ->where('status', 1)
                ->where('daily_news', 1)
                ->where('language',$language)
                ->when(Sentinel::check() == false, function ($query) {
                    $query->where('auth_required', 0);
                })               
				->orderBy('updated_at', 'desc')
                          
                ->select('id','old_id','category_id','press_release_link','image_id','user_id','title','title2','slug','slug2','content','content2','daily_news','post_type','tags','product2','company_name2','created_at')
                ->orderBy('id', 'desc')
                ->offset($offset)
                ->take($limit)
                ->get();


        $posts =    $this->imageUrlset($this->commentsCount($this->dateToHuman($posts)));
        $posts =  $this->AllPostsWithCategoriesDetails($posts);

        return $this->responseWithSuccess(__('successfully_found'), $posts, 200);
    }


    
    public function show($id='', $slug='')
	{
		
		$post = Post::with(['image', 'comments' => function ($query) {
			return $query->whereNull('comment_id');
		}, 'comments.reply.user', 'comments.user'])
			->where('slug', $slug)->first();

	

		$post  = Post::with(['image','quizQuestions','quizQuestions.quizAnswers','quizResults','comments'=> function ($query) {
										return $query->whereNull('comment_id');
									}, 'comments.reply.user', 'comments.user'])
									->where('slug', $slug)->first();

		$comname =  explode(',', $post->company_name2);
		$getAllPosts = [];
		foreach ($comname as $key => $value) {
			$AllPostByCompany = Post::with(['image'])
			->where('company_name2', 'like', "%$value%")
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
            ->limit(10)
			->get();				
			array_push($getAllPosts, $AllPostByCompany);
		}
        
		// Get relatedPost by  product 
        if(count($getAllPosts[0]) < 20){
            $productname =  explode(',', $post->product2);
            foreach ($productname as $key => $value) {
                $AllPostProduct = Post::with(['image'])
                ->where('product2', 'like', "%$value%")
                ->where('id', '!=', $post->id)
                ->orderBy('updated_at', 'desc')
                ->limit(10)
                ->get();				
                array_push($getAllPosts, $AllPostProduct);
            }
        }
      
		
		// Get relatedPost by  tags
        if(count($getAllPosts[0]) < 20){ 
            $tagsname =  explode(',', $post->tags);
            foreach ($tagsname as $key => $value) {
                $AllPosttags = Post::with(['image'])
                ->where('tags', 'like', "%$value%")
                ->where('id', '!=', $post->id)
                ->orderBy('updated_at', 'desc')
                ->limit(10)
                ->get();				
                array_push($getAllPosts, $AllPosttags);
            }
		}
        
		$AllPostBycategory = Post::with(['image'])
			->whereJsonContains('category_id', ["$post->category_id"])
			->where('id', '!=', $post->id)
			->orderBy('updated_at', 'desc')
			->get();
			
		$getAllPostsSameCategory=[];
		if(in_array("24", json_decode($post->category_id))){
            if(count($getAllPosts[0]) < 20){
                $AllPostBycategory1 = Post::with(['image'])
                ->whereJsonContains('category_id', ["24"])
                ->where('id', '!=', $post->id)
                ->orderBy('updated_at', 'desc')
                ->limit(10)
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
           


		}
		elseif(in_array("21", json_decode($post->category_id))){
            if(count($getAllPosts[0]) < 20){
                $AllPostBycategory1 = Post::with(['image'])
                ->whereJsonContains('category_id', ["21"])
                ->where('id', '!=', $post->id)
                ->limit(10)
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
		}
		elseif(in_array("22", json_decode($post->category_id))){
            if(count($getAllPosts[0]) < 20){
                $AllPostBycategory1 = Post::with(['image'])
                ->whereJsonContains('category_id', ["22"])
                ->where('id', '!=', $post->id)
                ->limit(10)
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
		}
		elseif(in_array("27", json_decode($post->category_id))){
            if(count($getAllPosts[0]) < 20){
                $AllPostBycategory1 = Post::with(['image'])
                ->whereJsonContains('category_id', ["27"])
                ->where('id', '!=', $post->id)
                ->limit(10)
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
		}
		elseif(in_array("28", json_decode($post->category_id))){
            if(count($getAllPosts[0]) < 20){
                $AllPostBycategory1 = Post::with(['image'])
                ->whereJsonContains('category_id', ["28"])
                ->limit(10)
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
		}
		elseif(in_array("29", json_decode($post->category_id))){
            if(count($getAllPosts[0]) < 20){
                $AllPostBycategory1 = Post::with(['image'])
                ->whereJsonContains('category_id', ["29"])
                ->limit(10)
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
        $getAllPosts =  $this->imageUrlset($this->commentsCount($this->dateToHuman($getAllPosts)));
        $getAllPosts =  $this->AllPostsWithCategoriesDetails($getAllPosts);
        $postsData = [       
            'total'=>count($getAllPosts),        
            'relatedPost'=>$getAllPosts,
            
        ];                
        return $this->responseWithSuccess(__('successfully_found'),$postsData,200);
    }

    
    public function discoverRecommendedPosts(Request $request)
    {
        $language   = $request->lang ?? settingHelper('default_language');

        $page   = $request->page ?? 1;

        $offset = ( $page * 15 ) - 15;
        $limit  = 15;

        $posts = Post::with('image','user:id,first_name,last_name')
                ->where('category_id', $request->category)
                ->where('visibility', 1)
                ->where('status', 1)
                ->where('recommended',1)
                ->where('language',$language)
                ->when(Sentinel::check() == false, function ($query) {
                    $query->where('auth_required', 0);
                })
                ->select('id','category_id','press_release_link','image_id','user_id','title','slug','post_type','tags','created_at')
                ->orderBy('id', 'desc')
                ->offset($offset)
                ->take($limit)
                ->get();

        $posts = $this->imageUrlset($this->commentsCount($this->dateToHuman($posts)));


        return $this->responseWithSuccess(__('successfully_found'), $posts, 200);
    }



    public function discoverFeaturedPosts(Request $request)
    {
        $language   = $request->lang ?? settingHelper('default_language');

        $page   = $request->page ?? 1;

        $offset = ( $page * 15 ) - 15;
        $limit  = 15;

        $posts = Post::with('image','user:id,first_name,last_name')
                ->where('category_id', $request->category)
                ->where('visibility', 1)
                ->where('status', 1)
                ->where('featured',1)
                ->where('language',$language)
                ->when(Sentinel::check() == false, function ($query) {
                    $query->where('auth_required', 0);
                })
                ->select('id','category_id','press_release_link','image_id','user_id','title','slug','post_type','tags','created_at')
                ->orderBy('id', 'desc')
                ->offset($offset)
                ->take($limit)
                ->get();

        $posts = $this->imageUrlset($this->commentsCount($this->dateToHuman($posts)));

        return $this->responseWithSuccess(__('successfully_found'), $posts, 200);
    }
}
