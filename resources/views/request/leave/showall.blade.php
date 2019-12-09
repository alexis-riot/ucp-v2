@extends('layouts.app')
@section('page_title', "Bugs")

@section('breadcrumb')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ route('bug.index') }}" class="kt-subheader__breadcrumbs-link">Bug list</a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ route('bug.review') }}" class="kt-subheader__breadcrumbs-link">Review Bug Reports</a>
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
                            <small>{{ $request_list->count() }} ticket(s) has been found.</small>
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
                            <th>Date</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Created on</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($request_list->count() > 0)
                            @foreach ($request_list as $loa)
                                <tr>
                                    <td><a href="{{ route('showone', ['loa' => $loa]) }}">{{ $loa->id }}</a></td>
                                    <td>From <b>{{ $loa->date_start }}</b>, to <b>{{ $loa->date_end }}</b></td>
                                    <td>{!! $loa->getType() !!}</td>
                                    <td>{!! $loa->getStatus() !!}</td>
                                    <td>{{ $loa->created_at->diffForHumans() }}</td>
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
    <script src="{{ asset('js/pages/bug/list.js') }}" type="text/javascript"></script>
@endsection
