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

Route::group(['prefix'=>'super_admin','middleware'=>['super_admin']], function(){
    Route::get('/', 'PageController@members')->name('page.member');
});

Route::group(['prefix'=>'members','middleware'=>['auth','completely_verified']], function(){
    Route::group(['prefix'=>'events'], function(){
        Route::get('/', 'PageController@events')->name('page.events');
        Route::get('{id}', 'EventController@view')->name('event.view');
        Route::get('register/{id}/{fee}', 'EventController@register')->name('event.register');
        Route::post('pay/{id}/{fee}', 'EventController@pay')->name('event.pay');
    });
    
    Route::post('/add-event', 'PageController@add_event')->name('page.add-event');
});

Route::group(['prefix'=>'departments','middleware'=>['auth','super_admin']], function(){
    Route::get('/', 'DepartmentController@index')->name('page.departments');
});

Route::group(['prefix'=>'agencies','middleware'=>['auth','super_admin']], function(){
    Route::get('/', 'AgencyController@index')->name('page.agencies');
    Route::post('/import','ImportController@import_agencies')->name('agency.import');
});

Route::group(['prefix'=>'reports', 'middleware'=>['auth','super_admin']], function(){
    Route::get('/', 'ReportController@index')->name('page.reports');
    Route::get('/print/{event_id}', 'ReportController@export')->name('report.print.event');
});

Route::group(['prefix'=>'payments', 'middleware'=>['auth','super_admin']], function(){
    Route::get('review/{event_id}', 'PaymentController@review')->name('payment.review');
    Route::post('review/{registered_id}', 'PaymentController@paid')->name('payment.paid');
});


Route::group(['prefix'=>'account'], function(){
    Route::get('information', 'AccountController@information')->name('page.account_info');
    Route::post('update-information','AccountController@update_information')->name('page.update-account');
});


Route::group(['prefix'=>'mail'], function(){
    
});




Route::group(['prefix'=>'artisan'], function(){
    Route::group(['prefix'=>'migrate'], function(){
        Route::get('/', function(){
            Artisan::call('migrate:fresh');
        });

        Route::get('rollback', function(){
            Artisan::call('migrate:rollback');
        });

        Route::get('seed', function(){
            if(Artisan::call('migrate:fresh --seed')){
                echo "migrated fresh and seeded";
            } else {
                echo "Not able to migrate";
            }
        });
    });

    Route::get('clear-cache', function(){
        Artisan::call('cache:clear');
    });

    Route::get('inspire', function(){
        echo Artisan::call('inspire');
    });
});