<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdatePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        return view('user.index')
            ->with('user', Auth::user())
            ->with('characters', DB::table('characters')->where('accountID', Auth::user()->id));
    }

    /**
     * Editing the password.
     *
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
        return view('user.password')
            ->with('user', Auth::user());
    }
    public function updatePassword(UpdatePasswordRequest $request)
    {
        if(Hash::check($request->input('actual_password'), Auth::user()->password)) {
            Auth::user()->password = Hash::make($request->input('new_password'));
            Auth::user()->save();
        }
        else {
            return response()->json([
                'status' => 'error',
                'message' => 'Your actual password is incorrect.',
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'reset' => true,
            'message' => 'Your password has been changed.',
        ], 200);
    }
}
