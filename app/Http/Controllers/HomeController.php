<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Controllers\Controller;
use App\Upload;
use App\UploadedFile;
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
            'fileso'     => $upload_handler->response['myfiles'],
        );

        $upload = new Upload();
        $upload->to = $to;
        $upload->message = $message;
        $upload->save();


        foreach ($upload_handler->response['myfiles'] as $f){
            $file = new File();
            $file->internal_name    = $f->name;
            $file->original_name    = $f->original_name;
            $file->type             = $f->type;
            $file->upload_id        = $upload->id;
            $file->save();
        }

        /*
        */

        return response()->json($data);
    }
}
