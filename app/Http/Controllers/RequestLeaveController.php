<?php

namespace App\Http\Controllers;

use App\Models\RequestLeave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
            ->with('request_list', RequestLeave::where('account_id', Auth::user()->id)->paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leave.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date1 = $request->get('date_start');
        $date2 = $request->get('date_end');
        $date5 = date("Y-m-d", strtotime($date1));
        $date6 = date("Y-m-d", strtotime($date2));

        RequestLeave::create([
            'account_id' => Auth::user()->id,
            'date_start' => $date5,
            'date_end' => $date6,
            'interim_head' => $request->input('head'),
            'type' => $request->input('type'),
            'reason' => $request->input('reason'),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => "You have created a new Leave of absence Request.",
            'redirect' => route('leave.index')
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
