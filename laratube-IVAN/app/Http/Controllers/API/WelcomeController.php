<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Video;

class WelcomeController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
       // return Video::all()->where('data','!=','');
        return Video::with('categories')->paginate(20);
    }
}
