<?php

namespace App\Http\Requests;

use App\Http\Repositorios\ObrasRepo;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BuscarTitulosRequest extends FormRequest
{
    /**
     * Reglas validación.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'tituloBuscado' =>
            [
                'required',
                function (string $attribute, mixed $valor, Closure $fail)
                {
                    if (ObrasRepo::obtenerObrasBusqueda($valor)->count() == 0) {
                        $fail("Sin resultados");
                    }
                }
            ],
        ];
    }


    /**
     * Mensajes validación.
     */
    public function messages(): array
    {
        return [
            'tituloBuscado.required' => 'Busca algún título',
        ];
    }
}
