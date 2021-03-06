<?php

namespace App\Http\Controllers\Backend\Media;

use Response;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Image\ImageRepository;
use Illuminate\Support\Facades\Input;

class MediaController extends Controller
{
    protected $image;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->image = $imageRepository;
    }

    public function getUpload()
    {
        return view('backend.media.index');
    }

    public function postUpload()
    {
        $photo = Input::all();
        $response = $this->image->upload($photo);

        return $response;
    }

    public function deleteUpload()
    {
        $filename = Input::get('id');

        if (!$filename) {
            return 0;
        }

        $response = $this->image->delete($filename);

        return $response;
    }

    public function getList()
    {
        $image_array = array();
        $images = Image::all();

        foreach ($images as $key => $value) {
            array_push($image_array, array('title' => $value->filename, 'value' => $value->filename.'.jpg'));
        }

        return Response::json($image_array);
    }

    // video
    // 
     public function getUploadVideo()
    {
        //return view('backend.media.index');
    }

    public function postUploadVideo(Request $request)
    {
       // $video = Input::all();
        $video = $request->file('video');
       //$response = $this->image->upload($photo);
        if ($request->hasFile('video')) {
            return 'true' ;

        }else
        {
            return 'false' ;
        }
       // dd(  $video );
    }

    public function deleteUploadVideo()
    {
        // $filename = Input::get('id');

        // if (!$filename) {
        //     return 0;
        // }

        // $response = $this->image->delete($filename);

        // return $response;
    }

    public function getListVideo()
    {
        // $image_array = array();
        // $images = Image::all();

        // foreach ($images as $key => $value) {
        //     array_push($image_array, array('title' => $value->filename, 'value' => $value->filename.'.jpg'));
        // }

        // return Response::json($image_array);
    }
}
