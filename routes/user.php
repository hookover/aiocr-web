<?php


Route::group(['middleware' => ['auth:user']], function () { // 指定 auth 的 guard 为 新建的 admins

    Route::get('/user/dashboard', 'DashboardController@dashboard');
    Route::get('/user/statistics', 'DashboardController@statisticsUser');

    Route::get('/user/decode-log', 'User\DecodeLogController@index');


    Route::get('/user/reset-token', 'Backend\SecurityCenterController@resetToken')->name('reset-token-user');

    Route::any('/user/point-lock', 'User\UserController@pointLock')->name('point-lock-user');
    Route::any('/user/point-unlock', 'User\UserController@pointUNLock')->name('point-unlock-user');


    #支付
    Route::get('/user/payment', 'Backend\PaymentController@index')->name('payment-user');
    Route::post('/user/payment/bank', 'Backend\PaymentController@bankPay')->name('payment-bank-user');
    Route::post('/user/payment/card', 'Backend\PaymentController@cardPay')->name('payment-card-user');
    Route::any('/user/payment/alipay', 'Backend\PaymentController@alipay')->name('payment-aliapy-user');


    #安全中心
    Route::any('/user/reset-password', 'Backend\SecurityCenterController@resetPassword')->name('reset-password-user');
    Route::get('/user/reset-userinfo', 'Backend\SecurityCenterController@resetUserInfo');
    Route::post('/user/update-userinfo', 'Backend\SecurityCenterController@updateUserInfo')->name('update-user-info-user');

    #识别统计
    Route::get('/user/statistical-reports', 'User\StatisticalReportsUserController@statisticalReports');

});
