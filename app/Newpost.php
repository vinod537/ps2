<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Newpost extends Model
{
   protected $fillable = [
        'content',
    ];

}
