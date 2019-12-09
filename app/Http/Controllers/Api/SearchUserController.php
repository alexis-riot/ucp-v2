<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\User;
use Illuminate\Http\Request;

class SearchUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function search(Request $request)
    {
        $user_list = User::where('username', 'like', '%' . $request->get('username') . '%')->get();
        $character_list = Character::where('name', 'like', '%' . $request->get('username') . '%')->get();

        if ($request->input('render')) {
            return view('api.search_user')
                ->with('user_list', $user_list)
                ->with('character_list', $character_list)
                ->render();
        }
        else {
            return response()->json([
                'status' => 'success',
                'character_list' => $user_list,
                'user_list' => $character_list,
            ], 200);
        }
    }
}
