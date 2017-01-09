<?php

use App\Post;
use Illuminate\Http\Request;

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


Route::group(['middleware' => ['jwt.auth']], function () {

//    Route::post('posts', 'PostController@index');

    Route::get('/user/{id}', function (Request $request) {
        return response(['user' => $request->user()], 200);
    });

    Route::post('post', 'PostController@store');

});

Route::post('auth','AuthenticateController@authenticate');
Route::post('auth/me','AuthenticateController@getAuthenticatedUser');
//Route::post('login','UserController@login');
Route::get('/post/{id}', 'PostController@show');

Route::get('posts', 'PostController@index');



