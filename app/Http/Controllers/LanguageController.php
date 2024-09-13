<?php

namespace App\Http\Controllers;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        if (array_key_exists($lang, config('languages'))) {
            session(['userCustomLocale' => $lang]);
        }
        return redirect()->back();
    }
}
