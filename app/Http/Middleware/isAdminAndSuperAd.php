<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdminAndSuperAd
{
    /**
     * Maneja una solicitud entrante
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Se verifica si el usuario está autenticado y tiene el rol correspondiente
        if (auth()->check() && auth()->user()->rol == 'ADMIN' || auth()->check() && auth()->user()->rol == 'SUPERAD') {
            // Si es un usuario válido, se permite que la solicitud entre
            return $next($request);
        }
        // Si no es un usuario válido, redirigir a la página principal
        return redirect('/');
    }
}
