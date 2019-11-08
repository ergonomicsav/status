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

Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('welcome');
});


Route::group(['namespace' => 'Status'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/ssl', 'SslController@execute');
    Route::get('/expiry', 'ExpiryController@execute');
    Route::get('/domain/{id}', 'SingleDomainController@index')->name('domain');
    Route::resources([
        '/domains' => 'DomainController'
    ]);
});


