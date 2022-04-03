@extends('master')

@section('title', 'Register')

@section('content')
<div class="section">
  <div class="container">
    <h2 class="section-title">Register to Bank App</h2>
    <form method="POST" class="form-control box-shadow-1">
      @csrf
      <input type="text" class="" placeholder="your ID" id="identification" name="identification">
      <input type="text" class="" placeholder="your Name?" id="name" name="name">
      <input type="text" class="" placeholder="your Last Name?" id="last_name" name="last_name">
      <input type="email" class="" placeholder="your Email?" id="email" name="email">
      <input type="password" class="" placeholder="your Password" id="password" name="password">
      <input type="password" class="" placeholder="your Password" id="password_confirmation" name="password_confirmation">
      <input class="btn" type="submit" value="Register">
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
</div>
@endsection