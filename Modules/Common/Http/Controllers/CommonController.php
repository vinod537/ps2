<?php



namespace Modules\Common\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Illuminate\Routing\Controller;

use Carbon\Carbon;

use App\VisitorTracker;

use Modules\User\Entities\Activation;

use Modules\Post\Entities\Post;
use Modules\Post\Entities\PressRelease;

use Modules\Setting\Entities\Setting;

use Modules\Post\Entities\Category;


use Modules\Post\Entities\Company;
use Modules\Post\Entities\Product;
use Modules\Post\Entities\CompanyProduct;


use Modules\Gallery\Entities\Image as galleryImage;

use Modules\Gallery\Entities\Video;

use DB;

use File;

use Image;

use Validator;

use Illuminate\Support\Facades\Storage;

use Aws\S3\Exception\S3Exception as S3;

use Modules\Common\Entities\Cron;

use Session;



class CommonController extends Controller

{

    /**

     * Display a listing of the resource.

     * @return Response

     */

    public function index()

    {


        


         $data['registeredUsers']           = Activation::get();

        // $data['publishedPost']             = Post::where('visibility', 1)->where('status', 1)->get();

        // $data['submittedPost']             = Post::where('submitted', 1)->get();

       
        $data['publishedPost'] = [];
        $data['submittedPost'] = [];

        $data['posthits']              = Post::with('image')->orderBy('total_hit', 'DESC')->where('total_hit', '!=', 0)->paginate(10);
        $data['browserColor'] = ['#254f37', '#8f97db', '#db9cd0', '#dbc98f', '#9fdb8f', '#8fdbc3', '#8fcfdb', '#6F7841', '#a61616', '#051057'];




        
        return view('common::index', compact('data'));

    }

    public function getImport()

    {       

        return view('common::import');

    }

    public function getImportupdate()

    {       
      //  echo $this->make_slug("ok? noon one can do !!this-Now whereheelo's so @ this%");

        return view('common::importupdate');

    }


    public function importcompanyproduct() {
        return view('common::importcompany');
    }



