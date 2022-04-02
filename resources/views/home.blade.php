@extends('master')

@section('title', 'Home')

@section('content')
@if (auth()->check())
  <div class="col-1">
    @include('sidebar')
  </div>
  <div class="col-2">
    <div class="page">
    @yield('content_board')
    </div>
  </div>
@endif
@endsection