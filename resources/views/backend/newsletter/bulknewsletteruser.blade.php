@extends('backend.layouts.master')
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
                        <li class="breadcrumb-item active">Bulk Newsletter Users Import</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card mt-3">

                <div class="card-header">
                    <h3 class="card-title">Bulk Newsletter Users Import</h3>
                    
                </div>
                @if (session()->has('failures'))
                <div class="card-body">
                        <table class="table table-danger">
                            <tr>
                                <th>Row</th>
                                <th>Attribute</th>
                                <th>Errors</th>
                                <th>Values</th>
                            </tr>
                            @foreach (session()->get('failures') as $validation)
                                <tr>
                                    <td>{{$validation->row()}}</td>
                                    <td>{{$validation->attribute()}}</td>
                                    <td>
                                        <ul>
                                            @foreach ($validation->errors() as $e)
                                                <li>{{$e}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{$validation->values()[$validation->attribute()]}}</td>
                                </tr>
                            @endforeach
                        </table>
                        <table class="table table-success">
                            <tr>
                                <td>Total Affected Rows : {{session()->get('rows')}}</td>
                            </tr>
                        </table>
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('admin.newsletter.storebulk.user') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-5 form-group">
                                <input type="file" name="file" class="form-control" >
                                
                            </div>
                            <div class="col-md-7 form-group" style="padding-top: 5px">
                                <span style="color:red">*The file type should be: .csv, .xls, .xlsx.</span>
                            </div>
                        </div>
                        
                        <button class="btn btn-success">Import Bulk Newsletter Subscribers</button>
                        <a class="btn btn-warning" href="{{ asset('images/Book1.xlsx') }}" download>Download Demo Excel</a>{{-- <a class="btn btn-warning" href="#">Export User Data</a> --}}
                    </form>
                    
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    

                </div>
            </div>
        </div>
    </section>
    
</div>
@endsection
