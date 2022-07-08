<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disclosure extends Model
{
    use HasFactory;
    protected $fillable = [
        'financial_year',
        'audit_status',
        'remarks'
    ];
}
