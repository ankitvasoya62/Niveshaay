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
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                <li class="breadcrumb-item active">Edit Testimonial</li>
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
                            <div class="card-title">Edit Testimonial</div>
                        </div>
                        <form id="quickForm" method="POST" action="{{route('admin.update.our-clients',$client->id)}}" enctype="multipart/form-data">@csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="client_name">Name</label>
                                <input type="text" name="client_name" id="client_name" class="form-control" value="{{ $client->client_name }}">
                                @error('client_name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="client_description">Testimonial</label>
                                <textarea name="client_description" id="client_description" class="form-control" >{{ $client->client_description }}</textarea>
                                @error('client_description')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="client_image">Client Image</label>
                                <input type="file" name="client_image" id="client_image" class="form-control">
                                @error('client_image')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <img src="{{ asset('images/clients/'.$client->client_image) }}" alt="" style="height: 150px"/>
                            </div>
                            <div class="form-group">
                                <label for="client_designation">Designation</label>
                                <input type="text" name="client_designation" id="client_designation" class="form-control" value="{{ $client->client_designation }}">
                                @error('client_designation')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sort_order">Order</label>
                                        <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ $client->sort_order }}">
                                        @error('sort_order')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                </div>
                            </div> --}}
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