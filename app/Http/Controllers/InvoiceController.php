<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceDetail;
use App\Models\SubscriptionFormDetail;
use App\Models\User;
use Mail;
use PDF;

class InvoiceController extends Controller
{
    //
    public function index(){
        $active = 'invoice';
        $invoices = InvoiceDetail::orderBy('id','desc')->get();
        return view('backend.invoice.index',compact('active','invoices'));
    }

    public function add(){
        $active = 'invoice';
        return view('backend.invoice.add',compact('active'));
    }

    public function store(Request $request){

        $userid = $request->user_id;
        $subscriptionRecord = SubscriptionFormDetail::where('user_id',$userid)->orderBy('id','desc')->first();
        if(empty($subscriptionRecord)){
            $user = User::find($userid);
            $subscriptionRecord = new SubscriptionFormDetail([
                'name_of_investor'=>$user->name,
                'email'=>$user->email,
                'mobile_no'=>$user->phone_no,
                'pan_no'=>$request->pan_no,
                'gst_no'=>$request->gst_no,
                'state'=>$request->state,
                'street_address'=>$request->street_address,
                'user_id'=>$user->id,
                'is_email_verified'=>1,
                'is_verified_by_admin'=>1,
                'is_payment_received'=>1
            ]);
            $subscriptionRecord->save();
            
        }else{
            $subscriptionRecord->pan_no = $request->pan_no;
            $subscriptionRecord->gst_no = $request->gst_no;
            $subscriptionRecord->state = $request->state;
            $subscriptionRecord->street_address = $request->street_address;
            $subscriptionRecord->save();
        }
        $invoice = new InvoiceDetail;
        $invoice->service_type = $request->service_type;
        $invoice->invoice_no = $request->invoice_no;
        $invoice->description = $request->description;
        $invoice->subscription_start_date = $request->subscription_start_date;
        $invoice->subscription_end_date = $request->subscription_end_date;
        $invoice->amount = $request->amount;
        $invoice->subscription_form_id = $subscriptionRecord->id;
        $newInvoice = $invoice->save();
        
        if(!empty($newInvoice) && isset($request->service_type) && $request->service_type == 0  ){
            $toEmail = $subscriptionRecord->email;
            $data = array();
            $data = array();
        
            $data["title"] = "Invoice Mail" ;
            $data['name_of_investor'] = $subscriptionRecord->name_of_investor;
            $data['pan_no'] = $subscriptionRecord->pan_no;
            $data['state'] = $subscriptionRecord->state;
            $data["email"] = $subscriptionRecord->email;
            $data['gst_no'] = $subscriptionRecord->gst_no;
            $invoices = InvoiceDetail::find($invoice->id);
            $table_data = array();
            $invoiceData = array();
            $invoiceData['description'] = $invoices->description;
            $invoiceData['amount'] = $invoices->amount;
            $invoiceData['subscription_start_date'] = $invoices->subscription_start_date;
            $invoiceData['subscription_end_date'] = $invoices->subscription_end_date;
            array_push($table_data,$invoiceData);
            $data['invoice_no'] = $invoices->invoice_no;
            $amount = !empty($invoices->amount) ? $invoices->amount : 0 ;
            if($subscriptionRecord->state == 'Gujarat'){
                $cgst = $amount * 0.09;
                $sgst = $amount * 0.09;
                $total = $amount + $cgst + $sgst;
                $data['amount'] = $amount;
                $data['cgst'] = $cgst;
                $data['sgst'] = $sgst;
                $data['total'] = $total;
                
            }else{
                $igst = $amount * 0.18;
                $total = $amount + $igst;
                $data['amount'] = $amount;
                $data['igst'] = $igst;
                $data['total'] = $total;
            }
            
            
            $data['table_data'] = $table_data;
            $pdf = PDF::loadView('pdf.document', $data);
            Mail::send('backend.invoiceMail', $data, function($message)use($data, $pdf) {
                $message->to($data["email"], $data["email"])
                        ->bcc('research@niveshaay.com')
                        ->subject($data["title"])
                        ->attachData($pdf->output(), "invoice.pdf");
                        // ->attachData($subscriptionpdf->output(), "agreement.pdf");
            });
        }

        return redirect()->route('admin.invoice')->with('success',"Record Added Successfully");
        
    }

    public function edit($id){
        $active = 'invoice';
        $invoice = InvoiceDetail::find($id);
        return view('backend.invoice.edit',compact('active','invoice'));
    }
    
    public function update(Request $request,$id){
        // $id = $request->user_id;
        $invoice = InvoiceDetail::find($id);
        $subscription_id = $invoice->subscriptionForm->id;

        $subscriptionRecord = SubscriptionFormDetail::find($subscription_id);
        $subscriptionRecord->pan_no = $request->pan_no;
        $subscriptionRecord->gst_no = $request->gst_no;
        $subscriptionRecord->street_address = $request->street_address;
        $subscriptionRecord->state = $request->state;
        $subscriptionRecord->save();
        
        $invoice->description = $request->description;
        $invoice->subscription_start_date = $request->subscription_start_date;
        $invoice->subscription_end_date = $request->subscription_end_date;
        $invoice->amount = $request->amount;
        $invoice->save();
        return redirect()->route('admin.invoice')->with('success',"Record Updated Successfully");
    }

    public function delete($id){
        $invoice = InvoiceDetail::find($id);
        $invoice->delete();
        return redirect()->route('admin.invoice')->with('success',"Record Deleted Successfully");
    }

    public function userSubscriptionRecord($userid){
        $subscriptionRecord = SubscriptionFormDetail::where('user_id',$userid)->orderBy('id','desc')->first();
        return response()->json($subscriptionRecord);        
    }
}
