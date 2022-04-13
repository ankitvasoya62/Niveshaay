<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurResearch extends Model
{
    use HasFactory;
    protected $fillable=array('title','subtitle','description','image_path','status','short_description');
}
