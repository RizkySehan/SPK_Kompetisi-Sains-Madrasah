<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $role = Auth::user()->role;

        $redirects = [
            'administration' => 'administration.dashboard',
            'homeroom-teacher' => 'homeroom-teacher.dashboard',
            'headmaster' => 'headmaster.dashboard',
            'ksm-teacher' => 'ksm-teacher.dashboard',
        ];


        if (array_key_exists($role, $redirects)) {
            return redirect()->route($redirects[$role])->with('success', 'Login successfully!');
        }

        Auth::logout(); // Logout kalau role tak dikenal
        return redirect()->route('login')->with('error', 'Role is not recognized.');
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout Successed!');
    }
}
