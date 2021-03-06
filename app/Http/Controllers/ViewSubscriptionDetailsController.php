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
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ViewSubscriptionDetailsController extends Controller
{
    //
    public function viewSubscriptionDetails(){
        $subscription_details = SubscriptionFormDetail::where('status','active')->orderBy('id','desc')->get();
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
        // $subscription_details->status = 'deleted';
        // $subscription_details->save();
        $subscription_details->delete();
        $invoices = InvoiceDetail::where('subscription_form_id',$id)->delete();
        return redirect()->back()->with('success','Subscribe User Deleted Successfully');        
    }

    public function editSubscriptionDetails($id){
        $subscription_details = SubscriptionFormDetail::find($id);
        $states = getStates();
        $active = 'subscription-details';
        if($subscription_details->subscription_type == 0){
            return view('backend.subscriptionDetails.editsubscriptionDetails',compact('active','subscription_details','states'));        
        }else{
            return view('backend.subscriptionDetails.editcompanysubscriptionDetails',compact('active','subscription_details','states'));        
        }
        
    }

    public function updateSubscriptionDetails(Request $request,$id){
        $subscriptionFormDetail = SubscriptionFormDetail::find($id);
        if($subscriptionFormDetail->subscription_type == 1){
            $subscriptionFormDetail->name_of_investor = $request->name_of_investor;
            $subscriptionFormDetail->email = $request->email;
            $subscriptionFormDetail->mobile_no = $request->mobile_no;
            $subscriptionFormDetail->pan_no = $request->pan_no;
            $subscriptionFormDetail->gst_no = $request->gst_no;
            $subscriptionFormDetail->state = $request->state;
            $subscriptionFormDetail->street_address = $request->street_address;
            $subscriptionFormDetail->is_demat_account= !empty($request->is_demat_account) ? $request->is_demat_account : 0;
            $subscriptionFormDetail->demat_account_no = $request->demat_account_no;
            $subscriptionFormDetail->number_of_years_since_registration = $request->number_of_years_since_registration;
            $subscriptionFormDetail->average_profit = $request->average_profit;
            $subscriptionFormDetail->date_of_incorporation = Carbon::parse($request->date_of_incorporation)->format('Y-m-d');
            $subscriptionFormDetail->legal_status = $request->legal_status;
            $subscriptionFormDetail->invest_net_worth = $request['invest_net_worth'];
            $subscriptionFormDetail->investment_period = $request['investment_period'];
            $subscriptionFormDetail->risk_attitude = $request['risk_attitude'];
            $subscriptionFormDetail->knowledge_experience = $request['knowledge_experience'];
            
            $subscriptionFormDetail->save();
        }else{
            $subscriptionFormDetail->name_of_investor = $request['name_of_investor'];
            $subscriptionFormDetail->dob = Carbon::parse($request['dob'])->format('Y-m-d');
            $subscriptionFormDetail->email = $request['email'];
            $subscriptionFormDetail->mobile_no = $request['mobile_no'];
            $subscriptionFormDetail->pan_no = $request['pan_no'];
            $subscriptionFormDetail->gst_no = $request['gst_no'];
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
        }
        
        return redirect()->route('admin.subscription-details')->with('success','Record Updated Successfully!');
    }

    
    public function verifySubscriptionDetails(Request $request){

        date_default_timezone_set('Asia/Kolkata');
        $id = !empty($request->subscription_form_id) ? $request->subscription_form_id : 0;
        $table_data = array();
        $amount_sum = 0;
        $max_date = array();
        $subscription_invoice_no = !empty($request->invoice_no) ? $request->invoice_no : ''; 
         // dd($request);
        foreach ($request->description as $key => $value) {
            # code...
            $data = array();
            $data['description'] = $value;
            $data['amount'] = $request->amount[$key];
            $data['amount_description'] = $request->amount_description[$key];
            $data['subscription_start_date'] = $request->subscription_start_date[$key];
            $data['subscription_end_date'] = $request->subscription_end_date[$key];
            $data['subscription_form_id'] = $id;
            $today= Carbon::now();
            $data['created_at'] = $today;
            $currentmonth = $today->month;
            $currentyear = $today->year;
            if(!empty($subscription_invoice_no)){
                $invoice_no = $subscription_invoice_no;
            }else{
                if($currentmonth < 4){
                    $invoice_no = "#NRS/".($currentyear-1)."-".($currentyear)."/".($id+100);
                }else{
                    $invoice_no = "#NRS/".$currentyear."-".($currentyear+1)."/".($id+100);
                }
            }
            if(!empty($request->fees_frequency)){
                $data['fees_frequency'] = $request->fees_frequency;
            }
            $data['agreement_date'] = $request->agreement_date;
            
            $data['invoice_no'] = $invoice_no;
            $insertdata = InvoiceDetail::insert($data);
            $max_date[] = $request->subscription_end_date[$key];
            array_push($table_data,$data);
            $amount_sum += $request->amount[$key];
        }
        $subscription_details = SubscriptionFormDetail::find($id);
        $toEmail = $subscription_details->email;
        $name = $subscription_details->name_of_investor;
        $data = array();
        $data['name'] = $name;
        if($subscription_details->subscription_type == 0){
            $average = riskProfile($subscription_details,$id);
        }else{
            $average = companyRiskProfile($subscription_details,$id);
        }
        // $average = riskProfile($subscription_details,$id);
        if($average >=1 && $average <4){
            $riskProfile = 'Low Risk';
        }elseif($average >=4 && $average <7){
            $riskProfile = 'Moderate';
            
        }   
        elseif($average >= 7 && $average <=10){
            $riskProfile = 'High Risk';
        }
        $invoices = InvoiceDetail::where('subscription_form_id',$id)->where('is_renew',0)->orderBy('id','desc')->first();
        $amount = $invoices->amount;
        $subscription_start_date = $invoices->subscription_start_date;
        $subscription_end_date = $invoices->subscription_end_date;
        $feesfrequency = !empty($invoices->fees_frequency) ? $invoices->fees_frequency : '6 Months';
        $subscription_data = array();
        $subscription_data['name_of_investor'] = $subscription_details->name_of_investor;
        $subscription_data['email'] = $subscription_details->email;
        $subscription_data['pan_no'] = $subscription_details->pan_no;
        $subscription_data['riskprofile'] = $riskProfile;
        $subscription_data['amount'] = $amount;
        $subscription_data['amount_description'] = $invoices->amount_description;
        $subscription_data['subscription_start_date'] = date('d F, Y',strtotime($subscription_start_date));
        $subscription_data['subscription_end_date'] = date('d F, Y',strtotime($subscription_end_date));
        $subscription_data['agreement_date'] = $invoices->agreement_date;
        $subscription_data['fees_frequency'] = $feesfrequency;
        // $subscription_data = !empty($subscription_details) ? $subscription_details : array();
        $subscriptionpdf = PDF::loadView('pdf.advisor-agreement', $subscription_data);
        if($subscription_details->subscription_type == 0){
            $riskprofilepdf = PDF::loadView('pdf.risk-profiling',$subscription_details);
        }else{
            $riskprofilepdf = PDF::loadView('pdf.companyrisk-profiling',$subscription_details);
        }
        
        try{
            Mail::send('frontend.mail.payment-details', $data, function($message)use($toEmail, $subscriptionpdf,$riskprofilepdf) {
                $message->to($toEmail, $toEmail)
                        ->bcc('research@niveshaay.com')
                        ->subject('Payment Details Mail')
                        ->attachData($subscriptionpdf->output(), "agreement.pdf")
                        ->attachData($riskprofilepdf->output(), "riskprofiling.pdf");
            });
            //Mail::to($toEmail)->send(new PaymentDetailsMail($name));
            $subscription_details->is_verified_by_admin =1;
            $subscription_details->save();
            return redirect()->route('admin.subscription-details')->with('success','Mail Sent Successfully!');
        }
        catch(\Throwable $th){
            //throw $th;
            return redirect()->back()->with('error','Something went wrong');
        }
        

    }

    public function paymentReceivedAction(Request $request,$id){
        date_default_timezone_set('Asia/Kolkata');
        $editinvoice = InvoiceDetail::where('subscription_form_id',$id)->where('is_renew',0)->orderBy('id','desc')->first();
        $editinvoice->invoice_date = $request->invoice_payment_date;
        $editinvoice->save();

        $data = array();
        
        $data["title"] = "Account Successfully Activated" ;
        // $data["body"] = "This is Demo";
        $subscription_details = SubscriptionFormDetail::find($id);
        $toEmail = $subscription_details->email;
        $data['name_of_investor'] = $subscription_details->name_of_investor;
        $data['pan_no'] = $subscription_details->pan_no;
        $data['state'] = $subscription_details->state;
        $data["email"] = $subscription_details->email;
        $data['gst_no'] = $subscription_details->gst_no;
        $today= Carbon::now();
        $currentmonth = $today->month;
        $currentyear = $today->year;
        
        
        $invoices = InvoiceDetail::where('subscription_form_id',$id)->where('is_renew',0)->orderBy('id','desc')->first();
        $invoice_no = $invoices->invoice_no;
        
        $table_data = array();
        $invoiceData = array();
        $invoiceData['description'] = $invoices->description;
        $invoiceData['amount'] = $invoices->amount;
        $invoiceData['subscription_start_date'] = $invoices->subscription_start_date;
        $invoiceData['subscription_end_date'] = $invoices->subscription_end_date;
        array_push($table_data,$invoiceData);
        $data['invoice_no'] = $invoice_no;
        $data['created_at'] = $invoices->invoice_date;
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
        Mail::send('backend.paymentReceivedMail', $data, function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->bcc('research@niveshaay.com')
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "invoice.pdf");
                    // ->attachData($subscriptionpdf->output(), "agreement.pdf");
        });
        // $pdf->output(public_path('invoicepdf/'.$id.'/invoice.pdf'),'F');
        $subscription_details['is_payment_received'] = 1;
        $subscription_details->save();

        // $subscription_details_user  = $subscription_details->user;
        // $subscription_details_user_end_date = $subscription_details_user->subscription_end_date;
        // $subscription_details_user_end_date = date('Y-m-d',strtotime($subscription_details_user_end_date));
        // $max_date[] = $subscription_details_user_end_date;
        // $max_subscription_end_date = max($max_date);

        // $user = User::find($subscription_details_user->id);
        // $user->subscription_end_date  = $max_subscription_end_date;
        // $user->save();


        
        //return redirect()->route('admin.subscription-details')->with('success','Payment Received! Mail Sent Successfully');
        $success = ['success'=>1];
        session()->flash('success','Payment Received! Mail Sent Successfully');
        return response()->json($success);
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
        $invoice = InvoiceDetail::latest()->where('subscription_form_id',$id)->where('is_renew',0)->orderBy('id','desc')->get();
        return response()->json($invoice);
        // // dd($invoice->subscriptionForm->user_id);
        // $active = 'subscription-details';
        // return view('backend.invoicedetails.edit',compact('invoice','active'));
    }

    public function updateinvoice(Request $request,$id){
        
        $invoices = InvoiceDetail::latest()->where('subscription_form_id',$id)->where('is_renew',0)->orderBy('id','desc')->get();

        foreach ($invoices as $key => $value) {
            # code...
            if($value->id == $request->invoice_id[$key] ){
                $invoice = InvoiceDetail::find($value->id);
                $invoice->description = $request->description[$key];
                $invoice->amount = $request->amount[$key];
                $invoice->amount_description = $request->amount_description[$key];
                $invoice->subscription_start_date = !empty($request->subscription_start_date[$key]) ? date('Y-m-d',strtotime($request->subscription_start_date[$key])) : NULL;
                $invoice->subscription_end_date = !empty($request->subscription_end_date[$key]) ? date('Y-m-d',strtotime($request->subscription_end_date[$key])) : NULL;
                if(!empty($request->invoice_no)){
                    $invoice->invoice_no = $request->invoice_no;
                }
                if(!empty($request->fees_frequency)){
                    $invoice->fees_frequency = $request->fees_frequency;
                }
                $invoice->agreement_date = $request->agreement_date;
                $invoice->invoice_date = $request->invoice_date;
                $user = User::find($invoice->subscriptionForm->user_id);
                if(!empty($user)){
                    $max_date = max($user->subscription_end_date,$invoice->subscription_end_date);
                    $user->subscription_end_date = $max_date;
                    $user->save();
                }
                
                // $invoice->subscription_end_date = !empty($max_date) ? $max_date : $invoice->subscription_end_date;
                
                $invoice->save();
            }
        }
        $success = ['success'=>1];
        session()->flash('success','Invoice updated successfully!');
        return response()->json($success);
    }

    public function generatePdf($id){
        $subscription_details = SubscriptionFormDetail::find($id);
        $toEmail = $subscription_details->email;
        $invoices = InvoiceDetail::where('subscription_form_id',$id)->where('is_renew',0)->orderBy('id','desc')->first();
        // dd($invoices);
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
        $data['created_at'] = $invoices->invoice_date;
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
        
    }

    public function agreementPdf($id){

        date_default_timezone_set('Asia/Kolkata');
        $subscription_details = SubscriptionFormDetail::find($id);
        if($subscription_details->subscription_type == 0){
            $average = riskProfile($subscription_details,$id);
        }else{
            $average = companyRiskProfile($subscription_details,$id);
        }
        
        if($average >=1 && $average <4){
            $riskProfile = 'Low Risk';
        }elseif($average >=4 && $average <7){
            $riskProfile = 'Moderate';
            
        }   
        elseif($average >= 7 && $average <=10){
            $riskProfile = 'High Risk';
        }
        $invoices = InvoiceDetail::latest()->where('subscription_form_id',$id)->where('is_renew',0)->orderBy('id','desc')->first();
        $amount = $invoices->amount;
        $subscription_start_date = $invoices->subscription_start_date;
        $subscription_end_date = $invoices->subscription_end_date;
        $feesfrequency = !empty($invoices->fees_frequency) ? $invoices->fees_frequency : '6 Months';
        $created_at = $invoices->created_at;
        $subscription_data = array();
        $subscription_data = $subscription_details;
        $subscription_data['riskprofile'] = $riskProfile;
        $subscription_data['amount'] = $amount;
        $subscription_data['amount_description'] = $invoices->amount_description;
        $subscription_data['subscription_start_date'] = date('d F, Y',strtotime($subscription_start_date));
        $subscription_data['subscription_end_date'] = date('d F, Y',strtotime($subscription_end_date));
        $subscription_data['fees_frequency'] = $feesfrequency;
        $subscription_data['agreement_date'] = $invoices->agreement_date;
        $pdf = PDF::loadView('pdf.advisor-agreement', $subscription_data);
        return $pdf->download('agreement.pdf');
                                    
                                
                                    
                                
    }

    public function riskProfilePdf($id){
        $subscription_details = SubscriptionFormDetail::find($id);
        if($subscription_details->subscription_type == 0){
            $pdf = PDF::loadView('pdf.risk-profiling',$subscription_details);
        }else{
            $pdf = PDF::loadView('pdf.companyrisk-profiling',$subscription_details);
        }
        
        return $pdf->download('riskprofiling.pdf');

    }

    public function trash(){
        $subscription_details = SubscriptionFormDetail::onlyTrashed()->orderBy('id','desc')->get();
        $active = 'subscription-details';
        return view('backend.subscriptionDetails.trash',compact('active','subscription_details'));
    }

    public function restore($id){
        $subscription_details = SubscriptionFormDetail::withTrashed()->find($id);
        $subscription_details->restore();
        $invoices = InvoiceDetail::where('subscription_form_id',$id)->restore();
        
        return redirect()->route('admin.subscription-detail.trash')->with('success',"Record restored Successfully!");
    }

    public function permanentDelete($id){
        $subscription_details = SubscriptionFormDetail::withTrashed()->find($id);
        $subscription_details->forceDelete();
        $invoices = InvoiceDetail::where('subscription_form_id',$id);
        $invoices->forceDelete();
        return redirect()->route('admin.subscription-detail.trash')->with('success',"Record deleted Successfully!");
    }
}
