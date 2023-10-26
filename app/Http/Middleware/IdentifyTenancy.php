<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Stancl\Tenancy\Database\Models\Domain;
use Symfony\Component\HttpFoundation\Response;

class IdentifyTenancy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $domain = Domain::where('domain', $request->header('X-Tenant'))->first();
        // if (!$domain)
        //     abort(404, "Tenant not found!");

        // $tenant = $domain->tenant;

        // tenancy()->initialize($tenant);

        return $next($request);
    }
}
