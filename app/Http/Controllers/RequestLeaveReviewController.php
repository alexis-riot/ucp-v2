<?php

namespace App\Http\Controllers;

use App\Models\RequestLeave;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestLeaveReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request_list = RequestLeave::query()->orderBy('status', 'asc');
        $parameters = array('type' => false, 'status' => false);

        if ($request->get('type') != null && $request->get('type') != "All") {
            $parameters['type'] = true;
            $request_list->where('type', $request->get('type'));
        }
        if ($request->get('status') != null && $request->get('status') != "All") {
            $parameters['status'] = true;
            $request_list->where('status', $request->get('status'));
        }
        if ($request->get('search') != null) {
            $user = User::where('username', $request->get('search'))->first();
            if ($user !== null) {
                $request_list->where('account_id', $user->id);
                $parameters['search'] = true;
            }
            else {
                $request->session()->flash('user', 'This user doesnt exist.');
            }
        }

        $paginated = $request_list->paginate(10);

        return view('request.leave.review.index')
            ->with('request_list', $paginated)
            ->with('parameters', $parameters);
    }

    public function update(Request $request, RequestLeave $request_leave)
    {
        $request_leave->update([
            'status' => (($request->input('method') === 'approve') ? 1 : 2),
            'approved_by' => Auth::user()->id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => "You have review the request.",
            'redirect' => route('leave.review')
        ], 200);
    }
}
