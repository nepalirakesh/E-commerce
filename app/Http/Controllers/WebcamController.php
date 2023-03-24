<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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
        if ($request->image!=null) {
            $img = $request->input('image');
            $folderPath = "public/images/";
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = uniqid() . '.png';
            $file = $folderPath . $fileName;
            Storage::put($file, $image_base64);

            $response = Http::attach('image', file_get_contents('/var/www/E-commerce/public/storage/images/' . $fileName), $fileName)
                ->post('13.233.250.181:8000/video/detect-faces?email=' . $request->email);
            if ($response->body() == "true") {
                $user = User::where('email', $request->email)->first();
                if (!is_null($user)) {

                    Auth::guard('web')->login($user);
                    return redirect()->route('home');
                } else {
                    session()->flash('error', 'Enter Valid Email');
                    return back()->withInput($request->oly('email'));
                }
            } else {
                session()->flash('error', 'Face not matched with user');
                return back()->withInput($request->only('email'));
            }
        }else{
            session()->flash('error', 'Image is required for Face Authentication');
            return back()->withInput($request->only('email'));
        }
    }
}
