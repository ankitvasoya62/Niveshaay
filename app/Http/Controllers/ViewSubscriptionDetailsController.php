<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubscriptionFormDetail;
use App\Exports\SubscriptionDetails;
use App\Exports\InvoiceDetails;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Mail;
use App\Mail\PaymentDetailsMail;
use PDF;
use App\Models\InvoiceDetail;
use App\Models\SubscriptionLog;

class ViewSubscriptionDetailsController extends Controller
{
    //
    public function viewSubscriptionDetails(){
        $subscription_details = SubscriptionFormDetail::all()->where('status','active');
        $active = 'subscription-details';
        return view('backend.subscriptionDetails.subscriptionDetails',compact('active','subscription_details'));
    }

    public function downloadExcel(){
        return Excel::download(new SubscriptionDetails, 'subscription_details.xlsx');
    
    }

    public function showDetails($id){
        $subscription_details = SubscriptionFormDetail::find($id);
        $active = 'subscription-details';
        return view('backend.subscriptionDetails.viewsubscriptionDetails',compact('active','subscription_details'));
    }

    public function deleteSubscriptionDetails($id){
        $subscription_details = SubscriptionFormDetail::find($id);
        $subscription_details->status = 'deleted';
        $subscription_details->save();
        return redirect()->back();        
    }

    public function editSubscriptionDetails($id){
        $subscription_details = SubscriptionFormDetail::find($id);
        $states = [
        'AP' => 'Andhra Pradesh',
        'AR' => 'Arunachal Pradesh',
        'AS' => 'Assam',
        'BR' => 'Bihar',
        'CT' => 'Chhattisgarh',
        'GA' => 'Goa',
        'GJ' => 'Gujarat',
        'HR' => 'Haryana',
        'HP' => 'Himachal Pradesh',
        'JK' => 'Jammu and Kashmir',
        'JH' => 'Jharkhand',
        'KA' => 'Karnataka',
        'KL' => 'Kerala',
        'MP' => 'Madhya Pradesh',
        'MH' => 'Maharashtra',
        'MN' => 'Manipur',
        'ML' => 'Meghalaya',
        'MZ' => 'Mizoram',
        'NL' => 'Nagaland',
        'OR' => 'Odisha',
        'PB' => 'Punjab',
        'RJ' => 'Rajasthan',
        'SK' => 'Sikkim',
        'TN' => 'Tamil Nadu',
        'TG' => 'Telangana',
        'TR' => 'Tripura',
        'UP' => 'Uttar Pradesh',
        'UT' => 'Uttarakhand',
        'WB' => 'West Bengal',
        'AN' => 'Andaman and Nicobar Islands',
        'CH' => 'Chandigarh',
        'DN' => 'Dadra and Nagar Haveli',
        'DD' => 'Daman and Diu',
        'LD' => 'Lakshadweep',
        'DL' => 'National Capital Territory of Delhi',
        'PY' => 'Puducherry'
        ];
        $active = 'subscription-details';
        return view('backend.subscriptionDetails.editsubscriptionDetails',compact('active','subscription_details','states'));        
    }

    public function updateSubscriptionDetails(Request $request,$id){
        $subscriptionFormDetail = SubscriptionFormDetail::find($id);
        $subscriptionFormDetail->name_of_investor = $request['name_of_investor'];
        $subscriptionFormDetail->dob = Carbon::parse($request['dob'])->format('Y-m-d');
        $subscriptionFormDetail->email = $request['email'];
        $subscriptionFormDetail->mobile_no = $request['mobile_no'];
        $subscriptionFormDetail->pan_no = $request['pan_no'];
        $subscriptionFormDetail->pin_code = $request['pin_code'];
        $subscriptionFormDetail->street_address = $request['street_address'];
        $subscriptionFormDetail->state = $request['state'];
        $subscriptionFormDetail->age = $request['age'];
        $subscriptionFormDetail->source_of_income = implode(",",$request['source_of_income']);
        $subscriptionFormDetail->currently_hold_investments = implode(",",$request['currently_hold_investments']);
        $subscriptionFormDetail->annual_income = $request['annual_income'];
        $subscriptionFormDetail->repayment_of_existing_liabilities = $request['repayment_of_existing_liabilities'];
        $subscriptionFormDetail->invest_net_worth = $request['invest_net_worth'];
        $subscriptionFormDetail->investment_period = $request['investment_period'];
        $subscriptionFormDetail->invest_objective = $request['invest_objective'];
        $subscriptionFormDetail->invest_average_return = $request['invest_average_return'];
        $subscriptionFormDetail->risk_attitude = $request['risk_attitude'];
        $subscriptionFormDetail->knowledge_experience = $request['knowledge_experience'];
        $subscriptionFormDetail->save();
        return redirect()->route('admin.subscription-details')->with('success','Record Updated Successfully');;
    }
    public function verifySubscriptionDetails($id){
        $subscription_details = SubscriptionFormDetail::find($id);
        $toEmail = $subscription_details->email;
        $name = $subscription_details->name_of_investor;
        try{
            Mail::to($toEmail)->send(new PaymentDetailsMail($name));
        }
        catch(\Throwable $th){
            //throw $th;
        }
        $subscription_details->is_verified_by_admin =1;
        $subscription_details->save();
        return redirect()->route('admin.subscription-details')->with('success','Mail Sent Successfully');;

    }

