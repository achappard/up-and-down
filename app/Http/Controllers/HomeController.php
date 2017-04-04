<?php

namespace App\Http\Controllers;

use App\File;
use App\Mail\NewUploadToDownload;
use App\Recipient;
use App\Upload;
use App\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

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
            'fileso'    => $upload_handler->response['myfiles'],
        );

        /*
        // Save Upload in database
        $upload = new Upload();
        $upload->to = $to;
        $upload->message = $message;
        $upload->save();*/

        // data for email notification
        $dataNotification = [
            'sender_name'   => Auth::user()->name,
            'downloadLink'  => URL::to('/download'),
            'downloadList'  => array()
        ];



/*        foreach ($upload_handler->response['myfiles'] as $f){
            $file = new File();
            $file->internal_name    = $f->name;
            $file->original_name    = $f->original_name;
            $file->size             = $f->size;
            $file->type             = $f->type;
            $file->upload_id        = $upload->id;
            $file->save();

            $dataNotification['downloadList'][] = array(
                'name'              => $f->original_name,
                'size'              => $f->size
            );
        }*/

        // on notifie le destinataire


        /** todo: a décalé car pour les gros fichier ça envoie plein de mail
        Mail::to($to)->send(new NewUploadToDownload($dataNotification));
         */
        return response()->json($data);
    }
}
