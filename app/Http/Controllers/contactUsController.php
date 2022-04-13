<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;

class contactUsController extends Controller
{
    //
    public function contactUsList(){
        $contactus_list = Contactus::all();
        $active = 'contact';
        return view('backend.contactUs.listcontacts',compact('active','contactus_list'));
    }

    public function showContact($id){
        $contact = Contactus::find($id);
        return response()->json($contact);
    }
}
