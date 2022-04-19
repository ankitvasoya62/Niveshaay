<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    public function showLinkRequestForm()
    {
        $active ='';
        return view('frontend.forget-password-email',compact('active'));
    }
    public function showadminRequestForm()
    {
        $active ='';
        return view('backend.adminForgotEmail',compact('active'));
    }
    public function sendResetLinkEmail(Request $request){
        
        $request->validate(['email' => 'required|email']);
        dd($request->only('email','is_admin'));
        $status = Password::sendResetLink(
            $request->only('email','is_admin')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Get the needed authentication credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only('email');
    }
}
