<?php

namespace App\Http\Controllers\Frontend;
use URL;
use Illuminate\Support\Facades\Route;
use Hash;
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
use App\Models\InvoiceDetail;
use Carbon\Carbon;
use App\Models\CurrentMonthComplaint;
use App\Models\MonthlyComplaint;
use App\Models\AnnuallyComplaint;
use PdfWatermarker\PdfWatermarker;
use App\Models\OurClientSayManagement;
use App\Models\FeaturedOn;
use App\Models\TweeterFeed;
use DB;
use File;
use Cookie;
// use DOMPDF;
Use Image;
use Intervention\Image\Exception\NotReadableException;
use App\Models\Disclosure;


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

        $ourClientSay = OurClientSayManagement::orderBy('sort_order','asc')->get();
        $featuredOn = FeaturedOn::where('status','active')->orderBy('sort_order','asc')->get();
        $tweeterfeed = TweeterFeed::orderBy('sort_order','asc')->get();
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
            'phone_no'=>'required|digits:10'
        ],[
            'phone_no.digits'=>"Contact number should be of 10 digits"
        ]);
        try {
            //code...
            ContactUs::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'message' => $request->message,
                'phone_no'=>$request->phone_no
            ]);
            $toEmail = "research@niveshaay.com";
            Mail::to($toEmail)->send(new FeedbackMail($request->message,$request->first_name,$request->last_name,$request->email,$request->phone_no));
            return redirect()->route('frontend.contact')->with('success','We’ll contact you shortly.');
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
        // dd(count($past_subscription));
        return view('frontend.profile',compact('active','user','current_subscription','past_subscription'));
    }
    public function shareDetail()
    {
        $share = ShareDetails::where(['status'=>'active','share_status'=>"1"])->orderBy('id','desc')->get();
        
        $latest_addition = array();
        $current_recommendation = array();
        $past_recommendation = array();
        $quaterly_results = array();
        $investment_recommendations = array();
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
                if(in_array('3',$share_recommendation_array)){
                    $quaterly_results[] = $value;
                }
                if(in_array('4',$share_recommendation_array)){
                    $investment_recommendations[] = $value;
                }
            }
        }
        
        $active = "share-details";
        return view('frontend.share-details',compact('active','latest_addition','current_recommendation','past_recommendation','quaterly_results','investment_recommendations'));
    }

    public function viewShare($id){
        
        $share = ShareDetails::find($id);
        
        $active = "view-share";
        if($share->copy_to_our_research == 1){
            return view('frontend.view-share',compact('active','share'));
        }else{

            
            if(Auth::user()){
                $SubscriptionFormDetailCount = SubscriptionFormDetail::where('user_id',Auth::user()->id)->where('is_payment_received',1)->first();
                if(empty($SubscriptionFormDetailCount)){
                    return redirect()->route('frontend.research-dashboard'); 
                }else{
                    if($share->upload_type == 1){
                        $destinationPath = public_path("userpdf");
                
                        if(!File::exists($destinationPath)) {
                            File::makeDirectory($destinationPath, 0777, true, true);
                        }
                        $authUser = Auth::user();
                        $outputpdf = public_path("userpdf/".$share->id.".pdf");
                        $inputpdf = public_path('pdf/'.$share->pdf_name) ;
                        $watermarkfile = public_path("userwatermark/$authUser->id/".$authUser->id.".png");
                        $watermarker = new PdfWatermarker(
                            $inputpdf, // input
                            $outputpdf, // outputpublic\
                            $watermarkfile, // watermark file
                            'center', // watermark position (topleft, topright, bottomleft, bottomright, center)
                            false // set to true - replace original input file
                        );
                        $watermarker->create();
                    }
                    
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
    public function generatewatermarkpdf($id){
        $share = ShareDetails::find($id);
        if($share->upload_type == 1){
            $destinationPath = public_path("userpdf");
                
            if(!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $authUser = Auth::user();
            $outputpdf = public_path("userpdf/".$share->id.".pdf");
            $inputpdf = public_path('pdf/'.$share->pdf_name) ;
            $watermarkfile = public_path("userwatermark/$authUser->id/".$authUser->id.".png");
            $watermarker = new PdfWatermarker(
                $inputpdf, // input
                $outputpdf, // outputpublic\
                $watermarkfile, // watermark file
                'center', // watermark position (topleft, topright, bottomleft, bottomright, center)
                false // set to true - replace original input file
            );
            $watermarker->create();
            
            return response()->file($outputpdf);
        }else{
            return redirect()->route('frontend.view.share',$share->id);
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
                    $imageFileExt = $image->getClientOriginalName();
                    $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                    $imageName = str_replace(" ", "_", $imageFileName).'_' .time().".".$image->extension();
                    //$imageName = time().".".$image->extension();
                    $destinationPath = public_path('images/profile-photos');
                    
                    if(!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, 0777, true, true);
                    }
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

    public function Services($id = ""){
        $active = 'services';
        $smallcasearray = smallcaseapi();
        
        $green_energy_stock_array = $smallcasearray[0];
        $mid_and_small_case_focus_stock_array = $smallcasearray[1];
        $china_plus_one_strategy_stock_array = $smallcasearray[2];
        $trends_triology_stock_array = $smallcasearray[3];
        $researches = ourresearchreport();
        $activeservice = "1";
        
        if($id == "" || !in_array($id,["1","2","3","4"])){
            $activeservice = "1";
        }else{
            $activeservice = $id;
            
        }
        
        return view('frontend.services',compact('active','green_energy_stock_array','mid_and_small_case_focus_stock_array','china_plus_one_strategy_stock_array','trends_triology_stock_array','researches','activeservice'));
    }

    public function researchDashboard(){
        $active = '';
        $SubscriptionFormDetailCount = SubscriptionFormDetail::where('user_id',auth()->user()->id)->where('is_email_verified',1)->first();
        $subscriptionFormCount = SubscriptionFormDetail::where('user_id',auth()->user()->id)->first();
        $isEmailVerified = 1;
        $researches = ourresearchreport();
        if(empty($SubscriptionFormDetailCount)){
            $isEmailVerified = 0;
        }
        return view('frontend.research-dashboard',compact('active','isEmailVerified','researches','subscriptionFormCount'));        
    }

    public function generatePDF(){
        $active = '';
        return view('frontend.companysubscriptionform',compact('active'));
        $pdf = PDF::loadView('pdf.advisor-agreement', array());
        return $pdf->stream('document.pdf');
    }

    public function invoicePDF(){
        $id = 52;
        $subscription_details = SubscriptionFormDetail::find(52);
        $pdf = PDF::loadView('pdf.risk-profiling', $subscription_details);
        return $pdf->stream('invoice.pdf');
        $toEmail = $subscription_details->email;
        $invoices = InvoiceDetail::latest()->where('subscription_form_id',$id)->first();
        // dd($invoices);
        $table_data = [];
        $inoice = array();
        $invoice['description'] = $invoices->description;
        $invoice['amount'] = $invoices->amount;
        $invoice['subscription_start_date'] = $invoices->subscription_start_date;
        $invoice['subscription_end_date'] = $invoices->subscription_end_date;
        // $invoice['amount'] = $invoices->amount;
        $invoice['invoice_no'] = $invoices->invoice_no;
        array_push($table_data,$invoice);
        $data['name_of_investor'] = $subscription_details->name_of_investor;
        $data['pan_no'] = $subscription_details->pan_no;
        $data['state'] = $subscription_details->state;
        $data["email"] = $subscription_details->email;
        $data['gst_no'] = $subscription_details->gst_no;
        // $today= Carbon::now();
        // $currentmonth = $today->month;
        // $currentyear = $today->year;
        // if($currentmonth < 4){
        //     $invoice_no = "#NIV/".($currentyear-1)."-".($currentyear)."/".($id+100);
        // }else{
        //     $invoice_no = "#NIV/".$currentyear."-".($currentyear+1)."/".($id+100);
        // }
        $data['invoice_no'] = $invoices->invoice_no;
        $amount = $invoices->amount;
        if($subscription_details->state == 'Gujarat'){
               $cgst = $amount * 0.09;
               $sgst = $amount * 0.09;
               $total = $amount + $cgst + $sgst;
               $data['amount'] = $amount;
               $data['cgst'] = $cgst;
               $data['sgst'] = $sgst;
               $data['total'] = $total;
               
        }else{
            $igst = $amount * 0.18;
            $total = $amount + $igst;
            $data['amount'] = $amount;
            $data['igst'] = $igst;
            $data['total'] = $total;
        }
        
        
        $data['table_data'] = $table_data;
        
        // dd($data);
        $pdf = PDF::loadView('pdf.document', $data);
        return $pdf->stream('invoice.pdf');

    }

    public function changePasswordForm(){
        $active = "change-password";
        return view('frontend.change-password',compact('active'));
    }

    public function changePassword(Request $request){
        $this->validate($request,[
            // 'current_password'=>'required',
            'password'=>'required|min:8',
            'password_confirmation'=>'same:password'    

        ],[
            'password_confirmation.same'=> "Confirm Password does not match with New Password. Please try again!",
        ]);        
        
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('frontend.home')->with("forgot_password_status","Your password has been updated successfully!");
    }

    public function disclosure(){
        $active = '';
        $disclosures = Disclosure::all();
        return view('frontend.disclosure',compact('active','disclosures'));
    }
}
