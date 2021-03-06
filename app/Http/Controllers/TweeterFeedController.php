<?php

namespace App\Http\Controllers;

use App\Models\TweeterFeed;
use Illuminate\Http\Request;
use File;

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
        $listtweeterfeed = TweeterFeed::orderBy('sort_order','asc')->get();
        $active = 'tweeter-feeds';
        $i = 1;
        foreach ($listtweeterfeed as $key => $value) {
            # code...
            if($value['sort_order'] != $i){
                $updatetweet = TweeterFeed::find($value['id']);
                $updatetweet['sort_order'] = $i;
                $updatetweet->save();
            }
            $i++;
        }
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
            // 'tweeter_user_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'tweeter_username' => 'required'
            
        ]);

        $tweeterFeed = new TweeterFeed;
        $tweeterFeed->tweeter_name = $request->tweeter_name;
        $tweeterFeed->tweeter_username = $request->tweeter_username;
        $tweeterFeed->tweeter_description = $request->tweeter_description;
        $latestRecord = TweeterFeed::orderBy('sort_order','DESC')->first();
        if(empty($latestRecord)){
            $sort_order = 1;
        }else{
            $sort_order = $latestRecord->sort_order + 1;
        }
        $tweeterFeed->sort_order = $sort_order;
        try{
            if($request->file('tweeter_user_image')){
                $image = $request->file('tweeter_user_image');
                $imageFileExt = $image->getClientOriginalName();
                $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                $imageName = str_replace(" ", "_", $imageFileName).'_' .time().".".$image->extension();
                $destinationPath = public_path('images/tweeter-feeds');
                
                if(!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true, true);
                }
                $image->move(public_path('images/tweeter-feeds'),$imageName);
                $tweeterFeed->tweeter_user_image= $imageName;
            }
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
        
        
        // $newClient->client_designation = $request->client_designation;
        $tweeterFeed->save();
        return redirect()->route('admin.tweeter-feeds')->with('success','Tweeter Feed Added Successfully!');
        
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
        //$tweeterFeed->sort_order = $request->sort_order;
        try{
            if($request->file('tweeter_user_image')){
                $image = $request->file('tweeter_user_image');
                $imageFileExt = $image->getClientOriginalName();
                $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                $imageName = str_replace(" ", "_", $imageFileName).'_' .time().".".$image->extension();
                // $imageName = time().".".$image->extension();
                $destinationPath = public_path('images/tweeter-feeds');
                
                if(!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true, true);
                }
                $image->move(public_path('images/tweeter-feeds'),$imageName);
                $tweeterFeed->tweeter_user_image= $imageName;
                if(File::exists(public_path('images/tweeter-feeds/'.$previous_image))) {
                    @unlink(public_path('images/tweeter-feeds/'.$previous_image));
                }
                
            }
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
        
        
        // $newClient->client_designation = $request->client_designation;
        $tweeterFeed->save();
        return redirect()->route('admin.tweeter-feeds')->with('success','Tweeter Feed Updated Successfully!');
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
        //$previous_image = $tweeterFeed->tweeter_user_image;
        $tweeterFeed->delete();
        // if(File::exists(public_path('images/tweeter-feeds/'.$previous_image))) {
        //     @unlink(public_path('images/tweeter-feeds/'.$previous_image));
        // }
        
        return redirect()->route('admin.tweeter-feeds')->with('success','Tweeter Feed Deleted Successfully!');
    }

    public function moveup($id){
        $currentTweet = TweeterFeed::find($id);
        $totalTweet = count(TweeterFeed::all());
        $currentOrder = $currentTweet->sort_order;
        if($totalTweet == 1){
            return redirect()->back();
        }else{
            if($currentOrder <= 1){
                $latestRecord = TweeterFeed::orderBy('sort_order','DESC')->first();
                $previousOrder = $latestRecord->sort_order;
                $previousTweet = TweeterFeed::where('sort_order',$previousOrder)->first();
                $previousTweet->sort_order = $currentOrder;
                $currentTweet->sort_order = $previousOrder;
                $currentTweet->save();
                $previousTweet->save();
    
            }else{
                $previousRecord = TweeterFeed::where('sort_order','<',$currentOrder)->orderBy('sort_order','DESC')->first();
                if(empty($previousRecord)){
                    $latestRecord = TweeterFeed::orderBy('sort_order','DESC')->first();
                    $previousOrder = $latestRecord->sort_order;
                    
                }else{
                    $previousOrder = $previousRecord->sort_order ;
                }
                $previousTweet = TweeterFeed::where('sort_order',$previousOrder)->first();
                $previousTweet->sort_order = $currentOrder;
                $currentTweet->sort_order = $previousOrder;
                $currentTweet->save();
                $previousTweet->save();
    
            }
            return redirect()->back()->with('success','Moved up successfully');
        }
        
    }
    public function movedown($id){
        $currentTweet = TweeterFeed::find($id);
        $totalTweet = count(TweeterFeed::all());
        $currentOrder = $currentTweet->sort_order;
        if($totalTweet == 1){
            return redirect()->back();
        }else{
            if($currentOrder == $totalTweet){
                $firstRecord = TweeterFeed::orderBy('sort_order','ASC')->first();
                $newOrder = $firstRecord->sort_order ;
                $newTweet = TweeterFeed::where('sort_order',$newOrder)->first();
                $newTweet->sort_order = $currentOrder;
                $currentTweet->sort_order = $newOrder;
                $currentTweet->save();
                $newTweet->save();
            }else{
                $nextRecord = TweeterFeed::where('sort_order','>',$currentOrder)->orderBy('sort_order','ASC')->first();
                if(empty($nextRecord)){
                    $firstRecord = TweeterFeed::orderBy('sort_order','ASC')->first();
                    $newOrder = $firstRecord->sort_order ;
                }else{
                    $newOrder = $nextRecord->sort_order ;
                }
                $newTweet = TweeterFeed::where('sort_order',$newOrder)->first();
                $newTweet->sort_order = $currentOrder;
                $currentTweet->sort_order = $newOrder;
                $currentTweet->save();
                $newTweet->save();
            }
            return redirect()->back()->with('success','Moved down successfully');
        }
        
    }

    public function trash(){
        $listtweeterfeed = TweeterFeed::onlyTrashed()->orderBy('sort_order','asc')->get();
        $active = "tweeter-feeds";
        return view('backend.tweeterfeed.trash',compact('listtweeterfeed','active'));
    }

    public function restore($id){
        $tweeterFeed = TweeterFeed::withTrashed()->find($id);
        $tweeterFeed->restore();
        return redirect()->back()->with('success',"Record Restored Successfully!");
    }

    public function permanentDelete($id){
        $tweeterFeed = TweeterFeed::withTrashed()->find($id);
        $previous_image = $tweeterFeed->tweeter_user_image;
        $tweeterFeed->forceDelete();
        if(File::exists(public_path('images/tweeter-feeds/'.$previous_image))) {
            @unlink(public_path('images/tweeter-feeds/'.$previous_image));
        }
        return redirect()->back()->with('success',"Record Deleted Successfully!");
    }
}
