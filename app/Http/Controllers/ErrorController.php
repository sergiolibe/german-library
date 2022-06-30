<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Error;
use App\Models\Errors;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ErrorController extends Controller
{
    public function render_500(): JsonResponse
    {
        $e1     = new Error('DP-PBI-123', 'DB inconsistency', 'DP_PBI_123', 'Something went wrong with the validation of XYZ');
        $e2     = new Error('DP-PBI-456', 'Subscription Invalid', 'DP_PBI_456', 'An error occurred with the given subscription');
        $has_1  = false;
        $errors = [];
        if (rand(1, 100) > 50) {
            $errors[] = $e1;
            $has_1    = true;
        }
        if (rand(1, 100) > 50 || !$has_1) $errors[] = $e2;
        $errors = new Errors('1.0', $errors);
        return $this->_500($errors);
    }

    public function render_401(): Response
    {
        return response('Unauthorized', 401);
    }
}