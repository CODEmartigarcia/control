<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies = '*'; // Acepta todos los proxies. Ajusta según tu entorno si es necesario.

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = \Illuminate\Http\Request::HEADER_X_FORWARDED_FOR;
}