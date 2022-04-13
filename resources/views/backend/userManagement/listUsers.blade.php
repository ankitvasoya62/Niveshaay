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
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
<section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        @if($route == 'user')
                            <h3 class="card-title">Users</h3>
                        @else
                            <h3 class="card-title">Admin Users</h3>
                        @endif
                            <div style="float:right; display:block;">
                                <button class="btn btn-success"> <a href="{{$route == "user" ? route('admin.add.users'):route('admin.add.admin-user')}}"
                                        class="text-light"><i class="fa fa-plus"></i> Add User</a> </button>
                                
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:5%">SR No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone No.</th>
                                        <th>Amount</th>
                                        <th>D.O.B</th>
                                        <th>Pan</th>
                                        <th style="width:10%">Subscription Start Date</th>
                                        <th style="width:10%">Subscription End Date</th>
                                        
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{ $user->name}}</td>
                                        <td>{{$user->email }}</td>
                                        <td>{{$user->phone_no }}</td>
                                        <td>{{$user->amount }}</td>
                                        <td>{{$user->dob }}</td>
                                        <td>{{$user->pan }}</td>
                                        <td>{{!empty($user->subscription_start_date) ? date("d-m-Y", strtotime($user->subscription_start_date)) : ""}}</td>
                                        <td>{{ !empty($user->subscription_end_date) ? date("d-m-Y", strtotime($user->subscription_end_date)) : "" }}</td>
                                        
                                        <td>
                                            <a href="{{route('admin.edit-user',$user->id)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                            <a onclick="return confirm('Are you sure want to delete?')"
                                                href="{{route('admin.delete-user',$user->id)}}" style="margin-left: 5px" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
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