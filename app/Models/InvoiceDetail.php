<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceDetail extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'description',
        'amount',
        'subscription_start_date',
        'subscription_end_date',
        'subscription_form_id',
        'invoice_no',
        'fees_frequency',
        'amount_description',
        'service_type',
        'is_renew'
    ];

    public function subscriptionForm(){
        return $this->belongsTo(SubscriptionFormDetail::class,'subscription_form_id');
    }
}
