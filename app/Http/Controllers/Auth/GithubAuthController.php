<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SocialiteLoginMail;
use App\Models\LoginTipo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;
use Mail;

class GithubAuthController extends Controller
{
    /**
     * Redirect the user to the Github authentication page
     *
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Log ins the user
     * @return RedirectResponse
     */
    public function handleCallback(): RedirectResponse
    {
        $gitUser = Socialite::driver('github')->user();
        $user = User::firstOrCreate(
            [
                'social_id' => $gitUser->id,
            ],
            [
                'usuario'                => $gitUser->name,
                'email'                  => $gitUser->email,
                'login_tipo_id'          => LoginTipo::GIT_TIPO,
                'email_verificado_fecha' => Date::now()
            ]
        );
        // Siempre se envía mail, podría configurarse para envíar solo cuando no exista el usuario(social_id)
        Mail::to($user->email)->send(new SocialiteLoginMail($user));
        Auth::login($user);
        return redirect()->intended();
    }
}
