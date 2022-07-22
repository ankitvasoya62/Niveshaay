<?php

namespace App\Http\Controllers;

use App\Models\OurClientSayManagement;
use Illuminate\Http\Request;
use File;

class OurClientSayManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $listClients = OurClientSayManagement::where('status','active')->orderBy('sort_order','asc')->get();
        $active ='clients';
        $i = 1;
        foreach ($listClients as $key => $value) {
            # code...
            if($value['sort_order'] != $i){
                $updateClient = OurClientSayManagement::find($value['id']);
                $updateClient['sort_order'] = $i;
                $updateClient->save();
            }
            $i++;
        }
        return view('backend.ourClients.index',compact('listClients','active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $active ='clients';
        return view('backend.ourClients.add',compact('active'));

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
            'client_name'=>'required',
            'client_description'=>'required',
            // 'client_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            // 'client_designation' => 'required'
            
        ]);

        $newClient = new OurClientSayManagement;
        $newClient->client_name = $request->client_name;
        $newClient->client_description = $request->client_description;
        $latestRecord = OurClientSayManagement::orderBy('sort_order','DESC')->first();
        if(empty($latestRecord)){
            $sort_order = 1;
        }else{
            $sort_order = $latestRecord->sort_order + 1;
        }
        $newClient->sort_order = $sort_order;
        if($request->file('client_image')){
            try{
                $image = $request->file('client_image');
                $imageFileExt = $image->getClientOriginalName();
                $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                $imageName = str_replace(" ", "_", $imageFileName).'_' .time().".".$image->extension();
                // $imageName = time().".".$image->extension();
                $destinationPath = public_path('images/clients');
                
                if(!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true, true);
                }
                $image->move(public_path('images/clients'),$imageName);
            }catch(\Exception $e){

            }
            
            $newClient->client_image= $imageName;
        }
        
        $newClient->client_designation = $request->client_designation;
        $newClient->save();
        return redirect()->route('admin.our-clients')->with('success','Client Added Successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OurClientSayManagement  $ourClientSayManagement
     * @return \Illuminate\Http\Response
     */
    public function show(OurClientSayManagement $ourClientSayManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OurClientSayManagement  $ourClientSayManagement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $client = OurClientSayManagement::find($id);
        $active = 'clients';
        return view('backend.ourClients.edit',compact('active','client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OurClientSayManagement  $ourClientSayManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'client_name'=>'required',
            'client_description'=>'required',
            
            // 'client_designation' => 'required'
            
        ]);
        $updateClient = OurClientSayManagement::find($id);
        $previous_image = $updateClient->client_image;
        $updateClient->client_name = $request->client_name;
        $updateClient->client_description = $request->client_description;
        //$updateClient->sort_order = $request->sort_order;
        if($request->file('client_image')){
            try{
                $image = $request->file('client_image');
                $imageFileExt = $image->getClientOriginalName();
                $imageFileName = pathinfo($imageFileExt, PATHINFO_FILENAME);
                $imageName = str_replace(" ", "_", $imageFileName).'_' .time().".".$image->extension();
                //$imageName = time().".".$image->extension();
                $destinationPath = public_path('images/clients');
                
                if(!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true, true);
                }
                $image->move(public_path('images/clients'),$imageName);
                $updateClient->client_image= $imageName;
                // if(!File::exists(public_path('images/tweeter-feeds/'.$previous_image))) {
                //     @unlink(public_path('images/tweeter-feeds/'.$previous_image));
                // }
                @unlink(public_path('images/clients/'.$previous_image));
            }catch(\Exception $e){

            }
            
        }
        
        $updateClient->client_designation = $request->client_designation;
        $updateClient->save();
        return redirect()->route('admin.our-clients')->with('success','Client Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OurClientSayManagement  $ourClientSayManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $client = OurClientSayManagement::find($id);
        // $previous_image = $client->client_image;
        // @unlink(public_path('images/clients/'.$previous_image));
        // $client->status = 'deleted';
        // $client->save();
        $client->delete();
        return redirect()->route('admin.our-clients')->with('success','Client Deleted Successfully!');
    }

    public function moveup($id){
        $currentClient = OurClientSayManagement::find($id);
        $totalClient = count(OurClientSayManagement::all());
        $currentOrder = $currentClient->sort_order;
        if($totalClient == 1){
            return redirect()->back();
        }else{
            if($currentOrder <= 1){
                $latestRecord = OurClientSayManagement::orderBy('sort_order','DESC')->first();
                $previousOrder = $latestRecord->sort_order;
                $previousClient = OurClientSayManagement::where('sort_order',$previousOrder)->first();
                $previousClient->sort_order = $currentOrder;
                $currentClient->sort_order = $previousOrder;
                $currentClient->save();
                $previousClient->save();
    
            }else{
                $previousRecord = OurClientSayManagement::where('sort_order','<',$currentOrder)->orderBy('sort_order','DESC')->first();
                if(empty($previousRecord)){
                    $latestRecord = OurClientSayManagement::orderBy('sort_order','DESC')->first();
                    $previousOrder = $latestRecord->sort_order;
                    
                }else{
                    $previousOrder = $previousRecord->sort_order ;
                }
                
                $previousClient = OurClientSayManagement::where('sort_order',$previousOrder)->first();
                $previousClient->sort_order = $currentOrder;
                $currentClient->sort_order = $previousOrder;
                $currentClient->save();
                $previousClient->save();
                
            }
            return redirect()->back()->with('success','Moved up successfully');
        }
        
    }
    public function movedown($id){
        $currentClient = OurClientSayManagement::find($id);
        $totalClient = count(OurClientSayManagement::all());
        $currentOrder = $currentClient->sort_order;
        
        if($totalClient == 1){
            return redirect()->back();
        }else{
            if($currentOrder == $totalClient){
                $firstRecord = OurClientSayManagement::orderBy('sort_order','ASC')->first();
                $newOrder = $firstRecord->sort_order ;
                $newClient = OurClientSayManagement::where('sort_order',$newOrder)->first();
                $newClient->sort_order = $currentOrder;
                $currentClient->sort_order = $newOrder;
                $currentClient->save();
                $newClient->save();
            }else{
                $nextRecord = OurClientSayManagement::where('sort_order','>',$currentOrder)->orderBy('sort_order','ASC')->first();
                if(empty($nextRecord)){
                    $newOrder = 1;
                }else{
                    $newOrder = $nextRecord->sort_order ;
                }
                
                $newClient = OurClientSayManagement::where('sort_order',$newOrder)->first();
                $newClient->sort_order = $currentOrder;
                $currentClient->sort_order = $newOrder;
                $currentClient->save();
                $newClient->save();
    
            }
            return redirect()->back()->with('success','Moved down successfully');
        }
        
    }

    public function trash(){
        $listClients = OurClientSayManagement::onlyTrashed()->orderBy('sort_order','asc')->get();
        $active ='clients';
        return view('backend.ourClients.trash',compact('listClients','active'));
    }

    public function restore($id){
        $client = OurClientSayManagement::withTrashed()->find($id);
        $client->restore();
        return redirect()->back()->with('success',"Record Restored Successfully!");
    }

    public function permanentDelete($id){
        $client = OurClientSayManagement::withTrashed()->find($id);
        $previous_image = $client->client_image;
        @unlink(public_path('images/clients/'.$previous_image));
        $client->forceDelete();
        return redirect()->back()->with('success',"Record Deleted Successfully!");
    }
}
