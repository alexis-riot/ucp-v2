@extends('layouts.app')
@section('page_title', "LOA")

@section('breadcrumb')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ route('leave.index') }}" class="kt-subheader__breadcrumbs-link">Requests list</a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ route('showall') }}" class="kt-subheader__breadcrumbs-link">Review Requests list</a>
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
                            <th>Date</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody class="table-detailled">
                        @if ($request_list->count() > 0)
                            @foreach ($request_list as $loa)
                                <tr class="content" id="{{ $loa->id }}"><td>{{ $loa->id }}</td>
                                    <td>From <b>{{ Carbon\Carbon::parse($loa->date_start)->isoFormat('MMM Do YYYY') }}</b>, to <b>{{ Carbon\Carbon::parse($loa->date_end)->isoFormat('MMM Do YYYY') }}</b></td>
                                    <td>{!! $loa->getType() !!}</td>
                                    <td>{!! $loa->getStatus() !!}</td>
                                </tr>
                                <tr class="detail detail-hidden" id ="{{ $loa->id }}">
                                    <td colspan="4" style="text-align: center">
                                        <br><b>Reason for leave:</b> {{ $loa->reason }}<br>
                                        @if( $loa->status == 0)
                                        <b style="color: #0c61ed">Waiting Approval</b> <br>
                                        @elseif( $loa->status == 1)
                                        <b style="color: #0c5ce1">Approved by:</b> {{ $loa->approve->username }} <br>
                                        @else
                                        <b style="color: red">Declined by:</b> {{ $loa->approve->username }} <br>
                                        @endif
                                        <b>Request submitted on:</b> {{ $loa->created_at->diffForHumans() }}<br>
                                        <b>Interim department head:</b> {{ $loa->head->username }} <br> <br>
                                        <button class="btn m-btn--square  btn-success">
                                            <a style="color: white" href="{{ route('showone', ['loa' => $loa]) }}">Show more details</a>
                                        </button>
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
    <script src="{{ asset('js/pages/bug/list.js') }}" type="text/javascript"></script>
@endsection
