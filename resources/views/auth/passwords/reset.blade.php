@extends('layouts.auth')

@section('content')
  <div class="kt-login__signin">
    <div class="kt-login__head">
      <h3 class="kt-login__title">Mafia City Roleplay - Reset Password</h3>
    </div>
    <form class="kt-form" method="POST" action="{{ route('password.update') }}">
      @csrf

      <input type="hidden" name="token" value="{{ $token }}">

      <div class="input-group">
        <input class="form-control @error('email') is-invalid @enderror" type="inputtext" placeholder="{{ __('Email address') }}" value="{{ $email ?? old('email') }}" name="email" required>
        @error('email')
          <div class="error invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="input-group">
        <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="{{ __('Password') }}" name="password" id="password">
        @error('password')
          <div class="error invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="input-group">
        <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" id="password-confirm">
      </div>

      <div class="kt-login__actions">
        <button type="submit" class="btn btn-brand btn-elevate kt-login__btn-primary">{{ __('Reset Password') }}</button>
      </div>
    </form>
  </div>
@endsection