    public function importcompanyproductupdate(Request $request){
      
        
        if ($request->input('submit') != null ){  

          $file = $request->file('file');
          
          $filename = $file->getClientOriginalName();
          $extension = $file->getClientOriginalExtension();
          $tempPath = $file->getRealPath();
          $fileSize = $file->getSize();
          $mimeType = $file->getMimeType();
          $valid_extension = array("csv");
          $maxFileSize = 100000000; 
          if(in_array(strtolower($extension), $valid_extension)){
            if($fileSize <= $maxFileSize){
              $location = 'uploads';
              $file->move($location,$filename);             
              $filepath = $location."/".$filename;             
              $file = fopen($filepath,"r");           
              $importData_arr = array();
              $i = 0;
              
              while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                 $num = count($filedata );                
               
                 for ($c=0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata [$c];
                 }
                 $i++;
              }
              fclose($file);
              $i=0;
             
              foreach($importData_arr as $importData){
             
                $i++;
                if ($i != 1) {
                 if ($importData[0]) {
                    //$PostSlugAlready =  PressRelease::where('id', $importData[0])->first(); 
                    $id = $importData[0];
                    $productnamearr = trim($importData[1]);

                    $companynamearr = trim($importData[2]);

                    // 
                    // $productslug = $this->make_slug($productname);

                    $companyAllIds = [];
                    if ($companynamearr != '') {

                        $companynamearrnew = explode(',', $companynamearr);
                        foreach ($companynamearrnew as $keycompany => $valuecompany) {

                            $valuecompanynew = strtolower(trim($valuecompany));

                            $companyslug = $this->make_slug($valuecompanynew);
                            $Companydetails = Company::where('slug', $companyslug)->first();

                            if (!$Companydetails) {        
                                $company                   = new Company();
                                $company->company_name     = $valuecompanynew;    
                                $company->slug             = $companyslug ;                                
                                $company->created_at       =  date('Y-m-d H:i:s');
                                $company->updated_at       =  date('Y-m-d H:i:s');
                                $company->save();
                                $companyAllIds[] = $company->id;

                            }else{
                                $companyAllIds[] = $Companydetails->id;
                            }
                        }
                    }


                    $productAllIds = [];

                    if ($productnamearr != '') {
                        
                        $productnamearrnew = explode(',', $productnamearr);
                        foreach ($productnamearrnew as $keyproduct => $valueproduct) {

                            $valueproductnew = strtolower(trim($valueproduct));

                            $productslug = $this->make_slug($valueproductnew);
                            $productdetails = Product::where('slug', $productslug)->first();

                            if (!$productdetails) {
        
                                $product                   = new product();
                                $product->product_name     = $valueproductnew;    
                                $product->slug             = $productslug ;
                                $product->created_at       =  date('Y-m-d H:i:s');
                                $product->updated_at       =  date('Y-m-d H:i:s');
                                $product->save();
                                $productAllIds[] = $product->id;
                            }else{
                                $productAllIds[] = $productdetails->id;
                            }
                        }
                    }

                    if (count($productAllIds) > 0) {
                        foreach ($productAllIds as $keyproductid => $valueproductid) {
                            if (count($companyAllIds) > 0) {
                                foreach ($companyAllIds as $keycompanyid => $valuecompanyid) {

                                    $companyproductdetails = CompanyProduct::where('company_id', $valuecompanyid)->where('product_id', $valueproductid)->first();
                                    if (!$companyproductdetails) {
                                        $productcompany            = new CompanyProduct();
                                        $productcompany->product_id       = $valueproductid;    
                                        $productcompany->company_id       = $valuecompanyid;  
                                        $productcompany->created_at       =  date('Y-m-d H:i:s');
                                        $productcompany->updated_at       =  date('Y-m-d H:i:s');
                                        $productcompany->save();
                                    }                                   
                                }
                            }    
                        }
                    }

                    if (count($productAllIds) > 0) {
                         $FProduct       = \Modules\Post\Entities\Product::whereIn('id', $productAllIds)->pluck('slug')->toArray();
                    }

                    if (count($companyAllIds) > 0) {
                        $FCompany       = \Modules\Post\Entities\Company::whereIn('id', $companyAllIds)->pluck('slug')->toArray();
                    }

                    if (count($companyAllIds) > 0 && count($productAllIds) > 0) {

                        $UpdateARR['company_name2'] = json_encode($FCompany);
                        $UpdateARR['product2'] = json_encode($FProduct);
                        Post::where('id', $id)->update($UpdateARR);
                    }
                    
                   
                    // PressRelease::create($UpdateARR);
                    //  PressRelease::where('id', $id)->update($UpdateARR);
                    // return redirect()->back()->with('success',__('successfully_added'));

                }

                }            
            
              }
    
              Session::flash('message','Update Successful.');
            }else{
              Session::flash('message','File too large. File must be less than 100MB.');
            }
    
          }else{
             Session::flash('message','Invalid File Extension.');
          }
    
        }  
        return redirect()->back()->with('success',__('successfully_added'));
    }




    // public function importproduct() {   
    //     return view('common::importproduct');
    // }



    private function make_description($string, $delimiter = "'") {
        $utfstring = $string;
        $string =  utf8_encode($utfstring);
        // $pattern = "/’/i";
        // $string =  preg_replace($pattern, '"', $str);
        return $string;
    }

    public function uploadFile(Request $request){
      
        
        if ($request->input('submit') != null ){  
          $file = $request->file('file');
          
          $filename = $file->getClientOriginalName();
          $extension = $file->getClientOriginalExtension();
          $tempPath = $file->getRealPath();
          $fileSize = $file->getSize();
          $mimeType = $file->getMimeType();
          $valid_extension = array("csv");
          $maxFileSize = 100000000; 
          if(in_array(strtolower($extension),$valid_extension)){
            if($fileSize <= $maxFileSize){
              $location = 'uploads';
              $file->move($location,$filename);             
              $filepath = $location."/".$filename;             
              $file = fopen($filepath,"r");           
              $importData_arr = array();
              $i = 0;
              
              while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                 $num = count($filedata );                
               
                 for ($c=0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata [$c];
                 }
                 $i++;
              }
              fclose($file);
              $i=0;
              foreach($importData_arr as $importData){
                
                $i++;
                if ($i != 1) {
                 if ($importData[0]) {
                    //$PostSlugAlready =  PressRelease::where('id', $importData[0])->first(); 

                    $id = $importData[0];                         
                    $UpdateARR['updated_at']     = $importData[1];  
                    
                    
                    // $UpdateARR['content']          = $importData[2];                          
                    // $UpdateARR['slug']          =  $this->make_slug(html_entity_decode($importData[1]));;                          
                    // $UpdateARR['slug2']          =  $this->make_slug(html_entity_decode($importData[1]));;                          
                    // $UpdateARR['user_id']          = 18;                          
                    // $UpdateARR['category_id']          = '["12"]';                          
                    // $UpdateARR['post_type']          = 'article';                          
                    // $UpdateARR['status']          = '1';                          
                    // $UpdateARR['visibility']          = '1';                          
                    // $UpdateARR['meta_title']          = $importData[1];                          
                    // $UpdateARR['old_id']          = null;                          

                    // if(isset($importData[3])){
                    //     $UpdateARR['created_at']    =  date('Y-m-d H:i:s', strtotime(trim($importData[3])));
                    //     $UpdateARR['updated_at']    =  date('Y-m-d H:i:s', strtotime(trim($importData[3])));
                    // }else{
                    //     $UpdateARR['created_at']    =  date('Y-m-d H:i:s');
                    //     $UpdateARR['updated_at']    =  date('Y-m-d H:i:s');
                    // }
                   // dd($UpdateARR);
                    // $id    =  $PostSlugAlready->id;
                    // PressRelease::create($UpdateARR);
                  Post::where('id', $id)->update($UpdateARR);
                 
                        
                    }
                }            
            
              }
    
              Session::flash('message','Update Successful.');
            }else{
              Session::flash('message','File too large. File must be less than 100MB.');
            }
    
          }else{
             Session::flash('message','Invalid File Extension.');
          }
    
        }  
        return redirect()->back()->with('success',__('successfully_added'));
    }

    // public function uploadFile(Request $request){
      
        
    //     if ($request->input('submit') != null ){  
    //       $file = $request->file('file');
    //       $filename = $file->getClientOriginalName();
    //       $extension = $file->getClientOriginalExtension();
    //       $tempPath = $file->getRealPath();
    //       $fileSize = $file->getSize();
    //       $mimeType = $file->getMimeType();
    //       $valid_extension = array("csv");
    //       $maxFileSize = 100000000; 
    //       if(in_array(strtolower($extension),$valid_extension)){
    //         if($fileSize <= $maxFileSize){
    //           $location = 'uploads';
    //           $file->move($location,$filename);             
    //           $filepath = $location."/".$filename;             
    //           $file = fopen($filepath,"r");           
    //           $importData_arr = array();
    //           $i = 0;
    //           while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
    //              $num = count($filedata );                
               
    //              for ($c=0; $c < $num; $c++) {
    //                 $importData_arr[$i][] = $filedata [$c];
    //              }
    //              $i++;
    //           }
    //           fclose($file);
    //           $i=0;
    //           foreach($importData_arr as $importData){
    //             $i++;
    //             if ($i != 1) {
    //              if ($importData[0]) {
    //                 $PostSlugAlready =  Post::where('id', $importData[0])->first(); 
    //                 if($PostSlugAlready){                           
                            
    //                          $UpdateARR['old_id']          = trim($importData[1]);                          
 
    //                          if(trim($importData[2]) != '#N/A'){
    //                              $UpdateARR['created_at']    =  date('Y-m-d H:i:s', strtotime(trim($importData[2])));
    //                              $UpdateARR['updated_at']    =  date('Y-m-d H:i:s', strtotime(trim($importData[2])));
    //                          }else{
    //                              $UpdateARR['created_at']    =  date('Y-m-d H:i:s');
    //                              $UpdateARR['updated_at']    =  date('Y-m-d H:i:s');
    //                          }
    //                          $id    =  $PostSlugAlready->id;
    //                          Post::where('id', $id)->update($UpdateARR);
    //                         /// dd($PostSlugAlready);
    //                     }
    //                 }
    //             }            
            
    //           }
    
    //           Session::flash('message','Update Successful.');
    //         }else{
    //           Session::flash('message','File too large. File must be less than 100MB.');
    //         }
    
    //       }else{
    //          Session::flash('message','Invalid File Extension.');
    //       }
    
    //     }  
    //     return redirect()->back()->with('success',__('successfully_added'));
    // }



    // public function uploadFileupdate(Request $request){
      
        
    //     if ($request->input('submit') != null ){  
    //       $file = $request->file('file');
    //       $filename = $file->getClientOriginalName();
    //       $extension = $file->getClientOriginalExtension();
    //       $tempPath = $file->getRealPath();
    //       $fileSize = $file->getSize();
    //       $mimeType = $file->getMimeType();
    //       $valid_extension = array("csv");
    //       $maxFileSize = 100000000; 
    //       if(in_array(strtolower($extension),$valid_extension)){
    //         if($fileSize <= $maxFileSize){
    //           $location = 'uploads';
    //           $file->move($location,$filename);             
    //           $filepath = $location."/".$filename;             
    //           $file = fopen($filepath,"r");           
    //           $importData_arr = array();
    //           $i = 0;
    //           while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
    //              $num = count($filedata );                
               
    //              for ($c=0; $c < $num; $c++) {
    //                 $importData_arr[$i][] = $filedata [$c];
    //              }
    //              $i++;
    //           }
    //           fclose($file);
    //           $i=0;
    //           foreach($importData_arr as $importData){
    //             $i++;
    //             if ($i != 1) {

                                     

    //             //     $categoryIDSMain = [];                    
    //             //     if ($importData[1] && $importData[1] !='') {
    //             //          $excat = explode('|', $importData[1]);
    //             //          foreach ($excat as $keyCat => $valueCat) {
    //             //              $categoryIDS1 =  Category::where('category_name', trim($valueCat))->first(); 
    //             //              if($categoryIDS1){
    //             //                  $categoryIDS      = $categoryIDS1->id; 
    //             //                  $categoryIDS = json_encode($categoryIDS);
    //             //                  array_push($categoryIDSMain, $categoryIDS);

    //             //              }                        
    //             //          }                        
    //             //     }else{
    //             //         $categoryIDSMain = [];
    //             //     }
    //             //    $categoryIDSMainS =  $categoryIDSMain;


    //                 $str1 = [',','?',"'",'"','','©',"'"];
    //                 $rplc1 =[',','?',"'",'â','€™','�','’'];
                        
    //              // echo   $this->make_slug(str_replace($rplc,$str, $importData[0]));

    //              if ($importData[0]) {
    //                 $PostSlugAlready =  Post::where('slug', trim($this->make_slug($this->make_description($importData[0]))))->first(); 
    //                 if($PostSlugAlready){
    //                         // $prefix = '?';
    //                         // $str1 = $importData[0];
    //                         // $str11 = $importData[0];
    //                         // if (substr($str1, 0, strlen($prefix)) == $prefix) {
    //                         //         $str11 = substr($str1, strlen($prefix));
    //                         //     } 


    //                         // $slug             =  $PostSlugAlready->slug;
    //                         // $UpdateARR['title']   = $str11;

    //                         // Post::where('slug', $slug)
    //                         // ->update($UpdateARR);


    //                         // Update product
    //                         // if ($importData[1] && $importData[1] !='') {
    //                         //     $product = str_replace('|', ',', $importData[1]); 
    //                         // }else{
    //                         //     $product = '';
    //                         // }
    //                         // $UpdateARR['product']   = $product;



    //                         // // Update Date
                            
    //                         // $UpdateARR['content']          = $this->make_description($importData[1]); 
    //                         // // if ($importData[2] && $importData[2] !='') {
    //                         // //     $UpdateARR['content2']          = $this->make_description($importData[2]);
    //                         // // }  

    //                         // if(trim($importData[2]) != '#N/A'){
    //                         //     $UpdateARR['created_at']    =  date('Y-m-d H:i:s', strtotime(trim($importData[2])));
    //                         //     $UpdateARR['updated_at']    =  date('Y-m-d H:i:s', strtotime(trim($importData[2])));
    //                         // }else{
    //                         //     $UpdateARR['created_at']    =  date('Y-m-d H:i:s');
    //                         //     $UpdateARR['updated_at']    =  date('Y-m-d H:i:s');
    //                         // }
    //                         // $slug             =  $PostSlugAlready->slug;
    //                         // Post::where('slug', $slug)
    //                         // ->update($UpdateARR);


    //                             // die;
                            
    //                             //$slug             =  $this->make_slug(str_replace($rplc,$str, $importData[0]));

    //                         // $UpdateARR['category_id']   = json_encode($categoryIDSMainS);
    //                         // $UpdateARR['category_id']   = '';
    //                         // if(trim($importData[2]) != '#N/A'){
    //                         //     $UpdateARR['created_at']    =  date('Y-m-d H:i:s', strtotime(trim($importData[2])));
    //                         //     $UpdateARR['updated_at']    =  date('Y-m-d H:i:s', strtotime(trim($importData[2])));
    //                         // }else{
    //                         //     $UpdateARR['created_at']    =  date('Y-m-d H:i:s');
    //                         //     $UpdateARR['updated_at']    =  date('Y-m-d H:i:s');
    //                         // }
                            
    //                         // Post::where('slug', $slug)
    //                         // ->update($UpdateARR);
    //                         // print_r($categoryIDSMain);
    //                         // die;

    //                          // Update Date
                            
    //                          $UpdateARR['old_id']          = trim($importData[1]); 
                         
 
    //                          if(trim($importData[2]) != '#N/A'){
    //                              $UpdateARR['created_at']    =  date('Y-m-d H:i:s', strtotime(trim($importData[2])));
    //                              $UpdateARR['updated_at']    =  date('Y-m-d H:i:s', strtotime(trim($importData[2])));
    //                          }else{
    //                              $UpdateARR['created_at']    =  date('Y-m-d H:i:s');
    //                              $UpdateARR['updated_at']    =  date('Y-m-d H:i:s');
    //                          }
    //                          $slug             =  $PostSlugAlready->slug;
    //                          Post::where('slug', $slug)
    //                          ->update($UpdateARR);
    //                     }
    //                 }
    //             }            
            
    //           }
    
    //           Session::flash('message','Update Successful.');
    //         }else{
    //           Session::flash('message','File too large. File must be less than 100MB.');
    //         }
    
    //       }else{
    //          Session::flash('message','Invalid File Extension.');
    //       }
    
    //     }  
    //     return redirect()->back()->with('success',__('successfully_added'));
    // }


    


    // public function uploadFile(Request $request){
      
    //     if ($request->input('submit') != null ){
    
          
    //       $file = $request->file('file');
    //       //$file = $request->file ;
         

    //      // var_dump($request->file('file'))
    //       // File Details 
    //       $filename = $file->getClientOriginalName();
    //       $extension = $file->getClientOriginalExtension();
    //       $tempPath = $file->getRealPath();
    //       $fileSize = $file->getSize();
    //       $mimeType = $file->getMimeType();
    //       // Valid File Extensions
    //       $valid_extension = array("csv");
    
    //       // 100MB in Bytes
    //       $maxFileSize = 100000000; 
    
    //       // Check file extension
    //       if(in_array(strtolower($extension),$valid_extension)){
    
    //         // Check file size
    //         if($fileSize <= $maxFileSize){
    
    //           // File upload location
    //           $location = 'uploads';
    
    //           // Upload file
    //           $file->move($location,$filename);
             
    //           // Import CSV to Database
    //           $filepath = $location."/".$filename;
             
    //           // Reading file
    //           $file = fopen($filepath,"r");
           
    //           $importData_arr = array();
    //           $i = 0;

             
    //           while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
    //              $num = count($filedata );                
               
    //              for ($c=0; $c < $num; $c++) {
    //                 $importData_arr[$i][] = $filedata [$c];
    //              }
    //              $i++;
    //           }
    //           fclose($file);
             
    //           // Insert to MySQL database

             
    //           $i=0;
    //           foreach($importData_arr as $importData){
    //             //dd($importData);
    //             $i++;
    //             if(trim($importData[0]) == 'Post'){
    //                 $post               =   new Post();
    //             }elseif(trim($importData[0]) == 'PressRelease') {
    //                 $post               =   new PressRelease();
    //             }

    //             $str = [',','?',"'",'"','','©',"'"];
    //             $rplc =[',','?',"'",'â','€™','�','’'];

    //             $str1 = ['-','-',"-",'-','-','-','-'];
    //             $rplc1 =[',','?',"'",'â','€™','�','’'];

    //             if ($i != 1) {
                    
    //                 if(trim(str_replace($rplc,$str, $importData[1])) && trim(str_replace($rplc,$str, $importData[1])) !=''){
    //                 if ($importData[5] && $importData[5] != '') {
    //                     $eximg = explode('|', $importData[5]);
    //                     $uploaded_file_id = $this->imageUpload($eximg[0]);
    //                 }else{
    //                     $uploaded_file_id = '23';
    //                 }


    //                 if ($importData[9] && $importData[9] !='') {
    //                     $tags = str_replace('|', ',', $importData[9]); 
    //                 }else{
    //                     $tags = '';
    //                 }

    //                 if ($importData[7] && $importData[7] !='') {
    //                     $companyname = str_replace('|', ',', $importData[7]); 
    //                 }else{
    //                     $companyname = '';
    //                 }

    //                 if ($importData[8] && $importData[8] !='') {
    //                     $product = str_replace('|', ',', $importData[8]); 
    //                 }else{
    //                     $product = '';
    //                 }
               
                   
    //                     //             echo str_replace($rplc,$str,$importData['1']);
    //                     //  die;
    //                     //             dd($importData);


    //                     $categoryIDSMain = [];                    
    //                     if ($importData[6] && $importData[6] !='') {
    //                          $excat = explode('|', $importData[6]);
    //                          foreach ($excat as $keyCat => $valueCat) {
    //                              $categoryIDS1 =  Category::where('category_name', trim($valueCat))->first(); 
    //                              if($categoryIDS1){
    //                                  $categoryIDS      = $categoryIDS1->id; 
    //                                  $categoryIDS = json_encode($categoryIDS);
    //                                  array_push($categoryIDSMain, $categoryIDS);
    
    //                              }                        
    //                          }                        
    //                     }else{
    //                         $categoryIDSMain = [];
    //                     }
    //                    $categoryIDSMainS =  $categoryIDSMain;

    //                 //  $categoryIDS = '14';
    //                 //     if ($importData[6] && $importData[6] !='') {
    //                 //          $excat = explode('|', $importData[6]);
    //                 //         $categoryIDS1 =  Category::where('category_name', trim($excat[0]))->first(); 
    //                 //         if($categoryIDS1){
    //                 //             $categoryIDS      = $categoryIDS1->id; 
    //                 //         }                        
    //                 //     }else{
    //                 //         $categoryIDS = '14';
    //                 //     }
                                
    //                 // $post->meta_title       = str_replace(',', ' ', $importData[1]);
    //                 $post->meta_title       = str_replace($rplc,$str, $importData[1]);
    //                 $post->meta_keywords    = $tags;      
    //                 $post->tags             = $tags;  
    //                 $post->company_name     = $companyname;  
    //                 $post->product          = $product;  
    //                 $post->meta_description = str_replace($rplc,$str, $importData[1]);     
    //                 $post->language         = 'en';  

    //                 $post->category_id      = json_encode($categoryIDSMainS);     
    //                 $post->sub_category_id  = '1';      
    //                 $post->submitted        = '1';      
    //                 $post->image_id         = $uploaded_file_id;
    //                 $post->featured         = '0';
    //                 $post->layout           = 'default';
    //                 $post->visibility       = '1';
    //                 if(trim($importData[12]) && trim($importData[12]) !=''){
    //                     $post->user_id          = trim($importData[12]);
    //                 }else{
    //                     $post->user_id          = 1;
    //                 }
    //                 $post->content          = $this->make_description($importData[3]); 
    //                 if ($importData[4] && $importData[4] !='') {
    //                     $post->content2          = $this->make_description($importData[4]);
    //                 }  
                                    
    //                 if ($importData[2] && $importData[2] !='') {
    //                     $post->slug2             =  $this->make_slug($this->make_description($importData[2]));
    //                 }

    //                 if ($importData[1]) {
    //                     $PostSlugAlready =  Post::where('slug', trim($this->make_slug($this->make_description($importData[1]))))->first(); 
    //                     if($PostSlugAlready){
    //                         $post->slug             =  $this->make_slug($this->make_description($importData[1])).'-'.rand();
    //                     }else{
    //                         $post->slug             =  $this->make_slug($this->make_description($importData[1]));

    //                     }
    //                 }

    //                 $post->title            =   trim($this->make_description($importData[1]));
                    
    //                 if ($importData[2] && $importData[2] !='') {
    //                     $post->title2           =   trim($this->make_description($importData[2]));
    //                 }

    //                 if(trim($importData[11]) != '#N/A'){
    //                     $post->created_at    =  date('Y-m-d H:i:s', strtotime(trim($importData[11])));
    //                     $post->updated_at    =  date('Y-m-d H:i:s', strtotime(trim($importData[11])));
    //                 }else{
    //                     $post->created_at    =  date('Y-m-d H:i:s');
    //                     $post->updated_at    =  date('Y-m-d H:i:s');
    //                 }     
                   
    //                 $post->post_type        = 'article';
    //                 $post->status           = '1';
    //                 $post->save();
    //             }
    //         }            
            
    //     }
    
    //           Session::flash('message','Import Successful.');
    //         }else{
    //           Session::flash('message','File too large. File must be less than 100MB.');
    //         }
    
    //       }else{
    //          Session::flash('message','Invalid File Extension.');
    //       }
    
    //     }
    
    //     // Redirect to index
    //     // return redirect()->action('CommonController@getImport');
    //     return redirect()->back()->with('success',__('successfully_added'));
    // }


      
    public function imageUpload($url){   
        // echo $url;
        // die;     
      
      if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            return 10;
        }
        $info = pathinfo($url);       
         $contents = file_get_contents($url);
            $image                  = new galleryImage();
            //$requestImage           = $request->file('image');
            // $fileType               = $requestImage->getClientOriginalExtension();
            $fileType               =  pathinfo($info['basename'], PATHINFO_EXTENSION);

            $originalImageName      = date('YmdHis') . "_original_" . rand(1, 50) . '.' . 'webp';
            $ogImageName            = date('YmdHis') . "_ogImage_" . rand(1, 50) . '.' . $fileType;
            $thumbnailImageName     = date('YmdHis') . "_thumbnail_100x100_" . rand(1, 50) . '.' . 'webp';
            $bigImageName           = date('YmdHis') . "_big_1080x1000_" . rand(1, 50) . '.' . 'webp';
            $bigImageNameTwo        = date('YmdHis') . "_big_730x400_" . rand(1, 50) . '.' . 'webp';
            $mediumImageName        = date('YmdHis') . "_medium_358x215_" . rand(1, 50) . '.' . 'webp';
            $mediumImageNameTwo     = date('YmdHis') . "_medium_350x190_" . rand(1, 50) . '.' . 'webp';
            $mediumImageNameThree   = date('YmdHis') . "_medium_255x175_" . rand(1, 50) . '.' . 'webp';
            $smallImageName         = date('YmdHis') . "_small_123x83_" . rand(1, 50) . '.' . 'webp';

           
            $directory              = 'public/images/';
            $originalImageUrl       = $directory . $originalImageName;
            $ogImageUrl             = $directory . $ogImageName;
            $thumbnailImageUrl      = $directory . $thumbnailImageName;
            $bigImageUrl            = $directory . $bigImageName;
            $bigImageUrlTwo         = $directory . $bigImageNameTwo;
            $mediumImageUrl         = $directory . $mediumImageName;
            $mediumImageUrlTwo      = $directory . $mediumImageNameTwo;
            $mediumImageUrlThree    = $directory . $mediumImageNameThree;
            $smallImageUrl          = $directory . $smallImageName;            

            file_put_contents($ogImageUrl, $contents);


            file_put_contents($ogImageUrl, $contents);
            file_put_contents($originalImageUrl, $contents);
            file_put_contents($thumbnailImageUrl, $contents);
            file_put_contents($bigImageUrl, $contents);
            file_put_contents($bigImageUrlTwo, $contents);
            file_put_contents($mediumImageUrl, $contents);
            file_put_contents($mediumImageUrlTwo, $contents);
            file_put_contents($mediumImageUrlThree, $contents);
            file_put_contents($smallImageUrl, $contents);



            $image->original_image      = str_replace("public/","",$originalImageUrl);
            $image->og_image            = str_replace("public/","",$ogImageUrl);
            $image->thumbnail           = str_replace("public/","",$thumbnailImageUrl);
            $image->big_image           = str_replace("public/","",$bigImageUrl);
            $image->big_image_two       = str_replace("public/","",$bigImageUrlTwo);
            $image->medium_image        = str_replace("public/","",$mediumImageUrl);
            $image->medium_image_two    = str_replace("public/","",$mediumImageUrlTwo);
            $image->medium_image_three  = str_replace("public/","",$mediumImageUrlThree);
            $image->small_image         = str_replace("public/","",$smallImageUrl);
            $image->disk                = 'local';
            $image->save();
            return $image->id;
           
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

    /**

     * Show the form for creating a new resource.

     * @return Response

     */

    public function create()

    {

        return view('common::create');

    }





    /**

     * Store a newly created resource in storage.

     * @param Request $request

     * @return Response

     */

    public function store(Request $request)

    {

        //

    }



    /**

     * Show the specified resource.

     * @param int $id

     * @return Response

     */

    public function show($id)

    {

        return view('common::show');

    }



    /**

     * Show the form for editing the specified resource.

     * @param int $id

     * @return Response

     */

    public function edit($id)

    {

        return view('common::edit');

    }



    /**

     * Update the specified resource in storage.

     * @param Request $request

     * @param int $id

     * @return Response

     */

    public function update(Request $request, $id)

    {

        //

    }



    /**

     * Remove the specified resource from storage.

     * @param int $id

     * @return Response

     */

    public function destroy($id)

    {

        //

    }

}