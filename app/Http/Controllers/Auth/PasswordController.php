<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Validator;

class PasswordController extends Controller
{
    /**
     * Actualizar el password del usuario.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = Validator::make($request->all(),
            [
                'current_password' => ['required', 'current_password'],
                'password'         => [
                    'required',
                    Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised(),
                    'confirmed'
                ],
            ],
            [],
            [
                'current_password' => trans('validation.attributes.current_password'),
                'password'         => trans('validation.attributes.password'),
            ]
        )->validate();

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back();
    }
}
