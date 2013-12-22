<?php
/**
 * Layouts routes
 */

Route::get('construction/layouts', array(
    'before' => 'auth',
    'uses' => 'LayoutsController@getAdminLayouts'));

Route::post('construction/add-layout', array(
    'before' => 'auth',
    'uses' => 'LayoutsController@postAddLayout'));

Route::post('construction/edit-layout', array(
    'before' => 'auth',
    'uses' => 'LayoutsController@postEditLayout'));

Route::post('construction/get-layout', array(
    'before' => 'auth',
    'uses' => 'LayoutsController@postGetLayout'));

Route::post('construction/delete-layout', array(
    'before' => 'auth',
    'uses' => 'LayoutsController@postDeleteLayout'));

/** Houses routes */

Route::get('construction/houses', array(
    'before' => 'auth',
    'uses' => 'HousesController@getAdminHouses'));

Route::post('construction/add-house', array(
    'before' => 'auth',
    'uses' => 'HousesController@postAddHouse'));

Route::post('construction/edit-house', array(
    'before' => 'auth',
    'uses' => 'HousesController@postEditHouse'));

Route::post('construction/get-house', array(
    'before' => 'auth',
    'uses' => 'HousesController@postGetHouse'));

Route::post('construction/delete-house', array(
    'before' => 'auth',
    'uses' => 'HousesController@postDeleteHouse'));

Route::get('house/{id}', array(
    'uses' => 'HousesController@getPublicHouse' ));

/** Floors routes */

Route::get('construction/floors', array(
    'before' => 'auth',
    'uses' => 'FloorsController@getAdminFloors'));

Route::post('construction/add-floor', array(
    'before' => 'auth',
    'uses' => 'FloorsController@postAddFloor'));

Route::post('construction/edit-floor', array(
    'before' => 'auth',
    'uses' => 'FloorsController@postEditFloor'));

Route::post('construction/get-floor', array(
    'before' => 'auth',
    'uses' => 'FloorsController@postGetFloor'));

Route::post('construction/delete-floor', array(
    'before' => 'auth',
    'uses' => 'FloorsController@postDeleteFloor'));

Route::get('floors/{floor_id}', array(
    'uses' => 'FloorsController@getPublicFloor'));

/** Apartments routes */

Route::get('construction/apartments', array(
    'before' => 'auth',
    'uses' => 'ApartmentsController@getAdminApartments'));

Route::post('construction/add-apartment', array(
    'before' => 'auth',
    'uses' => 'ApartmentsController@postAddApartment'));

Route::post('construction/edit-apartment', array(
    'before' => 'auth',
    'uses' => 'ApartmentsController@postEditApartment'));

Route::post('construction/get-apartment', array(
    'before' => 'auth',
    'uses' => 'ApartmentsController@postGetApartment'));

Route::post('construction/delete-apartment', array(
    'before' => 'auth',
    'uses' => 'ApartmentsController@postDeleteApartment'));

Route::get('apartments/{apartment_id}', array(
    'before' => 'auth',
    'uses' => 'ApartmentsController@getPublicApartment'));