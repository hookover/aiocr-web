<?php

Route::get('/', 'WelcomeController@index');
Route::get('/file-type', 'WelcomeController@fileType');
Route::get('/agreement', 'WelcomeController@agreement');
Route::get('/news-list', 'WelcomeController@newsList');
Route::get('/news/{id}', 'WelcomeController@news');
Route::get('/contact-us', 'WelcomeController@contactUs');
Route::post('/contact-us', 'WelcomeController@contactUsPost');