<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use File;
use Hash;
use Auth;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   $active='dashboard';
        return view('backend.dashboard')->with('active',$active);
    }

    public function showchangepasswordform(){
        $active = 'change-password';
        return view('backend.changepassword',compact('active'));

    }

    public function changepassword(Request $request){
        // if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
        //     // The passwords matches
        //     return redirect()->back()->with("error","Your current password does not matches with the password.");
        // }
        $this->validate($request,[
            // 'current_password'=>'required',
            'password'=>'required|min:8|confirmed'
            
            
        ]);        
        
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with("success","Password successfully changed!");


    }
}
