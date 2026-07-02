<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o usuário está logado e se é admin
        if ($request->user() && $request->user()->isAdmin()) {
            return $next($request);
        }

        // Se não for admin, redireciona para o dashboard com erro
        return redirect()->route('dashboard')->with('error', 'Acesso negado: você não tem permissão de administrador.');
    }
}