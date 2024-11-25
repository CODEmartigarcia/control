<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        // Verifica si el usuario está autenticado y tiene el rol admin
        if (!$request->user() || $request->user()->role !== 'admin') {
            abort(403, 'No tienes permisos para acceder a esta página.');
        }
        return $next($request);
        // return redirect('/');
    }
}
