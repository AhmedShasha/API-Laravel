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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// ######################## All API here must be authenticated ###################33
Route::group(['middleware' => ['api', 'checkPassword', 'checkLanguage'], 'namespace' => 'Api'], function () {
    Route::post('GetCategories', 'CategoriesController@index');
    Route::post('getOneCategory', 'CategoriesController@getCategoryById');
});

Route::group(['middleware' => ['api', 'checkPassword', 'checkLanguage', 'checkAdminToken:admin-api'], 'namespace' => 'Api'], function () {
    Route::get('offers', 'CategoriesController@index');
});
