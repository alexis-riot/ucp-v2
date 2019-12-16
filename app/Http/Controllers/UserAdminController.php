<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserAdminController extends Controller
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
     * Search page user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lookup.user.index');
    }

    /**
     * Search page user.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        //
    }
}
