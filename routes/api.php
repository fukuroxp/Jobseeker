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

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/logout', 'AuthController@logout');
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api', 'middleware' => ['jwt.verify']], function () {
    Route::post('sells/{id}/pay', 'SellController@pay');
    Route::get('sells/products', 'SellController@getProductSuggestion');
    Route::apiResource('sells', 'SellController');

    Route::get('orders/products/{business_id}', 'OrderController@getProductSuggestion');
    Route::post('orders/{id}/accept', 'OrderController@accept');
    Route::post('orders/{id}/reject', 'OrderController@reject');
    Route::put('orders', 'OrderController@updateOrder');
    Route::apiResource('orders', 'OrderController');

    Route::post('notify', 'HomeController@notify');
});