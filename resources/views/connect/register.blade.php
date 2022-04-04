@extends('master')

@section('title', 'Register')

@section('content')
<div class="row">
  <div class="col-3"></div>
  <div class="col-6">
  <form method="POST" class="form box-shadow-1">
    @csrf
    <h2 class="title">Register to Bank App</h2>
    <input type="text" class="" placeholder="your ID" id="identification" name="identification">
    <input type="text" class="" placeholder="your Name?" id="name" name="name">
    <input type="text" class="" placeholder="your Last Name?" id="last_name" name="last_name">
    <input type="email" class="" placeholder="your Email?" id="email" name="email">
    <input type="password" class="" placeholder="your Password" id="password" name="password">
    <input type="password" class="" placeholder="your Password" id="password_confirmation" name="password_confirmation">
    <input class="btn" type="submit" value="Register">
    @include('message')  
  </form>    
  </div>
  <div class="col-3"></div>
</div>
@endsection