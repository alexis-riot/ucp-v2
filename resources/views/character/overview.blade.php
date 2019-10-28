@extends('layouts.app')
@section('page_title', $character->username)

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('profile') }}" class="kt-subheader__breadcrumbs-link">Characters</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('character.overview', ['id' => $character->id, 'slug' => $character->slug()]) }}" class="kt-subheader__breadcrumbs-link">{{ $character->name }}</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('character.overview', ['id' => $character->id, 'slug' => $character->slug()]) }}" class="kt-subheader__breadcrumbs-link">Overview</a>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
          <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
              <h3 class="m-portlet__head-text">
                Statistics of tets
              </h3>
            </div>
          </div>
        </div>
        <div class="m-portlet__body" style="padding: 0px;">
          <div class="panel-body panel-body-table">
            <table class="table table-striped">
              <tbody>
              <tr>
                <td><i class="fa fa-user"></i> <b>Name</b></td>
                <td>test</td>
              </tr>
              <tr>
                <td><i class="fa fa-transgender"></i> <b>Gender</b></td>
                <td><i class="fa fa-male" style="color: #1996f6"></i></td>
              </tr>
              <tr>
                <td><i class="fa fa-phone"></i> <b>Phone number</b></td>
                <td>N/A</td>
              </tr>
              <tr>
                <td><i class="fa fa-money"></i> <b>Cash</b></td>
                <td>$ test</td>
              </tr>
              <tr>
                <td><i class="fa fa-credit-card"></i> <b>Bank</b></td>
                <td>$ </td>
              </tr>
              <tr>
                <td><i class="fa fa-medkit"></i> <b>Health</b></td>
                <td>
                  <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: 10%"  aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"><b>10HP</b></div>
                  </div>
                   20
                  <br>
                  <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-defaut" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"><b>10 ARM</b></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td><i class="fa fa-cutlery"></i> <b>Hunger</b></td>
                <td>
                  <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 10%" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"><b>10%</b></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td><i class="fa fa-suitcase"></i> <b>License(s)</b></td>
                <td>
                  test
                </td>
              </tr>
              <tr>
                <td><i class="fa fa-connectdevelop"></i> <b>Organization(s)</b></td>
                <td>
                  - <a href="#">test</a> <span class="m-badge m-badge--brand m-badge--wide">group</span><br>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
