<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (in_array('auth:admin', Route::current()->gatherMiddleware())) {
                return route('admin.login');
            }

            if (in_array('auth:client', Route::current()->gatherMiddleware())) {
                return route('client.login');
            }

            if (in_array('auth:provider', Route::current()->gatherMiddleware())) {
                return route('provider.login');
            }

            return route('welcome');
        }
    }
}
