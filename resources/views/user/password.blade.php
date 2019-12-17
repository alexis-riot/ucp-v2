@extends('layouts.user')
@section('page_title', 'Change Password')

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('profile') }}" class="kt-subheader__breadcrumbs-link">My Profile</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('profile.password') }}" class="kt-subheader__breadcrumbs-link">Change Password</a>
@endsection

@section('content-profile')
  <div class="row">
    <div class="col-xl-12">
      <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Change Password<small>change or reset your account password</small></h3>
          </div>
        </div>
        <form class="kt-form kt-form--label-right" method="POST" data-form-method="PATCH" data-form-type="update-password" data-form-url="{{ route('profile.password.update') }}">
          <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
              <div class="kt-section__body">
                <div class="alert alert-solid-danger alert-bold fade show kt-margin-t-20 kt-margin-b-40" role="alert">
                  <div class="alert-icon"><i class="fa fa-exclamation-triangle"></i></div>
                  <div class="alert-text">We recommand you to use a unique and strong password that has more than 8 characters and composed of specials characters/numbers.</div>
                  <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true"><i class="la la-close"></i></span>
                    </button>
                  </div>
                </div>
                <div class="row">
                  <label class="col-xl-3"></label>
                  <div class="col-lg-9 col-xl-6">
                    <h3 class="kt-section__title kt-section__title-sm">Change or recover your password:</h3>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-xl-3 col-lg-3 col-form-label">Current Password</label>
                  <div class="col-lg-9 col-xl-6">
                    <input type="password" id="actual_password" class="form-control" value="" placeholder="Current password">
                    <a class="kt-link kt-font-sm kt-font-bold kt-margin-t-5" data-offset="20px 20px" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Go to the login page to reset your password or contact an administrator.">Forgot password ?</a>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-xl-3 col-lg-3 col-form-label">New Password</label>
                  <div class="col-lg-9 col-xl-6">
                    <input type="password" id="new_password" class="form-control" value="" placeholder="New password">
                  </div>
                </div>
                <div class="form-group form-group-last row">
                  <label class="col-xl-3 col-lg-3 col-form-label">Verify Password</label>
                  <div class="col-lg-9 col-xl-6">
                    <input type="password" id="new_confirmed_password" class="form-control" value="" placeholder="Verify password">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="kt-portlet__foot">
            <div class="kt-form__actions">
              <div class="row">
                <div class="col-lg-3 col-xl-3">
                </div>
                <div class="col-lg-9 col-xl-9">
                  <button type="button" data-type-button="update-password" class="btn btn-brand btn-bold">Change Password</button>&nbsp;
                  <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/pages/user/password.js') }}" type="text/javascript"></script>
@endsection
