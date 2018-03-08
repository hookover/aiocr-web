<?php

Route::group(['middleware' => ['auth:developer']], function () { // 指定 auth 的 guard 为 新建的 admins

    Route::get('/developer/dashboard', 'DashboardController@dashboard');
    Route::get('/developer/statistics', 'DashboardController@statisticsDeveloper');




    #app
    Route::get('/developer/app', 'Developer\AppController@app');
    Route::post('/developer/app/create', 'Developer\AppController@create')->name('create-app');

    #识别日志
    Route::get('/developer/decode-log', 'Developer\DecodeLogController@index');

    #充值卡
    Route::get('/developer/card', 'Developer\CardController@card')->name('card-developer');
    Route::post('/developer/create', 'Developer\CardController@create')->name('create-card');
    Route::get('/developer/export/{status?}', 'Developer\CardController@exportExcel')->name('export-card');

    #提现
    Route::get('/developer/withdraw', 'Developer\WithdrawController@index');
    Route::post('/developer/withdraw', 'Developer\WithdrawController@withdraw');
    Route::get('/developer/withdraw-account', 'Developer\DeveloperController@withdrawAccount');


    #充值
    Route::get('/developer/payment', 'Backend\PaymentController@index')->name('payment-developer');
    Route::post('/developer/payment/bank', 'Backend\PaymentController@bankPay')->name('payment-bank-developer');
    Route::any('/developer/payment/alipay', 'Backend\PaymentController@alipay')->name('payment-aliapy-developer');


    #安全中心
    Route::any('/developer/reset-password', 'Backend\SecurityCenterController@resetPassword')->name('reset-password-developer');
    Route::get('/developer/reset-userinfo', 'Backend\SecurityCenterController@resetUserInfo');
    Route::post('/developer/update-userinfo', 'Backend\SecurityCenterController@updateUserInfo')->name('update-user-info-developer');
    Route::post('/developer/withdraw-account', 'Developer\DeveloperController@withdrawAccountUpdate')->name('withdraw-account-developer');

    #识别统计
    Route::get('/developer/statistical-reports', 'Developer\StatisticalReportsDeveloperController@statisticalReports');

});