<?php

namespace App\Http\Controllers\API;

use App\Channel;
use App\Http\Controllers\Controller;
use App\Registry;
use Illuminate\Http\Request;

class ChannelController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return Channel::all();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Channel
     */
    public function store(Request $request)
    {
        $channel = new Channel();
        $channel->url = $request->url;
        $channel->service = $request->service;
        $channel->save();

        // Guardamos un log de registro
        Registry::Record('channel', $request->url, 'add-channel' );

        // Lo añadimos al observador
        Registry::Observer('channel', $request->url, 'add-channel' );

        return $channel ;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Channel
     */
    public function show(int $id)
    {
        return Channel::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, int $id)
    {
        $channel = Channel::find($id);
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
        $channel = Channel::find($id);
        $channel->delete();
    }
}
