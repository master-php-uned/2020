<?php

use App\Pointer;
use App\Video;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/channels', 'HomeController@index')->name('channel');
Route::get('/videos', 'HomeController@videos')->name('videos');
Route::get('/categories', 'HomeController@category')->name('category');



