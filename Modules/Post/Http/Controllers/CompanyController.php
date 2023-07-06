<?php



namespace Modules\Post\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Cache;

use Modules\Language\Entities\Language;

use Modules\Post\Entities\Company;

use Modules\Gallery\Entities\Image as galleryImage;

use Modules\Post\Entities\Product;
use Modules\Post\Entities\CompanyProduct;

use Validator;

use DB;

use LaravelLocalization;



class CompanyController extends Controller

{

    public function companies(Request $request)

    {
        $search_key = '';

        if($request->search_key){
            $search_key = $request->search_key;
        }

        $companies1       = Company::orderBy('id', 'ASC');

        if($search_key !=''){            
            $companies1->where('company_name', 'like', '%' . $search_key .'%');
        }

         $companies =  $companies1->paginate(10);

        // dd($companies1->toSql());
        // dd($companies);

        $products        = Product::get();
        $activeLang      = Language::where('status', 'active')->orderBy('name', 'ASC')->get();

        return view('post::companies', compact('activeLang', 'companies','search_key','products'));

    }



    public function saveNewCompany(Request $request){

        Validator::make($request->all(), [

            'company_name' => 'required|unique:companies|min:2|max:40',

            'slug'          => 'nullable|min:2|unique:companies|max:30|regex:/^\S*$/u',

            'language'      => 'required'

        ])->validate();



        $company                   = new Company();



        $company->company_name    = strtolower($request->company_name);
        $company->language         = $request->language;
        $company->image_id         = $request->image_id;
        $company->image_id_api         = $request->image_id_api;



        if ($request->slug != null) :

            $company->slug = $request->slug;

        else :

            $company->slug = $this->make_slug(strtolower($request->company_name));

        endif;



        $company->meta_description     = $request->meta_description;

        $company->meta_keywords        = $request->meta_keywords;


       // $company->show_on_menu         = $request->show_on_menu;

//        $company->block_style          = $request->block_style;



        $company->save();




        Cache::Flush();



        return redirect()->back()->with('success', __('successfully_added'));

    }

    



    public function editcompany($id){


        $company        = Company::find($id);
        $CompanyProduct        = CompanyProduct::where('company_id', $id)->pluck('product_id')->toArray();

        $products        = Product::get();
        $activeLang     = Language::where('status', 'active')->orderBy('name', 'ASC')->get();
        $imagethumbnail = '';
        if ($company->image_id && $company->image_id !='' && $company->image_id != null) {
            $image          = galleryImage::find($company->image_id);
            if ($image ) {
                $imagethumbnail = $image->thumbnail;

            }
        }
        $imagethumbnailapi = '';
        if ($company->image_id_api && $company->image_id_api !='' && $company->image_id_api != null) {
            $image          = galleryImage::find($company->image_id_api);
            if ($image ) {
                $imagethumbnailapi = $image->thumbnail;

            }
        }



        return view('post::edit_company', compact('company', 'activeLang', 'imagethumbnail','imagethumbnailapi','products','CompanyProduct'));

    }



    public function updatecompany(Request $request)

    {

        Validator::make($request->all(), [

            'company_name'     => 'required|min:2|max:40|unique:companies,company_name,' . $request->company_id,

            'slug'              => 'nullable|min:2|max:30|regex:/^\S*$/u|unique:companies,slug,' . $request->company_id,

            'language'          => 'required'

        ])->validate();



        $company                   = Company::find($request->company_id);



        $company->company_name    = strtolower($request->company_name);
        $company->language         = $request->language;
        $company->image_id         = $request->image_id;
        $company->image_id_api      = $request->image_id_api;



        if ($request->slug != null) :

            $company->slug     = $request->slug;

        else :

            $company->slug     = $this->make_slug(strtolower($request->company_name));

        endif;



        $company->meta_description = $request->meta_description;

        $company->meta_keywords    = $request->meta_keywords;

 //       $company->show_on_menu     = $request->show_on_menu;

//        $company->block_style      = $request->block_style;



        $company->save();

        // CompanyProduct::where('company_id', $company->id)->delete();

        // if (is_array($request->product_id)) {
        //     if (count($request->product_id) > 0) {
        //         foreach ($request->product_id as $key => $value) {
        //             $companyProduct =  new CompanyProduct();
        //             $companyProduct->product_id =  $value;
        //             $companyProduct->company_id =  $company->id;
        //             $companyProduct->save();
        //         }
        //     }
        // }

        Cache::Flush();



        return redirect()->route('companies')->with('success', __('successfully_updated'));

    }



