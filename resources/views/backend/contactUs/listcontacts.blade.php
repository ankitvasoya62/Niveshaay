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
                        <li class="breadcrumb-item active">Contact Us</li>
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
                            <h3 class="card-title">Contact Us</h3>
                            
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SR No</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Phone no.</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                @foreach ($contactus_list as $contact)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{ $contact->first_name}}</td>
                                        <td>{{ $contact->last_name}}</td>
                                        <td>{{ $contact->email}}</td>
                                        <td>{{ Str::limit($contact->message,20,' ...') }}</td>
                                        <td>{{ $contact->phone_no }}</td>
                                        <td>{{date("d-m-Y", strtotime($contact->created_at)) }}</td>
                                        <td><a style="cursor:pointer" data-toggle="modal" data-target="#modal-default" class="btn btn-info contact-details" id="{{ $contact->id }}" title="view"><i class="nav-icon fas fa-eye"></i></a></td>
                                        
                                        
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
        <div class="modal fade" id="modal-default" aria-modal="true" role="dialog">
            <div class="modal-dialog">
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
                        Name: <span id="contact-name" ></span>
                    </div>
                    <div class="col-md-12">
                        Email: <span id="contact-email" ></span>
                    </div>
                    <div class="col-md-12">
                        Phone no.: <span id="contact-phone" ></span>
                    </div>
                    <div class="col-md-12">
                        Message: <span id="contact-message" ></span>
                    </div>
                </div>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
                </div>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
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
    $('.contact-details').click(function(e){
        e.preventDefault();
        contact_id = $(this).attr('id');
        $.ajax({
            url: "{{  url('/admin/showcontact/') }}/"+contact_id,
                     type:"GET",
                     dataType:"json",
                     success:function(data) {
                        $('#contact-title').text(data.first_name + " " + data.last_name);
                        $('#contact-name').text(data.first_name + " " + data.last_name);
                        $('#contact-email').text(data.email);
                        $('#contact-phone').text(data.phone_no);
                        $('#contact-message').text(data.message);
                     
                      },
                      error:function(res){
                        
                      }
        });
    })
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
