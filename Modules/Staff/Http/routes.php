<?php

Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Modules\Staff\Http\Controllers'], function()
{
//    Route::get('/', 'StaffController@index');

    Route::group(['middleware' => 'web', 'prefix' => 'staffs'], function()
    {
        Route::resource('addressProofType', 'AddressProofTypesController');
        Route::resource('position', 'StaffPositionsController');
        Route::resource('staffShifts', 'StaffShiftsController');
    });

    Route::post('/states', 'StaffController@states')->name('staff.states');
    Route::post('/cities', 'StaffController@cities')->name('staff.cities');
    Route::resource('staffs', 'StaffController');

});
