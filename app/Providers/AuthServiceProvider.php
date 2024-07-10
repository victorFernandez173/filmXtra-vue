<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Mail\VerificacionMail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Correo de validación personalizado sustituye email por defecto de validación
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return new VerificacionMail($notifiable, $url);
        });
    }
}
