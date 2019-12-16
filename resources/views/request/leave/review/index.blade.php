@extends('layouts.app')
@section('page_title', "LOA")

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('leave.index') }}" class="kt-subheader__breadcrumbs-link">Requests list</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('leave.review') }}" class="kt-subheader__breadcrumbs-link">Review Requests list</a>
@endsection

@section('content')
  <div class="row">
    <div class="col-xl-12">
      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
              <i class="kt-font-brand flaticon2-rocket-1"></i>
            </span>
            <h3 class="kt-portlet__head-title">
              Review Leave of Absence Requests
              <small>{{ $request_list->count() }} requests(s) has been found.</small>
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body">
          <div class="row">
            <div class="col-md-3">
              <form method="POST" id="search">
                <div class="kt-input-icon kt-input-icon--left">
                  <input type="text" class="form-control" placeholder="Search by User Name" data-url-redirect="search" id="search_text">
                  <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                        <span><i class="la la-search"></i></span>
                                    </span>
                </div>
                <input type="submit" style="display: none;">
              </form>
            </div>
            <div class="col-md-3">
              <div class="form-group row">
                <label for="example-text-input" class="col-2 col-form-label">Status:</label>
                <div class="col-10">
                  <select class="form-control" data-url-redirect="status" id="status">
                    <option>All</option>
                    @foreach (\App\Models\RequestLeave::$statusString as $key => $status)
                      <option value="{{ $key }}" @if (app('request')->input('status') == $key && $parameters['status'] == true) selected @endif>{!! $status !!}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group row">
                <label for="example-text-input" class="col-2 col-form-label">Type:</label>
                <div class="col-10">
                  <select class="form-control" data-url-redirect="type" id="type">
                    <option>All</option>
                    @foreach (\App\Models\RequestLeave::$typeString as $key => $type)
                      <option value="{{ $key }}" @if (app('request')->input('type') == $key && $parameters['type'] == true) selected @endif>{!! $type !!}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <table class="table table-striped" id="table1">
            <thead>
            <tr>
              <th>#</th>
              <th>User</th>
              <th>Date</th>
              <th>Type</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody class="table-detailled">
              @if ($request_list->count() > 0)
                @foreach ($request_list as $request)
                  <tr class="content" id="{{ $request->id }}">
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->user->username }}</td>
                    <td>{{ $request->date_start->format('m/d/Y') }} - {{ $request->date_end->format('m/d/Y') }}</td>
                    <td>{!! $request->getType() !!}</td>
                    <td>{!! $request->getStatus() !!}</td>
                  </tr>
                  <tr class="detail detail-hidden" id ="{{ $request->id }}">
                    <td colspan="5" style="text-align: center">
                      @if ($request->status == 1)
                        <p class="text-success"><i class="fa fa-check"></i> This request was approved by <b>{{ $request->approve->username }}</b></p>
                      @elseif ($request->status == 2)
                        <p class="text-danger"><i class="fa fa-times"></i> This request was rejected by <b>{{ $request->approve->username }}</b></p>
                      @else
                        <p class="text-primary"><i class="fas fa-spinner fa-spin"></i> This request is waiting approval.</p>
                      @endif

                      <b>Reason for leave:</b> {{ $request->reason }}<br>
                      <b>Duration:</b> {{ $request->countDays() }} days<br>
                      <b>Request submitted on:</b> {{ $request->created_at->diffForHumans() }}<br>
                      @if ($request->head)
                        <b>Interim department head:</b> {{ $request->head->username }}<br>
                      @endif
                      @if ($request->status == 0)
                        <form method="POST" data-form-method="PATCH" data-form-type="update-approve" data-form-url="{{ route('leave.review.update', ['request_leave' => $request]) }}">
                          <button type="button" class="btn m-btn--square  btn-success mt-2" data-type-button="update-approve"><i class="fa fa-check"></i> APPROVE</button>
                        </form>
                        <form method="POST" data-form-method="PATCH" data-form-type="update-decline" data-form-url="{{ route('leave.review.update', ['request_leave' => $request]) }}">
                          <button type="button" class="btn m-btn--square  btn-danger mt-2" data-type-button="update-decline"><i class="fa fa-times"></i> DECLINE</button>
                        </form>
                      @endif
                    </td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="4" class="text-center">No records found</td>
                </tr>
              @endif
            </tbody>
          </table>
          {{ $request_list->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/pages/request/leave/review/index.js') }}" type="text/javascript"></script>
@endsection
