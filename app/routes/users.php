<?php

/**
 * Users authentification routes
 */
Route::get('/user/login',array(
    'uses' => 'UsersController@getLogin'));
Route::post('/user/login', array(
    'before' => 'csrf',
    'uses' => 'UsersController@postLogin'));

Route::get('/user/logout', array(
    'uses' => 'UsersController@getLogout'));
Route::post('/user/logout', array(
    'uses' => 'UsersController@postLogout'));

Route::get('/user/register', array(
    'uses' => 'UsersController@getRegister'));
Route::post('/user/register', array(
    'before' => 'csrf',
    'uses' => 'UsersController@postRegister'));

Route::get('/user/reset_password', array(
    'uses' => 'UsersController@getResetPassword'));
Route::post('/user/reset_password', array(
    'before' => 'csrf',
    'uses' => 'UsersController@postResetPassword'));

Route::get('/user/change_password/{reset_code}', array(
    'uses' => 'UsersController@getChangePassword'));
Route::post('/user/change_password/{reset_code}', array(
    'before' => 'csrf',
    'uses' => 'UsersController@postChangePassword'));

Route::get('/user/all', array(
    'before' => 'admin',
    'uses' => 'UsersController@getUsers'));

Route::post('/user/edit', array(
    'before' => 'admin',
    'uses' => 'UsersController@postUserEdit'));

Route::get('/user/profile/{user_id?}', array(
    'before' => 'auth',
    'uses' => 'UsersController@getProfile'));

Route::post('/user/profile-update', array(
    'before' => 'auth|csrf',
    'uses' => 'UsersController@postUpdateProfile'));

Route::post('/user/follow', array(
    'before' => 'auth|csrf',
    'uses' => 'UsersController@postFollow'));

Route::post('/user/unfollow', array(
    'before' => 'auth|csrf',
    'uses' => 'UsersController@postUnfollow'));

Route::post('/user/change-picture', array(
    'before' => 'auth|csrf',
    'uses' => 'UsersController@postProfilePicture'));

Route::get('/user/list', array(
    'before' => 'auth',
    'uses' => 'UsersController@getUsersList'));

Route::get('/user/following/{user_id}', array(
    'before' => 'auth',
    'uses' => 'UsersController@getFollowing'));

Route::get('/user/followers/{user_id}', array(
    'before' => 'auth',
    'uses' => 'UsersController@getFollowers'));
