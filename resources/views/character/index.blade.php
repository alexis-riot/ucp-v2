@extends('layouts.app')
@section('page_title', $character->username)

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('profile') }}" class="kt-subheader__breadcrumbs-link">Characters</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('profile') }}" class="kt-subheader__breadcrumbs-link">{{ $character->name }}</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('profile') }}" class="kt-subheader__breadcrumbs-link">Overview</a>
@endsection

@section('content-profile')
  test
@endsection
