<?php

namespace App\Http\Requests;

use App\Models\Usuario;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Obtiene las reglas de validación que se aplican a la petición de actualización de perfil.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'usuario' => ['required', 'string', 'max:25'],
            'email'   => ['required', 'email', 'max:60', Rule::unique(Usuario::class)->ignore($this->user()->id)],
        ];
    }

    public function messages(): array
    {
        return [
            'usuario.required' => 'Usuario requerido',
            'usuario.max'      => 'Máximo 25 caracteres',
            'usuario.string'   => 'Inserte texto para el usuario',
            'email.max'        => 'Máximo 60 caracteres',
            'email.required'   => 'Inserte email',
            'email.email'      => 'Inserte un email válido',
            'email.unique'     => 'Ya existe este email'
        ];
    }
}
