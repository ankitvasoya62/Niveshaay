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
        $listFeaturedOn = FeaturedOn::where('status','active')->orderBy('id','desc')->get();
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
}
