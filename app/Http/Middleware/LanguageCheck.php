<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LanguageCheck
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si session tiene userCustomLocale es que se ha elegido idioma manualmente
        // Si además dicho idioma existe en los idiomas disponibles
        // Entonces aplicamos dicho idioma
        // Sino, recurrimos al app.locale
        if (session()->has('userCustomLocale') and array_key_exists(session('userCustomLocale'), config('languages'))) {
            app()->setLocale(session('userCustomLocale'));
        } else {
            app()->setLocale(config('app.locale'));
        }
        return $next($request);
    }
}
