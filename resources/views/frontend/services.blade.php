@extends('frontend.layout.master')
@section('content')
<section class="our-strategy-page-banner-section">
			<img src="{{ asset('images/our-services-banner.jpg') }}" alt="banner-img">
			<div class="container">
				<div class="banner-content">
					<h1>Our Services</h1>
					{{-- <p>Our Stocks Found Love With Great Value Investors</p> --}}
				</div>
			</div>
</section>
<section class="services-tabbing-section">
	<div class="niveshaay-container">
		<div class="service-tab-wrapper">
			<ul class="tab-heading-block">
				<li  class="@if($activeservice == 1) active @endif"><a href="#" title="equity-portfolio-tab" data-tab="equity-portfolio-advisory">
					<em>
						<img src="{{ asset('images/equity-portfolio-advisory.svg') }}" alt="tab-icon" class="tab-icon">
						<img src="{{ asset('images/equity-portfolio-advisory-white.svg') }}" alt="tab-icon" class="tab-icon-hover">
					</em>
					Equity Portfolio Advisory
					<span class="down-arrow-icon">
						
						<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
						<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							width="18.333px" height="10px" viewBox="246.833 251 18.333 10" enable-background="new 246.833 251 18.333 10"
							xml:space="preserve">
						<path class="down-arrow-svg" id="Down_Arrow_3_" fill="#84b645" d="M256,261c-0.213,0-0.427-0.082-0.589-0.244l-8.333-8.334
							c-0.326-0.325-0.326-0.853,0-1.178c0.325-0.325,0.853-0.326,1.178,0l7.744,7.745l7.744-7.745c0.326-0.326,0.854-0.326,1.179,0
							s0.325,0.853,0,1.178l-8.333,8.334C256.426,260.918,256.212,261,256,261L256,261z"/>
						</svg>
					</span>
				</a> </li>
				<li class="@if($activeservice == 2) active @endif"><a href="#" title="research-services-tab" data-tab="research-services">
					<em>
						<img src="{{ asset('images/research-services.svg') }}" alt="tab-icon" class="tab-icon">
						<img src="{{ asset('images/research-services-white.svg') }}" alt="tab-icon" class="tab-icon-hover">
					</em>
					Research Services
					<span class="down-arrow-icon">
						
						<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
						<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							width="18.333px" height="10px" viewBox="246.833 251 18.333 10" enable-background="new 246.833 251 18.333 10"
							xml:space="preserve">
						<path class="down-arrow-svg" id="Down_Arrow_3_" fill="#84b645" d="M256,261c-0.213,0-0.427-0.082-0.589-0.244l-8.333-8.334
							c-0.326-0.325-0.326-0.853,0-1.178c0.325-0.325,0.853-0.326,1.178,0l7.744,7.745l7.744-7.745c0.326-0.326,0.854-0.326,1.179,0
							s0.325,0.853,0,1.178l-8.333,8.334C256.426,260.918,256.212,261,256,261L256,261z"/>
						</svg>
					</span>
				</a></li>
				<li class="@if($activeservice == 3) active @endif"><a href="#" title="portfolio-listed-tab" data-tab="portfolio-listed-on-smallcase">
					<em>
						<img src="{{ asset('images/new_portfolio_listed_on_small_case.svg') }}" alt="tab-icon" class="tab-icon">
						<img src="{{ asset('images/portfolio-listed-smallcase-white.svg') }}" alt="tab-icon" class="tab-icon-hover">
					</em>
					Portfolio Listed on Smallcase
					<span class="down-arrow-icon">
						
						<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
						<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							width="18.333px" height="10px" viewBox="246.833 251 18.333 10" enable-background="new 246.833 251 18.333 10"
							xml:space="preserve">
						<path class="down-arrow-svg" id="Down_Arrow_3_" fill="#84b645" d="M256,261c-0.213,0-0.427-0.082-0.589-0.244l-8.333-8.334
							c-0.326-0.325-0.326-0.853,0-1.178c0.325-0.325,0.853-0.326,1.178,0l7.744,7.745l7.744-7.745c0.326-0.326,0.854-0.326,1.179,0
							s0.325,0.853,0,1.178l-8.333,8.334C256.426,260.918,256.212,261,256,261L256,261z"/>
						</svg>
					</span>
				</a></li>
				<li class="@if($activeservice == 4) active @endif"><a href="#" title="family-office-tab" data-tab="family-office-consulting">
					<em>
						<img src="{{ asset('images/family-office-consulting.svg') }}" alt="tab-icon" class="tab-icon">
						<img src="{{ asset('images/family-office-consulting-white.svg') }}" alt="tab-icon" class="tab-icon-hover">
					</em>
					Family Office Consulting
					<span class="down-arrow-icon">
						
						<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
						<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							width="18.333px" height="10px" viewBox="246.833 251 18.333 10" enable-background="new 246.833 251 18.333 10"
							xml:space="preserve">
						<path class="down-arrow-svg" id="Down_Arrow_3_" fill="#84b645" d="M256,261c-0.213,0-0.427-0.082-0.589-0.244l-8.333-8.334
							c-0.326-0.325-0.326-0.853,0-1.178c0.325-0.325,0.853-0.326,1.178,0l7.744,7.745l7.744-7.745c0.326-0.326,0.854-0.326,1.179,0
							s0.325,0.853,0,1.178l-8.333,8.334C256.426,260.918,256.212,261,256,261L256,261z"/>
						</svg>
					</span>
				</a></li>
			</ul>
			<div class="tab-content-block">
				<div class="tab-content-inner @if($activeservice == 1) active opacity @endif" data-id="equity-portfolio-advisory">
						<div class="tab-inner-detail">
							<h2>Small & Mid Cap focused portfolio</h2>
							<ul class="green-dot-listing">
								<li>Every business starts small and law of large numbers gives this space an opportunity to outperform and have outsized impact on the portfolio. </li>
								<li>We follow Research based Investing and have devised our own strategy named QQI
									<ul>
										<li>-<span> Qualitative Strategy:</span> Understanding the Business Model, Scuttlebutt Approach and Interaction with varied Entrepreneurs</li>
										<li>-<span> Quantitative Strategy:</span> Subscription to various portals enables us to continuously track emerging data points.  </li>
										<li>-<span> Idiosyncratic Factors:</span> Luck and Patience</li>
									</ul>
								</li>
								<li>Volatility, being an inherent nature of small and mid-caps, we prefer a time horizon of 3-5 years for reasonable returns.  </li>
							</ul>
							
							<p class="has-different-style"><a href="{{ route('frontend.contact')}}" title="click-here-btn" class="services-click-btn">Click here</a> to Contact Us</p>
							
						</div>
				</div>
				<div class="tab-content-inner list-catagory-section niveshaay-research-block @if($activeservice == 2) active opacity @endif" data-id="research-services">
					<div class="tab-inner-detail">
						<p>Our core competency is Equity Research. Here, what differentiates us is that we follow a holistic approach from explaining the business in great detail, 
							covering supply side analysis to financials and valuations. In this process, we interact with various business management, dealers and distributors to 
							enhance our business understanding. Further, subscription to various data portals helps us to become agile to different emerging data points.
						</p>
						<ul class="green-dot-listing">
							<li>Here, we provide 10-15 investment ideas which has a potential to provide outsized returns in long term </li>
							<li>Quarterly Updates on the stock along with regular updates if there is any</li>
							<li>Help Desk is always available to guide you in case of any query </li>
						</ul>
						<p>Our process has helped us to see the global and emerging trends with new outlook and help us find companies like Borosil Renewables, HLE Glascoat, 
							Textiles to name a few. 
						</p>
					</div>
					<p class="subscription-fees-text">Subscription Fees: <span> ₹ 20,000 + GST for 6 Months</span></p>
					@if (!Auth::user())
						<p class="has-different-style"><a href="{{ route('frontend.signup')}}" title="click-here-btn" class="services-click-btn">Click here</a> to Subscribe</p>
					@endif
					<div class="list-catagory-wrapper">
						<div class="list-wrapper">
							<div class="list-inner-wrapper">
								@foreach ($researches as $research)
									<div class="list-item-wrapper">
										@if($research->upload_type == 0)
									<a href="{{ route('frontend.view.share',$research->id) }}" class="list-item-link">
										<div class="list-item">
											<div class="item-img-wrapper">
												<img src="{{asset('images/share-logo/'.$research->share_logo)}}" alt="McClintock eye">
											</div>
											<div class="item-content-wrapper">
												<h3>{{ $research->share_title}}</h3>
												<div class="item-inner-content">
													
													{{-- <p>{!! $research->description !!}</p> --}}
													<p>{{ Str::limit($research->short_description,50,' ...') }}</p>
													<span><a href="{{ route('frontend.view.share',$research->id) }}">Read More</a></span>
												</div>
											</div>
										</div>
									</a>
									@else
									<a href="{{ asset('pdf/'.$research->pdf_name) }}" target="_blank" class="list-item-link">
										<div class="list-item">
											<div class="item-img-wrapper">
												<img src="{{asset('images/share-logo/'.$research->share_logo)}}" alt="McClintock eye">
											</div>
											<div class="item-content-wrapper">
												<h3>{{ $research->share_title}}</h3>
												<div class="item-inner-content">
													
													{{-- <p>{!! $research->description !!}</p> --}}
													<p>{{ Str::limit($research->short_description,50,' ...') }}</p>
													<span><a href="{{ asset('pdf/'.$research->pdf_name) }}" target="_blank">Read More</a></span>
												</div>
											</div>
										</div>
									</a>
										
									@endif
									</div>	
								@endforeach
								{{-- <div class="list-item-wrapper">
									<a href="#" class="list-item-link">
										<div class="list-item">
											<div class="item-img-wrapper">
												<img src="{{ asset('images/research1.jpg') }}" alt="McClintock eye">
											</div>
											<div class="item-content-wrapper">
												<h3>McClintock's eye for detail text certainly helped.</h3>
												<div class="item-inner-content">
													<p>Nor is there anyone who loves or pursues or desires to obtain
														pain of itself, because it is pain, but occasionally
														circumstances and occur in which toil and pain can procure
														him some great pleasure.
													</p>
													<span>Read More</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="list-item-wrapper">
									<a href="#" class="list-item-link">
										<div class="list-item">
											<div class="item-img-wrapper">
												<img src="{{ asset('images/research2.jpg') }}" alt="classical latin">
											</div>
											<div class="item-content-wrapper">
												<h3>So how did the classical Latin become so incoherent.</h3>
												<div class="item-inner-content">
													<p>According to McClintock, a 15th century typesetter likely
														scrambled part of Cicero's De Finibus in order to provide
														placeholder text to mockup various fonts for a type specimen
														book.
													</p>
													<span>Read More</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="list-item-wrapper">
									<a href="#" class="list-item-link">
										<div class="list-item">
											<div class="item-img-wrapper">
												<img src="{{ asset('images/research3.jpg') }}" alt="blog-item-img">
											</div>
											<div class="item-content-wrapper">
												<h3>It's difficult to find examples of lorem ipsum.</h3>
												<div class="item-inner-content">
													<p>Letraset made it popular as a dummy text in the 1960s,
														although McClintock says he remembers coming across the
														lorem ipsum passage in a book of old metal type samples.
													</p>
													<span>Read More</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="list-item-wrapper">
									<a href="#" class="list-item-link">
										<div class="list-item">
											<div class="item-img-wrapper">
												<img src="{{ asset('images/research1.jpg') }}" alt="McClintock eye">
											</div>
											<div class="item-content-wrapper">
												<h3>McClintock's eye for detail text certainly helped.</h3>
												<div class="item-inner-content">
													<p>Nor is there anyone who loves or pursues or desires to obtain
														pain of itself, because it is pain, but occasionally
														circumstances and occur in which toil and pain can procure
														him some great pleasure.
													</p>
													<span>Read More</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="list-item-wrapper">
									<a href="#" class="list-item-link">
										<div class="list-item">
											<div class="item-img-wrapper">
												<img src="{{ asset('images/research2.jpg') }}" alt="classical latin">
											</div>
											<div class="item-content-wrapper">
												<h3>So how did the classical Latin become so incoherent.</h3>
												<div class="item-inner-content">
													<p>According to McClintock, a 15th century typesetter likely
														scrambled part of Cicero's De Finibus in order to provide
														placeholder text to mockup various fonts for a type specimen
														book.
													</p>
													<span>Read More</span>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="list-item-wrapper">
									<a href="#" class="list-item-link">
										<div class="list-item">
											<div class="item-img-wrapper">
												<img src="{{ asset('images/research3.jpg') }}" alt="blog-item-img">
											</div>
											<div class="item-content-wrapper">
												<h3>It's difficult to find examples of lorem ipsum.</h3>
												<div class="item-inner-content">
													<p>Letraset made it popular as a dummy text in the 1960s,
														although McClintock says he remembers coming across the
														lorem ipsum passage in a book of old metal type samples.
													</p>
													<span>Read More</span>
												</div>
											</div>
										</div>
									</a>
								</div> --}}
							</div>
						</div>
					</div>
					{{-- <p class="has-different-style"><a href="#" title="click-here-btn">Click here</a> to Subscribe for the Research Services</p> --}}
				</div>
				<div class="tab-content-inner niveshaay-pick-smallcase @if($activeservice == 3) active opacity @endif" data-id="portfolio-listed-on-smallcase">
					<div class="tab-inner-detail">
						<p>We have four portfolios listed on Smallcase platform: </p>
					</div>
                    <div class="smallcase-grid">
                        <div class="grid-item">
                            <div class="grid-inner">
                                <span class="smallcase-badge">{{ $mid_and_small_case_focus_stock_array['riskLabel'] }}</span>
                                <div class="top-block">
                                    <em class="img-block">
                                        <img src="{{ asset('images/Mid-Small Cap.svg')}}"
                                            alt="Mid and small cap portfolio">
                                    </em>
                                    <ul class="info-list">
                                        <li>
                                            {{ $mid_and_small_case_focus_stock_array['cagrDuration'] }} CAGR
                                            <span>{{ round($mid_and_small_case_focus_stock_array['cagr'] * 100,2) }}%</span>
                                        </li>
                                        <li>
                                            Min. investment
                                            <span>₹ {{ number_format($mid_and_small_case_focus_stock_array['minInvestAmount']) }}</span>
                                        </li>
                                        <li>
                                            Subscription fees
                                            <span>₹ 2,999 for 3 Months</span>
                                        </li>
                                    </ul>
                                    <h3>{{ $mid_and_small_case_focus_stock_array['name'] }}</h3>
                                </div>
                                <div class="content-block-inner">
                                    <p>This portfolio contains mid and small cap size companies available at
                                        reasonable valuations with strong market hold.</p>
                                    <a href="https://www.smallcase.com/smallcase/mid-and-small-cap-focused-portfolio-NIVMO_0001" title="Subscribe Now" class="btn btn-green" target="_blank">Subscribe Now</a>
                                </div>
    
                            </div>
                        </div>
                        <div class="grid-item">
                            <div class="grid-inner">
                                <span class="smallcase-badge red">{{ $green_energy_stock_array['riskLabel']}}</span>
                                <div class="top-block">
                                    <em class="img-block">
                                        <img src="{{ asset('images/Green Energy.svg')}}" alt="Green Energy">
                                    </em>
                                    <ul class="info-list">
                                        <li>
                                            {{ $green_energy_stock_array['cagrDuration']}} Returns
                                            <span>{{ round($green_energy_stock_array['cagr'] * 100,2) }}%</span>
                                        </li>
                                        <li>
                                            Min. investment
                                            <span>₹ {{ number_format($green_energy_stock_array['minInvestAmount']) }}</span>
                                        </li>
                                        <li>
                                            Subscription fees
                                            <span>₹ 1,999 for 3 Months</span>
                                        </li>
                                    </ul>
                                    <h3>{{ $green_energy_stock_array['name'] }}</h3>
                                </div>
                                <div class="content-block-inner">
                                    <p>A portfolio of stocks, which will get benefit from the renewable energy
                                        sector development.</p>
                                    <a href="https://www.smallcase.com/smallcase/green-energy-portfolio-NIVTR_0001" title="Subscribe Now" class="btn btn-green" target="_blank">Subscribe Now</a>
                                </div>
    
                            </div>
                        </div>
                        <div class="grid-item">
                            <div class="grid-inner">
                                <span class="smallcase-badge red">{{ $china_plus_one_strategy_stock_array['riskLabel'] }}</span>
                                <div class="top-block">
                                    <em class="img-block">
                                        <img src="{{ asset('images/China Plus One 1.svg')}}" alt="Rising Strategy">
                                    </em>
                                    <ul class="info-list">
                                        <li>
                                            {{ $china_plus_one_strategy_stock_array['cagrDuration'] }} Returns
                                            <span>{{ round($china_plus_one_strategy_stock_array['cagr'] * 100,2) }}%</span>
                                        </li>
                                        <li>
                                            Min. investment
                                            <span>₹ {{ number_format($china_plus_one_strategy_stock_array['minInvestAmount']) }}</span>
                                        </li>
                                        <li>
                                            Subscription fees
                                            <span>₹ 1,999 for 3 Months</span>
                                        </li>
                                    </ul>
                                    <h3>{{ $china_plus_one_strategy_stock_array['name'] }}</h3>
                                </div>
                                <div class="content-block-inner">
                                    <p>A smallcase to play the emerging structural theme from China plus one
                                        strategy.</p>
                                    <a href="https://www.smallcase.com/smallcase/china-plus-one-strategy-india-rising!-NIVNM_0001" title="Subscribe Now" class="btn btn-green" target="_blank">Subscribe Now</a>
                                </div>
    
                            </div>
                        </div>
                        <div class="grid-item">
                            <div class="grid-inner">
                                <span class="smallcase-badge red">{{ $trends_triology_stock_array['riskLabel'] }}</span>
                                <div class="top-block">
                                    <em class="img-block">
                                        <img src="{{ asset('images/Trends Triology.svg')}}" alt="Rising Strategy">
                                    </em>
                                    <ul class="info-list">
                                        <li>
                                            {{ $trends_triology_stock_array['cagrDuration'] }} Returns
                                            <span>{{ round($trends_triology_stock_array['cagr'] * 100,2) }}%</span>
                                        </li>
                                        <li>
                                            Min. investment
                                            <span>₹ {{ number_format($trends_triology_stock_array['minInvestAmount']) }}</span>
                                        </li>
                                        <li>
                                            Subscription fees
                                            <span>₹ 2,999 for 3 Months</span>
                                        </li>
                                    </ul>
                                    <h3>{{ $trends_triology_stock_array['name'] }}</h3>
                                </div>
                                <div class="content-block-inner">
                                    <p>It aptly combines the three inter-related trends of investing:
                                        Business, Financial & Price trends.</p>
                                    <a href="https://www.smallcase.com/smallcase/trends-trilogy-NIVMO_0004" title="Subscribe Now" class="btn btn-green" target="_blank">Subscribe Now</a>
                                </div>
    
                            </div>
                        </div>
                    </div>
						{{-- <p>With immense gratitude, 
							we believe that our well defined process and discipline to stick to our process has enabled our portfolio to be in the top performer list on small case. 
						</p> --}}
				</div>
				<div class="tab-content-inner @if($activeservice == 4) active opacity @endif" data-id="family-office-consulting">
					<div class="tab-inner-detail">
						<p>Our research team understands that every family is different. So, we provide bespoke advice to establish, operate and grow your family office. Here, the AUM of family office is large. The general trend is to divide the portfolio and take advisory of different fund managers. 
							Here, leveraging our research capabilities, we not only manage their portfolios but also make prudent allocation on consolidated basis for effective returns. 
						</p>
						
						<p class="has-different-style"><a href="{{ route('frontend.contact')}}" title="click-here-btn" class="services-click-btn">Click here</a> to Contact Us</p>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection