@extends('backend.layouts.master')
@push('css')
    <style>
    .error{
        color:red;
    }
    
    </style>
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                <h3 class="card-title">Edit User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" method="POST" action="{{ route('admin.update-user',$user->id)}}" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{ $user->name }}" required>
                    @error('name')
                        <span class="error">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="name">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{ $user->email }}" required>
                    @error('email')
                        <span class="error">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="name">Phone number</label>
                    <input type="text" name="phone_no" class="form-control" id="phone_no" placeholder="Enter Phone Number" value="{{ $user->phone_no }}" required>
                    @error('phone_no')
                        <span class="error">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="name">Pan number</label>
                    <input type="text" name="pan" class="form-control" id="pan" placeholder="Enter Pan Number" value="{{ $user->pan }}" required>
                    @error('pan')
                        <span class="error">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                        <label>Date Of Birth:</label>
                        
                        <input type="date" class="form-control datetimepicker-input" name="dob" value="{{ date("Y-m-d", strtotime($user->dob)) }}">
                        @error('dob')
                            <span class="error">{{$message}}</span>
                        @enderror
                        
                    </div>
                  <div class="form-group">
                        <label>Subscription Start Date:</label>
                        
                        <input type="date" class="form-control datetimepicker-input" name="subscription_start_date" value="{{ date("Y-m-d", strtotime($user->subscription_start_date)) }}">
                        @error('subscription_start_date')
                            <span class="error">{{$message}}</span>
                        @enderror
                        
                    </div>
                    <div class="form-group">
                        <label>Subscription End Date:</label>
                        
                        <input type="date" class="form-control datetimepicker-input" name="subscription_end_date" value="{{ date("Y-m-d", strtotime($user->subscription_end_date)) }}">
                        @error('subscription_end_date')
                            <span class="error">{{$message}}</span>
                        @enderror
                        
                    </div>
                    <div class="form-group">
                        <label for="name">Amount</label>
                        <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter Amount" value="{{ $user->amount }}" required>
                        @error('amount')
                            <span class="error">{{$message}}</span>
                        @enderror
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
  {{-- <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <script>
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

  </script> --}}
@endpush