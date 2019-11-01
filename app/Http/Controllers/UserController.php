<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
}
