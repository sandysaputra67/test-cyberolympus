<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/category/{slug}', 'HomeController@category')->name('category');
Route::get('/product/{slug}', 'HomeController@product')->name('product');

Route::get('logout','Auth\LoginController@logout');

Route::group(["middleware" => ["is_thisAgent","auth"]],function (){
    Route::group(["namespace" => "Agent"], function (){
        Route::resource("agent-users","UsersController");
        Route::resource("agent-category","CategoryController");
        Route::resource("agent-products","ProductController");
        Route::resource("agent-min-orders","OrderController");
    });
});


Route::group(['prefix' => 'basket'], function () {
    Route::get('/', 'BasketController@index')->name('basket');

    Route::post('/create', 'BasketController@create')->name('basket.create');
    Route::delete('/destroy', 'BasketController@destroy')->name('basket.destroy');
    Route::patch('/update/{rowid}', 'BasketController@update')->name('basket.update');
});




Route::get('/orders', 'OrderController@index')->name('orders');
Route::get('/orders/{id}', 'OrderController@detail')->name('order');

Route::resource('profile', 'UserDetailController')->middleware('auth');