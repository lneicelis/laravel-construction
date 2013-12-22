<?php

/**
 * Settings routes
 */

Route::get('/settings/gallery', array(
    'before' => 'admin',
    'uses' => 'SettingsController@getGallerySettings'));

Route::post('/settings/gallery', array(
    'before' => 'admin|csrf',
    'uses' => 'SettingsController@postGallerySettings'));