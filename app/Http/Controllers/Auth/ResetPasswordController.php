<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    public function showResetForm(Request $request){
        $active ='';
        $token = $request->route()->parameter('token');
        $user = User::where('email',$request->email)->first();
        if($user->is_admin == 1){
            return view('backend.adminForgotReset', ['token' => $token,'email'=>$request->email,'active'=>'']);

        }
        else{
            return view('frontend.forget-reset', ['token' => $token,'email'=>$request->email,'active'=>'']);
        }
        

    }

    public function reset(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ],[
            'password.confirmed'=> "Password and Confirm Password does not match"
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
                // $this->guard()->login($user);
            }
        );
        $user = User::where('email',$request->email)->first();
        if($user->is_admin == 1){
            return $status === Password::PASSWORD_RESET
                    ? redirect()->route('admin.login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);

        }
        else{
            return $status === Password::PASSWORD_RESET
                    ? redirect()->route('frontend.home')->with('forgot_password_status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
        }
        
    }
}
