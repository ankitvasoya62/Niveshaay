@extends('backend.layouts.master')
@push('css')
<style>
  .error{
      color:red;
  }
  .card-img{
      max-height:100px;
  }
  .images-card{
    width: 20rem;
    height:250px;
    padding:15px;
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
                <li class="breadcrumb-item active">Edit Research Report Image</li>
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
                            <div class="card-title">Edit Image Library</div>
                        </div>
                        <form id="quickForm" method="POST" action="{{route('admin.update.report-images',$research_images->id)}}" enctype="multipart/form-data">@csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="client_name">Title</label>
                                <input type="text" name="report_title" id="report_title" class="form-control" value="{{ $research_images->report_title }}" required>
                                @error('report_title')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="report_image_path">Image (you can upload multiple image here)</label>
                                <input type="file" name="report_image_path[]" id="report_image_path[]" class="form-control" multiple>
                                @error('report_image_path')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    @foreach ($research_images_path as $row )
                                        <div class="col-md-3">
                                            <div class="card images-card">
                                                <img src="{{ asset('images/research-images/'. $research_images->id.'/'.$row['report_image_path']) }}" class="card-img"><br><br>
                                                <div class="card-body">
                                                    <div class="col-md-12 text-center">
                                                        <a class="btn btn-danger" onclick="return confirm('Are you sure want to delete?')" href="{{route('admin.deleteimages.report-images',$row['id'])}}"><i class="fas fa-trash-alt text-center"></i></a><br><br>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <a style="float: right" class="btn btn-danger" href="{{route('admin.delete.report-images',$row['id'])}}"><i class="fas fa-trash-alt"></i></a> --}}
                                            
                                            
                                            
                                        </div>    
                                    @endforeach
                                    
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-danger" onclick="window.history.back();" style="margin: 5px;">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>

@endsection