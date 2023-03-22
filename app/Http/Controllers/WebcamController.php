<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebcamController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('home.webcam');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        // $img = $request->image;
        // $folderPath = "uploads/";
        // dd($img);

        // $image_parts = explode(";base64,", $img);
        // $image_type_aux = explode("image/", $image_parts[0]);
        // $image_type = $image_type_aux[1];

        // $image_base64 = base64_decode($image_parts[1]);
        // $fileName = uniqid() . '.png';

        // $file = $folderPath . $fileName;
        // Storage::put($file, $image_base64);

        // ('Image uploaded successfully: ' . $fileName);

        $images = array();
        for ($i = 1; $i <= 5; $i++) {
            if ($request->has('image' . $i)) {
                $img = $request->input('image' . $i);
                $folderPath = "uploads/";
                $image_parts = explode(";base64,", $img);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $fileName = uniqid() . '.png';
                $file = $folderPath . $fileName;
                Storage::put($file, $image_base64);
                array_push($images, $fileName);
            }
        }
        // Save the image file names to the database or do other processing
        dd($images);
    }
}