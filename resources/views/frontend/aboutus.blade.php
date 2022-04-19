@extends('frontend.layout.master')
@section('content')
<section class="about-page-banner-section">
	<div class="bg-img">
		<img src="{{ asset('images/slider3.jpg')}}" alt="banner-img">
	</div>
	<div class="niveshaay-container">
		<div class="home-banner-content">
			<h2>About Us</h2>
			<p> Niveshaay Investment Advisors
			</p>
		</div>
	</div>
</section>

<div id="content-main-wrap" class="is-clearfix">
	<div id="content-area" class="site-content-area">
		<section class="niveshaay-welcome-block niveshaay-gray-bg video-block-section niveshaay-section-paddding">
			<div class="niveshaay-container">
				<h1 class="heading-title niveshaay-section-title">Welcome To Niveshaay</h1>
				<p>Niveshaay (in Hindi translates to income from investments) is a SEBI Registered boutique Investment Advisory Firm with a Dedicated Research Team of 12+ young creative like-minded professionals advising on over Rs. 200+ crores of AUM. Our core focus is on small-mid cap stocks which has the potential of giving outsized returns in long term. Our approach of Research based Investing and Second Order Thinking has helped us find companies that delivered great returns.  </p>
				<ul>
					<li>Direct Equity Portfolio Advisory</li>
					<li>Portfolio Restructuring</li>
					<li>Research Portfolio</li>
					<li>Family Office Portfolio Consultancy</li>
				</ul>
				<div class="video-wrapper">
					<iframe src="https://www.youtube.com/embed/EgDqm9H1T0s" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
			</div>
		</section>
		<section class="founder-info-section niveshaay-gray-bg">
			<div class="niveshaay-container">
				<div class="founder-info-wrapper">
					<div class="founder-image">
						<img src="{{ asset('images/arvind-kothari.jpg')}}" alt="arvind-kothari">
					</div>
					<div class="founder-text">
						<h2 class="heading-title niveshaay-section-title">Arvind Kothari</h2>
						<p class="green-text">Founder and Director
						<span>B.COM, CA, CWA</span>
						<span>Former Industry Research Analyst at ICICI Bank</span></p>
						<p>“Over 12 years of experience in Equity Research and Investment Advisory, he started his journey as an Industry Research Analyst at ICICI Bank. Nearly a decade ago, after working in the finance industry and understanding its nuances, it caught his observation and interest that the wealth management industry was a little complex for investors to understand which induced him to quit his job. He then, started with advising on wealth management and leading investments for his family & friends. That’s how Niveshaay was born. He has a firm belief that taking entrepreneur calls work better than questioning quarterly performance like an analyst and has developed that culture in the enterprise too.”</p>
					</div>
				</div>
			</div>
		</section>
		<section class="our-team-section niveshaay-section-paddding">
			<div class="niveshaay-container">
				<h2 class="heading-title niveshaay-section-title">Our Team</h2>
				<div class="team-slider-wrapper">
					<div class="team-member-wrapper">
						<div class="team-member-inner">
							<div class="member-photo">
								<img src="{{ asset('images/sahil-jain.jpg') }}" alt="team-meber-photo">
							</div>
							<div class="member-detail">
								<h3 class="name">Sahil Jain</h3>
								<span>CA, B.COM</span>
								<p>Chennai based investor with an experience of over 8 years working with renowned
									investors community in equity market. Passionate about investing with strong
									fundamental research and analytical skills. 
								</p>
							</div>
						</div>
					</div>
					<div class="team-member-wrapper">
						<div class="team-member-inner">
							<div class="member-photo">
								<img src="{{ asset('images/bhavin-solanki.jpg') }} " alt="team-meber-photo">
							</div>
							<div class="member-detail">
								<h3 class="name">Bhavin Solanki </h3>
								<span>B.E. Mechanical</span>
								<p>Over 12 years of experience as a technical investor, he is widely recognized for
									his knowledge and work in the finance industry. He aptly combines the three
									inter-related trends of investing: Business Trend, Financial Trend & Price Trend
								</p>
							</div>
						</div>
					</div>
					<div class="team-member-wrapper">
						<div class="team-member-inner">
							<div class="member-photo">
								<img src="{{ asset('images/vikram-sharma.jpg') }}" alt="team-meber-photo">
							</div>
							<div class="member-detail">
								<h3 class="name">Vikram Sharma </h3>
								<span>CS, CFA(US) L-II, B.Com</span>
								<p>Over 5 years of experience in equity research and portfolio management. He is widely
									recognized for his fundamental research work and analytical skills in the industry with
									a strong focus on emerging data points.
								</p>
							</div>
						</div>
					</div>
					<div class="team-member-wrapper">
						<div class="team-member-inner">
							<div class="member-photo">
								<img src="{{ asset('images/gunjan-kabra.jpg') }}" alt="team-meber-photo">
							</div>
							<div class="member-detail">
								<h3 class="name">Gunjan Kabra</h3>
								<span>CFA(US) L-II, B.Sc. Economics(NMIMS)</span>
								<p>Over 6 years of experience in the equity market and is widely known for her research
									reports in the industry. During the course, she refined her research process and learnt
									the intricacies of building different businesses. 
								</p>
							</div>
						</div>
					</div>
					<div class="team-member-wrapper">
						<div class="team-member-inner">
							<div class="member-photo">
								<img src="{{ asset('images/ajay-surya.jpg') }}" alt="team-meber-photo">
							</div>
							<div class="member-detail">
								<h3 class="name">Ajay Surya </h3>
								<span>CFA(US) L-II, B.Com </span>
								<p>Research analyst with 4 years of experience in equity market. Working on various
									sectors and industries applying his strong research and analytical skills.
								</p>
							</div>
						</div>
					</div>
					<div class="team-member-wrapper">
						<div class="team-member-inner">
							<div class="member-photo">
								<img src="{{ asset('images/aditi-bhatted.jpg') }}" alt="team-meber-photo">
							</div>
							<div class="member-detail">
								<h3 class="name">Aditi Bhatted</h3>
								<span>CA, B.COM</span>
								<p>Former Credit manager at Capital First Ltd. Experience in financial and credit
									analysis, currently working in the areas of family office consultancy and research
									projects.
								</p>
							</div>
						</div>
					</div>
					<div class="team-member-wrapper">
						<div class="team-member-inner">
							<div class="member-photo">
								<img src="{{ asset('images/krishna-agarwal.jpg') }}" alt="team-meber-photo">
							</div>
							<div class="member-detail">
								<h3 class="name">Krishna Agrawal </h3>
								<span>CFA(US) L-II, BBA(Finance and Economics)</span>
								<p>Experience in working with various industries in the equity market. Holds a
									strong business understanding and research skills.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<!-- #content-area -->
@endsection