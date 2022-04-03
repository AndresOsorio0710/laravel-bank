<article class="account-cards">
@foreach ($accounts as $account)
  <aside class="account-card box-shadow-1">
    <h2 class="name"><a href="">{{ strtoupper($account->name) }}</a></h2>
    <h3>${{ number_format($account->amount,2,",",".") }}</h3>
  </aside>
@endforeach
</article>