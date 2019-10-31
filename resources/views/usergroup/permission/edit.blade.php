@extends('layouts.app')
@section('page_title', 'Usergroup List')

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('usergroup.index') }}" class="kt-subheader__breadcrumbs-link">Usergroup</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('usergroup.create') }}" class="kt-subheader__breadcrumbs-link">Create</a>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="kt-portlet">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Permission Information
            </h3>
          </div>
        </div>
        <form class="kt-form" method="POST" data-form-method="PUT" data-form-type="update" data-form-url="{{ route('permission.update', ["permission" => $permission]) }}">
          <div class="kt-portlet__body">
            <div class="form-group form-group-last">
              <div class="alert alert-secondary" role="alert">
                <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                <div class="alert-text">
                  The permission will be created and can be assigned to all usergroups.
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Permission Name</label>
              <input type="inputtext" name="name" id="name" value="{{ $permission->permission }}" class="form-control" placeholder="Enter the name...">
            </div>
            <div class="form-group">
              <label>Group Name</label>
              <input type="inputtext" name="group" id="group" value="{{ $permission->tag }}" class="form-control" placeholder="Enter the group name...">
            </div>
            <div class="form-group">
              <label>Description</label>
              <input type="inputtext" name="description" id="description" value="{{ $permission->description }}" class="form-control" placeholder="Enter the description...">
            </div>
          </div>
          <div class="kt-portlet__foot">
            <div class="kt-form__actions">
              <button type="button" data-type-button="update" class="btn btn-primary">Update</button>
              <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/pages/usergroup/permission/edit.js') }}" type="text/javascript"></script>
@endsection
