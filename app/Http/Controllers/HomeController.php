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
        $data = [
            'sender_name'   => Auth::user()->name,
            'downloadLink'  => URL::to('/download'),
            'downloadList'  => array(
                ['name' => 'Premier fichier', 'size' => 12345],
                ['name' => 'Deuxième fichier', 'size' => 8765455],
            )
        ];

        // on notifie le destinataire
        Mail::to("test@pop.com")
            ->send(new NewUploadToDownload($data));
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

        // on notifie le destinataire
        $destinataire = new Recipient();
        $destinataire->email = $to;

        $destinataire->notify( new NewUploadToDownload() );
        /*
        */

        return response()->json($data);
    }
}
