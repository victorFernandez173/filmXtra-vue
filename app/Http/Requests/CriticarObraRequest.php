<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CriticarObraRequest extends FormRequest
{
    /**
     * Determina si el usuario puede evaluar si ha verificado email.
     */
    public function authorize(): bool
    {
        return $this->user()->hasVerifiedEmail();
    }

    /**
     * Reglas de validación aplicadas a la peticion.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'critica' => 'required|min:40|max:5000',
        ];
    }


    /**
     * Mensajes de validación.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function messages(): array
    {
        return [
            'critica.required' => 'No has escrito nada.',
            'critica.min'      => 'Requerimos un mínimo de texto para razonar la crítica.',
            'critica.max'      => 'Has sobrepasado el máximo permitido de texto.',
        ];
    }
}
