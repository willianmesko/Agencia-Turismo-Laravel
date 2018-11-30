<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Redireciona para caso não esteja logado
        if ( !auth()->check() )
            return redirect()->back();

        // Redireciona caso não seja um administrador
        if ( !auth()->user()->is_admin )
            return redirect()->back();

        return $next($request);
    }
}
