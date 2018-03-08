<?php

Route::get('/go-to-home', 'Admin\LoginController@showLoginForm');
Route::post('logout', 'Auth\LoginController@logout')->name('logout-out-admin');

Route::group(['middleware'=>['check_captcha']], function(){
    Route::post('/login', 'Admin\LoginController@login')->name('login-admin');
});


Route::group(['middleware' => ['auth:admin']], function () { // 指定 auth 的 guard 为 新建的 admins
    Route::get('/admin/dashboard', 'Admin\DashboardController@dashboard');
    Route::get('/admin/reset-password', 'Admin\SecurityCenterController@resetPassword');
    Route::post('/admin/reset-password', 'Admin\SecurityCenterController@resetPassword')->name('reset-password-admin');
    Route::post('/admin/payment/admin-pay', 'Admin\PaymentController@adminPay')->name('payment-admin');
    Route::post('/admin/payment/confirm-bank-transfer', 'Admin\PaymentController@confirmBankTransfer')->name('confirm-bank');

    Route::get('/admin/statistics', 'Admin\DashboardController@statistics');

    Route::resource('/admin/admin', 'Admin\AdminController');
    Route::resource('/admin/user', 'Admin\UserController');
    Route::resource('/admin/developer', 'Admin\DeveloperController');
    Route::resource('/admin/app', 'Admin\AppController');
    Route::resource('/admin/file', 'Admin\FileController');
    Route::resource('/admin/file_type', 'Admin\FileTypeController');
    Route::resource('/admin/card', 'Admin\CardController');
    Route::resource('/admin/withdraw', 'Admin\WithdrawController');
    Route::resource('/admin/payment', 'Admin\PaymentController');
    Route::resource('/admin/payment_gift', 'Admin\PaymentGiftController');
    Route::resource('/admin/developer_log', 'Admin\DeveloperLogController');
    Route::resource('/admin/user_log', 'Admin\UserLogController');
    Route::resource('/admin/password_developer_reset', 'Admin\PasswordDeveloperResetController');
    Route::resource('/admin/password_user_reset', 'Admin\PasswordUserResetController');
    Route::resource('/admin/news', 'Admin\NewsController');
    Route::resource('/admin/server_id', 'Admin\ServerIDController');
    Route::resource('/admin/contact_us', 'Admin\ContactUsController');
    Route::resource('/admin/statistical_reports_admin', 'Admin\StatisticalReportsAdminController');
    Route::resource('/admin/statistical_reports_developer', 'Admin\StatisticalReportsDeveloperController');
    Route::resource('/admin/statistical_reports_user', 'Admin\StatisticalReportsUserController');

    Route::get('/admin/withdraw/agree/{id}', 'Admin\WithdrawController@agree');
    Route::post('/admin/withdraw/refuse/{id}', 'Admin\WithdrawController@refuse');
});
