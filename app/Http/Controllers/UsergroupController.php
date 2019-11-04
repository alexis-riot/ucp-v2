<?php

namespace App\Http\Controllers;

use App\Http\Requests\Usergroup\StoreRequest;
use App\Http\Requests\Usergroup\UpdateRequest;
use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\PermissionGroupList;
use App\Models\PermissionGroupUser;

class UsergroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
    public function store(StoreRequest $request)
    {
        $usergroup = PermissionGroup::create([
            'name' => $request->input('name'),
        ]);

        collect($request->input('permissions'))->each(function($permission) use ($usergroup) {
            PermissionGroupList::create([
                'group_id' => $usergroup->id,
                'permission_id' => $permission,
            ]);
        });

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
    public function update(UpdateRequest $request, PermissionGroup $usergroup)
    {
        $usergroup->name = $request->input('name');
        $usergroup->save();

        // Deleting all existing permissions
        PermissionGroupList::where('group_id', $usergroup->id)->delete();

        collect($request->input('permissions'))->each(function($permission) use ($usergroup) {
            PermissionGroupList::create([
                'group_id' => $usergroup->id,
                'permission_id' => $permission,
            ]);
        });

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
