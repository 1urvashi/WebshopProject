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

Route::resource('orders', OrderController::class);
Route::post('orders/{order}/add', 'OrderController@addProduct');
Route::post('orders/{order}/pay', 'OrderController@payOrder');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

