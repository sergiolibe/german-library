<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function bad_request(array $errors = [], string $message = ''): JsonResponse
    {
        return $this->_400(['message' => $message ?: 'Bad Request', 'errors' => $errors]);
    }

    /**
     * OK
     * @param mixed $data
     * @return JsonResponse
     */
    public function _200(mixed $data = []): JsonResponse
    {
        return $this->_json($data, 200);
    }

    /**
     * Created
     * @param mixed $data
     * @return JsonResponse
     */
    public function _201(mixed $data = []): JsonResponse
    {
        return $this->_json($data, 201);
    }

    /**
     * No Content
     * @return JsonResponse
     */
    public function _204(): JsonResponse
    {
        return $this->_json('', 204);
    }

    /**
     * Bad Request
     * @param mixed $data
     * @return JsonResponse
     */
    public function _400(mixed $data = []): JsonResponse
    {
        return $this->_json($data, 400);
    }

    /**
     * Not Found
     * @param mixed $data
     * @return JsonResponse
     */
    public function _404(mixed $data = []): JsonResponse
    {
        return $this->_json($data, 404);
    }

    private function _json(mixed $data = [], int $http_code = 200): JsonResponse
    {
        if (is_string($data)) $data = ['message' => $data];
        return response()->json($data, $http_code);
    }

    /**
     * Internal Server Error
     * @param mixed $data
     * @return JsonResponse
     */
    public function _500(mixed $data = []): JsonResponse
    {
        return $this->_json($data, 500);
    }
}
