<?php

namespace App\Http\Middleware;

use App\Models\BugTicket;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsHisBugTicket
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
        $bugTicket = $request->route('bug');
        if (($bugTicket->account_id != Auth::user()->id) && (Auth::user()->developer <= 0 && Auth::user()->admin <= 0))
            abort(403);

        return $next($request);
    }
}
