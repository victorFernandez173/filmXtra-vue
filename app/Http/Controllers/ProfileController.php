<?php

namespace App\Http\Controllers;

use App\Events\BajaUsuario;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\LoginTipo;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Muestra el formulario de perfil del usuario.
     */
    public function edit(Request $request): Response
    {
        //Establece como la url objetivo, la url previa
        Redirect::setIntendedUrl(url()->previous());

        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Actualiza la información de perfil del usuario.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verificado_fecha = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Borra la cuenta del usuario
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->login_tipo_id == LoginTipo::FILMXTRA_TIPO) {
            $request->validate(
                [
                    'password' => ['required', 'current_password'],
                ],
                [
                    'password.required' => __('validation.required', ['attribute' => trans('validation.attributes.password')]),
                    'password.current_password' => __('validation.current_password', ['attribute' => trans('validation.attributes.password')]),
                ]
            );
        }

        Auth::logout();

        // Si el borrado es efectivo, se despacha el evento
        BajaUsuario::dispatchIf($user->delete(), $user);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(RouteServiceProvider::HOME)->with('borradoCuentaExitoso', true);
    }
}
