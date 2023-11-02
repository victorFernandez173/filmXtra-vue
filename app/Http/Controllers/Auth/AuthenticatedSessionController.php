<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Redirect;

class AuthenticatedSessionController extends Controller
{
    /**
     * Renderiza la vista de logueo
     */
    public function create(): Response
    {
        //Establece como la url objetivo, la url de origen
        Redirect::setIntendedUrl(url()->previous());

        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Maneja solicitud de autenticación
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Redirige a la url objetivo también incluye valor default
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destruye sesión autenticada.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Redirige a la url objetivo
        return redirect(url()->previous());
    }
}
