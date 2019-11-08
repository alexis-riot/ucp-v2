@extends('layouts.app')
@section('page_title', 'Logs Panel')

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('logs.panel') }}" class="kt-subheader__breadcrumbs-link">Server Logs</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('logs.panel') }}" class="kt-subheader__breadcrumbs-link">Panel</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('logs.panel') }}" class="kt-subheader__breadcrumbs-link">List</a>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12 d-flex justify-content-center">
      <div class="col-lg-4 col-md-6 col-sm-12">
        <h4 class="text-center">LOG SWITCHER</h4>

        <select class="form-control" id="log_select">
          <option value="">Select the log</option>
          @foreach ($tables_list as $log)
            <option value="{{ $log->type }}">{{ ucfirst($log->type) }}</option>
          @endforeach
        </select>
        <span class="form-text text-muted">Select the log in the list that you want to see.</span>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/pages/logs/panel/index.js') }}" type="text/javascript"></script>
@endsection
