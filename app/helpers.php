<?php
use Illuminate\Support\Facades\Http;
use App\Models\ShareDetails;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Models\SubscriptionFormDetail;
// use File;
// use Image;

function smallcaseapi(){
    $green_energy_stock = Http::get("https://api.smallcase.com/smallcases/smallcase?scid=NIVTR_0001");
    $mid_and_small_case_focus_stock = Http::get("https://api.smallcase.com/smallcases/smallcase?scid=NIVMO_0001");
    $china_plus_one_strategy_stock = Http::get("https://api.smallcase.com/smallcases/smallcase?scid=NIVNM_0001");
    $trends_triology_stock = Http::get("https://api.smallcase.com/smallcases/smallcase?scid=NIVMO_0004");
    if(!empty($green_energy_stock['data'])){
        $green_energy_stock_details = $green_energy_stock['data'];
        // dd($green_energy_stock_details);
        $green_energy_stock_array = array();
        $green_energy_stock_array['name'] = $green_energy_stock_details['info']['name'];
        $green_energy_stock_array['minInvestAmount'] = $green_energy_stock_details['stats']['minInvestAmount'];
        $green_energy_stock_array['cagr'] = $green_energy_stock_details['stats']['ratios']['cagr'];
        $green_energy_stock_array['cagrDuration'] = $green_energy_stock_details['stats']['ratios']['cagrDuration'];
        $green_energy_stock_array['riskLabel'] = $green_energy_stock_details['stats']['ratios']['riskLabel'];
    }else{  
        $green_energy_stock_array = array();
    }
    if(!empty($mid_and_small_case_focus_stock['data'])){
        $mid_and_small_case_focus_stock_details = $mid_and_small_case_focus_stock['data'];
        // dd($green_energy_stock_details);
        $mid_and_small_case_focus_stock_array = array();
        $mid_and_small_case_focus_stock_array['name'] = $mid_and_small_case_focus_stock_details['info']['name'];
        $mid_and_small_case_focus_stock_array['minInvestAmount'] = $mid_and_small_case_focus_stock_details['stats']['minInvestAmount'];
        $mid_and_small_case_focus_stock_array['cagr'] = $mid_and_small_case_focus_stock_details['stats']['ratios']['cagr'];
        $mid_and_small_case_focus_stock_array['cagrDuration'] = $mid_and_small_case_focus_stock_details['stats']['ratios']['cagrDuration'];
        $mid_and_small_case_focus_stock_array['riskLabel'] = $mid_and_small_case_focus_stock_details['stats']['ratios']['riskLabel'];
    }else{  
        $mid_and_small_case_focus_stock_array = array();
    }
    if(!empty($china_plus_one_strategy_stock['data'])){
        $china_plus_one_strategy_stock_details = $china_plus_one_strategy_stock['data'];
        // dd($green_energy_stock_details);
        $china_plus_one_strategy_stock_array = array();
        $china_plus_one_strategy_stock_array['name'] = $china_plus_one_strategy_stock_details['info']['name'];
        $china_plus_one_strategy_stock_array['minInvestAmount'] = $china_plus_one_strategy_stock_details['stats']['minInvestAmount'];
        $china_plus_one_strategy_stock_array['cagr'] = $china_plus_one_strategy_stock_details['stats']['ratios']['cagr'];
        $china_plus_one_strategy_stock_array['cagrDuration'] = $china_plus_one_strategy_stock_details['stats']['ratios']['cagrDuration'];
        $china_plus_one_strategy_stock_array['riskLabel'] = $china_plus_one_strategy_stock_details['stats']['ratios']['riskLabel'];
    }else{  
        $china_plus_one_strategy_stock_array = array();
    }
    if(!empty($trends_triology_stock['data'])){
        $trends_triology_stock_details = $trends_triology_stock['data'];
        // dd($green_energy_stock_details);
        $trends_triology_stock_array = array();
        $trends_triology_stock_array['name'] = $trends_triology_stock_details['info']['name'];
        $trends_triology_stock_array['minInvestAmount'] = $trends_triology_stock_details['stats']['minInvestAmount'];
        $trends_triology_stock_array['cagr'] = $trends_triology_stock_details['stats']['ratios']['cagr'];
        $trends_triology_stock_array['cagrDuration'] = $trends_triology_stock_details['stats']['ratios']['cagrDuration'];
        $trends_triology_stock_array['riskLabel'] = $trends_triology_stock_details['stats']['ratios']['riskLabel'];
    }else{  
        $trends_triology_stock_array = array();
    }
    $smallcasearray = [
        $green_energy_stock_array,
        $mid_and_small_case_focus_stock_array,
        $china_plus_one_strategy_stock_array,
        $trends_triology_stock_array
    ];
    return $smallcasearray;
}

function ourresearchreport(){
    return ShareDetails::all()->where('copy_to_our_research',1)->where('share_status',1)->where('status','active');
}

