<?php

namespace App\Http\Controllers\Admin;

use App\Backgrounds;
use App\Upload;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title  = '<i class="fa fa-dashboard"></i> Tableau de bord';
        $breadcrumb = array(
            array(
                'label' => $page_title,
                'url'   => false
            ),
        );
        $nbBackgrounds = Backgrounds::all()->count();
        $files_availables = Storage::files('up-and-down');

        foreach ($files_availables as $f){
            //print_r( \SizeHelper::formatSizeUnits (Storage::size($f)) );
        }

        $nbDownloads    = count($files_availables);
        $hightMenuItem = 'admin';
        return view('admin.dashboard',
            compact(
                'page_title',
                'breadcrumb',
                'hightMenuItem',
                'nbBackgrounds',
                'nbDownloads',
                'files_availables'
            )
        );
    }
}
