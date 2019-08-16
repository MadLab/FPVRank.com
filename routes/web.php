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
try {
    DB::connection()->getPdo();
} catch (\Exception $e) {
    die('Database error, please contact developers.    ' . $e->getMessage());
}

//get json for testing
Route::get('/json', 'HomeController@json')->name('json');
///get excel with current rankings
Route::get('/ranking', 'HomeController@ranking')->name('welcome.ranking');


///public routes
Route::prefix('/')->group(function () {
    Route::name('welcome.')->group(function () {
        Route::get('', 'HomeController@index')->name('index'); //index rankings        
        Route::get('/ranking/{text}', 'HomeController@searchByClass')->name('searchclass'); //rankings by class
        Route::get('/pilot/{pilotId}', 'HomeController@pilot')->name('pilot');//show the pilot info
        Route::get('/event-list', 'HomeController@event')->name('event');
        Route::get('/event-list/{eventId}', 'HomeController@getEvent')->name('getevent');

        
        Route::get('/search/{text}/{classId}', 'HomeController@searchRankings')->name('search');
        
        Route::get('/events-info/{text}/{date1}/{date2}', 'HomeController@eventinfo')->name('eventinfo');
        
    });
});

Auth::routes(); //for auth controller
Route::get('home', 'AdminController@index')->name('home'); //for home view in admin
Route::middleware('auth')->group(function () {
    Route::prefix('users')->group(function () {
        Route::name('user.')->group(function () {
            Route::get('/', 'UserController@index')->name('index');
            Route::get('show/{text}', 'UserController@show')->name('show');
            Route::get('create', 'UserController@create')->name('create');
            Route::post('store', 'UserController@store')->name('store');
            Route::get('edit/{id}', 'UserController@edit')->name('edit');
            Route::put('update/{id}', 'UserController@update')->name('update');
        });
    });
    Route::prefix('classes')->group(function () {
        Route::name('class.')->group(function () {
            Route::get('/', 'ClassController@index')->name('index');
            Route::get('show/{text}', 'ClassController@show')->name('show');
            Route::get('create', 'ClassController@create')->name('create');
            Route::post('store', 'ClassController@store')->name('store');
            Route::post('storejson', 'ClassController@storejson')->name('storejson');
            Route::get('edit/{id}', 'ClassController@edit')->name('edit');
            Route::put('update/{id}', 'ClassController@update')->name('update');
        });
    });
    Route::prefix('pilots')->group(function () {
        Route::name('pilot.')->group(function () {
            Route::get('/', 'PilotController@index')->name('index');
            Route::get('show/{text}', 'PilotController@show')->name('show');
            Route::get('create', 'PilotController@create')->name('create');
            Route::post('store', 'PilotController@store')->name('store');
            Route::post('storejson', 'PilotController@storejson')->name('storejson');
            Route::get('edit/{id}', 'PilotController@edit')->name('edit');
            Route::put('update/{id}', 'PilotController@update')->name('update');
        });
    });
    Route::prefix('events')->group(function () {
        Route::name('event.')->group(function () {
            Route::get('/', 'EventController@index')->name('index');
            Route::get('show/{text}', 'EventController@show')->name('show');
            Route::get('create', 'EventController@create')->name('create');
            Route::post('store', 'EventController@store')->name('store');
            Route::post('storejson', 'EventController@storejson')->name('storejson');
            Route::get('edit/{id}', 'EventController@edit')->name('edit');
            Route::put('update/{id}', 'EventController@update')->name('update');
            Route::get('rank/{eventId}/{classId}', 'EventController@rank')->name('rank');
        });
    });
    Route::prefix('results')->group(function () {
        Route::name('result.')->group(function () {
            //Route::get('/', 'ResultController@index')->name('index');
            //Route::get('show/{text}', 'ResultController@show')->name('show');
            //Route::get('create', 'ResultController@create')->name('create');
            //Route::post('store', 'ResultController@store')->name('store');
            //Route::get('edit/{id}', 'ResultController@edit')->name('edit');
            //Route::put('update/{id}', 'ResultController@update')->name('update');
            Route::get('inputs/{count}', 'ResultController@inputs')->name('inputs');
        });
    });
});
