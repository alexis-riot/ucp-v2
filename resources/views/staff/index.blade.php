@extends('layouts.app')
@section('page_title', 'Staff Profile')

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('staff') }}" class="kt-subheader__breadcrumbs-link">Staff Profile</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('staff') }}" class="kt-subheader__breadcrumbs-link">List</a>
@endsection

@section('content')
  <div class="row">
    <div class="col-xl-3">

      <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__body mt-5">

          @foreach ($staff_list as $staff)
            <div class="kt-widget kt-widget--user-profile-2">
              <div class="kt-widget__head">
                <div class="kt-widget__media">
                  <img class="kt-widget__img rounded-circle" src="{{ asset('images/avatars/gtav03.png') }}" alt="image">
                </div>
                <div class="kt-widget__info">
                  <a href="#" class="kt-widget__username">{{ $staff->username }}</a>
                  <span class="kt-widget__desc">@if ($staff->staff_level) {{ $staff->staff_level->levelName }} @else N/A @endif</span>
                </div>
              </div>
              <div class="kt-widget__body mt-3">
                <div class="kt-widget__item">
                  <div class="kt-widget__contact">
                    <span class="kt-widget__label">Admin rank:</span>
                    <a class="kt-widget__data">@if ($staff->staff_level) {{ $staff->staff_level->levelName }} @else N/A @endif ({{ $staff->staff_level->levelID }})</a>
                  </div>
                  <div class="kt-widget__contact">
                    <span class="kt-widget__label">Is developer:</span>
                    <a class="kt-widget__data">
                      @if ($staff->developer > 0)
                        <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill kt-badge--rounded">yes</span>
                      @else
                        <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">no</span>
                      @endif
                    </a>
                  </div>
                  <div class="kt-widget__contact">
                    <span class="kt-widget__label">Last connection:</span>
                    <a class="kt-widget__data">{{ $staff->lastLogin }}</a>
                  </div>
                </div>
              </div>
              <div class="kt-widget__footer">
                <a href="#" class="btn btn-label-warning btn-lg btn-upper">view profile</a>
              </div>
            </div>
          @endforeach
        </div>
      </div>

    </div>
  </div>
@endsection
