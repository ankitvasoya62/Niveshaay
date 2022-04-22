<?php

namespace App\Http\Controllers;

use App\Models\ResearchImage;
use App\Models\SubResearchImage;
use Illuminate\Http\Request;
use File;

class ResearchImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list_research_images = ResearchImage::all();
        $active = 'research_image';
        return view('backend.researchImages.index',compact('list_research_images','active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $active = 'research_image';
        return view('backend.researchImages.add',compact('active'));
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
        $this->validate($request,[
            'report_title'=>'required|unique:research_images',
            
            
        ]);
        $researchImages = new ResearchImage;
        $researchImages->report_title = $request->report_title;
        $researchImages->save();
        $researchId = $researchImages->id;
        $report_images = $request->file('report_image_path');
        if(!empty($report_images)){
            foreach ($report_images as $key => $value) {
                # code...
                $subResearchImages = new SubResearchImage;
                try{
                    $image = $value;
                    $imageFileExt = $image->getClientOriginalName();
                    $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                    $imageName = str_replace(" ", "_", $imageFileName).'_' . time().'.'.$image->getClientOriginalExtension();
                    //$imageName = time().".".$image->extension();
                    $destinationPath = public_path('images/research-images/'.$researchId);
                
                    if(!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, 0777, true, true);
                    }

                    $image->move(public_path('images/research-images/'.$researchId),$imageName);
                    $subResearchImages->report_image_path= $imageName;
                    $subResearchImages->research_image_id = $researchId;
                }catch(\Exception $e){
                    return $e->getMessage();
                }
                
                
                $subResearchImages->save();
                
            }
        }
        return redirect()->route('admin.edit.report-images',$researchId)->with('success','Images Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResearchImage  $researchImage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $research_images = ResearchImage::find($id);
        $research_title = $research_images->report_title;
        $research_images_path = SubResearchImage::where('research_image_id',$id)->get();
        // 
        // $research_images_array = ResearchImage::where('report_title',$research_title)->get();
        // $research_images_path = [];
        // foreach ($research_images_array as $key => $value) {
        //     # code...
        //     $same_title_images = array();
        //     $same_title_images['id'] = $value['id'];
        //     $same_title_images['image_path'] = $value['report_image_path'];
        //     $research_images_path[] = $same_title_images;
        // }
        $active = 'research_image';
        return view('backend.researchImages.view',compact('active','research_images','research_images_path'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResearchImage  $researchImage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $research_images = ResearchImage::find($id);
        // $research_title = $research_images->report_title;
        $research_images_path = SubResearchImage::where('research_image_id',$id)->get();
        // $research_images_path 
        // foreach ($research_images_array as $key => $value) {
        //     # code...
        //     $same_title_images = array();
        //     $same_title_images['id'] = $value['id'];
        //     $same_title_images['image_path'] = $value['report_image_path'];
        //     $research_images_path[] = $same_title_images;
        // }
        $active = 'research_image';
        return view('backend.researchImages.edit',compact('active','research_images','research_images_path'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResearchImage  $researchImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'report_title'=>'required|unique:research_images,report_title,'.$id,
            
            
        ]);
        $updateResearchImage = ResearchImage::find($id);

        $updateResearchImage->report_title = $request->report_title;
        $updateResearchImage->save();
        $report_images = $request->file('report_image_path');
        if(!empty($report_images)){
            foreach ($report_images as $key => $value) {
                # code...
                $researchImages = new SubResearchImage;
                try{
                    $image = $value;            
                    $imageFileExt = $image->getClientOriginalName();
                    $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                    $imageName = str_replace(" ", "_", $imageFileName).'_' . time().'.'.$image->getClientOriginalExtension();
                    //$imageName = time().".".$image->extension();
                    $destinationPath = public_path('images/research-images/'.$id);
                
                    if(!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, 0777, true, true);
                    }
                    //$imageName = time().".".$image->extension();
                    $image->move(public_path('images/research-images/'.$id),$imageName);
                    $researchImages->report_image_path= $imageName;
                    $researchImages->research_image_id = $id;
                    
                    $researchImages->save();
                }catch(\Exception $e){

                }
                
            }
        }
        return redirect()->back()->with('success','Images Update Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResearchImage  $researchImage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $researchImages = ResearchImage::find($id);
        // $research_image = $researchImages->report_image_path;
        $research_images_path = SubResearchImage::where('research_image_id',$id)->get();
        $researchImages->delete();
        // $research_images_path->delete();
        // foreach ($research_images_path as $key => $value) {
        //     # code...
        //     $research_image = $value->report_image_path;
        //     @unlink(public_path('images/research-images/'.$id)."/".$research_image);
        // }
        if(File::exists(public_path('images/research-images/'.$id))){
            File::deleteDirectory(public_path('images/research-images/'.$id));
        }
        

        // @unlink(public_path('images/research-images')."/".$id);
        $subResearchImage = SubResearchImage::where('research_image_id',$id);
        $subResearchImage->delete();
        return redirect()->back()->with('success','Images Delete Successfully!');
    }

    public function deletedByImage($id){
        $subResearchImage = SubResearchImage::find($id);
        $research_image = $subResearchImage->report_image_path;
        $subResearchImageId = $subResearchImage->research_image_id;
        $subResearchImage->delete();
        if(File::exists(public_path('images/research-images/'.$subResearchImageId)."/".$research_image)){
            @unlink(public_path('images/research-images/'.$subResearchImageId)."/".$research_image);
        }
        
        return redirect()->back()->with('success','Image Delete Successfully!');
    }
}
