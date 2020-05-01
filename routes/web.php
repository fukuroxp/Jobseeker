<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', function() {
    return view('home');
});

Route::resource('business', 'BusinessController');

Route::group(['middleware' => 'auth'], function () {
    Route::put('products/{id}/stock', 'ProductController@updateStock')->name('products.updateStock');
    Route::resource('products', 'ProductController');
    Route::post('settings/password', 'SettingController@updatePassword')->name('settings.updatePassword');
    Route::resource('settings', 'SettingController');
    Route::resource('users', 'UserController');
    Route::get('tables/print', 'TableController@print')->name('tables.print');
    Route::resource('tables', 'TableController');
    Route::resource('sells', 'SellController');
});