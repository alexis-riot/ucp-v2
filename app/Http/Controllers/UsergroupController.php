<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\PermissionGroupList;
use App\Models\PermissionGroupUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsergroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('usergroup.index')
            ->with('group_list', PermissionGroup::paginate(10))
            ->with('permission_list', Permission::all()->groupBy('tag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usergroup.create')
            ->with('permission_list', Permission::all()->groupBy('tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|unique:cp_permissions_groups',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => "An error was encoured.",
            ], 200);
        } else {

            $usergroup = new PermissionGroup;
            $usergroup->name = $request->input('name');
            $usergroup->save();

            foreach ($request->input('permissions') as $permission) {
                $usergroup_permission = new PermissionGroupList;
                $usergroup_permission->group_id = $usergroup->id;
                $usergroup_permission->permission_id = $permission;
                $usergroup_permission->save();
            }
        }
        return response()->json([
            'status' => 'success',
            'message' => "You have created a new usergroup.",
            'redirect' => route('usergroup.index')
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('usergroup.edit')
            ->with('usergroup', PermissionGroup::findOrFail($id))
            ->with('permission_list', Permission::all()->groupBy('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => [
                'required',
                Rule::unique('cp_permissions_groups')->ignore($id),
            ],
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => "An error was encoured.",
            ], 200);
        } else {

            $usergroup = PermissionGroup::findOrFail($id);
            $usergroup->name = $request->input('name');
            $usergroup->save();

            // Deleting all existing permissions
            PermissionGroupList::where('group_id', $usergroup->id)->delete();

            foreach ($request->input('permissions') as $permission) {
                $usergroup_permission = new PermissionGroupList;
                $usergroup_permission->group_id = $usergroup->id;
                $usergroup_permission->permission_id = $permission;
                $usergroup_permission->save();
            }
        }
        return response()->json([
            'status' => 'success',
            'message' => "You have updated the usergroup.",
            'redirect' => route('usergroup.index')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        foreach (PermissionGroupUser::where('group_id', $id)->get() as $user)
            $user->delete();
        foreach (PermissionGroupList::where('group_id', $id)->get() as $permission)
            $permission->delete();

        PermissionGroup::findOrFail($id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => "The usergroup has been deleted.",
            'redirect' => route('usergroup.index')
        ], 200);
    }
}
