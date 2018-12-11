<?php

Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    Route::get('/', 'UserController@index');
    Route::get('/register-individual', 'UserController@showIndividualForm')->name('show.individual.form');
    Route::post('/basic-detail', 'UserController@savebasic')->name('save.basic.info');
});
