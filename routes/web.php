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

Route::group(['prefix'=>'super_admin','middleware'=>['auth','super_admin']], function(){
    Route::get('/', 'PageController@members')->name('page.member');
});

Route::group(['prefix'=>'members','middleware'=>['auth','completely_verified']], function(){
    Route::group(['prefix'=>'events'], function(){
        Route::get('/edit-event/{id}', 'EventController@editEvent')->name('event.edit');
        Route::post('/edit-event/{id}', 'EventController@updateEvent')->name('event.update');
        Route::get('/', 'PageController@events')->name('page.events');
        Route::get('{id}', 'EventController@view')->name('event.view');
        Route::get('register/{id}/{fee}', 'EventController@register')->name('event.register');
        Route::post('pay/{id}/{fee}', 'EventController@pay')->name('event.pay');
    });

    Route::get('dashboard', 'MembersController@dashboard')->name('member.dashboard');
    
    Route::post('/add-event', 'PageController@add_event')->name('page.add-event');
});

Route::get('event-materials/{id}', "EventController@materials")->name('event.materials');
Route::get('event-materials/demo/{url}', "EventController@demo")->name('event.materials.demo');

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
    Route::get('/users/print', 'ReportController@userExport')->name('report.user.list');
});

Route::group(['prefix'=>'payments', 'middleware'=>['auth','super_admin']], function(){
    Route::get('review/{event_id}', 'PaymentController@review')->name('payment.review');
    Route::post('review/{registered_id}', 'PaymentController@paid')->name('payment.paid');
});

// Attendee Validator
Route::get('validator/{event_id}', 'EventController@validator_page')->name('validator.page');
Route::get('validator/{event_id}/{code}', 'EventController@validator')->name('validator.validate');


Route::group(['prefix'=>'account','middleware'=>['auth']], function(){
    Route::get('information', 'AccountController@information')->name('page.account_info');
    Route::post('update-information','AccountController@update_information')->name('page.update-account');
});


Route::group(['prefix'=>'mail'], function(){
    
});

Route::get('{event}/images/{id}', "PhotoController@display_image")->name('image.viewer');




Route::group(['prefix'=>'artisan'], function(){
    Route::group(['prefix'=>'migrate'], function(){
        Route::get('/', function(){
            if(!Artisan::call('migrate')){
                echo 'migration complete';
            } else {
                echo 'migration failed';
            }
        });
        Route::get('/new', function(){
            if(!Artisan::call('migrate:fresh')){
                echo 'fresh migration complete';
            } else {
                echo 'migration failed';
            }
        });

        Route::get('rollback', function(){
            if(!Artisan::call('migrate:rollback')){
                echo 'migration rollback complete';
            } else {
                echo 'migration failed';
            }
        });

        Route::get('seed', function(){
            if(!Artisan::call('migrate:fresh --seed')){
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

    Route::get('storage-link', function(){
        echo Artisan::call('storage:link');
    });

    Route::get('up', function(){
        echo Artisan::call('up');
        return redirect('/home');
    });

    Route::get('down', function(){
        echo Artisan::call('down');
        return redirect('/home');
    });

    Route::get('optimize-clear', function(){
        echo Artisan::call('optimize:clear');
        return redirect('/home');
    });
    Route::get('passport-install', function(){
        echo Artisan::call('passport:install');
        return redirect('/home');
    });

});
