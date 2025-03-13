<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * 
     *
     * 
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\Cors::class,
        // otros middlewares...
    ];

    /**
     * 
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * 
     *
     * 
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        //
    ];

    /**
     * 
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/*', 
    ];
}
