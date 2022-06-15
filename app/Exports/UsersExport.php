<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\SubscriptionFormDetail;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection,WithHeadings,WithMapping
{
    private $rows = 0;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        $users = User::select(

            "users.*",
            "subscription_form_details.id AS s_id",
            "subscription_form_details.is_verified_by_admin",
            "subscription_form_details.is_payment_received",
            "subscription_form_details.is_email_verified"

        )

        ->leftJoin("subscription_form_details", "subscription_form_details.user_id", "=", "users.id")
        ->where('is_admin',0)
        ->whereNull('subscription_form_details.deleted_at')
        
        ->orderBy('users.id','desc')
        ->get();
        return $users;
    }

    public function map($user) : array {
        ++$this->rows;
        $status = '';
        if(empty($user->s_id)){
            $status = "Signup";
        }   
        else{
            if($user->is_payment_received == 1){
                $status ="Portal access";
            }   
            elseif($user->is_email_verified == 1){
                $status = "OTP Verified";
            }
            else{
                $status = "Form Filled";
            }
                
        }
            
            
        
            
        
        return [
            $this->rows,
             date('d-m-Y',strtotime($user->created_at)) ,
             $user->name,
             $user->email,
             $user->phone_no,
             $user->dob,
             $user->amount,
             $user->pan,
             
             !empty($user->subscription_start_date) ? date("d-m-Y", strtotime($user->subscription_start_date)) : "",
             !empty($user->subscription_start_date) ? date("d-m-Y", strtotime($user->subscription_start_date)) : "",
             $status

                ] ;
 
 
    }

    public function headings() : array {
        return [
            'SR No',
            'Date',
            'Name',
            'Email',
            'Phone No.',
            'Amount',
            'D.O.B',
            'PAN',
            'Subscription Start Date',
            'Subscription End Date',
            'Status'
        ] ;
    }
}
