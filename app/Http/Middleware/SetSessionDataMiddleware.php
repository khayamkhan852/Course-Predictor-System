<?php

namespace App\Http\Middleware;

use App\Models\Branch;
use Closure;
use Illuminate\Http\Request;

class SetSessionDataMiddleware
{
    /**
     * Checks if session data is set or not for a user. If data is not set then set it.
     *
     * @param Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && ! $request->session()->has('branch_id')) {
            $user = auth()->user();
            $branch = Branch::findOrFail($user->branch_id);
            $request->session()->put('branch_id', $branch->id);
        }

        return $next($request);
    }
}
