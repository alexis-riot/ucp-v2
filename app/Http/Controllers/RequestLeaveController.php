<?php

namespace App\Http\Controllers;

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

    public function showall(Request $request)
    {
        $request_list = RequestLeave::query()->orderBy('updated_at', 'desc');
        $users = RequestLeave::query()->orderBy('updated_at', 'desc');
        $parameters = array('type' => false, 'status' => false);

        if ($request->get('type') != null && $request->get('type') != "All") {
            $parameters['type'] = true;
            $request_list->where('type', $request->get('type'));
        }
        if ($request->get('status') != null && $request->get('status') != "All") {
            $parameters['status'] = true;
            $request_list->where('status', $request->get('status'));
        }
        if (Auth::user() != null) {
            $user = User::where('username', $request->get('search'))->first();
            if ($user !== null) {
                $request_list->where('account_id', $user->id);
                $parameters['status'] = true;
            }
            else {
                $request->session()->flash('user', 'This user doesnt exist.');
            }
        }
        if ($request->get('search') != null) {
            $parameters['search'] = true;
            $users->where('username', 'like', '%' . $request->get('search') . '%');
        }

        $paginated = $request_list->paginate(10);

        return view('request.leave.list')
            ->with('request_list', $paginated)
            ->with('parameters', $parameters);
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

    public function show(RequestLeave $loa)
    {
        return view('request.leave.show')
            ->with('difference', Carbon::parse($loa->date_start)->diffInDays($loa->date_end))
            ->with('ticket', $loa);
    }

    public function approve($loa)
    {
        $ticket = RequestLeave::findOrFail($loa);
        $ticket->status = 1;
        $ticket->approved_by = Auth::user()->id;
        $ticket->save();
        return redirect('/admin/request')
            ->with('ticket', $loa);
    }
    public function decline($loa)
    {
        $ticket = RequestLeave::findOrFail($loa);
        $ticket->status = 2;
        $ticket->approved_by = Auth::user()->id;
        $ticket->save();
        return redirect('/admin/request')
            ->with('ticket', $loa);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($loa)
    {
        $ticket = RequestLeave::findOrFail($loa);
        $ticket->status = 1;
        return view('request.leave.showone')
            ->with('ticket', RequestLeave::findOrFail($loa));
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
