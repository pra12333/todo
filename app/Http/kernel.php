<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // Your middleware groups and route middleware definitions go here

    protected $routeMiddleware = [
        // Other middleware entries...
        'auth.user' => \App\Http\Middleware\AuthenticateUser::class,
    ];
    


}

