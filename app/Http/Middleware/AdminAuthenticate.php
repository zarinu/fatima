<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->user()->isAdmin()) {
            return redirect('panel');
        }
        return $next($request);
    }
}
