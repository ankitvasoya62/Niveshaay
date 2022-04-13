<?php $active = ''; ?>
@extends('frontend.layout.master')
@section('content')
<section class="research-dashboard-banner-section">
	<img src="{{ asset('images/research-dashboard-banner.jpg') }}" alt="banner-img">
	<div class="container">
		<div class="banner-content">
			<h1>Dashboard</h1>
			<p>Investing in the best stocks of tomorrow</p>
		</div>
	</div>
</section>
<section class="green-block-section">
	<div class="green-block-wrapper">
		<div class="niveshaay-container">
			<h2 class="heading-title niveshaay-section-title">Our Research Services</h2>
			@if(empty($isEmailVerified))
				<p>Please Subscribe <a href="{{ route('frontend.subscriptionForm') }}" title="Click to Subscribe">Here</a></p>
			@else
				<p>You have verified the agreement successfully. You will receive the mail soon for further process. 
				</p>
			@endif
		</div>
	</div>
</section>
<section class="list-catagory-section niveshaay-research-block sample-research-block">
	<div class="niveshaay-container">
		<h2 class="heading-title niveshaay-section-title">Our Sample Research Reports </h2>
		<div class="list-catagory-wrapper">
			<div class="list-wrapper">
				<div class="list-inner-wrapper">
					<div class="list-item-wrapper">
						<a href="#" class="list-item-link">
							<div class="list-item">
								<div class="item-img-wrapper">
									<img src="{{ asset('images/research1.jpg') }}" alt="McClintock eye">
								</div>
								<div class="item-content-wrapper">
									<h3>Rain Industries Ltd. </h3>
									<div class="item-inner-content">
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
											incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris aute irure dolor in voluptate velit esse.
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
									<h3>Borosil Renewables Ltd. </h3>
									<div class="item-inner-content">
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
											incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris aute irure dolor in voluptate velit esse.
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
									<h3>HLE Glascoat Ltd.</h3>
									<div class="item-inner-content">
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
											incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris aute irure dolor in voluptate velit esse.
										</p>
										<span>Read More</span>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection