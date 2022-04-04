@extends('master')

@section('title', 'Log in')

@section('content')
<div class="row">
  <div class="col-3"></div>
  <div class="col-6">
    <form method="POST" class="form box-shadow-1">
      @csrf
      <label for="" class="title">Log In to Bank App</label>
      <div class="row">
        <input type="text" class="col-6" placeholder="your ID" id="identification" name="identification">
        <input type="password" class="col-6" placeholder="your Password" id="password" name="password">
        </div>  
      <input class="btn" type="submit" value="log in">
      @include('message')
    </form>    
  </div>
  <div class="col-3"></div>
</div>      
@endsection