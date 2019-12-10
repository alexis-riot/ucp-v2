@extends('layouts.app')
@section('page_title', "Bugs")

@section('breadcrumb')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ route('bug.index') }}" class="kt-subheader__breadcrumbs-link">Bug list</a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ route('bug.review') }}" class="kt-subheader__breadcrumbs-link">Review Bug Reports</a>
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Leave of Absence Request Details
                </h3>
            </div>
        </div>
        <div class="kt-form kt-form--label-right">
            <div class="kt-portlet__body">
                <div class="form-group form-group-xs row">
                    <label class="col-5 col-form-label">Submitted by:</label>
                    <div class="col-7">
                        <span class="form-control-plaintext kt-font-bolder">{{ $ticket->user->username }}</span>
                    </div>
                </div>
                <div class="form-group form-group-xs row">
                    <label class="col-5 col-form-label">Type:</label>
                    <div class="col-7">
                        <span class="form-control-plaintext kt-font-bolder">{!! $ticket->getType() !!}</span>
                    </div>
                </div>
                <div class="form-group form-group-xs row">
                    <label class="col-5 col-form-label">Status:</label>
                    <div class="col-7">
                        <span class="form-control-plaintext">{!! $ticket->getStatus() !!}</span>
                    </div>
                </div>
                <div class="form-group form-group-xs row">
                    <label class="col-5 col-form-label">Reason:</label>
                    <div class="col-7">
                        <span class="form-control-plaintext kt-font-bolder">{{ $ticket->reason }}</span>
                    </div>
                </div>
                <div class="form-group form-group-xs row">
                    <label class="col-5 col-form-label">Date:</label>
                    <div class="col-7">
                        <span class="form-control-plaintext kt-font-bolder">{{ Carbon\Carbon::parse($ticket->date_start)->isoFormat('MMM Do YYYY') }}<small> / </small>{{ Carbon\Carbon::parse($ticket->date_end)->isoFormat('MMM Do YYYY') }}</span>
                    </div>
                </div>
                <div class="form-group form-group-xs row">
                    <label class="col-5 col-form-label">Duration:</label>
                    <div class="col-7">
                        <span class="form-control-plaintext kt-font-bolder">{{ $difference }}    Days</span>
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
                <br><br><div style="text-align: center">
                @if( $ticket->status == 0)
                    <button class="btn m-btn--square  btn-success">
                        <a style="color: white" href="{{ route('approve', ['loa' => $ticket]) }}">Approve</a>
                    </button>
                    <button class="btn m-btn--square  btn-danger">
                        <a style="color: white" href="{{ route('decline', ['loa' => $ticket]) }}">Decline</a>
                    </button>
                @elseif($ticket->status == 1)
                    <button class="btn m-btn--square  btn-success">
                        <a style="color: white" disabled="">Already Approved</a>
                    </button>
                @else
                    <button class="btn m-btn--square  btn-danger">
                        <a style="color: white" disabled="">Already Declined</a>
                    </button>
                @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
