<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function current_user(): JsonResponse
    {
        $u = User::with([])->findOrFail(Auth::id());
        return $this->_200($u);
    }
}
