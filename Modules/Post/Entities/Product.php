<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [];

    public function company()
    {
        return $this->belongsTo('Modules\Post\Entities\Company');
    }

    public function post()
    {
        return $this->hasMany('Modules\Post\Entities\Post');
    }

    public function rssFeed()
    {
        return $this->hasMany('Modules\Post\Entities\RssFeed');
    }
}
