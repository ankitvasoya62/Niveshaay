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
                        <a class="btn btn-primary" href="{{ route('admin.newsletter.users') }}">Back</a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Trash Subscribed Users</li>
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
                                <h3 class="card-title">Trash Newsletter Subscribed Users</h3>
                                {{-- <div style="float:right; display:block;">
                                    <button class="btn btn-success"> <a href="{{ route('admin.newsletter.add.users')}}"
                                            class="text-light"><i class="fa fa-plus"></i>&nbsp;Add New</a> </button>
                                </div> --}}
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
                                            {{-- <th>Status</th> --}}
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
                                            {{-- <td>
                                                @if($newsletteruser->status == 'active')
                                                    <span class="badge badge-success">active</span>
                                                @else
                                                <span class="badge badge-warning">inactive</span>
                                                @endif
                                            </td> --}}
                                            <td>
                                                <a onclick="return confirm('Are you sure you want to restore this entry?')"
                                                href="{{route('admin.newsletteruser.restorenewsusers',$newsletteruser->id)}}" class="btn btn-warning" title="Restore"><i class="fas fa-undo"></i>
                                                </a>
                                                <a onclick="return confirm('Are you sure you want to delete this entry?')"
                                                    href="{{route('admin.newsletteruser.permanent-deletenewsusers',$newsletteruser->id)}}" class="btn btn-danger" title="Delete"><i class="fas fa-trash"></i>
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
        "columnDefs": [
        { "orderable": false, "targets": [6] }]
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