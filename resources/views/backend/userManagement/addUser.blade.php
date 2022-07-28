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
              <li class="breadcrumb-item active">Add User</li>
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
                <h3 class="card-title">Add User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" method="POST" action="{{$route == "user" ? route('admin.store.users'):route('admin.store.admin-user')}}" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{old('name')}}" required>
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
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{old('email')}}" required>
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
                        <input type="text" name="phone_no" class="form-control" id="phone_no" placeholder="Enter Phone Number" value="{{old('phone_no')}}" required>
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
                        <input type="text" name="pan" class="form-control" id="pan" placeholder="Enter PAN Number" value="{{old('pan')}}" required>
                        @error('pan')
                            <span class="error">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="name">GST number</label>
                        <input type="text" name="gst_no" class="form-control" id="gst_no" placeholder="Enter GST Number" value="{{old('gst_no')}}" required>
                        @error('gst_no')
                            <span class="error">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="name">Street address</label>
                    <input type="text" name="street_address" class="form-control" id="street_address" placeholder="Enter Street Address" value="{{old('gst_no')}}" required>
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
                                <option value="{{$state}}">{{ $state }}
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
                        <input type="text" name="service_name" class="form-control" id="service_name" placeholder="Enter Service Name" value="{{old('service_name')}}" required>
                        @error('service_name')
                            <span class="error">{{$message}}</span>
                        @enderror
                      </div>    
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Date Of Birth:</label>
                        
                        <input type="date" class="form-control datetimepicker-input" name="dob" value="{{ old('dob') }}" max="9999-12-31">
                        @error('dob')
                            <span class="error">{{$message}}</span>
                        @enderror
                        
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                          <label>Service Start Date:</label>
                          
                          <input type="date" class="form-control datetimepicker-input" name="subscription_start_date" value="{{ old('subscription_start_date') }}" max="9999-12-31">
                          @error('subscription_start_date')
                              <span class="error">{{$message}}</span>
                          @enderror
                          
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Service End Date:</label>
                        
                        <input type="date" class="form-control datetimepicker-input" name="subscription_end_date" value="{{ old('subscription_end_date') }}" max="9999-12-31">
                        @error('subscription_end_date')
                            <span class="error">{{$message}}</span>
                        @enderror
                        
                      </div>
                    </div>
                  </div>
                  
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="name">Amount</label>
                          <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter Amount" value="{{old('amount')}}" required>
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