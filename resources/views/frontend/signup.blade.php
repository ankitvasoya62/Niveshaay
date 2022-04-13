@extends('frontend.layout.master')
@section('content')
<section class="signup-page custom-form-section">
  <div class="form-wrapper">
                    <div class="form-inner-wrapper">
                      <a class="site-logo" href="#" title="Logo">
                        <img src="{{ asset('images/logo.png') }}" alt="Site- Logo">
                      </a>
                      <p>Create a New Account</p>
                      <form class="contact-us-form" action= "{{ route('user.register')}}" method="POST">@csrf
                        <div class="form-outer-wrapper">
                          <div class="form-group half-width">
                            <label for="first-name">First Name</label>
                            <input id="first-name" name="first_name" type="text" class="form-control" placeholder="First Name">	
                            @error('first_name')
                                <span style="color:red">{{ $message }}</span>
                            @enderror	                    
                          </div>
                          <div class="form-group half-width">
                            <label for="last-name">Last Name</label>
                            <input id="last-name" name="last_name" type="text" class="form-control" placeholder="Last Name">
                            @error('last_name')
                                <span style="color:red">{{ $message }}</span>
                            @enderror	           		                    
                          </div>
                          <div class="form-group half-width">
                            <label for="email-address">Email Address</label>
                            <input id="email-address" name="email" type="text" class="form-control" placeholder="Email Address">
                            @error('email')
                                <span style="color:red">{{ $message }}</span>
                            @enderror	           		                    
                          </div>
                          <div class="form-group half-width">
                            <label for="contact-no">phn-no</label>
                            <input id="contact-no" name="phone_no" type="number" class="form-control" placeholder="+91 | Phone Number">	
                            @error('phone_no')
                                <span style="color:red">{{ $message }}</span>
                            @enderror	           	                    
                          </div>
                          <div class="form-group half-width">
                            <label for="set-password">Set Password</label>
                            <input id="set-password" name="password" type="password" class="form-control" placeholder="Set Password">
                            @error('password')
                                <span style="color:red">{{ $message }}</span>
                            @enderror	           			
                          </div>
                          <div class="form-group half-width">
                            <label for="re-enter-password">Re-Enter Password</label>
                            <input id="re-enter-password" name="password_confirmation" type="password" class="form-control" placeholder="Re-Enter Password">
                            @error('password_confirmation')
                                <span style="color:red">{{ $message }}</span>
                            @enderror	           			
                          </div>
                          <div class="form-group has-checkbox half-width">
                            <div class="checkbox-wrapper">
                              <div class="checkbox-inner">
                                <input type="checkbox" class="form-control" id="checkbox" value="1" name="subscribe_news_letter" checked>
                                <label for="checkbox">Subscribe Newsletter</label>
                              </div>
                            </div>
                            
                          </div>
                          <div class="form-group form-btn-wrapper">
                            <button type="submit" class="btn btn-border">Sign Up</button>
                            <button type="submit" class="btn btn-border login-link" data-link="login-modal">Login</button>
                          </div>                
                        </div>
                      </form>
                    </div>
  </div>
</section>

@endsection    