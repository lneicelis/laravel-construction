<?php

class FloorsController extends \BaseController {

    public function getAdminFloors()
    {
        $response['layouts'] = Layout::where('type', '=', 'floor')->get();
        $response['houses'] = House::all();
        $response['floors'] = Floor::all();

        return View::make('admin.construction.floors', $response);
    }

    public function postAddFloor()
    {
        $validator = Validator::make(
            Input::get(),
            array(
                'house_id' => 'required',
                'layout_id' => 'required',
                'floor_no' => 'required',
                'title' => 'required'
            )
        );

        if(!$validator->fails())
        {
            $floor = new Floor;
            $floor->house_id = Input::get('house_id');
            $floor->layout_id = Input::get('layout_id');
            $floor->floor_no = Input::get('floor_no');
            $floor->title = Input::get('title');
            $floor->svg = Input::get('svg');
            $floor->save();

            $response = array(
                'title' => 'Success',
                'message' => "Some message");
            return Response::json($response, 200);
        }else{
            return Response::json($validator->messages(), 404);
        }
    }

    public function postEditFloor()
    {
        $validator = Validator::make(
            Input::get(),
            array(
                'id' => 'required',
                'house_id' => 'required',
                'layout_id' => 'required',
                'floor_no' => 'required',
                'title' => 'required'
            )
        );

        if(!$validator->fails())
        {
            $floor = Floor::find(Input::get('id'));
            $floor->house_id = Input::get('house_id');
            $floor->layout_id = Input::get('layout_id');
            $floor->floor_no = Input::get('floor_no');
            $floor->title = Input::get('title');
            $floor->svg = Input::get('svg');
            $floor->save();

            $response = array(
                'title' => 'Success',
                'message' => "Some message");
            return Response::json($response, 200);
        }else{
            return Response::json($validator->messages(), 404);
        }
    }

    public function postGetFloor()
    {
        if(Input::has('id'))
        {
            $response = Floor::find(Input::get('id'))->toArray();

            return Response::json($response, 200);
        }
    }

    public function postDeleteFloor()
    {
        if(Input::has('id'))
        {
            $floor = Floor::find(Input::get('id'));
            $floor->delete();

            $gritter = array(
                'type' => 'success',
                'title' => 'Message',
                'message' => 'Floor has been successfully deleted.');

            return Response::json($gritter, 200);
        }
    }
    
    public function getPublicFloor($id)
    {
        $response['status_css'] = array(0 => 'svg-vacant', 1 => 'svg-reserved', 2 => 'svg-sold');
        $response['status_word'] = array(0 => 'Laisvas', 1 => 'Rezervuotas', 2 => 'Parduotas');
        $response['floor'] = Floor::find($id);

        return View::make('public.floors.main', $response);
    }

}