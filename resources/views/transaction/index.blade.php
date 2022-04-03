@extends('transaction.master')

@section('transaction_title')
<h2 class="section-title">My Transactions</h2>
@endsection

@section('transaction_content')
@include('transaction.history')
@endsection