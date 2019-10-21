<?php

namespace App\Http\Middleware;

use App\Models\Character;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsHisCharacter
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
        $character = Character::findOrFail($request->route('id'));
        if ($character->accountID != Auth::user()->id)
            abort(403);

        return $next($request);
    }
}
