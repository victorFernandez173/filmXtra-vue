<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a hacer esta petición.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:25'],
            // Ahora el bloque de email incorpora una regla que va a tener en cuenta que 'email' es único cuando 'social_type' es 'filmXtra'. Es decir, es posible que un usuario se pueda registrar con dos cuentas: google y estándar. Así si el usuario ya tiene cuenta para un email con google o'auth y trata de registrarse de manera estándar con el formulario y ese mismo email, podrá: ya que el 'social_type' no va a coincidir. Pero si ya tiene cuenta estándar no podrá, porque el 'social_type' si va a coincidir: 'filmXtra'. El usuario podrá tener dos cuentas diferentes si se registra de las dos maneras o incluso más si se registra con diferentes proveedores o'auth: google y github.
            'email' => ['required', 'max:60', 'email:rfc,dns', Rule::unique('users', 'email')->where('social_type', 'filmXtra')],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
