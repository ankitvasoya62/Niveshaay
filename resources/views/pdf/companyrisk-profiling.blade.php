<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Risk Profiling</title>
    
    <style>
        @media  screen and
        print {
            *,*:after,*:before {
                box-sizing:border-box;
            }
            h1 { font-size: 28px; text-align: center; font-weight: bold; line-height: 1.2; margin-bottom: 10px; color: #3b3b3b;  font-family: "Playfair Display", serif; }
            .subscription-form-section h1 span { display: block; }
            .custom-form-section .form-wrapper .form-outer-wrapper { display: block;}
            .white-shadow-card { background-color: #fff;padding:20px 15px; }
            .custom-form-section .form-outer-wrapper .form-group.half-width { width:50%;float: left;margin-right: -4px;}
            .clearfix{ clear: both; margin:0;padding:0;}
            .form-group label,.form-group .label { display: block;margin-bottom: 5px;color: #888;font-family: 'Open Sans',sans-serif;line-height: 1.38;display: block;font-size: 14px;padding:0 15px;margin-bottom: 5px;}
            .custom-form-section .form-wrapper .form-group .form-control {font-size:16px;width: 100%;font-family: 'Open Sans',sans-serif;color: #222121;padding:0 15px;}
            .custom-form-section .form-wrapper .form-group { margin-bottom: 20px;}
            .red-text {color: #b5111b;}
        }
    </style>
</head>
<body>
    <div class="subscription-form-section">
        <div class="niveshaay-container">
        <div class="image-wrapper" style="margin-bottom:12px;text-align:center">
                    <img src="{{ public_path('images/logo.png') }}" alt="logo" style="width:200px;height: auto;margin:0 auto"/>
                </div>
            <h1>Niveshaay Risk Profiling and <span>Suitability Assessment</span></h1>
            <div class="subscription-form-block custom-form-section">
                <div class="white-shadow-card form-wrapper">
                    
                    <div class="form-outer-wrapper">
                        <div class="form-group half-width">
                            <div class="label">Name of Investor<span class="red-text">*</span></div>
                            <div class="form-control">{{ $name_of_investor }}</div>
                            
                        </div>
                        
                        
                        <div class="form-group half-width">
                            <div class="label"> Email Address<span class="red-text">*</span></div>
                            <div class="form-control">{{ $email }}</div>
                        </div>
                        <div class="form-group half-width">
                            <div class="label">Mobile Number<span class="red-text">*</span></div>
                            <div class="form-control">{{ $mobile_no }}</div>
                        </div>
                        <div class="form-group half-width">
                        <div class="label">Full Street Address</div>
                            <div class="form-control">{{ $street_address }}</div>
                        </div>
                       
                        
                        <div class="form-group half-width">
                            <div class="label"> Please provide your PAN NO<span class="red-text">*</span></div>
                            <div class="form-control">{{ $pan_no }}</div>
                        </div>
                        <div class="form-group half-width">
                            <div class="label"> GST No.</div>
                            <div class="form-control">{{ $gst_no }}</div>
                        </div>
                        <div class="form-group half-width">
                            <div class="label">Do you have DEMAT Account?
                                <span class="red-text">*</span></div>
                            <div class="form-control">{{ !empty($is_demat_account) ? "Yes" : "No" }}</div>
                        </div>
                        <div class="form-group half-width">
                            <div class="label">DEMAT Account No</div>
                                
                            <div class="form-control">{{ $demat_account_no }}</div>
                        </div>
                        <div class="form-group half-width">
                            <div class="label">Date Of Incorporation</div>
                                
                            <div class="form-control">{{ $date_of_incorporation }}</div>
                        </div>
                        <div class="form-group half-width">
                            <div class="label">Legal Status</div>
                                
                            <div class="form-control">{{ $legal_status }}</div>
                        </div>
                        <div class="form-group">
                            <div class="label">Number of years since Incorporation/Registration<span class="red-text">*</span></div>
                            <div class="form-control">
                                @if($number_of_years_since_registration == 1)
                                    < 5 years
                                @elseif($number_of_years_since_registration == 2)
                                    5 - 10 years
                                @elseif($number_of_years_since_registration == 3)
                                    >10 years
                                @else
                                    ---
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label">Average profit after tax (PAT) for last 3 years
                                <span class="red-text">*</span></div>
                            <div class="form-control">
                                @if($average_profit == 1)
                                    less than Rs. 10 lakhs
                                @elseif($average_profit == 2)
                                    Rs. 10-25 lakhs
                                @elseif($average_profit == 3)
                                    more than Rs. 25 lakhs
                                @else
                                    ---
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label">State/UnionTerritory ( Please put in country also if outside India)<span class="red-text">*</span></div>
                            <div class="form-control">{{ $state }}</div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="label">Percentage of your liquid net worth you would like to invest?<span class="red-text">*</span></div>
                            <div class="form-control" >
                                @if($invest_net_worth == 1)
                                    < 25% 
                                @elseif($invest_net_worth == 2)
                                    25% - 50%
                                @elseif($invest_net_worth == 3)
                                    > 50% 
                                @else
                                ---
                                @endif
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label">What is your comfortable holding investments period?<span class="red-text">*</span></div>
                            <div class="form-control">
                                @if($investment_period == 1)
                                    < 12 months
                                @elseif($investment_period == 2)
                                    12 - 36 months
                                @elseif($investment_period == 3)
                                    > 36 months
                                @else
                                ---
                                @endif
                                
                            </div>
                            
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="label">What best describes your Risk Attitude?<span class="red-text">*</span></div>
                            <div class="form-control">
                                @if($risk_attitude == 1)
                                SECURE : I seek complete safety of my capital with no negative returns
                                @elseif($risk_attitude == 2)
                                MODERATE : I seek a balance of regular income and capital appreciation over medium term
                                @elseif($risk_attitude == 3)
                                AGGRESSIVE : I am comfortable with volatility and seek aggressive returns over a long term
                                @endif
                                
                            </div>
                        </div>	
                        <div class="form-group">
                            <div class="label">What best describes your Knowledge & Experience?<span class="red-text">*</span></div>
                            <div class="form-control">
                                @if($knowledge_experience == 1)
                                LIMITED : I have limited understanding & experience of financial investments
                                @elseif($knowledge_experience == 2)
                                MODERATE : I am comfortable with financial products & have fair understanding & experience in investments
                                @elseif($knowledge_experience == 3)
                                EXTENSIVE : I have extensive knowledge & experience of financial products
                                @endif
                                
                            </div>
                        </div>
                        
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>