<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureEntreprenariatAdmin
{
    private const ROLE = 'admin_entreprenariat';

    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('admin_id')) {
            return redirect()->route('admin.entreprenariat.login');
        }

        if ($request->session()->get('admin_role') !== self::ROLE) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
