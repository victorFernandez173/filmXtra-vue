<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Log;
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
        // Si session tiene appLocale es que se ha elegido idioma manualmente
        // Si además dicho idioma exite en los idiomas disponibles
        // Entonces aplicamos dicho idiomas
        // Sino, recurrimos al fallback_locale
        if (session()->has('appLocale') and array_key_exists(session('appLocale'), config('languages'))) {
            app()->setLocale(session('appLocale'));
        } else {
            app()->setLocale(config('app.fallback_locale'));
        }
        return $next($request);
    }
}
