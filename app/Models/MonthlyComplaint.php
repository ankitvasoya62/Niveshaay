<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyComplaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'month',
        'year',
        'carried_forward',
        'received',
        'resolved',
        'pending'
    ];
}
