<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use App\Registry;

use App\VideoCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VideoCategoryController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
    }


    public function index()
    {
        return Category::all();

        // Devuelve con los videos por categoria
        //return Category::with('videos')->get();
    }


    public function view()
    {

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return VideoCategory
     */
    public function store(Request $request)
    {
        $videoCategory = null;

        if($request->category_selected == true) {

            $videoCategory = new VideoCategory();
            $videoCategory->video_id = $request->video_id;
            $videoCategory->category_id = $request->category_id;
            $videoCategory->save();
        }

        return $videoCategory;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show(int $id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, int $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param int $id
     */
    public function destroy(Request $request, int $id)
    {
        $videoCategory = VideoCategory::where('category_id','=',$id,'and')->where('video_id','=',$request->video_id);
        $videoCategory->delete();
    }
}
