@extends('frontend.layout.master')
@section('content')
    <section class="inner-page-banner-section contact-page-banner">
        <img  src="{{ asset('images/Contact-us-Adjusted.jpg')}}" alt="contact-banner" class=" home-banner-contact">
        <img  src="{{ asset('images/contact-mobile-banner.jpg')}}" alt="contact-banner" class=" mobile-banner-contact">
        <div class="container">
            <h1>Contact Us</h1>
        </div>
    </section>
    <section class="contact-us-section">
        <div class="container">
          <div class="contact-us-content-wrapper custom-form-section">
            <div class="form-wrapper">
              <div class="form-inner-wrapper">
              <form class="contact-us-form" method="POST" action="{{route('frontend.contactForm')}}">
                @csrf
                @if(Auth::user())

                  <?php 
                    $name = explode(" ",Auth::user()->name);
                    $firstname = !empty($name[0]) ? $name[0] : "";
                    $lastname = !empty($name[1]) ? $name[1] : "";
                  ?>

                @endif
                <div class="form-outer-wrapper">
                  <div class="form-group half-width">
                    <label for="name">First Name</label>
                    <input id="name" name="first_name" type="text" class="form-control" placeholder="First Name" value="{{ !empty($firstname) ? $firstname : old('first_name') }}" required>
                    @error('first_name')
                        <span class="error-message">*{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group half-width">
                    <label for="last-name">Last Name</label>
                    <input id="last-name" name="last_name" type="text" class="form-control" placeholder="Last Name" value="{{ !empty($lastname) ? $lastname : old('last_name')}}" required>
                    @error('last_name')
                        <span class="error-message">*{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group half-width">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" class="form-control" placeholder="Email Address" value="{{ Auth::user() ? Auth::user()->email : old('email') }}" required>
                    @error('email')
                        <span class="error-message">*{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group half-width">
                    <label for="phone_no">Phone number</label>
                    <input id="phone_no" name="phone_no" type="text" class="form-control" placeholder="Contact number" value="{{ Auth::user() ? Auth::user()->phone_no : old('phone_no') }}" required>
                    @error('phone_no')
                        <span class="error-message">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="Message">Message</label>
                    <textarea id="Message" name="message" class="form-control" placeholder="Message" value="{{old('message')}}">{{old('message')}}</textarea>
                  </div>
                  <div class="form-group">
                    <button type="submit" id="submit" class="btn btn-green">Submit</button>
                  </div>
                </div>
              </form>
              @if (session('success'))
                <div class="alert-success">
                    {{session('success')}}
                </div>
                @elseif (session('error'))
                <div class="alert-danger">
                    {{session('error')}}
                </div>
                @endif
              </div>
            </div>
            <div class="get-in-touch-wrapper">
              <div class="title-wrapper">
                <h2>Get In Touch</h2>
              </div>
              <div class="content-wrapper">
                <ul class="get-in-touch-content">
                  <li>
                    <span class="icon">
                      <i class="icon-location-pin">
                      </i>
                    </span>
                    <address>
                      <a href="https://goo.gl/maps/kvtDT3CSsGG6wPkp8" target="_blank">
                      508, SNS Platina, near Reliance Mart, <br>
                      Vesu, Surat, Gujarat 395007
                      </a>
                    </address>
                  </li>
                  <li>
                    <span>
                      <img src="{{ asset('images/email.svg')}}" alt="email">
                    </span>
                    <a href="{{url('mailto:research@niveshaay.com')}}">research@niveshaay.com
                    </a>
                  </li>
                  <li>
                  <span>
                      <img src="{{ asset('images/phone.svg')}}" alt="phone">
                    </span>
                    <a href="tel:918200384930">(+91) 8200384930
                    </a>
                  </li>
                  <li>
                    <span>
                      <img src="{{ asset('images/phone.svg')}}" alt="phone">
                    </span>
                    <a href="tel:917990746384">(+91) 7990746384
                    </a>
                  </li>
                </ul>
                <h3>Follow us on:
                </h3>
                <ul class="social-icon-wrapper">
                  <li>
                    <a href="https://www.facebook.com/niveshaay/" target="_blank" title="facebook">
                      <span class="icon">
                        <i class="fab fa-facebook-f">
                        </i>
                      </span>
                    </a>
                  </li>
                  <li>
                    <a href="https://twitter.com/niveshaay" target="_blank" title="twitter">
                      <span class="icon">
                        <i class="fab fa-twitter">
                        </i>
                      </span>
                    </a>
                  </li>
                  <li>
                    <a href="https://www.instagram.com/niveshaay/?hl=en" target="_blank" title="instagram">
                      <span class="icon">
                        <i class="fab fa-instagram">
                        </i>
                      </span>
                    </a>
                  </li>
                  <li>
                    <a href="https://www.linkedin.com/company/14391848" target="_blank" title="linkedin">
                      <span class="icon">
                        <i class="fab fa-linkedin">
                        </i>
                      </span>
                    </a>
                  </li>
                  <li>
                    <a href="https://www.youtube.com/channel/UC8vnjpKi6JhsBLKr6zovAHQ" target="_blank" title="youtube">
                      <span class="icon">
                        <i class="fab fa-youtube">
                        </i>
                      </span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
@endsection

