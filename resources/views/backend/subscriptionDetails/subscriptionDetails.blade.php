@extends('backend.layouts.master')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset ('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset ('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<style>
    .loader{
        position: fixed;
        left: 50%;
        top: 50%;
        display: none;
        background: transparent url("{{ asset('images/site-loader.svg') }}");
        z-index: 1000;
        height: 31px;
        width: 31px;
    }
</style>
@endpush
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Manage Subscription</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Subscription</h3>
                            <div class="row">
                                <div class="col-md-11">
                                    <div style="float:right; display:block;">
                                        <form action='{{ route('download.excel') }}' class="form-inline">
                                            
                                            <div class="form-group">
                                                <label>Export Date range:</label>&nbsp;
                            
                                                <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="date-range" class="form-control float-right" id="reservation">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <div class="form-group" style="margin-left:10px">
                                                <button type="submit" class="btn btn-success">Download Excel</button>
                                            </div>
                                        </form>
        
                                       
                                        
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-primary"> <a href="{{route('admin.subscription-detail.trash')}}"
                                        class="text-light"><i class="fa fa-trash-restore"></i> Trash</a> </button>
                                </div>
                            </div>
                            
                            
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:5%;">SR No</th>
                                        <th style="width:10%;">Date</th>
                                        <th style="width:10%;">Name of Investor</th>
                                        <th style="width:10%;">Email</th>
                                        
                                        <th style="width:10%;">PAN no.</th>
                                        <th style="width:10%;">Mobile no.</th>
                                        <th>Subscription Type</th>
                                        
                                        <th style="width:25%;">Subscription Action</th>
                                        <th style="width:20%;">Invoice Action & Downloads</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                @foreach ($subscription_details as $subscription_detail)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{date("d-m-Y", strtotime($subscription_detail->created_at)) }}</td>
                                        <td>{{ $subscription_detail->name_of_investor}}</td>
                                        <td>{{ $subscription_detail->email}}</td>
                                        
                                        <td>{{ $subscription_detail->pan_no}}</td>
                                        <td>{{ $subscription_detail->mobile_no}}</td>
                                        
                                        @if($subscription_detail->subscription_type == 1)
                                            <td><span class="badge badge-success">Company</span></td>
                                        @else
                                            <td><span class="badge badge-success">Individual</span></td>
                                        @endif
                                        
                                        <td>
                                            {{-- <a href="{{route('admin.edit.share',$share->id)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                            <a onclick="return confirm('Are you sure want to delete?')"
                                                href="{{ route('admin.delete.share',$share->id) }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
                                            </a> --}}
                                            <a href="{{ route('admin.show-details',$subscription_detail->id)}}" class="btn btn-info" title="View"><i class="nav-icon fas fa-eye"></i></a>
                                            <a href="{{ route('admin.edit-subscription',$subscription_detail->id)}}" class="btn btn-info" title="Edit"><i class="nav-icon fas fa-edit"></i></a>
                                            
                                            @if($subscription_detail->is_verified_by_admin == 0)
                                                <a class="btn btn-warning verify-admin-button" id="{{ $subscription_detail->id }}" data-toggle="modal" data-target="#modal-default" title="Verification Pending" style="cursor:pointer"><i class="fas fa-hourglass"></i></a>
                                            @else
                                                <span class="badge badge-success" style="height:40px;font-size:16px;padding:13px" title="Verified"><i class="fa fa-check" aria-hidden="true"></i>
                                                </span>
                                            @endif
                                            @if($subscription_detail->is_payment_received == 0)
                                                @if($subscription_detail->is_verified_by_admin == 0)
                                                <a class="btn btn-warning disabled" title="Confirm Payment"> <i class="fas fa-rupee-sign"></i></a>
                                                @else
                                            <a href="{{ route('admin.payment-received',$subscription_detail->id)}}" style="cursor:pointer"  class="btn btn-warning payment-received-button" data-toggle="modal" data-target="#invoice-modal" title="Confirm Payment" id="invoice_{{ $subscription_detail->id }}"> <i class="fas fa-rupee-sign"></i></a>
                                                @endif
                                             
                                            @else
                                                <span class="badge badge-success" style="height:40px;font-size:16px;padding:13px" title="Payment Received"><i class="fas fa-rupee-sign"></i><i class="fa fa-check"></i></span>
                                            @endif
                                            <a href="{{ route('admin.delete-subscription',$subscription_detail->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this entry?')" title="Delete"><i class="nav-icon fas fa-trash"></i></a>
                                        </td>
                                        <td>
                                            @if($subscription_detail->is_verified_by_admin == 1)
                                            {{-- <a href="{{ route('admin.view.invoicedetails',$subscription_detail->id) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a> --}}
                                            <a href="#" onclick="event.preventDefault();" class="btn btn-info invoice-details" title="Edit" data-toggle="modal" data-target="#modal-default-2" id="{{ $subscription_detail->id}}"><i class="fas fa-edit"></i></a>
                                            {{-- <a href="{{ route('admin.download.invoice',$subscription_detail->id)}}" class="btn btn-success" title="Download Details">Download Details</a> --}}
                                            <a href="{{ route('admin.download.invoicepdf',$subscription_detail->id)}}" class="btn btn-success @if($subscription_detail->is_payment_received == 0) disabled @endif" target="_blank" title="Download Invoice" title="Invoice"><i class="fas fa-file-invoice"></i></a>
                                            <a href="{{ route('admin.download.agreementpdf',$subscription_detail->id)}}" class="btn btn-success" target="_blank" title="Download Agreement"><i class="fas fa-file-contract"></i></a>
                                            <a href="{{ route('admin.download.riskprofilingpdf',$subscription_detail->id)}}" class="btn btn-success" target="_blank" title="Download Risk Profiling Pdf"><i class="fas fa-tachometer-alt"></i>
                                            </a>
                                            @else
                                            <a href="#" onclick="event.preventDefault();" class="btn btn-info disabled" title="edit"><i class="fas fa-edit"></i></a>
                                            {{-- <a href="#" class="btn btn-success disabled" title="Download Details">Download Details</a> --}}
                                            <a href="#" class="btn btn-success disabled" title="Invoice"><i class="fas fa-file-invoice"></i></a>
                                            <a href="#" class="btn btn-success disabled" title="Download Agreement"><i class="fas fa-file-contract"></i></a>
                                            <a href="{{ route('admin.download.riskprofilingpdf',$subscription_detail->id)}}" class="btn btn-success" target="_blank" title="Download Risk Profiling Pdf"><i class="fas fa-tachometer-alt"></i>
                                            </a>
                                            @endif
                                            
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <div class="modal fade" id="modal-default" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="contact-title"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body" id="contact-content">
            <div class="row">
                
               <div class="col-md-12">
                    <form id="payment-received-form" action="{{ route('admin.verify-subscription')}}" method="POST">@csrf
                        
                        
                    </form>
               </div> 
            </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-primary" id="payment-form-submit">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            
            </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-default-2" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="contact-title"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body" id="invoice-content">
            <div class="row">
                {{-- <div class="col-md-12" >
                    <a class="btn btn-primary add-invoice" style="float:right;margin-bottom:15px">Add More Invoice</a>
                </div> --}}
                <div class="loader">

                </div>
               <div class="col-md-12">
                    <form id="invoice-form" action="" method="POST">@csrf
                        
                        
                    </form>
               </div> 
            </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-primary" id="invoice-form-submit" onclick="fninvoicesubmit()">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            
            </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="invoice-modal" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="contact-title"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body" id="invoice-date-content">
            <div class="row">
                {{-- <div class="col-md-12" >
                    <a class="btn btn-primary add-invoice" style="float:right;margin-bottom:15px">Add More Invoice</a>
                </div> --}}
                <div class="loader">

                </div>
               <div class="col-md-12">
                    <form id="invoice-date-form" action="" method="POST">@csrf
                        
                        {{-- <input type="hidden" id="subscription_form_date_id" name="subscription_form_date_id"/>     --}}
                        <div class="form-group">
                            <label class="control-label">Invoice Date</label>
                            <input type="date" class="form-control" name="invoice_payment_date" id="invoice_payment_date" required value="<?php echo date('Y-m-d'); ?>">
                            <span style="color: red" class="invoice-date-error"></span>
                        </div>
                            
                        
                        
                    </form>
               </div> 
            </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-primary" id="invoice-date-form-submit" onclick="fninvoicedatesubmit()">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            
            </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
@endsection
@push('js')
<!-- DataTables -->
<script src="{{ asset('admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset ('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset ('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset ('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset ('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
        "columnDefs": [
        { "orderable": false, "targets": [6,7] }]
    });
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});
//Date range picker
$('#reservation').daterangepicker({
    autoUpdateInput: false,
    locale:{
        cancelLabel : 'clear'
    }
});
$('#reservation').on('apply.daterangepicker',function(ev,picker){
    $(this).val(picker.startDate.format('DD-MM-YYYY') +  ' - ' + picker.endDate.format('DD-MM-YYYY'))
});

