<form method="POST" class="form-control box-shadow-1">
  @csrf
  <label for="title" class="title">New Account</label>
  <input type="text" class="" placeholder="name Account" id="name" name="name">
  <input class="btn" type="submit" value="Create Account">
  @if (Session::has('message'))
    <div class="alert alert-{{ Session::get('typealert') }}">
      {{ Session::get('message') }}
      @if ($errors->any())
      <ul>
      @foreach ( $errors->all() as $error )
        <li>{{ $error }}</li>
      @endforeach
        </ul>
      @endif
    </div>
  @endif
</form>