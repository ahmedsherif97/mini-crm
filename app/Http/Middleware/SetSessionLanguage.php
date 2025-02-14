<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetSessionLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestLanguage = $request->header('Accept-Language') ?? 'ar';
        if(!in_array($requestLanguage, ['ar', 'en'])) $requestLanguage = 'ar';

        session()->put('lang', $requestLanguage);

        App::setLocale($requestLanguage);

        return $next($request);
    }
}
