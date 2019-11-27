@extends('layouts.app')
@section('page_title', 'Request LOA')

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="#" class="kt-subheader__breadcrumbs-link">Request</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('leave.index') }}" class="kt-subheader__breadcrumbs-link">Leave of absence</a>
@endsection

@section('content')
  <div class="row">
    <div class="col-xl-5">
      <form method="POST">
        <div class="kt-portlet kt-portlet--height-fluid">
          <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
              <span class="kt-portlet__head-icon"><i class="flaticon-stopwatch"></i></span>
              <h3 class="kt-portlet__head-title">Send LOA New Request</h3>
            </div>
          </div>
          <div class="kt-portlet__body">
            <div class="form-group form-group-last">
              <div class="alert alert-brand" role="alert">
                <div class="alert-icon"><i class="flaticon-warning kt-font-white"></i></div>
                <div class="alert-text">
                  <b>Warning!</b> An LOA is mandatory for any absences that are 3 days or longer.
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="inputtext" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label>Email address</label>
              <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
              <span class="form-text text-muted">We'll never share your email with anyone else.</span>
            </div>
            <hr>
            <div class="form-group">
              <label>Date of leave</label>
              <div class="input-daterange input-group" id="datepicker_leave">
                <input type="text" class="form-control" id="date_start" />
                <div class="input-group-append">
                  <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                </div>
                <input type="text" class="form-control" id="date_start" />
              </div>
            </div>
            <div class="form-group">
              <label>Interim Department Head <small>(required for admin level 3+)</small></label>
              <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label>Type of leave</label>
              <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label>Reasons for leave</label>
              <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
          </div>
          <div class="kt-portlet__foot">
            <div>
              <button type="reset" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="col-xl-7">
      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
              <i class="kt-font-brand flaticon2-rocket-1"></i>
            </span>
            <h3 class="kt-portlet__head-title">
              Your leave/absence request(s)
              <small>{{ $request_list->count() }} request(s) has been found.</small>
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Date</th>
              <th>Type</th>
              <th>Status</th>
              <th>Created on</th>
              <th>Validated on</th>
            </tr>
            </thead>
            <tbody>
            @if ($request_list->count() > 0)
              @foreach ($request_list as $request)
                <tr>
                  <th scope="row">{{ $request->id }}</th>
                  <td>From <b>{{ $request->date_start }}</b>, to <b>{{ $request->date_end }}</b></td>
                  <td>{!! $request->getType() !!}</td>
                  <td>{!! $request->getStatus() !!}</td>
                  <td>{{ $request->created_at->diffForHumans() }}</td>
                  <td>{{ $request->updated_at->diffForHumans() }}</td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="6" class="text-center">No records found</td>
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
  <script src="{{ asset('js/pages/request/leave/index.js') }}" type="text/javascript"></script>
@endsection

