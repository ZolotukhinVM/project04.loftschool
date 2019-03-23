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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout');

// administrator

Route::group(['prefix' => '/admin/products', 'middleware' => ['auth', 'level']], function (){
    Route::get('/', 'ProductController@index')->name('product');
    Route::get('create', 'ProductController@create')->name('product.create');
    Route::post('store', 'ProductController@store')->name('product.store');
    Route::get('edit/{product}', 'ProductController@edit')->name('product.edit');
    Route::post('update/{id}', 'ProductController@update')->name('product.update');
    Route::get('destroy/{id}', 'ProductController@destroy')->name('product.destroy');
});

Route::group(['prefix' => '/admin/category', 'middleware' => ['auth', 'level']], function (){
    Route::get('/', 'CategoryController@index')->name('category');
    Route::get('create', 'CategoryController@create')->name('category.create');
    Route::post('store', 'CategoryController@store')->name('category.store');
    Route::get('edit/{category}', 'CategoryController@edit')->name('category.edit');
    Route::post('update/{id}', 'CategoryController@update')->name('category.update');
    Route::get('destroy/{id}', 'CategoryController@destroy')->name('category.destroy');
});

Route::group(['prefix' => '/admin/order', 'middleware' => ['auth', 'level']], function (){
    Route::get('list', 'OrderController@adminList')->name('admin.order.list');
});

// auth user

Route::group(['prefix' => '/order', 'middleware' => ['auth']], function (){
    Route::post('store', 'OrderController@store')->name('order.store');
    Route::get('list', 'OrderController@list')->name('order.list');
});

// all user

Route::group(['prefix' => '/category'], function (){
    Route::get('{category}', 'CategoryController@show')->name('category.show');
});

Route::group(['prefix' => '/product'], function (){
    Route::get('{product}', 'ProductController@detail')->name('product.detail');
});

Route::get('/search', 'ProductController@search')->name('search.result');
Route::get('/ajax/order', 'AjaxController@order')->name('ajax.order');