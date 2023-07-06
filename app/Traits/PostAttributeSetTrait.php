<?php

 namespace App\Traits;

 use Carbon\Carbon;
 use Illuminate\Support\Facades\Config;
 use Illuminate\Support\Facades\Validator;
 use Modules\Gallery\Entities\Image as galleryImage;
 use Modules\Gallery\Entities\Video;
 use Modules\Post\Entities\Comment;
 use Modules\Gallery\Entities\Image;
 use Modules\Post\Entities\Category;
 use JWTAuth;


 trait PostAttributeSetTrait
 {
     protected function commentsCount($posts){
         foreach ($posts as $post):
             $post->commentsCount = Comment::where('post_id', $post->id)->where('comment_id', '=' , null)->count();
             $user = JWTAuth::parseToken()->authenticate();
            
             if(in_array($post->id, json_decode($user->user_intrest_bookmark))){                   
                $post->is_bookmarked = 1;
            }else{
                $post->is_bookmarked = 0;
            }          
         endforeach;

         return $posts;
     }


     protected function AllPostsWithCategoriesDetails($postdetilss){
       
        $AllPOSt = [];        
         foreach ($postdetilss as $postdetils):
           
                $postdetilsdetail = json_decode($postdetils->category_id);
                $caategories = array(); 
                foreach ($postdetilsdetail as $key => $value) {
                    $CatDetail  =  Category::with('image')->where('id',$value)->first();  

                   $imagesDetail = Image::where('id', $CatDetail->image_id_api)->first();         
          
                    if($imagesDetail){
                        $image =    static_asset($imagesDetail->original_image);
                    }else{
                        $image =  static_asset('default-100x100.png');
                    }
                        
                    $data_category['id'] = $CatDetail->id;
                    $data_category['category_name'] = $CatDetail->category_name;
                    $data_category['image'] = $image;
                    $data_category['slug'] = $CatDetail->slug;
                    $data_category['created_at'] = $CatDetail->created_at;

                    array_push($caategories, $data_category);                     
                   
                }              
                
                $data['id'] = $postdetils->id;
                $data['old_id'] = $postdetils->old_id;
                $data['category_id'] = $postdetils->category_id;
                $data['press_release_link'] = $postdetils->press_release_link;
                $data['image_id'] = $postdetils->image_id;
                $data['user_id'] = $postdetils->user_id;
                $data['title'] = $postdetils->title;
                $data['title2'] = $postdetils->title2;
                $data['slug'] = $postdetils->slug;
                $data['slug2'] = $postdetils->slug2;
                $data['content'] = str_replace("<p><strong>Shots:</strong></p>", "",$postdetils->content);
                $data['content2'] = str_replace("<p><strong>Shots:</strong></p>", "",$postdetils->content2);
                $data['daily_news'] = $postdetils->daily_news;
                $data['post_type'] = $postdetils->post_type;
                $data['tags'] = $postdetils->tags;
                $data['product'] = $postdetils->product;
                $data['company_name'] = $postdetils->company_name;
                $data['created'] = $postdetils->created;
                $data['commentsCount'] = $postdetils->commentsCount;
                $data['is_bookmarked'] = $postdetils->is_bookmarked;
                $data['image'] = $postdetils->image;
                $data['video'] = $postdetils->video;
                $data['category'] = $postdetils->category;
                $data['user'] = $postdetils->user;
                $data['categorydetail'] = $caategories;
                
               
                array_push($AllPOSt, $data);
         endforeach;         
         //dd($caategories);
    return $AllPOSt;
     }



     protected function AllPostsWithCategoriesDetailsDealForma($postdetilss){

        $AllPOSt = [];
         foreach ($postdetilss as $postdetils):

                $postdetilsdetail = json_decode($postdetils->category_id);
                $caategories = array();
                foreach ($postdetilsdetail as $key => $value) {
                    $CatDetail  =  Category::with('image')->where('id',$value)->first();

                   $imagesDetail = Image::where('id', $CatDetail->image_id_api)->first();

                    if($imagesDetail){
                        $image =    static_asset($imagesDetail->original_image);
                    }else{
                        $image =  static_asset('default-100x100.png');
                    }

                    $data_category['id'] = $CatDetail->id;
                    $data_category['category_name'] = $CatDetail->category_name;
                    $data_category['image'] = $image;
                    $data_category['slug'] = $CatDetail->slug;
                    $data_category['created_at'] = $CatDetail->created_at;

                    array_push($caategories, $data_category);

                }

                $data['id'] = $postdetils->id;
                $data['category_id'] = $postdetils->category_id;
                $data['image_id'] = $postdetils->image_id;
                $data['user_id'] = $postdetils->user_id;
                $data['title'] = $postdetils->title;
                $data['slug'] = $postdetils->slug;
                $data['url'] = url('/').'/'.$postdetils->id.'/'.$postdetils->slug;
                $data['content'] = str_replace("<p><strong>Shots:</strong></p>", "",$postdetils->content);
                $data['post_type'] = $postdetils->post_type;
                $data['tags'] = $postdetils->tags;
                $data['product'] = $postdetils->product2;
                $data['company_name'] = $postdetils->company_name2;
                $data['created'] = $postdetils->created;
                $data['image'] = $postdetils->image;
                $data['category'] = $postdetils->category;
                $data['user'] = $postdetils->user;
                $data['categorydetail'] = $caategories;


                array_push($AllPOSt, $data);
         endforeach;
         //dd($caategories);
    return $AllPOSt;
     }
     
     protected function dateToHuman($posts){
         foreach ($posts as $post):
           // dd($post);
             if (isset($post->created_at)):
                //$createdAt = Carbon::parse($post->created);
                 $post->created = date('M d, Y', strtotime($post->created_at));
                 
                  //$post->created = Carbon::createFromTimestamp(strtotime($post->created))->toDateTimeString();;
                //   $post->created = Carbon::parse($post->created_at)->diffForHumans();
                  
             endif;

             //unset($post->created_at);

         endforeach;

         return $posts;
     }

     protected function imageUrlset($posts)
     {

         foreach ($posts as $post) {
            
             if (isset($post->image)) {
                 if ($post->image->disk == 's3') {
                     $s3Link = "https://s3." . Config::get('filesystems.disks.s3.region') . ".amazonaws.com/" . Config::get('filesystems.disks.s3.bucket') . "/";

                     $post->image->original_image = $s3Link . $post->image->original_image;
                     $post->image->og_image = $s3Link . $post->image->og_image;
                     $post->image->big_image = $s3Link . $post->image->big_image;
                     $post->image->big_image_two = $s3Link . $post->image->big_image_two;
                     $post->image->medium_image = $s3Link . $post->image->medium_image;
                     $post->image->medium_image_two = $s3Link . $post->image->medium_image_two;
                     $post->image->medium_image_three = $s3Link . $post->image->medium_image_three;
                     $post->image->small_image = $s3Link . $post->image->small_image;
                     $post->image->thumbnail = $s3Link . $post->image->thumbnail;

                 } else {

                     
                   $post->image->original_image = static_asset($post->image->original_image);
                   $post->image->og_image = static_asset($post->image->og_image);
                   $post->image->big_image = static_asset($post->image->big_image);
                   $post->image->big_image_two = static_asset($post->image->big_image_two);
                   $post->image->medium_image = static_asset($post->image->medium_image);
                   $post->image->medium_image_two = static_asset($post->image->medium_image_two);
                   $post->image->medium_image_three = static_asset($post->image->medium_image_three);
                   $post->image->small_image = static_asset($post->image->small_image);
                   $post->image->thumbnail = static_asset($post->image->thumbnail);
             
             
                     $post->image->original_image = str_replace('https://www.pharmashots.com/public/https://www.pharmashots.com/public/','https://www.pharmashots.com/public/',static_asset($post->image->original_image));
                     $post->image->og_image = str_replace('https://www.pharmashots.com/public/https://www.pharmashots.com/public/','https://www.pharmashots.com/public/',static_asset($post->image->og_image));
                     $post->image->big_image = str_replace('https://www.pharmashots.com/public/https://www.pharmashots.com/public/','https://www.pharmashots.com/public/',static_asset($post->image->big_image));
                     $post->image->big_image_two = str_replace('https://www.pharmashots.com/public/https://www.pharmashots.com/public/','https://www.pharmashots.com/public/',static_asset($post->image->big_image_two));
                     $post->image->medium_image = str_replace('https://www.pharmashots.com/public/https://www.pharmashots.com/public/','https://www.pharmashots.com/public/',static_asset($post->image->medium_image));
                     $post->image->medium_image_two = str_replace('https://www.pharmashots.com/public/https://www.pharmashots.com/public/','https://www.pharmashots.com/public/',static_asset($post->image->medium_image_two));
                     $post->image->medium_image_three = str_replace('https://www.pharmashots.com/public/https://www.pharmashots.com/public/','https://www.pharmashots.com/public/',static_asset($post->image->medium_image_three));
                     $post->image->small_image = str_replace('https://www.pharmashots.com/public/https://www.pharmashots.com/public/','https://www.pharmashots.com/public/',static_asset($post->image->small_image));
                     $post->image->thumbnail = str_replace('https://www.pharmashots.com/public/https://www.pharmashots.com/public/','https://www.pharmashots.com/public/',static_asset($post->image->thumbnail));
                     
                     
                     
                     $post->image->original_image = str_replace('https://www.pharmashots.com/public/https://www.pharmashots.com/public/','https://www.pharmashots.com/public/',$post->image->original_image);
                     $post->image->og_image = str_replace('https://www.pharmashots.com/public/https://www.pharmashots.com/public/','https://www.pharmashots.com/public/',$post->image->og_image);
                     $post->image->big_image = str_replace('https://www.pharmashots.com/public/https://www.pharmashots.com/public/','https://www.pharmashots.com/public/',$post->image->big_image);
                     $post->image->big_image_two = str_replace('https://www.pharmashots.com/public/https://www.pharmashots.com/public/','https://www.pharmashots.com/public/',$post->image->big_image_two);
                     $post->image->medium_image = str_replace('https://www.pharmashots.com/public/https://www.pharmashots.com/public/','https://www.pharmashots.com/public/',$post->image->medium_image);
                     $post->image->medium_image_two = str_replace('https://www.pharmashots.com/public/https://www.pharmashots.com/public/','https://www.pharmashots.com/public/',$post->image->medium_image_two);
                     $post->image->medium_image_three = str_replace('https://www.pharmashots.com/public/https://www.pharmashots.com/public/','https://www.pharmashots.com/public/',$post->image->medium_image_three);
                     $post->image->small_image = str_replace('https://www.pharmashots.com/public/https://www.pharmashots.com/public/','https://www.pharmashots.com/public/',$post->image->small_image);
                     $post->image->thumbnail = str_replace('https://www.pharmashots.com/public/https://www.pharmashots.com/public/','https://www.pharmashots.com/public/',$post->image->thumbnail);
                 }

                 unset($post->image->id);
                 unset($post->image->disk);
                // unset($post->image->created_at);
                 //unset($post->image->updated_at);
                 
             }


         }
        
         return $posts;
     }

     protected function get_image($image){
         if ($image->disk == 's3') {
             $s3Link = "https://s3." . Config::get('filesystems.disks.s3.region') . ".amazonaws.com/" . Config::get('filesystems.disks.s3.bucket') . "/";

             $image->original_image = $s3Link . $image->original_image;
             $image->og_image = $s3Link . $image->og_image;
             $image->big_image = $s3Link . $image->big_image;
             $image->big_image_two = $s3Link . $image->big_image_two;
             $image->medium_image = $s3Link . $image->medium_image;
             $image->medium_image_two = $s3Link . $image->medium_image_two;
             $image->medium_image_three = $s3Link . $image->medium_image_three;
             $image->small_image = $s3Link . $image->small_image;
             $image->thumbnail = $s3Link . $image->thumbnail;

         } else {
             $image->original_image = static_asset($image->original_image);
             $image->og_image = static_asset($image->og_image);
             $image->big_image = static_asset($image->big_image);
             $image->big_image_two = static_asset($image->big_image_two);
             $image->medium_image = static_asset($image->medium_image);
             $image->medium_image_two = static_asset($image->medium_image_two);
             $image->medium_image_three = static_asset($image->medium_image_three);
             $image->small_image = static_asset($image->small_image);
             $image->thumbnail = static_asset($image->thumbnail);
             
             
             
            //  $image->image->original_image = str_replace('https://pharmashots.com/public/https://pharmashots.com/public/','https://pharmashots.com/public/',static_asset($image->image->original_image));
            //  $image->image->og_image = str_replace('https://pharmashots.com/public/https://pharmashots.com/public/','https://pharmashots.com/public/',static_asset($image->image->og_image));
            //  $image->image->big_image = str_replace('https://pharmashots.com/public/https://pharmashots.com/public/','https://pharmashots.com/public/',static_asset($image->image->big_image));
            //  $image->image->big_image_two = str_replace('https://pharmashots.com/public/https://pharmashots.com/public/','https://pharmashots.com/public/',static_asset($image->image->big_image_two));
            //  $image->image->medium_image = str_replace('https://pharmashots.com/public/https://pharmashots.com/public/','https://pharmashots.com/public/',static_asset($image->image->medium_image));
            //  $image->image->medium_image_two = str_replace('https://pharmashots.com/public/https://pharmashots.com/public/','https://pharmashots.com/public/',static_asset($image->image->medium_image_two));
            //  $image->image->medium_image_three = str_replace('https://pharmashots.com/public/https://pharmashots.com/public/','https://pharmashots.com/public/',static_asset($image->image->medium_image_three));
            //  $image->image->small_image = str_replace('https://pharmashots.com/public/https://pharmashots.com/public/','https://pharmashots.com/public/',static_asset($image->image->small_image));
            //  $image->image->thumbnail = str_replace('https://pharmashots.com/public/https://pharmashots.com/public/','https://pharmashots.com/public/',static_asset($image->image->thumbnail));
         }

         unset($image->id);
         unset($image->disk);
        // unset($image->created_at);
         //unset($image->updated_at);

         return $image;
     }

     protected function get_audio($disk, $filename){
         if ($disk == 's3') {
             $s3Link = "https://s3." . Config::get('filesystems.disks.s3.region') . ".amazonaws.com/" . Config::get('filesystems.disks.s3.bucket') . "/";

             return $s3Link . $disk. $filename;

         } else {
             return static_asset($disk. $filename);
         }
     }

     protected function get_id_youtube($url = ""){
         preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
         $youtube_id = $match[1];
         return $youtube_id;
     }

     private function audioUrlSet($post){
         if (isset($post->audio)):
             foreach ($post->audio as $key => $audio):
                 $audios_array[] =
                     array(
                         'name' => $audio->audio_name,
                         'file' => $this->get_audio($audio->disk, $audio->original),
                     );
             endforeach;
             if (!isset($audios_array)):
                 $audios_array[] = array();
             endif;
         endif;

         $post->audios = $audios_array;
         unset($post->audio);
         return $post;
     }

     private function videoUrlSet($post){

         if (isset($post['video_id']) and (!isset($post['video_url_type']) or $post['video_url_type'] == 'Select option')):

             if ($post->video->disk == 's3') {
                 $s3Link = "https://s3." . Config::get('filesystems.disks.s3.region') . ".amazonaws.com/" . Config::get('filesystems.disks.s3.bucket') . "/";

                 if($post->video->video_thumbnail):
                     $post->video->video_thumbnail = $s3Link . $post->video->video_thumbnail;
                 endif;

                 if($post->video->original):
                     $post->video->original = $s3Link . $post->video->original;
                 endif;
                 if(isset($post->video->v_144p)):
                     $post->video->v_144p = $s3Link . $post->video->v_144p;
                 endif;
                 if(isset($post->video->v_240p)):
                     $post->video->v_240p = $s3Link . $post->video->v_240p;
                 endif;
                 if(isset($post->video->v_360p)):
                     $post->video->v_360p = $s3Link . $post->video->v_360p;
                 endif;
                 if(isset($post->video->v_480p)):
                     $post->video->v_480p = $s3Link . $post->video->v_480p;
                 endif;
                 if(isset($post->video->v_720p)):
                     $post->video->v_720p = $s3Link . $post->video->v_720p;
                 endif;
                 if(isset($post->video->v_1080p)):
                     $post->video->v_1080p = $s3Link . $post->video->v_1080p;
                 endif;

             } else {
                 if($post->video->video_thumbnail):
                     $post->video->video_thumbnail = static_asset($post->video->video_thumbnail);
                 endif;

                 if($post->video->original):
                     $post->video->original = static_asset($post->video->original);
                 endif;
                 if($post->video->v_144p):
                     $post->video->v_144p = static_asset($post->video->v_144p);
                 endif;
                 if($post->video->v_240p):
                     $post->video->v_240p = static_asset($post->video->v_240p);
                 endif;
                 if($post->video->v_360p):
                     $post->video->v_360p = static_asset($post->video->v_360p);
                 endif;
                 if($post->video->v_480p):
                     $post->video->v_480p = static_asset($post->video->v_480p);
                 endif;
                 if($post->video->v_720p):
                     $post->video->v_720p = static_asset($post->video->v_720p);
                 endif;
                 if($post->video->v_1080p):
                     $post->video->v_1080p = static_asset($post->video->v_1080p);
                 endif;
             }

             unset($post->video->video_name);

             unset($post->video->disk);
            //  unset($post->video->created_at);
            //  unset($post->video->updated_at);

         elseif($post['video_url_type'] == 'mp4_url'):
             unset($post['video']);
             if(isset($post['video_thumbnail_id'])):
                 $image = galleryImage::find($post['video_thumbnail_id']);

                 $post['video_thumbnail'] = $this->get_image($image);
                 unset($post['video_thumbnail_id']);
             endif;
         elseif($post['video_url_type'] == 'youtube_url'):
             $post['youtube_id'] = $this->get_id_youtube($post['video_url']);
             unset($post['video_url']);
             unset($post['video']);

             if(isset($post['video_thumbnail_id'])):
                 $image = galleryImage::find($post['video_thumbnail_id']);

                 $post['video_thumbnail'] = $this->get_image($image);
                 unset($post['video_thumbnail_id']);
             endif;

         endif;

         return $post;
     }

     private function additionalVideoUrlSet($posts){

         if (isset($posts['video_id']) and (!isset($post['video_url_type']) or $post['video_url_type'] == 'Select option')):

             $post = Video::find($posts['video_id']);

             if ($post->disk == 's3') {
                 $s3Link = "https://s3." . Config::get('filesystems.disks.s3.region') . ".amazonaws.com/" . Config::get('filesystems.disks.s3.bucket') . "/";

                 if(isset($posts['video_thumbnail_id'])):
                     $image = galleryImage::find($posts['video_thumbnail_id']);

                     $posts['video_thumbnail'] = $this->get_image($image , 'og_image');
                     unset($posts['video_thumbnail_id']);

                 elseif ($post['video_thumbnail']):
                     $posts['video_thumbnail'] = $s3Link . $post['video_thumbnail'];
                     unset($posts['video_thumbnail_id']);
                 endif;

                 if($post['original']):
                     $posts['original'] = $s3Link . $post['original'];
                 endif;
                 if(isset($post['v_144p'])):
                     $posts['v_144p'] = $s3Link . $post['v_144p'];
                 endif;
                 if(isset($post['v_240p'])):
                     $posts['v_240p'] = $s3Link . $post['v_240p'];
                 endif;
                 if(isset($post['v_360p'])):
                     $posts['v_360p'] = $s3Link . $post['v_360p'];
                 endif;
                 if(isset($post['v_480p'])):
                     $posts['v_480p'] = $s3Link . $post['v_480p'];
                 endif;
                 if(isset($post['v_720p'])):
                     $posts['v_720p'] = $s3Link . $post['v_720p'];
                 endif;
                 if(isset($post['v_1080p'])):
                     $posts['v_1080p'] = $s3Link . $post['v_1080p'];
                 endif;

             } else {

                 if(isset($posts['video_thumbnail_id'])):
                     $image = galleryImage::find($posts['video_thumbnail_id']);

                     $posts['video_thumbnail'] = $this->get_image($image , 'og_image');
                     unset($posts['video_thumbnail_id']);

                 elseif ($post['video_thumbnail']):
                     $posts['video_thumbnail'] = static_asset($post['video_thumbnail']);
                     unset($posts['video_thumbnail_id']);
                 endif;

                 if($post['original']):
                     $posts['original'] = static_asset($post['original']);
                 endif;
                 if($post['v_144p']):
                     $posts['v_144p'] = static_asset($post['v_144p']);
                 endif;
                 if($post['v_240p']):
                     $posts['v_240p'] = static_asset($post['v_240p']);
                 endif;
                 if($post['v_360p']):
                     $posts['v_360p'] = static_asset($post['v_360p']);
                 endif;
                 if($post['v_480p']):
                     $posts['v_480p'] = static_asset($post['v_480p']);
                 endif;
                 if($post['v_720p']):
                     $posts['v_720p'] = static_asset($post['v_720p']);
                 endif;
                 if($post['v_1080p']):
                     $posts['v_1080p'] = static_asset($post['v_1080p']);
                 endif;
             }

         elseif($posts['video_url_type'] == 'mp4_url'):
             unset($posts['video']);
             if(isset($posts['video_thumbnail_id'])):
                 $image = galleryImage::find($posts['video_thumbnail_id']);

                 $posts['video_thumbnail'] = $this->get_image($image , 'og_image');
                 unset($posts['video_thumbnail_id']);
             endif;
         elseif($posts['video_url_type'] == 'youtube_url'):
             $posts['youtube_id'] = $this->get_id_youtube($posts['video_url']);
             unset($posts['video_url']);
             unset($posts['video']);

             if(isset($posts['video_thumbnail_id'])):
                 $image = galleryImage::find($posts['video_thumbnail_id']);

                 $posts['video_thumbnail'] = $this->get_image($image , 'og_image');
                 unset($posts['video_thumbnail_id']);
             endif;

         endif;

         unset($posts['video_id']);
         return $posts;
     }
 }
