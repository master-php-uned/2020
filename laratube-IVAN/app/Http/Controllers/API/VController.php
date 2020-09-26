<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Registry;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function show($id)
    {
        return  Video::find($id);
    }
}
