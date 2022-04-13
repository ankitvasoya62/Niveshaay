<?php $active='';  ?>
@extends('frontend.layout.master')
@section('content')
<section class="niveshaay-section-paddding error-page">
    <div class="container">
        <h1>404</h1>
        <h2>Page not found</h2>
        <p>Opps! That page can't be found.</p>
        <p>It looks like nothing was found at this location.</p>
        <a href="{{route('frontend.home')}}" title="return home" class="btn btn-green">return home</a>
    </div>
</section>
@endsection
