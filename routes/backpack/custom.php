<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace' => 'App\Http\Controllers\Admin',
], function () { 
    // custom admin routes
    CRUD::resource('person', 'PersonCrudController');
    CRUD::resource('answer', 'AnswerCrudController');
    CRUD::resource('question', 'QuestionCrudController');
    CRUD::resource('profile', 'ProfileCrudController')->with(function () {
        Route::get('profile/chart/pie', 'ProfileCrudController@chartPie')->name('profile.chart.pie');
    });
    CRUD::resource('schooling', 'SchoolingCrudController');
}); 

// this should be the absolute last line of this file
