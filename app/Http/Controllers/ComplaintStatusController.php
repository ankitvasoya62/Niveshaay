<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\CurrentMonthComplaint;
use App\Models\MonthlyComplaint;
use App\Models\AnnuallyComplaint;

class ComplaintStatusController extends Controller
{
    //
    public function currentMonth(){
        $active = 'current-month';
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
        

        
        return view('backend.complaintStatus.currentmonth',compact('active','current_month_investor_count','sebi_scores_count','other_sources_count'));
    }

    public function storeCurrentMonth(Request $request){
        
        if(count($request->investor) == 6 && count($request->sebi_scores) == 6 && count($request->other_sources) == 6 ){
            $fields = [
                
                'pending_last_month',
                'received',
                'resolved',
                'total_pending',
                'pending_3m',
                'avg_resolution_time'
            ];

            $investorsDetails = $request->investor;
            $sebiDetails = $request->sebi_scores;
            $otherDetails = $request->other_sources;
            $today= Carbon::now();
            $currentmonth = $today->month;
            $currentyear = $today->year;
            $received_from = [
                'Investor',
                'SEBI Scores',
                'Other Sources'
            ];

            foreach ($received_from as $row => $col) {
                # code...

                $insert_or_update_count = CurrentMonthComplaint::latest()
                                        ->where('received_from',$col)
                                        ->where('month',$currentmonth)
                                        ->where('year',$currentyear)
                                        ->first();
                $currentmonthinsert = array();
                $currentmonthinsert['received_from'] = $col;
                $currentmonthinsert['month'] = $currentmonth;
                $currentmonthinsert['year'] = $currentyear;
                foreach ($fields as $key => $value) {
                    # code...
                    if($row == 0){
                        $currentmonthinsert[$value] = !empty($investorsDetails[$key]) ? $investorsDetails[$key] : 0;
                    }
                    elseif ($row == 1) {
                        # code...
                        $currentmonthinsert[$value] = !empty($sebiDetails[$key]) ? $sebiDetails[$key] : 0;
                    }
                    else{
                        $currentmonthinsert[$value] = !empty($otherDetails[$key]) ? $otherDetails[$key] : 0;
                    }
                    
                }
                if(!empty($insert_or_update_count)){
                    $update_id = $insert_or_update_count->id;
                    CurrentMonthComplaint::find($update_id)->update($currentmonthinsert);
                }else{
                    CurrentMonthComplaint::insert($currentmonthinsert);
                }
                
            }
            return redirect()->route('admin.currentmonthcomplaint')->with('success','Research Updated Successfully');
        }else{
            return redirect()->route('admin.currentmonthcomplaint')->with('error','Something went wrong');
        }
    }

    public function Monthly(){
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
        $active ='monthly';
        return view('backend.complaintStatus.monthly',compact('monthlyComplaints','active'));
    }

    public function storeMonthly(Request $request){

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

        foreach ($data as $key => $value) {
            # code...
            $complaint_month = $value['monthnumber'];
            $complaint_year = $value['year'];
            $complaint_full_year = $value['fullyear'];
            $per_month_data = array();
            $per_month_data = MonthlyComplaint::latest()->where('month',$complaint_month)->where('year',$complaint_full_year)->first();
            
            $storeMonthlyComplaints = array();
            $storeMonthlyComplaints['carried_forward'] = !empty($request['carried_forward_'.$key]) ? $request['carried_forward_'.$key] : 0 ;
            $storeMonthlyComplaints['received'] = !empty($request['received_'.$key]) ? $request['received_'.$key] :0;
            $storeMonthlyComplaints['resolved'] = !empty($request['resolved_'.$key]) ? $request['resolved_'.$key] : 0;
            $storeMonthlyComplaints['pending'] = !empty($request['pending_'.$key]) ? $request['pending_'.$key] : 0;
            $storeMonthlyComplaints['month'] = $complaint_month;
            $storeMonthlyComplaints['year'] = $complaint_full_year;

            if(!empty($per_month_data)){
                $update_id = $per_month_data->id;
                MonthlyComplaint::find($update_id)->update($storeMonthlyComplaints);
            }else{
                MonthlyComplaint::insert($storeMonthlyComplaints);
            }
        }
        return redirect()->route('admin.monthlycomplaint')->with('success','Record updated successfuly');
    }

    public function Anually(){
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
        $active ='annually';
        return view('backend.complaintStatus.annually',compact('annuallyComplaints','active'));
    }

    public function storeAnnually(Request $request){

        $data = array();
        for ($i = 2; $i >= 0; $i--) {
            
            $year = Carbon::now()->subYear($i)->format('Y');
            $monthnumber = Carbon::today()->startOfMonth()->subMonth($i)->format('n');
            array_push($data, array(
                
                'year' => $year,
                
            ));
        }

        foreach ($data as $key => $value) {
            # code...
            $complaint_year = $value['year'];
            $per_year_complaints = array();
            $per_year_complaints = AnnuallyComplaint::latest()->where('year',$complaint_year)->first();
            $storeAnnuallyComplaints = array();
            $storeAnnuallyComplaints['carried_forward'] = !empty($request['carried_forward_'.$key]) ? $request['carried_forward_'.$key] : 0 ;
            $storeAnnuallyComplaints['received'] = !empty($request['received_'.$key]) ? $request['received_'.$key] : 0;
            $storeAnnuallyComplaints['resolved'] = !empty($request['resolved_'.$key]) ? $request['resolved_'.$key] : 0;
            $storeAnnuallyComplaints['pending'] = !empty($request['pending_'.$key]) ? $request['pending_'.$key] : 0;
            
            $storeAnnuallyComplaints['year'] = $complaint_year;

            if(!empty($per_year_complaints)){
                $update_id = $per_year_complaints->id;
                AnnuallyComplaint::find($update_id)->update($storeAnnuallyComplaints);
            }else{
                AnnuallyComplaint::insert($storeAnnuallyComplaints);
            }

        }
        return redirect()->route('admin.anuallycomplaint')->with('success','Record updated successfuly');
    }
}
