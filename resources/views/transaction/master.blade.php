@extends('master')

@section('title', 'Transaction')

@section('content')
<div class="row">
  <div class="col-3">
  </div>
  <div class="col-6">  
    @yield('transaction_title')
    <nav class="nav-btn">
      <a class="btn" href="{{ route('transaction_own_account.index') }}">Own Accounts</a>
      <a class="btn" href="{{ route('transaction_other_account.index') }}">Other Accounts</a>      
    </nav>
    @yield('transaction_content')
  </div>
  <div class="col-3"></div>
</div>
@endsection