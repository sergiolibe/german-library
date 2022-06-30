<?php
declare(strict_types=1);


namespace App\Http\Controllers;

use App\Http\Payload\Auth\SignIn;
use App\Http\Payload\Auth\SignUp;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function sign_in(Request $r): JsonResponse
    {
        $sign_in = SignIn::validate($r);
        if ($sign_in->is_error) return $this->bad_request($sign_in->errors);

        /** @var User|null $user */
        $user = User::where('email', $sign_in->email)->first();

        if (!is_null($user) && Hash::check($sign_in->password, $user->password)) {
            $jwt = JWT::encode([
                'iss' => 'Corp Inc',
                'aud' => 'Corp Inc',
                'iat' => time(),
                'nbf' => time(),
                'exp' => time() + 86400 * 30,
                'sub' => $user->id,
            ], env('JWT_KEY'), 'HS256');

            return $this->_200(['user' => $user, 'jwt' => $jwt]);
        }

        return $this->_404('User details incorrect');
    }

    public function sign_up(Request $r): JsonResponse
    {
        $sign_up = SignUp::validate($r);
        if ($sign_up->is_error) return $this->bad_request($sign_up->errors);

        $count = User::where('email', $sign_up->email)->count();

        if ($count > 0) return $this->bad_request(['email' => 'Email already in use']);

        $u           = new User;
        $u->name     = $sign_up->name;
        $u->email    = $sign_up->email;
        $u->password = Hash::make($sign_up->password);
        $u->save();

        return $this->_201('User created');
    }
}