    public function paymentReceivedAction(Request $request){

        $id = !empty($request->subscription_form_id) ? $request->subscription_form_id : 0;
        $table_data = array();
        $amount_sum = 0;
        $max_date = array();
        // dd($request);
        foreach ($request->description as $key => $value) {
            # code...
            $data = array();
            $data['description'] = $value;
            $data['amount'] = $request->amount[$key];
            $data['subscription_start_date'] = $request->subscription_start_date[$key];
            $data['subscription_end_date'] = $request->subscription_end_date[$key];
            $data['subscription_form_id'] = $id;
            
            $insertdata = InvoiceDetail::insert($data);
            $max_date[] = $request->subscription_end_date[$key];
            array_push($table_data,$data);
            $amount_sum += $request->amount[$key];
        }

        $data = array();
        
        $data["title"] = "Account Successfully Activated" ;
        // $data["body"] = "This is Demo";
        $subscription_details = SubscriptionFormDetail::find($id);
        $toEmail = $subscription_details->email;
        $data['name_of_investor'] = $subscription_details->name_of_investor;
        $data['pan_no'] = $subscription_details->pan_no;
        $data['state'] = $subscription_details->state;
        $data["email"] = $subscription_details->email;
        $today= Carbon::now();
        $currentmonth = $today->month;
        $currentyear = $today->year;
        if($currentmonth < 4){
            $invoice_no = "#NIV/".($currentyear-1)."-".($currentyear)."/".($id+100);
        }else{
            $invoice_no = "#NIV/".$currentyear."-".($currentyear+1)."/".($id+100);
        }
        $data['invoice_no'] = $invoice_no;
        $amount = $amount_sum;
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
        
        // dd($data);
        $pdf = PDF::loadView('pdf.document', $data);
        Mail::send('backend.paymentReceivedMail', $data, function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "invoice.pdf");
        });
        
        $subscription_details['is_payment_received'] = 1;
        $subscription_details->save();

        $subscription_details_user  = $subscription_details->user->subscription_end_date;
          

        
        return redirect()->route('admin.subscription-details')->with('success','Payment Received! Mail Sent Successfully');
    }

    public function viewinvoicedetails($id){
        $invoice_details = InvoiceDetail::where('subscription_form_id',$id)->get();
        $active = 'subscription-details';
        return view('backend.invoicedetails.view',compact('active','invoice_details'));
                                        
    }

    // public function editinvoicedetails($id){
    //     $invoice_details = InvoiceDetail::where('subscription_form_id',$id)->get();
    //     $active = 'subscription-details';
    //     return view('backend.invoicedetails.view',compact('active','invoice_details'));
    // }

    public function downloadinvoice($id){
        return Excel::download(new InvoiceDetails($id), 'invoice_details.xlsx');
    }

    public function editinvoice($id){
        $invoice = InvoiceDetail::find($id);
        // dd($invoice->subscriptionForm->user_id);
        $active = 'subscription-details';
        return view('backend.invoicedetails.edit',compact('invoice','active'));
    }

    public function updateinvoice(Request $request,$id){
        $validatedata = $request->validate([

    		'name' => 'description',
    		
            'amount' => 'required',
            
            'subscription_start_date' => 'required|date|date_format:Y-m-d',
            'subscription_end_date' => 'required|date|date_format:Y-m-d|after:subscription_start_date'

    	]);
        $invoice = InvoiceDetail::find($id);
        $invoice->description = $request->description;
        $invoice->amount = $request->amount;
        $invoice->subscription_start_date = !empty($request->subscription_start_date) ? date('Y-m-d',strtotime($request->subscription_start_date)) : "";
        $invoice->subscription_end_date = !empty($request->subscription_end_date) ? date('Y-m-d',strtotime($request->subscription_end_date)) : "";
        $invoice->save();
        $subscriptionlog = new SubscriptionLog([
            'title'=> $request->description,
            'subscription_start_date' => !empty($request->subscription_start_date) ? date('Y-m-d',strtotime($request->subscription_start_date)) : "",
            'subscription_end_date' => !empty($request->subscription_end_date) ? date('Y-m-d',strtotime($request->subscription_end_date)) : "",
            'amount'=>$request->amount,
            'user_id'=> $invoice->subscriptionForm->user_id
        ]);
        return back()->with('success','invoice updated successfully');
    }
}
