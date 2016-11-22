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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $background_images = Backgrounds::all();
        $page_title  = "<i class=\"fa fa-desktop\"></i> Gestion des images de fond";
        $breadcrumb = array(
            array(
                'label' => $page_title,
                'url'   => false
            ),
        );
        $hightMenuItem = 'admin.manage-backgrounds';
        return view('admin.background.index', compact('background_images', 'page_title', 'breadcrumb', 'hightMenuItem'));
    }

    /**
     * Store a newly created background in storage.
     *
     * @return Response
     */
    public function store(Request $request){

        $background = new Backgrounds;
        $background->url = $request->url;
        $background->save();
        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // delete
        $background = Backgrounds::find($id);
        $background->delete();

        // redirect
        return redirect()
            ->route('background.index')
            ->with([
                'flash_success_message'       => '<i class="icon fa fa-check"></i> L\'image de fond a été correctement supprimée !',
                ]
            );
    }
}
