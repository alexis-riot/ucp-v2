@extends('layouts.app')
@section('page_title', 'Usergroup List')

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('usergroup.index') }}" class="kt-subheader__breadcrumbs-link">Usergroup</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('usergroup.create') }}" class="kt-subheader__breadcrumbs-link">Create</a>
@endsection

@section('content')
  <form method="POST" data-form-method="POST" data-form-type="create" data-form-url="{{ route('usergroup.store') }}">
    <div class="row">
      <div class="col-md-4">
        <div class="kt-portlet">
          <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
              <h3 class="kt-portlet__head-title">
                Usergroup Informations
              </h3>
            </div>
          </div>
          <div class="kt-form">
            <div class="kt-portlet__body">
              <div class="form-group form-group-last">
                <div class="alert alert-secondary" role="alert">
                  <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                  <div class="alert-text">
                    Specify all informations about this new usergroup, all of these data can be edit later.
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Usergroup name</label>
                <input type="inputtext" name="usergroup_name" id="usergroup_name" class="form-control" aria-describedby="emailHelp" placeholder="Enter the name...">
              </div>
            </div>
            <div class="kt-portlet__foot">
              <div class="kt-form__actions">
                <button type="button" data-type-button="create" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="kt-portlet">
          <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
              <h3 class="kt-portlet__head-title">
                Permissions
              </h3>
            </div>
          </div>
          <div class="kt-form">
            <div class="kt-portlet__body">
              <div class="form-group form-group-marginless">
                @foreach ($permission_list as $key => $group)
                  <hr>
                  <h5>{{ $group[0]->tag }}</h5>
                  <div class="row">
                    @foreach ($group as $key_perm => $permission)
                      <div class="col-lg-6">
                        <label class="kt-option">
                        <span class="kt-option__control">
                          <span class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">
                            <input type="checkbox" name="label_permission" id="label_permission" value="{{ $permission->id }}">
                            <span></span>
                          </span>
                        </span>
                          <span class="kt-option__label">
                          <span class="kt-option__head">
                            <span class="kt-option__title">
                              {{ $permission->permission }}
                            </span>
                          </span>
                          <span class="kt-option__body">{{ $permission->description }}</span>
                        </span>
                        </label>
                      </div>
                    @endforeach
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

@endsection

@section('scripts')
  <script src="{{ asset('js/pages/usergroup/create.js') }}" type="text/javascript"></script>
@endsection

