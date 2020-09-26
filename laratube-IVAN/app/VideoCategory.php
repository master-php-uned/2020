<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoCategory extends Model
{
    public function datavideo()
    {
        return $this->hasOne('App\Video','id','video_id');/*->where('data', '!=', '');*/
    }
}
