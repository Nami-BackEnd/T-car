<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetCompanyLocale
{
    public const SESSION_KEY = 'company_locale';

    protected array $supported = ['ar', 'en'];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get(self::SESSION_KEY, config('app.locale'));

        if (! in_array($locale, $this->supported, true)) {
            $locale = config('app.locale');
        }

        App::setLocale($locale);

        return $next($request);
    }
}