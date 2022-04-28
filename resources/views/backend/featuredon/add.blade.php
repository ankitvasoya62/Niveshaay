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
                <li class="breadcrumb-item active">Featured On</li>
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
                            <div class="card-title">Add Featured On</div>
                        </div>
                        <form id="quickForm" method="POST" action="{{route('admin.store.featured-on')}}" enctype="multipart/form-data">@csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="featured_image">Image</label>
                                <input type="file" name="featured_image" id="featured_image" class="form-control">
                                @error('featured_image')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="featured_date">Date of Publish</label>
                                        <input type="date" name="featured_date" id="featured_date" class="form-control" max="9999-12-31">
                                        @error('featured_date')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="featured_logo">Logo</label>
                                <input type="file" name="featured_logo" id="featured_logo" class="form-control">
                                @error('featured_logo')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="featured_title">Title</label>
                                <input type="text" name="featured_title" id="featured_title" class="form-control" value="{{ old('client_name') }}">
                                @error('featured_title')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="featured_description">Description</label>
                                <textarea name="featured_description" id="featured_description" class="form-control" >{{ old('client_description') }}</textarea>
                                @error('featured_description')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="featured_url">Link</label>
                                <input type="text" name="featured_url" id="featured_url" class="form-control" value="{{ old('featured_url') }}">
                                @error('featured_url')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sort_order">Order</label>
                                        <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order') }}">
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