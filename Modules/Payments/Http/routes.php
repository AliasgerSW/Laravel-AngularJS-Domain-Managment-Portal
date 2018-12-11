<?php

Route::group(['middleware' => 'web', 'prefix' => 'payments', 'namespace' => 'Modules\Payments\Http\Controllers'], function()
{
    Route::get('/', 'PaymentsController@index');




    Route::get('/method/amount', 'PaymentsController@amount');
    Route::get('/method/percent', 'PaymentsController@percent');
    Route::get('/method/changeStatus', 'PaymentsController@changeStatus');
    Route::get('/setting', 'PaymentsController@settings')->name('payments.settings');



//    ************* PayPal Routes ****************
    Route::get('/paypal', 'PayPalController@index')->name('method.paypal');

    Route::get('/pro','PayPalController@proRedirect')->name('paypal.pro.payment');
    Route::post('/pro/payment/process','PayPalController@processProPayment')->name('paypal.pro.payment-process');



//    ************* Authorize Routes ****************

    Route::get('/authorizepayment','AuthorizeController@index')->name('authorize.net.index');
    Route::post('/authorizepayment/process','AuthorizeController@processPayment')->name('authorize.net.process');


//    ************* Sofort Routes ****************

    Route::get('/sofort','SofortController@processPayment')->name('sofort.payment.process');

//    ************* MultiSafe Routes ****************
Route::get('/multisafe','MultiSafeController@processPayment');


});

