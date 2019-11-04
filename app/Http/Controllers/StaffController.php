<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the staff list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('staff.index')
            ->with('staff_list', User::where('admin', '>', '0')->orWhere('developer', '>', '0')->get());
    }
}
