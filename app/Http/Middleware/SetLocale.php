<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    protected array $supported = ['ar', 'en'];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->query('locale')
            ?? $request->header('Accept-Language')
            ?? config('app.locale');

        $locale = in_array($locale, $this->supported) ? $locale : config('app.locale');

        app()->setLocale($locale);

        return $next($request);
    }
}
