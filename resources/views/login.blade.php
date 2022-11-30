@extends('layouts/fullLayoutMaster')

@section('title', 'Login Page')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
<div class="auth-wrapper auth-basic px-2">
  <div class="auth-inner my-2">
  <div class="card mb-0">
      <div class="card-body">
        <h2 class="text-center text-primary ms-1">Easy Store</h2>
        <form action="{{route('login')}}" class="auth-login-form mt-2" method="POST">
<div class="col-12">
@CSRF
        <div class="mb-1">
            <label class="form-label">User Name</label>
            <div class="input-group input-group-merge">
            <span class="input-group-text"><i data-feather="user"></i></span>
            <input
                type="text"
                class="form-control"
                placeholder="User Name"
                required
                name="username"
            />
            </div>
            <span class="text-danger">
                @error('user_name') {{ $message }} @enderror
            </span>
        </div>
    </div>
    <div class="col-12">
        <div class="mb-1">
            <label class="form-label" for="password-icon">Password</label>
            <div class="input-group input-group-merge">
            <span class="input-group-text"><i data-feather="lock"></i></span>
            <input
                type="password"
                class="form-control"
                placeholder="Password"
                name="password"
                required
            />
            </div>
            <span class="text-danger">
                @error('password') {{ $message }} @enderror
            </span>
        </div>
      </div>
      <div class="col-md-12">
      @if (session()->has('message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="alert-body">
        {{session('message')}}
              </div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
      </div>
    <div class="mb-1">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="remember-me" tabindex="3" />
        <label class="form-check-label" for="remember-me"> Remember Me </label>
    </div>
    </div>
    <button class="btn btn-primary w-100" tabindex="4">Sign in</button>
</form>

    </div>
    </div>
  </div>
</div>
@endsection

@section('vendor-script')

@endsection

@section('page-script')
<script>

</script>
@endsection
