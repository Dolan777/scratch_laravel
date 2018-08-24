<?php

Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function() {
    Route::get('/', 'AuthController@index');
    Route::get('admin-login', ['uses' => 'AuthController@index', 'as' => 'admin-login']);
    Route::post('admin-login', ['uses' => 'AuthController@post_login', 'as' => 'admin-login']);
    Route::group(['middleware' => ['admin', 'validateBackHistory']], function() {
        Route::get('admin-dashboard', ['uses' => 'DashboardController@index', 'as' => 'admin-dashboard']);
        Route::get('admin-profile', ['uses' => 'DashboardController@get_profile', 'as' => 'admin-profile']);
        Route::post('admin-profile', ['uses' => 'DashboardController@post_profile', 'as' => 'admin-profile']);
        Route::get('admin-change-password', ['uses' => 'DashboardController@get_change_password', 'as' => 'admin-change-password']);
        Route::post('admin-change-password', ['uses' => 'DashboardController@post_change_password', 'as' => 'admin-change-password']);
        Route::get('user-change-image', ['uses' => 'DashboardController@get_change_image', 'as' => 'user-change-image']);
        Route::post('user-change-image', ['uses' => 'DashboardController@post_change_image', 'as' => 'user-change-image']);
        
        Route::get('artists-list', ['uses' => 'ArtistsController@get_artists_list', 'as' => 'artists-list']);
        Route::get('artists-list-datatable', ['uses' => 'ArtistsController@get_artists_list_datatable', 'as' => 'artists-list-datatable']);
        Route::get('artists-add', ['uses' => 'ArtistsController@get_add_artists', 'as' => 'artists-add']);
        Route::post('artists-add', ['uses' => 'ArtistsController@post_add_artists', 'as' => 'artists-add']);
        Route::get('artists-edit/{id}', ['uses' => 'ArtistsController@get_edit_artists', 'as' => 'artists-edit']);
        Route::post('artists-edit/{id}', ['uses' => 'ArtistsController@post_edit_artists', 'as' => 'artists-edit']);
        Route::get('artists-delete/{id}', ['uses' => 'ArtistsController@delete', 'as' => 'artists-delete']);
        
        Route::get('admin-logout', ['uses' => 'AuthController@logout', 'as' => 'admin-logout']);
        
        Route::get('settings', ['uses' => 'SettingsController@index', 'as' => 'settings']);
        Route::post('settings', ['uses' => 'SettingsController@store', 'as' => 'settings']);
        
        Route::get('login-history', ['uses' => 'LoginHistoryController@index', 'as' => 'login-history']);
        Route::get('login-history-list', ['uses' => 'LoginHistoryController@get_list', 'as' => 'login-history-list']);
        
        Route::get('emailNotification', ['uses' => 'EmailNotificationController@index', 'as' => 'emailNotification']);
        Route::get('emailNotification-edit/{id}', ['uses' => 'EmailNotificationController@get_edit', 'as' => 'emailNotification-edit']);
        Route::post('emailNotification-edit/{id}', ['uses' => 'EmailNotificationController@post_edit', 'as' => 'emailNotification-edit']);
        Route::get('emailNotification-list', ['uses' => 'EmailNotificationController@get_list', 'as' => 'emailNotification-list']);
        Route::get('emailNotification', ['uses' => 'EmailNotificationController@index', 'as' => 'emailNotification']);
        Route::get('emailNotification-edit/{id}', ['uses' => 'EmailNotificationController@get_edit', 'as' => 'emailNotification-edit']);
        Route::post('emailNotification-edit/{id}', ['uses' => 'EmailNotificationController@post_edit', 'as' => 'emailNotification-edit']);
        
        Route::get('faqpage-list', ['uses' => 'FaqController@get_list', 'as' => 'faqpage-list']);
        Route::get('faqpage', ['uses' => 'FaqController@index', 'as' => 'faqpage']);
        Route::get('faqpage-edit/{id}', ['uses' => 'FaqController@get_edit', 'as' => 'faqpage-edit']);
        Route::post('faqpage-edit/{id}', ['uses' => 'FaqController@post_edit', 'as' => 'faqpage-edit']);
        Route::get('faqpage-add', ['uses' => 'FaqController@get_add', 'as' => 'faqpage-add']);
        Route::get('faqpage-delete/{id}', ['uses' => 'FaqController@get_delete', 'as' => 'faqpage-delete']);
        Route::post('faqpage-add', ['uses' => 'FaqController@post_add', 'as' => 'faqpage-add']);
        
        Route::get('contactus-list', ['uses' => 'ContactusController@get_list', 'as' => 'contactus-list']);
        Route::get('contactus', ['uses' => 'ContactusController@index', 'as' => 'contactus']);
        Route::get('contactus-view/{id}', ['uses' => 'ContactusController@get_view', 'as' => 'contactus-view']);
        
        Route::get('slider-list', ['uses' => 'SliderController@get_list', 'as' => 'slider-list']);
        Route::get('slider', ['uses' => 'SliderController@index', 'as' => 'slider']);
        Route::get('slider-add', ['uses' => 'SliderController@get_add', 'as' => 'slider-add']);
        Route::post('slider-add', ['uses' => 'SliderController@post_add', 'as' => 'slider-add']);
        Route::get('slider-edit/{id}', ['uses' => 'SliderController@get_edit', 'as' => 'slider-edit']);
        Route::post('slider-edit/{id}', ['uses' => 'SliderController@post_edit', 'as' => 'slider-edit']);
        Route::get('slider-delete/{id}', ['uses' => 'SliderController@delete', 'as' => 'slider-delete']);
        
        Route::get('cms', ['uses' => 'CmsController@index', 'as' => 'cms']);
        Route::get('cms-list', ['uses' => 'CmsController@get_list', 'as' => 'cms-list']);
        Route::get('cms-edit/{id}', ['uses' => 'CmsController@get_edit', 'as' => 'cms-edit']);
        Route::post('cms-edit/{id}', ['uses' => 'CmsController@post_edit', 'as' => 'cms-edit']);
        
        Route::get('cmspage', ['uses' => 'CmspageController@index', 'as' => 'cmspage']);
        Route::get('cmspage-list', ['uses' => 'CmspageController@get_list', 'as' => 'cmspage-list']);
        Route::get('cmspage-edit/{id}', ['uses' => 'CmspageController@get_edit', 'as' => 'cmspage-edit']);
        Route::post('cmspage-edit/{id}', ['uses' => 'CmspageController@post_edit', 'as' => 'cmspage-edit']);
    });
});
