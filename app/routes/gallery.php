<?php

/**
 * Gallery albums routes
 */
Route::get('/gallery/{user_id?}', array(
    'before' => 'auth',
    'uses' => 'AlbumsController@index'));

Route::post('/gallery/new-album', array(
    'before' => 'auth|csrf',
    'uses' => 'AlbumsController@postCreate'));

Route::get('/gallery/album/{id}', array(
    'before' => 'auth',
    'uses' => 'AlbumsController@show'));

Route::post('/gallery/album/set_cover', array(
    'before' => 'auth',
    'uses' => 'AlbumsController@postSetCover'));

Route::post('/gallery/album/edit', array(
    'before' => 'auth|csrf',
    'uses' => 'AlbumsController@postEdit'));

Route::get('/gallery/album/destroy/{album_id}', array(
    'before' => 'auth',
    'uses' => 'AlbumsController@destroy'));

Route::post('/gallery/album/comment', array(
    'before' => '',
    'uses' => 'AlbumsController@postComment'));

Route::post('/gallery/album/like', array(
    'before' => '',
    'uses' => 'AlbumsController@postLike'));

/**
 * Gallery Photos routes
 */

Route::get('/album/{album_id}/upload', array(
    'before' => 'auth',
    'uses' => 'PhotosController@getUpload'));

Route::post('/album/{album_id}/upload', array(
    'before' => 'auth',
    'uses' => 'PhotosController@postUpload'));

Route::post('photo/destory/{photo_id}', array(
    'before' => 'auth|csrf',
    'uses' => 'PhotosController@destroy'));

Route::post('photo/edit', array(
    'before' => 'auth',
    'uses' => 'PhotosController@edit'));

Route::post('photo/transfer', array(
    'before' => 'auth',
    'uses' => 'PhotosController@postTransfer'));

Route::post('photo/get-all', array(
    'before' => 'auth',
    'uses' => 'PhotosController@getPhotos'));

Route::post('photo/crop', array(
    'before' => 'auth',
    'uses' => 'PhotosController@postCrop'));

Route::post('photo/rotate/{direction}', array(
    'before' => 'auth|csrf',
    'uses' => 'PhotosController@postRotate'));

Route::post('photo/status', array(
    'before' => 'auth',
    'uses' => 'PhotosController@postStatus'));

Route::post('photo/get-info', array(
    'before' => 'auth',
    'uses' => 'PhotosController@postGetPhotoInfo'));