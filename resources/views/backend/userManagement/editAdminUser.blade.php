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
                <h3 class="card-title">Edit Admin User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" method="POST" action="{{ route('admin.update.admin-user',$user->id)}}" enctype="multipart/form-data">
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
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Date Of Birth:</label>
                        
                        <input type="date" class="form-control datetimepicker-input" name="dob" value="{{ date("Y-m-d", strtotime($user->dob)) }}" max="9999-12-31">
                        @error('dob')
                            <span class="error">{{$message}}</span>
                        @enderror
                        
                      </div>        
                    </div>
                  </div>
                  
                  
                  
                   
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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