<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ShouldHaveOrganizationBeforeLocalAdminCreation
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->organizations->isEmpty()) {
            return back()->with("error", "You must have at least one organization before proceeding to create localadmin");
        }

        return $next($request);
    }
}
