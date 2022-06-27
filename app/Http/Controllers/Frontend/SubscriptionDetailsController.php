<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionFormDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Mail\SubscriptionOtpMail;
use Auth;

class SubscriptionDetailsController extends Controller
{
    //
    public function subscriptionForm($id = 0){
        $subscription_details = SubscriptionFormDetail::where('user_id',auth()->user()->id)->where('status','active')->first();
        if(empty($subscription_details)){
            if($id ==0 ){
                $states = getStates();
                return view('frontend.subscription-form',compact('states'));
            }else{
                $states = getStates();
                return view('frontend.companysubscriptionform',compact('states'));
            }
        }else{
            if($subscription_details->subscription_type == 1){
                $states = getStates();
                return view('frontend.editcompanysubscriptionform',compact('subscription_details','states'));
            }else{
                $states = getStates();
                return view('frontend.editsubscription-form',compact('states','subscription_details'));
            }
        }
    }

    
    public function storeDetails(Request $request){

        $this->validate($request,[
            'name_of_investor'=>'required',
            'dob'=>'required',
            'email'=>'required',
            'mobile_no'=>'required|digits:10',
            'pan_no'=>'required|max:10|min:10',
            'pin_code'=>'required|max:6',
            'street_address'=>'required',
            'state'=>'required',
            'age'=>'required',
            'annual_income'=>'required',
            'repayment_of_existing_liabilities'=>'required',
            'invest_net_worth'=>'required',
            'invest_objective'=>'required',
            'invest_average_return'=>'required',
            'risk_attitude' => 'required',
            'knowledge_experience'=>'required'
        ]);
        $subscription_details = SubscriptionFormDetail::where('user_id',auth()->user()->id)->where('status','active')->first();
        if(empty($subscription_details)){
            $subscriptionFormDetail = new SubscriptionFormDetail;
            $subscriptionFormDetail->name_of_investor = $request['name_of_investor'];
            $subscriptionFormDetail->dob = Carbon::createFromFormat('d/m/Y',$request['dob'])->format('Y-m-d');
            $subscriptionFormDetail->email = $request['email'];
            $subscriptionFormDetail->mobile_no = $request['mobile_no'];
            $subscriptionFormDetail->pan_no = $request['pan_no'];
            $subscriptionFormDetail->gst_no = $request['gst_no'];
            $subscriptionFormDetail->pin_code = $request['pin_code'];
            $subscriptionFormDetail->street_address = $request['street_address'];
            $subscriptionFormDetail->state = $request['state'];
            $subscriptionFormDetail->age = $request['age'];
            $subscriptionFormDetail->source_of_income = implode(",",$request['source_of_income']);
            $subscriptionFormDetail->currently_hold_investments = implode(",",$request['currently_hold_investments']);
            $subscriptionFormDetail->annual_income = $request['annual_income'];
            $subscriptionFormDetail->repayment_of_existing_liabilities = $request['repayment_of_existing_liabilities'];
            $subscriptionFormDetail->invest_net_worth = $request['invest_net_worth'];
            $subscriptionFormDetail->investment_period = $request['investment_period'];
            $subscriptionFormDetail->invest_objective = $request['invest_objective'];
            $subscriptionFormDetail->invest_average_return = $request['invest_average_return'];
            $subscriptionFormDetail->risk_attitude = $request['risk_attitude'];
            $subscriptionFormDetail->knowledge_experience = $request['knowledge_experience'];
            $subscriptionFormDetail->confirm_legal_residental_Status = $request['confirm_legal_residental_Status'];
            $subscriptionFormDetail->assesed_owned_research = $request['assesed_owned_research'];
            $subscriptionFormDetail->understand_risk_reward = $request['understand_risk_reward'];
            $subscriptionFormDetail->user_id = Auth::user()->id;
            $subscriptionFormDetail->save();
            return redirect()->route('frontend.advisor-agreement');
        }
        else{
            $subscriptionFormDetail = SubscriptionFormDetail::where('user_id',auth()->user()->id)->where('status','active')->first();
            $subscriptionFormDetail->name_of_investor = $request['name_of_investor'];
            $subscriptionFormDetail->dob = Carbon::createFromFormat('d/m/Y',$request['dob'])->format('Y-m-d');
            $subscriptionFormDetail->email = $request['email'];
            $subscriptionFormDetail->mobile_no = $request['mobile_no'];
            $subscriptionFormDetail->pan_no = $request['pan_no'];
            $subscriptionFormDetail->gst_no = $request['gst_no'];
            $subscriptionFormDetail->pin_code = $request['pin_code'];
            $subscriptionFormDetail->street_address = $request['street_address'];
            $subscriptionFormDetail->state = $request['state'];
            $subscriptionFormDetail->age = $request['age'];
            $subscriptionFormDetail->source_of_income = implode(",",$request['source_of_income']);
            $subscriptionFormDetail->currently_hold_investments = implode(",",$request['currently_hold_investments']);
            $subscriptionFormDetail->annual_income = $request['annual_income'];
            $subscriptionFormDetail->repayment_of_existing_liabilities = $request['repayment_of_existing_liabilities'];
            $subscriptionFormDetail->invest_net_worth = $request['invest_net_worth'];
            $subscriptionFormDetail->investment_period = $request['investment_period'];
            $subscriptionFormDetail->invest_objective = $request['invest_objective'];
            $subscriptionFormDetail->invest_average_return = $request['invest_average_return'];
            $subscriptionFormDetail->risk_attitude = $request['risk_attitude'];
            $subscriptionFormDetail->knowledge_experience = $request['knowledge_experience'];
            $subscriptionFormDetail->confirm_legal_residental_Status = $request['confirm_legal_residental_Status'];
            $subscriptionFormDetail->assesed_owned_research = $request['assesed_owned_research'];
            $subscriptionFormDetail->understand_risk_reward = $request['understand_risk_reward'];
            //$subscriptionFormDetail->user_id = Auth::user()->id;
            $subscriptionFormDetail->save();
            return redirect()->route('frontend.advisor-agreement');
        }
        
    }

