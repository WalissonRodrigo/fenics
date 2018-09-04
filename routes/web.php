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

Route::group(['namespace' => '\Admin'], function () { 
    // custom admin routes
    Route::get('/', 'PersonCrudController@createVocational')->name('vocational.create');
    Route::post('/', 'PersonCrudController@storeVocational')->name('vocational.store');
    Route::get('/{id}', 'ProfileCrudController@showVocaional')->name('vocational.show');
}); 