<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShareDetails;
use File;
use Illuminate\Support\Facades\Validator;

class ShareDetailsController extends Controller
{
    //
    public function listShare(){
        $share_list = ShareDetails::where('status','active')->orderBy('id','desc')->get();
        $active = "share";
        return view('backend.shareManagement.listshare',compact('share_list','active'));
    }

    public function addShare($upload_type){
        $active = "share";
        return view('backend.shareManagement.addShare',compact('active','upload_type'));
    }

    public function storeShare(Request $request,$upload_type){
        // dd($request);
        // return $request->has('submit');
        if($request->has('submit')){
            
            if($upload_type == 0){
                $validator = Validator::make(
                    $request->all(), [
                        'share_title'=>'required',
                        'share_description'=>'required',
                        'share_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',

                    ],[
                        'share_title.required'=> "Title field is required",
                        'share_description.required'=> "Description field is required",
                        'share_logo.required'=> "Company logo field is required",
                        'share_logo.mimes'=>"Please upload file having extensions .jpeg/.jpg/.png/.gif only."
                        
                    ]
                );
                if($validator->fails()){
                    
                    $errors = ['success'=>0,'message'=>$validator->errors()];
                    return response()->json($errors);
                }
                // $this->validate($request,[
                //     'share_title'=>'required',
                //     'share_description'=>'required',
                //     'share_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                //     'share_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                //     'share_date' => 'required|date',
                    
                // ],[
                //     'share_title.required'=> "Title field is required",
                //     'share_description.required'=> "Description field is required",
                //     'share_logo.required'=> "Company logo field is required",
                //     'share_image.required'=> "Report image field is required",
                //     'share_date.required'=> "Initiating coverage date field is required"
                // ]);
        
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
                    // return redirect()->back()->with('error',$e->getMessage());
                    $errors = ['success'=>0,'message'=>$e->getMessage()];
                    return response()->json($errors);
                }
                $share->mutual_funds = $request->mutual_funds;
                $share->fiis = $request->fiis;
                $share->share_status = "1";
                // $sharedescription = $request->file('share_description');
                // $shareDescriptionName = time().".".$sharedescription->extension();
                // $sharedescription->move(public_path('pdf'),$shareDescriptionName);
                // $share->share_description = $shareDescriptionName;
                $share->save();
            }else{
                // $this->validate($request,[
                //     'share_title'=>'required',
                //     // 'share_description'=>'required',
                //     'share_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                //     // 'share_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                //     // 'share_date' => 'required|date',
                //     // 'share_description'=>'required',
                //     'pdf_name' => 'required|mimes:pdf',
                //     // 'short_description'=>'required'
                // ]);
                $validator = Validator::make(
                    $request->all(), [
                        'share_title'=>'required',
                        // 'share_description'=>'required',
                        'share_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        // 'share_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        // 'share_date' => 'required|date',
                        // 'share_description'=>'required',
                        'pdf_name' => 'required|mimes:pdf',
                        // 'short_description'=>'required'
                    ],[
                        'share_title.required'=> "Title field is required",
                        
                        'share_logo.required'=> "Company logo field is required",
                        
                        'pdf_name.required'=> "PDF field is required"
                    ]
                );
                if($validator->fails()){
                    
                    $errors = ['success'=>0,'message'=>$validator->errors()];
                    return response()->json($errors);
                }
        
                $share = new ShareDetails;
                $share->share_title = $request->share_title;
                //$share->share_date = $request->share_date;
                
                //$share->share_description = $request->share_description;
                
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
                    }
                    // if($request->file('share_image')){
                    //     $shareimage = $request->file('share_image');
                    //     $imageFileExt = $shareimage->getClientOriginalName();
                    //     $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                    //     $shareImageName = str_replace(" ", "_", $imageFileName).'_' .time().".".$shareimage->extension();
                    //     $shareimage->move(public_path('images/share-images'),$shareImageName);
                    //     $share->share_image = $shareImageName;
                    // }
                    if($request->file('pdf_name')){
                        $destinationPath = public_path('pdf');
                        if(!File::exists($destinationPath)) {
                            File::makeDirectory($destinationPath, 0777, true, true);
                        }
                        $pdfName = $request->file('pdf_name');
                        $imageFileExt = $pdfName->getClientOriginalName();
                        $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                        $reportPdfName = str_replace(" ", "_", $imageFileName).'_' .time().".".$pdfName->extension();
                        $pdfName->move(public_path('pdf'),$reportPdfName);
                        $share->pdf_name = $reportPdfName;
                    }
                    
                }catch(\Exception $e){
                    dd($e->getmessage());
                    //return redirect()->back()->with('error',$e->getMessage());
                }
                // $share->mutual_funds = $request->mutual_funds;
                // $share->fiis = $request->fiis;
                $share->share_status = "1";
                $share->upload_type = "1";
                // $sharedescription = $request->file('share_description');
                // $shareDescriptionName = time().".".$sharedescription->extension();
                // $sharedescription->move(public_path('pdf'),$shareDescriptionName);
                // $share->share_description = $shareDescriptionName;
                $share->save();    
            }
            $success = ['success'=>1];
            session()->flash('success','Report Uploaded Successfully!');
            return response()->json($success); 
            //return redirect()->route('admin.share')->with('success','Report Uploaded Successfully!');
        }else if ($request->has('draft')) {
            $share = new ShareDetails;
            $share->share_title = $request->share_title;
            
            if($upload_type == 0){
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
                $share->mutual_funds = $request->mutual_funds;
                $share->fiis = $request->fiis;
                $share->upload_type = "0";
            }else{
                $share->upload_type = "1";
            }
            
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
                }
                if($upload_type == 0){
                    if($request->file('share_image')){
                        $shareimage = $request->file('share_image');
                        $imageFileExt = $shareimage->getClientOriginalName();
                        $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                        $shareImageName = str_replace(" ", "_", $imageFileName).'_' .time().".".$shareimage->extension();
                        $shareimage->move(public_path('images/share-images'),$shareImageName);
                        $share->share_image = $shareImageName;
                    }
                }
                
                if($upload_type == 1){
                    if($request->file('pdf_name')){
                        $destinationPath = public_path('pdf');
                    
                        if(!File::exists($destinationPath)) {
                            File::makeDirectory($destinationPath, 0777, true, true);
                        }
                        $pdfName = $request->file('pdf_name');
                        $imageFileExt = $pdfName->getClientOriginalName();
                        $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                        $reportPdfName = str_replace(" ", "_", $imageFileName).'_' .time().".".$pdfName->extension();
                        $pdfName->move(public_path('pdf'),$reportPdfName);
                        $share->pdf_name = $reportPdfName;
                    }
                }
                
            }catch(\Exception $e){
                return redirect()->back()->with('error',$e->getMessage());
            }
            
            // $sharedescription = $request->file('share_description');
            // $shareDescriptionName = time().".".$sharedescription->extension();
            // $sharedescription->move(public_path('pdf'),$shareDescriptionName);
            // $share->share_description = $shareDescriptionName;
            
            $share->share_status = "0";
            $share->save();
            $success = ['success'=>1];
            session()->flash('success','Draft Created Successfully!');
            return response()->json($success);
            //return redirect()->route('admin.share')->with('success','Draft Created Successfully!');
        }
        return redirect()->route('admin.share');
        
    }

    public function editShare($id){

        $active = 'share';
        $share = ShareDetails::find($id);
        return view('backend.shareManagement.editShare',compact('active','share'));
    }

    public function updateShare(Request $request,$id){
        
        $share = ShareDetails::find($id);
        if($request->has('submit')){
            if($share->share_status == 0){
                $validateArray = [
                    'share_title'=>'required',
                    // 'short_description'=>'required'
                ];
                
                
                if(empty($share->share_logo)){
                    $validateArray['share_logo'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
                }
                $validator = Validator::make(
                    $request->all(), $validateArray,[
                        'share_title.required'=> "Title field is required",
                        
                        'share_logo.required'=> "Company logo field is required",
                        'share_logo.mimes'=>"Please upload file having extensions .jpeg/.jpg/.png/.gif only."
                    ]
                );
                if($validator->fails()){
                    
                    $errors = ['success'=>0,'message'=>$validator->errors()];
                    return response()->json($errors);
                }
                // $this->validate($request,$validateArray); 
            }
            
            $share_previous_logo = $share->share_logo;
            $share->share_title = $request->share_title;
            

            if($share->upload_type == 0){
                $share->share_date = $request->share_date;
                $share_previous_image = $share->share_image;
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
                $share->mutual_funds = $request->mutual_funds;
                $share->fiis = $request->fiis;
            }
            
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
                if($share->upload_type == 0 ){
                    if($request->file('share_image')){
                        $shareimage = $request->file('share_image');
                        $imageFileExt = $shareimage->getClientOriginalName();
                        $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                        $shareImageName = str_replace(" ", "_", $imageFileName).'_' .time().".".$shareimage->extension();
                        $shareimage->move(public_path('images/share-images'),$shareImageName);
                        $share->share_image = $shareImageName;
                        @unlink(public_path('images/share-images')."/".$share_previous_image);
                    }
                }
               
                if($share->upload_type == 1){
                    if($request->file('pdf_name')){
                        $destinationPath = public_path('pdf');
                        if(!File::exists($destinationPath)) {
                            File::makeDirectory($destinationPath, 0777, true, true);
                        }
                        $pdfName = $request->file('pdf_name');
                        $imageFileExt = $pdfName->getClientOriginalName();
                        $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                        $reportPdfName = str_replace(" ", "_", $imageFileName).'_' .time().".".$pdfName->extension();
                        $pdfName->move(public_path('pdf'),$reportPdfName);
                        $share->pdf_name = $reportPdfName;
                    }
                }
            }catch(\Exception $e){
                $errors = ['success'=>0,'message'=>$e->getMessage()];
                return response()->json($errors);
            }
            
            $share->share_status = "1";
            
            $share->save();
            $success = ['success'=>1];
            session()->flash('success','Report Uploaded Successfully!');
            return response()->json($success);
            //return redirect()->route('admin.share')->with('success','Report Uploaded Successfully!');
        }else if ($request->has('draft')) {
           
            $share_previous_logo = $share->share_logo;
            $share->share_title = $request->share_title;
            
            if($share->upload_type == 0){
                $share_previous_image = $share->share_image;
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
                $share->mutual_funds = $request->mutual_funds;
                $share->fiis = $request->fiis;
            }
            
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
                if($share->upload_type == 0){
                    if($request->file('share_image')){
                        $shareimage = $request->file('share_image');
                        $imageFileExt = $shareimage->getClientOriginalName();
                        $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                        $shareImageName = str_replace(" ", "_", $imageFileName).'_' .time().".".$shareimage->extension();
                        $shareimage->move(public_path('images/share-images'),$shareImageName);
                        $share->share_image = $shareImageName;
                        @unlink(public_path('images/share-images')."/".$share_previous_image);
                    }
                }
                
                if($share->upload_type == 1){
                    if($request->file('pdf_name')){
                        $destinationPath = public_path('pdf');
                        if(!File::exists($destinationPath)) {
                            File::makeDirectory($destinationPath, 0777, true, true);
                        }
                        $pdfName = $request->file('pdf_name');
                        $imageFileExt = $pdfName->getClientOriginalName();
                        $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                        $reportPdfName = str_replace(" ", "_", $imageFileName).'_' .time().".".$pdfName->extension();
                        $pdfName->move(public_path('pdf'),$reportPdfName);
                        $share->pdf_name = $reportPdfName;
                    }
                }
            }catch(\Exception $e){
                return redirect()->back()->with('error',$e->getMessage());
            }
            
           
            $share->share_status = "0";            
            $share->save();
            session()->flash('success','Draft Updated Successfully!');
            $success = ['success'=>1];
            return response()->json($success);
        }
        $success = ['success'=>1];
        return response()->json($success);
    }

    public function deleteShare($id){
        $active = 'share';
        $share = ShareDetails::find($id);
        // $share_previous_image = $share->share_image;
        // $share_previous_logo = $share->share_logo;
        
        // $share->status = 'deleted';
        $share->delete();  
        // @unlink(public_path('images/share-logo')."/".$share_previous_logo);
        // @unlink(public_path('images/share-images')."/".$share_previous_image);
        return redirect()->route('admin.share')->with('success','Report Deleted Successfully!');      
    }

    public function viewShare($id){
        $share = ShareDetails::find($id);
        $active = 'share';
        return view('backend.shareManagement.viewreport',compact('active','share'));
        // return view()
    }

    public function storeImages(Request $request){
        $destinationPath = public_path('images/report');
        if(!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }
        $shareimage = $request->file('file');
        $shareImageName = time().".".$shareimage->extension();
        $shareimage->move(public_path('images/report'),$shareImageName);
        
        return asset('images/report/'.$shareImageName);       
    }

    public function trash(){
        $share_list = ShareDetails::onlyTrashed()->orderBy('id','desc')->get();
        $active = "share";
        return view('backend.shareManagement.trash',compact('share_list','active'));
    }

    public function restore($id){
        $report = ShareDetails::withTrashed()->find($id);
        $report->restore();
        return redirect()->route('admin.report.trash')->with('success',"Record Restored Successfully!");
    }

    public function permanentDelete($id){
        $report = ShareDetails::withTrashed()->find($id);
        $share_previous_image = $report->share_image;
        $share_previous_logo = $report->share_logo;
        $report->forceDelete();
        @unlink(public_path('images/share-logo')."/".$share_previous_logo);
        @unlink(public_path('images/share-images')."/".$share_previous_image);
        return redirect()->route('admin.report.trash')->with('success',"Record Deleted Successfully!");
    }
}
