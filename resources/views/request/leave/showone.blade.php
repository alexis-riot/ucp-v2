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
                    <label class="col-5 col-form-label">Submitted by:</label>
                    <div class="col-7">
                        <span class="form-control-plaintext kt-font-bolder">{{ $ticket->user->username }}</span>
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
                        <span class="form-control-plaintext kt-font-bolder">{{ $ticket->date_start }}<small>to</small>{{ $ticket->date_end }}</span>
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
@endsection

@section('scripts')

@endsection
