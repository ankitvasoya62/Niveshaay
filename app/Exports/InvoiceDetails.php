<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\InvoiceDetail;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoiceDetails implements FromCollection,WithHeadings
{
    public $subscription_form_id;
    
    public function __construct($id){
        $this->subscription_form_id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        $invoice_details = InvoiceDetail::select('description','subscription_start_date','subscription_end_date','amount')
                                        ->where('subscription_form_id',$this->subscription_form_id)
                                        ->get();
        return $invoice_details;
    }

    public function headings() : array {
        return [
            'description',
            'subscription_start_date',
            'subscription_end_date',
            'amount'
        ] ;
    }
}
