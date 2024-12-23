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

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->with(['prompt' => 'select_account'])->redirect();
    }

    /**
     * Logs in the user
     *
     * @return RedirectResponse
     */
    public function handleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = Usuario::firstOrNew(
            [
                'social_id' => $googleUser->id,
            ],
            [
                'usuario' => $googleUser->name,
                'email' => $googleUser->email,
                'login_tipo_id' => LoginTipo::GOOGLE_TIPO,
            ]
        );
        $user->email_verificado_fecha = now();
        $user->save();

        Mail::to($user->email)->send(new SocialiteLoginMail($user));
        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
