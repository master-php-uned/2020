<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::apiResource('/channels','API\ChannelController');
Route::apiResource('/videos','API\VideoController');
Route::apiResource('/list','API\WelcomeController');
Route::apiResource('/categories','API\CategoryController');
Route::apiResource('/video-category','API\VideoCategoryController');
Route::apiResource('/pointer','API\PointerController');
Route::resource('/video', 'API\VController')->only([
    'show'
]);


Route::get('categories-view', 'API\CategoryController@view');
