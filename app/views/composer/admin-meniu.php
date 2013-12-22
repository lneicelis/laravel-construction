<?php

App::before(function($request)
{
    View::composer('admin.components.sidebar', function($view)
    {
        if(Sentry::getUser()->hasAccess('admin'))
        {
            $meniu[] = array('icon' => 'icon-group',       'title' => 'Users',         'url' => URL::action('UsersController@getUsers'));
            $meniu[] = array('icon' => 'icon-cogs',        'title' => 'Settings',      'url' => URL::action('SettingsController@getGallerySettings'));
            $meniu[] = array('icon' => 'icon-home',        'title' => 'Construction',  'submeniu' => array(
                    array('title' => 'Layouts', 'url' => URL::action('LayoutsController@getAdminLayouts')),
                    array('title' => 'Houses', 'url' => URL::action('HousesController@getAdminHouses')),
                    array('title' => 'Floors', 'url' => URL::action('FloorsController@getAdminFloors')),
                    array('title' => 'Apartments', 'url' => URL::action('ApartmentsController@getAdminApartments')),
            ));
        }

        if(Sentry::getUser()->hasAccess('user'))
        {
            $meniu[] = array('icon' => 'icon-picture',      'title' => 'Gallery',       'url' => URL::action('AlbumsController@index'));
        }

        $view->with('meniu', $meniu);
    });
});