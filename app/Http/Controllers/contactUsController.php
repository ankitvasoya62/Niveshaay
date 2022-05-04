<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;

class contactUsController extends Controller
{
    //
    public function contactUsList(){
        $contactus_list = Contactus::orderBy('id','desc')->get();
        $active = 'contact';
        return view('backend.contactUs.listcontacts',compact('active','contactus_list'));
    }

    public function showContact($id){
        $contact = Contactus::find($id);
        return response()->json($contact);
    }

    public function deleteContact($id){
        $contact = Contactus::find($id);
        $contact->delete();
        return redirect()->back()->with('success','Record deleted Successfully!');
    }
}
