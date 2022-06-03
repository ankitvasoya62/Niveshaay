<?php
use Illuminate\Support\Facades\Http;
use App\Models\ShareDetails;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
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