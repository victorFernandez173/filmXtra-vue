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
     * Renderizado de páginas de error
     *
     * @param $request
     * @param Throwable $e
     * @return JsonResponse|Response|RedirectResponse
     * @throws Throwable
     */
    public function render($request, Throwable $e): JsonResponse|Response|RedirectResponse
    {
        $response = parent::render($request, $e);
        $status = $response->getStatusCode();

        if (!app()->environment(['local', 'testing'])) {
            return match ($status) {
                404 => Inertia::render('Errors/404',
                    [
                        'title' => __('error_404.title'),
                        'msg' => __('error_404.msg'),
                        'inicio' => __('error_404.inicio')
                    ]
                )->toResponse($request)->setStatusCode($status),
                400, 401, 402, 403, 405, 406, 407, 408, 409, 410, 411, 412, 413, 414, 415, 416, 417, 418, 419, 420,  421, 422, 423, 424, 425, 426, 428, 429, 430, 431, 440, 444, 449, 450, 451, 460, 463, 464, 494, 495, 496, 497, 498, 499, 500, 501, 502, 503, 504, 505, 506, 507, 508, 509, 510, 511, 520, 521, 522, 523, 524, 525, 526, 527, 529, 530, 540, 561, 598, 599, 783 => Inertia::render('Errors/XXX',
                    [
                        'status' => $status,
                        'title' => __('error_XXX.title', ['status' => $status]),
                        'h1' => __('error_XXX.h1', ['status' => $status]),
                        'msg' => $status == 500 ? __('error_XXX.msg2') : __('error_XXX.msg1'),
                        'inicio' => __('error_XXX.inicio'),
                    ]
                )->toResponse($request)->setStatusCode($status),
                default => $response
            };
        }

        return $response;
    }

    // PARA DEBUGUEO CON MENSAJES DE ERROR NO CLAROS
    //    #[NoReturn] public function report(Throwable $e): void
    //    {
    //         dd($e);
    //    }
}
