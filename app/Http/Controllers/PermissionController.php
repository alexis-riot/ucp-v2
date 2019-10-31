<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{

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
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|unique:cp_permissions,permission',
            'group' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => "An error was encoured.",
            ], 200);
        } else {
            $permission = new Permission;
            $permission->permission = $request->input('name');
            $permission->tag = $request->input('group');
            $permission->description = $request->input('description');
            $permission->save();
        }
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
    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => [
                'required',
                Rule::unique('cp_permissions', 'permission')->ignore($id),
            ],
            'group' => 'required',
            'description' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => "An error was encoured.",
            ], 200);
        } else {
            $permission = Permission::findOrFail($id);
            $permission->permission = $request->input('name');
            $permission->tag = $request->input('group');
            $permission->description = $request->input('description');
            $permission->save();
        }
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
        Permission::findOrFail($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => "You have deleted the permission.",
            'redirect' => route('usergroup.index')
        ], 200);
    }
}
