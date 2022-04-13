@extends('backend.layouts.master')
@push('css')
<style>
  .error{
      color:red;
  }

  .padding-div{
      padding-bottom: 5px;
  }
  
  </style>
@endpush

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Send Newsletter </li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">Send Newsletter</div>
                        </div>
                        <form id="quickForm" method="POST" action="{{route('admin.newsletter.send.mail')}}" enctype="multipart/form-data">@csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="news_letter">Select Newsletter</label>
                                <select name="newsletter_id" id="news_letter" class="form-control" required oninvalid="this.setCustomValidity('please select only one newsletter')">
                                    <option value="">---Select One---</option>
                                    @foreach ( $newsletters as $newsletter)
                                        <option value="{{ $newsletter->id }}">{{ $newsletter->title }}</option>    
                                    @endforeach
                                    
                                </select>
                                @error('newsletter_id')
                                        <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label for ="subscribed_users">Select Subscribed Users</label>
                                <div class="container-fluid">
                                    <div class="row">
                                        @foreach ( $newsletterusers as $newsletteruser)
                                            
                                            <div class="form-check d-inline col-md-3 padding-div">
                                                <input class="form-check-input" type="checkbox" name="newsletter_user[]" id="{{ $newsletteruser->id }}" value="{{$newsletteruser->email}}" checked >
                                                <label for="{{$newsletteruser->id}}" class="form-check-label">{{$newsletteruser->email}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                               
                                
                            </div> --}}
                            {{-- <div class="form-group">
                                <label for="">Subscribed Users</label>
                                <select name="newsletter_user[]" id="" class="form-control" multiple required>
                                    @foreach ($newsletterusers as $newsletteruser )
                                        <option value="{{$newsletteruser->email}}">{{$newsletteruser->email}}</option>
                                    @endforeach
                                </select>
                                
                            </div> --}}
                           
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Send Newsletter</button>
                            <button type="button" class="btn btn-danger" onclick="window.history.back();" style="margin: 5px;">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>

@endsection