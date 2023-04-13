@extends('templates.authentications')
@section('content')
<div class="card card-primary">
  <div class="card-header"><h4>Register</h4></div>
  <div class="card-body">
    <form method="POST" action="{{ route('compro.postregister') }}" class="needs-validation mt-0" novalidate="">
      @csrf
      <div class="form-group">
        <label for="">Nama Panjang</label>
        <input id="" type="text" class="form-control" name="nama_panjang" tabindex="1">
        @error('nama_panjang')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis consequatur quidem tempora assumenda odio sapiente dolore laudantium incidunt delectus reprehenderit!</p>
      <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email" class="form-control" name="email" tabindex="2">
        @error('email')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <div class="d-block">
          <label for="password" class="control-label">Password</label>
          <div class="float-right">
            <a href="auth-forgot-password.html" class="text-small">
              Forgot Password?
            </a>
          </div>
        </div>
        <input id="password" type="password" class="form-control" name="password" tabindex="3">
        @error('password')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" name="agree" class="custom-control-input" id="agree">
          <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
          Register
        </button>
      </div>
    </form>
    <div class="text-muted text-center">
      Sudah punya akun? <a href="{{ route('compro.login') }}">Login</a>
    </div>
  </div>
</div>
@endsection