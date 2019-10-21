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
          <h4 class="alert-heading">Actually, you have <span class="kt-font-bold">{{ $countActiveWarns }} warnings</span> points.</h4>
          <p>This table contains all the information about your admin records in this community.</p>
          <hr>
          <p class="mb-0">As a reminder, a strict regulation is available by <a class="kt-link kt-font-bold" href="https://mafiacity-rp.com/forums/index.php?threads/server-rules.2496/" target="_blank">clicking here</a>.</p>
        </div>
      </div>
      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
              <i class="kt-font-brand flaticon2-warning"></i>
            </span>
            <h3 class="kt-portlet__head-title">
              Punishments Records
              <small>{{ $user->warns->count() }} warns has been found.</small>
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body">
          <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
            <div class="row align-items-center">
              <div class="col-xl-8 order-2 order-xl-1">
                <div class="row align-items-center">
                  <div class="col-md-6 kt-margin-b-20-tablet-and-mobile">
                    <div class="kt-input-icon kt-input-icon--left">
                      <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                      <span class="kt-input-icon__icon kt-input-icon__icon--left">
                        <span><i class="la la-search"></i></span>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">
          <table class="kt-datatable2" id="html_table" width="100%">
            <thead>
            <tr>
              <th title="Field #1">Reason</th>
              <th title="Field #2">Staff Name</th>
              <th title="Field #3">Points</th>
              <th title="Field #4">Date</th>
              <th title="Field #5">Expiration</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($user->warns as $warn)
                <tr>
                  <td>{{ $warn->name }}</td>
                  <td>{{ $warn->author->username }}</td>
                  <td>{{ $warn->points }}</td>
                  <td>{{ $warn->punishmentDate }}</td>
                  <td>
                    @if ($warn->isExpired()):
                      <span class="kt-font-danger">Expired on {{ $warn->expiration }}</span>
                    @else:
                      <span class="kt-font-default">{{ $warn->expiration }}</span>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('scripts')
  <script>
      var KTDatatable = function() {
          return {
              // Public functions
              init: function() {
                  $('.kt-datatable2').KTDatatable({
                      data: {
                          saveState: {
                              cookie: false
                          },
                      },
                      search: {
                          input: $('#generalSearch'),
                      },
                      // columns definition
                      columns: [{
                          sortable: 'asc',
                          selector: false,
                      }],
                  });
              },
          };
      }();

      jQuery(document).ready(function() {
          KTDatatable.init();
      });
  </script>
@endsection
