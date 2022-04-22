@extends('frontend.layout.master')
@section('content')
<section class="forgot-page custom-form-section">
  <div class="form-wrapper">
            <div class="form-inner-wrapper">
                <a class="site-logo" href="#" title="Logo">
                <img src="{{ asset('images/logo.png') }}" alt="Site- Logo">
                </a>
                <p>{{ __('Reset Password') }}</p>
                <form class="contact-us-form" action="{{ route('password.update') }}" method="POST">@csrf
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <div class="form-outer-wrapper">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                    <label for="email-address">Email Address</label>
                    <input id="email-address" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus readonly>
                    
                    @error('email')
                        <span style="color:red">{{ $message }}</span>
                    @enderror	           		                    
                    </div>
                    <div class="form-group">
                    <label for="password" class="col-md-4 col-form-label text-md-end">New {{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    
                    @error('password')
                        <span style="color:red">{{ $message }}</span>
                    @enderror	           		                    
                    </div>
                    <div class="form-group">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    @error('password_confirmation')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                              		                    
                    </div>
                    
                    <div class="form-group form-btn-wrapper">
                    <button type="submit" class="btn btn-border">{{ __('Reset Password') }}</button>
                    
                    </div>                
                </div>
                </form>
            </div>
  </div>
</section>

@endsection    