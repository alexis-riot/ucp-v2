@extends('layouts.user')
@section('page_title', 'Punishments Records')

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('punishments') }}" class="kt-subheader__breadcrumbs-link">Punishments Records</a>
@endsection

@section('content')
  <div class="row">
    <div class="col-xl-12">
      <div class="alert alert-light alert-elevate fade show" role="alert">
        <div class="alert-text">
          <h4 class="alert-heading">Actually, you have <span class="kt-font-bold">{{ $countActiveWarns }} active records</span>.</h4>
          <p>This table contains all the information about your admin records in this community.</p>
          <hr>
          <p class="mb-0">As a reminder, a strict regulation is available by <a class="kt-link kt-font-bold" href="https://mafiacity-rp.com/forums/index.php?threads/server-rules.2496/" target="_blank">clicking here</a>.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-12">
      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
              <i class="kt-font-brand flaticon2-rocket-1"></i>
            </span>
            <h3 class="kt-portlet__head-title">
              Punishments Records
              <small>{{ $user->warns->count() }} warns has been found.</small>
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body">
          <table class="table table-striped table-light">
            <thead>
            <tr>
              <th>Reason</th>
              <th>Staff Name</th>
              <th>Date</th>
              <th>Expiration</th>
            </tr>
            </thead>
            <tbody>
            @if ($user->warns->count() > 0)
              @foreach ($user->warns as $warn)
                <tr>
                  <td>{{ $warn->name }}</td>
                  <td>@if ($warn->author) {{ $warn->author->username }} @else N/A @endif</td>
                  <td>{{ $warn->punishmentDate }}</td>
                  <td>
                    @if ($warn->isExpired())
                      <span class="kt-font-danger">Expired on {{ $warn->expiration }}</span>
                    @else
                      <span class="kt-font-default">{{ $warn->expiration }}</span>
                    @endif
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="6" class="text-center">No records found</td>
              </tr>
            @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
