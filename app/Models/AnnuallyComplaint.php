<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnuallyComplaint extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'year',
        'carried_forward',
        'received',
        'resolved',
        'pending'
    ];
}
