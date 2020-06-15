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

Route::get('/unauthorized', function (Request $request) {
    return response((['error' => 'Unauthorized. You need credentials to access']), 401);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('images', 'ImageController');
// Route::resource('categories', 'CategoryController');
Route::resource('workSections', 'WorkSectionController');
Route::resource('socialNetworks', 'SocialNetworkController');
Route::resource('messages', 'MessageController');
//Route::resource('auth', 'AuthController');

Route::get('/images/test', 'ImageController@test');

// Route::group([
//     'prefix' => 'messages',
// ], function () {
//     Route::middleware('auth:api')->post('/', 'MessageController@store');
//     Route::middleware('auth:api')->put('/{id}', 'MessageController@update');
//     Route::middleware('auth:api')->delete('/{id}', 'MessageController@delete');
//     Route::get('/', 'MessageController@index');
//     Route::get('/{id}', 'MessageController@show');
// });

// Route::group([
//     'prefix' => 'socialNetworks',
// ], function () {
//     Route::middleware('auth:api')->post('/', 'SocialNetworkController@store');
//     Route::middleware('auth:api')->put('/{id}', 'SocialNetworkController@update');
//     Route::middleware('auth:api')->delete('/{id}', 'SocialNetworkController@delete');
//     Route::get('/', 'SocialNetworkController@index');
//     Route::get('/{id}', 'SocialNetworkController@show');
// });

// Route::group([
//     'prefix' => 'workSections',
// ], function () {
//     Route::middleware('auth:api')->post('/', 'WorkSectionController@store');
//     Route::middleware('auth:api')->put('/{id}', 'WorkSectionController@update');
//     Route::middleware('auth:api')->delete('/{id}', 'WorkSectionController@delete');
//     Route::get('/', 'WorkSectionController@index');
//     Route::get('/{id}', 'WorkSectionController@show');
// });

Route::group([
    'prefix' => 'works',
], function () {
    Route::middleware('auth:api')->post('/', 'WorkController@store');
    Route::middleware('auth:api')->put('/{id}', 'WorkController@update');
    Route::middleware('auth:api')->delete('/{id}', 'WorkController@delete');
    Route::middleware('auth:api')->get('/', 'WorkController@index');
    Route::get('/getActiveWorks', 'WorkController@getActiveWorks');
    Route::get('/{id}', 'WorkController@show');
});

Route::group([
    'prefix' => 'categories',
], function () {
    Route::middleware('auth:api')->post('/', 'CategoryController@store');
    Route::middleware('auth:api')->put('/{id}', 'CategoryController@update');
    Route::middleware('auth:api')->delete('/{id}', 'CategoryController@delete');
    Route::get('/', 'CategoryController@index');
    Route::get('/{id}', 'CategoryController@show');
});

Route::group([
    'prefix' => 'users',
], function () {
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    Route::middleware('auth:api')->get('/', 'UserController@index');
});
