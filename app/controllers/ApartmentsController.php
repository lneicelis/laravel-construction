<?php

class ApartmentsController extends \BaseController {

    public function getAdminApartments()
    {
        $response['layouts'] = Layout::where('type', '=', 'apartment')->get();
        $response['floors'] = Floor::all();
        $response['apartments'] = Apartment::all();

        return View::make('admin.construction.apartments', $response);
    }

    public function postAddApartment()
    {
        $validator = Validator::make(
            Input::get(),
            array(
                'floor_id' => 'required',
                'layout_id' => 'required',
                'apartment_no' => 'required',
                'title' => 'required'
            )
        );

        if(!$validator->fails())
        {
            $apartment = new Apartment;
            $apartment->floor_id = Input::get('floor_id');
            $apartment->layout_id = Input::get('layout_id');
            $apartment->apartment_no = Input::get('apartment_no');
            $apartment->title = Input::get('title');
            $apartment->no_rooms = Input::get('no_rooms');
            $apartment->status = Input::get('status');
            $apartment->save();

            $response = array(
                'title' => 'Success',
                'message' => "Some message");
            return Response::json($response, 200);
        }else{
            return Response::json($validator->messages(), 404);
        }
    }

    public function postEditApartment()
    {
        $validator = Validator::make(
            Input::get(),
            array(
                'id' => 'required',
                'floor_id' => 'required',
                'layout_id' => 'required',
                'apartment_no' => 'required',
                'title' => 'required'
            )
        );

        if(!$validator->fails())
        {
            $apartment = Apartment::find(Input::get('id'));
            $apartment->floor_id = Input::get('floor_id');
            $apartment->layout_id = Input::get('layout_id');
            $apartment->apartment_no = Input::get('apartment_no');
            $apartment->title = Input::get('title');
            $apartment->no_rooms = Input::get('no_rooms');
            $apartment->status = Input::get('status');
            $apartment->save();

            $response = array(
                'title' => 'Success',
                'message' => "Some message");
            return Response::json($response, 200);
        }else{
            return Response::json($validator->messages(), 404);
        }
    }

    public function postGetApartment()
    {
        if(Input::has('id'))
        {
            $response = Apartment::find(Input::get('id'))->toArray();

            return Response::json($response, 200);
        }
    }

    public function postDeleteApartment()
    {
        if(Input::has('id'))
        {
            $apartment = Apartment::find(Input::get('id'));
            $apartment->delete();

            $gritter = array(
                'type' => 'success',
                'title' => 'Message',
                'message' => 'Apartment has been successfully deleted.');

            return Response::json($gritter, 200);
        }
    }
    
    public function getPublicApartment($id)
    {
        $response['apartment'] = Apartment::find($id);

        return View::make('public.apartments.main', $response);
    }

}