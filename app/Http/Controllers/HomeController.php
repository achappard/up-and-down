<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('upAndDown.home');
    }



    public function submitUpload(Request $request){
        dd(request()->file('myfiles'));
//        ->store('avatars');
        $files =request()->file('myfiles');
        if($files){
            foreach ($files as $file)
            {
                $file->store('uploads');
            }
        }
        return back();
    }
}
