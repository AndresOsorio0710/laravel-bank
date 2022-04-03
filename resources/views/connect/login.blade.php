@extends('master')

@section('title', 'Log in')

@section('content')
<div class="row-10">
  <div class="col-3"></div>
  <div class="col-4">
      <form method="POST" class="form-control box-shadow-1">
        @csrf
        <label for="" class="title">Log In to Bank App</label>
        <input type="text" class="" placeholder="your ID" id="identification" name="identification">
        <input type="password" class="" placeholder="your Password" id="password" name="password">
        <input class="btn" type="submit" value="log in">
        @if (Session::has('message'))
        <div class="alert alert-{{ Session::get('typealert') }}">
          {{ Session::get('message') }}
          @if ($errors->any())
          <ul>
          @foreach ( $errors->all() as $error )
            <li>{{ $error }}</li>
          @endforeach
            </ul>
          @endif
        </div>
        @endif
      </form>    
  </div>
  <div class="col-3"></div>
</div>
@endsection