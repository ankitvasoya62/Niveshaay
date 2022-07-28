<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Str;
use Mail;
use App\Mail\passwordMail;
use App\Models\SubscriptionLog;
use App\Models\SubscriptionFormDetail;
use App\Models\InvoiceDetail;
use Carbon\Carbon;


class UsersImport implements ToModel,WithHeadingRow,WithValidation,SkipsOnFailure
{
    use SkipsFailures;
    private $rows = 0;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        ++$this->rows;
        //dd($row);
        // Validator::make($row, [
        //     'name' => 'required',
        //     'email' => 'required',
        //     'phone_number'=>'required',
        //     'pan'=>'required',
        //     'dob'=>'required',
        //     'smallcase_name'=>'required',
        //     'subscription_status'=>'required',
        //     'subscription_start_date' => 'required',
        //     'subscription_end_date'=>'required',
        //     'subscription_plan' => 'required',
        //     'amount'=>'required',
        //     'broker'=>'required',
        // ])->validate();
        // $user=User::where('email',$row['email'])->count();
        // if (!$user) {
        //     # code...
        // }
        $user_existed =User::where('email',$row['email'])->count();
        
        if ($user_existed != 0) {
            # code...
            $user = User::where('email',$row['email'])->first();
            if($user->is_admin == 1){
                --$this->rows;
            }else{
                $subscription_end_date = date('Y-m-d',strtotime($user->subscription_end_date));
                $excel_end_date = date('Y-m-d',strtotime($row['service_end_date']));
                $max_date = max($subscription_end_date,$excel_end_date );
                $user->name = $row['name'];
                $user->email = $row['email'];
                $user->phone_no = $row['contact_number'];
                $user->pan = $row['pan_no'];
                $user->dob = $row['dob'];
                // $user->smallcase_name = $row['smallcase_name'];
                // $user->subscription_status = $row['subscription_status']=='SUBSCRIBED' ? 1:0;
                $user->subscription_start_date = date('Y-m-d',strtotime($row['service_start_date']));
                $user->subscription_end_date  = $max_date;
                // $user->subscription_plan  = $row['subscription_plan'];
                $user->amount  = $row['amount'];
                // $user->broker = $row['broker']; 
                $user->save();
                $updateduser = $user->fresh();
                // $subscriptionlog = new SubscriptionLog([
                //     'title'=> $row['service_name'],
                //     'subscription_start_date' => date('Y-m-d',strtotime($row['subscription_start_date'])),
                //     'subscription_end_date' => $max_date,
                //     'amount'=>$row['amount'],
                //     'user_id'=>$user->id
                // ]);
                // $subscriptionlog->save();
                return $updateduser;
            }
            
        }else{
            $random_password = Str::random(8);
            $user = new User([
                'name'=> $row['name'],
                'email'=> $row['email'],
                'password'=>\Hash::make($random_password),
                'phone_no'=>$row['contact_number'],
                'pan'=>$row['pan_no'],
                'dob'=>date("Y-m-d", strtotime($row['dob'])),
                // 'smallcase_name'=>$row['smallcase_name'],
                // 'subscription_status'=>$row['subscription_status']=='SUBSCRIBED' ? 1:0,
                'subscription_start_date'=>!empty($row['service_start_date']) ? date("Y-m-d", strtotime($row['service_start_date'])) : '',
                'subscription_end_date'=>!empty($row['service_end_date']) ? date("Y-m-d", strtotime($row['service_end_date'])) : '',
                // 'subscription_plan'=>$row['subscription_plan'],
                'is_admin'=>0,
                'amount'=>$row['amount'],
                // 'broker'=>$row['broker'],
            ]);
            $user->save();
            $toEmail = $row['email'];
            try{
                Mail::to($toEmail)->send(new passwordMail($random_password,$row['name']));
            }
            catch(\Throwable $th){
                
            }
            // $subscriptionlog = new SubscriptionLog([
            //     'title'=> $row['smallcase_name'],
            //     'subscription_start_date' => date('Y-m-d',strtotime($row['service_start_date'])),
            //     'subscription_end_date' => date('Y-m-d',strtotime($row['service_end_date'])),
            //     'amount'=>$row['amount'],
            //     'user_id'=>$user->id
            // ]);
            // $subscriptionlog->save();
            $subscriptionFormDetails = new SubscriptionFormDetail([
                'name_of_investor'=>$row['name'],
                'email'=>$row['email'],
                'mobile_no'=>$row['contact_number'],
                'pan_no'=>$row['pan_no'],
                'gst_no'=>$row['gst_no'],
                'dob'=>date("Y-m-d", strtotime($row['dob'])),
                'street_address'=>$row['street_address'],
                'state'=>!empty($row['state']) ? $row['state'] : '',
                'user_id'=>$user->id,
                'is_email_verified'=>1,
                'is_verified_by_admin'=>1,
                'is_payment_received'=>1
            ]);
            $subscriptionFormDetails->save();
            $today= Carbon::now();
            $currentmonth = $today->month;
            $currentyear = $today->year;
            if($currentmonth < 4){
                $invoice_no = "#NRS/".($currentyear-1)."-".($currentyear)."/".($subscriptionFormDetails->id+100);
            }else{
                $invoice_no = "#NRS/".$currentyear."-".($currentyear+1)."/".($subscriptionFormDetails->id+100);
            }
            $invoiceDetails = new InvoiceDetail([
                'description'=>$row['service_name'],
                'subscription_start_date'=>date("Y-m-d", strtotime($row['service_start_date'])),
                'subscription_end_date'=>date("Y-m-d", strtotime($row['service_end_date'])),
                'amount'=>$row['amount'],
                'invoice_no'=>$invoice_no,
                'subscription_form_id'=>$subscriptionFormDetails->id
            ]);
            $invoiceDetails->save();
            return $user;
        }
        
    }
    // public function onError(\Throwable $error){

    // }
     public function rules(): array
     {
         return [
             '*.name'=>['required'],
             '*.email'=>['email'],
             '*.dob'=>['date'],
             
             '*.contact_number'=>['digits:10'],
             '*.pan_no'=>['max:10','min:10']
         ];
     }
    //  public function onFailure(Failure ...$failure)
    //  {

    //  }
    public function getRowCount(): int
    {
        return $this->rows;
    }
}
