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
        $invoices = InvoiceDetail::where('is_renew',1)->orderBy('id','desc')->get();
        return view('backend.invoice.index',compact('active','invoices'));
    }

    public function add(){
        $active = 'invoice';
        return view('backend.invoice.add',compact('active'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'user_id'=>'required',
            
        ],[
            'user_id.required'=>'Please select a user'
        ]);
        $userid = $request->user_id;
        $subscriptionRecord = SubscriptionFormDetail::where('user_id',$userid)->orderBy('id','desc')->first();
        if(empty($subscriptionRecord)){
            $user = User::find($userid);
            $subscriptionRecord = new SubscriptionFormDetail([
                'name_of_investor'=>$user->name,
                'email'=>!empty($request->email) ? $request->email :$user->email,
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
            $subscriptionRecord->email = $request->email;
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
        $invoice->is_renew = 1;
        $newInvoice = $invoice->save();
        
        if(!empty($newInvoice)){
            $user = User::find($userid);
            $user->subscription_start_date = $request->subscription_start_date;
            $user->subscription_end_date = $request->subscription_end_date;
            $user->save();
        }
        
        // $user = User::find($userid);
        // $user->subscription_start_date = $request->subscription_start_date;
        if(!empty($newInvoice) && isset($request->service_type) && $request->service_type == 0  ){
            $toEmail = $subscriptionRecord->email;
            $data = array();
            $data = array();
        
            $data["title"] = "Invoice" ;
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
        $subscriptionRecord->email = $request->email;
        $subscriptionRecord->gst_no = $request->gst_no;
        $subscriptionRecord->street_address = $request->street_address;
        $subscriptionRecord->state = $request->state;
        $subscriptionRecord->save();
        
        $invoice->description = $request->description;
        $invoice->subscription_start_date = $request->subscription_start_date;
        $invoice->subscription_end_date = $request->subscription_end_date;
        $invoice->amount = $request->amount;
        $invoice->save();

        $userid = $invoice->subscriptionForm->user_id;
        $user = User::find($userid);
        $user->subscription_start_date = $request->subscription_start_date;
        $user->subscription_end_date = $request->subscription_end_date;
        $user->save();

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

    public function downloadInvoiceById($id){
        $invoices = InvoiceDetail::find($id);
        $subscription_details = $invoices->subscriptionForm;
        if(!empty($invoices) && !empty($subscription_details)){
            $table_data = [];
            $inoice = array();
            $invoice['description'] = $invoices->description;
            $invoice['amount'] = !empty($invoices->amount) ? $invoices->amount : 0 ;
            $invoice['subscription_start_date'] = $invoices->subscription_start_date;
            $invoice['subscription_end_date'] = $invoices->subscription_end_date;
            // $invoice['amount'] = $invoices->amount;
            $invoice['invoice_no'] = $invoices->invoice_no;
            array_push($table_data,$invoice);
            $data['name_of_investor'] = $subscription_details->name_of_investor;
            $data['pan_no'] = $subscription_details->pan_no;
            $data['state'] = $subscription_details->state;
            $data["email"] = $subscription_details->email;
            $data['gst_no'] = $subscription_details->gst_no;
            
            $data['invoice_no'] = $invoices->invoice_no;
            $amount = !empty($invoices->amount) ? $invoices->amount : 0 ;
            if($subscription_details->state == 'Gujarat'){
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
            return $pdf->download('invoice.pdf');
        }else{
            return redirect()->back()->with('error','Sorry, Record not found');
        }
        
    }
}
