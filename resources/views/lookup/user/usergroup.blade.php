@extends('layouts.lookup_user')
@section('page_title', 'Lookup User / Manage')

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('lookup.user.overview', ['user' => $user]) }}" class="kt-subheader__breadcrumbs-link">Lookup User / Manage</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('lookup.user.usergroup', ['user' => $user]) }}" class="kt-subheader__breadcrumbs-link">Adjust Usergroups</a>
@endsection

@section('content-lookup')
  test
@endsection
