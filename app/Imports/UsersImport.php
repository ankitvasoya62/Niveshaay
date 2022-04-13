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
            $subscription_end_date = date('Y-m-d',strtotime($user->subscription_end_date));
            $excel_end_date = date('Y-m-d',strtotime($row['subscription_end_date']));
            $max_date = max($subscription_end_date,$excel_end_date );
            $user->name = $row['name'];
            $user->email = $row['email'];
            $user->phone_no = $row['phone_number'];
            $user->pan = $row['pan'];
            $user->dob = $row['dob'];
            $user->smallcase_name = $row['smallcase_name'];
            $user->subscription_status = $row['subscription_status']=='SUBSCRIBED' ? 1:0;
            $user->subscription_start_date = date('Y-m-d',strtotime($row['subscription_start_date']));
            $user->subscription_end_date  = $max_date;
            $user->subscription_plan  = $row['subscription_plan'];
            $user->amount  = $row['amount'];
            $user->broker = $row['broker']; 
            $user->save();
            $updateduser = $user->fresh();
            $subscriptionlog = new SubscriptionLog([
                'title'=> $row['smallcase_name'],
                'subscription_start_date' => date('Y-m-d',strtotime($row['subscription_start_date'])),
                'subscription_end_date' => $max_date,
                'amount'=>$row['amount'],
                'user_id'=>$user->id
            ]);
            return $updateduser;
        }else{
            $random_password = Str::random(8);
            $user = new User([
                'name'=> $row['name'],
                'email'=> $row['email'],
                'password'=>\Hash::make($random_password),
                'phone_no'=>$row['phone_number'],
                'pan'=>$row['pan'],
                'dob'=>date("Y-m-d", strtotime($row['dob'])),
                'smallcase_name'=>$row['smallcase_name'],
                'subscription_status'=>$row['subscription_status']=='SUBSCRIBED' ? 1:0,
                'subscription_start_date'=>date("Y-m-d", strtotime($row['subscription_start_date'])),
                'subscription_end_date'=>date("Y-m-d", strtotime($row['subscription_end_date'])),
                'subscription_plan'=>$row['subscription_plan'],
                'is_admin'=>0,
                'amount'=>$row['amount'],
                'broker'=>$row['broker'],
            ]);
            $toEmail = $row['email'];
            try{
                Mail::to($toEmail)->send(new passwordMail($random_password));
            }
            catch(\Throwable $th){
                
            }
            $subscriptionlog = new SubscriptionLog([
                'title'=> $row['smallcase_name'],
                'subscription_start_date' => date('Y-m-d',strtotime($row['subscription_start_date'])),
                'subscription_end_date' => date('Y-m-d',strtotime($row['subscription_end_date'])),
                'amount'=>$row['amount'],
                'user_id'=>$user->id
            ]);
            return $user;
        }
        // return new User([
        //     'name'=> $row['name'],
        //     'email'=> $row['email'],
        //     'password'=>\Hash::make('12345678'),
        //     'phone_no'=>$row['phone_number'],
        //     'pan'=>$row['pan'],
        //     'dob'=>$row['dob'],
        //     'smallcase_name'=>$row['smallcase_name'],
        //     'subscription_status'=>$row['subscription_status']=='SUBSCRIBED' ? 1:0,
        //     'subscription_start_date'=>$row['subscription_start_date'],
        //     'subscription_end_date'=>$row['subscription_end_date'],
        //     'subscription_plan'=>$row['subscription_plan'],
        //     'amount'=>$row['amount'],
        //     'broker'=>$row['broker'],
        // ]);
    }
    // public function onError(\Throwable $error){

    // }
     public function rules(): array
     {
         return [
             '*.email'=>['email'],
             '*.dob'=>['date'],
             '*.subscription_start_date'=>['date'],
             '*.subscription_end_date'=>['date','after:subscription_start_date'],
             '*.phone_no'=>['digits:10'],
             '*.pan'=>['max:10','min:10']
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
