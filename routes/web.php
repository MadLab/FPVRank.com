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

Auth::routes();
Route::get('home', 'AdminController@index')->name('home');

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
            Route::get('edit/{id}', 'EventController@edit')->name('edit');
            Route::put('update/{id}', 'EventController@update')->name('update');
        });
    });
    Route::prefix('results')->group(function () {
        Route::name('result.')->group(function () {
            Route::get('/', 'ResultController@index')->name('index');
        });
    });
});
