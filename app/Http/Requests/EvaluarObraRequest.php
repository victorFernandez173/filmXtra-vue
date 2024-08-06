<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EvaluarObraRequest extends FormRequest
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
            'evaluacion' => 'required|int|min:0|max:10',
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
            'evaluacion' => 'No has elegido una puntuación.'
        ];
    }
}
