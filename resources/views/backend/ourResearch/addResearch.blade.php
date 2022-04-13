@extends('backend.layouts.master')
@push('css')
    <style>
    .error{
        color:red;
    }
    #summernote{
      min-height: 100px !important;
    }
    .note-editable, .note-code{
    
    min-height: 200px; /* custom size */
    
    }
    </style>
    <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css')}}">
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
              <li class="breadcrumb-item active">Add Research</li>
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
                <h3 class="card-title">Add Reseach</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" method="POST" action="{{route('admin.store-research')}}" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" value="{{old('title')}}" required>
                    @error('title')
                        <span class="error">{{$message}}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="subtitle">Sub Title</label>
                    <input type="text" name="subtitle" class="form-control" id="subtitle" placeholder="Enter Subtitle" value="{{old('subtitle')}}" required>
                    @error('subtitle')
                        <span class="error">{{$message}}</span>
                    @enderror
                  </div> 
                   <div class="form-group">
                    <label for="description">Short Description</label>
                    <textarea type="text" name="short_description" class="form-control" rows="5" cols="20" placeholder="Describe your title here..." value="{{old('description')}}"></textarea>
                    @error('short_description')
                        <span class="error">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" name="description" class="form-control" id="summernote" rows="5" cols="20" placeholder="Describe your title here..." value="{{old('description')}}"></textarea>
                    @error('description')
                        <span class="error">{{$message}}</span>
                    @enderror
                  </div>
                   <div class="form-group">
                    <label for="image">File input</label>
                    <input type="file" name="image" class="form-control" id="image" value="{{old('image')}}" required>
                    @error('image')
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
<!-- Summernote -->
<script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>

    <script>
      $(function () {
        // Summernote
        $('#summernote').summernote();
      });
    </script>
    {{-- <!-- jquery-validation -->
    <script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../../plugins/jquery-validation/additional-methods.min.js"></script>
    <script>
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });
  $('#quickForm').validate({
    rules: {
      title: {
        required: true,
      },
      sub_title: {
        required: true,
        minlength: 5
      },
      terms: {
        required: true
      },
    },
    messages: {
      title: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      subtitle: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script> --}}
@endpush
