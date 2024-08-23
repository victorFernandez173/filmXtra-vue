<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SocialiteLoginMail;
use App\Models\LoginTipo;
use App\Models\Usuario;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;
use Mail;
use Redirect;

class GithubAuthController extends Controller
{
    /**
     * Redirect the user to the Github authentication page
     *
     */
    public function redirectToProvider()
    {
        //Establece como la url objetivo, la url de origen
        Redirect::setIntendedUrl(url()->previous());

        return Socialite::driver('github')->redirect();
    }

    /**
     * Log ins the user
     * @return RedirectResponse
     */
    public function handleCallback(): RedirectResponse
    {
        $gitUser = Socialite::driver('github')->user();
        $user = Usuario::firstOrCreate(
            [
                'social_id' => $gitUser->id,
            ],
            [
                'usuario'                => $gitUser->name,
                'email'                  => $gitUser->email,
                'login_tipo_id'          => LoginTipo::GIT_TIPO,
            ]
        );
        $user->email_verificado_fecha = now();
        $user->save();

        Mail::to($user->email)->send(new SocialiteLoginMail($user));
        Auth::login($user);
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
