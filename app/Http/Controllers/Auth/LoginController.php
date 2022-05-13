<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
use Str;
use Illuminate\Support\Facades\Validator;
use App\Models\NewsletterUser;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('AdminLogin','logout');
        
    }
    public function login(Request $request)
    {   
        $input = $request->all();
        //dd($request->all());
        // $this->validate($request->all(), [
        //     'login-email' => 'required|email',
        //     'login-password' => 'required',
        // ]);
        $validator = Validator::make(
            $request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]
        );
        if($validator->fails()){
            
            $errors = ['success'=>0,'message'=>$validator->errors()];
            return response()->json($errors);
        }
        // if(is_numeric($input['email'])){
        //     $field = 'phone_no';
        // }else{
        //     $field = 'email';
        // }
        if(Auth::attempt(['email' => $input['email'], 'password' => $input['password'],'status'=>'active']))
        {
            if (auth()->user()->is_admin == 1) {
                Auth::logout();
                $errors = ['success'=>0,'message'=>"Email address or password does not match."];
                return response()->json($errors);
                
            }else{

                $authUser = Auth::user();
                $profilePhotourl = !empty(Auth::user()->profile_photo) ? asset('images/profile-photos/'.Auth::user()->profile_photo) : asset('images/blankuser.jpeg') ;
                $authUserName = $authUser->name;
                $profile_photocookie_name = "profile_photo";
                $profile_cookie_value = $profilePhotourl;
                $username_cookie = "user_name";
                $username_cookie_value = $authUserName;
                setcookie($profile_photocookie_name,$profile_cookie_value, time() + (86400 * 30), "/"); //name,value,time,url
                setcookie($username_cookie,$username_cookie_value, time() + (86400 * 30), "/"); //name,value,time,url

                // dd($_COOKIE["user"]);
                $success = ['success'=>1];
            return response()->json($success);
            }
        }else{
            $errors = ['success'=>0,'message'=>"Email address or password does not match"];
            return response()->json($errors);
            
        }
          
    }

    public function adminLogin(request $request){
        $input = $request->all();
        //dd($request->all());
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        
        // if(is_numeric($input['email'])){
        //     $field = 'phone_no';
        // }else{
        //     $field = 'email';
        // }
        $user = User::where('email',$request->email)
                    // ->where('password',Hash::make($request->password))
                    ->where('is_admin',1)
                    ->first();
        if($user){
            if (!(Hash::check($request->password, $user->password))) {
                // The passwords matches
                // return redirect()->back()->with("error","Your current password does not matches with the password.");
                return redirect()->route('admin.loginform')
                ->with('error','Email address or password does not match.');
            }

            Auth::guard('admin')->login($user);
            //dd(Auth::guard('admin')->user());
            return redirect()->route('admin.home');
            // dd($user);
        }else{
            return redirect()->route('admin.loginform')
                ->with('error','Email address or password does not match.');
        }
        // if(Auth::attempt(['email' => $input['email'], 'password' => $input['password']]))
        // {
        //     if (auth()->user()->is_admin == 1) {
        //         return redirect()->route('admin.home');
        //     }else{
        //         Auth::logout();
        //         return redirect()->route('admin.loginform')
        //         ->with('error','Email address or password does not match.');
        //     }
        // }else{
        //     return redirect()->route('admin.login')
        //         ->with('error','Email address or password does not match.');
        // }
    }

    public function registerUser(Request $request){
        $this->validate($request, [
            'first_name'=>'required',
            'last_name'=>'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'phone_no' => 'required|digits:10'
        ],
        [   
            'email.email'=> "Please enter a valid email address",
            'password.confirmed'=> "The passwords you entered do not match, please re-enter your passwords",
            'password.min'=>"The password must be of at least 8 characters",
            'phone_no.digits'=>"The Phone Number must be of 10 digits"
        ]
    );
    $user = User::create([
            'name' => $request->first_name . " ".$request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_no' => $request->phone_no,
            'is_admin'=>0
        ]);
        if(!empty($request->subscribe_news_letter) && $request->subscribe_news_letter == 1){
            NewsletterUser::create([
                'first_name'=> $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_no'=> $request->phone_no,
            ]);
        }
        
        // $user = Auth::attempt(['email' => $request->email, 'password' => Hash::make($request->password)]);
        $this->guard()->login($user);
        return redirect()->route('frontend.research-dashboard');
    }
    
    public function logout(Request $request){
        
        $isAdmin = !empty($request->is_admin) ? $request->is_admin : 0;
        if(!empty($isAdmin)){
            Auth::guard('admin')->logout();
            return redirect()->route('admin.loginform');
        }else{
            unset($_COOKIE['user_name']);
            unset($_COOKIE['profile_photo']);
            setcookie('user_name', '', time() - 3600, '/');
            setcookie('profile_photo', '', time() - 3600, '/');
            Auth::logout();
        }
        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return redirect()->route('frontend.home');
    }
    
}
