<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Newsletter extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'title',
        'banner',
        'banner_title',
        'date',
        'editor_top',
        'editor_left',
        'editor_right',
        'editor_bottom'
    ];
    
}
