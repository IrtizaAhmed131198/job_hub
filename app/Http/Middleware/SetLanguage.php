<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use App\Models\language;


class SetLanguage
{
    public function handle($request, Closure $next)
    {
        session()->put('lang', $this->getCode());
        $currentLanguageCode = session('lang');
        app()->setLocale($currentLanguageCode);
        return $next($request);

    }

    public function getCode()
    {
        if (session()->has('lang')) {
            return session('lang');
        }

        $language = Language::where('is_default', 1)->first();
        return $language ? $language->code : 'en';
    }
}