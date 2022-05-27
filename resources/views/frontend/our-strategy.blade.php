@extends('frontend.layout.master')
@section('content')
<section class="our-strategy-page-banner-section">
			<img src="{{ asset('images/chess.jpg')}}" alt="banner-img">
			<div class="container">
				<div class="banner-content">
					<h1>Our Strategy</h1>
					<p>Think the Entrepreneur Way</p>
				</div>
			</div>
</section>
<section class="research-card-section">
	<div class="niveshaay-container">
		<div class="research-card-grid">
			<div data-link="our-strategy-modal-1" class="modal-link white-card">
				<div class="white-card-inner">
					<em class="card-icon-wrapper">
						<img src="{{ asset('images/research-based-investing.svg')}}" class="card-icon" alt="research-based-investing">
						<img src="{{ asset('images/research-based-investing-white.svg')}}" class="card-icon-white" alt="research-based-investing">
					</em>
					<span class="card-title">Niveshaay’s Hedgehog Approach</span>
					<div class="card-content-wrapper">	
						<ul class="green-dot-listing">
							<li>Developed our circle of Entrepreneurs</li>
							<li>Research- Based Investing</li>
							<li>Scuttlebutt Approach</li>
						</ul>
					</div>
					<a href="#" title="Read More" data-link="our-strategy-modal-1" class="modal-link">Read More</a>
				</div>
			</div>
			<div data-link="our-strategy-modal-2" class="modal-link white-card">
				<div class="white-card-inner">
					<em class="card-icon-wrapper">
						<img src="{{ asset('images/our-philosophy.svg')}}" class="card-icon" alt="our-philosophy">
						<img src="{{ asset('images/our-philosophy-white.svg')}}" class="card-icon-white" alt="our-philosophy">
					</em>
					<span class="card-title">Our Philosophy</span>
					<div class="card-content-wrapper">	
						<p>Think the Entrepreneur Way- The Key Mantra of Investing in Equity Markets.</p>
					</div>
					<a href="#" title="Read More" data-link="our-strategy-modal-2" class="modal-link">Read More</a>
				</div>
			</div>
			<div data-link="our-strategy-modal-3" class="modal-link white-card">
				<div class="white-card-inner">
					<em class="card-icon-wrapper">
						<img src="{{ asset('images/stock-selection.svg')}}" class="card-icon" alt="stock-selection">
						<img src="{{ asset('images/stock-selection-white.svg')}}" class="card-icon-white" alt="stock-selection">
					</em>
					<span class="card-title">Stock Selection Approach</span>
					<div class="card-content-wrapper">	
						<ul class="green-dot-listing">
							<li>Supply Side Analysis</li>
							<li>Under-penetrated Industries</li>
							<li>Companies recovering from bad-cycle</li>
						</ul>
					</div>
					<a href="#" title="Read More" data-link="our-strategy-modal-3" class="modal-link">Read More</a>
				</div>
			</div>
			<div data-link="our-strategy-modal-4" class="modal-link white-card">
				<div class="white-card-inner">
					<em class="card-icon-wrapper">
						<img src="{{ asset('images/peripheral-story.svg')}}" class="card-icon" alt="peripheral-story">
						<img src="{{ asset('images/peripheral-story-white.svg')}}" class="card-icon-white" alt="peripheral-story">
					</em>
					<span class="card-title">Play on peripheral story. Why?</span>
					<div class="card-content-wrapper">	
						<ul class="green-dot-listing">
							<li>	Niche Market </li>
							<li>	Less Disruptive </li>
							<li>	Enjoy Competitive Advantage </li>
						</ul>
					</div>
					<a href="#" title="Read More" data-link="our-strategy-modal-4" class="modal-link">Read More</a>
				</div>
			</div>
			<div data-link="our-strategy-modal-5" class="modal-link white-card">
				<div class="white-card-inner">
					<em class="card-icon-wrapper">
						<img src="{{ asset('images/broad-allocation.svg')}}" class="card-icon" alt="broad-allocation">
						<img src="{{ asset('images/broad-allocation-white.svg')}}" class="card-icon-white" alt="broad-allocation">
					</em>
					<span class="card-title">Broad Allocation Strategy </span>
					<div class="card-content-wrapper">	
						<ul class="green-dot-listing">
							<li>Macro Tailwinds in sector </li>
							<li>Operating Leverage Play </li>
							<li>Cyclical Approach </li>
						</ul>
					</div>
					<a href="#" title="Read More" data-link="our-strategy-modal-5" class="modal-link">Read More</a>
				</div>
			</div>
			<div data-link="our-strategy-modal-6" class="modal-link white-card">
				<div class="white-card-inner">
					<em class="card-icon-wrapper">
						<img src="{{ asset('images/success-stories.svg')}}" class="card-icon" alt="research-based-investing">
						<img src="{{ asset('images/success-stories-white.svg')}}" class="card-icon-white" alt="research-based-investing">
					</em>
					<span class="card-title">Our Wealth Creation Stories </span>
					<div class="card-content-wrapper">	
						<ul class="green-dot-listing">
							<li>	Garware Technical Fibres  </li>
							<li>	Jamna Auto Ltd.  </li>
							<li>Rain Industries Ltd  </li>
						</ul>
					</div>
					<a href="#" title="Read More" data-link="our-strategy-modal-6" class="modal-link">Read More</a>
				</div>
			</div>
		</div>
	</div>
