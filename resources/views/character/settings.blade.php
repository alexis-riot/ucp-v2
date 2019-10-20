@extends('layouts.app')
@section('page_title', $character->username)

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('profile') }}" class="kt-subheader__breadcrumbs-link">Characters</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('character/overview', ['id' => $character->id, 'slug' => $character->slug()]) }}" class="kt-subheader__breadcrumbs-link">{{ $character->name }}</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('character/settings', ['id' => $character->id, 'slug' => $character->slug()]) }}" class="kt-subheader__breadcrumbs-link">Settings</a>
@endsection

@section('content-profile')
  test
@endsection
