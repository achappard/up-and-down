<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserProfilController extends Controller
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
     * Show profile page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        $page_title  = '<i class="fa fa-user"></i> Mon profil';

        return view('admin.userprofile', compact('page_title'));
    }


    /**
     * Update profile and redirect to show profile page
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $validateArray = [
            'name'      => 'required',
            'email'     => 'required|email|max:255',
        ];

        if( !empty( $request->password ) ){
            $validateArray['password'] = 'required|min:6|confirmed';
        }

        $this->validate($request, $validateArray );
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if( !empty( $request->password ) ){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()
            ->route('userprofile.show')
            ->with([
                    'flash_success_message'       => '<i class="icon fa fa-check"></i> Votre compte a bien été enregistré !',
                ]
            );
    }
}
