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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login','UserController@login');
    Route::post('/register','UserController@register');
    Route::post('/logout','UserController@logout');
    Route::post('/refresh','UserController@refresh');
    Route::get('/user-profile','UserController@userProfile');
    Route::get('/admin', 'UserController@verify');
});

Route::resource('products', 'ProductController');
// Route::resource('products.categories' , 'ProductCategoryController');
Route::resource('products.categories' , 'ProductCategoryController') ;

// 2405381739


Route::resource('categories', 'CategoryController');

Route::resource('categories.products' , 'CategoryProductController', ['only' => ['index']]) ;
