@extends('layouts.auth')

@section('content')
  <div class="kt-login__forgot">
    <div class="kt-login__head">
      <h3 class="kt-login__title">{{ __('Forgotten Password ?') }}</h3>
      <div class="kt-login__desc">{{ __('Enter your email to reset your password:') }}</div>
    </div>
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif
    <form class="kt-form" method="post" action="{{ route('password.email') }}">
      @csrf
      <div class="input-group">
        <input class="form-control @error('email') is-invalid @enderror" type="text" placeholder="{{ __('Email') }}" name="email" id="email" value="{{ old('email') }}" autocomplete="off">
        @error('email')
          <div class="error invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="kt-login__actions">
        <button type="submit" class="btn btn-brand btn-elevate kt-login__btn-primary">{{ __('Request') }}</button>&nbsp;&nbsp;
        <button type="button" onclick="history.go(-1);" class="btn btn-light btn-elevate kt-login__btn-secondary">Cancel</button>
      </div>
    </form>
  </div>
@endsection
