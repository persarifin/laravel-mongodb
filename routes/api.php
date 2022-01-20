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

Route::prefix('auth')->group(function () {
    Route::post('login', 'UserController@login')->name('login');
    Route::post('register', 'UserController@register')->name('register');
    
});

Route::group(['middleware' => ['auth:api']], function(){
    Route::resource('payment-methods', 'PaymentMethodController')->only(['index','store','update','destroy']);
    Route::resource('payment-expireds', 'PaymentExpiredController')->only(['index','store','update','destroy']);
    Route::resource('sales', 'SalesController')->only(['index','store','destroy']);
    Route::resource('transactions', 'TransactionController')->only(['index','store','destroy']);
    Route::resource('transportations', 'TransportationController')->only(['index','store','update','destroy']);
    Route::put('update-status-cancel/{id}', 'SalesController@updateStatusCancel');

});
