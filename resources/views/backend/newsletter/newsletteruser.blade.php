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
                            <li class="breadcrumb-item active">Subscribed Users</li>
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
                                <h3 class="card-title">Newsletter Subscribed Users</h3>
                                <div style="float:right; display:block;">
                                    <button class="btn btn-success"> <a href="{{ route('admin.newsletter.add.users')}}"
                                            class="text-light"><i class="fa fa-plus"></i>&nbsp;Add New</a> </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">SR No</th>
                                            <th>First Name</th>
                                            <th>last Name</th>
                                            <th>Email</th>
                                            <th>Phone no.</th>
                                            <th>Status</th>
                                            {{-- <th style="width: 15%">Client Designation</th> --}}
                                            <th style="width: 15%">Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($newsletterusers as $newsletteruser)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{ $newsletteruser->first_name }}</td>
                                            <td>{{ $newsletteruser->last_name }}</td>
                                            <td>{{ $newsletteruser->email }}</td>
                                            <td>{{ $newsletteruser->phone_no }}</td>
                                            {{-- <td>{{ Str::limit($client->client_description,50,'...') }}</td>
                                            <td><img src="{{ asset('images/clients/'.$client->client_image)}}"></td>
                                            <td>{{ $client->client_designation }}</td> --}}
                                            {{-- <td>{{date("d-m-Y", strtotime($share->created_at)) }}</td>
                                            <td>{{date("d-m-Y", strtotime($share->updated_at))}}</td> --}}
                                            <td>
                                                @if($newsletteruser->status == 'active')
                                                    <span class="badge badge-success">active</span>
                                                @else
                                                <span class="badge badge-warning">inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.newsletter.edit.users',$newsletteruser->id)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                                
                                                @if($newsletteruser->status == 'active')
                                                    <a href="{{ route('admin.newsletter.deactive.user',$newsletteruser->id)}}" class="btn btn-warning"><i class="fas fa-ban"></i></a>
                                                @else
                                                <a href="{{ route('admin.newsletter.active.user',$newsletteruser->id)}}" class="btn btn-success"><i class="fas fa-check"></i></a>
                                                @endif
                                                <a onclick="return confirm('Are you sure want to delete?')"
                                                    href="{{ route('admin.newsletter.delete.users',$newsletteruser->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
                                                </a>
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