$('#reservation').on('cancel.daterangepicker',function(ev,picker){
    $(this).val('');
});
// $('#reservation').val('');
</script>
<script>
    $(document).on('click','.verify-admin-button',function(){
        var subscription_id = $(this).attr('id');
        // $(this).attr('data-toggle','modal');
        // $(this).attr('data-target','#modal-default');
        $('#payment-received-form').html('');
        var appendhtml = '@csrf<input type="hidden" value="'+ subscription_id +'" id="subscription_form_id" name="subscription_form_id">';
        appendhtml += `<div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group d-inline">
                                <label class="control-label">Invoice number</label>
                                <input type="text" class="form-control" name="invoice_no" required id="subscription_invoice_no"> 
                                <span class="subscription-invoice-no-error" style="color:red"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group d-inline">
                                <label class="control-label">Fee Frequency</label>
                                <input type="text" class="form-control" name="fees_frequency" required id="fees_frequency"> 
                                <span class="fees-frequency-error" style="color:red"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group d-inline">
                                <label class="control-label">Agreement Date</label>
                                <input type="datetime-local" class="form-control" name="agreement_date" required id="agreement_date" max="9999-12-31"> 
                                
                                <span class="agreement-date-error" style="color:red"></span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>`;
        appendhtml += `<div class="card card-payment-form"><div class="card-header"><b>Invoice Details</b></div><div class="card-body"> <div class="row"><div class="col-md-6"><div class="form-group d-inline"><label class="control-label">Description</label><textarea class="form-control" name="description[]" required></textarea></div></div><div class="col-md-6"><div class="form-group d-inline"><label class="control-label">Amount(in numbers only)</label><input type="number" class="form-control" name="amount[]" required> </div></div><div class="col-md-6">
            <div class="form-group d-inline">
                <label class="control-label">Service Start Date</label>
                <input type="date" class="form-control" name="subscription_start_date[]" required max="9999-12-31"> 
            </div>
        </div>
        <div class="col-md-6"><div class="form-group d-inline"><label class="control-label">Amount(in text)</label><input type="text" class="form-control" name="amount_description[]" required>
        
            </div></div>
        <div class="col-md-6">
            <div class="form-group d-inline">
                <label class="control-label">Service End Date</label>
                <input type="date" class="form-control" name="subscription_end_date[]" required max="9999-12-31"> 
                <span class="subscription-end-date-error" style="color:red"></span>
            </div>
        </div>
        <div class="col-md-6">
            <span style="color:red">*To generate the invoice for research reports services, put the amount in numbers only in Amount (in numbers only) field. In other cases, use Amount (in text) box.</span>
        </div>
        </div></div></div>`;
        $('#payment-received-form').html(appendhtml);
    });
    $(document).on('click','.add-invoice',function(){
        var invoicecount = $('.card-payment-form').length + 1;
        var appendhtml = `<div class="card card-payment-form"><div class="card-header"><b>Invoice Details</b><a class="btn btn-danger" style="float:right" onclick="return removeinvoice(`+invoicecount+`)"><i class="nav-icon fas fa-trash"></i></a></div><div class="card-body"> <div class="row"><div class="col-md-6"><div class="form-group d-inline"><label class="control-label">Description</label><textarea class="form-control" name="description[]" required></textarea></div></div><div class="col-md-6"><div class="form-group d-inline"><label class="control-label">Amount</label><input type="number" class="form-control" name="amount[]" required> </div></div><div class="col-md-6">
                    <div class="form-group d-inline">
                        <label class="control-label">Service Start Date</label>
                        <input type="date" class="form-control" name="subscription_start_date[]" required max="9999-12-31"> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-inline">
                        <label class="control-label">Service End Date</label>
                        <input type="date" class="form-control" name="subscription_end_date[]" required max="9999-12-31"> 
                        <span class="subscription-end-date-error" style="color:red"></span>
                    </div>
                </div></div></div></div>`;
        $('#payment-received-form').append(appendhtml);
    });
    $('#payment-form-submit').click(function(){
        var subscription_start_date = document.getElementsByName('subscription_start_date[]');
        var subscription_end_date = document.getElementsByName('subscription_end_date[]');
        var errordate = document.querySelector('.subscription-end-date-error');
        intJ = 0;
        $('.subscription-end-date-error').html('');
        $('.subscription-invoice-no-error').html('');
        $('.fees-frequency-error').html('');

        for(var i=0;i<subscription_start_date.length;i++){
            if(subscription_end_date[i].value > subscription_start_date[i].value ){

            }else{
                intJ = 1;
                $('.subscription-end-date-error')[i].innerHTML = 'Subscription end date should be greater than subscription start date';
                // $('.'[i]).html('Subscription end date should be greater than subscription start date');
                // errordate[i].innerHTML = 'Subscription end date should be greater than subscription start date';
            }
        }

        if($('#subscription_invoice_no').val() == ""){
            $('.subscription-invoice-no-error').html('Invoice number field is required');
            intJ = 1;
        }
        if($('#fees_frequency').val() == ""){
            $('.fees-frequency-error').html('Fee Frequency field is required');
            intJ = 1;
        }
        // alert(intJ);
        // return false;
        if(intJ == 0){
            $('#payment-received-form').submit();
        }else{
            // alert("Subscription end date should be greater than subscription start date");
        }
        

    });

    function removeinvoice(id){
        $('.card-payment-form')[id-1].remove();
        return false;
    }

    $('.invoice-details').click(function(e){
        e.preventDefault();
        subscription_form_id = $(this).attr('id');
        $.ajax({
            url: "{{  url('/admin/edit/invoice') }}/"+subscription_form_id,
                     type:"GET",
                     dataType:"json",
                     success:function(data) {
                        
                        console.log(data.length);
                        $('#invoice-form').attr('action',"{{  url('/admin/update/invoice') }}/"+subscription_form_id);
                        $('#invoice-form').html('');
                        var invoicehtml = '';
                        $.each(data,function(index,value){
                            value.amount_description = value.amount_description == null ? '' : value.amount_description;
                            value.amount = value.amount== null ? '' : value.amount;
                            value.fees_frequency = value.fees_frequency==null ? '' : value.fees_frequency;
                            value.agreement_date = value.agreement_date==null ? '' : value.agreement_date;
                            value.invoice_date = value.invoice_date==null ? '' : value.invoice_date;
                            if(index == 0){
                                invoicehtml += `<div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group d-inline">
                                                                    <label class="control-label">Invoice number</label>
                                                                    <input type="text" class="form-control" name="invoice_no" value="`+ value.invoice_no+`" required id="subscription_invoice_no"> 
                                                                    <span class="subscription-invoice-no-error" style="color:red"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group d-inline">
                                                                    <label class="control-label">Fee Frequency</label>
                                                                    <input type="text" class="form-control" name="fees_frequency"  value="`+ value.fees_frequency+`" required id="fees_frequency"> 
                                                                    <span class="fees-frequency-error" style="color:red"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group d-inline">
                                                                    <label class="control-label">Agreement Date</label>
                                                                    
                                                                    <input type="datetime-local" class="form-control" name="agreement_date" required id="agreement_date" value="${value.agreement_date}"> 
                                                                    <span class="agreement-date-error" style="color:red"></span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-6">
                                                                <div class="form-group d-inline">
                                                                    <label class="control-label">Invoice Date</label>
                                                                    <input type="date" class="form-control" name="invoice_date" required id="invoice_date" max="9999-12-31" value="${value.invoice_date}"> 
                                                                    <span class="invoice-date-error" style="color:red"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>`;
                                invoicehtml += `@csrf<div class="card"><div class="card-body"><div class="row">
                                                    <input type="hidden" value="`+ value.id+`" name="invoice_id[]">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input type="text" class="form-control" name="description[]" value="`+ value.description+`">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Amount(in numbers only)</label>
                                                            <input type="number" class="form-control" name="amount[]" value="`+ value.amount+`">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Service Start Date</label>
                                                            <input type="date" class="form-control" name="subscription_start_date[]" value="`+ value.subscription_start_date+`" id="subscription_start_date" max="9999-12-31">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6"><div class="form-group d-inline"><label class="control-label">Amount(in text)</label>
                                                        <input type="text" class="form-control" name="amount_description[]" value="`+ value.amount_description+`" required> 
                                                        
                                                    </div></div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Service End Date</label>
                                                            <input type="date" class="form-control" name="subscription_end_date[]" value="`+ value.subscription_end_date+`" id="subscription_end_date" max="9999-12-31">
                                                            <span class="text-danger invoice_end_date_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span style="color:red">*To generate the invoice for research reports services, put the amount in numbers only in Amount (in numbers only) field. In other cases, use Amount (in text) box.</span>
                                                    </div>
                                                </div></div></div>`

                            }else{
                                invoicehtml += `<div class="card"><div class="card-body"><div class="row">
                                                    <input type="hidden" value="`+ value.id+`" name="invoice_id[]">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input type="text" class="form-control" name="description[]" value="`+ value.description+`">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Amount(in numbers only)</label>
                                                            <input type="number" class="form-control" name="amount[]" value="`+ value.amount+`">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Service Start Date</label>
                                                            <input type="date" class="form-control" name="subscription_start_date[]" value="`+ value.subscription_start_date+`" max="9999-12-31">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6"><div class="form-group d-inline"><label class="control-label">Amount(in text)</label><input type="text" class="form-control" name="amount_description[]" value="`+ value.amount_description+`" required>
                                                        
                                                    </div></div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Service End Date</label>
                                                            <input type="date" class="form-control" name="subscription_end_date[]" value="`+ value.subscription_end_date+`" max="9999-12-31">
                                                            <span class="text-danger invoice_end_date_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span style="color:red">*To generate the invoice for research reports services, put the amount in numbers only in Amount (in numbers only) field. In other cases, use Amount (in text) box.</span>
                                                    </div>
                                                </div></div></div>`

                            }
                            });
                            $('#invoice-form').html(invoicehtml);
                      },
                      error:function(res){
                        
                      }
        });
    });
    $(document).on('.invoice-form-submit','click',function(e){
        e.preventDefault();
        var subscriptionformaction = $('#invoice-form').attr('action');
        $.ajax({
            url:subscriptionformaction,
            type:'POST',
            data:$('#invoice-form').seriallize(),
            success:function(data) {

                console.log(data);                
                     
            },
            error:function(res){
            
            }
        });        
    });
    // $(".invoice-form-submit").click(function(e){
        
    // })
    function fninvoicesubmit(){
        var subscription_start_date = document.getElementsByName('subscription_start_date[]');
        var subscription_end_date = document.getElementsByName('subscription_end_date[]');
        var errordate = document.querySelector('.invoice_end_date_error');
        intJ = 0;
        $('.invoice_end_date_error').html('');
        $('.subscription-invoice-no-error').html('');
        $('.fees-frequency-error').html('');
        for(var i=0;i<subscription_start_date.length;i++){
            if(subscription_end_date[i].value > subscription_start_date[i].value ){

            }else{
                intJ = 1;
                $('.invoice_end_date_error')[i].innerHTML = 'Subscription end date should be greater than subscription start date';
                // $('.'[i]).html('Subscription end date should be greater than subscription start date');
                // errordate[i].innerHTML = 'Subscription end date should be greater than subscription start date';
            }
        }
        // alert(intJ);
        // return false;
        if($('#subscription_invoice_no').val() == ""){
            $('.subscription-invoice-no-error').html('Invoice number field is required');
            intJ = 1;
        }

        if($('#fees_frequency').val() == ""){
            $('.fees-frequency-error').html('Fee Frequency field is required');
            intJ = 1;
        }

        if(intJ == 0){
            var subscriptionformaction = $('#invoice-form').attr('action');
            $.ajax({
                url:subscriptionformaction,
                type:'POST',
                data:$('#invoice-form').serialize(),
                
                success:function(data) {

                    if(data.success == 1){
                            window.location.href = window.location.href;
                    }else{
                        
                        console.log(data);
                    }
                
                        
                },
                error:function(res){
                   
                }
            });
        }else{
            
            // alert("Subscription end date should be greater than subscription start date");
        }
        // var subscription_start_date = document.getElementById('subscription_start_date');
        // var subscription_end_date = document.getElementById('subscription_end_date');
        // if(subscription_start_date.value < subscription_end_date.value ){
        //     var subscriptionformaction = $('#invoice-form').attr('action');
        //     $.ajax({
        //         url:subscriptionformaction,
        //         type:'POST',
        //         data:$('#invoice-form').serialize(),
                
        //         success:function(data) {

        //             if(data.success == 1){
        //                     window.location.href = window.location.href;
        //             }else{
                        
        //                 console.log(data);
        //             }
                
                        
        //         },
        //         error:function(res){
                   
        //         }
        //     }); 
        // }else{
        //     $('#invoice_end_date_error').focus();
        //     $('#invoice_end_date_error').html("Subscription end date should be greater than subscription start date");
            
        // }
               
    }

    $(document).on('click','.payment-received-button',function(){
        var subscription_id = $(this).attr('id');
        subscription_id = subscription_id.split("invoice_")[1];
        $('#invoice-date-form').attr('action',"{{  url('/admin/payment-received') }}/"+subscription_id);
        //$('invoice-date-form #subscription_form_date_id').val(subscription_id);
    });
    function fninvoicedatesubmit(){
        $('.invoice-date-error').html('');
        
        var invoice_date = $('#invoice_payment_date').val();
        if(invoice_date){
            $('#invoice-date-form-submit').addClass('disabled');
            var subscriptionformaction = $('#invoice-date-form').attr('action');
            $.ajax({
                url:subscriptionformaction,
                type:'POST',
                data:$('#invoice-date-form').serialize(),
                
                success:function(data) {
                    $('#invoice-date-form-submit').removeClass('disabled');
                    if(data.success == 1){
                            window.location.href = window.location.href;
                    }else{
                        
                        console.log(data);
                    }
                
                        
                },
                error:function(res){
                    $('#invoice-date-form-submit').removeClass('disabled');
                    $('.invoice-date-error').html('Something went wrong');
                }
            });
        }else{
            
            $('.invoice-date-error').html('Invoice Date is required');
        }
    }
</script>
<!--Data Table End -->
@endpush
