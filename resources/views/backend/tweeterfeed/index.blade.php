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
                            <li class="breadcrumb-item active">Twitter Feeds</li>
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
                                <h3 class="card-title">Twitter Feeds</h3>
                                <div style="float:right; display:block;">
                                    <button class="btn btn-success"> <a href="{{route('admin.add.tweeter-feeds')}}"
                                            class="text-light"><i class="fa fa-plus"></i> Add a Tweet</a> </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SR No</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            
                                            <th>Description</th>
                                            
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($listtweeterfeed as $tweeterfeed)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td><img src="{{ asset('images/tweeter-feeds/'.$tweeterfeed->tweeter_user_image) }}" style="width:100px"></td>
                                            <td>{{ $tweeterfeed->tweeter_name }}</td>
                                            <td>{{ $tweeterfeed->tweeter_username }}</td>
                                            <td>{{ Str::limit($tweeterfeed->tweeter_description,50,'...') }}</td>
                                            
                                            
                                            <td>
                                                <a href="{{route('admin.edit.tweeter-feeds',$tweeterfeed->id)}}" class="btn btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                                                <a onclick="return confirm('Are you sure you want to delete this entry?')"
                                                    href="{{route('admin.delete.tweeter-feeds',$tweeterfeed->id)}}" class="btn btn-danger" title="Delete"><i class="fas fa-trash-alt"></i>
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