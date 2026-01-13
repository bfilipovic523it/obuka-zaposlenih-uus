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

        $user = auth()->user();

        // ADMIN
        if ($user->uloga->naziv === 'Administrator') {
            return redirect()->route('obukas.index');
        }

        // PREDAVAC
        if ($user->uloga->naziv === 'Predavac') {
            return redirect()->route('predavac.obuke');
        }

        // ZAPOSLENI
        if ($user->uloga->naziv === 'Zaposleni') {
            return redirect()->route('zaposleni.obuke.index');
        }
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
