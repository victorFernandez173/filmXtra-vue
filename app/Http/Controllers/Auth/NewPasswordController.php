<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Validator;

class NewPasswordController extends Controller
{
    /**
     * Muesra la vista de reseteo de password
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Auth/ResetPassword', [
            'email' => Usuario::where('id', $request->id)->pluck('email')[0],
            'token' => $request->route('token'),
        ]);
    }

    /**
     * Maneja la petición de nuevo password.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        Validator::make($request->all(),
            [
                'token' => 'required',
                'email' => 'required|email:rfc,dns',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ],
            [],
            [
                'email' => trans('validation.attributes.email'),
                'token' => trans('validation.attributes.token'),
                'password' => trans('validation.attributes.password'),
            ]
        )->validate();

        // Para resetear el password del usario. Si hay éxito, se modificará
        // el password de un usuario de forma persistente también en la bbdd.
        // Sino, se devolverá el error.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request['password']),
                ])->save();
            }
        );

        // Si el password ha sido reseteado con éxito, redirigimos
        // a la pagina de login. Si ha habido errores
        // se redirige a donde estuvieran antes.
        if ($status == Password::PASSWORD_RESET) {

            // Evento para enviar un email de confirmación de reseteo de password
            $usuario = Usuario::where('email', $request['email'])->first();
            event(new PasswordReset($usuario));

            return redirect()->route('login')->with('status', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
