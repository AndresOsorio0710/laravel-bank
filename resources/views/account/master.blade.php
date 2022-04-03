@extends('master')

@section('title', 'Account')

@section('content_board')
<div class="section">
  <div class="container">
    <h2 class="section-title">My Accounts</h2>
    <div class="info">
      <div class="info-left">
        <h2>Available Balance</h2>
        <h3> ${{ number_format($amount,2,",",".") }}</h3>
      </div>
    </div>
  </div>
  @yield('account_content')
</div>
@endsection