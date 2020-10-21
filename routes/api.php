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

Route::resource('category','CategoryController');
Route::resource('product','ProductController');
Route::post('register','UserController@register');
Route::post('login','UserController@login');
Route::get('view','UserController@view');
Route::post('cart','ProductController@cart');
Route::get('getCategory/{id}','ProductController@category');
Route::resource('order','OrderController');
Route::resource('orderdetails','OrderDetailsController');