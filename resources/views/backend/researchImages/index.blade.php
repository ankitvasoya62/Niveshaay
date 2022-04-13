@extends('backend.layouts.master')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset ('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset ('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<style>
    .sr_no_width{
        width:5% !important;
    }
    .action_width{
        width:15% !important;
    }
    .vertical-css{
        vertical-align: middle;
    }
</style>
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
                            <li class="breadcrumb-item active">Image Library</li>
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
                                <h3 class="card-title">Image Library</h3>
                                <div style="float:right; display:block;">
                                    <button class="btn btn-success"> <a href="{{route('admin.add.report-images')}}"
                                            class="text-light"><i class="fa fa-plus"></i> Add Images</a> </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="sr_no_width">SR No</th>
                                            <th>Title</th>
                                            {{-- <th>Image</th>
                                            <th>Path</th> --}}
                                            
                                            <th class="action_width">Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($list_research_images as $research_images)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td class="vertical-css">{{ $research_images->report_title }}</td>
                                            {{-- <td><img src="{{ asset('images/research-images/'.$research_images->report_image_path) }}" style="width:100px"></td>
                                            <td><input type="hidden" value="{{ asset('images/research-images/'.$research_images->report_image_path) }}" id="image_path_{{$research_images->id}}"><span>{{ asset('images/research-images/'.$research_images->report_image_path) }}</span><a id="{{$research_images->id}}" class="copy-to-clip-board" style="float:right;cursor:pointer" data-tooltip="tooltip" title="Copied"><i class="fas fa-clipboard"></i></a></td> --}}
                                            {{-- <td>{{ $tweeterfeed->tweeter_name }}</td>
                                            <td>{{ $tweeterfeed->tweeter_username }}</td>
                                            <td>{{ $tweeterfeed->tweeter_description }}</td> --}}
                                            {{-- <td>{{ $FeaturedOn->featured_description }}</td> --}}
                                            {{-- <td>{{ $FeaturedOn->featured_url }}</td> --}}
                                            
                                            {{-- <td>{{date("d-m-Y", strtotime($share->created_at)) }}</td>
                                            <td>{{date("d-m-Y", strtotime($share->updated_at))}}</td> --}}
                                            
                                            <td>
                                                
                                                <a href="{{ route('admin.show.report-images',$research_images->id)}}" class="btn btn-success"><i class="nav-icon fas fa-eye"></i></a>
                                                <a href="{{route('admin.edit.report-images',$research_images->id)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                                <a onclick="return confirm('Are you sure want to delete?')"
                                                    href="{{route('admin.delete.report-images',$research_images->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
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

    $('.copy-to-clip-board').click(function(e){
        e.preventDefault();
        // alert("in");
        
        var copy_to_clipboard_id = $(this).attr('id');
        var copyText = document.querySelector('#image_path_'+copy_to_clipboard_id);
        
        var tempInput = document.createElement("input");
        tempInput.style = "position: absolute; left: -1000px; top: -1000px";
        tempInput.value = copyText.value;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        
    })
});

</script>
<!--Data Table End -->
@endpush