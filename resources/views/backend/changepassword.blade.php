@extends('backend.layouts.master')
@push('css')
<style>
  .error{
      color:red;
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
                <li class="breadcrumb-item active">Change Password</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Change Password</div>
                        </div>
                        <form id="quickForm" method="POST" action="{{route('admin.changepassword')}}" enctype="multipart/form-data">@csrf
                        <div class="card-body">
                            {{-- <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" name="current_password" id="current_password" class="form-control">
                                @error('current_password')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div> --}}
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                                @error('password')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="confirm_password" class="form-control">
                                @error('confirm_password')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger" onclick="window.history.back();" style="margin: 5px;">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>

@endsection