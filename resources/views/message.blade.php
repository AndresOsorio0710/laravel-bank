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