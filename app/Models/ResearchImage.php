<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
class ResearchImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'report_title'
        // 'report_image_path',
        // 'status',
        
    ];
}
