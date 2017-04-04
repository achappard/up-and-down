<?php

namespace App\Http\Controllers\Admin;

use App\Backgrounds;
use App\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $nbDownloads    = "A calculer";
        $hightMenuItem = 'admin';
        return view('admin.dashboard', compact('page_title', 'breadcrumb', 'hightMenuItem', 'nbBackgrounds', 'nbDownloads' ));
    }
}
