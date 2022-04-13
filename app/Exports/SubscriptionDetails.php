<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\SubscriptionFormDetail;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMapping;

class SubscriptionDetails implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        $dateRange = request()->input('date-range');
        if($dateRange == ''){
            return SubscriptionFormDetail::all()->where('status','active');
        }else{
            $dateRangeArray = explode('- ',$dateRange);
            // dd($dateRangeArray);
            $startDate = Carbon::parse($dateRangeArray[0])->format('Y-m-d');
            $endDate = Carbon::parse($dateRangeArray[1])->format('Y-m-d');
            return SubscriptionFormDetail::
            whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            
            ->get();
        }
        
        
    }
 
    public function map($subscription) : array {
        

        $age = '';
        if($subscription->age == 1)
            $age = '< 30 years';
        elseif($subscription->age == 2)
            $age = '30 - 60 years';
                                
        elseif($subscription->age == 3)
            $age = '>60 years';
                       
        $currently_hold_investments = str_replace("MF","Mutual Funds",$subscription->currently_hold_investments);
        $currently_hold_investments = str_replace("FD","Bank FD",$currently_hold_investments);

        $annual_income = '';
        if($subscription->annual_income == 1)
            $annual_income = '< 10 Lacs';
                                
        elseif($subscription->annual_income == 2)
            $annual_income = '10 Lacs - 50 Lacs';
            
        elseif($subscription->annual_income == 3)
            $annual_income = '50 Lacs - 1 Cr';
            
        elseif($subscription->annual_income == 4)
            $annual_income = 'Above 1 Cr';
        
        $repayment_of_existing_liabilities = '';
        if($subscription->repayment_of_existing_liabilities == 1)
            $repayment_of_existing_liabilities = '> 50%';
        
        elseif($subscription->repayment_of_existing_liabilities == 2)
            $repayment_of_existing_liabilities = '20 - 50%';
            
        elseif($subscription->repayment_of_existing_liabilities == 3)
            $repayment_of_existing_liabilities = '50%';
            
        $invest_net_worth = '';
        if($subscription->invest_net_worth == 1)
            $invest_net_worth = '< 25%';
        
        elseif($subscription->invest_net_worth == 2)
            $invest_net_worth = '25% - 50%';
            
        elseif($subscription->invest_net_worth == 3)
            $invest_net_worth = '> 50%';
            
            
        $investment_period = '';
        if($subscription->investment_period == 1)
            $investment_period = '< 12 months';
        
        elseif($subscription->investment_period == 2)
            $investment_period = '12 - 36 months';
            
        elseif($subscription->investment_period == 3)
            $investment_period = ' > 36 months';
    
        $invest_objective = '';
        if($subscription->invest_objective == 1)
            $invest_objective = 'Protect invested capital with very low chance of a loss (investment horizon - < 2 years)';
        
        elseif($subscription->invest_objective == 2)
            $invest_objective = 'Seek balance between invested capital growth and protection (investment horizon - 2-5 years)';
            
        elseif($subscription->invest_objective == 3)
            $invest_objective = 'Seek long term wealth creation with chances of higher short term loss (investment horizon - > 5 years)';
            
        $invest_average_return = '';
        if($subscription->invest_average_return == 1)
            $invest_average_return = '7% , 12% , -5%';
        elseif($subscription->invest_average_return == 2)
            $invest_average_return = '10% , 18% , -12%';
            
        elseif($subscription->invest_average_return == 3)
            $invest_average_return = '12% , 22% , -19%';
            
        $risk_attitude = '';
        if($subscription->risk_attittude == 1)
            $risk_attitude = 'Secure';
            
        elseif($subscription->risk_attittude == 2)
            $risk_attitude = 'Moderate';
            
        elseif($subscription->risk_attittude == 3)
            $risk_attitude = 'Aggressive';
        
        $knowledge_experience = '';
        if($subscription->knowledge_experience == 1)
            $knowledge_experience = 'Limited';
        elseif($subscription->knowledge_experience == 2)
            $knowledge_experience = 'Moderate';
            
        elseif($subscription->knowledge_experience == 3)
            $knowledge_experience = 'Extensive';
            
        
        return [
            $subscription->id,
            $subscription->name_of_investor,
            $subscription->dob,
            $subscription->email,
            $subscription->mobile_no,
            $subscription->street_address,
            $subscription->state,
            $subscription->pin_code,
            $subscription->pan_no,
            $age,
            $subscription->source_of_income,
            $currently_hold_investments,
            $annual_income,
            $repayment_of_existing_liabilities,
            $invest_net_worth,
            $investment_period,
            $invest_objective,
            $invest_average_return,
            $risk_attitude,
            $knowledge_experience,
            
            Carbon::parse($subscription->created_at)->toFormattedDateString()
        ] ;
 
 
    }
 
    public function headings() : array {
        return [

        
            '#',
            'Name Of Investor',
            'D.O.B.',
            'Email',
            'Mobile no.',
            'Street Address',
            'State',
            'Pincode',
            'Pan number',
            'Age',
            'Source Of Income',
            'currently hold investments',
            'annual income',
            'repayment of existing liabilities',
            'invest net worth',
            'investment period',
            'invest objective',
            'invest average return',
            'risk attitude',
            'knowledge experience',
            
            
            
            'Created At'
        ] ;
    }
}
