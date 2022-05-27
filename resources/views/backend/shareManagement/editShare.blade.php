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
  .note-editing-area .note-editable p{
    margin-left: 0px !important;
    margin-right: 0px !important;
  }
  .note-resize{
    display: none !important;
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
              <li class="breadcrumb-item active">Edit Research Report</li>
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
                <h3 class="card-title">Edit Research Report</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" class="update-report-form" method="POST" action="{{route('admin.update.share',$share->id)}}" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="copy_our_research" value="1" name="copy_to_our_research" @if($share->copy_to_our_research == 1) checked @endif>
                            <label for="copy_our_research" class="custom-control-label">Copy to Sample Research Reports</label>
                        </div>  
                        @error('copy_to_our_research')
                            <span class="error">{{$message}}</span>
                        @enderror
                    </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Company Logo</label>
                    <input type="file" class="form-control" id="shareLogo" name="share_logo">
                    @error('share_logo')
                        <span class="error">{{str_replace("share ","",$message)}}</span>
                    @enderror
                    <span class="error logo-error"></span>
                  </div>
                  <div class="form-group">
                    <img src="{{asset('images/share-logo/'.$share->share_logo)}}" width="150px" alt="">
                  </div>
                  <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" name="share_title" class="form-control" id="share_title" placeholder="Enter Title" value="{{ !empty(old('share_title')) ? old('share_title') : $share->share_title }}" >
                    @error('share_title')
                        <span class="error">{{str_replace("share ","",$message)}}</span>
                    @enderror
                    <span class="error title-error"></span>
                  </div>
                  @if($share->upload_type == 0)
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="name">Initiating Coverage Date</label>
                        <input type="date" name="share_date" class="form-control" id="share_date" placeholder="Enter Title" value="{{ !empty(old('share_date')) ? old('share_date') : $share->share_date }}"  max="9999-12-31">
                        @error('share_date')
                            <span class="error">{{str_replace("share ","",$message)}}</span>
                        @enderror
                        <span class="error date-error"></span>
                      </div>  
                    </div>
                  </div>
                  @endif
                  
                  <div class="form-group">
                    <label for="description">Short Description</label>
                    <textarea type="text" name="short_description" class="form-control" rows="5" cols="20" placeholder="Describe your title here...">{{ !empty(old('short_description')) ? old('short_description') : $share->short_description}}</textarea>
                    @error('short_description')
                        <span class="error">{{$message}}</span>
                    @enderror
                  </div>
                  @if($share->upload_type == 0)
                  <div class="form-group">
                    <label for="report-image">Report Image</label>
                    
                    <input type="file"  class="form-control" id="report-image" name="share_image">
                        
                     
                    @error('share_image')
                      <span class="error">{{str_replace("share ","",$message)}}</span>
                    @enderror
                    <span class="error image-error"></span>
                  </div>
                  <div class="form-group">
                    <img src="{{asset('images/share-images/'.$share->share_image)}}" width="150px" alt="">
                  </div>
                  @endif

                  @if($share->upload_type == 0)
                  <div class="row">
                    <div class="col-md-6">
                      <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Key Data</h3>
                        </div>
                    
                  
                        <div class="card-body">
                            <div class="form-group">
                              <label for="name">Industry</label>
                              <input type="text" name="share_industry" class="form-control" id="share_industry" placeholder="Enter Industry" value="{{ !empty(old('share_industry')) ? old('share_industry') : $share->share_industry }}" >
                              @error('share_industry')
                                  <span class="error">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label for="name">CMP</label>
                              <input type="text" name="share_cmp" class="form-control" id="share_cmp" placeholder="Enter CMP" value="{{ !empty(old('share_cmp')) ? old('share_cmp') :$share->share_cmp }}" >
                              @error('share_cmp')
                                  <span class="error">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label for="name">Market Cap</label>
                              <input type="text" name="share_market_cap" class="form-control" id="share_market_cap" placeholder="Enter Market Cap" value="{{ !empty(old('share_market_cap')) ? old('share_market_cap') : $share->share_market_cap }}" >
                              @error('share_market_cap')
                                  <span class="error">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label for="name">52 –Week High/Low</label>
                              <input type="text" name="share_week_high_low" class="form-control" id="share_week_high_low" placeholder="Enter 52 –Week High/Low" value="{{ !empty(old('share_week_high_low')) ? old('share_week_high_low') :$share->share_week_high_low }}" >
                              @error('share_week_high_low')
                                  <span class="error">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label for="name">Outlook</label>
                              <input type="text" name="share_outlook" class="form-control" id="share_outlook" placeholder="Enter Outlook" value="{{ !empty(old('share_outlook')) ? old('share_outlook') : $share->share_outlook}}" >
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
                              <input type="text" name="shareholding_promoters" class="form-control" id="shareholding_promoters" placeholder="Enter Promoteres" value="{{ !empty(old('shareholding_promoters')) ? old('shareholding_promoters') : $share->shareholding_promoters}}" >
                              @error('shareholding_promoters')
                                  <span class="error">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label for="mutual_funds">Mutual Funds</label>
                              <input type="text" name="mutual_funds" class="form-control" id="mutual_funds" placeholder="Enter Mutual Funds" value="{{!empty(old('mutual_funds')) ? old('mutual_funds') : $share->mutual_funds }}" >
                              @error('mutual_funds')
                                  <span class="error">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label for="mutual_funds">FIIs</label>
                              <input type="text" name="fiis" class="form-control" id="fiis" placeholder="Enter FIIs" value="{{!empty(old('fiis')) ? old('fiis') : $share->fiis}}" >
                              @error('fiis')
                                  <span class="error">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label for="name">Public</label>
                              <input type="text" name="shareholding_public" class="form-control" id="shareholding_public" placeholder="Enter public" value="{{ !empty(old('shareholding_public')) ? old('shareholding_public') :$share->shareholding_public}}" >
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
                              <input type="text" name="research_analyst_name" class="form-control" id="research_analyst_name" placeholder="Enter Name" value="{{!empty(old('research_analyst_name')) ? old('research_analyst_name') :$share->research_analyst_name}}" >
                              @error('research_analyst_name')
                                  <span class="error">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label for="name">Designation</label>
                              <input type="text" name="research_analyst_designation" class="form-control" id="research_analyst_designation" placeholder="Enter Designation" value="{{!empty(old('research_analyst_designation')) ? old('research_analyst_designation') : $share->research_analyst_designation}}" >
                              @error('research_analyst_designation')
                                  <span class="error">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label for="name">Email</label>
                              <input type="text" name="research_analyst_email" class="form-control" id="research_analyst_email" placeholder="Enter Email" value="{{ !empty(old('research_analyst_email')) ? old('research_analyst_email') :$share->research_analyst_email}}" >
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
                    <textarea name="share_description" class="form-control" id="summernote" rows="5" cols="20" placeholder="Describe your title here...">{{ !empty(old('share_description')) ? old('share_description') : $share->share_description}}</textarea>
                    {{-- <input type="file" name="share_description" class="form-control" accept="application/pdf"> --}}
                    @error('share_description')
                        <span class="error">{{str_replace("share ","",$message)}}</span>
                    @enderror
                  </div>
                  @else
                  <div class="form-group">
                    <label for="description">Upload pdf</label>
                    {{-- <textarea name="share_description" class="form-control" id="summernote" rows="5" cols="20" placeholder="Describe your title here...">{{ !empty(old('share_description')) ? old('share_description') : $share->share_description}}</textarea> --}}
                    <input type="file" name="pdf_name" class="form-control" id="upload_pdf" accept="application/pdf">
                    @error('pdf_name')
                        <span class="error">{{str_replace("pdf_name","pdf",$message)}}</span>
                    @enderror
                    <span class="error pdf-error"></span>
                  </div>
                  <div class="form-group">
                    <a href="{{ asset('pdf/'.$share->pdf_name) }}" target="_blank">{{ $share->pdf_name }}</a>
                  </div>
                  @endif
                  
                  <?php
                        $share_recommendation_array = explode(",",$share->share_recommendation);
                  ?>
                  <div class="form-group">
                    <label>Recommendation Categories</label>
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="0" name="share_recommendation[]" @if(in_array('0',$share_recommendation_array)) checked
                          
                      @endif>
                      <label for="customCheckbox1" class="custom-control-label" >Latest Additions</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="customCheckbox2" value="1" name="share_recommendation[]" @if(in_array('1',$share_recommendation_array)) checked
                          
                      @endif>
                      <label for="customCheckbox2" class="custom-control-label">Current Recommendations</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="quartelyResult" value="3" name="share_recommendation[]" @if(in_array('3',$share_recommendation_array)) checked
                          
                      @endif>
                      <label for="quartelyResult" class="custom-control-label">Quarterly Results</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="customCheckbox3" value="2" name="share_recommendation[]" @if(in_array('2',$share_recommendation_array)) checked
                          
                      @endif>
                      <label for="customCheckbox3" class="custom-control-label">Past Recommendations</label>
                    </div>
                  </div>
                    
                   
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" class="btn btn-primary report-submit" name="submit">Update</button>
                  <button type="button" class="btn btn-info report-draft" name="draft">Save as a Draft</button>
                  <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancel</button>
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
        $('#summernote').summernote({
          toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']],
          ],callbacks: {
          onImageUpload: function(files, editor, welEditable) {
              sendFile(files[0], editor, welEditable);
          }
        },
          disableResizeImage: true
        });

        function sendFile(file,editor,welEditable){
          var lib_url = "{{ route('admin.upload.image')}}";
          data = new FormData();
          data.append("file", file);
          $.ajax({
            data: data,
            type: "POST",
            headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: lib_url,
            cache: false,
            processData: false,
            contentType: false,
            success: function(url) {
                // console.log(url);
                var image = $('<img>').attr('src', url);
                $('#summernote').summernote("insertNode", image[0]);
            }
          });
        
        }

        // @if($share->upload_type == 1)

        //   $('.report-submit').click(function(){
        //     $('.title-error').text('');
        //     $('.logo-error').text('');
        //     $('.pdf-error').text('');
        //     var intJ = 0;
        //     if($('[name="share_title"]').val() == ''){
        //       $('[name="share_title"]').focus();
        //       $('.title-error').text('Title field is required');
        //       intJ = 1;
        //     }
        //     @if(empty($share->share_logo))
        //     var fileInput = document.getElementById('shareLogo');
        //     var filePath = fileInput.value;
        //     var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        //     if(filePath){
        //       if(!allowedExtensions.exec(filePath)){
        //         $('.logo-error').text('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        //         //alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        //         fileInput.value = '';
        //         intJ = 1;
        //       }
        //     }else{
        //       $('.logo-error').text('Logo field is required');
        //       // alert('Logo field is required');
        //       intJ = 1;
        //     }
        //     @endif

        //     @if(empty($share->pdf_name))
        //     var fileInput = document.getElementById('upload_pdf');
        //     var filePath = fileInput.value;
        //     var allowedExtensions = /(\.pdf)$/i;
        //     if(filePath){
        //       if(!allowedExtensions.exec(filePath)){
        //         $('.pdf-error').text('Please upload file having extensions .pdf only.');
        //         //alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        //         fileInput.value = '';
        //         intJ = 1;
        //       }
        //     }else{
        //       $('.pdf-error').text('PDF field is required');
        //       intJ = 1;
        //     }
        //     @endif
        //     if(intJ == 1){
        //       return false;
        //     }else{
        //       return true;
        //     }
            
        //   });
        //   @else
        //     $('.report-submit').click(function(){
        //         $('.title-error').text('');
        //         $('.logo-error').text('');
        //         $('.image-error').text('');
        //         $('.date-error').text('');
        //         var intJ = 0;
        //         if($('[name="share_title"]').val() == ''){
        //           $('[name="share_title"]').focus();
        //           $('.title-error').text('Title field is required');
        //           intJ = 1;
        //         }
        //         if($('[name="share_date"]').val() == ''){
        //           $('[name="share_date"]').focus();
        //           $('.date-error').text('Initiating coverage date field is required');
        //           intJ = 1;
        //         }

        //         @if(empty($share->share_logo))
        //         var fileInput = document.getElementById('shareLogo');
        //         var filePath = fileInput.value;
        //         var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        //         if(filePath){
        //           if(!allowedExtensions.exec(filePath)){
        //             $('.logo-error').text('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        //             //alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        //             fileInput.value = '';
        //             intJ = 1;
        //           }
        //         }else{
        //           $('.logo-error').text('Logo field is required');
        //           // alert('Logo field is required');
        //           intJ = 1;
        //         }
        //         @endif

        //         @if(empty($share->share_image))
        //         var fileInput = document.getElementById('report-image');
        //         var filePath = fileInput.value;
        //         var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        //         if(filePath){
        //           if(!allowedExtensions.exec(filePath)){
        //             $('.image-error').text('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        //             //alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        //             fileInput.value = '';
        //             intJ = 1;
        //           }
        //         }else{
        //           $('.image-error').text('Report image field is required');
        //           intJ = 1;
        //         }
        //         @endif
        //         if(intJ == 1){
        //           return false;
        //         }else{
        //           return true;
        //         }
                
        //       });
        // @endif
        
        
        $('.report-submit').click(function(){
          var data = new FormData( $( '.update-report-form' )[ 0 ] );
          data.append('submit','submit');
          $.ajax({
            data: data,
            type: "POST",
            headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: "{{route('admin.update.share',$share->id)}}",
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                // console.log(data);
                if(data.success == 1){
                  window.location.href = "{{ route('admin.share') }}";
                }else{
                  @if($share->upload_type == 1){
                      if(data.message.share_title){
                        $('.title-error').html(data.message.share_title[0]);
                      }
                      if(data.message.share_logo){
                        $('.logo-error').html(data.message.share_logo[0]);
                      }
                      if(data.message.pdf_name){
                        $('.pdf-error').html(data.message.pdf_name[0]);
                      }
                  }
                  @else
                    if(data.message.share_title){
                      $('.title-error').html(data.message.share_title[0]);
                    }
                    if(data.message.share_logo){
                      $('.logo-error').html(data.message.share_logo[0]);
                    }
                    if(data.message.share_image){
                      $('.image-error').html(data.message.share_image[0]);
                    }
                    if(data.message.share_description){
                      $('.description-error').html(data.message.share_description[0]);
                    }
                    if(data.message.share_date){
                      $('.date-error').html(data.message.share_date[0]);
                    }
                  @endif
                  
                  
                }
                
            }
          });
        });
        $('.report-draft').click(function(){
          var data = new FormData( $( '.update-report-form' )[ 0 ] );
          data.append('draft','draft');
          $.ajax({
            data: data,
            type: "POST",
            headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: "{{route('admin.update.share',$share->id)}}",
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
              window.location.href = "{{ route('admin.share') }}";  
    
                }
                
            
          });
        });
      });
    </script>
    

  {{-- <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <script>
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

  </script> --}}
@endpush