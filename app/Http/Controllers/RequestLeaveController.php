<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestLeave\StoreRequest;
use App\Models\RequestLeave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Carbon;



class RequestLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('request.leave.index')
            ->with('request_list', RequestLeave::where('account_id', Auth::user()->id)->paginate(15))
            ->with('staff_list', User::where('admin', '>', '0')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $date_start = date("Y-m-d", strtotime($request->input('date_start')));
        $date_end = date("Y-m-d", strtotime($request->input('date_end')));

        RequestLeave::create([
            'account_id' => Auth::user()->id,
            'date_start' => $date_start,
            'date_end' => $date_end,
            'interim_head' => $request->input('head'),
            'type' => $request->input('type'),
            'reason' => $request->input('reason'),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => "Your leave request has been submitted.",
            'redirect' => route('leave.index')
        ], 200);
    }
}
