@extends('master')

@section('title', 'Transaction')

@section('content_board')
<div class="row-10">
  <div class="col">
  </div>
  <div class="col-8">  
    @yield('transaction_title')
    <nav class="nav-btn">
      <a class="btn" href="{{ route('transaction_own_account.index') }}">Own Accounts</a>
      <a class="btn" href="{{ route('transaction_other_account.index') }}">Other Accounts</a>      
    </nav>
    @yield('transaction_content')
  </div>
  <div class="col"></div>
</div>
@endsection