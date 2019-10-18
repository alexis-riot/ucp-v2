@extends('layouts.user')
@section('page_title', 'Personal Informations')

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('profile') }}" class="kt-subheader__breadcrumbs-link">My Profile</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('profile') }}" class="kt-subheader__breadcrumbs-link">Personal Informations</a>
@endsection

@section('content-profile')
  <div class="row">
    <div class="col-xl-12">
      <div class="kt-portlet">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Personal Information <small>update your personal informations</small></h3>
          </div>
        </div>
        <form class="kt-form kt-form--label-right">
          <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
              <div class="kt-section__body">
                <div class="row">
                  <label class="col-xl-3"></label>
                  <div class="col-lg-9 col-xl-6">
                    <h3 class="kt-section__title kt-section__title-sm">Customer Info:</h3>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
                  <div class="col-lg-9 col-xl-6">
                    <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar">
                      <div class="kt-avatar__holder" style="background-image: url({{ asset('images/avatars/gtav03.png') }})"></div>
                      <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                        <i class="fa fa-pen"></i>
                        <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg">
                      </label>
                      <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                        <i class="fa fa-times"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-xl-3 col-lg-3 col-form-label">Username</label>
                  <div class="col-lg-9 col-xl-6">
                    <input class="form-control" type="text" value="{{ $user->username }}" disabled>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                  <div class="col-lg-9 col-xl-6">
                    <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                      <input type="text" class="form-control" value="{{ $user->email }}" placeholder="Email" aria-describedby="basic-addon1">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
            <div class="kt-section kt-section--first">
              <div class="kt-section__body">
                <div class="row">
                  <label class="col-xl-3"></label>
                  <div class="col-lg-9 col-xl-6">
                    <h3 class="kt-section__title kt-section__title-sm">Security:</h3>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-xl-3 col-lg-3 col-form-label">Login verification</label>
                  <div class="col-lg-9 col-xl-6">
                    <button type="button" class="btn btn-label-brand btn-bold btn-sm kt-margin-t-5 kt-margin-b-5">Setup login verification</button>
                    <span class="form-text text-muted">
                      After you log in, you will be asked for additional information to confirm your identity and protect your account from being compromised.
                    </span>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-xl-3 col-lg-3 col-form-label">Password reset verification</label>
                  <div class="col-lg-9 col-xl-6">
                    <div class="kt-checkbox-single">
                      <label class="kt-checkbox">
                        <input type="checkbox"> Require personal information to reset your password.
                        <span></span>
                      </label>
                    </div>
                    <span class="form-text text-muted">
                      For extra security, this requires you to confirm your email or phone number when you reset your password.
                    </span>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-xl-3 col-lg-3 col-form-label">Security question</label>
                  <div class="col-lg-9 col-xl-6">
                    <button type="button" class="btn btn-label-primary btn-bold btn-sm kt-margin-t-5 kt-margin-b-5">Setup security question</button>
                    <span class="form-text text-muted">
                      In addition to the others security, a question can be asked to you to determine if you are the owner of this account.
                    </span>
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
                  <button type="reset" class="btn btn-success">Submit</button>&nbsp;
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
