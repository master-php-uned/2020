<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $hidden = ['laravel_through_key','created_at','updated_at'];

    public function videos()
    {
        return $this->hasMany('App\VideoCategory','category_id')->with('datavideo');
    }
}
