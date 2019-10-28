@extends('layouts.app')
@section('page_title', "Bugs")

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('bug.index') }}" class="kt-subheader__breadcrumbs-link">Bug list</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('bug.create') }}" class="kt-subheader__breadcrumbs-link">Create ticket</a>
@endsection

@section('head')
  <link href="{{ asset('css/pages/bug/create.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
  <div class="kt-portlet">
    <div class="kt-portlet__body kt-portlet__body--fit">
      <div class="kt-grid  kt-wizard-v2 kt-wizard-v2--white" id="kt_wizard_v2" data-ktwizard-state="step-first">
        <div class="kt-grid__item kt-wizard-v2__aside">

          <!--begin: Form Wizard Nav -->
          <div class="kt-wizard-v2__nav">
            <div class="kt-wizard-v2__nav-items kt-wizard-v2__nav-items--clickable">

              <!--doc: Replace A tag with SPAN tag to disable the step link click -->
              <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                <div class="kt-wizard-v2__nav-body">
                  <div class="kt-wizard-v2__nav-icon">
                    <i class="flaticon2-rocket-1"></i>
                  </div>
                  <div class="kt-wizard-v2__nav-label">
                    <div class="kt-wizard-v2__nav-label-title">
                      Bug Details
                    </div>
                    <div class="kt-wizard-v2__nav-label-desc">
                      Setup informations about your bug
                    </div>
                  </div>
                </div>
              </div>
              <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
                <div class="kt-wizard-v2__nav-body">
                  <div class="kt-wizard-v2__nav-icon">
                    <i class="flaticon-rocket"></i>
                  </div>
                  <div class="kt-wizard-v2__nav-label">
                    <div class="kt-wizard-v2__nav-label-title">
                      Explanation
                    </div>
                    <div class="kt-wizard-v2__nav-label-desc">
                      Explain how you have discover this bug
                    </div>
                  </div>
                </div>
              </div>
              <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
                <div class="kt-wizard-v2__nav-body">
                  <div class="kt-wizard-v2__nav-icon">
                    <i class="flaticon-multimedia-4"></i>
                  </div>
                  <div class="kt-wizard-v2__nav-label">
                    <div class="kt-wizard-v2__nav-label-title">
                      Medias
                    </div>
                    <div class="kt-wizard-v2__nav-label-desc">
                      Upload your medias
                    </div>
                  </div>
                </div>
              </div>
              <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
                <div class="kt-wizard-v2__nav-body">
                  <div class="kt-wizard-v2__nav-icon">
                    <i class="flaticon-confetti"></i>
                  </div>
                  <div class="kt-wizard-v2__nav-label">
                    <div class="kt-wizard-v2__nav-label-title">
                      Completed!
                    </div>
                    <div class="kt-wizard-v2__nav-label-desc">
                      Review and Submit
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--end: Form Wizard Nav -->
        </div>
        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper">

          <!--begin: Form Wizard Form-->
          <form method="POST" class="kt-form" id="kt_form" data-form-type="create" data-form-url="{{ route('bug.index') }}" data-form-method="POST">
            @csrf
            <!--begin: Form Wizard Step 1-->
              <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                <div class="kt-heading kt-heading--md">Your Account Details</div>
                <div class="kt-form__section kt-form__section--first">
                  <div class="kt-wizard-v2__form">
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->username }}" value="John" disabled>
                    </div>
                    <div class="form-group">
                      <label>Email address</label>
                      <input type="text" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" value="John" disabled>
                    </div>
                  </div>
                </div>
                <div class="kt-heading kt-heading--md">Bug Details</div>
                <div class="kt-form__section kt-form__section--first">
                  <div class="kt-wizard-v2__form">
                    <div class="form-group">
                      <label>Bug Type</label>
                      <select class="form-control" id="type">
                        @foreach (\App\Models\BugTicket::$typeString as $key => $type)
                          <option value="{{ $key }}">{{ $type }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Priority</label>
                      <select class="form-control" id="priority">
                        @foreach (\App\Models\BugTicket::$priorityString as $key => $priority)
                          <option value="{{ $key }}">{!! $priority !!}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Subject</label>
                      <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter the subject...">
                      <span class="form-text text-muted">Please enter a comprehensive subject.</span>
                    </div>
                  </div>
                </div>
              </div>
              <!--end: Form Wizard Step 1-->


              <!--begin: Form Wizard Step 2-->
              <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                <div class="kt-heading kt-heading--md">Explanation</div>
                <div class="kt-form__section kt-form__section--first">
                  <div class="kt-wizard-v2__form">
                    <div class="form-group">
                      <div class="summernote" id="content" name="content">
                        <b>Main description of the bug:</b><br>
                        Your answer here.<br>
                        <hr>
                        <b>How to replicate:</b><br>
                        Your answer here.<br>
                        <hr>
                        <b>Expected result:</b><br>
                        Your answer here.<br>
                        <hr>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--end: Form Wizard Step 1-->

              <!--begin: Form Wizard Step 1-->
              <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                <div class="kt-heading kt-heading--md">Upload your medias</div>
                <div class="kt-form__section kt-form__section--first">
                  <div class="kt-wizard-v2__form" id="kt_repeater_2">
                    <div class="form-group">
                      <div data-repeater-list="">
                        <div data-repeater-item class="kt-margin-b-10">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="la la-image"></i>
                              </span>
                            </div>
                            <input type="text" class="form-control form-control-danger images" placeholder="Enter the link of your media">
                            <div class="input-group-append">
                              <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon">
                                <i class="la la-close"></i>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div data-repeater-create="" class="btn btn btn-warning">
                      <span>
                        <i class="la la-plus"></i>
                        <span>Add</span>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <!--end: Form Wizard Step 1-->


              <!--begin: Form Wizard Step 6-->
            <div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
              <div class="kt-heading kt-heading--md">Review your Details and Submit</div>
              <div class="kt-form__section kt-form__section--first">
                <div class="kt-wizard-v2__review">
                  <div class="kt-wizard-v2__review-item">
                    <div class="kt-wizard-v2__review-title kt-font-info">
                      Account Details
                    </div>
                    <div class="kt-wizard-v2__review-content">
                      <b>Username:</b> <span id="review_username"></span><br/>
                      <b>Email:</b> <span id="review_email"></span>
                    </div>
                  </div>
                  <div class="kt-wizard-v2__review-item">
                    <div class="kt-wizard-v2__review-title kt-font-info">
                      Bug Details
                    </div>
                    <div class="kt-wizard-v2__review-content">
                      <b>Type:</b> <span id="review_type"></span><br/>
                      <b>Priority:</b> <span id="review_priority"></span><br/>
                      <b>Subject:</b> <span id="review_subject"></span>
                    </div>
                  </div>
                  <div class="kt-wizard-v2__review-item">
                    <div class="kt-wizard-v2__review-title kt-font-info">
                      Explanation
                    </div>
                    <div class="kt-wizard-v2__review-content">
                      <div class="kt-section">
                        <div class="kt-section__content kt-section__content--solid">
                          <span id="review_content"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="kt-wizard-v2__review-item">
                    <div class="kt-wizard-v2__review-title kt-font-info">
                      Medias
                    </div>
                    <div class="kt-wizard-v2__review-content">
                      <span id="count_review_medias"></span> media(s) uploaded(s).
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!--end: Form Wizard Step 6-->

            <!--begin: Form Actions -->
            <div class="kt-form__actions">
              <button class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                Previous
              </button>
              <button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
                Submit
              </button>
              <button class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                Next Step
              </button>
            </div>

            <!--end: Form Actions -->
          </form>

          <!--end: Form Wizard Form-->
        </div>
      </div>
    </div>
  </div>
@endsection


@section('scripts')
  <script src="{{ asset('js/pages/bug/create.js') }}" type="text/javascript"></script>
@endsection
