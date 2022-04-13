<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubResearchImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'research_image_id',
        'report_image_path',
        
        
    ];
    // public function reportimages(){
    //     return $this->belongsTo(User::class,'user_id');
    // }
}
