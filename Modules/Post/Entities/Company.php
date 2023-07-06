<?php



namespace Modules\Post\Entities;



use Illuminate\Database\Eloquent\Model;

use LaravelLocalization;

use Sentinel;



class Company extends Model

{

    protected $fillable = ['company_name','image_id_api', 'language', 'slug', 'meta_description', 'meta_keywords', 'order', 'show_on_menu', 'show_on_homepage'];

    public function image(){
        //   return $this->hasOne(Media::class ,'id', 'avatar_id');
        return $this->belongsTo('Modules\Gallery\Entities\Image');
    }


    public function product()
    {
        return $this->hasMany('Modules\Post\Entities\Product');

    }



    public function post()

    {

        return $this->hasMany('Modules\Post\Entities\Post')->limit(10);

    }



    public function rssFeed()

    {

        return $this->hasMany('Modules\Post\Entities\RssFeed');

    }





}



