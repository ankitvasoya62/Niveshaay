<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\ContactUs;

class ContactusExport implements FromCollection,WithHeadings,WithMapping
{
    private $rows = 0;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        $contactus_list = Contactus::orderBy('id','desc')->get();
        return $contactus_list;
    }

    public function map($contact) : array {
        ++$this->rows;
        return [
            $this->rows,
            date("d-m-Y", strtotime($contact->created_at))  ,
             $contact->first_name,
             $contact->last_name,
             $contact->email,
             $contact->message,
             $contact->phone_no,
             
             

                ] ;
 
 
    }

    public function headings() : array {
        return [
            'SR No',
            'Date',
            'First Name',
            'Last Name',
            'Email',
            'Message',
            'Phone no.',
            
        ] ;
    }
}
