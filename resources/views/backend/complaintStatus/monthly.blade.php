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
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Monthly</li>
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
                            <h3 class="card-title">Monthly</h3>
                        </div>
                        <div class="card-body">
                            <form method='POST' action="{{ route('admin.storemonthlycomplaint')}}">@csrf
                                <table class="table table-bordered table-striped" id="example1">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Carried Forward</th>
                                            <th>Received</th>
                                            <th>Resolved</th>
                                            <th>pending</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($monthlyComplaints as $key=>$monthly_complaint )
                                        <tr>
                                            <td>{{ $monthly_complaint['complaint_month_name'] }} - {{ $monthly_complaint['complaint_year'] }}<input type="hidden" value="{{ $monthly_complaint['complaint_month_number'] }}" name="month_{{ $key }}"><input type="hidden" value="{{ $monthly_complaint['complaint_year'] }}" name="year_{{ $key }}"> </td>
                                            <td><input type='number' name='carried_forward_{{ $key }}' class="form-control" value="{{ !empty($monthly_complaint['carried_forward']) ? $monthly_complaint['carried_forward'] : 0 }}"></td>
                                            <td><input type='number' name='received_{{ $key }}' class="form-control" value="{{ !empty($monthly_complaint['received']) ? $monthly_complaint['received'] : 0 }}"></td>
                                            <td><input type='number' name='resolved_{{ $key }}' class="form-control" value="{{ !empty($monthly_complaint['resolved']) ? $monthly_complaint['resolved'] : 0 }}"></td>
                                            <td><input type='number' name='pending_{{ $key }}' class="form-control" value="{{ !empty($monthly_complaint['pending']) ? $monthly_complaint['pending'] : 0 }}"></td>
                                            
                                        </tr>
                                        @endforeach
                                            
                                            
                                            

                                        
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection
@push('js')
<!-- DataTables -->

<script src="{{ asset ('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset ('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset ('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset ('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
     $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
        "sorting":false,
        "searching": false,
        "ordering": false,
        "paging": false,
        "lengthChange": false,
        "info": false,
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

</script>
@endpush