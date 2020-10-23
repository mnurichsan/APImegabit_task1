<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/login', 'API\UsersControllerAPI@login');
Route::post('/register', 'API\UsersControllerAPI@register');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/post', 'API\PostController@index');
    Route::post('/post', 'API\PostController@store');
    Route::post('/post/edit/{id}', 'API\PostController@update');
    Route::delete('post/delete/{id}', 'API\PostController@destroy');
});
