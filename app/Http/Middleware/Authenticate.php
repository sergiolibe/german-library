<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Http\Request;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var Factory
     */
    protected Factory $auth;

    /**
     * Create a new middleware instance.
     *
     * @param Factory $auth
     * @return void
     */
    public function __construct(Factory $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ?string $guard = null): mixed
    {
        if ($this->auth->guard($guard)->guest()) {
            return response()->json('Unauthorized.', 401);
        }

        return $next($request);
    }
}
