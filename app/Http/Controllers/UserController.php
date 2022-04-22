<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Mail;
use App\Mail\passwordMail;
use Str;
use App\Models\User;
use App\Models\SubscriptionFormDetail;
use App\Models\InvoiceDetail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::latest()->where('is_admin',0)->get();
        $active = "users";
        $route = "user";
        return view('backend.userManagement.listUsers',compact('active','users','route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $users = DB::table('users').all().where('is_admin',0);
        $active = "users";
        $route = "user";
        return view('backend.userManagement.addUser',compact('active','route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $todayDate = date('Y-m-d');
        $validatedata = $request->validate([

    		'name' => 'required',
    		'email' => 'required|email|unique:users,email',
            'amount' => 'required',
            'phone_no' => 'required|digits:10',
            'dob' => 'required|date|date_format:Y-m-d|before:'.$todayDate,
            'pan' => [
                'required',
                'regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/'
            ],
            'subscription_start_date' => 'required|date|date_format:Y-m-d',
            'subscription_end_date' => 'required|date|date_format:Y-m-d|after:subscription_start_date'

    	],[
            'dob.date_format'=>'Please enter a valid date of birth!',
            'subscription_start_date.date_format'=>'Please enter a valid subscription start date!',
            'subscription_end_date.date_format'=>'Please enter a valid subscription end date!',
        ]);
        $random_password = Str::random(8);
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['amount'] = $request->amount;
        $data['phone_no'] = $request->phone_no;
        $data['dob'] = $request->dob;
        $data['pan'] = $request->pan;
        $data['is_admin'] = 0;
        $data['subscription_start_date'] = $request->subscription_start_date;
        $data['subscription_end_date'] = $request->subscription_end_date;
        $data['password'] = Hash::make($random_password);
        // $data['password'] = Hash::make(str_random(8));
        $data['created_at'] = Carbon::now();
        $user = new User($data);
        $user->save();
        $toEmail = $request->email;
        try{
            Mail::to($toEmail)->send(new passwordMail($random_password,$request->name));
        }
        catch(\Throwable $th){
            throw $th;
        }
        $subscriptionFormDetails = new SubscriptionFormDetail([
            'name_of_investor'=>$request->name,
            'email'=>$request->email,
            'mobile_no'=>$request->phone_no,
            'pan_no'=>$request->pan,
            'dob'=>date("Y-m-d", strtotime($request->dob)),
            'user_id'=>$user->id,
            'is_email_verified'=>1,
            'is_verified_by_admin'=>1,
            'is_payment_received'=>1
        ]);
        $subscriptionFormDetails->save();
        $today= Carbon::now();
        $currentmonth = $today->month;
        $currentyear = $today->year;
        if($currentmonth < 4){
            $invoice_no = "#NRS/".($currentyear-1)."-".($currentyear)."/".($subscriptionFormDetails->id+100);
        }else{
            $invoice_no = "#NRS/".$currentyear."-".($currentyear+1)."/".($subscriptionFormDetails->id+100);
        }
        $invoiceDetails = new InvoiceDetail([
            'description'=> '',
            'subscription_start_date'=>date("Y-m-d", strtotime($request->subscription_start_date)),
            'subscription_end_date'=>date("Y-m-d", strtotime($request->subscription_start_date)),
            'amount'=>$request->amount,
            'invoice_no'=>$invoice_no,
            'subscription_form_id'=>$subscriptionFormDetails->id
        ]);
        $invoiceDetails->save();

        $notification = array(
            'success'=>'User created successfully. Password has been mailed on registered mail ID.'
            );
        return redirect()->route('admin.users')->with($notification);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        $active= "users";
        return view('backend.userManagement.editUser',compact('active','user'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $todayDate = date('Y-m-d');
        $validatedata = $request->validate([

    		'name' => 'required',
    		'email' => 'required|email',
            'amount' => 'required',
            'phone_no' => 'required|digits:10',
            'dob' => 'required|date|date_format:Y-m-d|before:'.$todayDate,
            'pan' => 'required|max:10|min:10',
            'subscription_start_date' => 'required|date|date_format:Y-m-d',
            'subscription_end_date' => 'required|date|date_format:Y-m-d|after:subscription_start_date'

    	],[
            'dob.date_format'=>'Please enter a valid date of birth!',
            'subscription_start_date.date_format'=>'Please enter a valid subscription start date!',
            'subscription_end_date.date_format'=>'Please enter a valid subscription end date!',
        ]);
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['amount'] = $request->amount;
        $data['phone_no'] = $request->phone_no;
        $data['dob'] = $request->dob ;
        $data['pan'] = $request->pan;
        $data['subscription_start_date'] = $request->subscription_start_date;
        $data['subscription_end_date'] = $request->subscription_end_date;
        //$data['is_admin'] = 0;
       // $data['password'] = Hash::make("12345678");
        // $data['password'] = Hash::make(str_random(8));
        $data['updated_at'] = Carbon::now();
        User::find($id)->update($data);
        $user = User::find($id);
        $notification = array(
            // 'message' => 'User Updated Successfully',
            // 'alert-type' => 'success'
            'success'=>'User Updated Successfully!'
            );
        if($user->is_admin == 0){
            return redirect()->route('admin.users')->with($notification);
        }
        else{
            return redirect()->route('admin.admin-users')->with($notification);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id); 
        // $data = array();
        // $data['status'] = "deleted";
        // $data['updated_at'] = Carbon::now();
        // DB::table('users')->where('id',$id)->update($data);
        $user->forceDelete();
        SubscriptionFormDetail::where('user_id',$id)->forceDelete();
        $notification = array(
            
            'success'=>'User Deleted Successfully!'
            );
        return redirect()->route('admin.users')->with($notification);
        // if($user->is_admin == 0){
        //     return redirect()->route('admin.users')->with($notification);
        // }
        // else{
        //     return redirect()->route('admin.admin-users')->with($notification);
        // }
        
    }

    public function adminUsers()
    {
        //
        $users = User::all()->where('is_admin',1);
        $active = "admin";
        $route = "admin";
        return view('backend.userManagement.listAdminUsers',compact('active','users','route'));
    }

    public function createAdminUser()
    {
        //
        // $users = DB::table('users').all().where('is_admin',0);
        $active = "admin";
        $route = "admin";
        return view('backend.userManagement.addAdminUser',compact('active','route'));
    }

    public function storeAdminUser(Request $request)
    {
        $todayDate = date('Y-m-d');
        $validatedata = $request->validate([

    		'name' => 'required',
    		'email' => 'required|email',
            
            'phone_no' => 'required|digits:10',
            'dob' => 'required|date|date_format:Y-m-d|before:'.$todayDate,
            

    	],[
            'dob.date_format'=>'Please enter a valid date of birth!'
        ]);
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        
        $data['phone_no'] = $request->phone_no;
        $data['dob'] = $request->dob;
        
        $data['is_admin'] = 1;
        $random_password = Str::random(8);
        $data['password'] = Hash::make($random_password);
        // $data['password'] = Hash::make(str_random(8));
        $data['created_at'] = Carbon::now();
        User::insert($data);
        $toEmail = $request->email;
        try{
            Mail::to($toEmail)->send(new passwordMail($random_password,$request->name));
        }
        catch(\Throwable $th){
            //throw $th;
        }
        $notification = array(
            // 'message' => 'User Inserted Successfully',
            // 'alert-type' => 'success'
            'success' => 'Admin User created successfully. Password has been mailed on registered mail ID.',
            );
        return redirect()->route('admin.admin-users')->with($notification);
        
    }

    public function editAdminUser($id){
        $user = User::find($id);
        $active= "admin";
        return view('backend.userManagement.editAdminUser',compact('active','user'));
        
    }

    public function updateAdminUser(Request $request,$id){
        //
        $todayDate = date('Y-m-d');
        $validatedata = $request->validate([

    		'name' => 'required',
    		'email' => 'required',
            
            'phone_no' => 'required|digits:10',
            'dob' => 'required|date|date_format:Y-m-d|before:'.$todayDate,
            

    	]);
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        
        $data['phone_no'] = $request->phone_no;
        $data['dob'] = $request->dob ;
        $data['updated_at'] = Carbon::now();
        User::find($id)->update($data);
        $user = User::find($id);
        $notification = array(
            
            'success'=>'User Updated Successfully!'
            );
        
        
        return redirect()->route('admin.admin-users')->with($notification);
        
    }

    public function deleteAdminUser($id){
        $user = User::find($id); 
        
        $user->forceDelete();
        $notification = array(
            
            'success'=>'User Deleted Successfully!'
            );
        
        
        return redirect()->route('admin.admin-users')->with($notification);
        
    }
}
