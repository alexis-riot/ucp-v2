<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permission\StoreRequest;
use App\Http\Requests\Permission\UpdateRequest;
use App\Models\Permission;
use App\Models\PermissionGroupList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usergroup.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Permission::create([
            'permission' => $request->input('name'),
            'tag' => $request->input('group'),
            'description' => $request->input('description'),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => "You have created a new permission.",
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
        return view('usergroup.permission.edit')
            ->with('permission', Permission::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->permission = $request->input('name');
        $permission->tag = $request->input('group');
        $permission->description = $request->input('description');
        $permission->save();

        return response()->json([
            'status' => 'success',
            'message' => "You have updated the permission.",
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
        PermissionGroupList::where('permission_id', $id)->delete();
        Permission::findOrFail($id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => "You have deleted the permission.",
            'redirect' => route('usergroup.index')
        ], 200);
    }
}
