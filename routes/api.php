<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\CategoryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//user
Route::get('/user','UserController@index');
Route::post('/user','UserController@store');

//category
Route::get('/category','CategoryController@index');
Route::post('/category','CategoryController@store');

//post
Route::get('/posts','PostController@index');
Route::post('/posts','PostController@store');
route::post('/posts/{id}','PostController@update');
route::delete('/posts/{id}','PostController@destroy');
route::post('/posts/search','PostController@search');