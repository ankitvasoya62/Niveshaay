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
                <li class="breadcrumb-item active">Edit Twitter Feeds</li>
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
                            <div class="card-title">Edit Twitter Feeds</div>
                        </div>
                        <form id="quickForm" method="POST" action="{{route('admin.update.tweeter-feeds',$tweeterFeeds->id)}}" enctype="multipart/form-data">@csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="client_name">Name</label>
                                <input type="text" name="tweeter_name" id="tweeter_name" class="form-control" value="{{ $tweeterFeeds->tweeter_name }}">
                                @error('tweeter_name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="client_name">User name</label>
                                <input type="text" name="tweeter_username" id="tweeter_username" class="form-control" value="{{ $tweeterFeeds->tweeter_username }}">
                                @error('tweeter_username')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tweeter_user_image">User Image</label>
                                <input type="file" name="tweeter_user_image" id="tweeter_user_image" class="form-control">
                                @error('tweeter_user_image')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <img src="{{ asset('images/tweeter-feeds/'.$tweeterFeeds->tweeter_user_image) }}" style="width:100px">
                            </div>
                            <div class="form-group">
                                <label for="client_description">Description</label>
                                <textarea name="tweeter_description" id="tweeter_description" class="form-control" >{{ $tweeterFeeds->tweeter_description }}</textarea>
                                @error('tweeter_description')
                                    <span class="error">{{ $message }}</span>
                                @enderror
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