@extends('backend.layouts.master')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset ('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset ('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
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
                        <li class="breadcrumb-item active">Research Reports</li>
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
                            <h3 class="card-title">Research Reports</h3>
                            <div style="float:right; display:block;">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-flat">Add New Report</button>
                                    <button type="button" class="btn btn-success btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                      <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu" style="">
                                      <a class="dropdown-item" href="{{route('admin.add.share',0)}}">Upload Manually</a>
                                      <a class="dropdown-item" href="{{route('admin.add.share',1)}}">Upload Via Pdf</a>
                                      
                                    </div>
                                </div>
                                <button class="btn btn-primary"> <a href="{{route('admin.report.trash')}}"
                                        class="text-light"><i class="fa fa-trash-restore"></i> Trash</a> </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SR No</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Added On</th>
                                        <th>Updated On</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                @foreach ($share_list as $share)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{ $share->share_title}}</td>
                                        @if($share->share_status == 1)
                                            <td><span class="badge badge-success">Published</span></td>
                                        @else
                                            <td><span class="badge badge-info">Draft</span></td>
                                        @endif
                                        <td>{{date("d-m-Y", strtotime($share->created_at)) }}</td>
                                        <td>{{date("d-m-Y", strtotime($share->updated_at))}}</td>
                                        
                                        <td>
                                            @if ($share->share_status == 0)
                                            
                                                @if($share->upload_type == 0 )
                                                    <a href="{{ route('admin.view.report',$share->id)}}" class="btn btn-primary" target="_blank"><i class="fas fa-eye"></i></a>    
                                                @else
                                                    <a href="{{ asset('pdf/'.$share->pdf_name) }}" target="_blank" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                                @endif
                                            @endif
                                            
                                            <a href="{{route('admin.edit.share',$share->id)}}" class="btn btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                                            <a onclick="return confirm('Are you sure you want to delete this entry?')"
                                                href="{{ route('admin.delete.share',$share->id) }}" class="btn btn-danger" title="Delete"><i class="fas fa-trash-alt"></i>
                                            </a>
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

</div>
@endsection
@push('js')
<!-- DataTables -->
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
        { "orderable": false, "targets": [4] }]
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
</script>
<!--Data Table End -->
@endpush
