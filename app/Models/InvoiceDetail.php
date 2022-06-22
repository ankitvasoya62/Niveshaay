<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'amount',
        'subscription_start_date',
        'subscription_end_date',
        'subscription_form_id',
        'invoice_no',
        'fees_frequency',
        'amount_description',
        'service_type'
    ];

    public function subscriptionForm(){
        return $this->belongsTo(SubscriptionFormDetail::class,'subscription_form_id');
    }
}
