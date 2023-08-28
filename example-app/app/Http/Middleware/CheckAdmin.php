<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            $quantrivien = $user->role_id == 1 && $user->status == 1;
            $nhanvien = $user->role_id == 2 && $user->status == 1;

            if ($quantrivien || $nhanvien) {
                return $next($request);
            }
            return redirect('/');
        }

        return redirect('/admin/login');
    }
}
