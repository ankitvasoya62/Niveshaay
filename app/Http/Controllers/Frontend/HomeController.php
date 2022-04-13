<?php

namespace App\Http\Controllers\Frontend;
use URL;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\OurResearch;
use App\Mail\FeedbackMail;
use Mail;
use App\Models\ShareDetails;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use PDF;
use App\Models\SubscriptionFormDetail;
use Carbon\Carbon;
use App\Models\CurrentMonthComplaint;
use App\Models\MonthlyComplaint;
use App\Models\AnnuallyComplaint;
use PdfWatermarker\PdfWatermarker;
use App\Models\OurClientSayManagement;
use App\Models\FeaturedOn;
use App\Models\TweeterFeed;
use DB;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->only(['subscribeviewshare']);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active='home';
        $researches = ourresearchreport();
       
        $smallcasearray = smallcaseapi();
        
        $green_energy_stock_array = $smallcasearray[0];
        $mid_and_small_case_focus_stock_array = $smallcasearray[1];
        $china_plus_one_strategy_stock_array = $smallcasearray[2];
        $trends_triology_stock_array = $smallcasearray[3];
        /* Current Month Complaints Logic Start */

        $today= Carbon::now();
        $currentmonth = $today->month;
        $currentyear = $today->year;

        $current_month_investor_count = CurrentMonthComplaint::latest()
                                        ->where('received_from','Investor')
                                        ->where('month',$currentmonth)
                                        ->where('year',$currentyear)
                                        ->first();
        $sebi_scores_count = CurrentMonthComplaint::latest()
                            ->where('received_from','SEBI Scores')
                            ->where('month',$currentmonth)
                            ->where('year',$currentyear)
                            ->first();
        
        $other_sources_count = CurrentMonthComplaint::latest()
                                ->where('received_from','Other Sources')
                                ->where('month',$currentmonth)
                                ->where('year',$currentyear)
                                ->first();

        /* Grand Total Logic */
        $currentmonthfields = [
                
            'pending_last_month',
            'received',
            'resolved',
            'total_pending',
            'pending_3m',
            'avg_resolution_time'
        ];
        $currentmonthgrandtotal = array();
        foreach ($currentmonthfields as $key => $value) {
            # code...
            $investorscount = !empty($current_month_investor_count) ? $current_month_investor_count[$value] : 0;
            $sebicount = !empty($sebi_scores_count) ? $sebi_scores_count[$value] : 0;
            $othercount = !empty($other_sources_count) ? $other_sources_count[$value] : 0;
            $currentmonthgrandtotal[] = $investorscount + $sebicount + $othercount;
        }
        /* End Logic */

        /* Current Month Complaints Logic End */

        /* Monthly Complaints Logic Start */
        $data = array();
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::today()->startOfMonth()->subMonth($i);
            $year = Carbon::today()->startOfMonth()->subMonth($i)->format('y');
            $fullyear = Carbon::today()->startOfMonth()->subMonth($i)->format('Y');
            $monthnumber = Carbon::today()->startOfMonth()->subMonth($i)->format('n');
            array_push($data, array(
                'month' => $month->shortMonthName,
                'year' => $year,
                'monthnumber'=>$monthnumber,
                'fullyear'=>$fullyear
            ));
        }

        $monthlyComplaints = array();
        foreach ($data as $key => $value) {
            # code...
            $complaint_month = $value['monthnumber'];
            $complaint_year = $value['year'];
            $complaint_full_year = $value['fullyear'];
            $per_month_data = array();
            $per_month_data = MonthlyComplaint::latest()->where('month',$complaint_month)->where('year',$complaint_full_year)->first();
            $per_month_data['complaint_month_name'] = $value['month'];
            $per_month_data['complaint_month_number'] = $value['monthnumber'];
            $per_month_data['complaint_year'] = $value['year'];    
            
            array_push($monthlyComplaints,$per_month_data);
        }

        /* Grand Total Logic */
        $monthlyfields = [
                
            'carried_forward',
            'received',
            'resolved',
            'pending',
            
        ];
        $monthlygrandtotal = array();
        
            # code...
            foreach ($monthlyfields as $key => $value) {
                $sum = 0;
                foreach ($monthlyComplaints as $row => $col) {
                    # code...
                    $monthlycount = !empty($col[$value]) ? $col[$value] : 0;
                    $sum +=  $monthlycount;
                }
                
                
                $monthlygrandtotal[] = $sum;    
            }
            
        
                /* End Logic */
        /* Monthly Complaints Logic End */

        /*Annually Complaints Logic Start */
        $data = array();
        for ($i = 2; $i >= 0; $i--) {
            
            $year = Carbon::now()->subYear($i)->format('Y');
            $monthnumber = Carbon::today()->startOfMonth()->subMonth($i)->format('n');
            array_push($data, array(
                
                'year' => $year,
                
            ));
        }
        
        $annuallyComplaints = array();
        foreach ($data as $key => $value) {
            # code...
            $complaint_year = $value['year'];
            $per_year_complaints = array();
            $per_year_complaints = AnnuallyComplaint::latest()->where('year',$complaint_year)->first();
            $per_year_complaints['year'] = $complaint_year;
            $per_year_complaints['year_diff'] = $complaint_year - 1 . " - ". $complaint_year;
            array_push($annuallyComplaints,$per_year_complaints);
        }

        /* Grand Total Logic */
        $annuallyfields = [
                
            'carried_forward',
            'received',
            'resolved',
            'pending',
            
        ];
        $annuallygrandtotal = array();
        
            # code...
            foreach ($annuallyfields as $key => $value) {
                $sum = 0;
                foreach ($annuallyComplaints as $row => $col) {
                    # code...
                    $annuallycount = !empty($col[$value]) ? $col[$value] : 0;
                    $sum +=  $annuallycount;
                }
                
                
                $annuallygrandtotal[] = $sum;    
            }
            
        
                /* End Logic */
        /*Annually Complaints Logic End */

        $ourClientSay = OurClientSayManagement::all();
        $featuredOn = FeaturedOn::all();
        $tweeterfeed = TweeterFeed::all();
        return view('frontend.Home',compact('researches','active','green_energy_stock_array','mid_and_small_case_focus_stock_array','china_plus_one_strategy_stock_array','trends_triology_stock_array','current_month_investor_count','sebi_scores_count','other_sources_count','monthlyComplaints','annuallyComplaints','currentmonthgrandtotal','monthlygrandtotal','annuallygrandtotal','ourClientSay','featuredOn','tweeterfeed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contactForm(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
        ]);
        try {
            //code...
            ContactUs::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'message' => $request->message,
            ]);
            $toEmail = "info@niveshaay.com";
            Mail::to($toEmail)->send(new FeedbackMail($request->message,$request->first_name,$request->last_name,$request->email));
            return redirect()->route('frontend.contact')->with('success','Thank you! We will be in touch shortly.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->route('frontend.contact')->with('error','Something went wrong!');

        }

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
    }
    public function contact(){
        $active='contact';
        return view('frontend.contact',compact('active'));
    }
    public function about()
    {
        $active='about';
        return view('frontend.aboutus',compact('active'));
    }
    public function userProfile()
    {
        $active='profile';
        $user = User::find(Auth::user()->id);
        $todayDate = date('Y-m-d');
        $current_subscription = DB::table('invoice_details')
                                ->join('subscription_form_details','subscription_form_details.id','invoice_details.subscription_form_id')
                                ->join('users','subscription_form_details.user_id','users.id')
                                ->select('invoice_details.*')
                                
                                ->where('invoice_details.subscription_start_date','<=',$todayDate)
                                ->where('invoice_details.subscription_end_date','>=',$todayDate)
                                ->where('users.id',Auth::user()->id)
                                ->get();
        $past_subscription = DB::table('invoice_details')
                            ->join('subscription_form_details','subscription_form_details.id','invoice_details.subscription_form_id')
                            ->join('users','subscription_form_details.user_id','users.id')
                            
                            ->select('invoice_details.*')
                            ->where('invoice_details.subscription_start_date','<=',$todayDate)
                            ->where('invoice_details.subscription_end_date','<=',$todayDate)
                            ->where('users.id',Auth::user()->id)
                            ->get();
        // dd($current_subscription);
        return view('frontend.profile',compact('active','user','current_subscription','past_subscription'));
    }
    public function shareDetail()
    {
        $share = ShareDetails::all()->where('status','active');
        
        $latest_addition = array();
        $current_recommendation = array();
        $past_recommendation = array();
        foreach ($share as $key => $value) {
            # code...
            if(isset($value['share_recommendation'])){
                $share_recommendation_array = explode(",",$value['share_recommendation']);
                if(in_array('0',$share_recommendation_array)){
                    $latest_addition[] = $value;
                }
                if(in_array('1',$share_recommendation_array)){
                    $current_recommendation[] = $value;
                }
                if(in_array('2',$share_recommendation_array)){
                    $past_recommendation[] = $value;
                }
            }
        }
        
        $active = "share-details";
        return view('frontend.share-details',compact('active','latest_addition','current_recommendation','past_recommendation'));
    }

    public function viewShare($id){
        
        $share = ShareDetails::find($id);
        // dd(route());
        // dd(Route::getCurrentRoute()->getPath());
        // dd(URL::current() == URL::previous());
        // dd(Route::current()->getName());
        $active = "view-share";
        if($share->copy_to_our_research == 1){
            return view('frontend.view-share',compact('active','share'));
        }else{

            
            if(Auth::user()){
                $SubscriptionFormDetailCount = SubscriptionFormDetail::where('user_id',Auth::user()->id)->where('is_payment_received',1)->first();
                if(empty($SubscriptionFormDetailCount)){
                    return redirect()->route('frontend.research-dashboard'); 
                }else{
                    return view('frontend.view-share',compact('active','share'));
                }
            }else{
                if(URL::current() == URL::previous()){
                    return redirect()->route('frontend.home');
                }else{
                    return redirect()->back();
                }
            }
        }
       
        
    }

    public function subscribeviewshare(){
        // dd("hoo");
    }
    public function signUp(){
        $active = "";
        return view('frontend.signup',compact('active'));
    }

    public function ourStrategy(){
        $active = 'our-strategy';
        return view('frontend.our-strategy',compact('active'));
    }

    public function editProfile(Request $request){
        
        $user = User::find(Auth::user()->id);
        if($user){
            $validator = Validator::make(
                $request->all(), [
                    'email' => 'required|email|unique:users,email,'.Auth::user()->id,
                    'phone_no' => 'required|digits:10',
                    'name'=> 'required'
                ]
            );
            if($validator->fails()){
                
                $errors = ['success'=>0,'message'=>$validator->errors()];
                return response()->json($errors);
            }
            $existed_email = User::where('email',$request->email)->where('id','!=',Auth::user()->id)->get();
            if(count($existed_email) == 0){
                $old_profile_photo = $user->profile_photo;
                $user->email = $request->email;
                $user->phone_no = $request->phone_no;
                $user->name = $request->name;
                if($request->has('profile_photo')){
                    
                    $image = $request->file('profile_photo');
                    $imageName = time().".".$image->extension();
                    $image->move(public_path('images/profile-photos'),$imageName);
                    $user->profile_photo= $imageName;
                    if(!empty($old_profile_photo)){
                        @unlink(public_path('images/profile-photos')."/".$old_profile_photo);
                    }
                }
                $user->save();
                $success = ['success'=>1];
                return response()->json($success);
            }else{
                $errors = ['success'=>0,'message'=>"Email Already Exists"];
                return response()->json($errors);    
            }
            
        }else{
            $errors = ['success'=>0,'message'=>"Something went wrong"];
            return response()->json($errors);
        }
        
    }

    public function Services(){
        $active = 'services';
        $smallcasearray = smallcaseapi();
        
        $green_energy_stock_array = $smallcasearray[0];
        $mid_and_small_case_focus_stock_array = $smallcasearray[1];
        $china_plus_one_strategy_stock_array = $smallcasearray[2];
        $trends_triology_stock_array = $smallcasearray[3];
        $researches = ourresearchreport();
        return view('frontend.services',compact('active','green_energy_stock_array','mid_and_small_case_focus_stock_array','china_plus_one_strategy_stock_array','trends_triology_stock_array','researches'));
    }

    public function researchDashboard(){
        $active = '';
        $SubscriptionFormDetailCount = SubscriptionFormDetail::where('user_id',auth()->user()->id)->where('is_email_verified',1)->first();
        $isEmailVerified = 1;
        $researches = ourresearchreport();
        if(empty($SubscriptionFormDetailCount)){
            $isEmailVerified = 0;
        }
        return view('frontend.research-dashboard',compact('active','isEmailVerified','researches'));        
    }

    public function generatePDF(){
        // $pdf = PDF::loadFile(public_path('pdf/1648039795.pdf'));
        // $pdf->setWatermarkImage(public_path('images/logo.png'));
        // $pdf->save(public_path('file.pdf'));
        // $headers = [
        //     'Content-Type' => 'application/pdf'
        // ];

        // return response()->download(public_path('pdf/1648039795.pdf'), 'Test File', $headers, 'inline');

        // dd('Mail sent successfully');
        // $config = ['instanceConfigurator' => function ($mpdf) {
        //     $mpdf->SetWatermarkImage(public_path('images/logo.png'));
        //     $mpdf->showWatermarkImage = true;
        //     // $mpdf->watermarkImageAlpha = 0.2; // image opacity 
        //     // dd($mpdf) // show all attributes 
        // }];

        // $pdf = PDF::loadFile(public_path('pdf/1648039795.pdf'), $config);

        // return $pdf->stream('DocumentName.pdf');
        // $pdf = new PDF;
        // $mpdf = $pdf->getMpdf();
        // $mpdf->SetWatermarkText("PÉROLA NEGRA");
        // $mpdf->showWatermarkText = true;
        //$mpdf->SetProtection(array(), 'UserPassword', 'MyPassword');
        // $mpdf->WriteHTML('Hello World');
        // $mpdf->Output('filename.pdf');
        // dd(sys_get_temp_dir());
        // $data = array();
        // $pdf = PDF::loadView('pdf.hello', $data);
        // return $pdf->stream('document.pdf');
        // dd(request()->ip());
        // dd(view('pdf.hello'));
        $watermarker = new PdfWatermarker(
            public_path('pdf/1648040112.pdf'), // input
            public_path('pdf/watermark/output27.pdf'), // output
            base_path() . '/resources/views/pdf/hello.blade.php', // watermark file
            'center', // watermark position (topleft, topright, bottomleft, bottomright, center)
            false // set to true - replace original input file
           );
        $watermarker->create();
        dd("success");
    }

    // public function generateMailPDF(){
    //     $data["email"] = "nikhilvshah12274@gmail.com";
    //     $data["title"] = "From ItSolutionStuff.com";
    //     $data["body"] = "This is Demo";
    //     $pdf = PDF::loadView('pdf.document', $data);
    //     Mail::send('pdf.document', $data, function($message)use($data, $pdf) {
    //         $message->to($data["email"], $data["email"])
    //                 ->subject($data["title"])
    //                 ->attachData($pdf->output(), "text.pdf");
    //     });
    //     //return $pdf->stream('document.pdf');
    //     dd('Mail sent successfully');
    // }
    
}
