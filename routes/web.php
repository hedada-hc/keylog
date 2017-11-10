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

Route::get('/login', function () {
    return view('welcome');
});

Route::get('/key',function(){
	return view('key');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth', "namespace" => "Admin"], function() {
    Route::resource('/admin/index', "IndexController");
    Route::get('/admin/api/key', "IndexController@KeyLog");
    Route::get('admin/export','ExcelController@export');
});