function createWatermark(){
    $authUser = Auth::user();
    $profilePhotourl = !empty(Auth::user()->profile_photo) ? asset('images/profile-photos/'.Auth::user()->profile_photo) : asset('images/blankuser.jpeg') ;
    $authUserName = $authUser->name;
    $profile_photocookie_name = "profile_photo";
    $profile_cookie_value = $profilePhotourl;
    $username_cookie = "user_name";
    $username_cookie_value = $authUserName;
    setcookie($profile_photocookie_name,$profile_cookie_value, time() + (86400 * 30), "/"); //name,value,time,url
    setcookie($username_cookie,$username_cookie_value, time() + (86400 * 30), "/"); //name,value,time,url
    try{
        $destinationPath = public_path("userwatermark");
        if(!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }
        $destinationPath = public_path("userwatermark/$authUser->id");
    
        if(!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
            $img = Image::canvas(800, 600);
        // $img = Image::make(public_path("image.jpg"));
            $img->text($authUser->email,200,320,function($font){
                $font->file(public_path("fonts/OpenSans-Regular.ttf"));
                $font->size(40);
                $font->color([0,0,0,0.3]);
                $font->align("center");
                $font->valign("top");
                $font->angle(45);
            });
            $filename = $authUser->id.".png";
            $img->save(public_path("userwatermark/$authUser->id/".$filename));
        }

        

        
    }catch(\Exception $e){

    }
}

function riskProfile($latestSubscriptionFormDetails,$id = ''){
    // $latestSubscriptionFormDetails = subscriptionFormDetail::find($id);
    $sum = 0;
    $age = $latestSubscriptionFormDetails->age;
    $source_of_income = explode(",",$latestSubscriptionFormDetails->source_of_income);
    $invest_objective = $latestSubscriptionFormDetails->invest_objective;
    $annual_income = $latestSubscriptionFormDetails->annual_income;
    $repayment_of_existing_liabilities	= $latestSubscriptionFormDetails->repayment_of_existing_liabilities;
    $invest_average_return = $latestSubscriptionFormDetails->invest_average_return;
    $invest_net_worth = $latestSubscriptionFormDetails->invest_net_worth;		
    $currently_hold_investments	= explode(",",$latestSubscriptionFormDetails->currently_hold_investments);
    $investment_period = $latestSubscriptionFormDetails->investment_period;
    $risk_attitude = $latestSubscriptionFormDetails->risk_attitude;
    $knowledge_experience = $latestSubscriptionFormDetails->knowledge_experience;

    $sumArr = array();
    /* First Question Logic */
        
        if($age == 1 ){
            $sumArr[] = 8.5 * 2;
        }elseif($age == 2 ){
            $sumArr[] = 5.5 * 2;
        }elseif($age == 3 ){
            $sumArr[] = 2.5 * 2;
        }
    /* end first question logic */

    /* Second question logic */
        if(count($source_of_income) == 1){
            $sumArr[] = 2.5 * 1;
        }elseif(count($source_of_income) == 2){
            $sumArr[] = 5.5 * 1;
        }elseif(count($source_of_income) == 3){
            $sumArr[] = 8.5 * 1;
        }elseif(count($source_of_income) == 4){
            $sumArr[] = 8.5 * 1;
        }elseif(count($source_of_income) == 5){
            $sumArr[] = 10 * 1;
        }elseif(count($source_of_income) == 6){
            $sumArr[] = 10 * 1;
        }
    /* end second question logic */

    /* Third question logic */
        if($invest_objective == 1 ){
            $sumArr[] = 2.5 * 2;
        }elseif($invest_objective == 2 ){
            $sumArr[] = 5.5 * 2;
        }elseif($invest_objective == 3 ){
            $sumArr[] = 8.5 * 2;
        }
    /* end third question logic */

    /* Fourth question logic */
    if($annual_income == 1 ){
        $sumArr[] = 2.5 * 1;
    }elseif($annual_income == 2 ){
        $sumArr[] = 5.5 * 1;
    }elseif($annual_income == 3 ){
        $sumArr[] = 8.5 * 1;
    }elseif($annual_income == 4 ){
        $sumArr[] = 10 * 1;
    }
    /* end Fourth question logic */

    /* Fifth question logic */
    if($repayment_of_existing_liabilities == 1 ){
        $sumArr[] = 2.5 * 1;
    }elseif($repayment_of_existing_liabilities == 2 ){
        $sumArr[] = 5.5 * 1;
    }elseif($repayment_of_existing_liabilities == 3 ){
        $sumArr[] = 8.5 * 1;
    }
    /* end Fifth question logic */

    /* Sixth question logic */
    if($invest_average_return == 1 ){
        $sumArr[] = 2.5 * 2;
    }elseif($invest_average_return == 2 ){
        $sumArr[] = 5.5 * 2;
    }elseif($invest_average_return == 3 ){
        $sumArr[] = 8.5 * 2;
    }
    /* end Sixth question logic */

    /* Seventh question logic */
    if($invest_net_worth == 1 ){
        $sumArr[] = 2.5 * 1;
    }elseif($invest_net_worth == 2 ){
        $sumArr[] = 5.5 * 1;
    }elseif($invest_net_worth == 3 ){
        $sumArr[] = 8.5 * 1;
    }
    /* end Seventh question logic */

    /* Eighth question logic */
    if($currently_hold_investments == ["stock","MF","FD"]){
        $sumArr[] = 8.5 * 1;
    }elseif($currently_hold_investments == ['stock','MF'] ){
        $sumArr[] = 8.5 * 1;
    }elseif($currently_hold_investments == ['stock','FD'] ){
        $sumArr[] = 5.5 * 1;
    }elseif($currently_hold_investments == ['MF','FD'] ){
        $sumArr[] = 5.5 * 1;
    }elseif($currently_hold_investments == ['stock'] ){
        $sumArr[] = 10 * 1;
    }elseif($currently_hold_investments == ['MF'] ){
        $sumArr[] = 5.5 * 1;
    }elseif($currently_hold_investments == ['FD'] ){
        $sumArr[] = 2.5 * 1;
    }
    /* end Eighth question logic */
    
    /* Nineth question logic */
    if($investment_period == 1 ){
        $sumArr[] = 2.5 * 2;
    }elseif($investment_period == 2 ){
        $sumArr[] = 5.5 * 2;
    }elseif($investment_period == 3 ){
        $sumArr[] = 10 * 2;
    }
    /* end Nineth question logic */

    /* tenth question logic */
    if($risk_attitude == 1 ){
        $sumArr[] = 2.5 * 2;
    }elseif($risk_attitude == 2 ){
        $sumArr[] = 5.5 * 2;
    }elseif($risk_attitude == 3 ){
        $sumArr[] = 8.5 * 2;
    }
    /* end tenth question logic */

    /* eleventh question logic */
    if($knowledge_experience == 1 ){
        $sumArr[] = 2.5 * 1;
    }elseif($knowledge_experience == 2 ){
        $sumArr[] = 5.5 * 1;
    }elseif($knowledge_experience == 3 ){
        $sumArr[] = 8.5 * 1;
    }
    /* end eleventh question logic */
    
    $sum = collect($sumArr)->sum();

    $average = $sum / 16;
    return $average;
}

