<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentMonthComplaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'received_from',
        'month',
        'year',
        'pending_last_month',
        'received',
        'resolved',
        'total_pending',
        'pending_3m',
        'avg_resolution_time'
    ];
}
