@extends('layouts.app')
@section('page_title', "Bugs")

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('bug/index') }}" class="kt-subheader__breadcrumbs-link">Bug list</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('bug/review') }}" class="kt-subheader__breadcrumbs-link">Review Bug Reports</a>
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
              Review Bug Reports
              <small>{{ $bug_list->count() }} ticket(s) has been found.</small>
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body">
          <div class="row">
            <div class="col-md-3">
              <form id="search">
                <div class="kt-input-icon kt-input-icon--left">
                  <input type="text" class="form-control" placeholder="Search..." value="{{ request('search') }}" data-url-redirect="search" id="search_text">
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
                    @foreach (\App\Models\BugTicket::$statusString as $key => $status)
                      <option value="{{ $key }}" @if (app('request')->input('status') == $key && $parameters['status'] == True) selected @endif>{!! $status !!}</option>
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
                    @foreach (\App\Models\BugTicket::$typeString as $key => $type)
                      <option value="{{ $key }}" @if (app('request')->input('type') == $key && $parameters['type'] == True) selected @endif>{!! $type !!}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Bug subject</th>
              <th>Type</th>
              <th>Status</th>
              <th>Created on</th>
              <th>Updated on</th>
            </tr>
            </thead>
            <tbody>
            @if ($bug_list->count() > 0)
              @foreach ($bug_list as $bug)
              <tr>
                <th scope="row">{{ $bug->id }}</th>
                <td><a href="{{ route('bug/show', ['bug' => $bug]) }}">{{ $bug->subject }}</a></td>
                <td>{!! $bug->getType() !!}</td>
                <td>{!! $bug->getStatus() !!}</td>
                <td>{{ $bug->created_at->diffForHumans() }}</td>
                <td>{{ $bug->updated_at->diffForHumans() }}</td>
              </tr>
              @endforeach
            @else
              <tr>
                <td colspan="6" class="text-center">No records found</td>
              </tr>
            @endif
            </tbody>
          </table>
          {{ $bug_list->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/pages/bug/list.js') }}" type="text/javascript"></script>
@endsection
