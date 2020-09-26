<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use App\Registry;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
    }

    public function index()
    {
        return Category::all();
    }

    public function view()
    {
        return Category::where('visible','=','true')->get();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Category
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->visible = 'true';
        $category->save();

        // Guardamos un log de registro
        Registry::Record('category', $request->name, 'add-category' );

        return $category ;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Category
     */
    public function show(int $id)
    {
        return Category::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, int $id)
    {
        $category = Category::find($id);
        $category->visible = $request->visible;
        $category->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy(int $id)
    {
        $category = Category::find($id);
        $category->delete();
    }
}
