<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bug\StoreCommentRequest;
use App\Http\Requests\Bug\StoreRequest;
use App\Http\Requests\Bug\UpdateRequest;
use App\Models\BugComment;
use App\Models\BugImage;
use App\Models\BugLog;
use App\Models\BugTicket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BugController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('IsHisBugTicket', ['only' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bug_list = BugTicket::where('account_id', Auth::user()->id)->orderBy('updated_at', 'desc');
        $parameters = array('type' => false, 'status' => false);

        if ($request->get('type') != null && $request->get('type') != "All") {
            $parameters['type'] = true;
            $bug_list->where('type', $request->get('type'));
        }
        if ($request->get('status') != null && $request->get('status') != "All") {
            $parameters['status'] = true;
            $bug_list->where('status', $request->get('status'));
        }
        if ($request->get('search') != null) {
            $parameters['search'] = true;
            $bug_list->where('subject', 'like', '%' . $request->get('search') . '%');
        }
        $paginated = $bug_list->paginate(10);
        return view('bug.index')
            ->with('bug_list', $paginated)
            ->with('parameters', $parameters);
    }

    public function review(Request $request)
    {
        $bug_list = BugTicket::query()->orderBy('updated_at', 'desc');
        $parameters = array('type' => false, 'status' => false);

        if ($request->get('type') != null && $request->get('type') != "All") {
            $parameters['type'] = true;
            $bug_list->where('type', $request->get('type'));
        }
        if ($request->get('status') != null && $request->get('status') != "All") {
            $parameters['status'] = true;
            $bug_list->where('status', $request->get('status'));
        }
        if ($request->get('search') != null) {
            $parameters['search'] = true;
            $bug_list->where('subject', 'like', '%' . $request->get('search') . '%');
        }
        $paginated = $bug_list->paginate(10);
        return view('bug.review')
            ->with('bug_list', $paginated)
            ->with('parameters', $parameters);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bug.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $bugTicket = BugTicket::create([
            'type' => $request->input('bug_type'),
            'account_id' => Auth::user()->id,
            'subject' => $request->input('subject'),
            'priority' => $request->input('bug_priority'),

        ]);

        BugComment::create([
            'bug_id' => $bugTicket->id,
            'account_id' => Auth::user()->id,
            'comment' => $request->input('content'),
        ]);

        // Creating images
        collect($request->input('images'))->map(function($image) use ($bugTicket) {
            BugImage::create([
                'bug_id' => $bugTicket->id,
                'path' => $image,
            ]);
        });

        return response()->json([
            'status' => 'success',
            'message' => "Your bug report was submitted.",
            'redirect' => route('bug.show', ['bug' => $bugTicket])
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BugTicket  $bugsTickets
     * @return \Illuminate\Http\Response
     */
    public function show(BugTicket $bug)
    {
        return view('bug.show', [
            'ticket' => $bug
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BugTicket  $bugsTickets
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, BugTicket $bug)
    {
        $logTicket = array();
        $this->authorize('ticket-update-settings');
        if ($bug->subject != $request->input('settings_subject')) {
            $logTicket[] = sprintf("change the subject from \"%s\" to \"%s\".", $bug->subject, $request->input('settings_subject'));
            $bug->subject = $request->input('settings_subject');
        }

        if ($bug->type != $request->input('settings_type')) {
            $logTicket[] = sprintf("change the type from \"%s\" to \"%s\".", $bug->getType(), BugTicket::$typeString[$request->input('settings_type')]);
            $bug->type = $request->input('settings_type');
        }

        if ($bug->status != $request->input('settings_status')) {
            $logTicket[] = sprintf("change the status from %s to %s.", $bug->getStatus(), BugTicket::$statusString[(int)$request->input('settings_status')]);
            $bug->status = $request->input('settings_status');
        }

        if (!empty($request->input('settings_developer'))) {
            if (($developer = User::where('username', $request->input('settings_developer'))->first())) {
                if ($bug->developer_assigned != $developer->id) {
                    $logTicket[] = sprintf("change the developer assigned from %s to %s.", $bug->developer->username, $developer->username);
                    $bug->developer_assigned = $developer->id;
                }
            }
            else {
                return response()->json([
                    'status' => 'error',
                    'message' => "The user mentionned has developer was not found.",
                ], 200);
            }
        } else {
            $bug->developer_assigned = -1;
        }

        if (!empty($request->input('settings_tester'))) {
            if (($tester = User::where('username', $request->input('settings_tester'))->first())) {
                if ($bug->tester_assigned != $tester->id) {
                    $logTicket[] = sprintf("change the tester assigned from %s to %s.", $bug->tester->username, $tester->username);
                    $bug->tester_assigned = $tester->id;
                }
            }
            else {
                return response()->json([
                    'status' => 'error',
                    'message' => "The user mentionned has tester was not found.",
                ], 200);
            }
        } else {
            $bug->tester_assigned = -1;
        }

        $bug->save();
        collect($logTicket)->map(function($log) use ($bug) {
            BugLog::create([
                'bug_id' => $bug->id,
                'account_id' => Auth::user()->id,
                'logs' => $log,
            ]);
        });

        return response()->json([
            'status' => 'success',
            'message' => "The ticket was updated.",
            'redirect' => route('bug.show', ['bug' => $bug])
        ], 200);
    }

    public function storeComment(StoreCommentRequest $request, BugTicket $bug)
    {
        // Creating the comment
        BugComment::create([
            'bug_id' => $bug->id,
            'account_id' => Auth::user()->id,
            'comment' => $request->input('comment'),
        ]);

        // Update the status of the bug ticket
        if ($bug->account_id == Auth::user()->id)
            $bug->status = 3;
        else
            $bug->status = 6;
        $bug->save();

        return response()->json([
            'status' => 'success',
            'message' => "The comment was added to the ticket.",
            'redirect' => route('bug.show', ['bug' => $bug])
        ], 200);
    }
}
