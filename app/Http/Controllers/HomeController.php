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
}