    public function storeCompanyDetails(Request $request){
        $this->validate($request,[
            'name_of_investor'=>'required',
            'email'=>'required',
            'mobile_no'=>'required|digits:10',
            'pan_no'=>'required|max:10|min:10',
            'is_demat_account'=>'required',
            'average_profit'=>'required',
            'legal_status'=>'required',
            'number_of_years_since_registration'=>'required',
            'date_of_incorporation'=>'required',
            'invest_net_worth'=>'required',
            'investment_period'=>'required',
            'risk_attitude' => 'required',
            'knowledge_experience'=>'required',
            'state'=>'required'
        ]);
        $subscription_details = SubscriptionFormDetail::where('user_id',auth()->user()->id)->where('status','active')->first();
        if(empty($subscription_details)){
            $subscriptionFormDetail = new SubscriptionFormDetail;
            $subscriptionFormDetail->name_of_investor = $request->name_of_investor;
            $subscriptionFormDetail->email = $request->email;
            $subscriptionFormDetail->mobile_no = $request->mobile_no;
            $subscriptionFormDetail->pan_no = $request->pan_no;
            $subscriptionFormDetail->is_demat_account= $request->is_demat_account;
            $subscriptionFormDetail->demat_account_no = $request->demat_account_no;
            $subscriptionFormDetail->gst_no = $request->gst_no;
            $subscriptionFormDetail->state = $request->state;
            $subscriptionFormDetail->street_address = $request->street_address;
            $subscriptionFormDetail->number_of_years_since_registration = $request->number_of_years_since_registration;
            $subscriptionFormDetail->average_profit = $request->average_profit;
            $subscriptionFormDetail->date_of_incorporation = Carbon::createFromFormat('d/m/Y',$request->date_of_incorporation)->format('Y-m-d');
            $subscriptionFormDetail->legal_status = $request->legal_status;
            $subscriptionFormDetail->invest_net_worth = $request['invest_net_worth'];
            $subscriptionFormDetail->investment_period = $request['investment_period'];
            $subscriptionFormDetail->risk_attitude = $request['risk_attitude'];
            $subscriptionFormDetail->knowledge_experience = $request['knowledge_experience'];
            $subscriptionFormDetail->subscription_type  = 1;
            $subscriptionFormDetail->user_id = Auth::user()->id;
            $subscriptionFormDetail->save(); 
        }else{
            $subscriptionFormDetail = $subscription_details;
            $subscriptionFormDetail->name_of_investor = $request->name_of_investor;
            $subscriptionFormDetail->email = $request->email;
            $subscriptionFormDetail->mobile_no = $request->mobile_no;
            $subscriptionFormDetail->pan_no = $request->pan_no;
            $subscriptionFormDetail->gst_no = $request->gst_no;
            $subscriptionFormDetail->is_demat_account= $request->is_demat_account;
            $subscriptionFormDetail->demat_account_no = $request->demat_account_no;
            $subscriptionFormDetail->state = $request->state;
            $subscriptionFormDetail->street_address = $request->street_address;
            $subscriptionFormDetail->number_of_years_since_registration = $request->number_of_years_since_registration;
            $subscriptionFormDetail->average_profit = $request->average_profit;
            $subscriptionFormDetail->date_of_incorporation = Carbon::createFromFormat('d/m/Y',$request->date_of_incorporation)->format('Y-m-d');
            $subscriptionFormDetail->legal_status = $request->legal_status;
            $subscriptionFormDetail->invest_net_worth = $request['invest_net_worth'];
            $subscriptionFormDetail->investment_period = $request['investment_period'];
            $subscriptionFormDetail->risk_attitude = $request['risk_attitude'];
            $subscriptionFormDetail->knowledge_experience = $request['knowledge_experience'];
            $subscriptionFormDetail->subscription_type  = 1;
            $subscriptionFormDetail->save();
        }
        return redirect()->route('frontend.advisor-agreement');
    }

