<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'parent', 'url', 'data','status'
    ];

    protected $hidden = ['parent','created_at','updated_at'];

    public function categories()
    {
        return $this->hasManyThrough(
            'App\Category',
            'App\VideoCategory',
            'video_id', // Foreign key on users table...
            'id', // Foreign key on posts table...
            'id', // Local key on countries table...
            'category_id' // Local key on users table...
        );
    }
}
