<?php

use App\Post;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

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

    Route::resource('post', 'PostController');

});

Route::post('auth', 'AuthenticateController@authenticate');
Route::post('auth/me', 'AuthenticateController@getAuthenticatedUser');
//Route::post('login','UserController@login');
Route::get('/post/{id}', 'PostController@show');
Route::get('posts', 'PostController@index');
