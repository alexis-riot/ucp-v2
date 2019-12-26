@extends('layouts.app')
@section('page_title', 'Logs Server')

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('logs.server') }}" class="kt-subheader__breadcrumbs-link">Server Logs</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('logs.server') }}" class="kt-subheader__breadcrumbs-link">Server</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('logs.server') }}" class="kt-subheader__breadcrumbs-link">{{ ucfirst(request('log')) }}</a>
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
              Server Logs - {{ ucfirst(request('log')) }}
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body">
          <div class="row">
            <div class="col-md-3">
              <form method="POST" id="search_user">
                <div class="kt-input-icon kt-input-icon--left">
                  <input type="text" class="form-control @if (Session::has('user')) is-invalid @endif" placeholder="Search a specific user..." value="{{ request('user') }}" data-url-redirect="user" id="search_text_user">
                  <span class="kt-input-icon__icon kt-input-icon__icon--left">
                    <span><i class="la la-search"></i></span>
                  </span>
                </div>
                @if (Session::has('user'))
                  <span class="form-text text-muted kt-font-danger">{!! session('user') !!}</span>
                @endif
                <input type="submit" style="display: none;">
              </form>
            </div>
            <div class="col-md-3">
              <form method="POST" id="search_global">
                <div class="kt-input-icon kt-input-icon--left">
                  <input type="text" class="form-control" placeholder="Search by word/sentence..." value="{{ request('search') }}" data-url-redirect="search" id="search_text_global">
                  <span class="kt-input-icon__icon kt-input-icon__icon--left">
                    <span><i class="la la-search"></i></span>
                  </span>
                </div>
                <input type="submit" style="display: none;">
              </form>
            </div>
            <div class="col-md-3">
              <div class="form-group row">
                <label for="example-text-input" class="col-3 col-form-label">Log Type:</label>
                <div class="col-9">
                  <select class="form-control" data-url-redirect="type" id="log_type">
                    <option>All</option>
                    @foreach ($type_list as $key => $type)
                      <option value="{{ $key }}" @if (app('request')->input('type') == $key && $parameters['type'] == true) selected @endif>{{ $type->category }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <table class="table table-striped table-light">
            <thead>
              <tr>
                <th>#</th>
                <th>Username / Character</th>
                <th>Date</th>
                <th>Section</th>
                <th>Details</th>
                <th>IP</th>
              </tr>
            </thead>
            <tbody class="table-detailled">
            @if ($logs_list->count() > 0)
              @foreach ($logs_list as $log)
                <tr class="content" id="{{ $log->id }}">
                  <th scope="row">{{ $log->id }}</th>
                  <td>@if ($log->username) <a href="#">{{ $log->username }}</a> @else -- @endif / @if ($log->name) <a href="#">{{ $log->name }}</a> @else -- @endif</td>
                  <td>{{ $log->timestamp }}</td>
                  <td>{{ $log->category }}</td>
                  <td>{{ Str::limit($log->message, 70, '...') }}</td>
                  <td>{{ $log->ip }} <small><a target="_blank" href="http://www.ip-tracker.org/locator/ip-lookup.php?ip={{ $log->ip }}">[Trace]</a></small></td>
                </tr>
                @if (strlen($log->message) > 70)
                  <tr class="detail detail-hidden" id="{{ $log->id }}">
                    <td colspan="6">{{ $log->message }}</td>
                  </tr>
                @endif
              @endforeach
            @else
              <tr>
                <td colspan="6" class="text-center">No records found</td>
              </tr>
            @endif
            </tbody>
          </table>
          {{ $logs_list->render() }}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/pages/logs/server/show.js') }}" type="text/javascript"></script>
@endsection
