<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubdomain
{
    public function handle($request, Closure $next)
    {
        // Obtém o subdomínio da requisição
        $subdomain = $this->getSubdomain($request);
        // Adiciona o subdomínio à requisição
        $request->attributes->add(['subdomain' => $subdomain]);

        return $next($request);
    }

    protected function getSubdomain($request)
    {
        $host = $request->getHost();
        $subdomain = explode('.', $host)[0];

        return $subdomain;
    }
}
