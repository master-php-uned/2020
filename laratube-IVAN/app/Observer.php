<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observer extends Model
{
    protected $fillable = [
        'reference', 'localizador', 'data',
    ];
}
