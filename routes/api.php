<?php

use Illuminate\Http\Request;

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

Route::group(['middleware'=>'auth:api','prefix'=>'v1'], function(){
    
    Route::group(['prefix'=>'user'], function(){
        Route::resource('', 'Api\User');

        Route::resource('info', 'Api\UserInfo');
    });

    Route::resource('department', 'Api\Department');
    Route::resource('agency', 'Api\Agency');


    Route::post('done-instruction', 'Api\Helpers@updateInstruction');

    Route::post('delete-event/{id}', 'EventController@deleteEvent');
});

Route::group(['prefix'=>'v1','middleware'=>['auth:api']], function(){
    Route::resource('user', 'Api\User');
});

Route::post("v1/feedback", 'Api\Feedback@store');
