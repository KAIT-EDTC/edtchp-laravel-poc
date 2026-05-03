<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BasicAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, $next)
    {
        $user = env('POC_USER');
        $pass = env('POC_PASSWORD');
        $environment = env('APP_ENV');

        if (
            $environment === 'production' && 
           ($request->getUser() !== $user || $request->getPassword() !== $pass)
        ) 
        {
            return response('Unauthorized', 401, ['WWW-Authenticate' => 'Basic realm="PoC"']);
        }

        return $next($request);
    }
}
