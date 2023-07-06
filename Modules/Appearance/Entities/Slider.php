<?php

namespace Modules\Appearance\Entities;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    // protected $fillable = [];
    protected $guarded = array();

    public function adImage(){
        return $this->belongsTo('Modules\Gallery\Entities\Image', 'image_id','id');
    }
}
