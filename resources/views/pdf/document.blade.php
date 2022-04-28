<!DOCTYPE html>
<html>
<head>
    <title>laravel MPDF</title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ public_path('css/pdf.css') }}" rel="stylesheet">

    <style>
        @media  screen,
        print {
        	.title{
                color:#069;
                font-weight:bold; 
            }
            .description{
                color:#000;
                font-weight: 400;
            }
            @page  {
                margin: 0;
            }

            * {
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }
            .rupee-icon {
                width: 10px;
            }
            .rupee-icon img {
                width: 10px;
            }
            body {
                margin: 0;
                font-family: 'opensans';
                -webkit-print-color-adjust: exact;
            }
            .left-block{
                width: 45%;
                float: left;
                margin-right: -4px;
                vertical-align: middle;
            }
            .right-block{
                width: 55%;
                float: right;
                margin-right: -4px;
            }
            .clearfix{
                clear: both;
                margin:0;
                padding:0;
            }
            .pdf-container{
                width: 100%;
                margin:0 auto;
                max-width: 100%;
                padding:0 30px;
            }
            .advisor-block{
                width: 75%;
                float: left;
                margin-right: -4px;
                vertical-align: middle;
            }
            .billing-block{
                width: 25%;
                float: right;
                margin-right: -4px;
            }
            h1{
                font-size: 32px;
                background-color: transparent;
                margin:0;
                font-weight: 700;
   				color:#fff;
   				margin:0 0 10px;
   				font-family: 'opensans';
            }
            h2{
                font-size: 20px;
                color:#7eb33e;
                font-weight: 700;
                font-family: 'opensans';
                letter-spacing: 0;
                margin:0 0 10px;
            }
            p{
                font-size: 14px;
                margin:0;
                font-weight: 400;
                line-height: normal;
                color:#222121;
            }
            .table thead tr{
                background-color: #fafafa;
            }
            .table th{
                font-size: 14px;
                font-weight: 600;
                text-transform: uppercase;
                padding:15px;
                text-align: left;
            }
            .table td{
                font-size: 12px;
                padding:15px 20px;
                text-align: left;
                border-top:1px solid #e1e1e1;
            }
            .table td p{
                font-size: 12px;
            }
            .green-bar{
                height:25px;
                position: fixed;
                bottom:0;
                background-color: #7eb33e;
                width:100%;
            }
            .right-green-block{
                margin:0 0 40px;
            }
            .total-block{
                padding:10px 15px;
                font-size: 12px;
                color:#fff;
            }
            .invoice-details .invoice-inner{
            	color:#fff;
            	font-size:14px;
            }
            .invoice-details .left{
            	width: 25%;
            	float: left;
            	margin-right: -4px;
            }
            .invoice-details .right{
            	width: 75%;
            	float: right;
            	margin-right: -4px;
            }
        }
    </style>
