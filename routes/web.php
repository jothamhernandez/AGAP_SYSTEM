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

Auth::routes(['verify'=>true]);


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'members'], function(){
    Route::get('/', 'PageController@members')->name('page.member');
});


Route::group(['prefix'=>'account'], function(){
    Route::get('information', 'AccountController@information')->name('page.account_info');
});