<?php

namespace App\Providers;

use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void;
     */
    public function boot(): void
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function (Request $request): ?User {
            $jwt = $request->bearerToken() ?? $request->get('token');
            if (is_null($jwt)) return null;

            try {
                $payload = JWT::decode($jwt, new Key(env('JWT_KEY'), 'HS256'));
            } catch (\Exception $e) {
                return null;// response()->json(['message'=>$e->getMessage()], 401);
            }

            if (!isset($payload->sub)) return null;
            $uid = (int)$payload->sub;

            /** @var User|null $u */
            $u = User::where('id', $uid)->first();
            if (is_null($u)) return null;
            return $u;
        });
    }
}
