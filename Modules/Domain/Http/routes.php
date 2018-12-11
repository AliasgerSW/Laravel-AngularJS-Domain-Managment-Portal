<?php

Route::group(['middleware' => 'web', 'prefix' => 'domain', 'namespace' => 'Modules\Domain\Http\Controllers'], function()
{
    Route::get('/', 'DomainController@index');

    Route::get('list-continents', 'ContinentController@list');
    Route::get('list-groups', 'TldGroupController@list');

    Route::resource('tld', 'TldController');
    Route::post('tld-other-details', 'TldController@storeOtherDetails');
    Route::post('tld-feature-service', 'TldsFeaturesServicesController@store');
    Route::post('save-continent', 'TldController@saveContinent');
    Route::post('save-category', 'TldController@saveCategoryGroup');



    Route::resource('tld-group', 'TldGroupController');
    Route::post('tld-group-restore/{id}', 'TldGroupController@restore')->name('tld-group.restore');
    Route::delete('tld-group-permanent/{id}', 'TldGroupController@permanentDelete')->name('tld-group.permanentDelete');

    Route::post('tlds-prices', 'TldsPricesController@store');
    Route::post('update-tlds-prices', 'TldsPricesController@update');
    Route::delete('tlds-prices/{id}', 'TldsPricesController@destroy');

    Route::post('tlds-renewal-prices', 'TldsRenewalPricesController@store');
    Route::post('update-tlds-renewal-prices', 'TldsRenewalPricesController@update');
    Route::delete('tlds-renewal-prices/{id}', 'TldsRenewalPricesController@destroy');

    Route::get('tlds-pull' , 'TldController@pullSaveTldsFromResellerClub')->name('tlds.pull');

});


Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Modules\Domain\Http\Controllers'], function()
{

    Route::resource('domain', 'DomainController');

    Route::group(['middleware' => 'web', 'prefix' => 'domains'], function()
    {
        Route::get('tld/details', 'TldController@tlddetails');

        Route::get('domainDetail/{id}', 'DomainController@show');
            Route::get('tld/details', 'TldController@tldDetails')->name('admin.domains.tld.details');
        Route::get('tld/details/{id}', 'TldController@tldDetails');
        Route::get('tld/create-raw-data', 'TldController@create_raw_data');
        Route::post('tld/store-tld-row', 'TldController@store_raw_data')->name('admin.domains.tld.store-tld-row');
        Route::post('tld/tld-active-inactive-for-sale', 'TldController@tld_active_inactive_for_sale')->name('admin.domains.tld.tld-active-inactive-for-sale');
        Route::post('tld/change-registrar', 'TldController@change_registrar')->name('admin.domains.tld.change-registrar');
        Route::post('tld/change-sequence', 'TldController@change_sequence')->name('admin.domains.tld.tld-change-sequence');
        Route::post('tld/store-tld', 'TldController@store_tld')->name('admin.domains.tld.store-tld');
        Route::post('tld/tld-active-force-fully', 'TldController@tld_active_force_fully')->name('admin.domains.tld.tld-active-force-fully');
        //Route::resource('tld', 'TldController');
        Route::post('ajax/contactDetails', 'DomainContactDetailController@contactDetails');
        Route::post('ajax/theftProtection', 'DomainProtectionController@theftProtection')->name('admin.domains.domain.theftprotection');
        Route::post('ajax/domainSecret', 'DomainProtectionController@domainSecret')->name('admin.domains.domain.domainsecret');
        Route::post('ajax/domainNameServers', 'DomainServerController@domainNameServers');
        Route::post('ajax/domainChildNameServers', 'DomainServerController@domainChildNameServers');
        Route::post('ajax/removeDomainChildNameServers', 'DomainServerController@removeDomainChildNameServers');
        Route::post('ajax/domainDNSSEC', 'DomainServerController@domainDNSSEC');
        Route::post('ajax/domainForwardingSave', 'DomainServerController@domainForwardingSave');
        Route::post('ajax/privacyProtection', 'DomainProtectionController@privacyProtection');
        Route::post('ajax/domainGDPRProtection', 'DomainProtectionController@domainGDPRProtection')->name('admin.domains.domain.gdprprotection');

        Route::post('ajax/domainForwarding', 'DomainProtectionController@domainForwarding')->name('admin.domains.domain.domainforwarding');
        Route::post('ajax/domainForwardingEdit', 'DomainProtectionController@domainForwardingEdit');
        Route::post('ajax/domainForwardingDelete', 'DomainProtectionController@domainForwardingDelete');

        Route::post('ajax/addDNSRecords', 'DNSRecordsController@addDNSRecords');
        Route::post('ajax/editDNSRecords', 'DNSRecordsController@editDNSRecords');
        Route::post('ajax/deleteDNSRecords', 'DNSRecordsController@deleteDNSRecords');

        Route::post('ajax/createContactDetail', 'DomainContactDetailController@createContactDetail');

        Route::get('singledomain/{id}', 'DomainController@singleDomain');

    });

});