@extends('backend.layouts.master')
@section('content')
<div class="content-wrapper">
    
    <section class="content-header">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{URL::previous()}}" class="btn btn-primary">Back</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Subscription Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    
                                    
                                    <div class="col-md-6">
                                        Name Of Investor
                                    </div>
                                    <div class="col-md-6">
                                        {{ $subscription_details->name_of_investor }}
                                    </div>
                                    <hr>
                                    <div class="col-md-6">
                                        Date of birth
                                    </div>
                                    
                                    <div class="col-md-6">
                                        {{ $subscription_details->dob }}
                                    </div>
                                    <hr>
                                    <div class="col-md-6">
                                        Email
                                    </div>
                                    
                                    <div class="col-md-6">
                                        {{ $subscription_details->email }}
                                    </div>
                                    <hr>
                                    <div class="col-md-6">
                                        Mobile number
                                    </div>
                                    
                                    <div class="col-md-6">
                                        {{ $subscription_details->mobile_no }}
                                    </div>
                                    <hr>
                                    <div class="col-md-6">
                                        Street Address
                                    </div>
                                    
                                    <div class="col-md-6">
                                        {{ $subscription_details->street_address }}
                                    </div>
                                    <hr>
                                    <div class="col-md-6">
                                        State
                                    </div>
                                    
                                    <div class="col-md-6">
                                        {{ $subscription_details->state }}
                                    </div>
                                    <hr>
                                    <div class="col-md-6">
                                        Pin Code
                                    </div>
                                    
                                    <div class="col-md-6">
                                        {{ $subscription_details->pin_code }}
                                    </div>
                                    <hr>
                                    <div class="col-md-6">
                                        Pan number
                                    </div>
                                    
                                    <div class="col-md-6">
                                        {{ $subscription_details->pan_no }}
                                    </div>
                                    <hr>
                                    
                                    <div class="col-md-6">
                                        Age
                                    </div>
                                    
                                    <div class="col-md-6">
                                        @if($subscription_details->age == 1)
                                            < 30 years
                                        @elseif($subscription_details->age == 2)
                                            30 - 60 years
                                        @elseif($subscription_details->age == 3)
                                            >60 years
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="col-md-6">
                                        Source Of Income
                                    </div>
                                    
                                    <div class="col-md-6">
                                        {{ $subscription_details->source_of_income }}
                                        
                                    </div>
                                    <hr>
                                    <div class="col-md-6">
                                        Currently hold investments
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <?php 
                                                $currently_hold_investments = str_replace("MF","Mutual Funds",$subscription_details->currently_hold_investments);
                                                $currently_hold_investments = str_replace("FD","Bank FD",$currently_hold_investments);
                                        ?>
                                        {{ $currently_hold_investments }}
                                        
                                    </div>
                                    <hr>
                                    <div class="col-md-6">
                                        Annual Income
                                    </div>
                                    
                                    <div class="col-md-6">
                                        
                                        @if($subscription_details->annual_income == 1)
                                                <p>< 10 Lacs</p>
                                        @elseif($subscription_details->annual_income == 2)
                                            <p>10 Lacs - 50 Lacs</p>
                                        @elseif($subscription_details->annual_income == 3)
                                            <p>50 Lacs - 1 Cr</p>
                                        @elseif($subscription_details->annual_income == 4)
                                            <p>Above 1 Cr</p>
                                        @endif
                                        
                                    </div>
                                    <hr>
                
                                    <div class="col-md-6">
                                        Repayment Liabilities
                                    </div>
                                    <div class="col-md-6">
                                        
                                        @if($subscription_details->repayment_of_existing_liabilities == 1)
                                                <p>> 50%</p>
                                        @elseif($subscription_details->repayment_of_existing_liabilities == 2)
                                            <p>20 - 50%</p>
                                        @elseif($subscription_details->repayment_of_existing_liabilities == 3)
                                            <p>< 20%</p>
                                        @endif
                                        
                                    </div>
                                    <hr>
                
                                    <div class="col-md-6">
                                        Invest Net Worth
                                    </div>
                                    <div class="col-md-6">
                                        
                                        @if($subscription_details->invest_net_worth == 1)
                                                <p> < 25% </p>
                                        @elseif($subscription_details->invest_net_worth == 2)
                                            <p> 25% - 50%</p>
                                        @elseif($subscription_details->invest_net_worth == 3)
                                            <p> > 50% </p>
                                        @endif
                                        
                                    </div>
                                    <hr>
                
                                    <div class="col-md-6">
                                        Investment Horizon
                                    </div>
                                    <div class="col-md-6">
                                        
                                        @if($subscription_details->investment_period == 1)
                                                <p> < 12 months </p>
                                        @elseif($subscription_details->investment_period == 2)
                                            <p> 12 - 36 months </p>
                                        @elseif($subscription_details->investment_period == 3)
                                            <p> > 36 months </p>
                                        @endif
                                        
                                    </div>
                                    <hr>
                
                                    <div class="col-md-6">
                                        Investment Objective
                                    </div>
                                    <div class="col-md-6">
                                        @if($subscription_details->invest_objective == 1)
                                                <p>Protect invested capital with very low chance of a loss (investment horizon - < 2 years)</p>
                                        @elseif($subscription_details->invest_objective == 2)
                                            <p>Seek balance between invested capital growth and protection (investment horizon - 2-5 years)</p>
                                        @elseif($subscription_details->invest_objective == 3)
                                            <p>Seek long term wealth creation with chances of higher short term loss (investment horizon - > 5 years)</p>
                                        @endif
                                        
                                        
                                    </div>
                                    <hr>
                
                                    <div class="col-md-6">
                                        Investment Average Return
                                    </div>
                                    <div class="col-md-6">
                                        @if($subscription_details->invest_average_return == 1)
                                                7% , 12% , -5%
                                        @elseif($subscription_details->invest_average_return == 2)
                                            10% , 18% , -12%
                                        @elseif($subscription_details->invest_average_return == 3)
                                            12% , 22% , -19%
                                        @endif
                                        
                                    </div>
                                    <hr>
                
                                    <div class="col-md-6">
                                        Risk Attitude
                                    </div>
                                    <div class="col-md-6">
                                        @if($subscription_details->risk_attittude == 1)
                                            Secure
                                        @elseif($subscription_details->risk_attittude == 2)
                                            Moderate
                                        @elseif($subscription_details->risk_attittude == 3)
                                            Aggressive
                                        @endif
                                        
                                    </div>
                                    <hr>
                
                                    <div class="col-md-6">
                                        Knowledge & Experience
                                    </div>
                                    <div class="col-md-6">
                                        @if($subscription_details->knowledge_experience == 1)
                                            Limited
                                        @elseif($subscription_details->knowledge_experience == 2)
                                            Moderate
                                        @elseif($subscription_details->knowledge_experience == 3)
                                            Extensive
                                        @endif
                                        
                                    </div>
                                    <hr>
                
                                    <div class="col-md-6">
                                        Email Verified
                                    </div>
                                    <div class="col-md-6">
                                        @if($subscription_details->is_email_verified == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                        
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</div>
@endsection
