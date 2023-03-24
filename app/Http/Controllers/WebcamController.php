<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

            if ($request->has('image')) {
                $img = $request->input('image');
                $folderPath = "uploads/";
                $image_parts = explode(";base64,", $img);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $fileName = uniqid() . '.png';
                $file = $folderPath . $fileName;
                Storage::put($file, $image_base64);
            }
            $user=User::where('email',$request->email)->first();
            if(!is_null($user)){

                Auth::guard('web')->login($user);
                return redirect()->route('home');
            }else {
                session()->flash('error', 'Enter Valid Email');
                return back()->withInput($request->only('email'));
            }
        
        }
    }
     
           
            
    
            