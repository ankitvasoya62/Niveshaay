@extends('frontend.layout.master')
@section('content')
<section class="research-page-banner-section">
    <img src="{{ asset('images/dashboard-banner.jpg') }}" alt="banner-img">
    <div class="container">
        <h1>Our Research</h1>
    </div>
</section>
<section class="research-page-wrapper">
    <div class="container">
    <div class="research-inner">
        <h2>Latest Addition</h2>
        <div class="research-image-grid">
            @foreach ($latest_addition as $share )
            <div class="research-item">
                <a href="{{ route('frontend.view.share',$share->id) }}" class="research-item-inner">
                    <img src="{{ asset('images/share-logo/'.$share->share_logo)}}" alt="research-icons">
                </a>
            </div>    
            @endforeach
            

        </div>
    </div>
    <div class="research-inner">
        <h2>Current Recommendation</h2>
        <div class="research-image-grid">
            @foreach ($current_recommendation as $share)
                <div class="research-item">
                    <div class="research-item-inner">
                        <a href="{{ route('frontend.view.share',$share->id) }}"><img src="{{ asset('images/share-logo/'.$share->share_logo)}}" alt="research-icons"></a>
                    </div>
                </div>    
            @endforeach
            
        </div>
    </div>
    <div class="research-inner">
        <h2>Past Recommendation</h2>
        <div class="research-image-grid">
            @foreach ($past_recommendation as $share)
            <div class="research-item">
                <div class="research-item-inner">
                    <a href="{{ route('frontend.view.share',$share->id) }}"><img src="{{ asset('images/share-logo/'.$share->share_logo)}}" alt="research-icons"></a>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
    </div>
</section>
@endsection