    public function advisorAgreement(){
        $latestSubscriptionFormDetails = subscriptionFormDetail::where('user_id',Auth::user()->id)->latest()->first();
        // $sum = 0;
        // $age = $latestSubscriptionFormDetails->age;
        // $source_of_income = explode(",",$latestSubscriptionFormDetails->source_of_income);
        // $invest_objective = $latestSubscriptionFormDetails->invest_objective;
        // $annual_income = $latestSubscriptionFormDetails->annual_income;
        // $repayment_of_existing_liabilities	= $latestSubscriptionFormDetails->repayment_of_existing_liabilities;
        // $invest_average_return = $latestSubscriptionFormDetails->invest_average_return;
        // $invest_net_worth = $latestSubscriptionFormDetails->invest_net_worth;		
        // $currently_hold_investments	= explode(",",$latestSubscriptionFormDetails->currently_hold_investments);
        // $investment_period = $latestSubscriptionFormDetails->investment_period;
        // $risk_attitude = $latestSubscriptionFormDetails->risk_attitude;
        // $knowledge_experience = $latestSubscriptionFormDetails->knowledge_experience;

        // $sumArr = array();
        // /* First Question Logic */
            
        //     if($age == 1 ){
        //         $sumArr[] = 8.5 * 2;
        //     }elseif($age == 2 ){
        //         $sumArr[] = 5.5 * 2;
        //     }elseif($age == 3 ){
        //         $sumArr[] = 2.5 * 2;
        //     }
        // /* end first question logic */

        // /* Second question logic */
        //     if(count($source_of_income) == 1){
        //         $sumArr[] = 2.5 * 1;
        //     }elseif(count($source_of_income) == 2){
        //         $sumArr[] = 5.5 * 1;
        //     }elseif(count($source_of_income) == 3){
        //         $sumArr[] = 8.5 * 1;
        //     }elseif(count($source_of_income) == 4){
        //         $sumArr[] = 8.5 * 1;
        //     }elseif(count($source_of_income) == 5){
        //         $sumArr[] = 10 * 1;
        //     }elseif(count($source_of_income) == 6){
        //         $sumArr[] = 10 * 1;
        //     }
        // /* end second question logic */

        // /* Third question logic */
        //     if($invest_objective == 1 ){
        //         $sumArr[] = 2.5 * 2;
        //     }elseif($invest_objective == 2 ){
        //         $sumArr[] = 5.5 * 2;
        //     }elseif($invest_objective == 3 ){
        //         $sumArr[] = 8.5 * 2;
        //     }
        // /* end third question logic */

        // /* Fourth question logic */
        // if($annual_income == 1 ){
        //     $sumArr[] = 2.5 * 1;
        // }elseif($annual_income == 2 ){
        //     $sumArr[] = 5.5 * 1;
        // }elseif($annual_income == 3 ){
        //     $sumArr[] = 8.5 * 1;
        // }elseif($annual_income == 4 ){
        //     $sumArr[] = 10 * 1;
        // }
        // /* end Fourth question logic */

        // /* Fifth question logic */
        // if($repayment_of_existing_liabilities == 1 ){
        //     $sumArr[] = 2.5 * 1;
        // }elseif($repayment_of_existing_liabilities == 2 ){
        //     $sumArr[] = 5.5 * 1;
        // }elseif($repayment_of_existing_liabilities == 3 ){
        //     $sumArr[] = 8.5 * 1;
        // }
        // /* end Fifth question logic */

        // /* Sixth question logic */
        // if($invest_average_return == 1 ){
        //     $sumArr[] = 2.5 * 2;
        // }elseif($invest_average_return == 2 ){
        //     $sumArr[] = 5.5 * 2;
        // }elseif($invest_average_return == 3 ){
        //     $sumArr[] = 8.5 * 2;
        // }
        // /* end Sixth question logic */

        // /* Seventh question logic */
        // if($invest_net_worth == 1 ){
        //     $sumArr[] = 2.5 * 1;
        // }elseif($invest_net_worth == 2 ){
        //     $sumArr[] = 5.5 * 1;
        // }elseif($invest_net_worth == 3 ){
        //     $sumArr[] = 8.5 * 1;
        // }
        // /* end Seventh question logic */

        // /* Eighth question logic */
        // if($currently_hold_investments == ["stock","MF","FD"]){
        //     $sumArr[] = 8.5 * 1;
        // }elseif($currently_hold_investments == ['stock','MF'] ){
        //     $sumArr[] = 8.5 * 1;
        // }elseif($currently_hold_investments == ['stock','FD'] ){
        //     $sumArr[] = 5.5 * 1;
        // }elseif($currently_hold_investments == ['MF','FD'] ){
        //     $sumArr[] = 5.5 * 1;
        // }elseif($currently_hold_investments == ['stock'] ){
        //     $sumArr[] = 10 * 1;
        // }elseif($currently_hold_investments == ['MF'] ){
        //     $sumArr[] = 5.5 * 1;
        // }elseif($currently_hold_investments == ['FD'] ){
        //     $sumArr[] = 2.5 * 1;
        // }
        // /* end Eighth question logic */
        
        // /* Nineth question logic */
        // if($investment_period == 1 ){
        //     $sumArr[] = 2.5 * 2;
        // }elseif($investment_period == 2 ){
        //     $sumArr[] = 5.5 * 2;
        // }elseif($investment_period == 3 ){
        //     $sumArr[] = 10 * 2;
        // }
        // /* end Nineth question logic */

        // /* tenth question logic */
        // if($risk_attitude == 1 ){
        //     $sumArr[] = 2.5 * 2;
        // }elseif($risk_attitude == 2 ){
        //     $sumArr[] = 5.5 * 2;
        // }elseif($risk_attitude == 3 ){
        //     $sumArr[] = 8.5 * 2;
        // }
        // /* end tenth question logic */

        // /* eleventh question logic */
        // if($knowledge_experience == 1 ){
        //     $sumArr[] = 2.5 * 1;
        // }elseif($knowledge_experience == 2 ){
        //     $sumArr[] = 5.5 * 1;
        // }elseif($knowledge_experience == 3 ){
        //     $sumArr[] = 8.5 * 1;
        // }
        // /* end eleventh question logic */
        
        // $sum = collect($sumArr)->sum();

        // $average = $sum / 16;
        // dd($latestSubscriptionFormDetails);
        if($latestSubscriptionFormDetails->subscription_type == 1){
            $average = companyRiskProfile($latestSubscriptionFormDetails);
            
        }else{
            $average = riskProfile($latestSubscriptionFormDetails);
        }

        
        return view('frontend.advisor-agreement',compact('latestSubscriptionFormDetails','average'));
    }

