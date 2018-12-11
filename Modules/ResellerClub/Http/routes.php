<?php

Route::group(['middleware' => 'web', 'prefix' => 'resellerclub', 'namespace' => 'Modules\ResellerClub\Http\Controllers'], function()
{
    Route::get('/', 'ResellerClubController@index');
});
