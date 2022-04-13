<?php $active='';  ?>
@extends('frontend.layout.master')
@section('content')
<section class="niveshaay-section-paddding error-page">
    <div class="container">
        
        <h2>Your Subscription has been expired</h2>
        
        <a href="{{route('frontend.home')}}" title="return home" class="btn btn-green">return home</a>
    </div>
</section>
@endsection