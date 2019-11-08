<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\LogPanel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('log.panel.index')
            ->with('tables_list', LogPanel::select('type')->groupBy('type')->get());
    }

    public function show(Request $request, $typeLog)
    {
        $parameters = array('category' => false, 'status' => false);

        // Get all differents categories
        $category_list = LogPanel::select('category')
            ->where('type', $typeLog)
            ->groupBy('category')
            ->get();

        // Get all logs from differents tables
        $logs_list = LogPanel::where('type', $typeLog);

        if ($request->get('category') != null && $request->get('category') != "All") {
            $parameters['category'] = true;
            $logs_list->where('category', $category_list[$request->get('category')]->category);
        }
        if ($request->get('user') != null) {
            $user = User::where('username', $request->get('user'))->first();
            if ($user !== null) {
                $logs_list->where('account_id', $user->id);
                $parameters['user'] = true;
            }
            else {
                $request->session()->flash('user', 'This user doesnt exist.');
            }
        }
        if ($request->get('search') != null) {
            $parameters['search'] = true;
            $logs_list->where('message', 'like', '%' . $request->get('search') . '%');
        }

        return view('log.panel.show')
            ->with('logs_list', $logs_list->paginate(20))
            ->with('category_list', $category_list)
            ->with('parameters', $parameters);
    }}
