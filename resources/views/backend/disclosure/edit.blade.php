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
                <li class="breadcrumb-item active">Edit Disclosure</li>
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
                            <div class="card-title">Edit Disclosure</div>
                        </div>
                        <form id="quickForm" method="POST" action="{{route('admin.disclosure.update',$disclosure->id)}}" enctype="multipart/form-data">@csrf
                        <div class="card-body">
                            
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="financial_year">Finance year</label>
                                        <input type="text" name="financial_year" id="financial_year" class="form-control" value="{{ old('financial_year') ? old('financial_year') : $disclosure->financial_year  }}">
                                        @error('financial_year')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="audit_status">Audit Status</label>
                                        <input type="text" name="audit_status" id="audit_status" class="form-control" value="{{ old('audit_status') ? old('audit_status') : $disclosure->audit_status }}">
                                        @error('audit_status')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="remarks">Remarks</label>
                                <input type="text" name="remarks" id="remarks" class="form-control" value="{{ old('remarks') ? old('remarks') : $disclosure->remarks  }}">
                                @error('remarks')
                                    <span class="error">{{ $message }}</span>
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

@endsection


