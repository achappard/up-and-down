<?php

namespace App\Http\Controllers\Admin;

use App\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

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
        $page_title  = "<i class=\"ion ion ion-ios-box\"></i>  Gestion des téléchargements disponibles";
        $breadcrumb = array(
            array(
                'label' => $page_title,
                'url'   => false
            ),
        );

        $hightMenuItem = 'admin.downloads';
        return view('admin.downloads.index', compact('page_title', 'breadcrumb', 'hightMenuItem'));
    }

}