    public function products(Request $request)

    {

        $search_key = '';

        if($request->search_key){
            $search_key = $request->search_key;
        }

        $products1       = Product::with('company')->orderBy('id', 'ASC');

        if($search_key !=''){            
            $products1->where('product_name', 'like', '%' . $search_key .'%');
        }

         $products =  $products1->paginate(10);



        // $products          = Product::with('company')->orderBy('id', 'DESC')->paginate(10);
        $companies             = Company::orderBy('company_name','ASC')->get();
        $activeLang             = Language::where('status', 'active')->orderBy('name', 'ASC')->get();
        return view('post::products', compact('products', 'activeLang', 'companies','search_key'));

    }



    public function productsAdd(Request $request)

    {

        Validator::make($request->all(), [
            'product_name'      => 'required|unique:products|min:2|max:40',
            'slug'              => 'nullable|min:2|unique:companies|max:30|regex:/^\S*$/u',

        ])->validate();



        $product                    = new Product();



        $product->product_name = strtolower($request->product_name);

        $product->language          = $request->language;



        if ($request->slug != null) :

            $product->slug  = $request->slug;

        else :

            $product->slug  = $this->make_slug(strtolower($request->product_name));

        endif;



        $product->meta_description  = $request->meta_description;

        $product->meta_keywords     = $request->meta_keywords;





        $product->save();

        CompanyProduct::where('product_id', $product->id)->delete();

        if (is_array($request->company_id)) {
            if (count($request->company_id) > 0) {
                foreach ($request->company_id as $key => $value) {
                    $companyProduct =  new CompanyProduct();
                    $companyProduct->company_id =  $value;
                    $companyProduct->product_id =  $product->id;
                    $companyProduct->save();
                }
            }
        }

        Cache::Flush();



        return redirect()->back()->with('success', __('successfully_added'));

    }



    public function editProduct($id)

    {

        $product    = Product::find($id);
        $companies    = Company::get();

        $CompanyProduct        = CompanyProduct::where('product_id', $id)->pluck('company_id')->toArray();

        $activeLang     = Language::where('status', 'active')->orderBy('name', 'ASC')->get();



        return view('post::edit_product', compact('product', 'activeLang','companies','CompanyProduct'));

    }



    public function updateProduct(Request $request)

    {

        Validator::make($request->all(), [

            'product_name'     => 'required|min:2|max:40|unique:products,product_name,' . $request->product_id,

            'language'              => 'required',

            'slug'                  => 'nullable|min:2|max:30|regex:/^\S*$/u|unique:products,slug,' . $request->product_id,


        ])->validate();



        $product                    = Product::find($request->product_id);

        $product->product_name = strtolower($request->product_name);

        $product->language          = $request->language;



        if ($request->slug != null) :

            $product->slug  = $request->slug;

        else :

            $product->slug  = $this->make_slug(strtolower($request->product_name));

        endif;



        $product->meta_description  = $request->meta_description;

        $product->meta_keywords     = $request->meta_keywords;




        $product->save();

        CompanyProduct::where('product_id', $product->id)->delete();

        if (is_array($request->company_id)) {
            if (count($request->company_id) > 0) {
                foreach ($request->company_id as $key => $value) {
                    $companyProduct =  new CompanyProduct();
                    $companyProduct->company_id =  $value;
                    $companyProduct->product_id =  $product->id;
                    $companyProduct->save();
                }
            }
        }

        Cache::Flush();



        return redirect()->route('products')->with('success', __('successfully_added'));

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

