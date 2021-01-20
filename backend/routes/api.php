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

Route::post('auth/login', 
[
    'uses' => 'AuthController@login',
    'as' => 'login'
]);

Route::post('auth/register', 
[
    'uses' => 'AuthController@register',
    'as' => 'register'
]);

Route::group([
    'middleware' => 'api',
    'prefix' => 'user'
],
    function() {
        Route::get('/profile', 'AuthController@getAuthUser');
        Route::post('/logout', 'AuthController@logout');
    }
);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('upload-image', 'ImageController@uploadImage');
});



Route::get('view-all-images', 'ImageController@viewAllImages');
Route::get('view-image-by-id', 'ImageController@viewImageDetailsByID');
Route::post('search-image-by-title', 'ImageController@searchImageByTitle');
Route::post('filter-image-by-category', 'ImageController@filterImageByCategory');
