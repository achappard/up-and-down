<?php

namespace App\Http\Controllers\Admin;

use App\Downloads;
use App\Mail\NewUploadToDownload;
use App\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SizeHelper;

class DownloadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $page_title  = "<i class=\"ion ion ion-ios-box\"></i>  Gestion des téléchargements";
        $breadcrumb = array(
            array(
                'label' => $page_title,
                'url'   => false
            ),
        );

        $hightMenuItem = 'admin.downloads';
        return view('admin.downloads.index', compact('page_title', 'breadcrumb', 'hightMenuItem'));
    }


    /**
     * Vérifie le formulaire de soumission d'un nouveau téléchargement
     * @param Request $request
     */
    public function store(Request $request){

        // Rules for validation
        $rules = [
            'file-to-send-input'            =>  'bail|required',
            'file-name-input'               =>  'bail|required',
            'email_to'                      =>  'bail|required|email',
            'message'                       =>  'bail|required',
            'expiration_date'               =>  'bail|date_format:d/m/Y'
        ];

        // Custom message
        $messages = [
            'email_to.required'             => 'Veuillez renseigner un destinataire pour votre envoi.',
            'email_to.email'                => 'L\'adresse email fournie pour le destinataire n\'est pas correcte. Veuillez la corriger',
            'message.required'              => 'Veuillez renseigner un petit message pour votre destinataire, c\'est vraiment plus sympa.',
            'expiration_date.date_format'   => 'Oups, la date n\'a pas correctement écrite, veuillez renseigner une date au format jj/mm/aaaa.'
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        // Store the download in database
        $file = $request['file-to-send-input'];
        $download = new Downloads;
        $download->uuid = $this->random_download_uuid();
        $download->to = $request->email_to;
        $download->from_email = Auth::user()->email;
        $download->from_name = Auth::user()->name ;
        $download->file_name = $file;
        $download->file_size = Storage::size($file);
        $download->message = $request->message;

        //dd($download);
        if ( $request->expiration_date ){
            $tabDate = explode('/' , $request->expiration_date);
            $download->expiration_date  = $tabDate[2].'-'.$tabDate[1].'-'.$tabDate[0];
        }

        $findme   = '/';
        $pos = strpos($download->file_name, $findme);

        $download->save();

        // Send email
        $dataMail = [
            'sender_name'       => Auth::user()->name,
            'sender_email'      => Auth::user()->email,
            'file_name'         => substr($download->file_name, $pos + 1, strlen($download->file_name)),
            'file_size'         => SizeHelper::formatSizeUnits($download->file_size),
            'sender_message'    => nl2br($download->message),
            'download_link'     => url('download/' . $download->uuid),
            'expiration_date'   => $download->expiration_date
        ];
        Mail::to($request->email_to)->send(new NewUploadToDownload( $dataMail ));

        // redirect to final 
        return redirect("admin#step3")
            ->with([
                    'store_download'       => 'success',
                ]
            );
    }

    /**
     * Généère un identifiant unique
     * @return string
     */
    public function random_download_uuid(){
        $id = str_random(36);

        $data_validate = array(
            'id'    => $id
        );

        $rules = array(
            'id'    => 'unique:downloads,uuid'
        );

        $validator = Validator::make( $data_validate, $rules );
        if ($validator->fails() ){
            $this->random_download_uuid();
        }
        return $id;
    }



}
