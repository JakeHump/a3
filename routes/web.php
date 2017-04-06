<?php

/**
* Log viewer
* (only accessible locally)
*/
if(config('app.env') == 'local') {
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
}

/**
* Main homepage visitors see when they visit just /
*/
Route::get('/', 'WelcomeController');