    public function sendOtp(Request $request){
        $validator = Validator::make(
            $request->all(), [
                'email' => 'required|email',
                
            ]
        );

        if($validator->fails()){
            
            $errors = ['success'=>0,'message'=>$validator->errors()];
            return response()->json($errors);
        };

        $email = $request->email;
        $randomOtp = random_int(100000, 999999);
        
        try{
            Mail::to($email)->send(new SubscriptionOtpMail($email,$randomOtp));
            session()->put('subscription_otp',$randomOtp);
            $success = ['success'=>1];
            return response()->json($success);
        }
        catch(\Throwable $th){
            // throw $th;
            $success = ['success'=>0,'message'=>'Something went wrong'];
            return response()->json($success);
            
        }   
    }

    public function verifyOtp(Request $request){
        $validator = Validator::make(
            $request->all(), [
                'otp' => 'required',
                
            ]
        );

        if($validator->fails()){
            
            $errors = ['success'=>0,'message'=>$validator->errors()];
            return response()->json($errors);
        };
        if($request->otp == session()->get('subscription_otp')){
            $success = ['success'=>1];
            $latestSubscriptionFormDetails = subscriptionFormDetail::where('user_id',Auth::user()->id)->latest()->first();
            $latestSubscriptionFormDetails->is_email_verified = 1;
            $latestSubscriptionFormDetails->save();
            return response()->json($success);
        }
        else{
            $success = ['success'=>0,'message'=>'OTP does not match'];
            return response()->json($success);            
        }
        
    }
}
