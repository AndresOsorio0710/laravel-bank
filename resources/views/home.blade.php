@extends('master')

@section('title', 'Home')
@section('content')
<div class="row">
  <div class="col-3"></div>
  <div class="col-6">
    <h2 class="section-title">welcome <br> {{auth()->user()->name}}</h2>
  </div>
  <div class="col-3"></div>
</div>
@endsection