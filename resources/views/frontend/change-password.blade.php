@extends('frontend.layout.master')
@section('content')
<section class="forgot-page custom-form-section">
  <div class="form-wrapper">
                    <div class="form-inner-wrapper">
                      <a class="site-logo" href="#" title="Logo">
                        <img src="{{ asset('images/logo.png') }}" alt="Site- Logo">
                      </a>
                      <p>Create a New Password</p>
                      <form class="contact-us-form" action="{{ route('frontend.changepassword') }}" method="POST">@csrf
                        @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif
                        <div class="form-outer-wrapper">
                          
                          <div class="form-group">
                            <label for="password">New Password</label>
                            <input id="password" type="password" class="form-control" name="password">
                            
                            @error('password')
                                <span style="color:red">{{ $message }}</span>
                            @enderror	           		                    
                          </div>
                          <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                            
                            @error('password_confirmation')
                                <span style="color:red">{{ $message }}</span>
                            @enderror	           		                    
                          </div>
                          
                          <div class="form-group form-btn-wrapper">
                            <button type="submit" class="btn btn-border">Update Password</button>
                            
                          </div>                
                        </div>
                      </form>
                    </div>
  </div>
</section>

@endsection    