@extends('layouts.lookup_user')
@section('page_title', 'Lookup User / Manage')

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('lookup.user.overview', ['user' => $user]) }}" class="kt-subheader__breadcrumbs-link">Lookup User / Manage</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('lookup.user.overview', ['user' => $user]) }}" class="kt-subheader__breadcrumbs-link">Overview</a>
@endsection

@section('content-lookup')
  <div class="row">
    <div class="col-xl-6">
      <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              General Informations
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fluid">
          <div class="kt-widget12">
            <div class="kt-widget12__content">
              <div class="kt-widget12__item">
                <div class="kt-widget12__info">
                  <span class="kt-widget12__desc">Registered</span>
                  <span class="kt-widget12__value">{{ $user->regiDate }}</span>
                </div>
                <div class="kt-widget12__info">
                  <span class="kt-widget12__desc">Last Login</span>
                  <span class="kt-widget12__value">{{ $user->lastLogin }}</span>
                </div>
              </div>
              <div class="kt-widget12__item">
                <div class="kt-widget12__info">
                  <span class="kt-widget12__desc">Status</span>
                  <span class="kt-widget12__value">
                    @if ($user->onlineStatus)
                      <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill kt-badge--rounded">Online</span>
                    @else
                      <span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill kt-badge--rounded">Offline</span>
                    @endif
                  </span>
                </div>
                <div class="kt-widget12__info">
                  <span class="kt-widget12__desc">Security level</span>
                  <b>Two Factor Status:</b> <span class="text-success">Active</span><br>
                  <b>Recovery Questions:</b> <span class="text-success">Active</span>
                  <div class="kt-widget12__progress">
                      <div class="progress kt-progress--sm">
                      <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 40%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <span class="kt-widget12__stat">40%</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-6">
      <div class="kt-portlet kt-portlet--skin-solid kt-bg-danger">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Quick actions
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body">
          <button type="button" class="btn btn-block btn-outline-hover-light btn-font-light">Reset 2FA (Two-factor authentification)</button>
          <button type="button" class="btn btn-block btn-outline-hover-light btn-font-light">Reset recovery question</button>
          <button type="button" class="btn btn-block btn-outline-hover-light btn-font-light">Reset password</button>
        </div>
      </div>
    </div>
  </div>
@endsection