function getStates(){
    $states = [
        'AP' => 'Andhra Pradesh',
        'AR' => 'Arunachal Pradesh',
        'AS' => 'Assam',
        'BR' => 'Bihar',
        'CT' => 'Chhattisgarh',
        'GA' => 'Goa',
        'GJ' => 'Gujarat',
        'HR' => 'Haryana',
        'HP' => 'Himachal Pradesh',
        'JK' => 'Jammu and Kashmir',
        'JH' => 'Jharkhand',
        'KA' => 'Karnataka',
        'KL' => 'Kerala',
        'MP' => 'Madhya Pradesh',
        'MH' => 'Maharashtra',
        'MN' => 'Manipur',
        'ML' => 'Meghalaya',
        'MZ' => 'Mizoram',
        'NL' => 'Nagaland',
        'OR' => 'Odisha',
        'PB' => 'Punjab',
        'RJ' => 'Rajasthan',
        'SK' => 'Sikkim',
        'TN' => 'Tamil Nadu',
        'TG' => 'Telangana',
        'TR' => 'Tripura',
        'UP' => 'Uttar Pradesh',
        'UT' => 'Uttarakhand',
        'WB' => 'West Bengal',
        'AN' => 'Andaman and Nicobar Islands',
        'CH' => 'Chandigarh',
        'DN' => 'Dadra and Nagar Haveli',
        'DD' => 'Daman and Diu',
        'LD' => 'Lakshadweep',
        'DL' => 'National Capital Territory of Delhi',
        'PY' => 'Puducherry'
        ];
        return $states;
}

function companyRiskProfile($latestSubscriptionFormDetails){
    $sum = 0;
    $companyProfile = array(); 
    $companyProfile[] = $latestSubscriptionFormDetails->number_of_years_since_registration;
    $companyProfile[] = $latestSubscriptionFormDetails->average_profit;
    $companyProfile[] = $latestSubscriptionFormDetails->investment_period;
    $companyProfile[] = $latestSubscriptionFormDetails->invest_net_worth;
    $companyProfile[] = $latestSubscriptionFormDetails->risk_attitude;
    $companyProfile[] = $latestSubscriptionFormDetails->knowledge_experience;
    
    foreach ($companyProfile as $key => $value) {
        # code...
        if($value == 1){
            $sum += 2.5;
        }elseif($value == 2){
            $sum += 5.5;
        }elseif($value == 3){
            $sum += 8.5;
        }
    }

    $average = $sum/6;
    return $average;

}