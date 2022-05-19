<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShareDetails extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'share_title',
        'share_date',
        'share_logo',
        'share_image',
        'share_industry',
        'share_cmp',
        'share_market_cap',
        'share_week_high_low',
        'shareholding_promoters',
        'shareholding_public',
        'research_analyst_name',
        'research_analyst_designation',
        'research_analyst_email',
        'share_description',
        'share_outlook',
        'share_recommendation',
        'mutual_funds',
        'fiis',
        'share_status',
        'upload_type',
        'pdf_name',
        'status'
        
    ];
}
