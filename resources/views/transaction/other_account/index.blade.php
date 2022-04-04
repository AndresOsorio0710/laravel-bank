@extends('transaction.master')

@section('transaction_title')
  <h2 class="section-title">Other Accounts</h2>
@endsection

@section('transaction_content')
<div class="row">
  <div class="col-6 box-shadow-1 p-1r">
    <h2 class="title text-center">My Accounts</h2>
    <table>
      <thead>
        <tr>
          <th class="text-left">Account</th>
          <th class="text-right">Available Balance</th>
        </tr>
      </thead> 
      <tbody>
        @foreach ($my_accounts as $account)
        <tr>
          <td>{{ strtoupper($account->name) }}</td>
          <td class="text-right">${{ number_format($account->amount,2,",",".") }}</td>
        </tr>
        @endforeach
      </tbody>    
    </table>
  </div>
  <div class="col-6 box-shadow-1">
    <form method="POST" class="form">
      @csrf
      <h2 for="title" class="title">New Transaction</h2>
      <select name="source_account" id="source_account" velue="{{ old('source_account') }}">
        <option value="x" selected disabled class="none">Select the source account</option>
        @foreach ($my_accounts as $account)
          <option value="{{ $account->id }}">{{ strtoupper($account->name) }}</option>
        @endforeach
      </select>
      <select name="target_account" id="target_account">
        <option value="x"  selected disabled class="none">Select the target account</option>
        @foreach ($other_accounts as $account)
          <option value="{{ $account->id }}">{{ strtoupper($account->name) }}</option>
        @endforeach
      </select>
      <input type="number" class="" placeholder="amount to transferred?" id="amount" name="amount" min="0">
      <input class="btn" type="submit" value="Transfer">
      @include('message')
    </form>
  </div>
</div>
@endsection