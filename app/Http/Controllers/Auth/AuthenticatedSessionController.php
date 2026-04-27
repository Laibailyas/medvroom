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
     * Display the login view for patients (jobseekers).
     */
    public function create(): View
    {
        return view('auth.login', ['role' => 'patient']);
    }

    /**
     * Display the login view for providers.
     */
    public function createProvider(): View
    {
        return view('auth.login', ['role' => 'doctor']);
    }

    /**
     * Display the login view for admins.
     */
    public function createAdmin(): View
    {
        return view('auth.login', ['role' => 'admin']);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = Auth::user();
        $intendedRole = $request->input('intended_role', 'patient');

        // Validate role
        if ($user->role !== $intendedRole) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $roleName = $intendedRole === 'doctor' ? 'Provider' : ($intendedRole === 'admin' ? 'Admin' : 'Patient');
            
            return redirect()->back()->withErrors([
                'email' => "This account does not have $roleName access. Please log in through the correct portal.",
            ])->withInput($request->only('email', 'remember'));
        }

        $request->session()->regenerate();

        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
