@extends('layouts.app')
@section('page_title', 'Usergroup List')

@section('breadcrumb')
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('usergroup.index') }}" class="kt-subheader__breadcrumbs-link">Usergroup</a>
  <span class="kt-subheader__breadcrumbs-separator"></span>
  <a href="{{ route('usergroup.index') }}" class="kt-subheader__breadcrumbs-link">List</a>
@endsection

@section('content')
  <div class="row">
    <div class="col-xl-6">
      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
              <i class="kt-font-brand fa fa-users"></i>
            </span>
            <h3 class="kt-portlet__head-title">
              Usergroups list
              <small>{{ $group_list->count() }} group(s) has been found.</small>
            </h3>
          </div>
          <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
              <div class="dropdown dropdown-inline">
                <a href="{{ route('usergroup.create') }}" class="btn btn-brand btn-icon-sm">
                  <i class="flaticon2-plus"></i> Create a new usergroup
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="kt-portlet__body">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Permissions</th>
              <th>Users in</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if ($group_list->count() > 0)
              @foreach ($group_list as $group)
                <tr>
                  <th scope="row">{{ $group->id }}</th>
                  <td>{{ $group->name }}</td>
                  <td>{{ $group->group_list->count() }}</td>
                  <td>{{ $group->group_user->count() }}</td>
                  <td>
                    <form method="POST" data-form-method="DELETE" data-form-type="delete_usergroup" data-form-url="{{ route('usergroup.destroy', ['usergroup' => $group]) }}">
                      <a href="{{ route('usergroup.edit', ['usergroup' => $group]) }}" title="Edit details" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="la la-edit"></i>
                      </a>
                      <button type="button" data-type-button="delete_usergroup" value="{{ $group->id }}" title="Delete" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                        <i class="la la-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="5" class="text-center">No group found.</td>
              </tr>
            @endif
            </tbody>
          </table>
          {{ $group_list->links() }}
        </div>
      </div>
    </div>

    <div class="col-xl-6">
      <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
          <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
              <i class="kt-font-brand fa fa-shield-alt"></i>
            </span>
            <h3 class="kt-portlet__head-title">
              Permissions
              <small>{{ \App\Models\Permission::count() }} permission(s) in {{ $permission_list->count() }} group(s) has been found.</small>
            </h3>
          </div>
          <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
              <div class="dropdown dropdown-inline">
                <a href="{{ route('permission.create') }}" class="btn btn-brand btn-icon-sm">
                  <i class="flaticon2-plus"></i> Add a permission
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="kt-portlet__body">
          <div class="accordion accordion-light accordion-toggle-arrow" id="accordionExample2">
            @foreach ($permission_list as $key => $group)
              <div class="card">
                <div class="card-header" id="heading{{ $group[0]->id }}">
                  <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse{{ $group[0]->id }}" aria-expanded="false" aria-controls="collapse{{ $group[0]->id }}">
                    {{ $group[0]->tag }}
                  </div>
                </div>
                <div id="collapse{{ $group[0]->id }}" class="collapse" aria-labelledby="heading{{ $group[0]->id }}" data-parent="#accordionExample2">
                  <div class="card-body collapsed">
                    <table class="table table-striped">
                      <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Currently used</th>
                        <th>Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach ($group as $permission)
                        <tr>
                          <th scope="row">{{ $permission->id }}</th>
                          <td>{{ $permission->permission }}</td>
                          <td>
                            @if ($permission->groupsList->count() > 0)
                              <span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill kt-badge--rounded">
                                in {{ $permission->groupsList->count() }} group(s)
                              </span>
                            @else
                              <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">
                                in {{ $permission->groupsList->count() }} group
                              </span>
                            @endif
                          </td>
                          <td>
                            <form method="POST" data-form-method="DELETE" data-form-type="delete_permission" data-form-url="{{ route('permission.destroy', ['permission' => $permission]) }}">
                              <a href="{{ route('permission.edit', ["permission" => $permission]) }}" title="Edit details" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                <i class="la la-edit"></i>
                              </a>
                              <button type="button" data-type-button="delete_permission" value="{{ $permission->id }}" title="Delete" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                <i class="la la-trash"></i>
                              </button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/pages/usergroup/index.js') }}" type="text/javascript"></script>
@endsection
