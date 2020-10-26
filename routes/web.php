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
    return view('welcome');
});



Route::group(['prefix' => 'api'], function () {
    Auth::routes();
    Route::put('/test', 'MainController@test');
    Route::put('/test2', 'MainController@test2');
    Route::post('/registration', 'MainController@registration');
    Route::post('/getusers', 'MainController@getotherusers');
    Route::put('/profiledit', 'MainController@profiledit');
    Route::delete('/deletion', 'MainController@deletion');
});
