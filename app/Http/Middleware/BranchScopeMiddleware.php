<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BranchScopeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure(Request): (Response|RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();
            if ($user && $user->hasRole('Admin')) {
                return $next($request);
            }

            $builder = $next($request)->getQuery();
            dd($builder);
            $builder->where('branch_id', $user->branch_id);

            return $builder;
        }
        return $next($request);


    }
}
