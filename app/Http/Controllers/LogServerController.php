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
            ->reject('players')
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
            ->distinct()
            ->groupBy('category')
            ->get();

        // Get all logs from differents tables
        $logs_list = DB::table($tableName)
            ->from($tableName)
            ->join("logs", $tableName . '.log_id', '=', 'logs.id');
        $logs_list->leftJoin('characters', 'logs_characters.character_id', '=', 'characters.id')
            ->leftJoin('accounts', 'characters.accountID', '=', 'accounts.id')
            ->select('accounts.username', 'accounts.ip', 'logs.id', 'logs.timestamp',
                'logs.category', 'logs.message', 'characters.name', 'accountID');

        return view('log.server.show')
            ->with('logs_list', $logs_list->orderByDesc('id')->simplePaginate(20))
            ->with('type_list', $type_list)
            ->with('parameters', $parameters);
    }
}
