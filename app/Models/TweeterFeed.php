<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TweeterFeed extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'tweeter_name',
        'tweeter_username',
        'tweeter_user_image',
        'tweeter_description',
        'sort_order'
    ];
}
