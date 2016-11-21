<?php

namespace App\Http\Controllers\Admin;


use App\Backgrounds;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BackgroundManagement extends Controller
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
        $background_images = array("https://c2.staticflickr.com/8/7618/16791990721_47d903dfbf_o.jpg");
        $background_images = Backgrounds::all();
        return view('admin.background.index', compact('background_images'));
    }

    public function store(Request $request){

        $background = new Backgrounds;
        $background->url = $request->url;
        $background->save();
        return back();

    }
}
