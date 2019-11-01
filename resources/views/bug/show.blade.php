@extends('layouts.app')
@section('page_title', "Bugs")

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('bug.index') }}" class="kt-subheader__breadcrumbs-link">Bug list</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('bug.index') }}" class="kt-subheader__breadcrumbs-link">View your tickets</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('bug.index') }}" class="kt-subheader__breadcrumbs-link">Ticket #{{ $ticket->id }}</a>
@endsection

@section('content')
  <div class="row">
    <div class="col-xl-4">

      @if (Auth::user()->admin > 0 || Auth::user()->developer > 0)
        <div class="kt-portlet kt-portlet--head-noborder">
          <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
              <h3 class="kt-portlet__head-title  kt-font-danger">
                Important Notice
              </h3>
            </div>
          </div>
          <div class="kt-portlet__body kt-portlet__body--fit-top">
            <div class="kt-section kt-section--space-sm">
              Some task was not assigned. Be aware that as long as they are not assigned, this task can not proceed.
            </div>
            <div class="kt-section kt-section--last">
              @if (Auth::user()->admin > 0)
                <a href="#" class="btn btn-danger btn-sm btn-bold"><i class=""></i> Assign me as Tester</a>&nbsp;
              @endif
              @if (Auth::user()->developer > 0)
                <a href="#" class="btn btn-primary btn-sm btn-bold"><i class=""></i> Assign me as Developer</a>&nbsp;
              @endif
            </div>
          </div>
        </div>
      @endif

      <div class="kt-portlet">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Bug Details
            </h3>
          </div>
        </div>
        <div class="kt-form kt-form--label-right">
          <div class="kt-portlet__body">
            <div class="form-group form-group-xs row">
              <label class="col-5 col-form-label">Subject:</label>
              <div class="col-7">
                <span class="form-control-plaintext kt-font-bolder">{{ $ticket->subject }}</span>
              </div>
            </div>
            <div class="form-group form-group-xs row">
              <label class="col-5 col-form-label">Type:</label>
              <div class="col-7">
                <span class="form-control-plaintext kt-font-bolder">{{ $ticket->getType() }}</span>
              </div>
            </div>
            <div class="form-group form-group-xs row">
              <label class="col-5 col-form-label">Status:</label>
              <div class="col-7">
                <span class="form-control-plaintext">{!! $ticket->getStatus() !!}</span>
              </div>
            </div>
            <div class="form-group form-group-xs row">
              <label class="col-5 col-form-label">Submitted by:</label>
              <div class="col-7">
                <span class="form-control-plaintext kt-font-bolder">{{ $ticket->user->username }}</span>
              </div>
            </div>
            <div class="form-group form-group-xs row">
              <label class="col-5 col-form-label">Tester assigned:</label>
              <div class="col-7">
                <span class="form-control-plaintext kt-font-bolder">
                  @if (!is_null($ticket->tester()))
                    {{ $ticket->tester->username }}
                  @else
                    N/A
                  @endif</span>
              </div>
            </div>
            <div class="form-group form-group-xs row">
              <label class="col-5 col-form-label">Developer assigned:</label>
              <div class="col-7">
                <span class="form-control-plaintext kt-font-bolder">
                  @if (!is_null($ticket->developer()))
                    {{ $ticket->developer->username }}
                  @else
                    N/A
                  @endif
                </span>
              </div>
            </div>
            <div class="form-group form-group-xs row">
              <label class="col-5 col-form-label">Created on:</label>
              <div class="col-7">
                <span class="form-control-plaintext kt-font-bolder">{{ $ticket->created_at->diffForHumans() }}</span>
              </div>
            </div>
            <div class="form-group form-group-xs row">
              <label class="col-5 col-form-label">Last update:</label>
              <div class="col-7">
                <span class="form-control-plaintext kt-font-bolder">{{ $ticket->updated_at->diffForHumans() }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--End:: Portlet-->
    </div>
    <div class="col-xl-8">
      <!--Begin:: Portlet-->
      <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-toolbar">
            <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_1" role="tab">
                  <i class="flaticon2-note"></i> Notes
                </a>
              </li>
              @if ($ticket->images->count() > 0)
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_2" role="tab">
                  <i class="flaticon-interface"></i> Medias
                </a>
              </li>
              @endif
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_3" role="tab">
                  <i class="flaticon2-time"></i> Activities
                </a>
              </li>
              @can('ticket-update-settings', Auth::user())
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_4" role="tab">
                  <i class="flaticon2-gear"></i> Settings
                </a>
              </li>
              @endcan
            </ul>
          </div>
        </div>
        <div class="kt-portlet__body">
          <div class="tab-content kt-margin-t-20">

            <!--Begin:: Tab Content-->
            <div class="tab-pane active" id="kt_apps_contacts_view_tab_1" role="tabpanel">
              @if ($ticket->status != 7)
                <form method="POST" data-form-type="add_comment" data-form-url="{{ route('bug.create.comment', ['bug' => $ticket]) }}" data-form-method="PATCH">
                  <div class="form-group">
                    <div class="summernote"></div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <button type="button" data-type-button="add_comment" class="btn btn-label-brand btn-bold">Add notes</button>
                    </div>
                  </div>
                </form>
              @else
                <div class="alert alert-success" role="alert">
                  <div class="alert-icon"><i class="flaticon2-checkmark"></i></div>
                  <div class="alert-text">This ticket is close, you can't reply to it!</div>
                </div>
              @endif
              <div class="kt-separator kt-separator--space-lg kt-separator--border-dashed"></div>
              <div class="kt-notes kt-scroll kt-scroll--pull" data-scroll="true" style="height: 700px;">
                <div class="kt-notes__items">
                  @foreach ($ticket->comments as $comment)
                    <div class="kt-notes__item">
                      <div class="kt-notes__media">
                        <img class="kt-hidden-" src="{{ asset('images/avatars/gtav03.png') }}" alt="image">
                        <span class="kt-notes__icon kt-font-boldest kt-hidden">
                          <i class="flaticon2-cup"></i>
                        </span>
                      </div>
                      <div class="kt-notes__content">
                        <div class="kt-notes__section">
                          <div class="kt-notes__info">
                            <a href="#" class="kt-notes__title">
                              {{ $comment->user->username }}
                            </a>
                            <span class="kt-notes__desc">
                              {{ $comment->created_at }}
                            </span>
                          </div>
                          <div class="kt-notes__dropdown">
                            <a href="#" class="btn btn-sm btn-icon-md btn-icon" data-toggle="dropdown">
                              <i class="flaticon-more-1 kt-font-brand"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                              <ul class="kt-nav">
                                <li class="kt-nav__item">
                                  <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                    <span class="kt-nav__link-text">View Profile</span>
                                  </a>
                                </li>
                                <li class="kt-nav__item">
                                  <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                    <span class="kt-nav__link-text">Ban user</span>
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <span class="kt-notes__body">{!! $comment->comment !!}</span>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>

            <!--End:: Tab Content-->

            @if ($ticket->images->count() > 0)
            <!--Begin:: Tab Content-->
            <div class="tab-pane" id="kt_apps_contacts_view_tab_2" role="tabpanel">
              <div class="kt-notes">
                <div class="kt-notes__items">
                  <div class="col-md-12">
                    @foreach($ticket->images as $image)
                      @if ($image->isValidImage())
                        <a target="_blank" href="{{ $image->path }}">
                          <img src="{{ $image->path }}" class="img-thumbnail" style="max-width: 45%; max-height: 45%;">
                        </a>
                      @endif
                    @endforeach
                  </div>

                  <div class="col-md-12 mt-5">
                    <h5>Others links:</h5>
                    <ul>
                      @foreach ($ticket->images as $image)
                        @if (!$image->isValidImage())
                          <li><a target="_blank" href="{{ $image->path }}">{{ $image->path }}</a></li>
                        @endif
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!--End:: Tab Content-->
            @endif

            <!--Begin:: Tab Content-->
            <div class="tab-pane" id="kt_apps_contacts_view_tab_3" role="tabpanel">
              <div class="kt-notes">
                <div class="kt-notes__items">
                  @if ($ticket->logs->count() <= 0)
                    <div class="alert alert-outline-danger fade show" role="alert">
                      <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
                      <div class="alert-text">No log was found for this bug ticket.</div>
                    </div>
                  @else
                    @foreach ($ticket->logs as $log)
                      <div class="kt-notes__item kt-notes__item--clean">
                        <div class="kt-notes__media">
                          <img class="kt-radius-100" src="{{ asset('images/avatars/gtav03.png') }}" alt="image">
                        </div>
                        <div class="kt-notes__content">
                          <div class="kt-notes__section">
                            <div class="kt-notes__info">
                              <a href="#" class="kt-notes__title">{{ $log->user->username }}</a>
                              <span class="kt-notes__desc">{{ $log->created_at->diffForHumans() }}</span>
                            </div>
                          </div>
                          <span class="kt-notes__body">{!! $log->logs !!}</span>
                        </div>
                      </div>
                    @endforeach
                  @endif
                </div>
              </div>
            </div>
            <!--End:: Tab Content-->

            @can('ticket-update-settings', Auth::user())
              <!--Begin:: Tab Content-->
              <div class="tab-pane" id="kt_apps_contacts_view_tab_4" role="tabpanel">
                <form data-form-type="update" data-form-url="{{ route('bug.update', ['bug' => $ticket]) }}" data-form-method="PATCH" class="kt-form kt-form--label-right">
                  @csrf
                  <div class="kt-form__body">
                    <div class="kt-section kt-section--first">
                      <div class="kt-section__body">
                        <div class="row">
                          <label class="col-xl-3"></label>
                          <div class="col-lg-9 col-xl-6">
                            <h3 class="kt-section__title kt-section__title-sm">Bug Details:</h3>
                          </div>
                        </div>
                        <div class="form-group form-group-sm row">
                          <label class="col-xl-3 col-lg-3 col-form-label">Subject</label>
                          <div class="col-lg-9 col-xl-6">
                            <input class="form-control" type="text" value="{{ $ticket->subject }}" name="settings_subject" id="settings_subject">
                          </div>
                        </div>
                        <div class="form-group form-group-sm row">
                          <label class="col-xl-3 col-lg-3 col-form-label">Type</label>
                          <div class="col-lg-9 col-xl-6">
                            <select class="form-control" name="settings_type" id="settings_type">
                              @foreach (\App\Models\BugTicket::$typeString as $key => $type)
                                <option value="{{ $key }}" @if ($ticket->type == $key) selected="selected" @endif>{!! $type !!}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group form-group-sm row">
                          <label class="col-xl-3 col-lg-3 col-form-label">Status</label>
                          <div class="col-lg-9 col-xl-6">
                            <select class="form-control" name="settings_status" id="settings_status">
                              @foreach (\App\Models\BugTicket::$statusString as $key => $status)
                                <option value="{{ $key }}" @if ($ticket->status == $key) selected="selected" @endif>{!! $status !!}</option>
                              @endforeach
                            </select>
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
                            <h3 class="kt-section__title kt-section__title-sm">Assignments:</h3>
                          </div>
                        </div>

                        <div class="form-group form-group-sm row">
                          <label class="col-xl-3 col-lg-3 col-form-label">Developer Assigned</label>
                          <div class="col-lg-9 col-xl-6">
                            <input class="form-control" type="text" value="@if (!is_null($ticket->developer())){{ $ticket->developer->username }}@endif" name="settings_developer" id="settings_developer">
                          </div>
                        </div>

                        <div class="form-group form-group-sm row">
                          <label class="col-xl-3 col-lg-3 col-form-label">Tester Assigned</label>
                          <div class="col-lg-9 col-xl-6">
                            <input class="form-control" type="text" value="@if (!is_null($ticket->tester())){{ $ticket->tester->username }}@endif" name="settings_tester" id="settings_tester">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                  <div class="kt-form__actions">
                    <div class="row">
                      <div class="col-xl-3"></div>
                      <div class="col-lg-9 col-xl-6">
                        <button type="button" class="btn btn-label-brand btn-bold" data-type-button="update">Save changes</button>
                        <button type="reset" class="btn btn-clean btn-bold">Cancel</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            @endif
            <!--End:: Tab Content-->
          </div>
        </div>
      </div>

      <!--End:: Portlet-->
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/pages/bug/show.js') }}" type="text/javascript"></script>
@endsection
