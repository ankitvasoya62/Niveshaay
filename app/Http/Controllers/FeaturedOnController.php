<?php

namespace App\Http\Controllers;

use App\Models\FeaturedOn;
use Illuminate\Http\Request;
use File;

class FeaturedOnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $active = "featured-on";
        $listFeaturedOn = FeaturedOn::where('status','active')->orderBy('sort_order','asc')->get();
        return view('backend.featuredon.index',compact('active','listFeaturedOn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $active = "featured-on";
        return view('backend.featuredon.add',compact('active'));
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
            'featured_title'=>'required',
            'featured_description'=>'required',
            'featured_date'=>'required',
            'featured_url'=>'required',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'featured_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            
            
        ]);
        $featuredOn = new FeaturedOn;
        $featuredOn->featured_title = $request->featured_title;
        $featuredOn->featured_description = $request->featured_description;
        $featuredOn->featured_date = $request->featured_date;
        $featuredOn->featured_url = $request->featured_url;
        $sortfeaturedOn = FeaturedOn::orderBy('sort_order','DESC')->first();
        if(empty($sortfeaturedOn)){
            $sort_order = 1;
        }else{
            $sort_order = $sortfeaturedOn->sort_order + 1;
        }
        $featuredOn->sort_order = $sort_order;
        if($request->file('featured_image')){
            try{
                $image = $request->file('featured_image');
                $imageFileExt = $image->getClientOriginalName();
                $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                $imageName = str_replace(" ", "_", $imageFileName).'_' .time().".".$image->extension();
                $destinationPath = public_path('images/featured/featured-image');
                
                if(!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true, true);
                }
                // $imageName = time().".".$image->extension();
                $image->move(public_path('images/featured/featured-image'),$imageName);
                $featuredOn->featured_image= $imageName;
            }catch(\Exception $e){

            }
            
        }
        
        try{
            $image = $request->file('featured_logo');
            $imageFileExt = $image->getClientOriginalName();
            $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
            $imageName = time().".".$image->extension();
            $destinationPath = public_path('images/featured/featured-logo');
                
            if(!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $image->move(public_path('images/featured/featured-logo'),$imageName);
            $featuredOn->featured_logo = $imageName;
        }catch(\Exception $e){

        }
        
        $featuredOn->save();
        return redirect()->route('admin.featured-on')->with('success','Feature Added Successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FeaturedOn  $featuredOn
     * @return \Illuminate\Http\Response
     */
    public function show(FeaturedOn $featuredOn)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeaturedOn  $featuredOn
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $featuredOn = FeaturedOn::find($id);
        $active = 'featured-on';
        return view('backend.featuredon.edit',compact('featuredOn','active'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FeaturedOn  $featuredOn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $featuredOn = FeaturedOn::find($id);
        $previous_featured_logo = $featuredOn->featured_logo;
        $previous_featured_image = $featuredOn->featured_image;
        $featuredOn->featured_title = $request->featured_title;
        $featuredOn->featured_description = $request->featured_description;
        $featuredOn->featured_date = $request->featured_date;
        $featuredOn->featured_url = $request->featured_url;
        // $featuredOn->sort_order = $request->sort_order;
        if($request->file('featured_image'))
        {   try{
                $image = $request->file('featured_image');
                $imageFileExt = $image->getClientOriginalName();
                $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                $imageName = str_replace(" ", "_", $imageFileName).'_' .time().".".$image->extension();
                $image->move(public_path('images/featured/featured-image'),$imageName);
                $featuredOn->featured_image= $imageName;
                @unlink(public_path('images/featured/featured-image/'.$previous_featured_image));
            }catch(\Exception $e){

            }
            
        }
        if($request->file('featured_logo')){
            try{
                $image = $request->file('featured_logo');
                $imageFileExt = $image->getClientOriginalName();
                $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                $imageName = time().".".$image->extension();
                $image->move(public_path('images/featured/featured-logo'),$imageName);
                $featuredOn->featured_logo = $imageName;
                @unlink(public_path('images/featured/featured-logo/'.$previous_featured_logo));
            }catch(\Exception $e){

            }
            
        }
        
        

        
        $featuredOn->save();
        return redirect()->route('admin.featured-on')->with('success','Changes Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeaturedOn  $featuredOn
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $featuredOn = FeaturedOn::find($id);
        $previous_featured_logo = $featuredOn->featured_logo;
        $previous_featured_image = $featuredOn->featured_image;
        $featuredOn->delete();
        @unlink(public_path('images/featured/featured-image/'.$previous_featured_image));
        @unlink(public_path('images/featured/featured-logo/'.$previous_featured_logo));
        return redirect()->route('admin.featured-on')->with('success','Feature Delete Successfully');
    }

    public function moveup($id){
        $currentFeaturedOn = FeaturedOn::find($id);
        $totalFeaturedOn = count(FeaturedOn::all());
        $currentOrder = $currentFeaturedOn->sort_order;
        if($totalFeaturedOn == 1){
            return redirect()->back();
        }else{
            if($currentOrder <= 1){
                $latestRecord = FeaturedOn::orderBy('sort_order','DESC')->first();
                $previousOrder = $latestRecord->sort_order;
                $previousfeaturedOn = FeaturedOn::where('sort_order',$previousOrder)->first();
                $previousfeaturedOn->sort_order = $currentOrder;
                $currentFeaturedOn->sort_order = $previousOrder;
                $currentFeaturedOn->save();
                $previousfeaturedOn->save();
    
            }else{
                $previousOrder = $currentOrder - 1 ;
                $previousfeaturedOn = FeaturedOn::where('sort_order',$previousOrder)->first();
                $previousfeaturedOn->sort_order = $currentOrder;
                $currentFeaturedOn->sort_order = $previousOrder;
                $currentFeaturedOn->save();
                $previousfeaturedOn->save();
    
            }
            return redirect()->back()->with('success','Moved up successfully');
        }
        
        
    }
    public function movedown($id){
        $currentFeaturedOn = FeaturedOn::find($id);
        $totalFeaturedOn = count(FeaturedOn::all());
        $currentOrder = $currentFeaturedOn->sort_order;
        if($totalFeaturedOn == 1){
            return redirect()->back();
        }else{
            if($currentOrder == $totalFeaturedOn){
                $firstRecord = FeaturedOn::orderBy('sort_order','ASC')->first();
                $newOrder = $firstRecord->sort_order ;
                $newfeaturedOn = FeaturedOn::where('sort_order',$newOrder)->first();
                $newfeaturedOn->sort_order = $currentOrder;
                $currentFeaturedOn->sort_order = $newOrder;
                $currentFeaturedOn->save();
                $newfeaturedOn->save();
            }else{
                $newOrder = $currentOrder + 1 ;
                $newfeaturedOn = FeaturedOn::where('sort_order',$newOrder)->first();
                $newfeaturedOn->sort_order = $currentOrder;
                $currentFeaturedOn->sort_order = $newOrder;
                $currentFeaturedOn->save();
                $newfeaturedOn->save();
    
            }
            return redirect()->back()->with('success','Moved down successfully');
        }
        
    }
}
