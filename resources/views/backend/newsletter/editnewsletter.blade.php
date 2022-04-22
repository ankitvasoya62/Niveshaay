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
                <li class="breadcrumb-item active">Edit Newsletter Template</li>
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
                            <div class="card-title">Edit Newsletter Template</div>
                        </div>
                        <form id="quickForm" method="POST" action="{{route('admin.newsletter.update', $newsletter->id )}}" enctype="multipart/form-data">@csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Template Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ $newsletter->title }}">
                                @error('title')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                                                        <div class="form-group">
                                <label for="banner_title">Banner Image</label>
                                <input type="file" name="banner" id="banner" class="form-control">
                                @error('banner')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <img src="{{ asset('images/newsletter/'.$newsletter->banner)}}" alt="" style="width: 200px">
                            </div>
                            {{-- <div class="form-group">
                                <label for="banner_title">Banner Title</label>
                                <input type="text" name="banner_title" id="banner_title" class="form-control" value="{{ $newsletter->banner_title }}">
                                @error('banner_title')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div> --}}
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" name="date" id="date" class="form-control" value="{{ $newsletter->date }}">
                                        @error('date')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>    
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <label for="editor_top">Section 1: Editor Top</label>
                                <textarea name="editor_top" class="form-control" id="summernote1" rows="5" cols="20" placeholder="Describe your title here..." value="{{old('description')}}">{{  $newsletter->editor_top }}</textarea>
                                @error('editor_top')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                            
                                <div class="form-group">
                                    <label for="editor_left">Section 2: Editor Left</label>
                                    <textarea name="editor_left" class="form-control" id="summernote2" placeholder="Describe your title here..." value="{{old('description')}}">{{  $newsletter->editor_left }}</textarea>
                                    @error('editor_left')
                                        <span class="error">{{$message}}</span>
                                    @enderror
                                </div>
                            
                            
                                <div class="form-group">
                                    <label for="editor_right">Section 2: Editor Right</label>
                                    <textarea name="editor_right" class="form-control" id="summernote3" placeholder="Describe your title here..." value="{{old('description')}}">{{  $newsletter->editor_right }}</textarea>
                                    @error('editor_right')
                                        <span class="error">{{$message}}</span>
                                    @enderror
                                </div>
                            
                            <div class="form-group">
                                <label for="editor_bottom">Section 3: Editor Bottom</label>
                                <textarea name="editor_bottom" class="form-control" id="summernote4" rows="5" cols="20" placeholder="Describe your title here..." value="{{old('description')}}">{{  $newsletter->editor_bottom }}</textarea>
                                @error('editor_bottom')
                                    <span class="error">{{$message}}</span>
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
@push('js')
<script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>

<script>
  $(function () {
    // Summernote
    $('#summernote1,#summernote2,#summernote3,#summernote4').summernote({
        callbacks: {
            onFocus: function (contents) {
                if($(this).summernote('isEmpty')){
                $(this).html(''); 
                }
            }
        }
    });
  });
</script>
@endpush
@endsection