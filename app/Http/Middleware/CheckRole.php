<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role ?? '';

        // تحقق مما إذا كان دور المستخدم ضمن الأدوار المسموح بها
        foreach ($roles as $allowedRole) {
            if (strtolower(trim($userRole)) === strtolower(trim($allowedRole))) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized');
    }
}