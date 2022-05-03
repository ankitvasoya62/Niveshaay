@extends('backend.layouts.master')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1></h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                <li class="breadcrumb-item active">Edit Subscription Details</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Subscription Details</h3>
                        </div>
                    </div>
                    <form id="quickForm" method="POST" action="{{ route('admin.update-subscription',$subscription_details->id) }}">@csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name_of_investor">Name Of Investor</label>
                                        <input type="text" name="name_of_investor" class="form-control" id="name_of_investor" placeholder="Enter Name Of Investor" value="{{ $subscription_details->name_of_investor }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">DOB</label>
                                        <input type="date" name="dob" class="form-control" id="dob" value="{{ $subscription_details->dob }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{ $subscription_details->email }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile_no">Mobile Number</label>
                                        <input type="text" name="mobile_no" class="form-control" id="mobile_no" placeholder="Enter Mobile no." value="{{ $subscription_details->mobile_no }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="street_address">Full Street Address</label>
                                        <input type="text" name="street_address" class="form-control" id="street_address" placeholder="Enter Street Address" value="{{ $subscription_details->street_address }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="state">State/UnionTerritory ( Please put in country also if outside India)</label>
                                        {{-- <input type="text" name="state" class="form-control" id="state" placeholder="Enter State"> --}}
                                        <select class="form-control" id="state" name="state"  required>
                                            <option value="">Select One</option>
                                            @foreach ($states as $key=>$val)
                                                <option value="{{ $val }}" @if($val == $subscription_details->state ) selected @endif>{{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pin_code">Pincode</label>
                                        <input type="text" name="pin_code" class="form-control" id="pin_code" placeholder="Enter Pin Code" value="{{ $subscription_details->pin_code }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pan_no">PAN Number</label>
                                        <input type="text" name="pan_no" class="form-control" id="pan_no" placeholder="Enter Pan Number" value="{{ $subscription_details->pan_no }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pan_no">GST Number</label>
                                        <input type="text" name="gst_no" class="form-control" id="gst_no" placeholder="Enter GST Number" value="{{ $subscription_details->gst_no }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                
                                <label for="age">Age</label><br>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="age" name="age" value="1" @if($subscription_details->age == 1) checked @endif >
                                    <label class="form-check-label"> < 30 years</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="age1" name="age" value="2" @if($subscription_details->age == 2) checked @endif>
                                    <label class="form-check-label"> 30 - 60 years</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="age2" name="age" value="2" @if($subscription_details->age == 3) checked @endif>
                                    <label class="form-check-label"> > 60 years</label>
                                </div>
                                {{-- <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" id="age" name="age" value="1" @if($subscription_details->age == 1) checked @endif >
                                    <label for="age" class="form-check-label"> < 30 years</label>&nbsp;&nbsp;
                                    <input class="form-check-input ml-3" type="radio" id="age1" name="age" value="2" @if($subscription_details->age == 2) checked @endif>
                                    <label for="age1" class="form-check-label"> 30 - 60 years</label>&nbsp;&nbsp;
                                    <input class="form-check-input ml-3" type="radio" id="age2" name="age" value="3" @if($subscription_details->age == 3) checked @endif>
                                    <label for="age2" class="form-check-label"> > 60 years</label>
                                </div> --}}
                            </div>
                            <div class="form-group">
                                <label for ="source-of-income">Source Of Income</label><br>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="checkbox" id="Employment" value="Employment" name="source_of_income[]" @if(str_contains($subscription_details->source_of_income, 'Employment')) checked @endif>
                                    <label for="Employment" class="form-check-label">Employment</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="checkbox" id="Bussiness" value="Business" name="source_of_income[]" @if(str_contains($subscription_details->source_of_income, 'Business')) checked @endif>
                                    <label for="Bussiness" class="form-check-label">Bussiness</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="checkbox" id="Investment" value="Investment" name="source_of_income[]" @if(str_contains($subscription_details->source_of_income, 'Investment')) checked @endif>
                                    <label for="Investment" class="form-check-label">Investment</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="checkbox" id="Real Estate" value="Real Estate" name="source_of_income[]" @if(str_contains($subscription_details->source_of_income, 'Real Estate')) checked @endif>
                                    <label for="Real Estate" class="form-check-label">Real Estate</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="checkbox" id="Other" value="Other" name="source_of_income[]" @if(str_contains($subscription_details->source_of_income, 'Other')) checked @endif>
                                    <label for="Other" class="form-check-label">Other</label>
                                </div>
                               
                                
                            </div>
                            <div class="form-group">
                                <label for ="currently_hold_investments">Currently Hold Investments</label><br>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="checkbox" id="stock" value="stock" name="currently_hold_investments[]" @if(str_contains($subscription_details->currently_hold_investments, 'stock')) checked @endif>
                                    <label for="stock" class="form-check-label">Stocks</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="checkbox" id="MF" value="MF" name="currently_hold_investments[]" @if(str_contains($subscription_details->currently_hold_investments, 'MF')) checked @endif>
                                    <label for="MF" class="form-check-label">Mutual Funds</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="checkbox" id="FD" value="FD" name="currently_hold_investments[]" @if(str_contains($subscription_details->currently_hold_investments, 'FD')) checked @endif>
                                    <label for="FD" class="form-check-label">Bank FD</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="checkbox" id="Other" value="Other" name="currently_hold_investments[]" @if(str_contains($subscription_details->currently_hold_investments, 'Other')) checked @endif>
                                    <label for="Other" class="form-check-label">Other</label>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label for="annual_income">Annual Income</label><br>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="10L" name="annual_income" value="1" @if($subscription_details->annual_income == 1) checked @endif>
                                    <label for="10L" class="form-check-label"> < 10 Lacs</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="50L" name="annual_income" value="2" @if($subscription_details->annual_income == 2) checked @endif>
                                    <label for="50L" class="form-check-label"> 10 Lacs - 50 Lacs</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="1CR" name="annual_income" value="3" @if($subscription_details->annual_income == 3) checked @endif>
                                    <label for="1CR" class="form-check-label"> 50 Lacs - 1 Cr</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="G10CR" name="annual_income" value="4" @if($subscription_details->annual_income == 4) checked @endif>
                                    <label for="G10CR" class="form-check-label"> 50 Lacs - 1 Cr</label>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label for="repayment_of_existing_liabilities">What percentage of your income goes in repayment of existing liabilities like bank loans etc. ?</label><br>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="repayment_of_existing_liabilities_1" name="repayment_of_existing_liabilities" value="1" @if($subscription_details->repayment_of_existing_liabilities == 1) checked @endif>
                                    <label for="repayment_of_existing_liabilities_1" class="form-check-label"> > 50%</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="repayment_of_existing_liabilities_2" name="repayment_of_existing_liabilities" value="2" @if($subscription_details->repayment_of_existing_liabilities == 2) checked @endif>
                                    <label for="repayment_of_existing_liabilities_2" class="form-check-label"> 20 - 50%</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="repayment_of_existing_liabilities_3" name="repayment_of_existing_liabilities" value="3" @if($subscription_details->repayment_of_existing_liabilities == 3) checked @endif>
                                    <label for="repayment_of_existing_liabilities_3" class="form-check-label"> 50%</label>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label for="invest_net_worth">Percentage of your liquid net worth you would like to invest?</label><br>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="invest_net_worth_1" name="invest_net_worth" value="1" @if($subscription_details->invest_net_worth == 1) checked @endif>
                                    <label for="invest_net_worth_1" class="form-check-label"> < 25%</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="invest_net_worth_2" name="invest_net_worth" value="2" @if($subscription_details->invest_net_worth == 2) checked @endif>
                                    <label for="invest_net_worth_2" class="form-check-label"> 25 - 50%</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="invest_net_worth_3" name="invest_net_worth" value="3" @if($subscription_details->invest_net_worth == 3) checked @endif>
                                    <label for="invest_net_worth_3" class="form-check-label"> > 20%</label>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label for="investment_period">What is your comfortable holding investments period?</label><br>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="investment_period_1" name="investment_period" value="1" @if($subscription_details->investment_period == 1) checked @endif>
                                    <label for="investment_period_1" class="form-check-label"> < 12 Months</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="investment_period_2" name="investment_period" value="2" @if($subscription_details->investment_period == 2) checked @endif>
                                    <label for="investment_period_2" class="form-check-label"> 12 - 36 Months</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="investment_period_3" name="investment_period" value="3" @if($subscription_details->investment_period == 3) checked @endif>
                                    <label for="investment_period_3" class="form-check-label"> Over 36 Months</label>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label for="invest_objective">What is your investment objective?</label><br>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="investment_objective_1" name="invest_objective" value="1" @if($subscription_details->invest_objective == 1) checked @endif>
                                    <label for="investment_objective_1" class="form-check-label"> Protect invested capital with very low chance of a loss (investment horizon - < 2 years) </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="investment_objective_2" name="invest_objective" value="2" @if($subscription_details->invest_objective == 2) checked @endif>
                                    <label for="investment_objective_2" class="form-check-label"> Seek balance between invested capital growth and protection (investment horizon - 2-5 years)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="investment_objective_3" name="invest_objective" value="3" @if($subscription_details->invest_objective == 3) checked @endif>
                                    <label for="investment_objective_3" class="form-check-label"> Seek long term wealth creation with chances of higher short term loss (investment horizon - > 5 years)</label>
                                </div>
                                
                            </div>
                            <div class="form-group">

                                <label for="invest_average_return">Pick a possible outcome along with potential capital drawdown for your investment - Average Return</label><br>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="invest_average_return_1" name="invest_average_return" value="1" @if($subscription_details->invest_average_return == 1) checked @endif>
                                    <label for="invest_average_return_1" class="form-check-label"> Avg Return - 7% Best Return - 12% Worst Return - (-5%) </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="invest_average_return_2" name="invest_average_return" value="2" @if($subscription_details->invest_average_return == 2) checked @endif>
                                    <label for="invest_average_return_2" class="form-check-label"> Avg Return - 10% Best Return - 18% Worst Return - (-12%)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="invest_average_return_3" name="invest_average_return" value="3" @if($subscription_details->invest_average_return == 3) checked @endif>
                                    <label for="invest_average_return_3" class="form-check-label"> Avg Return - 12% Best Return - 22% Worst Return - (-19%)</label>
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <label for="risk_attitude">What best describes your Risk Attitude?</label><br>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="risk_attitude_1" name="risk_attitude" value="1" @if($subscription_details->risk_attitude == 1) checked @endif>
                                    <label for="risk_attitude_1" class="form-check-label"> SECURE : I seek complete safety of my capital with no negative returns </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="risk_attitude_2" name="risk_attitude" value="2" @if($subscription_details->risk_attitude == 2) checked @endif>
                                    <label for="risk_attitude_2" class="form-check-label"> MODERATE : I seek a balance of regular income and capital appreciation over medium term</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="risk_attitude_3" name="risk_attitude" value="3" @if($subscription_details->risk_attitude == 3) checked @endif>
                                    <label for="risk_attitude_3" class="form-check-label"> AGGRESSIVE : I am comfortable with volatility and seek aggressive returns over a long term</label>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label for="knowledge_experience">What best describes your Knowledge & Experience?</label><br>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="knowledge_experience_1" name="knowledge_experience" value="1" @if($subscription_details->knowledge_experience == 1) checked @endif>
                                    <label for="knowledge_experience_1" class="form-check-label"> LIMITED : I have limited understanding & experience of financial investments </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="knowledge_experience_2" name="knowledge_experience" value="2" @if($subscription_details->knowledge_experience == 2) checked @endif>
                                    <label for="knowledge_experience_2" class="form-check-label"> MODERATE : I am comfortable with financial products & have fair understanding & experience in investments</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="knowledge_experience_3" name="knowledge_experience" value="3" @if($subscription_details->knowledge_experience == 3) checked @endif>
                                    <label for="knowledge_experience_3" class="form-check-label"> EXTENSIVE : I have extensive knowledge & experience of financial products</label>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-danger" onclick="window.history.back();" style="margin: 5px;">Cancel</button>
                          </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection