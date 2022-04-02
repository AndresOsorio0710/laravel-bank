@extends('master')

@section('title', 'Register')

@section('content')
<dic class="container">
  <div class="form-group">
    <div class="title"><h2>Register to Bank App</h2></div>
    <div class="form">
      <form method="POST">
        @csrf
        <div class="form-component">
          <label for="">Identification</label>
          <input type="text" class="" placeholder="your ID" id="identification" name="identification">
        </div>
        <div class="form-component">
          <label for="">Name</label>
          <input type="text" class="" placeholder="your Name" id="name" name="name">
        </div>
        <div class="form-component">
          <label for="">Last name</label>
          <input type="text" class="" placeholder="your Last Name" id="last_name" name="last_name">
        </div>
        <div class="form-component">
          <label for="">Email</label>
          <input type="email" class="" placeholder="your Email" id="email" name="email">
        </div>
        <div class="form-component">
          <label for="">Password</label>
          <input type="password" class="" placeholder="your Password" id="password" name="password">
        </div>
        <div class="form-component">
          <label for="">Password confirmation</label>
          <input type="password" class="" placeholder="your Password" id="password_confirmation" name="password_confirmation">
        </div>
        <button type="submit">Register</button>
      </form>
    </div>
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
    <div class="footer"></div>
  </div>
</dic>
@endsection