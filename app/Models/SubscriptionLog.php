<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'subscription_start_date',
        'subscription_end_date',
        'amount',
        'user_id'
    ];
}
