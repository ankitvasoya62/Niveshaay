<?php $active='' ?>
@extends('frontend.layout.master')
@section('content')
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('/css/jquery-ui-datepicker.min.css')}}">
<style>
    .error{
        color:red;
    }
</style>
@endpush
<section class="subscription-form-section">
	<div class="niveshaay-container">
		<h1>Niveshaay Risk Profiling and <span>Suitability Assessment</span></h1>
		<div class="subscription-form-block custom-form-section">
			<div class="white-shadow-card form-wrapper">
                <form method="POST" action="{{ route('store.subscription-details')}}">@csrf
                    <div class="form-outer-wrapper">
                        <div class="form-group half-width">
                            <label for="name">Name of Investor<span class="red-text">*</span></label>
                            <input id="name" name="name_of_investor" type="text" class="form-control" placeholder="Enter Name">		                    
                            @error('name_of_investor')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group half-width has-date-picker">
                            <label for="dob">Date of Birth<span class="red-text">*</span></label>
                            <input id="dob" name="dob" type="text" class="form-control datepicker" placeholder="Select Date of Birth">		                    
                            @error('dob')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group half-width">
                            <label for="email"> Email Address<span class="red-text">*</span></label>
                            <input id="email" name="email" type="text" class="form-control" placeholder="Enter Address ">		                    
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group half-width">
                            <label for="mobile-num">Mobile Number<span class="red-text">*</span></label>
                            <input id="mobile-num" name="mobile_no" type="text" class="form-control" placeholder="Enter Mobile Number ">		                    
                            @error('mobile_no')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group half-width">
                            <label for="street-address">Full Street Address</label>
                            <input id="street-address" name="street_address" type="text" class="form-control" placeholder="Enter Street Address">		                    
                            @error('street_address')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group half-width">
                            <label for="state">State/UnionTerritory ( Please put in country also if outside India)<span class="red-text">*</span></label>
                            <select name="state" class="custom-dropdown form-control">
                                <option value=''>SELECT One</option>
                                @foreach ($states as $key=>$value )
                                    <option value="{{ $value }}">{{ $value }} </option>
                                @endforeach
                            </select>	                    
                            @error('state')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group half-width">
                            <label for="pincode"> Pincode<span class="red-text">*</span></label>
                            <input id="pincode" name="pin_code" type="text" class="form-control" placeholder="Enter Pincode ">		                    
                            @error('pin_code')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group half-width">
                            <label for="pan-num"> Please provide your PAN NO<span class="red-text">*</span></label>
                            <input id="pan-num" name="pan_no" type="text" class="form-control" placeholder="Enter PAN No. ">		                    
                            @error('pan_no')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group has-radio-group">
                            <span class="label">Age<span class="red-text">*</span></span>
                            <div class="custom-radio-wrapper">
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="below30" name="age" type="radio" value="1">		                    
                                        <label for="below30"> &lt; 30 years</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="30-60" name="age" type="radio" value="2">		                    
                                        <label for="30-60">30 - 60 years</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="60plus" name="age" type="radio" value="3">		                    
                                        <label for="60plus"> &gt; 60 years</label>
                                    </div>
                                </div>
                            </div>
                            @error('age')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group has-checkbox-list">
                            <span class="label"> Select your sources of income<span class="red-text">*</span></span>
                            <div class="custom-checkbox-wrapper full-width">
                                <div class="custom-checkbox">
                                    <div class="checkbox-inner">
                                        <input id="employment" name="source_of_income[]" type="checkbox" value="Employment">		                    
                                        <label for="employment"> Employment</label>
                                    </div>
                                </div>
                                <div class="custom-checkbox">
                                    <div class="checkbox-inner">
                                        <input id="business" name="source_of_income[]" type="checkbox" value="Business">		                    
                                        <label for="business"> Business</label>
                                    </div>
                                </div>
                                <div class="custom-checkbox">
                                    <div class="checkbox-inner">
                                        <input id="investment" name="source_of_income[]" type="checkbox" value="Investment">		                    
                                        <label for="investment"> Investment</label>
                                    </div>
                                </div>
                                <div class="custom-checkbox">
                                    <div class="checkbox-inner">
                                        <input id="pension" name="source_of_income[]" type="checkbox" value="Pension">		                    
                                        <label for="pension"> Pension</label>
                                    </div>
                                </div>
                                <div class="custom-checkbox">
                                    <div class="checkbox-inner">
                                        <input id="real-estate" name="source_of_income[]" type="checkbox" value="Real Estate">		                    
                                        <label for="real-estate"> Real Estate</label>
                                    </div>
                                </div>
                                <div class="custom-checkbox  has-full-width">
                                    <div class="other-feild">
                                        <div class="checkbox-inner">
                                            <input id="other" name="source_of_income[]" type="checkbox" value="Other">		                    
                                            <label for="other"> Other</label>
                                        </div>
                                        <div class="other-input-wrapper">
                                            <label for=""></label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group has-checkbox-list">
                            <span class="label"> Select all the investments you currently hold<span class="red-text">*</span></span>
                            <div class="custom-checkbox-wrapper full-width">
                                <div class="custom-checkbox">
                                    <div class="checkbox-inner">
                                        <input id="stocks" name="currently_hold_investments[]" type="checkbox" value="stock">		                    
                                        <label for="stocks"> Stocks</label>
                                    </div>
                                </div>
                                <div class="custom-checkbox">
                                    <div class="checkbox-inner">
                                        <input id="mutual-funds" name="currently_hold_investments[]" type="checkbox" value="MF">		                    
                                        <label for="mutual-funds"> Mutual Funds</label>
                                    </div>
                                </div>
                                <div class="custom-checkbox">
                                    <div class="checkbox-inner">
                                        <input id="bank-fd" name="currently_hold_investments[]" type="checkbox" value="FD">		                    
                                        <label for="bank-fd"> Bank FD</label>
                                    </div>
                                </div>
                                <div class="custom-checkbox has-large-width">
                                    <div class="other-feild">
                                        <div class="checkbox-inner">
                                            <input id="other" name="currently_hold_investments[]" type="checkbox" value="Other">		                    
                                            <label for="other"> Other</label>
                                        </div>
                                        <div class="other-input-wrapper">
                                            <label for=""></label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group  has-radio-group">
                            <span class="label"> What is your annual income<span class="red-text">*</span></span>
                            <div class="custom-radio-wrapper">
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="below10lacs" name="annual_income" type="radio" value="1">		                    
                                        <label for="below10lacs"> &lt; 10 Lacs</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="10lacs-50lacs" name="annual_income" type="radio" value="2">		                    
                                        <label for="10lacs-50lacs"> 10 Lacs - 50 Lacs</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="50lacs-1cr" name="annual_income" type="radio" value="3">		                    
                                        <label for="50lacs-1cr"> 50 Lacs -1 Cr</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="above1cr" name="annual_income" type="radio" value="4">		                    
                                        <label for="above1cr"> Above 1 Cr</label>
                                    </div>
                                </div>
                            </div>
                            @error('annual_income')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group  has-radio-group">
                            <span class="label">What percentage of your income goes in repayment of existing liabilities like bank loans etc. ?<span class="red-text">*</span></span>
                            <div class="custom-radio-wrapper">
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="above50percent" name="repayment_of_existing_liabilities" type="radio" value="1">	                    
                                        <label for="above50percent"> &gt;50</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="20-50percent" name="repayment_of_existing_liabilities" type="radio" value="2">                  
                                        <label for="20-50percent">20% - 50%</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="50percent" name="repayment_of_existing_liabilities" type="radio" value="3">		                    
                                        <label for="50percent"> &lt;20%</label>
                                    </div>
                                </div>
                            </div>
                            @error('repayment_of_existing_liabilities')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group  has-radio-group">
                            <span class="label">Percentage of your liquid net worth you would like to invest?<span class="red-text">*</span></span>
                            <div class="custom-radio-wrapper">
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="below25percent" name="invest_net_worth" type="radio" value="1">	                    
                                        <label for="below25percent"> &lt; 25%</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="25-50percent" name="invest_net_worth" type="radio" value="2">                  
                                        <label for="25-50percent">25% - 50%</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="above50percent" name="invest_net_worth" type="radio" value="3">		                    
                                        <label for="above50percent">&gt; 50%</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group  has-radio-group">
                            <span class="label">What is your comfortable holding investments period?<span class="red-text">*</span></span>
                            <div class="custom-radio-wrapper">
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="below12months" name="investment_period" type="radio" value="1">	                    
                                        <label for="below12months"> &lt; 12 Months</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="12-36Months" name="investment_period" type="radio" value="2">                  
                                        <label for="12-36Months">12-36 Months</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="above36months" name="investment_period" type="radio" value="3">		                    
                                        <label for="above36months">Over 36 Months</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group  has-radio-group">
                            <span class="label">What is your investment objective?</span>
                            <div class="custom-radio-wrapper full-width">
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="type1" name="invest_objective" type="radio" value="1">		                    
                                        <label for="type1">Protect invested capital with very low chance of a loss (investment horizon - < 2 years)</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="type2" name="invest_objective" type="radio" value="2">		                    
                                        <label for="type2">Seek balance between invested capital growth and protection (investment horizon - 2-5 years)</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="type3" name="invest_objective" type="radio" value="3">		                    
                                        <label for="type3">Seek long term wealth creation with chances of higher short term loss (investment horizon - > 5 years)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group  has-radio-group">
                            <span class="label">Pick a possible outcome along with potential capital drawdown for your investment - Average Return<span class="red-text">*</span></span>
                            <div class="custom-radio-wrapper full-width">
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="type1" name="invest_average_return" type="radio" value="1">		                    
                                        <label for="type1">Avg Return - 7% Best Return - 12% Worst Return - (-5%)</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="type2" name="invest_average_return" type="radio" value="2">		                    
                                        <label for="type2">Avg Return - 10% Best Return - 18% Worst Return - (-12%)</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="type1" name="invest_average_return" type="radio" value="3">		                    
                                        <label for="type1">Avg Return - 12% Best Return - 22% Worst Return - (-19%)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group  has-radio-group">
                            <span class="label">What best describes your Risk Attitude?<span class="red-text">*</span></span>
                            <div class="custom-radio-wrapper full-width">
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="secure" name="risk_attitude" type="radio" value="1">		                    
                                        <label for="secure">SECURE : I seek complete safety of my capital with no negative returns</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="moderate" name="risk_attitude" type="radio" value="2">		                    
                                        <label for="moderate">MODERATE : I seek a balance of regular income and capital appreciation over medium term</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="aggressive" name="risk_attitude" type="radio" value="3">		                    
                                        <label for="aggressive">AGGRESSIVE : I am comfortable with volatility and seek aggressive returns over a long term</label>
                                    </div>
                                </div>
                            </div>
                        </div>	
                        <div class="form-group  has-radio-group">
                            <span class="label">What best describes your Knowledge & Experience?<span class="red-text">*</span></span>
                            <div class="custom-radio-wrapper full-width">
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="limited" name="knowledge_experience" type="radio" value="1">		                    
                                        <label for="limited">LIMITED : I have limited understanding & experience of financial investments</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="moderate" name="knowledge_experience" type="radio" value="2">		                    
                                        <label for="moderate">MODERATE : I am comfortable with financial products & have fair understanding & experience in investments</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="extensive" name="knowledge_experience" type="radio" value="3">		                    
                                        <label for="extensive">EXTENSIVE : I have extensive knowledge & experience of financial products</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group  has-radio-group">
                            <span class="label">Do you confirm that your legal residential status allows you to take this advisory and invest in the Indian stock markets?<span class="red-text">*</span></span>
                            <div class="custom-radio-wrapper">
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="yes" name="confirm_legal_residental_Status" type="radio" value="1">		                    
                                        <label for="yes">Yes</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="no" name="confirm_legal_residental_Status" type="radio" value="0">		                    
                                        <label for="no">No</label>
                                    </div>
                                </div>
                            </div>
                            @error('confirm_legal_residental_Status')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>				
                        <div class="form-group  has-radio-group">
                            <span class="label">Have you suitably assessed by your own research, the ability and the knowledge of the advisor Mr Arvind Kothari to provide you with the required services<span class="red-text">*</span></span>
                            <div class="custom-radio-wrapper">
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="yes" name="assesed_owned_research" type="radio" value="1">		                    
                                        <label for="yes">Yes</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="no" name="assesed_owned_research" type="radio" value="0">		                    
                                        <label for="no">No</label>
                                    </div>
                                </div>
                            </div>
                            @error('assesed_owned_research')
                                <span>{{ $message }}</span>
                            @enderror     
                        </div>
                        <div class="form-group">
                            <span class="label">Do you understand the Risk & Reward associated with Niveshaay's Investment Strategy?<span class="red-text">*</span></span>
                            <div class="custom-radio-wrapper">
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="yes" name="understand_risk_reward" type="radio" value="1">		                    
                                        <label for="yes">Yes</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="no" name="understand_risk_reward" type="radio" value="0">		                    
                                        <label for="no">No</label>
                                    </div>
                                </div>
                            </div>
                            @error('understand_risk_reward')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-green">Save and Next</button>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</section>
@push('js')
    <script defer type="text/javascript" src="{{asset('/js/jquery-ui-datepicker.min.js')}}"></script>
    <script type="module">
        JQuery.datepicker.formatDate( "dd-mm-yyyy");

    </script>
@endpush
@endsection