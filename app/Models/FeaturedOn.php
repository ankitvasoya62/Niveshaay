<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeaturedOn extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'featured_image',
        'featured_logo',
        'featured_date',
        'featured_title',
        'featured_url',
        'status',
        'featured_description'
    ];
}
