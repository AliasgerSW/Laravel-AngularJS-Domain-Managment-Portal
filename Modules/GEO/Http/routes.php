<?php

Route::group(['middleware' => 'web', 'prefix' => 'geo', 'namespace' => 'Modules\GEO\Http\Controllers'], function()
{
    Route::get('/', 'GEOController@index');
});

Route::group(['middleware' => 'web', 'prefix'=>'admin/geo', 'namespace' => 'Modules\GEO\Http\Controllers'], function()
{
    // Country Module Routes
    Route::get('countries/export', 'CountryController@export')->name('countries.export');
    Route::get('countries/import', 'CountryController@import')->name('countries.import');
    Route::post('countries/import', 'CountryController@importPost')->name('countries.import.post');

    Route::resource('countries', 'CountryController');

    // State Module Routes
    Route::get('states/export', 'StateController@export')->name('states.export');
    Route::get('states/import', 'StateController@import')->name('states.import');
    Route::post('states/import', 'StateController@importPost')->name('states.import.post');

    Route::resource('states', 'StateController');

    // City Module Routes
    Route::get('cities/export', 'CityController@export')->name('cities.export');
    Route::get('cities/import', 'CityController@import')->name('cities.import');
    Route::post('cities/import', 'CityController@importPost')->name('cities.import.post');
    Route::post('cities/getCountryIdWithState', 'CityController@getCountryIdWithState')->name('cities.getCountryIdWithState');

    Route::resource('cities', 'CityController');

    // Post Code Module Routes
    Route::get('post-code/export', 'PostCodeController@export')->name('post-code.export');
    Route::get('post-code/import', 'PostCodeController@import')->name('post-code.import');
    Route::post('post-code/import', 'PostCodeController@importPost')->name('post-code.import.post');

    Route::resource('post-code', 'PostCodeController');

    // Languages Module Routes
    Route::get('languages/export', 'LanguagesController@export')->name('languages.export');
    Route::get('languages/import', 'LanguagesController@import')->name('languages.import');
    Route::post('languages/import', 'LanguagesController@importPost')->name('languages.import.post');

    Route::resource('languages', 'LanguagesController');

    // Translation Module Routes
    Route::get('translations/export', 'TranslationController@export')->name('translations.export');
    Route::get('translations/import', 'TranslationController@import')->name('translations.import');
    Route::post('translations/import', 'TranslationController@importPost')->name('translations.import.post');
    Route::post('translations/update', 'TranslationController@transUpdate')->name('translation.update.json');
    Route::post('translations/updateKey', 'TranslationController@transUpdateKey')->name('translation.update.json.key');

    Route::resource('translations', 'TranslationController');

});