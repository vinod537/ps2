<?php

namespace Modules\Appearance\Entities;

use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{
    protected $fillable = [];

    protected $casts = [
    	"options" => "array"
    ];
}
