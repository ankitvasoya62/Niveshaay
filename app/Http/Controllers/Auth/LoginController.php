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
        $this->middleware('guest')->except('logout');
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
                $errors = ['success'=>0,'message'=>"Email address or Password was incorrect."];
                return response()->json($errors);
                
            }else{
                $success = ['success'=>1];
            return response()->json($success);
            }
        }else{
            $errors = ['success'=>0,'message'=>"Email address or Password was incorrect."];
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
        
        if(Auth::attempt(['email' => $input['email'], 'password' => $input['password']]))
        {
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('admin.home');
            }else{
                Auth::logout();
                return redirect()->route('admin.loginform')
                ->with('error','Email-Address or Password Are Wrong.');
            }
        }else{
            return redirect()->route('admin.login')
                ->with('error','Email-Address or Password Are Wrong.');
        }
    }

    public function registerUser(Request $request){
        $this->validate($request, [
            'first_name'=>'required',
            'last_name'=>'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'phone_no' => 'required'
        ],
        [
            'password.confirmed'=> "Password and Confirm Password does not match"
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
    // public function logout(){
    //     Auth::logout();
    //     return redirect('/login');
    // }
    
}
