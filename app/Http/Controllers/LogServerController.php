<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogServerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $logs_tables = collect(DB::connection()->getDoctrineSchemaManager()->listTableNames())
            ->map(function($table) {
                $count = 0;
                $table = str_replace('logs_', '', $table, $count);
                return (($count > 0) ? $table : null);
            })
            ->reject(function($table) {
                return empty($table);
            }
        );
        return view('log.server.index')
            ->with('tables_list', $logs_tables);
    }
    public function show(Request $request, $tableLog)
    {
        $this->middleware('IsValidLogServerTable');

        $tableName = 'logs_' . $tableLog;
        $parameters = array('type' => false, 'status' => false);

        // Get all differents types
        $type_list = DB::table('logs')
            ->select('category')
            ->join($tableName, 'logs.id', '=', $tableName . '.log_id')
            ->groupBy('category')
            ->get();

        // Get all logs from differents tables
        $logs_list = DB::table($tableName)
            ->from('logs')
            ->join($tableName, 'logs.id', '=', $tableName . '.log_id');
        if ($tableLog !== "players")
            $logs_list->join('logs_players', 'logs.id', '=', 'logs_players.log_id');
        $logs_list->join('characters', 'logs_players.player_id', '=', 'characters.id')
            ->join('accounts', 'characters.accountID', '=', 'accounts.id')
            ->select('accounts.username', 'accounts.ip', 'logs.id', 'logs.timestamp',
                'logs.category', 'logs.message', 'characters.name', 'accountID');

        if ($request->get('type') != null && $request->get('type') != "All") {
            $parameters['type'] = true;
            $logs_list->where('logs.category', '=', $type_list[$request->get('type')]->category);
        }
        if ($request->get('user') != null) {
            $parameters['user'] = true;

            if (User::where('username', $request->get('user'))->count() > 0) {
                $logs_list->where('accounts.username', 'like', '%' . $request->get('user') . '%');
            }
            elseif (Character::where('name', $request->get('user'))->count() > 0) {

                $logs_list->where('characters.name', 'like', '%' . $request->get('user') . '%');
            }
            else {
                $request->session()->flash('user', 'This user doesnt exist.');
            }

        }
        if ($request->get('search') != null) {
            $parameters['search'] = true;
            $logs_list->where('logs.message', 'like', '%' . $request->get('search') . '%');
        }

        return view('log.server.show')
            ->with('logs_list', $logs_list->orderByDesc('id')->paginate(20))
            ->with('type_list', $type_list)
            ->with('parameters', $parameters);
    }
}
