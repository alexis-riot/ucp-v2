<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class WarnController extends Controller
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
     * Show the punishments list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('warn.index')
            ->with('user', Auth::user())
            ->with('countActiveWarns', collect(Auth::user()->warns)->map(function ($warn) {
                return ($warn->isExpired()) ? 0 : $warn->points;
            })->sum());
    }
}
