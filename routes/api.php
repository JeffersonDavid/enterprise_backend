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

Route::middleware(['throttle:1000,1','auth:api'])->group(function () {
    Route::post('v1/orders', 'App\Http\Controllers\DatalakeController@intertOrders');
});


Route::middleware(['throttle:1000,1'])->group(function () {
    Route::post('v1/token', 'App\Http\Controllers\AuthController@getToken');
});


Route::get('Unauthorized', function () {
    return response()->json(['message' => 'Unauthorized'], 401);
})->name('unauthorized.json');



