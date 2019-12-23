@extends('layouts.app')
@section('page_title', 'Lookup User / Manage')

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('lookup.user.search') }}" class="kt-subheader__breadcrumbs-link">Lookup User / Manage</a>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12 text-center">
      <h1>
        <i class="flaticon2-search-1"></i>
      </h1>
      <h5>Please use the search bar at the top right bottom...</h5>
    </div>
  </div>
@endsection
