@extends('master')

@section('title', 'Log in')

@section('content')
<dic class="container">
  <div class="form-group">
    <div class="title"><h2>Log in to Bank App</h2></div>
    <div class="form">
      <form method="POST">
        @csrf
        <div class="form-component">
          <label for="">Identification</label>
          <input type="text" class="" placeholder="your ID" id="identification" name="identification">
        </div>
        <div class="form-component">
          <label for="">Passeord</label>
          <input type="password" class="" placeholder="your Password" id="password" name="password">
        </div>
        <button type="submit">log in</button>
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