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
                        <div class="form-group half-width has-date-picker">
                            <div class="label">Date of Birth<span class="red-text">*</span></div>
                            <div class="form-control">{{ $dob }}</div>
                        </div>
                        <div class="clearfix"></div>
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
                            <div class="label"> Pincode<span class="red-text">*</span></div>
                            <div class="form-control">{{ $pin_code }}</div>
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
                            <div class="label">Age<span class="red-text">*</span></div>
                            <div class="form-control">
                                @if($age == 1)
                                    < 30 years
                                @elseif($age == 2)
                                    30 - 60 years
                                @elseif($age == 3)
                                    >60 years
                                @else
                                    ---
                                @endif
                            </div>
                        </div>
                        <div class="form-group half-width">
                            <div class="label"> Select your sources of income<span class="red-text">*</span></div>
                            <div class="form-control">{{ $source_of_income }}</div>
                        </div>
                        <div class="form-group">
                        <div class="label">State/UnionTerritory ( Please put in country also if outside India)<span class="red-text">*</span></div>
                            <div class="form-control">{{ $state }}</div>
                        </div>
                        <div class="form-group">
                            <div class="label"> Select all the investments you currently hold<span class="red-text">*</span></div>
                            <div class="form-control">
                                <?php 
                                $currently_hold_investments = str_replace("MF","Mutual Funds",$currently_hold_investments);
                                $currently_hold_investments = str_replace("FD","Bank FD",$currently_hold_investments);
                                ?>
                                {{ $currently_hold_investments }}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label"> What is your annual income<span class="red-text">*</span></div>
                            <div class="form-control">
                                @if($annual_income == 1)
                                    < 10 Lacs
                                @elseif($annual_income == 2)
                                    10 Lacs - 50 Lacs
                                @elseif($annual_income == 3)
                                    50 Lacs - 1 Cr
                                @elseif($annual_income == 4)
                                    Above 1 Cr
                                @else
                                    ---
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label">What percentage of your income goes in repayment of existing liabilities like bank loans etc. ?<span class="red-text">*</span></div>
                            <div class="form-control">
                                @if($repayment_of_existing_liabilities == 1)
                                                > 50%
                                @elseif($repayment_of_existing_liabilities == 2)
                                    20 - 50%
                                @elseif($repayment_of_existing_liabilities == 3)
                                    < 20%
                                @else
                                    ---
                                @endif
                                
                            </div>
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
                            <div class="label">What is your investment objective?</div>
                            <div class="form-control">
                                @if($invest_objective == 1)
                                    Protect invested capital with very low chance of a loss (investment horizon - < 2 years)
                                @elseif($invest_objective == 2)
                                    Seek balance between invested capital growth and protection (investment horizon - 2-5 years)
                                @elseif($invest_objective == 3)
                                    Seek long term wealth creation with chances of higher short term loss (investment horizon - > 5 years)
                                @endif
                                {{-- {{ $invest_objective }} --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label">Pick a possible outcome along with potential capital drawdown for your investment - Average Return<span class="red-text">*</span></div>
                            <div class="form-control">
                                @if($invest_average_return == 1)
                                Avg Return - 7% Best Return - 12% Worst Return - (-5%)
                                @elseif($invest_average_return == 2)
                                Avg Return - 10% Best Return - 18% Worst Return - (-12%)
                                @elseif($invest_average_return == 3)
                                Avg Return - 12% Best Return - 22% Worst Return - (-19%)
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
                        <div class="form-group">
                            <div class="label">Do you confirm that your legal residential status allows you to take this advisory and invest in the Indian stock markets?<span class="red-text">*</span></div>
                            <div class="form-control">
                                {{ !empty($confirm_legal_residental_Status) ? "Yes" : "No"  }}
                            </div>
                        </div>				
                        <div class="form-group">
                            <div class="label">Have you suitably assessed by your own research, the ability and the knowledge of the advisor Mr Arvind Kothari to provide you with the required services<span class="red-text">*</span></div>
                            <div class="form-control">
                                {{ !empty($assesed_owned_research) ? "Yes" : "No"  }}
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label">Do you understand the Risk & Reward associated with Niveshaay's Investment Strategy?<span class="red-text">*</span></div>
                         
                            <div class="form-control">
                                {{ !empty($understand_risk_reward) ? "Yes" : "No"  }}
                                
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>