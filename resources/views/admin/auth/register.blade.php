@extends('layouts.admin')

@section('admin_content')
@push('title')<title>Admin|Hotel|Management|System</title>@endpush

<div class="register-box m-auto pt-5 pb-5" style="max-width: 550px;width:100%">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>HMS</b> Admin</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Register a new membership</p>
  
        <form action="{{route('admin.register')}}" method="post">
            @csrf
          <div class="input-group mb-3">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Full name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone"></span>
              </div>
            </div>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Retype password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                <label for="agreeTerms">
                 I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
  
        <div class="social-auth-links text-center">
          <a href="#" class="btn btn-block btn-primary col-md-5 float-start" style="float: left; margin-top:9px">
            <i class="fab fa-facebook mr-2"></i>
            Sign up using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger col-md-5 float-end" style="float: right">
            <i class="fab fa-google-plus mr-2"></i>
            Sign up using Google+
          </a>
        </div>
  
        <a href="{{route('admin.login.create')}}" class="text-center d-block col-md-12" style="margin-top: 75px; text-align:left !important;">I already have an account?</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

@endsection