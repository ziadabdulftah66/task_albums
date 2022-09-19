<?php

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

### albums routes ######################
Route::resource('albums', \App\Http\Controllers\AlbumController::class)->middleware('auth');
Route::get('/move_Album/{album_id}', '\App\Http\Controllers\AlbumController@move_album')->name('move_album')->middleware('auth');
Route::post('/move_album', '\App\Http\Controllers\AlbumController@moveAlbum')->name('move.Album')->middleware('auth');
###### end the album #############################
### photos routes ######################
Route::post('/storeImages', '\App\Http\Controllers\PhotoController@storeimages')->name('storeImages')->middleware('auth');
Route::post('/storeImages_DB', '\App\Http\Controllers\PhotoController@storeimages_DB')->name('storeImages_DB')->middleware('auth');
Route::get('/DeleteImages/{image_id}', '\App\Http\Controllers\PhotoController@Deleteimages')->name('DeleteImages')->middleware('auth');
Route::get('/moveImages/{image_id}', '\App\Http\Controllers\PhotoController@moveimages')->name('moveImages')->middleware('auth');
Route::post('/move_images', '\App\Http\Controllers\PhotoController@movePHoto')->name('move.photo')->middleware('auth');
##### end photos ###############################


