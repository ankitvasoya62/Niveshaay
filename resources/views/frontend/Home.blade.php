@extends('frontend.layout.master')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
@endpush
@section('content')
<div class="home-page-banner">
	<section class="home-page-banner-section">
		<!-- <div class="nivehshaay-container"></div> -->
		<div class="banner-slider-wrapper">
			<div class="home-banner-slider not-visible">
				<div class="home-banner-image">
					<img src="{{ asset('images/slider1.jpg')}}" alt="slider">
				</div>
				<div class="home-banner-content">
					<h2 class="aos-init" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="300">Niveshaay</h2>
					<p  class="aos-init banner-content" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="300" data-aos-delay="100"> Is a SEBI registered boutique investment advisory firm with a dedicated
						<span>research team specialising in equity portfolio advisory</span>
					</p>

				</div>
			</div>
			<div class="home-banner-slider">
				<div class="home-banner-image">
					<img src="{{ asset('images/new-slider2.jpg')}}" alt="slider">
				</div>
				<div class="home-banner-content">
					<h2 data-aos="fade-up" data-aos-easing="linear" data-aos-duration="300">Our Returns are driven by:</h2>
					<ul class="banner-content" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="300" data-aos-delay="100">
						<li>Qualitative Research</li>
						<li>Quantitative Data</li>
						<li>Luck and Patience</li>
					</ul>					
				</div>
			</div>
			<div class="home-banner-slider">
				<div class="home-banner-image">
					<img src="{{ asset('images/new-slider3.jpg')}}" alt="slider">
				</div>
				<div class="home-banner-content">
					<h2 data-aos="fade-up" data-aos-easing="linear" data-aos-duration="300">Mid-Small Cap Focused Portfolio</h2>
					<p class="banner-content" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="300" data-aos-delay="100"> 
						
						<span> Believes in the philosophy of ‘Think the Entrepreneur Way’ and gives utmost importance to Scuttlebutt Approach </span>						
					</p>
				</div>
			</div>
		</div>
	</section>
