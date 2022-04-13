@extends('frontend.layout.master')
@push('css')
<style>  
    @media print  
    {  
    iframe {display:none;}  
    }  
    </style> 
@endpush
@section('content')
<section class="share-detail-page-wrapper">
        <div class="niveshaay-container">
            <div class="share-detail-title-wrapper">
                <a href="#" title="logo" class="borosil-logo">
                    <img src="{{ asset('images/share-logo/'.$share->share_logo)}}" alt="borosil-logo">
                </a>
                <h1 class="heading-title niveshaay-section-title"><span>{{ $share->share_title}} </span>
                    
                </h1>
                <ul class="date-wrapper">
                        <li>{{ date('F d, Y',strtotime($share->share_date))}}</li>
                        <li >
                            <a href="#" class="icon" title="bookmark-icon">
                                <i class="far fa-bookmark bookmark"></i>
                                <i class="fas fa-bookmark bookmark-hover"></i>
                            </a>
                        </li>
                </ul>
            </div>
            <div class="share-detail-content-wrapper">
                <div class="share-detail-content-inner">
                    <div class="share-detail-left-col cms-page-content">
                        <div class="left-col-inner summer-note-content">
                            <p><img src="{{ asset('images/share-images/'.$share->share_image)}}" alt="share-detail-image"></p>
                            {!! $share->share_description !!}
                            

                            {{-- <iframe src='{{ asset('pdf/'.$share->share_description.'#embedded=true&toolbar=0&navpanes=0') }}' style="width:100%;height:500px" allowfullscreen id="disablingiframe">
                                
                            </iframe>
                            
                            <a href="{{ asset('pdf/'.$share->share_description.$encode) }}" target="_blank">Share Detail Pdf</a>
                             --}}

                            <div class="cms-border-box">
                                <h2 class="has-green-title">Disclaimer:</h2>
                                <p><strong>Niveshaay is a SEBI Registered (SEBI Registration No. INA000008552) Investment Advisory Firm. </strong>The research and reports express our opinions which we have based upon generally available public information, field research, inferences and deductions through are due 
                                    diligence and analytical process. To the best our ability and belief, all information contained here is accurate and reliable, and has been obtained from public sources we believe to be accurate and reliable. We make no representation, express or implied, as to the accuracy, 
                                    timeliness, or completeness of any such information or with regard to the results obtained from its use. This report does not represent an investment advice or a recommendation or a 
                                solicitation to buy any securities.</p>
                            </div>
                        </div>
                    </div>
                    <div class="share-detail-right-col">
                        <div class="right-col-inner">
                            <div class="data-wrapper">
                                <h2>Key Data</h2>
                                <ul>
                                    <li>
                                        <div class="data-title">Industry :</div>
                                        <div class="data-content">{{ $share->share_industry}}</div>
                                    </li>
                                    <li>
                                        <div class="data-title">CMP :</div>
                                        <div class="data-content">{{ $share->share_cmp }}</div>
                                    </li>
                                    <li>
                                        <div class="data-title">Market Cap (Cr) : </div>
                                        <div class="data-content">Rs. {{ $share->share_market_cap }}</div>
                                    </li>
                                    <li>
                                        <div class="data-title">52 –Week High/Low: </div>
                                        <div class="data-content">Rs. {{ $share->share_week_high_low }}</div>
                                    </li>
                                    <li>
                                        <div class="data-title">Outlook: </div>
                                        <div class="data-content">{{ $share->share_outlook }} </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="data-wrapper">
                                <h2>Shareholding Pattern</h2>
                                <ul>
                                    <li>
                                        Promoters: {{ $share->shareholding_promoters }}%
                                    </li>
                                    <li>
                                        Public: {{ $share->shareholding_public }}%
                                    </li>
                                </ul>
                            </div>
                            <div class="data-wrapper">
                                <h2>Research Analyst</h2>
                                <div class="data-wrapper-inner">
                                    <span>{{ $share->research_analyst_name}} </span>
                                    <span>{{ $share->research_analyst_designation }}</span>
                                    <a class="email-id-link" href="mailto:{{ $share->research_analyst_email }}" title="email-id">{{ $share->research_analyst_email }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
@push('js')
    <script type="module">
        // jQuery('iframe').keydown(function(e){
        //     if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        //             e.preventDefault();
        //     }
        //     if ((e.ctrlKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        //             e.preventDefault();
        //     }
        // });
        document.oncontextmenu = function() { 
            alert("Not allowed");
            return false;  
        }; 
        jQuery(document).on('keydown', function(e) {
            if((e.ctrlKey || e.metaKey) && (e.key == "p" || e.key == "P" || e.key == "s" || e.key == "S" || e.key == "u" || e.key == "U" || e.charCode == 16 || e.charCode == 112 || e.keyCode == 80) ){
                alert("Not allowed");
                e.cancelBubble = true;
                e.preventDefault();

                e.stopImmediatePropagation();
            }
            if (event.keyCode == 123) { // Prevent F12
                alert("Not allowed");
                e.cancelBubble = true;
                e.preventDefault();

                e.stopImmediatePropagation();
            } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
                alert("Not allowed");
                e.cancelBubble = true;
                e.preventDefault();

                e.stopImmediatePropagation();
            }  
        });
        // var frame = jQuery('#disablingiframe');
        // var contents = frame.contents();
        // var body = contents.find('body').attr('oncontextmenu',"return false;");
        // var body = contents.find('body').append('<div>New Div</div>');
    </script>
@endpush