<?php

namespace App\Http\Middleware;

use App\Support\Tenancy\CurrentTenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveTenant
{
    public function handle(Request $request, Closure $next): Response
    {
        $tenantId = $request->header('X-Tenant-ID');

        if (! $tenantId) {
            return response()->json([
                'message' => 'The X-Tenant-ID header is required.',
            ], 400);
        }

        app()->instance(CurrentTenant::class, new CurrentTenant($tenantId));

        return $next($request);
    }
}
