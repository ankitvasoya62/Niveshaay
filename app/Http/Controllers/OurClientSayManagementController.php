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
        $listClients = OurClientSayManagement::all()->where('status','active');
        $active ='clients';
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
            'client_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'client_designation' => 'required'
            
        ]);

        $newClient = new OurClientSayManagement;
        $newClient->client_name = $request->client_name;
        $newClient->client_description = $request->client_description;
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
        return redirect()->route('admin.our-clients')->with('success','Client Added Successfully');

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
            
            'client_designation' => 'required'
            
        ]);
        $updateClient = OurClientSayManagement::find($id);
        $previous_image = $updateClient->client_image;
        $updateClient->client_name = $request->client_name;
        $updateClient->client_description = $request->client_description;
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
        return redirect()->route('admin.our-clients')->with('success','Client Updated Successfully');
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
        $previous_image = $client->client_image;
        @unlink(public_path('images/clients/'.$previous_image));
        // $client->status = 'deleted';
        // $client->save();
        $client->delete();
        return redirect()->route('admin.our-clients')->with('success','Client Deleted Successfully');
    }
}
