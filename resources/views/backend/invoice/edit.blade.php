@extends('backend.layouts.master')
@push('css')
<style>
  .error{
      color:red;
  }
  
  </style>
  <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
                <li class="breadcrumb-item active">Edit Invoice</li>
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
                            <div class="card-title">Edit Invoice</div>
                        </div>
                        <form id="quickForm" method="POST" action="{{route('admin.invoice.update',$invoice->id)}}" enctype="multipart/form-data">@csrf
                        <div class="card-body">
                            {{-- <div class="form-group">
                                <label for="name_of_investor">Name Of Investor</label>
                                <input type="text" name="name_of_investor" id="name_of_investor" class="form-control" value="{{ old('name_of_investor') }}">
                                @error('name_of_investor')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div> --}}
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="service_type">Service Type</label>
                                        <select name="service_type" class="form-control" disabled>
                                            <option value="0" @if($invoice->service_type == 0) selected @endif>Research Report Service</option>
                                            <option value="1" @if($invoice->service_type == 1) selected @endif>Equity Advisory Service</option>
                                        </select>
                                        @error('service_type')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="invoice_no">Invoice no.</label>
                                        <input type="text" name="invoice_no" id="invoice_no" class="form-control" value="{{ $invoice->invoice_no }}">
                                        @error('invoice_no')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            {{-- <div class="form-group">
                                <label for="pan_no">PAN no.</label>
                                <input type="text" name="pan_no" id="pan_no" class="form-control" value="{{ old('pan_no') }}">
                                @error('pan_no')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="gst_no">GST no.</label>
                                <input type="text" name="gst_no" id="gst_no" class="form-control" value="{{ old('gst_no') }}">
                                @error('gst_no')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="state">State</label>
                                <input type="text" name="state" id="state" class="form-control" value="{{ old('state') }}">
                                @error('state')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div> --}}
                            {{-- <div class="form-group">
                                <label>User</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="user">
                                    <label class="form-check-label">Existing User</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="user" checked="">
                                    <label class="form-check-label">New User</label>
                                </div>
                            </div> --}}
                            <?php 
                                $users = DB::table('users')
                                        ->select('users.*')
                                        
                                        ->where('is_admin',0)->orderBy('name','asc')->get();

                            ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Name Of Investor</label>
                                        <select name="user_id" class="form-control" disabled>
                                            @foreach ($users as $user)
                                                
                                                <option value="{{ $user->id }}"  @if($user->id == $invoice->subscriptionForm->user_id) selected @endif>{{ $user->name }}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pan_no">PAN no.</label>
                                        <input type="text" name="pan_no" id="pan_no" class="form-control" value="{{ $invoice->subscriptionForm->pan_no }}">
                                        @error('pan_no')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gst_no">GST no.</label>
                                        <input type="text" name="gst_no" id="gst_no" class="form-control" value="{{ $invoice->subscriptionForm->gst_no }}">
                                        @error('gst_no')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="street_address">Street Address</label>
                                <input type="text" name="street_address" class="form-control" value="{{ $invoice->subscriptionForm->street_address }}">
                            </div>
                            <?php 
                                $states = getStates();
                            ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <select class="form-control select2bs4" name="state">
                                            <option value="">SELECT ONE</option>
                                            @foreach ($states as $state)
                                                <option value="{{$state}}" @if($state == $invoice->subscriptionForm->state) selected @endif>{{ $state }}
                                                </option>    
                                            @endforeach
                                            
                                        </select>
                                        @error('state')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            {{-- <div class="new-user-wrap">
                                <div class="form-group">
                                    <label for="description">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="descriphone_no">Phone No.</label>
                                    <input type="text" name="phone_no" id="phone_no" class="form-control" value="{{ old('phone_no') }}">
                                    @error('phone_no')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                            
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description" class="form-control" value="{{ $invoice->description }}">
                                @error('description')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="subscription_start_date">Subscription Start Date</label>
                                        <input type="date" name="subscription_start_date" id="subscription_start_date" class="form-control" value="{{ $invoice->subscription_start_date }}">
                                        @error('subscription_start_date')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="subscription_end_date">Subscription End Date</label>
                                        <input type="date" name="subscription_end_date" id="subscription_end_date" class="form-control" value="{{ $invoice->subscription_end_date }}">
                                        @error('subscription_end_date')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="number" name="amount" id="amount" class="form-control" value="{{ $invoice->amount }}">
                                        @error('amount')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
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
@push('js')
<script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    
//Initialize Select2 Elements
$('.select2bs4').select2({
theme: 'bootstrap4'
});
</script>

@endpush