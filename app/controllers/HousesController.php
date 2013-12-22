<?php

class HousesController extends \BaseController
{

    public function getAdminHouses()
    {
        $response['layouts'] = Layout::where('type', '=', 'house')->get();
        $response['houses'] = House::all();

        return View::make('admin.construction.houses', $response);
    }

    public function postAddHouse()
    {
        $validator = Validator::make(
            Input::get(),
            array(
                'layout_id' => 'required',
                'title' => 'required'
            )
        );

        if(!$validator->fails())
        {
            $layout = new House;
            $layout->layout_id = Input::get('layout_id');
            $layout->title = Input::get('title');
            $layout->save();

            $response = array(
                'title' => 'Success',
                'message' => "Some message");
            return Response::json($response, 200);
        }else{
            return Response::json($validator->messages(), 404);
        }
    }

    public function postEditHouse()
    {
        $validator = Validator::make(
            Input::get(),
            array(
                'id' => 'required',
                'layout_id' => 'required',
                'title' => 'required'
            )
        );

        if(!$validator->fails())
        {
            $layout = House::find(Input::get('id'));
            $layout->layout_id = Input::get('layout_id');
            $layout->title = Input::get('title');
            $layout->save();

            $response = array(
                'title' => 'Success',
                'message' => "Some message");
            return Response::json($response, 200);
        }else{
            return Response::json($validator->messages(), 404);
        }
    }

    public function postGetHouse()
    {
        if(Input::has('id'))
        {
            $response = House::find(Input::get('id'))->toArray();

            return Response::json($response, 200);
        }
    }

    public function postDeleteHouse()
    {
        if(Input::has('id'))
        {
            $house = House::find(Input::get('id'));
            $house->delete();

            $gritter = array(
                'type' => 'success',
                'title' => 'Message',
                'message' => 'House has been successfully deleted.');

            return Response::json($gritter, 200);
        }
    }

    public function getPublicHouse($id)
    {
        $response['house'] = House::find($id);

        return View::make('public.houses.main', $response);
    }
} 