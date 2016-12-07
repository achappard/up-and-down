<?php

namespace App\Http\Controllers;

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
       /* $first = new Upload();
        $first->to = 'aurelien.chappard.fr';
        $first->message = 'Hello the world';

        $first->save();*/

       /* $test = new UploadedFile();
        $test->upload_id = 1;
        $test->internal_name = "poigxcvb";
        $test->original_name = "test.docx";
        $test->type = "octet/stream";
        $test->save();*/



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
