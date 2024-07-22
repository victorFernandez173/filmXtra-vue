<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SocialiteLoginMail;
use App\Models\LoginTipo;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;
use Mail;
use Redirect;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page
     *
     */
    public function redirectToProvider()
    {
        //Establece como la url objetivo, la url de origen
        Redirect::setIntendedUrl(url()->previous());

        return Socialite::driver('google')->with(["prompt" => "select_account"])->redirect();
    }

    /**
     * Logs in the user
     * @return RedirectResponse
     */
    public function handleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = Usuario::updateOrCreate(
            [
                'social_id' => $googleUser->id,
            ],
            [
                'usuario'                => $googleUser->name,
                'email'                  => $googleUser->email,
                'login_tipo_id'          => LoginTipo::GOOGLE_TIPO,
                'email_verificado_fecha' => Date::now()
            ]
        );

        Mail::to($user->email)->send(new SocialiteLoginMail($user));
        Auth::login($user);
        return redirect()->intended();
    }
}
