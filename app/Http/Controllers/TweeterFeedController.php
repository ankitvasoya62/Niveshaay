<?php

namespace App\Http\Controllers;

use App\Models\TweeterFeed;
use Illuminate\Http\Request;

class TweeterFeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $listtweeterfeed = TweeterFeed::all();
        $active = 'tweeter-feeds';
        return view('backend.tweeterfeed.index',compact('listtweeterfeed','active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $active = 'tweeter-feeds';
        return view('backend.tweeterfeed.add',compact('active'));
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
            'tweeter_name'=>'required',
            'tweeter_description'=>'required',
            'tweeter_user_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'tweeter_username' => 'required'
            
        ]);

        $tweeterFeed = new TweeterFeed;
        $tweeterFeed->tweeter_name = $request->tweeter_name;
        $tweeterFeed->tweeter_username = $request->tweeter_username;
        $tweeterFeed->tweeter_description = $request->tweeter_description;
        
        $image = $request->file('tweeter_user_image');
        $imageName = time().".".$image->extension();
        $image->move(public_path('images/tweeter-feeds'),$imageName);
        $tweeterFeed->tweeter_user_image= $imageName;
        // $newClient->client_designation = $request->client_designation;
        $tweeterFeed->save();
        return redirect()->route('admin.tweeter-feeds')->with('success','Tweeter Feed Added Successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TweeterFeed  $tweeterFeed
     * @return \Illuminate\Http\Response
     */
    public function show(TweeterFeed $tweeterFeed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TweeterFeed  $tweeterFeed
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $tweeterFeeds = TweeterFeed::find($id);
        $active = "tweeter-feeds";
        return view('backend.tweeterfeed.edit',compact('active','tweeterFeeds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TweeterFeed  $tweeterFeed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $tweeterFeed = TweeterFeed::find($id);
        $previous_image = $tweeterFeed->tweeter_user_image;
        $tweeterFeed->tweeter_name = $request->tweeter_name;
        $tweeterFeed->tweeter_username = $request->tweeter_username;
        $tweeterFeed->tweeter_description = $request->tweeter_description;
        if($request->file('tweeter_user_image')){
            $image = $request->file('tweeter_user_image');
            $imageName = time().".".$image->extension();
            $image->move(public_path('images/tweeter-feeds'),$imageName);
            $tweeterFeed->tweeter_user_image= $imageName;
            @unlink(public_path('images/tweeter-feeds/'.$previous_image));
        }
        
        // $newClient->client_designation = $request->client_designation;
        $tweeterFeed->save();
        return redirect()->route('admin.tweeter-feeds')->with('success','Tweeter Feed Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TweeterFeed  $tweeterFeed
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $tweeterFeed = TweeterFeed::find($id);
        $previous_image = $tweeterFeed->tweeter_user_image;
        $tweeterFeed->delete();
        @unlink(public_path('images/tweeter-feeds/'.$previous_image));
        return redirect()->route('admin.tweeter-feeds')->with('success','Tweeter Feed Deleted Successfully');
    }
}
