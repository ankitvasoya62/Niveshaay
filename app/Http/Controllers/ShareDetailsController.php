<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShareDetails;

class ShareDetailsController extends Controller
{
    //
    public function listShare(){
        $share_list = ShareDetails::all()->where('status','active');
        $active = "share";
        return view('backend.shareManagement.listshare',compact('share_list','active'));
    }

    public function addShare(){
        $active = "share";
        return view('backend.shareManagement.addShare',compact('active'));
    }

    public function storeShare(Request $request){
        // dd($request);
        $this->validate($request,[
            'share_title'=>'required',
            'share_description'=>'required',
            'share_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'share_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'share_date' => 'required|date',
            'share_industry'=>'required',
            'share_cmp'=>'required',
            'share_market_cap'=>'required',
            'share_week_high_low'=>'required',
            'shareholding_promoters'=>'required',
            'shareholding_public'=>'required',
            'research_analyst_name'=>'required',
            'research_analyst_designation'=>'required',
            'research_analyst_email'=>'required',
            'share_description'=>'required',
            'share_outlook' => 'required',
            'short_description'=>'required'
        ]);

        $share = new ShareDetails;
        $share->share_title = $request->share_title;
        $share->share_date = $request->share_date;
        $share->share_industry = $request->share_industry;
        $share->share_cmp = $request->share_cmp;
        $share->share_market_cap = $request->share_market_cap;
        $share->share_week_high_low = $request->share_week_high_low;
        $share->shareholding_promoters = $request->shareholding_promoters;
        $share->shareholding_public = $request->shareholding_public;
        $share->research_analyst_name = $request->research_analyst_name;
        $share->research_analyst_designation = $request->research_analyst_designation;
        $share->research_analyst_email = $request->research_analyst_email;
        $share->share_description = $request->share_description;
        $share->share_outlook = $request->share_outlook;
        if(!empty($request->share_recommendation)){
            $share->share_recommendation = implode(",",$request->share_recommendation);
        }
        else{
            $share->share_recommendation = 0;
        }
        $share->copy_to_our_research = $request->copy_to_our_research;
        $share->short_description = $request->short_description;

        try{
            if($request->file('share_logo')){
                $sharelogo = $request->file('share_logo');
                $imageFileExt = $sharelogo->getClientOriginalName();
                $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                $shareLogoName =  str_replace(" ", "_", $imageFileName).'_' .time().".".$sharelogo->extension();
                $sharelogo->move(public_path('images/share-logo'),$shareLogoName);
                $share->share_logo = $shareLogoName;
            }
            if($request->file('share_image')){
                $shareimage = $request->file('share_image');
                $imageFileExt = $shareimage->getClientOriginalName();
                $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                $shareImageName = str_replace(" ", "_", $imageFileName).'_' .time().".".$shareimage->extension();
                $shareimage->move(public_path('images/share-images'),$shareImageName);
                $share->share_image = $shareImageName;
            }
            
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
        
        // $sharedescription = $request->file('share_description');
        // $shareDescriptionName = time().".".$sharedescription->extension();
        // $sharedescription->move(public_path('pdf'),$shareDescriptionName);
        // $share->share_description = $shareDescriptionName;
        $share->save();
        return redirect()->route('admin.share')->with('success','Share Added Successfully');
    }

    public function editShare($id){

        $active = 'share';
        $share = ShareDetails::find($id);
        return view('backend.shareManagement.editShare',compact('active','share'));
    }

    public function updateShare(Request $request,$id){
        
        $share = ShareDetails::find($id);
        $share_previous_image = $share->share_image;
        $share_previous_logo = $share->share_logo;
        $share->share_title = $request->share_title;
        $share->share_date = $request->share_date;
        $share->share_industry = $request->share_industry;
        $share->share_cmp = $request->share_cmp;
        $share->share_market_cap = $request->share_market_cap;
        $share->share_week_high_low = $request->share_week_high_low;
        $share->shareholding_promoters = $request->shareholding_promoters;
        $share->shareholding_public = $request->shareholding_public;
        $share->research_analyst_name = $request->research_analyst_name;
        $share->research_analyst_designation = $request->research_analyst_designation;
        $share->research_analyst_email = $request->research_analyst_email;
        $share->share_description = $request->share_description;
        $share->share_outlook = $request->share_outlook;
        if(!empty($request->share_recommendation)){
            $share->share_recommendation = implode(",",$request->share_recommendation);
        }
        else{
            $share->share_recommendation = 0;
        }
        $share->copy_to_our_research = !empty($request->copy_to_our_research) ? $request->copy_to_our_research :0 ;
        $share->short_description = $request->short_description;
        try{
            if($request->file('share_logo')){
                $sharelogo = $request->file('share_logo');
                $imageFileExt = $sharelogo->getClientOriginalName();
                $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                $shareLogoName =  str_replace(" ", "_", $imageFileName).'_' .time().".".$sharelogo->extension();
                $sharelogo->move(public_path('images/share-logo'),$shareLogoName);
                $share->share_logo = $shareLogoName;
                @unlink(public_path('images/share-logo')."/".$share_previous_logo);
            }
            if($request->file('share_image')){
                $shareimage = $request->file('share_image');
                $imageFileExt = $shareimage->getClientOriginalName();
                $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                $shareImageName = str_replace(" ", "_", $imageFileName).'_' .time().".".$shareimage->extension();
                $shareimage->move(public_path('images/share-images'),$shareImageName);
                $share->share_image = $shareImageName;
                @unlink(public_path('images/share-images')."/".$share_previous_image);
            }
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
        
        
        $share->save();
        return redirect()->route('admin.share')->with('success','Share Updated Successfully');
    }

    public function deleteShare($id){
        $active = 'share';
        $share = ShareDetails::find($id);
        $share_previous_image = $share->share_image;
        $share_previous_logo = $share->share_logo;
        
        // $share->status = 'deleted';
        $share->delete();  
        @unlink(public_path('images/share-logo')."/".$share_previous_logo);
        @unlink(public_path('images/share-images')."/".$share_previous_image);
        return redirect()->route('admin.share')->with('success','Share Deleted Successfully');      
    }
}
