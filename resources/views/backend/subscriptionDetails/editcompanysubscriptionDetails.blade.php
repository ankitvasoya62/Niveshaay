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
                <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">DOB</label>
                                        <input type="date" name="dob" class="form-control" id="dob" value="{{ $subscription_details->dob }}" required>
                                    </div>
                                </div> --}}
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
                                        <label for="pan_no">PAN Number</label>
                                        <input type="text" name="pan_no" class="form-control" id="pan_no" placeholder="Enter Pan Number" value="{{ $subscription_details->pan_no }}" required>
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
                                        <label for="state">State/UnionTerritory</label>
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
                                
                                        <label for="is_demat_account">Do you have DEMAT Account?</label><br>
                                        <div class="form-check d-inline">
                                            <input class="form-check-input" type="radio" id="is_demat_account" name="is_demat_account" value="1" @if($subscription_details->is_demat_account == 1) checked @endif >
                                            <label class="form-check-label"> Yes</label>
                                        </div>
                                        <div class="form-check d-inline">
                                            <input class="form-check-input" type="radio" id="is_demat_account1" name="is_demat_account" value="0" @if($subscription_details->is_demat_account == 0) checked @endif>
                                            <label class="form-check-label"> No</label>
                                        </div>
                                        
                                        
                                    </div>        
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="demat_account_no"> DEMAT Account No</label>
                                        <input type="text" name="demat_account_no" class="form-control" id="demat_account_no" placeholder="Enter DEMAT Account Number" value="{{ $subscription_details->pan_no }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_of_incorporation">Date Of Incorporation</label>
                                        <input type="date" name="date_of_incorporation" class="form-control" id="date_of_incorporation" value="{{ $subscription_details->date_of_incorporation }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="legal_status">Legal Status</label>
                                        <input type="text" name="legal_status" class="form-control" id="legal_status" placeholder="Enter Legal Status" value="{{ $subscription_details->legal_status }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gst_no">GST Number</label>
                                        <input type="text" name="gst_no" class="form-control" id="gst_no" placeholder="Enter GST Number" value="{{ $subscription_details->gst_no }}">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                
                                <label for="number_of_years_since_registration">Number of years since Incorporation/Registration</label><br>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="number_of_years_since_registration" name="number_of_years_since_registration" value="1" @if($subscription_details->number_of_years_since_registration == 1) checked @endif >
                                    <label class="form-check-label">less than 5 years</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="number_of_years_since_registration1" name="number_of_years_since_registration" value="2" @if($subscription_details->number_of_years_since_registration == 2) checked @endif>
                                    <label class="form-check-label">5-10 years</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="number_of_years_since_registration2" name="number_of_years_since_registration" value="3" @if($subscription_details->number_of_years_since_registration == 3) checked @endif>
                                    <label class="form-check-label">more than 10 years</label>
                                </div>
                                
                            </div>
                            
                            <div class="form-group">
                                
                                <label for="average_profit">Average profit after tax (PAT) for last 3 years</label><br>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="average_profit" name="average_profit" value="1" @if($subscription_details->average_profit == 1) checked @endif >
                                    <label class="form-check-label">less than Rs. 10 lakhs</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="average_profit1" name="average_profit" value="2" @if($subscription_details->average_profit == 2) checked @endif>
                                    <label class="form-check-label">Rs. 10-25 lakhs</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input class="form-check-input" type="radio" id="average_profit2" name="average_profit" value="3" @if($subscription_details->average_profit == 3) checked @endif>
                                    <label class="form-check-label">more than Rs. 25 lakhs</label>
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
                                    <label for="invest_net_worth_3" class="form-check-label"> > 50%</label>
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