</div>
<div id="content-main-wrap" class="is-clearfix">
	<div id="content-area" class="site-content-area">
		<section class="niveshaay-welcome-block niveshaay-home-welcome-block niveshaay-section-paddding">
			<div class="niveshaay-container">
				<div class="welcome-block-wrapper has-border-bottom">
					<h1 class="heading-title niveshaay-section-title">Welcome To Niveshaay</h1>
					<p>Niveshaay (in Hindi translates to income from investments) is a SEBI Registered boutique Investment Advisory Firm with a Dedicated Research Team advising on over Rs. 250+ crores of AUM. Our core focus is on small-mid cap stocks which has the potential of giving outsized returns in long term. Our approach of Research based Investing and Second Order Thinking has helped us find companies that delivered great returns.</p>				
				</div>
				<div class="welcome-block-wrapper">
					<h2 class="heading-title niveshaay-section-title">Why Niveshaay?</h2>
				<p>The firm believes in the philosophy of ‘Think the Entrepreneur Way’ and gives utmost importance to Scuttlebutt Approach. Our returns are primarily driven by Qualitative and Quantitative Research with an iota of luck. Our interaction with various entrepreneurs across the country helps us to understand different business models in great detail and gain insights from them on the current happenings of the industry. This process sets us apart in the industry and has enabled us to generate reasonable returns over the years. Trust us in our wealth creation journey as we’ll continue to stick to our process and give one hundred percent always. </p>
				</div>
				
				
			</div>
		</section>
		<section class="list-catagory-section niveshaay-research-block niveshaay-gray-bg niveshaay-section-paddding">
			<div class="niveshaay-container">
				<h2 class="heading-title niveshaay-section-title">Our Research Reports</h2>
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
											<img src="{{ asset('images/research2.jpg')}}" alt="classical latin">
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
											<img src="{{ asset('images/research3.jpg')}}" alt="blog-item-img">
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
											<img src="{{ asset('images/research1.jpg')}}" alt="McClintock eye">
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
											<img src="{{ asset('images/research2.jpg')}}" alt="classical latin">
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
											<img src="{{ asset('images/research3.jpg')}}" alt="blog-item-img">
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
			</div>
		</section>
		<section class="niveshaay-pick-smallcase niveshaay-section-paddding">
			<div class="niveshaay-container">
				<h2 class="heading-title niveshaay-section-title">Pick your smallcase</h2>
				
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
			</div>
		</section>
		<section class="niveshaay-client niveshaay-gray-bg niveshaay-section-paddding">
			<div class="niveshaay-container">
				<h2 class="heading-title niveshaay-section-title">What Our Clients Say</h2>
				<div class="niveshaay-client-content-wrapper our-clients-slider">
					@foreach ($ourClientSay as $client )
					<div class="niveshaay-client-content">
						<div class="client-content-wrapper">
							@if(!empty($client->client_image))
							<em>
								<img src="{{ asset('images/clients/'.$client->client_image)}}" alt="">
							</em>
							@endif
							<div class="content-wrapper">
								<p>
									{{ $client->client_description }}
								</p>
							</div>
							<span class="profile-name">- {{ $client->client_name }}</span>
							<span class="designation">{{ $client->client_designation }}</span>
						</div>
					</div>	
					@endforeach
					{{-- <div class="niveshaay-client-content">
						<div class="client-content-wrapper">
							<em>
								<img src="{{ asset('images/testimonial1.png')}}" alt="Sanjay Trisal">
							</em>
							<div class="content-wrapper">
								<p>
									Pleased to be able to count on the expertise and commitment of work at Niveshaay.
									Sparing time from our hectic schedule has always been difficult. I am thankful to
									Niveshaay for helping us manage our funds effectively. Regular communications
									regarding markets, industries and companies has been helpful.
								</p>
							</div>
							<span class="profile-name">- Sanjay Trisal</span>
							<span class="designation">General Manager (India, South East Asia and Australia, New
								Zealand), AppsFlyer</span>
						</div>
					</div>
					<div class="niveshaay-client-content">
						<div class="client-content-wrapper">
							<em>
								<img src="{{ asset('images/testimonial2.png')}}" alt="Ashish Amin">
							</em>
							<div class="content-wrapper">
								<p>
									It gives us immense pleasure to be associated with Arvind at Niveshaay. I am
									impressed with the quality of his research work and dedication with which he has
									helped us connect and grow by various business deals and expansion. The amount of
									hard work that he puts in understanding the industry and focusing on every small
									detail is quite intriguing,
								</p>
							</div>
							<span class="profile-name">- Ashish Amin</span>
							<span class="designation">Director, Premier Looms </span>
						</div>
					</div>
					<div class="niveshaay-client-content">
						<div class="client-content-wrapper">
							<em>
								<img src="{{ asset('images/testimonial3.png')}}" alt="Mithun Thakur">
							</em>
							<div class="content-wrapper">
								<p>
									Being held-up with the work, there was no time to manage my assets. Niveshaay has
									outperformed my expectations with their stock picking approach and research skills.
									They have always guided me with the best of their services and are always available
									to help. Absolutely satisfied with their work and their effective execution.
								</p>
							</div>
							<span class="profile-name">- Mithun Thakur </span>
							<span class="designation">Manager: Software Quality, Global Microchip Technology Inc.
							</span>
						</div>     
					</div> --}}
				</div>
			</div>
		</section>	
		<section class="twitter-feeds-section niveshaay-section-paddding niveshaay-gray-bg">
			<div class="niveshaay-container">
				<h2 class="heading-title niveshaay-section-title">Twitter Feeds</h2>
				<div class="twitter-feeds-content-wrapper twitter-feeds-slider">
					@foreach ($tweeterfeed as $tweeterfeed)
						<div class="twitter-feeds-content">
							<div class="feeds-content-inner">
								<div class="feeds-image-wrapper">
									<div class="twitter-profile">
										@if(!empty($tweeterfeed->tweeter_user_image))
											<em><img src="{{ asset('images/tweeter-feeds/'.$tweeterfeed->tweeter_user_image)}}" alt="profile-img"></em>
										@endif
										<p>{{$tweeterfeed->tweeter_name }} <span>{{$tweeterfeed->tweeter_username }} </span></p>
									</div>
									<em  class="twitter-img"><img src="{{ asset('images/twitter.png')}}" alt="twitter-img"></em>
								</div>
								<div class="twitter-content-wrapper">
									{{ $tweeterfeed->tweeter_description}}
								</div>
							</div>
						</div>
					@endforeach
						{{-- <div class="twitter-feeds-content">
							<div class="feeds-content-inner">
								<div class="feeds-image-wrapper">
									<div class="twitter-profile">
										<em><img src="{{ asset('images/maheshwar.jpg')}}" alt="profile-img"></em>
										<p>Maheshwar G <span>@Maheshwar888 </span></p>
									</div>
									<em  class="twitter-img"><img src="{{ asset('images/twitter.png')}}" alt="twitter-img"></em>
								</div>
								<div class="twitter-content-wrapper">
									<span><a href="#" title="niveshaay-handle">@niveshaay</a></span>		
									<p>Thanks for creating green energy smallcase,I satrted late but i did
										right thing. 
									</p>
									<p>Good job</p>
								</div>
							</div>
						</div>
						<div class="twitter-feeds-content">
							<div class="feeds-content-inner">
							<div class="feeds-image-wrapper">
									<div class="twitter-profile">
										<em><img src="{{ asset('images/pradeep.jpg')}}" alt="profile-img"></em>
										<p>Pradeep.K <span>@pradeep_kpr  </span></p>
									</div>
									<em class="twitter-img"><img src="{{ asset('images/twitter.png')}}" alt="twitter-img"></em>
								</div>
								<div class="twitter-content-wrapper">
									<p><a href="#" title="niveshaay-handle">@niveshaay</a> is doing fantastic job,
										subscriber to smallcase since 1.5Yrs.Excellent stock picks.
										Immensely benefitted.Thanks for
										ur Awesome job and keep up the 
										good work, <a href="#" title="twitter-handle">@arvind_kothari</a> 
										apperciate your webinars,so
										informative. <a href="#" title="twitter-handle">@csvikramsharma</a> Ur
										always there to help brother.
									</p>
								</div>
							</div>
						</div>
						<div class="twitter-feeds-content">
							<div class="feeds-content-inner">
							<div class="feeds-image-wrapper">
									<div class="twitter-profile">
										<em><img src="{{ asset('images/vishvesh.jpg')}}" alt="profile-img"></em>
										<p>Vishvesh <span>@Vishp89 </span></p>
									</div>
									<em class="twitter-img"><img src="{{ asset('images/twitter.png')}}" alt="twitter-img"></em>
								</div>
								<div class="twitter-content-wrapper">
									<p><a href="#" title="niveshaay-handle">@niveshaay</a>  very happy an
										satisfied with the samllcase of
										<span><a href="#" title="niveshaay-handle">@niveshaay</a></span>
									</p><p>
										When would we get a chance to
										interact with you sir??
	
									</p>
								</div>
							</div>
						</div>
						<div class="twitter-feeds-content">
							<div class="feeds-content-inner">
								<div class="feeds-image-wrapper">
									<div class="twitter-profile">
										<em ><img src="{{ asset('images/pushpraj.jpg')}}" alt="profile-img"></em>
										<p>Pushparaj Manglaore <span>@Pushpa_52 </span></p>
									</div>
									<em class="twitter-img"><img src="{{ asset('images/twitter.png')}}" alt="twitter-img"></em>
								</div>
								<div class="twitter-content-wrapper">
									<p>‘green energy portfolio’,this is a
									beautiful portfolio,currently,I
									enjoying a 35% + return
									</p>
								</div>
							</div>
						</div> --}}
				</div>
			</div>
		</section>
		<section class="list-catagory-section featured-on niveshaay-research-block niveshaay-section-paddding">
			<div class="niveshaay-container">
				<h2 class="heading-title niveshaay-section-title">Featured On</h2>
				<div class="list-catagory-wrapper">
					<div class="list-wrapper">
						<div class="list-inner-wrapper featured-on">
							@foreach ($featuredOn as $row )
								<div class="list-item-wrapper">
									<a href="{{ $row->featured_url }}" target="_blank" class="list-item-link">
										<div class="list-item">
											<div class="item-img-wrapper">
												<img src="{{ asset('images/featured/featured-image/'.$row->featured_image) }}" alt="McClintock eye">
											</div>
											<div class="item-content-wrapper">
												<div class="featured-listing">
													<ul>
														<li>{{ $row->featured_date }}</li>
														<li>
															<em class="smallcase-logo-wrapper">
																<img src="{{ asset('images/featured/featured-logo/'.$row->featured_logo) }}" alt="McClintock eye">
															</em>
														</li>
													</ul>
												</div>
												
												<h3>{{ $row->featured_title }}</h3>
												<div class="item-inner-content">
													<p>{{ Str::limit($row->featured_description,100,'...') }}
													</p>
													<span>Read More</span>
												</div>
											</div>
										</div>
									</a>
								</div>	
							@endforeach
							{{-- <div class="list-item-wrapper">
								<a href="https://www.tickertape.in/blog/can-china-plus-one-strategy-put-india-on-an-upwards-growth-trajectory/" target="_blank" class="list-item-link">
									<div class="list-item">
										<div class="item-img-wrapper">
											<img src="{{ asset('images/news1-image.jpg')}}" alt="McClintock eye">
										</div>
										<div class="item-content-wrapper">
											<ul>
												<li>SEPTEMBER 20,2021</li>
												<li>
													<em>
														<img src="{{ asset('images/ticker-tap-logo.png')}}" alt="McClintock eye">
													</em>
												</li>
											</ul>
											<h3>Can China Plus One Strategy Put India on an Upward Growth Trajectory?</h3>
											<div class="item-inner-content">
												<p>China, known as the ‘World’s factory’ has been the centre of global
													supply chains in the last few decades owing to favourable 
													factors of production and a strong business ecosystem
												</p>
												<span>Read More</span>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="list-item-wrapper">
								<a href="https://www.moneycontrol.com/news/business/top-performing-smallcases-of-samvat-2077-2-7682141.html" target="_blank" class="list-item-link">
									<div class="list-item">
										<div class="item-img-wrapper">
											<img src="{{ asset('images/news2-image.jpg')}}" alt="classical latin">
										</div>
										<div class="item-content-wrapper">
											<ul>
												<li>SEPTEMBER 20,2021</li>
												<li>
													<em>
														<img src="{{ asset('images/money-control.png')}}" alt="McClintock eye">
													</em>
												</li>
											</ul>
											<h3>Top Performing smallcases of Samvat 2077</h3>
											<div class="item-inner-content">
												<p>Samvat 2077 has been a historical year for the Indian equity markets. We saw benchmark equity indices 
												like Sensex and Nifty surpass the 60,000 and 18,000 mark respectively for the first time. 
												</p>
												<span>Read More</span>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="list-item-wrapper">
								<a href="https://open.spotify.com/episode/4XOq1PsPL7Evw8wY2gQgoq" target="_blank" class="list-item-link">
									<div class="list-item">
										<div class="item-img-wrapper">
											<img src="{{ asset('images/news3-image.jpg')}}" alt="blog-item-img">
										</div>
										<div class="item-content-wrapper">
											<ul>
												<li>SEPTEMBER 20,2021</li>
												<li>
													<em>
														<img src="{{ asset('images/ticker-tap-logo.png')}}" alt="China plus">
													</em>
												</li>
											</ul>
											<h3>Top performing smallcases of 2021</h3>
											<div class="item-inner-content">
												<p>Looking back at 2021, the Indian financial markets saw a lot of ups and downs. 
												   Mr Market was on a streak with all-time highs and record-breaking points. Unfortunately, 
												</p>
												<span>Read More</span>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="list-item-wrapper">
								<a href="https://www.moneycontrol.com/news/business/markets/top-performing-smallcases-of-2021-7897381.html" target="_blank" class="list-item-link">
									<div class="list-item">
										<div class="item-img-wrapper">
											<img src="{{ asset('images/news1-image.jpg')}}" alt="McClintock eye">
										</div>
										<div class="item-content-wrapper">
											<ul>
												<li>SEPTEMBER 20,2021</li>
												<li>
													<em>
														<img src="{{ asset('images/money-control.png')}}" alt="McClintock eye">
													</em>
												</li>
											</ul>
											<h3>Can China Plus One Strategy Put India on an Upward Growth Trajectory?</h3>
											<div class="item-inner-content">
												<p>China, known as the ‘World’s factory’ has been the centre of global
													supply chains in the last few decades owing to favourable 
													factors of production and a strong business ecosystem
												</p>
												<span>Read More</span>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div class="list-item-wrapper">
								<a href="https://www.moneycontrol.com/news/business/markets/most-bought-smallcases-for-december-2021-7897031.html" target="_blank" class="list-item-link">
									<div class="list-item">
										<div class="item-img-wrapper">
											<img src="{{ asset('images/news2-image.jpg')}}" alt="classical latin">
										</div>
										<div class="item-content-wrapper">
											<ul>
												<li>SEPTEMBER 20,2021</li>
												<li>
													<em>
														<img src="{{ asset('images/money-control.png')}}" alt="McClintock eye">
													</em>
												</li>
											</ul>
											<h3>Top Performing smallcases of Samvat 2077</h3>
											<div class="item-inner-content">
												<p>Samvat 2077 has been a historical year for the Indian equity markets. We saw benchmark equity indices 
												like Sensex and Nifty surpass the 60,000 and 18,000 mark respectively for the first time. 
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
			</div>
		</section>
		<section class="niveshaay-section-paddding niveshaay-gray-bg nivesh-shiksha niveshaay-welcome-block ">
			<div class="niveshaay-container">
				<div class="nivesh-shiksha-content-wrapper">
					{{-- <h2 class="heading-title niveshaay-section-title">NiveshShiksha</h2> --}}
					<h2 class="heading-title niveshaay-section-title"><img src="{{ asset('images/Nivesh-shiksha-logo.png')}}" alt=""></h2>
					<p>Niveshshiksha is a Financial Literacy endeavor of a team of professionals with a 
						cumulative work experience of 45+ years to impart financial knowledge to students 
						through interactive workshops and equip them to take control of their finances. 
						It was born with an idea to touch upon the most relevant participants of the society viz. 
						Students in order to instil financial discipline and create maximum impact because we believe 
						that in the times when India is moving towards organized market, 
						Financial Literacy is imperative to survive and thrive.</p>
				</div>
			</div>
		</section>
		<section class="niveshaay-complaints-section niveshaay-section-paddding">
			<div class="niveshaay-container">
				<div class="niveshaay-complaints-content">
					<h2 class="heading-title niveshaay-section-title"> Complaint Status</h2>
					<div class="complaints-tab-content-wrapper">
						<div class="tab-heading-outer-wrapper">
							<p>Disposal of complaints</p>
							<div class="tab-heading-wrapper">
								<span>Current Month</span>
								<ul class="tab-heading">
									<li data-id="current-month" class="active">Current Month</li>
									<li data-id="monthly">Monthly</li>
									<li data-id="annual">Annual</li>
								</ul>
							</div>
						</div>
						<div class="tab-content-wrapper">
							<div class="table-responsive niveshhay-table-responsive active" data-attr="current-month">
								<div class="table-wrapper">
									<table class="table table-hover table-bordered table-striped table-responsive">
										<thead>
											<tr>
												<th>Received From</th>
												<th>Pending- last month </th>
												<th>Received</th>
												<th>Resolved</th>
												<th>Total pending</th>
												<th>Pending > 3M</th>
												<th>Avg. resolution time</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Investors</td>
												<td>{{ !empty($current_month_investor_count->pending_last_month) ? $current_month_investor_count->pending_last_month : 0 }}</td>
												<td>{{ !empty($current_month_investor_count->received) ? $current_month_investor_count->received : 0 }}</td>
												<td>{{ !empty($current_month_investor_count->resolved) ? $current_month_investor_count->resolved : 0 }}</td>
												<td>{{ !empty($current_month_investor_count->total_pending) ? $current_month_investor_count->total_pending : 0 }}</td>
												<td>{{ !empty($current_month_investor_count->pending_3m) ? $current_month_investor_count->pending_3m : 0 }}</td>
												<td>{{ !empty($current_month_investor_count->avg_resolution_time) ? $current_month_investor_count->avg_resolution_time : 0 }}</td>
											</tr>
											<tr>
												<td>SEBI Scores</td>
												<td>{{ !empty($sebi_scores_count->pending_last_month) ? $sebi_scores_count->pending_last_month : 0 }}</td>
												<td>{{ !empty($sebi_scores_count->received) ? $sebi_scores_count->received : 0 }}</td>
												<td>{{ !empty($sebi_scores_count->resolved) ? $sebi_scores_count->resolved : 0 }}</td>
												<td>{{ !empty($sebi_scores_count->total_pending) ? $sebi_scores_count->total_pending : 0 }}</td>
												<td>{{ !empty($sebi_scores_count->pending_3m) ? $sebi_scores_count->pending_3m : 0 }}</td>
												<td>{{ !empty($sebi_scores_count->avg_resolution_time) ? $sebi_scores_count->avg_resolution_time : 0 }}</td>
											</tr>
											<tr>
												<td>Other Sources</td>
												<td>{{ !empty($other_sources_count->pending_last_month) ? $other_sources_count->pending_last_month : 0 }}</td>
												<td>{{ !empty($other_sources_count->received) ? $other_sources_count->received : 0 }}</td>
												<td>{{ !empty($other_sources_count->resolved) ? $other_sources_count->resolved : 0 }}</td>
												<td>{{ !empty($other_sources_count->total_pending) ? $other_sources_count->total_pending : 0 }}</td>
												<td>{{ !empty($other_sources_count->pending_3m) ? $other_sources_count->pending_3m : 0 }}</td>
												<td>{{ !empty($other_sources_count->avg_resolution_time) ? $other_sources_count->avg_resolution_time : 0 }}</td>
											</tr>
											<tr>
												<td>Grand Total</td>
												@foreach ($currentmonthgrandtotal as $total )
													<td>{{ !empty($total) ? $total : 0 }}</td>	
												@endforeach
												
											</tr>
										</tbody>
									</table>
								</div>
								<div class="content">
									<p>Contact us directly at <a href="mailto:Info@niveshaay.com"
											title="Mail Us On">Info@niveshaay.com</a> for assistance with any queries,
										complaints or grievances. We will ensure your grievance is resolved within 30
										days.
										If you feel that your grievance is not redressed satisfactorily, you may lodge a
										complaint with SEBI through <a href="https://scores.gov.in/" target="_blank"
											title="the Scores website">the Scores website</a> or the SEBI Scores app for
										<a target="_blank"
											href="https://play.google.com/store/apps/details?id=com.ionicframework.sebi236330&hl=en_IN&gl=US"
											title="Android">Android</a> or <a target="_blank"
											href="https://apps.apple.com/in/app/sebiscores/id1493257302"
											title="iOS">iOS</a>.</p>
								</div>
							</div>
							<div class="table-responsive niveshhay-table-responsive" data-attr="monthly">
								<div class="table-wrapper">
									<table class="table table-hover table-bordered table-striped table-responsive">
										<thead>
											<tr>
												<th>Month</th>
												<th>Carried forward</th>
												<th>Received</th>
												<th>Resolved</th>
												<th>Pending</th>
											</tr>
										</thead>
										<tbody>

											@foreach ($monthlyComplaints as $monthly_complaint)
												<tr>
													<td>{{ $monthly_complaint['complaint_month_name'] }} - {{ $monthly_complaint['complaint_year'] }}</td>
													<td>{{ !empty($monthly_complaint['carried_forward']) ? $monthly_complaint['carried_forward'] : 0 }}</td>
													<td>{{ !empty($monthly_complaint['received']) ? $monthly_complaint['received'] : 0 }}</td>
													<td>{{ !empty($monthly_complaint['resolved']) ? $monthly_complaint['resolved'] : 0 }}</td>
													<td>{{ !empty($monthly_complaint['pending']) ? $monthly_complaint['pending'] : 0 }}</td>
												</tr>	
											@endforeach
											
											
											
											<tr>
												<td>Grand Total</td>
												@foreach ($monthlygrandtotal as $total )
													<td>{{ !empty($total) ? $total : 0 }}</td>	
												@endforeach
												
											</tr>
										</tbody>
									</table>
								</div>
								<div class="content">
									<p>Contact us directly at <a href="mailto:Info@niveshaay.com"
											title="Mail Us On">Info@niveshaay.com</a> for assistance with any queries,
										complaints or grievances. We will ensure your grievance is resolved within 30
										days.
										If you feel that your grievance is not redressed satisfactorily, you may lodge a
										complaint with SEBI through <a href="https://scores.gov.in/" target="_blank"
											title="the Scores website">the Scores website</a> or the SEBI Scores app for
										<a target="_blank"
											href="https://play.google.com/store/apps/details?id=com.ionicframework.sebi236330&hl=en_IN&gl=US"
											title="Android">Android</a> or <a target="_blank"
											href="https://apps.apple.com/in/app/sebiscores/id1493257302"
											title="iOS">iOS</a>.</p>
								</div>
							</div>
							<div class="table-responsive niveshhay-table-responsive" data-attr="annual">
								<div class="table-wrapper">
									<table class="table table-hover table-bordered table-striped table-responsive">
										<thead>
											<tr>
												<th>Year</th>
												<th>Carried forward</th>
												<th>Received</th>
												<th>Resolved</th>
												<th>Pending</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($annuallyComplaints as $key=>$annually_complaint)
											<tr>
												<td>{{ $annually_complaint['year_diff'] }}</td>
												<td>{{ !empty($annually_complaint['carried_forward']) ? $annually_complaint['carried_forward'] : 0 }}</td>
												<td>{{ !empty($annually_complaint['received']) ? $annually_complaint['received'] : 0 }}</td>
												<td>{{ !empty($annually_complaint['resolved']) ? $annually_complaint['resolved'] : 0 }}</td>
												<td>{{ !empty($annually_complaint['pending']) ? $annually_complaint['pending'] : 0 }}</td>
											</tr>	
											@endforeach
											
											
											<tr>
												<td>Grand Total</td>
												@foreach ($annuallygrandtotal as $total )
													<td>{{ !empty($total) ? $total : 0 }}</td>	
												@endforeach
												
												
											</tr>
										</tbody>
									</table>
								</div>
								<div class="content">
									<p>Contact us directly at <a href="mailto:Info@niveshaay.com"
											title="Mail Us On">Info@niveshaay.com</a> for assistance with any queries,
										complaints or grievances. We will ensure your grievance is resolved within 30
										days.
										If you feel that your grievance is not redressed satisfactorily, you may lodge a
										complaint with SEBI through <a href="https://scores.gov.in/" target="_blank"
											title="the Scores website">the Scores website</a> or the SEBI Scores app for
										<a target="_blank"
											href="https://play.google.com/store/apps/details?id=com.ionicframework.sebi236330&hl=en_IN&gl=US"
											title="Android">Android</a> or <a target="_blank"
											href="https://apps.apple.com/in/app/sebiscores/id1493257302"
											title="iOS">iOS</a>.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<!-- #content-area -->
	@push('js')
	
		<script type="module">
			toastr.options = {
    			positionClass: 'toast-top-center'
  			};
			@if(Session::has('forgot_password_status'))
				toastr.success(" {{ Session::get('forgot_password_status') }} ");
			@endif

		</script>
		@if(request()->get('login') && request()->get('login') === "true")
		<script type="module">
			jQuery('body,html').addClass('open-modal');
			// var obj=jQuery('#').attr('data-link');
			var activemodal= jQuery("[data-tab='login-modal']");
			activemodal.addClass('visible');        
		</script>
		@endif
		
	@endpush
@endsection
