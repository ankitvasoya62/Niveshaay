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
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Add Share</li>
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
                <h3 class="card-title">Add Share</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" method="POST" action="{{route('admin.store.share')}}" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="copy_our_research" value="1" name="copy_to_our_research">
                      <label for="copy_our_research" class="custom-control-label">Copy To Our Research</label>
                    </div>  
                    @error('copy_to_our_research')
                        <span class="error">{{$message}}</span>
                    @enderror
                  </div>                  
                  <div class="form-group">
                    <label for="exampleInputFile">Share Logo</label>
                    <input type="file" class="form-control" id="shareLogo" name="share_logo">

                    @error('share_logo')
                        <span class="error">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" name="share_title" class="form-control" id="share_title" placeholder="Enter Title" value="{{old('share_title')}}" required>
                    @error('share_title')
                        <span class="error">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="name">Initiating Coverage Date</label>
                      <input type="date" name="share_date" class="form-control" id="share_date" placeholder="Enter Title" value="{{old('share_date')}}" required>
                      @error('share_date')
                          <span class="error">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="description">Short Description</label>
                    <textarea type="text" name="short_description" class="form-control" rows="5" cols="20" placeholder="Describe your title here..." value="{{old('short_description')}}"></textarea>
                    @error('short_description')
                        <span class="error">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Share Image</label>
                    
                    <input type="file"  class="form-control" id="exampleInputFile" name="share_image">
                        
                     
                    @error('share_image')
                        <span class="error">{{$message}}</span>
                    @enderror
                  </div>
                   
                  <div class="row">
                    <div class="col-md-6">
                      <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Key Data</h3>
                        </div>
                    
                  
                        <div class="card-body">
                            <div class="form-group">
                              <label for="name">Industry</label>
                              <input type="text" name="share_industry" class="form-control" id="share_industry" placeholder="Enter Industry" value="{{old('share_industry')}}" required>
                              @error('share_industry')
                                  <span class="error">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label for="name">CMP</label>
                              <input type="text" name="share_cmp" class="form-control" id="share_cmp" placeholder="Enter CMP" value="{{old('share_cmp')}}" required>
                              @error('share_cmp')
                                  <span class="error">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label for="name">Market Cap</label>
                              <input type="text" name="share_market_cap" class="form-control" id="share_market_cap" placeholder="Enter Market Cap" value="{{old('share_market_cap')}}" required>
                              @error('share_market_cap')
                                  <span class="error">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label for="name">52 –Week High/Low</label>
                              <input type="text" name="share_week_high_low" class="form-control" id="share_week_high_low" placeholder="Enter 52 –Week High/Low" value="{{old('share_week_high_low')}}" required>
                              @error('share_week_high_low')
                                  <span class="error">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label for="name">Outlook</label>
                              <input type="text" name="share_outlook" class="form-control" id="share_outlook" placeholder="Enter Outlook" value="{{old('share_outlook')}}" required>
                              @error('share_outlook')
                                  <span class="error">{{$message}}</span>
                              @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer"></div>
                        
    
                     </div>
                    </div>
                    <div class="col-md-6">
                      <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Shareholding Pattern</h3>
                        </div>
                    
                  
                        <div class="card-body">
                            <div class="form-group">
                              <label for="name">Promoters</label>
                              <input type="text" name="shareholding_promoters" class="form-control" id="shareholding_promoters" placeholder="Enter Promoteres" value="{{old('shareholding_promoters')}}" required>
                              @error('shareholding_promoters')
                                  <span class="error">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label for="name">public</label>
                              <input type="text" name="shareholding_public" class="form-control" id="shareholding_public" placeholder="Enter public" value="{{old('shareholding_public')}}" required>
                              @error('shareholding_public')
                                  <span class="error">{{$message}}</span>
                              @enderror
                            </div>
                            
                        
                        </div>
                        <!-- /.card-body -->
    
                        
    
                     </div>
                     <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Research Analyst</h3>
                        </div>
                  
                
                        <div class="card-body">
                            <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" name="research_analyst_name" class="form-control" id="research_analyst_name" placeholder="Enter Name" value="{{old('share_title')}}" required>
                              @error('research_analyst_name')
                                  <span class="error">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label for="name">Designation</label>
                              <input type="text" name="research_analyst_designation" class="form-control" id="research_analyst_designation" placeholder="Enter Designation" value="{{old('research_analyst_designation')}}" required>
                              @error('research_analyst_designation')
                                  <span class="error">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label for="name">Email</label>
                              <input type="text" name="research_analyst_email" class="form-control" id="research_analyst_email" placeholder="Enter Email" value="{{old('research_analyst_email')}}" required>
                              @error('research_analyst_email')
                                  <span class="error">{{$message}}</span>
                              @enderror
                            </div>
                        
                        </div>
                      <!-- /.card-body -->
  
                      
  
                     </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" name="share_description" class="form-control" id="summernote" rows="5" cols="20" placeholder="Describe your title here..."></textarea>
                    {{-- <input type="file" name="share_description" class="form-control" accept="application/pdf"> --}}
                    @error('share_description')
                        <span class="error">{{$message}}</span>
                    @enderror
                  </div>
                  
                  <div class="form-group">
                    <label>Share Recommendation</label>
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="0" name="share_recommendation[]">
                      <label for="customCheckbox1" class="custom-control-label" >Latest Addition</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="customCheckbox2" value="1" name="share_recommendation[]">
                      <label for="customCheckbox2" class="custom-control-label">Current Recommendation</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="customCheckbox3" value="2" name="share_recommendation[]">
                      <label for="customCheckbox3" class="custom-control-label">Past Recommendation</label>
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
@push('js')
<!-- Summernote -->
<script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>

    <script>
      $(function () {
        // Summernote
        $('#summernote').summernote();
      });
    </script>
    

  {{-- <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <script>
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

  </script> --}}
@endpush