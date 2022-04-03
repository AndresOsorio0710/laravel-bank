<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') - Bank App</title>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet" />
  <!-- Styles -->
  <link rel="stylesheet" href="{{ url('/static/css/app.css?v=' . time()) }}">
</head>
<body>
  <header class="header">
    <section class="container">
      <div class="logo">
        <a href="{{ route('home') }}">Bank App</a>
      </div>
      <button class="menu-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <path d="M4 6H20V8H4zM4 11H20V13H4zM4 16H20V18H4z" />
        </svg>
        <svg class="none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <path d="M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z"/>
        </svg>
      </button>
      <nav class="menu">
        @if (auth()->check())
          <a href="{{ route('transaction.index') }}">Banking Transactions</a>
          <a href="{{ route('account.index') }}">Account Status</a>
          <a href="{{ route('login.destroy') }}">log Out</a>
        @else
          <a href="{{ route('login.index') }}">Log In</a>
          <a href="{{ route('register.index') }}">Register</a>
        @endif
      </nav>
    </section>
  </header>
  @yield('content')
  @if (auth()->check())
    @yield('content_board')
  @endif
  <!-- Scripts -->
  <script src="{{ url('/static/js/app.js?v=' . time()) }}"></script>
</body>
</html>