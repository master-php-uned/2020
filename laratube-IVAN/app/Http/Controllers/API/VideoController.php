<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Registry;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return Video::all();
    }

    public function getList()
    {
        return Video::all()->where('data','!=','');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Video
     */
    public function store(Request $request)
    {
        $video = new Video();

        // Guardamos un log de registro
        Registry::Record('video', $request->url, 'add-video' );

        // Lo añadimos al observador
        Registry::Observer('video', $request->url, 'add-video' );

        return $video ;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Collection
     */
    public function show(int $id)
    {
        return DB::table('videos')
                ->join('video_categories','video_categories.video_id','=','videos.id')
                ->where('videos.data','!=','','and')
                ->where('video_categories.category_id','=',$id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, int $id)
    {
        $channel = Video::find($id);
        $channel->url = $request->url;
        $channel->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy(int $id)
    {
        $channel = Video::find($id);
        $channel->delete();
    }
}
