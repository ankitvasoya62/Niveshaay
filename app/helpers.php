<?php
use Illuminate\Support\Facades\Http;
use App\Models\ShareDetails;

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
    return ShareDetails::all()->where('copy_to_our_research',1)->where('status','active');
}