</section>
<div id="our-strategy-modal-1" class="custom-modal our-strategy-modal" data-tab="our-strategy-modal-1">
	<div class="modal-backdrop"></div>
	<div class="modal-content">
		<div class="modal-content-inner">
			<div class="modal-body custom-form-section">
				<a href="#" title="close" class="modal-close">
					<img src="{{ asset('images/close.svg')}}" alt="close-btn">
				</a>
				<div class="white-card">						
					<em class="card-icon-wrapper">
						<img src="{{ asset('images/research-based-investing.svg')}}" class="card-icon" alt="research-based-investing">
					</em>
					<span class="card-title">Niveshaay’s Hedgehog Approach</span>
					<span class="modal-card-title">Hedgehogs FOCUS on one thing at a time. </span>
					<div class="card-content-wrapper">	
						<ul class="green-dot-listing">
							<li>Developed our circle of Entrepreneurs with whom we interact to gain business insights on various industries.
							</li>
							<li>Research- Based Investing
							</li>
							<li>Scuttlebutt Approach </li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="our-strategy-modal-2" class="custom-modal our-strategy-modal" data-tab="our-strategy-modal-2">
	<div class="modal-backdrop"></div>
	<div class="modal-content">
		<div class="modal-content-inner">
			<div class="modal-body custom-form-section">
				<a href="#" title="close" class="modal-close">
					<img src="{{ asset('images/close.svg')}}" alt="close-btn">
				</a>
				<div class="white-card">						
					<em class="card-icon-wrapper">
						<img src="{{ asset('images/our-philosophy.svg')}}" class="card-icon" alt="research-based-investing">
					</em>
					<span class="card-title">Our Philosophy</span>
					{{-- <span class="modal-card-title">Hedgehogs FOCUS on one thing at a time. </span> --}}
					<div class="card-content-wrapper">	
						<p>Think the Entrepreneur Way- The Key Mantra of Investing in Equity Markets.</p>
						<p>Invest where there is low Risk and High Uncertainty. The idea is borrowed from Mr. Mohnish Pabrai, a key value investor and fund manager of Pabrai Funds based in California. </p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="our-strategy-modal-3" class="custom-modal our-strategy-modal" data-tab="our-strategy-modal-3">
	<div class="modal-backdrop"></div>
	<div class="modal-content">
		<div class="modal-content-inner">
			<div class="modal-body custom-form-section">
				<a href="#" title="close" class="modal-close">
					<img src="{{ asset('images/close.svg')}}" alt="close-btn">
				</a>
				<div class="white-card">						
					<em class="card-icon-wrapper">
						<img src="{{ asset('images/stock-selection.svg')}}" class="card-icon" alt="research-based-investing">
					</em>
					<span class="card-title">Stock Selection Approach </span>
					{{-- <span class="modal-card-title">Hedgehogs FOCUS on one thing at a time. </span> --}}
					<div class="card-content-wrapper">	
						<ul class="green-dot-listing">
							<li>Pick and Shovel Strategy : Second Order Thinking
							</li>
							<li>Supply Side Analysis 
							</li>
							<li>Under-penetrated Industries  </li>
							<li>Companies recovering from bad-cycle</li>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="our-strategy-modal-4" class="custom-modal our-strategy-modal" data-tab="our-strategy-modal-4">
	<div class="modal-backdrop"></div>
	<div class="modal-content">
		<div class="modal-content-inner">
			<div class="modal-body custom-form-section">
				<a href="#" title="close" class="modal-close">
					<img src="{{ asset('images/close.svg')}}" alt="close-btn">
				</a>
				<div class="white-card">						
					<em class="card-icon-wrapper">
						<img src="{{ asset('images//peripheral-story.svg')}}" class="card-icon" alt="research-based-investing">
					</em>
					<span class="card-title">Play on peripheral story. Why?</span>
					
					<div class="card-content-wrapper">	
						<ul class="green-dot-listing">
							<li>	Niche Market </li>
							<li>	Less Disruptive </li>
							<li>	Enjoy Competitive Advantage </li>
							<li>Few Players</li>
							<li>Sometimes, less volatility than the finished products </li>
							<li>Financial Statements are better than the finished product companies</li>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="our-strategy-modal-5" class="custom-modal our-strategy-modal" data-tab="our-strategy-modal-5">
	<div class="modal-backdrop"></div>
	<div class="modal-content">
		<div class="modal-content-inner">
			<div class="modal-body custom-form-section">
				<a href="#" title="close" class="modal-close">
					<img src="{{ asset('images/close.svg')}}" alt="close-btn">
				</a>
				<div class="white-card">						
					<em class="card-icon-wrapper">
						<img src="{{ asset('images/broad-allocation.svg')}}" class="card-icon" alt="research-based-investing">
					</em>
					<span class="card-title">Broad Allocation Strategy </span>
					
					<div class="card-content-wrapper">	
						<ul class="green-dot-listing">
							<li>Macro Tailwinds in sector </li>
							<li>Operating Leverage Play </li>
							<li>Clical Approach </li>
							<li>Basket Approach </li>
							<li>Growth Company, Emerging Giants</li>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="our-strategy-modal-6" class="custom-modal our-strategy-modal" data-tab="our-strategy-modal-6">
	<div class="modal-backdrop"></div>
	<div class="modal-content">
		<div class="modal-content-inner">
			<div class="modal-body custom-form-section">
				<a href="#" title="close" class="modal-close">
					<img src="{{ asset('images/close.svg')}}" alt="close-btn">
				</a>
				<div class="white-card">						
					<em class="card-icon-wrapper">
						<img src="{{ asset('images/success-stories.svg')}}" class="card-icon" alt="research-based-investing">
					</em>
					<span class="card-title">Our Wealth Creation Stories </span>
					
					<div class="card-content-wrapper">	
						<ul class="green-dot-listing">
							<li>	Garware Technical Fibres  </li>
							<li>	Jamna Auto Ltd.  </li>
							<li>Rain Industries Ltd  </li>
							<li>HLE Glascoat</li>
							<li>Borosil Renewables Ltd.</li>
							<li>Rajratan Global Wire Ltd.</li>
							<li>CDSL </li>
	
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection