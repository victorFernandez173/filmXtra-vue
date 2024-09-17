<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a hacer la petición.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'    => ['required', 'email:rfc,dns'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Para la localizacion de los attributos en los mensajes de validación.
     *
     * @return array<string, Rule|array|string>
     */
    public function attributes(): array
    {
        return [
            'email'    => trans('validation.attributes.email'),
            'password' => trans('validation.attributes.password'),
        ];
    }

    /**
     * Intento de autenticar las credenciales de la petición.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Comprueba si hay límite de intentos..
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Devuelve el límite de intentos.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')) . '|' . $this->ip());
    }
}
