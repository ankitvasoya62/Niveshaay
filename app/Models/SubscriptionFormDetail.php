<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionFormDetail extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name_of_investor',
        'dob',
        'email',
        'mobile_no',
        'street_address',
        'state',
        'pin_code',
        'pan_no',
        'age',
        'source_of_income',
        'currently_hold_investments',
        'annual_income',
        'repayment_of_existing_liabilities',
        'invest_net_worth',
        'investment_period',
        'invest_objective',
        'invest_average_return',
        'risk_attitude',
        'knowledge_experience',
        'confirm_legal_residental_Status',
        'assesed_owned_research',
        'understand_risk_reward',
        'is_email_verified',
        'is_verified_by_admin',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    }
