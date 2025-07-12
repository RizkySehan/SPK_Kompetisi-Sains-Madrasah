<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class GuestOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && in_array(Auth::user()->role, ['administration', 'homeroom-teacher', 'headmaster', 'ksm-teacher'])) {
            switch (Auth::user()->role) {
                case 'administration':
                    return redirect()->route('administration.dashboard');
                case 'homeroom-teacher':
                    return redirect()->route('homeroom-teacher.dashboard');
                case 'headmaster':
                    return redirect()->route('headmaster.dashboard');
                case 'ksm-teacher':
                    return redirect()->route('ksm-teacher.dashboard');
                default:
                    return redirect()->route('/login');
            }
        }

        return $next($request);
    }
}
