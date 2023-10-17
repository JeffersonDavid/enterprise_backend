<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiErrorHandlingMiddleware
{
    public function handle(Request $request, Closure $next)
    {

      
        try {

            return $next($request);

        } catch (\Exception $e) {

           
            return $this->handleException($e);
        }
    }

    private function handleException(\Exception $e)
    {
        // Puedes personalizar el manejo de excepciones aquí
        // Por ejemplo, registrarlo en un archivo de registro, enviar una respuesta JSON, etc.
        return new JsonResponse([
            'error' => $e->getMessage(),
        ], 500); // Enviar una respuesta JSON con un código de estado 500 (Error interno del servidor)
    }
}
