@extends('backend.layouts.master')
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
                <li class="breadcrumb-item active">Edit Invoice Details</li>
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
                            <h3 class="card-title">Edit Invoice Details</h3>
                        </div>
                    </div>
                    <form id="quickForm" method="POST" action="{{ route('admin.update.invoice',$invoice->id) }}">@csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" name="description" class="form-control" id="description" placeholder="Enter Name Of Investor" value="{{ $invoice->description}}" required>
                                </div>
                                @error('description')
                                    <span class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Amount</label>
                                    <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter amount" value="{{ $invoice->amount}}" required>
                                </div>
                                @error('amount')
                                    <span class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subscription_start_date">Subscription Start Date</label>
                                    <input type="date" name="subscription_start_date" class="form-control" id="subscription_start_date" placeholder="Enter amount" value="{{ $invoice->subscription_start_date}}" required>
    
                                </div>
                                @error('subscription_start_date')
                                    <span class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subscription_end_date">Subscription End Date</label>
                                    <input type="date" name="subscription_end_date" class="form-control" id="subscription_start_date" placeholder="Enter amount" value="{{ $invoice->subscription_end_date}}" required>
                                    
                                </div>
                                @error('subscription_end_date')
                                    <span class="text-danger">{{ $message}}</span>
                                @enderror
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
    </section>
</div>

@endsection