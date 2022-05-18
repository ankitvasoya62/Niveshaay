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
                        <li class="breadcrumb-item active">Current Month</li>
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
                            <h3 class="card-title">Current Month</h3>
                        </div>
                        <div class="card-body">
                            <form method='POST' action="{{ route('admin.storecurrentmonthcomplaint')}}">@csrf
                                <table class="table table-bordered table-striped" id="example1">
                                    <thead>
                                        <tr>
                                            <th>Received From</th>
                                            <th>Pending- last month </th>
                                            <th>Received</th>
                                            <th>Resolved</th>
                                            <th>Total pending</th>
                                            <th>Pending > 3M</th>
                                            <th>Avg. resolution time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            <tr>
                                                <td>Investors</td>
                                                <td><input type='number' name='investor[]' class="form-control" value="{{ !empty($current_month_investor_count->pending_last_month) ? $current_month_investor_count->pending_last_month : 0 }}"></td>
                                                <td><input type='number' name='investor[]' class="form-control" value="{{ !empty($current_month_investor_count->received) ? $current_month_investor_count->received : 0 }}"></td>
                                                <td><input type='number' name='investor[]' class="form-control" value="{{ !empty($current_month_investor_count->resolved) ? $current_month_investor_count->resolved : 0}}"></td>
                                                <td><input type='number' name='investor[]' class="form-control" value="{{ !empty($current_month_investor_count->total_pending) ? $current_month_investor_count->total_pending : 0 }}"></td>
                                                <td><input type='number' name='investor[]' class="form-control" value="{{ !empty($current_month_investor_count->pending_3m) ? $current_month_investor_count->pending_3m : 0 }}"></td>
                                                <td><input type='number' name='investor[]' class="form-control" value="{{ !empty($current_month_investor_count->avg_resolution_time) ? $current_month_investor_count->avg_resolution_time : 0 }}"></td>
                                            </tr>
                                            <tr>
                                                <td>SEBI Scores</td>
                                                <td><input type='number' name='sebi_scores[]' class="form-control" value="{{ !empty($sebi_scores_count->pending_last_month) ? $sebi_scores_count->pending_last_month : 0 }}"></td>
                                                <td><input type='number' name='sebi_scores[]' class="form-control" value="{{ !empty($sebi_scores_count->received) ? $sebi_scores_count->received : 0 }}"></td>
                                                <td><input type='number' name='sebi_scores[]' class="form-control" value="{{ !empty($sebi_scores_count->resolved) ? $sebi_scores_count->resolved : 0 }}"></td>
                                                <td><input type='number' name='sebi_scores[]' class="form-control" value="{{ !empty($sebi_scores_count->total_pending) ? $sebi_scores_count->total_pending :0 }}"></td>
                                                <td><input type='number' name='sebi_scores[]' class="form-control" value="{{ !empty($sebi_scores_count->pending_3m) ? $sebi_scores_count->pending_3m : 0}}"></td>
                                                <td><input type='number' name='sebi_scores[]' class="form-control" value="{{ !empty($sebi_scores_count->avg_resolution_time) ? $sebi_scores_count->avg_resolution_time : 0}}"></td>
                                            </tr>
                                            <tr>
                                                <td>Other Sources</td>
                                                <td><input type='number' name='other_sources[]' class="form-control" value="{{ !empty($other_sources_count->pending_last_month ) ? $other_sources_count->pending_last_month : 0 }}"></td>
                                                <td><input type='number' name='other_sources[]' class="form-control" value="{{ !empty($other_sources_count->received ) ? $other_sources_count->received : 0 }}"></td>
                                                <td><input type='number' name='other_sources[]' class="form-control" value="{{ !empty($other_sources_count->resolved ) ? $other_sources_count->resolved : 0 }}"></td>
                                                <td><input type='number' name='other_sources[]' class="form-control" value="{{ !empty($other_sources_count->total_pending ) ? $other_sources_count->total_pending : 0 }}"></td>
                                                <td><input type='number' name='other_sources[]' class="form-control" value="{{ !empty($other_sources_count->pending_3m ) ? $other_sources_count->pending_3m : 0 }}"></td>
                                                <td><input type='number' name='other_sources[]' class="form-control" value="{{ !empty($other_sources_count->avg_resolution_time ) ? $other_sources_count->avg_resolution_time : 0 }}"></td>
                                            </tr>

                                        
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