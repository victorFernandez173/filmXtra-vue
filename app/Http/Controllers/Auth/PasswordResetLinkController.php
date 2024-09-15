<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class PasswordResetLinkController extends Controller
{
    /**
     * Muestra la vista de petición de reseteo de password.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    /**
     * Maneja una peticion de enlace de reseteo de contraseña.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Mandaremos un link de reseteo al usario. Cuando hayamos intentado mandarlo
        // examinaremos la respuesta y veremos el mensaje que hay que enseñar al usario.
        // Para finalmente envíar el mensaje adecuado.

        // En sendResetLink() se requiere la existencia de la tabla pasword_reset_tokens,
        // aunque parece que no se almacenan registros con esta implementación que tengo activa
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __('forgot_password.enviado'));
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
