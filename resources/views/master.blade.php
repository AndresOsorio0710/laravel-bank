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
  <nav>
    <div>
      <h1><a href="{{ route('home') }}">Bank App</a></h1>
    </div>
    <ul>
      @if (auth()->check())
        <li><a href="{{ route('login.destroy') }}">log Out</a></li>
      @else
        <li><a href="{{ route('login.index') }}">Log In</a></li>
        <li><a href="{{ route('register.index') }}">Register</a></li>
      @endif
    </ul>
  </nav>
  @yield('content')
</body>
</html>