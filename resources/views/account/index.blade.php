@extends('account.master')

@section('title', 'Account')

@section('account_content')
<div class="row ">
  <div class="col-2"></div>
  <div class="col-8">
    <div class="row">
      <div class="col-6" >
        @include('account.list')
      </div>
      <div class="col-6">
        @include('account.add')
      </div>
    </div>    
  </div>  
  <div class="col-2"></div>
</div>

@endsection