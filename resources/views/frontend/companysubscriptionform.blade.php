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
                <form method="POST" action="{{ route('store.companysubscription-details')}}" id="subscription-form">@csrf
                    <div class="form-outer-wrapper">
                        <div class="form-group half-width">
                            <label for="name">Name of Investor<span class="red-text">*</span></label>
                            <input id="name" name="name_of_investor" type="text" class="form-control" placeholder="Enter Name" value="{{ Auth::user()->name }}" required>		                    
                            @error('name_of_investor')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group half-width">
                            <label for="email"> Email Address<span class="red-text">*</span></label>
                            <input id="email" name="email" type="text" class="form-control" placeholder="Enter Address" value="{{ Auth::user()->email }}">		                    
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group half-width">
                            <label for="mobile-num">Mobile Number<span class="red-text">*</span></label>
                            <input id="mobile-num" name="mobile_no" type="text" class="form-control" placeholder="Enter Mobile Number " value="{{ Auth::user()->phone_no }}">		                    
                            @error('mobile_no')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <span class="error" id="mobile_no_error"></span>
                        </div>
                        <div class="form-group half-width">
                            <label for="street-address">Full Street Address</label>
                            <input id="street-address" name="street_address" type="text" class="form-control" placeholder="Enter Street Address" value="{{ old('street_address') }}">		                    
                            @error('street_address')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group half-width">
                            <label for="state">State/UnionTerritory<span class="red-text">*</span></label>
                            <select name="state" class="custom-dropdown form-control" required>
                                <option value=''>SELECT One</option>
                                @foreach ($states as $key=>$value )
                                    <option value="{{ $value }}" @if ($value == old('state'))
                                         selected
                                    @endif>{{ $value }} </option>
                                @endforeach
                            </select>	                    
                            @error('state')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="form-group half-width">
                            <label for="pincode"> Pincode<span class="red-text">*</span></label>
                            <input id="pincode" name="pin_code" type="text" class="form-control" placeholder="Enter Pincode" value="{{ old('pin_code') }}" required>		                    
                            @error('pin_code')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class="form-group half-width">
                            <label for="pan-num"> Please provide your PAN NO<span class="red-text">*</span></label>
                            <input id="pan-num" name="pan_no" type="text" class="form-control" placeholder="Enter PAN No. " value="{{ old('pan_no') }}">		                    
                            @error('pan_no')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group has-radio-group half-width">
                            <span class="label">Do you have DEMAT Account?
                                <span class="red-text">*</span></span>
                            <div class="custom-radio-wrapper">
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="is_demat_account" name="is_demat_account" type="radio" value="1" @if(old('is_demat_Account') == 1) checked @endif>		                    
                                        <label for="is_demat_account">Yes</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="is_demat_account" name="is_demat_account" type="radio" value="0" @if(old('is_demat_Account') == 0) checked @endif>		                    
                                        <label for="is_demat_account">No</label>
                                    </div>
                                </div>
                                
                            </div>
                            @error('is_demat_account')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group half-width">
                            <label for="demat_account_no"> DEMAT Account No</label>
                            <input id="demat_account_no" name="demat_account_no" type="text" class="form-control" placeholder="Enter DEMAT account no. " value="{{ old('demat_account_no') }}">		                    
                            @error('demat_account_no')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group has-date-picker half-width">
                            <label for="date_of_incorporation">Date of Incorporation
                                <span class="red-text">*</span></label>
                                <input id="date_of_incorporation" name="date_of_incorporation" type="text" class="form-control datepicker" placeholder="Enter Date of Incorporation" autocomplete="off" value="{{ old('date_of_incorporation') }}">		                    
                            @error('date_of_incorporation')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group half-width">
                            <label for="legal_status"> Legal Status</label>
                            <input id="legal_status" name="legal_status" type="text" class="form-control" placeholder="Enter Legal Status" value="{{ old('legal_status') }}">		                    
                            @error('legal_status')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group half-width">
                            <label for="gst_no"> GST No.</label>
                            <input id="gst_no" name="gst_no" type="text" class="form-control" placeholder="Enter GST No. " value="{{ $subscription_details->gst_no }}">		                    
                            @error('gst_no')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group has-radio-group">
                            <span class="label">Number of years since Incorporation/Registration<span class="red-text">*</span></span>
                            <div class="custom-radio-wrapper">
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="less5" name="number_of_years_since_registration" type="radio" value="1" @if(old('number_of_years_since_registration') == '1') checked @endif>		                    
                                        <label for="less5">less than 5 years</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="5-10" name="number_of_years_since_registration" type="radio" value="2" @if(old('number_of_years_since_registration') == '2') checked @endif>		                    
                                        <label for="5-10">5-10 years</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="10plus" name="number_of_years_since_registration" type="radio" value="3" @if(old('number_of_year_since_registration') == '3') checked @endif>		                    
                                        <label for="10plus">more than 10 years</label>
                                    </div>
                                </div>
                            </div>
                            @error('number_of_years_since_registration')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group has-radio-group">
                            <span class="label">Average profit after tax (PAT) for last 3 years<span class="red-text">*</span></span>
                            <div class="custom-radio-wrapper">
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="less10" name="average_profit" type="radio" value="1" @if(old('average_profit') == '1') checked @endif>		                    
                                        <label for="less10">less than Rs. 10 lakhs</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="10-25" name="average_profit" type="radio" value="2" @if(old('average_profit') == '2') checked @endif>		                    
                                        <label for="10-25">Rs. 10-25 lakhs</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="25plus" name="average_profit" type="radio" value="3" @if(old('average_profit') == '3') checked @endif>		                    
                                        <label for="25plus">more than Rs. 25 lakhs</label>
                                    </div>
                                </div>
                            </div>
                            @error('average_profit')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group  has-radio-group">
                            <span class="label">Your comfortable holding investment horizon:<span class="red-text">*</span></span>
                            <div class="custom-radio-wrapper">
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="below12months" name="investment_period" type="radio" value="1" @if(old('investment_period') == '1') checked @endif>	                    
                                        <label for="below12months"> &lt; 12 Months</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="12-36Months" name="investment_period" type="radio" value="2" @if(old('investment_period') == '2') checked @endif>                  
                                        <label for="12-36Months">12-36 Months</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="above36months" name="investment_period" type="radio" value="3" @if(old('investment_period') == '3') checked @endif>		                    
                                        <label for="above36months">Over 36 Months</label>
                                    </div>
                                </div>
                            </div>
                            @error('investment_period')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        
                        
                        
                        <div class="form-group  has-radio-group">
                            <span class="label">What percentage of your surplus/investible funds are you looking to invest now?<span class="red-text">*</span></span>
                            <div class="custom-radio-wrapper">
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="below25percent" name="invest_net_worth" type="radio" value="1" @if(old('invest_net_worth') == '1') checked @endif>	                    
                                        <label for="below25percent"> &lt; 25%</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="25-50percent" name="invest_net_worth" type="radio" value="2" @if(old('invest_net_worth') == '2') checked @endif>                  
                                        <label for="25-50percent">25% - 50%</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="above50percent" name="invest_net_worth" type="radio" value="3" @if(old('invest_net_worth') == '3') checked @endif>		                    
                                        <label for="above50percent">&gt; 50%</label>
                                    </div>
                                </div>
                            </div>
                            @error('invest_net_worth')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group  has-radio-group">
                            <span class="label">What best describes your Risk Attitude?<span class="red-text">*</span></span>
                            <div class="custom-radio-wrapper full-width">
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="secure" name="risk_attitude" type="radio" value="1" @if(old('risk_attitude') == '1') checked @endif>		                    
                                        <label for="secure">SECURE : I seek complete safety of my capital with no negative returns</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="moderate" name="risk_attitude" type="radio" value="2" @if(old('risk_attitude') == '2') checked @endif>		                    
                                        <label for="moderate">MODERATE : I seek a balance of regular income and capital appreciation over medium term</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="aggressive" name="risk_attitude" type="radio" value="3" @if(old('risk_attitude') == '3') checked @endif>		                    
                                        <label for="aggressive">AGGRESSIVE : I am comfortable with volatility and seek aggressive returns over a long term</label>
                                    </div>
                                </div>
                            </div>
                            @error('risk_attitude')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>	
                        <div class="form-group  has-radio-group">
                            <span class="label">What best describes your Knowledge & Experience?<span class="red-text">*</span></span>
                            <div class="custom-radio-wrapper full-width">
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="limited" name="knowledge_experience" type="radio" value="1" @if(old('knowledge_experience') == '1') checked @endif>		                    
                                        <label for="limited">LIMITED : I have limited understanding & experience of financial investments</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="moderate" name="knowledge_experience" type="radio" value="2" @if(old('knowledge_experience') == '2') checked @endif>		                    
                                        <label for="moderate">MODERATE : I am comfortable with financial products & have fair understanding & experience in investments</label>
                                    </div>
                                </div>
                                <div class=" custom-radio-btn">
                                    <div class="radio-btn-inner">
                                        <input id="extensive" name="knowledge_experience" type="radio" value="3" @if(old('knowledge_experience') == '3') checked @endif>		                    
                                        <label for="extensive">EXTENSIVE : I have extensive knowledge & experience of financial products</label>
                                    </div>
                                </div>
                            </div>
                            @error('knowledge_experience')
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
        //JQuery.datepicker.formatDate( "dd-mm-yyyy");
        jQuery('#mobile-num').blur(function(){
            var phoneno = /^\d{10}$/;
            var inputtxt = jQuery(this).val();
            if((inputtxt.match(phoneno)))
            {
                jQuery('#mobile_no_error').html('');
            }
            else
            {
                jQuery('#mobile_no_error').html('The mobile no must be 10 digits.');
            }
        });
        jQuery('#subscription-form').submit(function(){
            var phoneno = /^\d{10}$/;
            var inputtxt = jQuery('#mobile-num').val();
            if((inputtxt.match(phoneno)))
            {
                return true;
            }
            else
            {
              return false;
            }

        });
    </script>
@endpush
@endsection