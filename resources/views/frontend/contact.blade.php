@extends('frontend.layout.master')
@section('content')
    <section class="inner-page-banner-section contact-page-banner">
        <img  src="{{ asset('images/contact-banner.jpg')}}" alt="contact-banner">
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
                <div class="form-outer-wrapper">
                  <div class="form-group half-width">
                    <label for="name">First Name</label>
                    <input id="name" name="first_name" type="text" class="form-control" placeholder="First Name" value="{{old('first_name')}}" required>
                    @error('first_name')
                        <span class="error-message">*{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group half-width">
                    <label for="last-name">Last Name</label>
                    <input id="last-name" name="last_name" type="text" class="form-control" placeholder="Last Name" value="{{old('last_name')}}" required>
                    @error('last_name')
                        <span class="error-message">*{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" class="form-control" placeholder="Email Address" value="{{old('email')}}" required>
                    @error('email')
                        <span class="error-message">*{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="Message">Message</label>
                    <textarea id="Message" name="message" class="form-control" placeholder="Message" value="{{old('last_name')}}"></textarea>
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
                      508, SNS Platina, near Reliance Mart, <br>
                      Vesu, Surat, Gujarat 395007
                    </address>
                  </li>
                  <li>
                    <span>
                      <img src="{{ asset('images/email.svg')}}" alt="email">
                    </span>
                    <a href="{{url('mailto:info@niveshaay.com')}}">info@niveshaay.com
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
                <h3>Follow Us On:
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

