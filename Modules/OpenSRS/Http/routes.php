<?php

Route::group(['middleware' => 'web', 'prefix' => 'opensrs', 'namespace' => 'Modules\OpenSRS\Http\Controllers'], function()
{
    Route::get('/', 'OpenSRSController@index');
});
