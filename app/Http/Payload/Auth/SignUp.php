<?php
declare(strict_types=1);

namespace App\Http\Payload\Auth;

use App\Http\Payload\BasePayload;

/* @method static static validate(\Illuminate\Http\Request $r) */
class SignUp extends BasePayload
{
    const rules = [
        'name'     => ['required', 'string', 'max:255'],
        'email'    => ['required', 'string', 'max:255'],
        'password' => ['required', 'string', 'max:255'],
    ];

    public function __construct(
        public readonly string $name = '',
        public readonly string $email = '',
        public readonly string $password = '',
    )
    {
    }
}