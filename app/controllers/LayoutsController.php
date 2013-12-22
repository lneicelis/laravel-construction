<?php

class LayoutsController extends \BaseController
{
    public function getAdminLayouts()
    {
        $response['albums'] = Album::all();
        $response['layouts'] = Layout::all();

        return View::make('admin.construction.layouts', $response);
    }

    public function postAddLayout()
    {
        $data = array_merge(Input::get(), Input::file());
        $validator = Validator::make(
            $data,
            array(
                'type' => 'required',
                'title' => 'required',
                'file' => 'mimes:jpeg,bmp,png'
            )
        );

        if(!$validator->fails())
        {
            $layout = new Layout;

            if(input::hasFile('file')) {
                $file = Input::file('file');
                $new_file_name = str_random(16) . '.' . $file->getClientOriginalExtension();
                $tmp_file = $file->getRealPath();

                $gallery = new \Luknei\Gallery\Gallery();
                $gallery->setPhotoPath('public_construction/layouts/');
                $gallery->image($tmp_file, $new_file_name);

                $layout->schema_image = $new_file_name;
            }

            $layout->type = Input::get('type');
            $layout->title = Input::get('title');
            $layout->svg = Input::get('svg');
            $layout->album_id = Input::get('album_id');
            $layout->save();

            $response = array(
                'title' => 'Success',
                'message' => "Some message");
            return Response::json($response, 200);
        }else{
            return Response::json($validator->messages(), 404);
        }
    }

    public function postEditLayout()
    {
        $data = array_merge(Input::get(), Input::file());
        $validator = Validator::make(
            $data,
            array(
                'id' => 'required',
                'type' => 'required',
                'title' => 'required',
                'file' => 'mimes:jpeg,bmp,png'
            )
        );

        if(!$validator->fails())
        {
            $layout = Layout::find(Input::get('id'));

            if(input::hasFile('file')) {
                $file = Input::file('file');
                $new_file_name = str_random(16) . '.' . $file->getClientOriginalExtension();
                $tmp_file = $file->getRealPath();

                $gallery = new \Luknei\Gallery\Gallery();
                $gallery->setPhotoPath('public_construction/layouts/');
                $gallery->image($tmp_file, $new_file_name);

                $layout->schema_image = $new_file_name;
            }

            $layout->type = Input::get('type');
            $layout->title = Input::get('title');
            $layout->svg = Input::get('svg');
            $layout->album_id = Input::get('album_id');
            $layout->save();

            $response = array(
                'title' => 'Success',
                'message' => "Some message");
            return Response::json($response, 200);
        }else{
            return Response::json($validator->messages(), 404);
        }
    }

    public function postGetLayout()
    {
        if(Input::has('id'))
        {
            $response = Layout::find(Input::get('id'))->toArray();

            return Response::json($response, 200);
        }
    }

    public function postDeleteLayout()
    {
        if(Input::has('id'))
        {
            $layout = Layout::find(Input::get('id'));

            if(!empty($layout->schema_image)) {
                unlink(public_path('public_construction' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . $layout->schema_image));
            }
            $layout->delete();

            $gritter = array(
                'type' => 'success',
                'title' => 'Message',
                'message' => 'Layout has been successfully deleted.');

            return Response::json($gritter, 200);
        }
    }
} 