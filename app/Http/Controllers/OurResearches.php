<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OurResearch;
use File;
use Illuminate\Support\Carbon;
class OurResearches extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listResearches()
    {
        $data=OurResearch::all()->where('status','active');
        $active='research';
        return view('backend.ourResearch.listResearches',compact('active','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addResearches()
    {
        $active='research';
        return view('backend.ourResearch.addResearch',compact('active'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeResearches(Request $request)
    {
         $this->validate($request,[
             'title'=>'required',
             'subtitle'=>'required',
             'description'=>'required',
             'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
         ]);
         $image = $request->file('image');
         $imageName = time().".".$image->extension();
         $image->move(public_path('images/our-research'),$imageName);

        OurResearch::create([
            'title'=>$request->title,
            'subtitle'=>$request->subtitle,
            'description'=>$request->description,
            'short_description'=>$request->description,
            'image_path'=>$imageName,
        ]);
        return redirect()->route('admin.research')->with('success','Researches Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editResearch($id)
    {
        $active="research";
        $research=OurResearch::find($id);
        return view('backend.ourResearch.editResearch',compact('research','active'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateResearch(Request $request, $id)
    {
        //dd($request->all());
        $this->validate($request,[
            'title'=>'required',
            'subtitle'=>'required',
            'description'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $research=OurResearch::find($id);
        $research->title=$request->title;
        $research->subtitle=$request->subtitle;
        $research->description=$request->description;
        $research->short_description = $request->short_description;
        if($request->has('image')){
            @unlink(public_path('images/our-research')."/".$research->image_path);
            $image = $request->file('image');
            $imageName = time().".".$image->extension();
            $image->move(public_path('images/our-research'),$imageName);
            $research->image_path= $imageName;
            
        }
        $research->save();
        
        return redirect()->route('admin.research')->with('success','Research Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteResearch($id)
    {   $research=OurResearch::find($id);
        $research_image_path = $research->image_path;
        @unlink(public_path('images/our-research')."/".$research_image_path);
        $data = array();
        $data['status'] = "deleted";
        $data['updated_at'] = Carbon::now();
        OurResearch::find($id)->update($data);
        return redirect()->route('admin.research')->with('success','Research deleted successfully');
    }
}
