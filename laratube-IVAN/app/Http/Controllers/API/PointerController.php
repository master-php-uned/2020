<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use App\Pointer;
use App\Registry;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;

class PointerController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
    }


    public function index()
    {

    }


    public function view()
    {

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request

     */
    public function store(Request $request)
    {


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
     * @return string
     */
    public function update(Request $request, int $id)
    {
        echo $id;
        $pointer = Pointer::get()->first();
        $pointer->localizador = $request->localizador;
        $pointer->save();
        Artisan::call('schedule:run');
        return " schedule:run";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy(int $id)
    {

    }
}
