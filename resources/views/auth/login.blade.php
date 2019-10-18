@extends('layouts.auth')

@section('content')
  <div class="kt-login__signin">
    <div class="kt-login__head">
      <h3 class="kt-login__title">Mafia City Roleplay - Login</h3>
    </div>
    <form class="kt-form" method="post" action="{{ route('login') }}">
      @csrf

      <div class="input-group">
        <input class="form-control {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" type="text" value="{{ old('username') ?: old('email') }}" placeholder="{{ __('Email or username') }}" name="login" id="login" autocomplete="off">
        @if ($errors->has('username') || $errors->has('email'))
        <div class="error invalid-feedback">{{ $errors->first('username') ?: $errors->first('email') }}</div>
        @enderror
      </div>
      <div class="input-group">
        <input class="form-control @error('email') is-invalid @enderror" type="password" placeholder="{{ __('Password') }}" name="password" id="password">
        @error('password')
          <div class="error invalid-feedback">{{ $message }}</div>
        @enderror

      </div>
      <div class="row kt-login__extra">
        <div class="col">
          <label class="kt-checkbox">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember me') }}
            <span></span>
          </label>
        </div>

        @if (Route::has('password.request'))
          <div class="col kt-align-right">
            <a class="kt-login__link" href="{{ route('password.request') }}">
              {{ __('Forget Password ?') }}
            </a>
          </div>
        @endif
      </div>
      <div class="kt-login__actions">
        <button id="kt_login_signin_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">{{ __('Sign In') }}</button>
      </div>
    </form>
  </div>
@endsection
