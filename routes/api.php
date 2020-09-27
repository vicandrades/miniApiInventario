<?php

use App\Http\Middleware\CheckUser;
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

Route::middleware('auth:api', CheckUser::class)->get('/dashboard', 'AdminController@adminHome')->name('dashboard');
//Route::middleware('auth:api')->get('/userAdmin', 'AdminController@adminHome')->name('userAdmin');
Route::middleware('auth:api', CheckUser::class)->post('/addProduct', 'AdminController@addProduct')->name('addProduct');
Route::middleware('auth:api', CheckUser::class)->post('/defineMinStock', 'AdminController@defineMinStock')->name('defineMinStock');
Route::middleware('auth:api', CheckUser::class)->post('/modifyStockPrice', 'AdminController@modifyStockPrice')->name('modifyStockPrice');

Route::middleware('auth:api')->get('/userHome', 'UserController@userHome')->name('userHome');
Route::middleware('auth:api')->post('/buyProducts', 'UserController@buyProducts')->name('buyProducts');

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('signup', 'AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});
