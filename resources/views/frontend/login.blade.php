<!DOCTYPE html>
<html lang="en" class="no-js no-svg">
<head>
	<title>Investment Expert | Niveshaay | Surat</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="https://assets.smallcase.com/images/publishers/niveshaay/favicon.ico">
	<link rel="stylesheet" type="text/css" href="{{asset('css/niveshaay-general.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Open+Sans:300,400&amp;v=1557517928137" rel="stylesheet">
</head>
<body>
<!-- <div class="pageloader is-active"></div> -->
<div id="site-wrap" class="site">
<div class="main-wrapper login-page-wrapper">
<div class="login-page">
    <section class="contact-us-section login-page-section">
         <div class="contact-us-content-wrapper login-content-wrapper">
            <div class="login-image">
                <img src="{{asset('images/login-image.jpg')}}" alt="login-image">
            </div>
            <div class="form-wrapper login-form-wrapper">
                <div class="logo-wrapper">
					<a class="site-logo" href="#" title="Logo">
						<img src="{{asset('images/logo.png')}}" alt="Site- Logo">
					</a>
                </div>
                <h1>
                    Log in to Niveshaay
                </h1>
                <p>Welcome back! Login with your data that you
                        entered during registration</p>
                <form class="login-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email_or_phone-number">Email Address / Phone Number</label>
                        <input id="email_or_phone-number" name="email" type="text" class="form-control" placeholder="Enter email or phone number">
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <span class="password-help"><a href="#" title="password-help">Forgot your password?</a></span>
                        <input id="password" name="password" type="password" class="form-control" placeholder="Enter your password">
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-green">Login</button>
                    </div>
                </form>
            </div>
          </div>
    </section>
</div>
</div>
	</div>
	</div>
</body>
</html>
