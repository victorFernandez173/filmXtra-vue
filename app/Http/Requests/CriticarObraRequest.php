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
            'critica.required' => __('ficha_valoraciones.formularios.critica.requerida'),
            'critica.min'      => __('ficha_valoraciones.formularios.critica.min'),
            'critica.max'      => __('ficha_valoraciones.formularios.critica.max'),
        ];
    }
}
