<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     *
     * Renderizado de páginas de error
     * @param $request
     * @param Throwable $e
     * @return JsonResponse|Response|RedirectResponse
     * @throws Throwable
     */
    public function render($request, Throwable $e): JsonResponse|Response|RedirectResponse
    {
        $response = parent::render($request, $e);
        $status = $response->status();

        if (!app()->environment(['local', 'testing'])) {
            return match ($status) {
                404 => Inertia::render('Errors/404')->toResponse($request)->setStatusCode($status),
                500, 503 => Inertia::render('Errors/XXX')->toResponse($request)->setStatusCode($status),
                default => $response
            };

        }

        return $response;
    }


    // PARA DEBUGUEO CON MENSAJES DE ERROR NO CLAROS
    //    #[NoReturn] public function report(Throwable $e): void
    //    {
    //        dd($e);
    //    }
}
