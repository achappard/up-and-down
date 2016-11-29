<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

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
        // Lancement de l'upload
        $upload_handler = new \UploadHandler();


        $to         = Input::get("to");
        $message    = Input::get("message");

        $data = array(
            'to'        => $to,
            'message'   => $message,
            'files'     => $upload_handler->response['myfiles'],
        );

        return response()->json($data);
    }
}
