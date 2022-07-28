@extends('backend.layouts.master')
@push('css')
    <style>
    .error{
        color:red;
    }
        
    </style>
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@push('headJs')
    
@endpush
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Edit User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" method="POST" action="{{ route('admin.update-user',$user->id)}}" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{ $user->name }}" required>
                        @error('name')
                            <span class="error">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="name">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{ $user->email }}" required>
                        @error('email')
                            <span class="error">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="name">Phone number</label>
                        <input type="text" name="phone_no" class="form-control" id="phone_no" placeholder="Enter Phone Number" value="{{ $user->phone_no }}" required>
                        @error('phone_no')
                            <span class="error">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="name">PAN number</label>
                        <input type="text" name="pan" class="form-control" id="pan" placeholder="Enter Pan Number" value="{{ $user->pan }}" required>
                        @error('pan')
                            <span class="error">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  
                  <?php
                    $subscription_details = \App\Models\SubscriptionFormDetail::where('user_id',$user->id)->first();
                    $street_address = !empty($subscription_details) ? $subscription_details->street_address : '';
                    $sub_state = !empty($subscription_details) ? $subscription_details->state : ''; 
                    $gst_no = !empty($subscription_details) ? $subscription_details->gst_no : ''; 
                    $service_name = '';
                    if(!empty($subscription_details)){
                      $invoice = \App\Models\InvoiceDetail::where('subscription_form_id',$subscription_details->id)->where('is_renew',0)->orderBy('id','desc')->first();
                      $service_name = !empty($invoice) ? $invoice->description : '';
                    }
                  ?>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="name">GST number</label>
                        <input type="text" name="gst_no" class="form-control" id="gst_no" placeholder="Enter GST Number" value="{{ $gst_no }}">
                        @error('gst_no')
                            <span class="error">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="name">Street address</label>
                    <input type="text" name="street_address" class="form-control" id="street_address" placeholder="Enter Street Address" value="{{ $street_address }}">
                    @error('street_address')
                        <span class="error">{{$message}}</span>
                    @enderror
                  </div>
                  
                  <?php 
                    $states = getStates();
                  ?>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="state">State</label>
                        <select class="form-control select2bs4" name="state">
                            <option value="">SELECT ONE</option>
                            @foreach ($states as $state)
                                <option value="{{$state}}" @if(!empty($sub_state) && $state == $sub_state) selected @endif>{{ $state }}
                                </option>    
                            @endforeach
                            
                        </select>
                        @error('state')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>    
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="name">Service Name</label>
                        <input type="text" name="service_name" class="form-control" id="service_name" placeholder="Enter Service Name" value="{{ $service_name }}">
                        @error('service_name')
                            <span class="error">{{$message}}</span>
                        @enderror
                      </div>    
                    </div>
                  </div>
                  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Date Of Birth:</label>
                      
                      <input type="date" class="form-control datetimepicker-input" name="dob" value="{{ !empty($user->dob) ? date("Y-m-d", strtotime($user->dob)) : '' }}" max="9999-12-31">
                      @error('dob')
                          <span class="error">{{$message}}</span>
                      @enderror
                      
                    </div>
                  </div>
                  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Service Start Date:</label>
                      
                      <input type="date" class="form-control datetimepicker-input" name="subscription_start_date" value="{{ !empty($user->subscription_start_date) ? date("Y-m-d", strtotime($user->subscription_start_date)) : '' }}" max="9999-12-31">
                      @error('subscription_start_date')
                          <span class="error">{{$message}}</span>
                      @enderror
                      
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Service End Date:</label>
                      
                      <input type="date" class="form-control datetimepicker-input" name="subscription_end_date" value="{{ !empty($user->subscription_end_date) ? date("Y-m-d", strtotime($user->subscription_end_date)) : '' }}" max="9999-12-31">
                      @error('subscription_end_date')
                          <span class="error">{{$message}}</span>
                      @enderror
                      
                    </div>
                  </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="name">Amount</label>
                          <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter Amount" value="{{ $user->amount }}" required>
                          @error('amount')
                              <span class="error">{{$message}}</span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    
                   
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" class="btn btn-danger" onclick="window.history.back();" style="margin: 5px;">Cancel</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@push('js')
<script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $(function(){
    $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
  })
</script>
  {{-- <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <script>
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

  </script> --}}
@endpush