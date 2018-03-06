<?php

namespace sisVentas\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /*
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \sisVentas\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \sisVentas\Http\Middleware\VerifyCsrfToken::class,
        
    ];
    /*
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        
        'auth' => \sisVentas\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \sisVentas\Http\Middleware\RedirectIfAuthenticated::class,
        'usuarioadmin'=> \sisVentas\Http\Middleware\MDusuarioadmin::class,
        'usuariocajero'=> \sisVentas\Http\Middleware\MDusuariocajero::class,
    
    ];


     protected $middlewareGroups = ['web' => [
            \sisVentas\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \sisVentas\Http\Middleware\VerifyCsrfToken::class,

            
        ],

        'api' => [
        'throttle:60,1',
        ],
    ];
}