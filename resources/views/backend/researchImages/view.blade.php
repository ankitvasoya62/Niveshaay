@extends('backend.layouts.master')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset ('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset ('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<style>
    .padding-div{
        border: 1px solid grey;padding:15px;  
    }
    .card-img{
      max-height:100px;
  }
  .images-card{
    width: 20rem;
    height:320px;
    padding:15px;
  }
  .path-css-design{
    background: lightgrey;
    padding: 5px;
    margin-bottom: 20px;
    font-weight: bold;
    border-radius: 5px;
    height:85px;
  }

</style>
@endpush
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Research Images</li>
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
                            <h3 class="card-title"><strong>Title: {{ $research_images->report_title }}<strong></h3>
                            {{-- <div style="float:right; display:block;">
                                <button class="btn btn-success"> <a href="{{route('admin.add.report-images')}}"
                                        class="text-light"><i class="fa fa-plus"></i> Add Research Images</a> </button>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="form-group">

                                <div class="row">
                                    @foreach ($research_images_path as $row )
                                        <div class="col-md-3" >
                                            <div class="card images-card">
                                                <img src="{{ asset('images/research-images/'. $research_images->id.'/'.$row['report_image_path']) }}" class="card-img-top card-img" alt="...">
                                                <div class="card-body">
                                                    <div class="text-center path-css-design">
                                                        <span id="image_path_{{ $row['id']}}">{{ asset('images/research-images/'. $research_images->id.'/'.$row['report_image_path']) }}</span>
                                                    </div>
                                                    <div class="text-center">
                                                        <a class="btn btn-success copy-to-clip-board btn-lg" id="{{ $row['id'] }}" data-toggle="tooltip" data-placement="top" title="Copied"><i class="fas fa-clipboard"></i>&nbsp;&nbsp;Copy Path</a>
                                                    </div>
                                                    
                                                </div>
                                              </div>
                                            {{-- <a style="float: right" class="btn btn-danger" href="{{route('admin.delete.report-images',$row['id'])}}"><i class="fas fa-trash-alt"></i></a> --}}
                                            {{-- <div class="col-md-12">
                                                <img src="" style="width: 100%;max-height:100px"><br><br>
                                            </div> --}}
                                            
                                            {{-- <div class="col-md-12 text-center">
                                                <span id="image_path_{{ $row['id']}}">{{ asset('images/research-images/'.$row['image_path']) }}</span><br><br>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <a class="btn btn-info copy-to-clip-board" id="{{ $row['id'] }}" data-toggle="tooltip" data-placement="top" title="Copied"><i class="fas fa-clipboard"></i>&nbsp;&nbsp;Copy Path</a><br><br>
                                            </div> --}}
                                            
                                        </div>    
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </section>
</div>
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
        var copyText = $('#image_path_'+copy_to_clipboard_id).text();
        var tempInput = document.createElement("input");
        tempInput.style = "position: absolute; left: -1000px; top: -1000px";
        tempInput.value = copyText;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        $(this).tooltip('show')

        
    })
});

</script>
<!--Data Table End -->
@endpush
@endsection