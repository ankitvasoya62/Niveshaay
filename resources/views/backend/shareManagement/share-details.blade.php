@extends('frontend.layout.master')
@section('content')
<section class="research-page-banner-section">
    <img src="{{ asset('images/dashboard-banner.jpg') }}" alt="banner-img">
    <div class="container">
        <h1>Our Research Reports</h1>
    </div>
</section>
<section class="research-page-wrapper">
    <div class="container">
    <div class="research-inner">
        <h2>Latest Additions</h2>
        <div class="research-image-grid">
            @foreach ($latest_addition as $share )
            <div class="research-item">
                @if($share->upload_type == 0)
                    <a href="{{ route('frontend.view.share',$share->id) }}" class="research-item-inner">
                        <img src="{{ asset('images/share-logo/'.$share->share_logo)}}" alt="research-icons">
                    </a>
                @else
                    @if($share->copy_to_our_research == 1)
                        <a href="{{ asset('pdf/'.$share->pdf_name) }}" class="research-item-inner" target="_blank">
                            <img src="{{ asset('images/share-logo/'.$share->share_logo)}}" alt="research-icons">
                        </a>
                    @else
                        <a href="{{ route('frontend.generate-pdfwatermark',$share->id) }}" class="research-item-inner" target="_blank">
                            <img src="{{ asset('images/share-logo/'.$share->share_logo)}}" alt="research-icons">
                        </a>
                    @endif
                @endif
            </div>    
            @endforeach
            

        </div>
    </div>
    <div class="research-inner">
        <h2>Current Recommendations</h2>
        <div class="research-image-grid">
            @foreach ($current_recommendation as $share)
                <div class="research-item">
                    <div class="research-item-inner">
                        @if($share->upload_type == 0)
                            <a href="{{ route('frontend.view.share',$share->id) }}" class="research-item-inner">
                                <img src="{{ asset('images/share-logo/'.$share->share_logo)}}" alt="research-icons">
                            </a>
                        @else
                            @if($share->copy_to_our_research == 1)
                                <a href="{{ asset('pdf/'.$share->pdf_name) }}" class="research-item-inner" target="_blank">
                                    <img src="{{ asset('images/share-logo/'.$share->share_logo)}}" alt="research-icons">
                                </a>
                            @else
                                <a href="{{ route('frontend.generate-pdfwatermark',$share->id) }}" class="research-item-inner" target="_blank">
                                    <img src="{{ asset('images/share-logo/'.$share->share_logo)}}" alt="research-icons">
                                </a>
                            @endif
                        @endif
                    </div>
                </div>    
            @endforeach
            
        </div>
    </div>
    <div class="research-inner">
        <h2>Quarterly Results</h2>
        <div class="research-image-grid">
            @foreach ($quaterly_results as $share)
                <div class="research-item">
                    <div class="research-item-inner">
                        @if($share->upload_type == 0)
                            <a href="{{ route('frontend.view.share',$share->id) }}" class="research-item-inner">
                                <img src="{{ asset('images/share-logo/'.$share->share_logo)}}" alt="research-icons">
                            </a>
                        @else
                            @if($share->copy_to_our_research == 1)
                                <a href="{{ asset('pdf/'.$share->pdf_name) }}" class="research-item-inner" target="_blank">
                                    <img src="{{ asset('images/share-logo/'.$share->share_logo)}}" alt="research-icons">
                                </a>
                            @else
                                <a href="{{ route('frontend.generate-pdfwatermark',$share->id) }}" class="research-item-inner" target="_blank">
                                    <img src="{{ asset('images/share-logo/'.$share->share_logo)}}" alt="research-icons">
                                </a>
                            @endif
                        @endif
                    </div>
                </div>    
            @endforeach
            
        </div>
    </div>
    <div class="research-inner">
        <h2>Past Recommendations</h2>
        <div class="research-image-grid">
            @foreach ($past_recommendation as $share)
            <div class="research-item">
                <div class="research-item-inner">
                    @if($share->upload_type == 0)
                        <a href="{{ route('frontend.view.share',$share->id) }}" class="research-item-inner">
                            <img src="{{ asset('images/share-logo/'.$share->share_logo)}}" alt="research-icons">
                        </a>
                    @else
                        @if($share->copy_to_our_research == 1)
                            <a href="{{ asset('pdf/'.$share->pdf_name) }}" class="research-item-inner" target="_blank">
                                <img src="{{ asset('images/share-logo/'.$share->share_logo)}}" alt="research-icons">
                            </a>
                        @else
                            <a href="{{ route('frontend.generate-pdfwatermark',$share->id) }}" class="research-item-inner" target="_blank">
                                <img src="{{ asset('images/share-logo/'.$share->share_logo)}}" alt="research-icons">
                            </a>
                        @endif
                    @endif
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
    </div>
</section>
@endsection