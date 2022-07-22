<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disclosure extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'financial_year',
        'audit_status',
        'remarks'
    ];
}
