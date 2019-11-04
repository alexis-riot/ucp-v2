<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class IsValidLogServerTable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $collection = collect(DB::connection()->getDoctrineSchemaManager()->listTableNames());
        if (!$collection->contains('logs_' . $request->route('log')))
            abort(401);

        return $next($request);
    }
}
