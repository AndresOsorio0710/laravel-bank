<div class="sidebar shadow">
    <div class="section-top">
        <div class="user">
            <span class="subtitle">Welcome</span>
            <div class="name">
                {{ auth()->user()->name }} {{ auth()->user()->last_name }} 
            </div>
            <div class="email">{{ auth()->user()->email }}</div>
        </div>
    </div>
    <div class="main">
        <ul>
            <li>
                <a href="{{ route('transaction.index') }}">Banking Transactions</a>
            </li>
            <li>
                <a href="{{ route('account.index') }}">Account Status</a>
            </li>
        </ul>
    </div>
</div>