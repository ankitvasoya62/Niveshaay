@extends('frontend.layout.master')
@section('content')
<section class="inner-page-banner-section profile-page-banner-section">
    <img src="{{ url('images/profile-banner-new.png')}}" alt="profile-banner">
    <div class="container">
        <h1>My Profile</h1>
    </div>
</section>
<section class="profile-section niveshaay-section-paddding">
    <div class="niveshaay-container">
        <div class="profile-info">
            <div class="profile-info-wrapper">
                <em class="profile-image">
                    <img src="{{ !empty($user->profile_photo) ? asset('images/profile-photos/'.$user->profile_photo) : asset('images/blankuser.jpeg') }}" alt="profile-image">
                </em>
                <div class="title-wrapper">
                    <h2>{{Auth::user()->name}} </h2>
                    <a href="#" class="modal-link" data-link="edit-profile-popup" title="Edit">
                        
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 453.8 453.7" style="enable-background:new 0 0 453.8 453.7;" xml:space="preserve" height="24" width="24">
                        <style type="text/css">
                            .st0{fill:#83B645;}
                        </style>
                        <path class="st0" d="M401.6,18.3c-24.4-24.4-63.9-24.4-88.3,0l-22.1,22.2L56,275.6l-0.5,0.5c-0.1,0.1-0.1,0.3-0.3,0.3
                            c-0.3,0.4-0.6,0.7-0.9,1.1c0,0.1-0.1,0.1-0.1,0.3c-0.3,0.4-0.4,0.6-0.6,1c-0.1,0.1-0.1,0.2-0.2,0.4c-0.1,0.4-0.3,0.6-0.4,1
                            c0,0.1-0.1,0.1-0.1,0.3l-52.2,157c-1.5,4.5-0.4,9.4,3,12.7c2.4,2.3,5.6,3.6,8.9,3.6c1.4,0,2.7-0.2,4-0.6l156.8-52.3
                            c0.1,0,0.1,0,0.3-0.1c0.4-0.1,0.8-0.3,1.1-0.5c0.1,0,0.2-0.1,0.3-0.1c0.4-0.3,0.9-0.5,1.2-0.8c0.4-0.2,0.8-0.6,1.1-0.9
                            c0.1-0.1,0.2-0.1,0.2-0.3c0.1-0.1,0.4-0.2,0.5-0.5l257.4-257.4c24.4-24.4,24.4-63.9,0-88.3L401.6,18.3z M169.4,371.4l-86.9-86.9
                            L300,67l86.9,86.9L169.4,371.4z M70.2,307.6l75.9,75.9l-114,38L70.2,307.6z M417.9,122.8l-13.2,13.4l-86.9-86.9l13.4-13.4
                            c14.6-14.6,38.3-14.6,52.9,0l34,34C432.5,84.5,432.5,108.2,417.9,122.8z"/>
                        </svg>
                    </a>
                </div>
                <ul class="contact-info">
                    <li>
                        <a href="mailto:john.doe22@gmail.com" title="Mail Us">{{$user->email}}</a>
                    </li>
                    <li>
                        <a href="tel:+13375506798" title="Call Us">{{$user->phone_no}}</a>
                    </li>
                </ul>
            </div>
            <div class="table-outer-wrapper">
                <div class="table-wrapper">
                    <h3>Current Subscriptions</h3>
                    <table class="table">
                        <thead>
                            <tr>
								<th>Product List</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Amount Paid</th>
							</tr>
                        </thead>
                        <tbody>
                            @foreach ($current_subscription as $row )
                            <tr>
                                <td>{{ $row->description }}</td>
                                <td>{{date('d-m-Y',strtotime($row->subscription_start_date))}}</td>
                                <td>{{date('d-m-Y',strtotime($row->subscription_end_date))}}</td>
                                <td>{{$row->amount}} INR</td>
                            </tr>
                            @endforeach
                            
                            {{-- <tr>
                                <td>Redignton</td>
                                <td>01/11/2022</td>
                                <td>01/31/2022</td>
                                <td>15,800 INR</td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
                @if(count($past_subscription) > 0)
                <div class="table-wrapper">
                    <h3>Past Subscriptions</h3>
                    <table class="table">
                        <thead>
                            <tr>
								<th>Product List</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Amount Paid</th>
							</tr>
                        </thead>
                        <tbody>
                            @foreach ($past_subscription as $row )
                            <tr>
                                <td>{{ $row->description }}</td>
                                <td>{{$row->subscription_start_date}}</td>
                                <td>{{$row->subscription_end_date}}</td>
                                <td>{{$row->amount}} INR</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<div id="edit-profile-popup" class="custom-modal edit-profile-popup" data-tab="edit-profile-popup">
	<div class="modal-backdrop"></div>
	<div class="modal-content">
		<div class="modal-content-inner">
			<div class="modal-body custom-form-section">
				<a href="#" title="close" class="modal-close">
					<img src="{{ asset('images/close.svg') }}" alt="close-btn">
				</a>
				<div class="edit-profile-wrapper form-wrapper">
                    <span class="form-title">Edit Profile</span>
                    <form id='edit-profile-form' method="POST" action="{{ route('frontend.editprofile') }}" enctype="multipart/form-data">@csrf
                        <div class="form-outer-wrapper">
                            <div class="profile-image-wrapper">
                                <em class="image-wrapper">
                                    <img src="{{ !empty($user->profile_photo) ? asset('images/profile-photos/'.$user->profile_photo) : asset('images/blankuser.jpeg') }}" alt="profile-image">
                                    <span class="edit-photo form-group">
                                        <input type="file" name="profile_photo">
                                        <img src="{{ asset('images/camera-icon.svg') }}" alt="camera-icon">
                                    </span>
                                </em>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" name="name" type="text" class="form-control" placeholder="John Doe" value="{{ $user->name }}">		                    
                                <span style="color:red" id='profile-modal-name-error'></span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input id="email" name="email" type="email" class="form-control" placeholder="john.dow22@gmail.com" value="{{ $user->email }}" readonly>			
                                <span style="color:red" id='profile-modal-email-error'></span>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input id="phone" name="phone_no" type="text" class="form-control" placeholder="+1 337-550-6798" value="{{ $user->phone_no }}">			
                                <span style="color:red" id='profile-modal-phone-error'></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-green">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection
