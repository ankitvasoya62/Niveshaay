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
                            <li class="breadcrumb-item active">Featured On</li>
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
                                <h3 class="card-title">Featured On</h3>
                                <div style="float:right; display:block;">
                                    <button class="btn btn-success"> <a href="{{route('admin.add.featured-on')}}"
                                            class="text-light"><i class="fa fa-plus"></i> Add Featured On</a> </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SR No</th>
                                            <th>Image</th>
                                            <th>Date of Publish</th>
                                            <th style="width:5%">Title</th>
                                            <th>Logo</th>
                                            <th>Description</th>
                                            {{-- <th style="width:5%;">Link</th> --}}
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($listFeaturedOn as $FeaturedOn)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td><img src="{{ asset('images/featured/featured-image/'.$FeaturedOn->featured_image) }}" style="width:100px"></td>
                                            <td>{{ $FeaturedOn->featured_date }}</td>
                                            <td>{{ $FeaturedOn->featured_title }}</td>
                                            <td><img src="{{ asset('images/featured/featured-logo/'.$FeaturedOn->featured_logo) }}" style="width:100px"></td>
                                            <td>{{ Str::limit($FeaturedOn->featured_description,50,'...') }}</td>
                                            {{-- <td style="width:5%;">{{ $FeaturedOn->featured_url }}</td> --}}
                                            
                                            {{-- <td>{{date("d-m-Y", strtotime($share->created_at)) }}</td>
                                            <td>{{date("d-m-Y", strtotime($share->updated_at))}}</td> --}}
                                            
                                            <td>
                                                <a href="{{route('admin.edit.featured-on',$FeaturedOn->id)}}" class="btn btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                                                <a onclick="return confirm('Are you sure you want to delete this entry?')"
                                                    href="{{route('admin.delete.featured-on',$FeaturedOn->id)}}" class="btn btn-danger" title="Delete"><i class="fas fa-trash-alt"></i>
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
