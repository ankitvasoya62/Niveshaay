@extends('frontend.layout.master')
@section('content')
<section class="forgot-page custom-form-section">
  <div class="form-wrapper">
                    <div class="form-inner-wrapper">
                      <a class="site-logo" href="#" title="Logo">
                        <img src="{{ asset('images/logo.png') }}" alt="Site- Logo">
                      </a>
                      <p>{{ __('Reset Password') }}</p>
                      <form class="contact-us-form" action="{{ route('password.email') }}" method="POST">@csrf
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="form-outer-wrapper">
                          
                          <div class="form-group">
                            <label for="email-address">Email Address</label>
                            <input id="email-address" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            
                            @error('email')
                                <span style="color:red">{{ $message }}</span>
                            @enderror	           		                    
                          </div>
                          
                          
                          <div class="form-group form-btn-wrapper">
                            <button type="submit" class="btn btn-border">{{ __('Send Password Reset Link') }}</button>
                            <button type="submit" class="btn btn-border login-link" data-link="login-modal">Login</button>
                          </div>                
                        </div>
                      </form>
                    </div>
  </div>
</section>

@endsection    