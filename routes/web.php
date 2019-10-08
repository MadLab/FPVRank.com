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

///public routes

Route::prefix('/')->group(function () {
    Route::name('welcome.')->group(function () {
        Route::get('', 'HomeController@index')->name('index'); //index rankings
        Route::get('/class/{classId}/{country}', 'HomeController@searchByClass')->name('searchclasscountry'); //rankings by class and country
        Route::get('/pilot/{pilotId}', 'HomeController@pilot')->name('pilot'); //show the pilot info
        Route::get('/event-list', 'HomeController@event')->name('event'); ///event public home page *event List
        Route::get('/event-list/{eventId}', 'HomeController@getEvent')->name('getevent'); ///open event info page by eventId
        Route::get('/search/{text}/{classId}/{country}', 'HomeController@searchRankings')->name('search'); ///change rankings grid
        Route::get('/events-info/{text}/{date1}/{date2}', 'HomeController@eventinfo')->name('eventinfo'); ///change events grid

        Route::get('/pilots-autocomplete', 'HomeController@fillAutoCompletePilots')->name('autocompletepilots'); ///change events grid
        Route::get('/search-pilots/{text}', 'HomeController@searchPilotsByName')->name('searchpilotsbyname'); ///change events grid

    });
});


Auth::routes(['register' => false]); //for auth controller

Route::get('home', 'AdminController@index')->name('home'); //for home view in admin
Route::get('profile', 'AdminController@editProfile')->name('profile.edit'); //show view for edit profile
Route::put('profile', 'AdminController@updateProfile')->name('profile.update'); //editprofile

Route::middleware(['auth', 'permission'])->group(function () {
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
            Route::post('update/{id}', 'PilotController@update')->name('update');
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
            Route::get('inputs/{count}', 'ResultController@inputs')->name('inputs');
        });
    });
});
