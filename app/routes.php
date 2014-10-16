<?php

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/
Route::get('/', '\App\Controllers\PublicController@index');
Route::get('/booking', '\App\Controllers\PublicController@booking');
Route::get('/faqs', '\App\Controllers\PublicController@faqs');
Route::get('/locations', '\App\Controllers\PublicController@locations');
Route::get('/pricing', '\App\Controllers\PublicController@pricing');
Route::get('/contact-us', '\App\Controllers\PublicController@contactUs');
Route::post('/contact-us', '\App\Controllers\PublicController@postContact');
Route::get('/privacy-policy', '\App\Controllers\PublicController@privacyPolicy');
Route::get('/terms', '\App\Controllers\PublicController@terms');
Route::get('/message', '\App\Controllers\PublicController@message');
Route::get('/giftcard', '\App\Controllers\PublicController@getPurchaseGiftcard');
Route::post('/giftcard', '\App\Controllers\PublicController@postPurchaseGiftcard');

Route::post('/check-zip-code', '\App\Controllers\PublicController@checkZipCode');
Route::get('/yelp-confirm', '\App\Controllers\PublicController@getYelpConfirm');
Route::get('/test', '\App\Controllers\PublicController@getTest');

Route::get('/city/{cityname}', '\App\Controllers\PublicController@landingpage');

/*
|--------------------------------------------------------------------------
| Customers
|--------------------------------------------------------------------------
*/
Route::controller('customer', '\App\Controllers\CustomerController');
Route::controller('password', '\App\Controllers\RemindersController');

/*
|--------------------------------------------------------------------------
| Jobs
|--------------------------------------------------------------------------
*/
Route::controller('job', '\App\Controllers\JobController');

/*
|--------------------------------------------------------------------------
| Cronjob
|--------------------------------------------------------------------------
*/
Route::controller('cron', '\App\Controllers\CronController');


/*
|--------------------------------------------------------------------------
| Admin Default
|--------------------------------------------------------------------------
*/
Route::get('admin', '\App\Controllers\Admin\JobController@anyIndex');


/*
|--------------------------------------------------------------------------
| Admin Jobs
|--------------------------------------------------------------------------
*/
Route::controller('admin/job', '\App\Controllers\Admin\JobController');


/*
|--------------------------------------------------------------------------
| Admin Members
|--------------------------------------------------------------------------
*/
Route::controller('admin/user', '\App\Controllers\Admin\UserController');


/*
|--------------------------------------------------------------------------
| Admin Auth
|--------------------------------------------------------------------------
*/
Route::get('admin/login', '\App\Controllers\Admin\AuthenController@login');
Route::post('admin/login', '\App\Controllers\Admin\AuthenController@postLogin');
Route::get('admin/logout', '\App\Controllers\Admin\AuthenController@logout');


/*Admin Teams*/
Route::controller('admin/team', '\App\Controllers\Admin\TeamController');

/*Admin Customers*/
Route::controller('admin/customer', '\App\Controllers\Admin\CustomerController');

/*Admin Service Type*/
Route::controller('admin/service-type', '\App\Controllers\Admin\ServiceTypeController');

/*Admin Service Frequency*/
Route::controller('admin/service-frequency', '\App\Controllers\Admin\ServiceFrequencyController');

/*Admin Service Extra*/
Route::controller('admin/service-extra', '\App\Controllers\Admin\ServiceExtraController');

/*Admin Customers*/
Route::controller('admin/dashboard', '\App\Controllers\Admin\DashboardController');

/*Admin Zip Codes*/
Route::controller('admin/zip-code', '\App\Controllers\Admin\ZipCodeController');

/*Admin GiftCard*/
Route::controller('admin/gift-card', '\App\Controllers\Admin\GiftCardController');