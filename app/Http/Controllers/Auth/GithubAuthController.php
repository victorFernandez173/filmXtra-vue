<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SocialiteLoginMail;
use App\Models\LoginTipo;
use App\Models\Usuario;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Mail;

class GithubAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleCallback(): RedirectResponse
    {
        $gitUser = Socialite::driver('github')->user();
        $user = Usuario::firstOrNew(
            [
                'social_id' => $gitUser->id,
            ],
            [
                'usuario'       => $gitUser->name,
                'email'         => $gitUser->email,
                'login_tipo_id' => LoginTipo::GIT_TIPO,
            ]
        );
        $user->email_verificado_fecha = now();
        $user->save();

        Mail::to($user->email)->send(new SocialiteLoginMail($user));
        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
