<?php

Route::get('/', ['uses' => 'SiteController@index', 'as' => '/']);
Route::get('feature-artist', ['uses' => 'SiteController@featureartist', 'as' => 'feature-artist']);
Route::get('artist-details', ['uses' => 'SiteController@artistdetails', 'as' => 'artist-details']);
Route::get('about-us', ['uses' => 'SiteController@about_us', 'as' => 'about-us']);
Route::get('page/{page}', ['uses' => 'SiteController@page', 'as' => 'page']);
Route::get('group-lesson', ['uses' => 'SiteController@group_lesson', 'as' => 'group-lesson']);
Route::get('application-form/{name}', ['uses' => 'SiteController@get_application_form', 'as' => 'application-form']);
Route::post('application-form/{name}', ['uses' => 'SiteController@post_application_form', 'as' => 'application-form']);
Route::get('private-lesson', ['uses' => 'SiteController@private_lesson', 'as' => 'private-lesson']);
Route::get('how-it-works', ['uses' => 'SiteController@how_it_works', 'as' => 'how-it-works']);
Route::get('privacy-policy', ['uses' => 'SiteController@privacy_policy', 'as' => 'privacy-policy']);
Route::get('faq', ['uses' => 'SiteController@faq', 'as' => 'faq']);
Route::get('teacher-list', ['uses' => 'SiteController@teacher', 'as' => 'teacher-list']);
Route::get('gift-card', ['uses' => 'SiteController@gift_card', 'as' => 'gift-card']);
Route::post('gift-card', ['uses' => 'SiteController@post_gift_card', 'as' => 'gift-card']);
Route::get('contact', ['uses' => 'SiteController@get_contact', 'as' => 'contact']);
Route::post('contact', ['uses' => 'SiteController@post_contact', 'as' => 'contact']);
Route::get('google-login', ['uses' => 'SiteController@google_login', 'as' => 'google-login']);
Route::get('get-city', ['uses' => 'SiteController@get_city', 'as' => 'get-city']);
Route::post('user-signup', ['uses' => 'SiteController@user_signup', 'as' => 'user-signup']);
Route::post('user-login/{type}', ['uses' => 'SiteController@user_login', 'as' => 'user-login']);
Route::get('activate-account/{id}', ['uses' => 'SiteController@activate_account', 'as' => 'activate-account']);
Route::get('forget-password', ['uses' => 'SiteController@forget_password', 'as' => 'forget-password']);
Route::post('forget-password', ['uses' => 'SiteController@forget_password_post', 'as' => 'forget-password']);


Route::get('reset-password/{token}', ['uses' => 'SiteController@reset_password', 'as' => 'reset-password']);
Route::post('reset-password/{token}', ['uses' => 'SiteController@post_reset_password', 'as' => 'reset-password']);


Route::get('gift-payment/{id}', ['uses' => 'PaymentController@giftPayment', 'as' => 'gift-payment']);
Route::get('gift-payment-callback', ['uses' => 'PaymentController@giftPaymentCallback', 'as' => 'gift-payment-callback']);
Route::get('gift-payment-cancel', ['uses' => 'PaymentController@giftPaymentCancel', 'as' => 'gift-payment-cancel']);


Route::get('mail', ['uses' => 'SiteController@mail', 'as' => 'mail']);
Route::get('google-sync', ['uses' => 'SiteController@google_sync', 'as' => 'google-sync']);



Route::group(['middleware' => ['frontendAuth', 'validateBackHistory']], function() {

    //===================User Controller=========================
    Route::get('dashboard', ['uses' => 'UserController@dashboard', 'as' => 'dashboard']);
});
Route::get('logout', ['uses' => 'SiteController@get_logout', 'as' => 'logout']);


