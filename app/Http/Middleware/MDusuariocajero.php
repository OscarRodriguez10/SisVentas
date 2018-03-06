<?php

namespace sisVentas\Http\Middleware;

use Closure;

class MDusuariocajero
{
    
    public function handle($request, Closure $next)
    {
       $usuario_actual=\Auth::user();

        if($usuario_actual->tipoUsuario!=1){
         return view("mensajes.msj_rechazado")->with("msj","Esta seccion es solo visible para el usuario Gerente <br/> usted aun no ha sido asignado como usuario Gerente , consulte al administrador del sistema");
        }
        return $next($request);
    
    }
}
