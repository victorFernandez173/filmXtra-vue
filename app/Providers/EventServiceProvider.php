<?php

namespace App\Providers;

use App\Events\BajaUsuario;
use App\Listeners\BajaUsuarioEscuchador;
use App\Listeners\ReseteoPasswordExitosoEscuchador;
use App\Listeners\VerificacionEmailExitosaEscuchador;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class    => [
            SendEmailVerificationNotification::class,
        ],
        Verified::class      => [
            VerificacionEmailExitosaEscuchador::class
        ],
        PasswordReset::class => [
            ReseteoPasswordExitosoEscuchador::class
        ],
        BajaUsuario::class => [
            BajaUsuarioEscuchador::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
