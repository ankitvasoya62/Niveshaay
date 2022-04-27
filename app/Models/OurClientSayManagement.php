<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurClientSayManagement extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'client_name',
        'client_image',
        'client_description',
        'client_status',
        'sort_order'
    ];
}
