<?php

namespace App\Http\Controllers;

use App\Models\Disclosure;
use Illuminate\Http\Request;

class DisclosureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $active = 'disclosure';
        $disclosures = Disclosure::OrderBy('id','desc')->get();
        return view('backend.disclosure.index',compact('active','disclosures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $active = 'disclosure';
        return view('backend.disclosure.add',compact('active'));
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
        $disclosure = new Disclosure;
        $disclosure->financial_year = $request->financial_year;
        $disclosure->audit_status = $request->audit_status;
        $disclosure->remarks = $request->remarks;
        $disclosure->save();
        return redirect()->route('admin.disclosure')->with('success','Record Added Successfully !');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rc  $rc
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rc  $rc
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $active = 'disclosure';
        $disclosure = Disclosure::find($id);
        return view('backend.disclosure.edit',compact('active','disclosure'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rc  $rc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $disclosure = Disclosure::find($id);
        $disclosure->financial_year = $request->financial_year;
        $disclosure->audit_status = $request->audit_status;
        $disclosure->remarks = $request->remarks;
        $disclosure->save();
        return redirect()->route('admin.disclosure')->with('success','Record Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rc  $rc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $disclosure = Disclosure::find($id);
        $disclosure->delete();
        return redirect()->route('admin.disclosure')->with('success','Record Deleted Successfully !');
    }

    public function trash(){
        $active = 'disclosure';
        $disclosures = Disclosure::onlyTrashed()->orderBy('id','desc')->get();
        return view('backend.disclosure.trash',compact('active','disclosures'));
    }

    public function restore($id){
        $disclosure = Disclosure::withTrashed()->find($id);
        $disclosure->restore();
        return redirect()->route('admin.disclosure.trash')->with('success',"Record Restored Successfully!");
    }

    public function permanentDelete($id){
        $disclosure = Disclosure::withTrashed()->find($id);
        $disclosure->forceDelete();
        return redirect()->route('admin.disclosure.trash')->with('success',"Record Deleted Successfully!");
    }
}
