<!DOCTYPE html>
<html lang="en" class="no-js no-svg">
<head>
	<title>Investment Expert | Niveshaay | Surat</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="{{asset('/favicon.ico')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/css/niveshaay-general.css')}}">
	<link href="{{asset('/css/googlefonts.css')}}" rel="stylesheet">
    @stack('css')
    @stack('headJs')
</head>
<body class="footer-widgets footer-background dark-color widget-7 {{ Route::is('frontend.signup') ? 'page-signup' : ''}}">
<!-- <div class="pageloader is-active"></div> -->
<div id="site-wrap" class="site">
	<div id="header-wrap" class="is-clearfix">
	<header class="niveshaay-header">
		<div class="container">
			<div class="header-wrapper">
				<div class="logo-wrapper">
					<a class="site-logo" href="{{route('frontend.home')}}" title="Logo">
						<img src="{{url('images/logo.png')}}" alt="Site- Logo">
					</a>
				</div>
				<div class="right-header-wrapper">
					<div class="navigation-wrapper">
						<nav class="bottom-header-wrapper">
							<ul>
								<li class="@if($active=='home') active @endif">
									<a href="{{route('frontend.home')}}" title="Home" class="active">Home</a>
								</li>
								<li class="@if($active=='about') active @endif">
									<a href="{{route('frontend.about')}}" title="About Us">About Us</a>
								</li>
								<li class="@if($active=='services') active @endif">
									<a href="{{ route('frontend.services') }}" title="Services">Services</a>
								</li>
								<li class="@if($active=='our-strategy') active @endif">
									<a href="{{route('frontend.our-strategy')}}" title="Research Process">Our Strategy
									</a>
								</li>
								@if (Auth::user())
									<li class="@if($active=='share-details') active @endif">
										<a href="{{route('frontend.share-detail')}}" title="Our Research">Our Research
										</a>
									</li>
								@endif
								<li>
									<a href="{{ asset('blog') }}" title="Blogs">Blog</a>
								</li>
								<li class="@if($active=='contact') active @endif">
									<a href="{{route('frontend.contact')}}" title="Contact Us">Contact Us</a>
								</li>
								@if (!Auth::user())
									
								<li class=" btn btn-border">
									<a href="#" title="Login/Signup" data-link="login-modal" class="modal-link">Login/Signup </a>
									{{-- <a href="{{ route('login') }}" title="Login/Signup">Login/Signup </a> --}}
								</li>
								@endif
								<li class=" btn btn-green" @if(Auth::user()) style="margin-left:42px" @endif>
									<a href="https://niveshaay.smallcase.com/" title="Visit smallCase" target="_blank">Visit Smallcase </a>
								</li>
								
							</ul>
						</nav>
						<div class="hamburger">
							<span class="bar1"></span>
							<span class="bar2"></span>
							<span class="bar3"></span>
						</div>
						@if (Auth::user())
						
						<div class="user-dropdown-wrapper">
							<a class="dropdown-link" href="#">
								<em class="profile-icon"><img src="{{ !empty(Auth::user()->profile_photo) ? asset('images/profile-photos/'.Auth::user()->profile_photo) : asset('images/blankuser.jpeg') }}" alt="profile-icon"></em> 
								<span>{{ Auth::user()->name }}</span>								
							</a>
							<div class="user-dropdown">
								<ul>
									<li class="@if($active=='profile') active @endif"><a href="{{route('frontend.profile')}}" title="My Profile">My Profile</a></li>
									<li class="@if($active=='change-password') active @endif"><a href="{{route('frontend.changepasswordform')}}" title="Change Password">Change Password</a></li>
									<li>
										<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
											Logout
										</a>
										
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
										</form>
									</li>
								</ul>
							</div>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</header>
</div>
@if (!Auth::user())
<div id="login-modal" class="custom-modal" data-tab="login-modal">
	<div class="modal-backdrop"></div>
	<div class="modal-content">
			<div class="modal-content-inner">
				<div class="modal-body custom-form-section">
						<a href="#" title="close" class="modal-close">
							<img src="{{ asset('images/close.svg')}}" alt="close-btn">
						</a>
						<div class="form-wrapper">
							<div class="form-inner-wrapper">
								<a class="site-logo" href="#" title="Logo">
									<img src="{{ asset('images/logo.png') }}" alt="Site- Logo">
								</a>
								<p>Log in to Niveshaay</p>
								<form class="contact-us-form" method="POST" action="{{ route('login')}}">@csrf
									<div class="form-outer-wrapper">
										<div class="form-group">
											<label for="email_or_phone_no">Email Address</label>
											<input id="email_or_phone_no" name="email" type="text" class="form-control" placeholder="Enter email" required>		                    
											
											<span style="color:red" id='login-modal-email-error'></span>
											
										</div>
										<div class="form-group">
											<label for="password">Password</label>
											<input id="password" name="password" type="password" class="form-control" placeholder="**********" required>			
											
											<span style="color:red" id="login-modal-error"></span>
											
											
										</div>
										<div class="form-group has-checkbox">
											{{-- <div class="checkbox-wrapper">
												<div class="checkbox-inner">
													<input type="checkbox" class="form-control" id="checkbox" checked>
													<label for="checkbox">Subscribe Newsletter</label>
												</div>
											</div> --}}
											<span class="password-help"><a href="{{ route('password.request') }}" title="password-help">Forgot Password?</a></span>
										</div>
										<div class="form-group form-btn-wrapper">
											<button type="submit" class="btn btn-border">Login</button>
											<button type="button" class="btn btn-border signup-link" data-link="signup-modal" onclick="location.href = '{{ route('frontend.signup')}}' ">Sign Up</button>
										</div>                
									</div>
								</form>
							</div>
						</div>
				</div>
			</div>
		</div>
</div>
@endif
<div class="main-wrapper">