</head>
<body>
    <div class="page-wrapper" style="padding-bottom: 25px;">
        <div class="float-block" style="margin-bottom: 40px;">
            <div class="left-block">
                <div class="image-wrapper" style="padding:30px;">
                    <img src="{{ public_path('images/logo.png') }}" alt="" style="width:200px;height: auto;"/>
                </div>
            </div>
            <div class="right-block">
                <div class="right-block-inner" style="background-image:url('{{ public_path('images/green-invoice.png') }}');background-repeat: no-repeat;background-size:150%;padding:20px 0 30px 110px;">
                    <h1><strong>Invoice</strong></h1>
                    <div class="invoice-details">
                        <div class="invoice-inner">
                            <div class="left">GSTIN:</div>
                            <div class="right">24AA0FN2865N3ZL</div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="invoice-inner">
                            <div class="left">Invoice No:</div>
                            <div class="right">{{ $invoice_no }}</div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="invoice-inner">
                            <div class="left">Date:</div>
                            <div class="right">{{ date('d F, Y') }}</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div> 
        <div class="pdf-container">
            <div class="advisor-billing-block" style="margin-bottom: 40px;">
                <div class="advisor-block">
                    <h2><strong>Niveshaay Investment Advisors</strong></h2>
                    <p>508, SNS Platina, Nr. Someshwara Enclave, Vesu,</p>
                    <p>Surat, Gujarat - 395007</p>
                </div>
                <div class="billing-block">
                    <h2><strong>Billed To</strong></h2>
                    <p><strong>{{ $name_of_investor }}</strong></p>
                    <p>PAN: {{ $pan_no }}</p>
                    
                    <p>{{ $state }}</p>
                    @if(!empty($gst_no))<p>GSTIN: {{ $gst_no }}</p>@endif
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="table-wrapper">
                <table class="table" cellspacing="0" cellpadding="0" style="width: 100%;border:1px solid #e1e1e1;" width="100%">
                    <thead>
                        <tr>
                            <th width="10%">Sr.No</th>
                            <th width="67%">Description</th>
                            <th width="23%">Amount</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ( $table_data as $key=>$value )
                            <tr>
                                <td width="10%">{{ $key + 1 }}.</td>
                                <td width="80%"><p>{!! nl2br($value['description']) !!}</p><p>{{ date('d F, Y',strtotime($value['subscription_start_date'])) }} to {{ date('d F, Y',strtotime($value['subscription_end_date'])) }} </p></td>
                                <td width="20%"><div class="price-block"><em class="rupee-icon" style=""><img width="5" src="{{ public_path('images/rupee-icon.png') }}" alt="rupee-icon" style="display:inline"></em> {{ number_format($value['amount'],2) }}</div></td>                                
                            </tr>
                        @endforeach
                        
                        {{-- <tr>
                            <td width="10%">02.</td>
                            <td width="80%"><p>6 Months Subcription for Mid and Samll Cap Focused Portfolio</p><p>14 Mar,2022 to 14 Sep,2022</p></td>
                            <td width="20%"><div class="price-block"><em class="rupee-icon" style=""><img width="5" src="{{ public_path('images/rupee-icon.png') }}" alt="rupee-icon" style="display:inline"></em> 4236.44</div></td>                                
                        </tr>
                        <tr>
                            <td width="10%">03.</td>
                            <td width="80%"><p>6 Months Subcription for Mid and Samll Cap Focused Portfolio</p><p>14 Mar,2022 to 14 Sep,2022</p></td>
                            <td width="20%"><div class="price-block"><em class="rupee-icon" style=""><img width="5" src="{{ public_path('images/rupee-icon.png') }}" alt="rupee-icon" style="display:inline"></em> 4236.44</div></td>                                
                        </tr>
                        <tr>
                            <td width="10%">04.</td>
                            <td width="80%"><p>6 Months Subcription for Mid and Samll Cap Focused Portfolio</p><p>14 Mar,2022 to 14 Sep,2022</p></td>
                            <td width="20%"><div class="price-block"><em class="rupee-icon" style=""><img width="5" src="{{ public_path('images/rupee-icon.png') }}" alt="rupee-icon" style="display:inline"></em> 4236.44</div></td>                                
                        </tr>
                        <tr>
                            <td width="10%">05.</td>
                            <td width="80%"><p>6 Months Subcription for Mid and Samll Cap Focused Portfolio</p><p>14 Mar,2022 to 14 Sep,2022</p></td>
                            <td width="20%"><div class="price-block"><em class="rupee-icon" style=""><img width="5" src="{{ public_path('images/rupee-icon.png') }}" alt="rupee-icon" style="display:inline"></em> 4236.44</div></td>                                
                        </tr> --}}
                    </tbody>
                </table>
            </div>
            <div class="summary-block" style="display: block;text-align: right;">
                <div class="right-green-block" style="width:240px;background-color: #7eb33e;text-align: left;margin-left: auto;">
                    <div class="total-block">
                        <div class="left-block">SubTotal:</div>
                        <div class="right-block"><em class="rupee-icon"><img width="5" src="{{ public_path('images/rupee-icon-white.png') }}" alt="rupee-icon"></em> {{ number_format($amount,2) }}</div>
                        <div class="clearfix"></div>
                    </div>
                    @if($state == 'Gujarat')
                        <div class="total-block" style="border-top:1px solid #fff;">
                            <div class="left-block">CGST @9%:</div>
                            <div class="right-block"><em class="rupee-icon"><img width="5" src="{{ public_path('images/rupee-icon-white.png') }}" alt="rupee-icon"></em> {{ number_format($cgst,2) }}</div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="total-block" style="border-top:1px solid #fff;">
                            <div class="left-block">SGST @9%:</div>
                            <div class="right-block"><em class="rupee-icon"><img width="5" src="{{ public_path('images/rupee-icon-white.png') }}" alt="rupee-icon"></em> {{ number_format($sgst,2) }}</div>
                            <div class="clearfix"></div>
                        </div>
                    @else
                        <div class="total-block" style="border-top:1px solid #fff;">
                            <div class="left-block">IGST @18%:</div>
                            <div class="right-block"><em class="rupee-icon"><img width="5" src="{{ public_path('images/rupee-icon-white.png') }}" alt="rupee-icon"></em> {{ number_format($igst,2) }}</div>
                            <div class="clearfix"></div>
                        </div>
                    @endif
                    <div class="total-block" style="border-top:1px solid #fff;">
                        <div class="left-block"><strong>Grand Total:</strong></div>
                        <div class="right-block"><strong><em class="rupee-icon"><img width="5" src="{{ public_path('images/rupee-icon-white.png') }}" alt="rupee-icon"></em> {{ number_format($total,2) }}</strong></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
	        {{-- <div class="terms-condition-block">
	            <h2>Terms & Conditions</h2>
	            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
	           	<p>sed do eiusmod tempor incididunt ut labore et</p>
	           	<p>dolore magna aliqua.</p>
	        </div>        --}}
        </div>
    </div>
    <div class="green-bar"></div>
</body>
</html>