@extends('backend.layouts.master')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset ('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset ('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
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
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Invoice Details</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Invoice Details</h3>
                                {{-- <div style="float:right; display:block;">
                                    <button class="btn btn-success"> <a href="{{ route('admin.newsletter.add')}}"
                                            class="text-light"><i class="fa fa-plus"></i>&nbsp;Add New</a> </button>
                                </div> --}}
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">SR No</th>
                                            <th>Title</th>
                                            <th>Subscription Start Date</th>
                                            <th>Subscription End Date</th>
                                            <th>Amount</th>
                                            <th style="width: 15%">Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($invoice_details as $invoice_detail)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{ $invoice_detail->description }}</td>
                                            <td>{{ $invoice_detail->subscription_start_date }}</td>
                                            <td>{{ $invoice_detail->subscription_end_date }}</td>
                                            <td>{{ $invoice_detail->amount }}</td>
                                            
                                            <td>
                                                <a href="{{ route('admin.edit.invoice',$invoice_detail->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                            </td>
                                            
                                        </tr>
                                        
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </section>
    </div>
@endsection