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
    public function search(Request $request, User $user)
    {
        return view('lookup.search');
    }

    /**
     * User lookup dash.
     *
     * @return \Illuminate\Http\Response
     */
    public function overview(Request $request, User $user)
    {
        return view('lookup.user.overview')
            ->with('user', $user);
    }

    public function usergroup(Request $request, User $user)
    {
        return view('lookup.user.usergroup')
            ->with('user', $user);
    }

    public function punishments(Request $request, User $user)
    {
        return view('lookup.user.punishments')
            ->with('user', $user);
    }

    public function whois(Request $request, User $user)
    {
        return view('lookup.user.whois')
            ->with('user', $user);
    }

    public function staffProfile(Request $request, User $user)
    {
        return view('lookup.user.staff_profile')
            ->with('user', $user);
    }
}
